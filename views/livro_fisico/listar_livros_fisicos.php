<?php
include_once '../../src/controllers/LivroFisicoController.php';

try {
    $livros = LivroFisicoController::listarLivrosFisicos();
} catch (Exception $e) {
    $erro = "Erro ao listar livros físicos: " . htmlspecialchars($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Livros Físicos</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Livros Físicos Cadastrados</h1>
    </header>

    <main class="list-container">
        <?php if (isset($erro)): ?>
            <p class="error"><?= $erro ?></p>
        <?php elseif (empty($livros)): ?>
            <p class="info">Nenhum livro físico cadastrado.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano de Lançamento</th>
                        <th>Preço</th>
                        <th>Gênero</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livros as $livro): ?>
                        <tr>
                            <td><?= htmlspecialchars($livro['id']) ?></td>
                            <td><?= htmlspecialchars($livro['titulo']) ?></td>
                            <td><?= htmlspecialchars($livro['autor']) ?></td>
                            <td><?= htmlspecialchars($livro['lancamento']) ?></td>
                            <td><?= htmlspecialchars($livro['preco']) ?></td>
                            <td><?= htmlspecialchars($livro['nome_genero']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="actions">
            <a href="../../index.html" class="btn-secondary">Voltar ao Menu</a>
        </div>
    </main>
</body>
</html>