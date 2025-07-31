<?php
// Código que envia proposta
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $valor = $_POST['valor'];

    $data = ['nome' => $nome, 'cpf' => $cpf, 'valor' => $valor];
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n" .
                         "Authorization: Bearer " . API_TOKEN . "\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];
    $context  = stream_context_create($options);
    $result = file_get_contents(API_URL . 'proposta', false, $context);

    echo $result;
}
?>