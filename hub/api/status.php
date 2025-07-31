<?php
// Consulta status
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $cpf = $_GET['cpf'];

    $options = [
        'http' => [
            'header'  => "Authorization: Bearer " . API_TOKEN . "\r\n",
            'method'  => 'GET',
        ],
    ];
    $context  = stream_context_create($options);
    $result = file_get_contents(API_URL . 'status?cpf=' . urlencode($cpf), false, $context);

    echo $result;
}
?>