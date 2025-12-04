<?php
// dashboard.php
require_once 'verifica_sessao.php';
verificaLogin();
$nome_usuario = $_SESSION['usuario_nome'] ?? 'Usuário';

// Verifica se o usuário é administrador (via cookie)
$is_admin = (isset($_COOKIE['admin_status']) && $_COOKIE['admin_status'] === 'true');

$usuarios = [];
$show_user_list = false;
require_once 'banco_de_dados.php';

// Se o admin clicar em "Mostrar Cadastros" OU veio de exclusão
if ((isset($_GET['action']) && $_GET['action'] === 'show_users') || isset($_SESSION['message'])) {
    if ($is_admin) {
        try {
            $sql = "SELECT id, nome, email, nivel_acesso FROM usuarios";
            $stmt = $pdo->query($sql);
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $show_user_list = true;
        } catch (PDOException $e) {
            echo "<p style='color:red;'>Erro ao buscar usuários: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        // Se um usuário comum tentar acessar a lista, redireciona para Sem Permissão
        header('Location: sem_permissao.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Sistema</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="page-container">

        <!-- Cabeçalho dashboard -->
        <header class="dashboard-header">
            <h1>Bem-vindo(a), <?= htmlspecialchars($nome_usuario) ?>!</h1>
            <div class="header-actions">
                <a href="wiki_page.php" class="btn-nav-wiki">Acessar Wiki</a>
                <a href="logout.php" class="btn-logout">Sair</a>
            </div>
        </header>

        <!-- Mensagem de sessão -->
        <?php
        if (isset($_SESSION['message'])) {
            $message_style = strpos($_SESSION['message'], 'sucesso') !== false ? 'success-message' : 'error-message';
            echo '<p class="' . $message_style . '">' . htmlspecialchars($_SESSION['message']) . '</p>';
            unset($_SESSION['message']);
        }
        ?>

        <!-- Usuário padrão -->
        <section>
            <h2 class="text-xl font-semibold mb-4">Minhas Informações</h2>
            <p>Aqui você pode ver o seu status e informações básicas da sua conta.</p>
            <p>Seu nível de acesso: <span class="font-bold <?= $is_admin ? 'text-yellow-400' : 'text-green-400' ?>"><?= $is_admin ? 'Administrador' : 'Usuário Padrão' ?></span></p>
        </section>


        <!-- Apenas administradores -->
        <?php if ($is_admin): ?>
            <hr class="my-6 border-gray-700">
            <section>
                <h2 class="text-xl font-semibold mb-4">Área Administrativa</h2>
                
                <!-- Botão de Ação -->
                <?php if (!$show_user_list): ?>
                    <p class="mb-4">Use a área administrativa para gerenciar os usuários do sistema.</p>
                    <a href="dashboard.php?action=show_users" class="action-btn">Mostrar Cadastros</a>
                <?php endif; ?>

            </section>

            <!-- Cadastros, visível apenas para administradores -->
            <?php if ($show_user_list): ?>
                <h3 class="text-lg font-bold mt-6 mb-4">Lista de Usuários</h3>
                
                <?php if (count($usuarios) > 0): ?>
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Nível</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?= htmlspecialchars($usuario['id']) ?></td>
                                    <td><?= htmlspecialchars($usuario['nome']) ?></td>
                                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                                    <td><?= htmlspecialchars($usuario['nivel_acesso']) ?></td>
                                    <td>
                                        <a href="editar_usuario.php?id=<?= $usuario['id'] ?>" class="action-btn edit-btn">Editar</a>
                                        <a href="excluir_usuario.php?id=<?= $usuario['id'] ?>" 
                                           class="action-btn delete-btn" 
                                           onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
                                           Excluir
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Nenhum usuário cadastrado até o momento.</p>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <script src="js/script.js"></script>
</body>
</html>