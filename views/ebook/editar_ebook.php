<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\controllers\EbookController;
use App\controllers\GeneroController;
use App\repositories\EbookRepository;
use App\repositories\GeneroRepository;

$pdo = \App\config\Conexao::conectar();

$repoGenero = new GeneroRepository($pdo);
$controllerGenero = new GeneroController($repoGenero);

$repoEbook = new EbookRepository($pdo);
$controllerEbook = new EbookController($repoEbook);

$mensagem = '';
$ebook = null;

try {
    $generos = $controllerGenero->listarGeneros();
    $ebooks = $controllerEbook->listarEbooks();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao carregar dados: " . htmlspecialchars($e->getMessage()) . "</p>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $lancamento = filter_var($_POST['lancamento'] ?? '', FILTER_VALIDATE_INT);
    $paginas = filter_var($_POST['paginas'] ?? '', FILTER_VALIDATE_INT);
    $id_genero = filter_var($_POST['id_genero'] ?? '', FILTER_VALIDATE_INT);

    if (!$titulo || !$autor || !$lancamento || !$paginas || !$id_genero) {
        $mensagem = "<p class='error'>Todos os campos são obrigatórios!</p>";
    } else {
        try {
            $controllerEbook->editarEbook($id, $titulo, $autor, $lancamento, $paginas, $id_genero);
            $mensagem = "<p class='success'>E-book atualizado com sucesso!</p>";
            $ebook = $controllerEbook->obterEbookPorId($id);
            $ebooks = $controllerEbook->listarEbooks();
        } catch (Exception $e) {
            $mensagem = "<p class='error'>Erro ao atualizar e-book: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
} elseif (isset($_GET['id'])) {
    try {
        $ebook = $controllerEbook->obterEbookPorId(filter_var($_GET['id'], FILTER_VALIDATE_INT));
    } catch (Exception $e) {
        $mensagem = "<p class='error'>Erro ao carregar o e-book: " . htmlspecialchars($e->getMessage()) . "</p>";
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

    <main>
        <?= $mensagem ?>

        <!-- Formulário de edição acima da lista -->
        <?php if ($ebook): ?>
            <section class="form-container">
                <h3>Editar E-book</h3>
                <form method="POST" class="form">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($ebook['id']) ?>">
                    <label for="titulo">Título:</label>
                    <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($ebook['titulo']) ?>" required>
                    <label for="autor">Autor:</label>
                    <input type="text" name="autor" id="autor" value="<?= htmlspecialchars($ebook['autor']) ?>" required>
                    <label for="lancamento">Ano de Lançamento:</label>
                    <input type="number" name="lancamento" id="lancamento" value="<?= htmlspecialchars($ebook['lancamento']) ?>" required min="1">
                    <label for="paginas">Número de Páginas:</label>
                    <input type="number" name="paginas" id="paginas" value="<?= htmlspecialchars($ebook['paginas']) ?>" required min="1">
                    <label for="id_genero">Gênero:</label>
                    <select name="id_genero" id="id_genero" required>
                        <?php foreach ($generos as $genero): ?>
                            <option value="<?= htmlspecialchars($genero['id']) ?>" <?= ($ebook['id_genero'] == $genero['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($genero['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn-primary">Atualizar E-book</button>
                    <a href="../../index.html" class="btn-secondary">Voltar ao Menu</a>
                </form>
            </section>
        <?php endif; ?>

        <!-- Lista de E-books -->
        <section class="list-container">
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
                                <td><a href="editar_ebook.php?id=<?= htmlspecialchars($ebookItem['id']) ?>" class="btn-primary">Editar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>