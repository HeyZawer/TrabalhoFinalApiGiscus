<?php
session_start();
require_once 'banco_de_dados.php';

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = (int) $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    $_SESSION['message'] = "Usuário não encontrado.";
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $nivel_acesso = $_POST['nivel_acesso'];

    if (empty($nome) || empty($email)) {
        $_SESSION['message'] = "Preencha todos os campos.";
    } else {
        $update = $pdo->prepare("UPDATE usuarios SET nome=?, email=?, nivel_acesso=? WHERE id=?");
        if ($update->execute([$nome, $email, $nivel_acesso, $id])) {
            $_SESSION['message'] = "Usuário atualizado com sucesso!";
        } else {
            $_SESSION['message'] = "Erro ao atualizar o usuário.";
        }
        header("Location: dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-layout">
    <div class="container form-container">
        <h1>Editar Usuário</h1>

        <form method="POST">
            <div class="input-group">
                <label>Nome:</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
            </div>

            <div class="input-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
            </div>

            <div class="input-group">
                <label>Nível de Acesso:</label>
                <select name="nivel_acesso" style="width:100%; padding:10px; border-radius:4px; background-color:#333; color:#fff; border:1px solid #444;">
                    <option value="user" <?= $usuario['nivel_acesso'] === 'user' ? 'selected' : '' ?>>Usuário</option>
                    <option value="admin" <?= $usuario['nivel_acesso'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
                </select>
            </div>

            <button type="submit">Salvar Alterações</button>
            <div class="toggle-form">
                <a href="dashboard.php">Voltar</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
