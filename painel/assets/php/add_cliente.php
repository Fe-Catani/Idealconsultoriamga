<?php
include 'config.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['nome']) && !empty($data['telefone']) && !empty($data['cpf']) && !empty($data['atendente'])) {
    $stmt = $pdo->prepare("INSERT INTO clientes (nome, telefone, cpf, atendente) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$data['nome'], $data['telefone'], $data['cpf'], $data['atendente']])) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
