<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\controllers\EbookController;
use App\repositories\EbookRepository;

$pdo = \App\config\Conexao::conectar();
$repoEbook = new EbookRepository($pdo);
$controllerEbook = new EbookController($repoEbook);

$mensagem = '';

try {
    $ebooks = $controllerEbook->listarEbooks();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao listar e-books: " . htmlspecialchars($e->getMessage()) . "</p>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if (!$id) {
        $mensagem = "<p class='error'>ID inválido.</p>";
    } else {
        try {
            if ($controllerEbook->excluirEbook((int)$id)) {
                $mensagem = "<p class='success'>E-book excluído com sucesso!</p>";
                $ebooks = $controllerEbook->listarEbooks();
            } else {
                $mensagem = "<p class='error'>Erro ao excluir e-book.</p>";
            }
        } catch (Exception $e) {
            $mensagem = "<p class='error'>Erro ao excluir e-book: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir E-book</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Excluir E-book</h1>
    </header>

    <main class="form-container">
        <?= $mensagem ?>

        <form method="POST" class="form">
            <label for="id">Selecione o E-book para excluir:</label>
            <select name="id" id="id" required>
                <?php foreach ($ebooks as $ebook): ?>
                    <option value="<?= htmlspecialchars($ebook['id']) ?>"><?= htmlspecialchars($ebook['titulo']) ?></option>
                <?php endforeach; ?>
            </select>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Excluir E-book</button>
                <a href="../../index.html" class="btn-secondary">Voltar ao Menu</a>
            </div>
        </form>

        <br>
        <h3>Lista de E-books Disponíveis:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ebooks as $ebook): ?>
                    <tr>
                        <td><?= htmlspecialchars($ebook['id']) ?></td>
                        <td><?= htmlspecialchars($ebook['titulo']) ?></td>
                        <td><?= htmlspecialchars($ebook['autor']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>