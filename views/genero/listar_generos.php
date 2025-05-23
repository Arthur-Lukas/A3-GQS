<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\controllers\GeneroController;

try {
    $generos = GeneroController::listarGeneros();
} catch (Exception $e) {
    $erro = "Erro ao listar gêneros: " . htmlspecialchars($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Gêneros</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Gêneros Cadastrados</h1>
    </header>

    <main class="list-container">
        <?php if (isset($erro)): ?>
            <p class="error"><?= $erro ?></p>
        <?php elseif (empty($generos)): ?>
            <p class="info">Nenhum gênero cadastrado.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($generos as $genero): ?>
                        <tr>
                            <td><?= htmlspecialchars($genero['id']) ?></td>
                            <td><?= htmlspecialchars($genero['nome']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="actions">
            <a href="../../index.html" class="btn-secondary">Voltar</a>
        </div>
    </main>
    
</body>
</html>