<?php
include_once '../controllers/GeneroController.php';
$generos = GeneroController::listarGeneros();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Listar Gêneros</title>
</head>
<body>
    <h1>Gêneros Cadastrados</h1>
    <ul>
        <?php foreach ($generos as $genero): ?>
            <li><?= $genero['id'] ?> - <?= $genero['nome'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>