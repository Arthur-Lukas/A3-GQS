<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\controllers\GeneroController;
use App\controllers\EbookController;

$mensagem = '';
$ebooks = [];
$generos = [];

try {
    $generos = GeneroController::listarGeneros();
    $ebooks = EbookController::listarEbooks();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao carregar dados: " . htmlspecialchars($e->getMessage()) . "</p>";
}

$ebook = null;
if (isset($_GET['id'])) {
    try {
        $ebook = EbookController::buscarPorId($_GET['id']);
    } catch (Exception $e) {
        $mensagem = "<p class='error'>Erro ao carregar o e-book: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $lancamento = trim($_POST['lancamento'] ?? '');
    $paginas = trim($_POST['paginas'] ?? '');
    $id_genero = $_POST['id_genero'] ?? '';

    // Validação dos campos numéricos
    if (
        !ctype_digit($lancamento) || (int)$lancamento <= 0 ||
        !ctype_digit($paginas) || (int)$paginas <= 0
    ) {
        $mensagem = "<p class='error'>Ano de lançamento e número de páginas devem ser números inteiros positivos!</p>";
    } elseif ($id && $titulo && $autor && $lancamento && $paginas && $id_genero) {
        try {
            EbookController::editarEbook($id, $titulo, $autor, $lancamento, $paginas, $id_genero);
            $mensagem = "<p class='success'>E-book atualizado com sucesso!</p>";
            $ebooks = EbookController::listarEbooks();
            $ebook = EbookController::buscarPorId($id);
        } catch (Exception $e) {
            $mensagem = "<p class='error'>Erro ao atualizar o e-book: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        $mensagem = "<p class='error'>Todos os campos são obrigatórios.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar E-book</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Editar E-book</h1>
    </header>

    <main class="form-container">
        <?= $mensagem ?>

        <?php if ($ebook): ?>
            <form method="POST" class="form">
                <input type="hidden" name="id" value="<?= htmlspecialchars($ebook['id']) ?>">

                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($ebook['titulo']) ?>" required>

                <label for="autor">Autor:</label>
                <input type="text" name="autor" id="autor" value="<?= htmlspecialchars($ebook['autor']) ?>" required>

                <label for="lancamento">Ano de Lançamento:</label>
                <input type="text" name="lancamento" id="lancamento" value="<?= htmlspecialchars($ebook['lancamento']) ?>" required>

                <label for="paginas">Número de Páginas:</label>
                <input type="text" name="paginas" id="paginas" value="<?= htmlspecialchars($ebook['paginas']) ?>" required>

                <label for="id_genero">Gênero:</label>
                <select name="id_genero" id="id_genero" required>
                    <option value="">Selecione o gênero</option>
                    <?php foreach ($generos as $genero): ?>
                        <option value="<?= htmlspecialchars($genero['id']) ?>"
                            <?= ($ebook['id_genero'] == $genero['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($genero['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Atualizar E-book</button>
                    <a href="../../index.html" class="btn-secondary">Voltar ao Menu</a>
                </div>
            </form>
        <?php endif; ?>
    </main>

    <div class="list-container">
        <h3>Lista de E-books Cadastrados</h3>
        <?php if (empty($ebooks)): ?>
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
                        <th>Gênero</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ebooks as $ebookItem): ?>
                        <tr>
                            <td><?= htmlspecialchars($ebookItem['id']) ?></td>
                            <td><?= htmlspecialchars($ebookItem['titulo']) ?></td>
                            <td><?= htmlspecialchars($ebookItem['autor']) ?></td>
                            <td><?= htmlspecialchars($ebookItem['lancamento']) ?></td>
                            <td><?= htmlspecialchars($ebookItem['paginas']) ?></td>
                            <td><?= htmlspecialchars($ebookItem['nome_genero'] ?? '') ?></td>
                            <td>
                                <a href="editar_ebook.php?id=<?= htmlspecialchars($ebookItem['id']) ?>" class="btn-primary">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <div class="actions">
            <a href="../../index.html" class="btn-secondary">Voltar ao Menu</a>
        </div>
    </div>
</body>
</html>