<?php
session_start();
require_once 'banco_de_dados.php';

// ✅ Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    $_SESSION['message'] = "ID do usuário não informado.";
    header("Location: dashboard.php?action=show_users");
    exit();
}

$id = (int) $_GET['id'];

// ✅ Evita que um admin exclua a si mesmo
if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] == $id) {
    $_SESSION['message'] = "Você não pode excluir sua própria conta.";
    header("Location: dashboard.php?action=show_users");
    exit();
}

try {
    // Busca o usuário antes de excluir
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        $_SESSION['message'] = "Usuário não encontrado.";
        header("Location: dashboard.php?action=show_users");
        exit();
    }

    // Bloqueia exclusão de outros administradores
    if ($usuario['nivel_acesso'] === 'admin') {
        $_SESSION['message'] = "Você não pode excluir outro administrador.";
        header("Location: dashboard.php?action=show_users");
        exit();
    }

    // Executa a exclusão
    $delete = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $delete->execute([$id]);

    $_SESSION['message'] = "Usuário excluído com sucesso!";

} catch (PDOException $e) {
    $_SESSION['message'] = "Erro ao excluir usuário: " . $e->getMessage();
}

// ✅ Redireciona de volta para o painel
header("Location: dashboard.php?action=show_users");
exit();
?>
