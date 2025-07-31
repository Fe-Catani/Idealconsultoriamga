<?php
include('config.php');

if (isset($_GET['alterar_status']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = $_GET['alterar_status'] == 'ativo' ? 1 : 0;

    // Verificar se o usuário com o ID fornecido existe
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Atualizar status do usuário
        $sql = "UPDATE usuarios SET ativo = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $status, $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'Status do usuário alterado com sucesso.';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Erro ao alterar status do usuário: ' . $stmt->error;
            $_SESSION['message_type'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Usuário não encontrado.';
        $_SESSION['message_type'] = 'danger';
    }

    $stmt->close();
} else {
    $_SESSION['message'] = 'Parâmetros inválidos.';
    $_SESSION['message_type'] = 'danger';
}

// Redirecionar de volta para a página principal
header("Location: criar_usuario.php");
exit();
?>