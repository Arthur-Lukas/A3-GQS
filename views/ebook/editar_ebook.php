<!-- filepath: c:\xampp\htdocs\ProjetoLimpo\views\editar_ebook.php -->
<?php
include_once '../src/controllers/EbookController.php';
include_once '../src/controllers/GeneroController.php';

$mensagem = '';
$ebooks = [];

try {
    // Buscar todos os e-books para exibição
    $ebooks = EbookController::listarEbooks();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao carregar e-books: " . htmlspecialchars($e->getMessage()) . "</p>";
}

// Buscar e-book pelo ID passado via GET
$ebook = null;
if (isset($_GET['id'])) {
    try {
        $ebook = EbookController::buscarPorId($_GET['id']);
    } catch (Exception $e) {
        $mensagem = "<p class='error'>Erro ao carregar o e-book: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Processar atualização do e-book
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $lancamento = $_POST['lancamento'] ?? '';
    $paginas = $_POST['paginas'] ?? '';
    $id_genero = $_POST['id_genero'] ?? '';

    if ($id && $titulo && $autor && $lancamento && $paginas && $id_genero) {
        try {
            EbookController::editarEbook($id, $titulo, $autor, $lancamento, $paginas, $id_genero);
            $mensagem = "<p class='success'>E-book atualizado com sucesso!</p>";
            // Atualizar a lista de e-books após edição
            $ebooks = EbookController::listarEbooks();
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
    <link rel="stylesheet" href="../assets/css/styles.css">
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
                <input type="number" name="lancamento" id="lancamento" value="<?= htmlspecialchars($ebook['lancamento']) ?>" required>

                <label for="paginas">Número de Páginas:</label>
                <input type="number" name="paginas" id="paginas" value="<?= htmlspecialchars($ebook['paginas']) ?>" required>

                <label for="id_genero">ID do Gênero:</label>
                <input type="number" name="id_genero" id="id_genero" value="<?= htmlspecialchars($ebook['id_genero']) ?>" required>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Atualizar E-book</button>
                    <a href="../index.html" class="btn-secondary">Voltar ao Menu</a>
                </div>
            </form>
        <?php endif; ?>

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
                        <th>Ações</th>
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
                            <td>
                                <a href="editar_ebook.php?id=<?= htmlspecialchars($ebook['id']) ?>" class="btn-primary">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="actions">
            <a href="../index.html" class="btn-secondary">Voltar ao Menu</a>
        </div>
    </main>
</body>
</html>