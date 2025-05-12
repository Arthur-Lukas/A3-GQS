<!-- filepath: c:\xampp\htdocs\ProjetoLimpo\views\listar_ebooks.php -->
<?php
include_once '../../src/controllers/EbookController.php';

try {
    $ebooks = EbookController::listarEbooks();
} catch (Exception $e) {
    $erro = "Erro ao listar e-books: " . htmlspecialchars($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar E-books</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>E-books Cadastrados</h1>
    </header>

    <main class="list-container">
        <?php if (isset($erro)): ?>
            <p class="error"><?= $erro ?></p>
        <?php elseif (empty($ebooks)): ?>
            <p class="info">Nenhum e-book cadastrado.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano de Lançamento</th>
                        <th>Número de Páginas</th>
                        <th>ID do Gênero</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ebooks as $ebook): ?>
                        <tr>
                            <td><?= htmlspecialchars($ebook['id']) ?></td>
                            <td><?= htmlspecialchars($ebook['titulo']) ?></td>
                            <td><?= htmlspecialchars($ebook['autor']) ?></td>
                            <td><?= htmlspecialchars($ebook['lancamento']) ?></td>
                            <td><?= htmlspecialchars($ebook['paginas']) ?></td>
                            <td><?= htmlspecialchars($ebook['id_genero']) ?></td>
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