<?php
// Código que chama a API de simulação
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valor = $_POST['valor'];
    $prazo = $_POST['prazo'];

    $data = ['valor' => $valor, 'prazo' => $prazo];
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n" .
                         "Authorization: Bearer " . API_TOKEN . "\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];
    $context  = stream_context_create($options);
    $result = file_get_contents(API_URL . 'simulacao', false, $context);

    echo $result;
}
?>