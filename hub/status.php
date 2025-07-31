<?php
// Consulta do status da solicitação
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status da Solicitação</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Status da Solicitação</h1>
    <form action="api/status.php" method="GET">
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>
        <button type="submit">Consultar</button>
    </form>
</body>
</html>