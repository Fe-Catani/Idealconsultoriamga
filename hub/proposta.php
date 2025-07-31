<?php
// Página para envio da proposta
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de Proposta</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Envio de Proposta</h1>
    <form action="api/proposta.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>
        <label for="valor">Valor:</label>
        <input type="number" id="valor" name="valor" required>
        <button type="submit">Enviar Proposta</button>
    </form>
</body>
</html>