<?php
// Página para simulação de FGTS
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulação FGTS</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Simulação de FGTS</h1>
    <form action="api/simulacao.php" method="POST">
        <label for="valor">Valor:</label>
        <input type="number" id="valor" name="valor" required>
        <label for="prazo">Prazo (meses):</label>
        <input type="number" id="prazo" name="prazo" required>
        <button type="submit">Simular</button>
    </form>
</body>
</html>