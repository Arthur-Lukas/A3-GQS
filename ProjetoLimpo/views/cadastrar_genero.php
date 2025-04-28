<?php
include_once __DIR__ . '/../src/controllers/GeneroController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    GeneroController::cadastrarGenero($nome);
    echo "<p>Gênero cadastrado com sucesso!</p>";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Gênero</title>
</head>
<body>
    <form method="POST">
        <label for="nome">Nome do Gênero:</label>
        <input type="text" name="nome" id="nome" required>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>