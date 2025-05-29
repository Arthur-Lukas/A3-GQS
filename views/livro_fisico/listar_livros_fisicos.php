<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\controllers\LivroFisicoController;
use App\config\Conexao;

$pdo = Conexao::conectar();
$repoLivroFisico = new \App\repositories\LivroFisicoRepository($pdo);
$controllerLivroFisico = new LivroFisicoController($repoLivroFisico);

$mensagem = '';
$livros = [];

try {
    // Buscar todos os livros físicos para exibição
    $livros = $controllerLivroFisico->listarLivrosFisicos();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao listar livros físicos: " . htmlspecialchars($e->getMessage()) . "</p>";
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
        <?= $mensagem ?>

        <?php if (empty($livros)): ?>
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
                            <td><?= htmlspecialchars(number_format($livro['preco'], 2, ',', '.')) ?></td>
                            <td><?= htmlspecialchars($livro['nome_genero'] ?? '') ?></td>
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