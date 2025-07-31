<?php
$host = "144.217.196.195";          // Host do seu servidor MySQL
$dbname = "idealco1_site";    // Nome do banco de dados
$user = "idealco1_admin";     // Usu���rio do banco de dados
$pass = "nC?LBx(Qitp0";       // Senha do banco de dados

// Criando a conex���o com o banco de dados
$conn = new mysqli($host, $user, $pass, $dbname);

// Checando se houve erro na conex���o
if ($conn->connect_error) {
    die("Conex���o falhou: " . $conn->connect_error);
}
?>