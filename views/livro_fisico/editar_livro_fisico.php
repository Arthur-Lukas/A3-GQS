<!-- filepath: c:\xampp\htdocs\ProjetoLimpo\views\editar_livro_fisico.php -->
<?php
include_once '../../src/controllers/LivroFisicoController.php';
include_once '../../src/controllers/GeneroController.php';

$mensagem = '';
$livros = [];

try {
    // Buscar todos os livros físicos para exibição
    $livros = LivroFisicoController::listarLivrosFisicos();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao carregar livros: " . htmlspecialchars($e->getMessage()) . "</p>";
}

// Buscar livro pelo ID passado via GET
$livro = null;
if (isset($_GET['id'])) {
    try {
        $livro = LivroFisicoController::buscarPorId($_GET['id']);
    } catch (Exception $e) {
        $mensagem = "<p class='error'>Erro ao carregar o livro: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// Processar atualização do livro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $lancamento = $_POST['lancamento'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $id_genero = $_POST['id_genero'] ?? '';

    if ($id && $titulo && $autor && $lancamento && $preco && $id_genero) {
        try {
            LivroFisicoController::editarLivroFisico($id, $titulo, $autor, $lancamento, $preco, $id_genero);
            $mensagem = "<p class='success'>Livro atualizado com sucesso!</p>";
            // Atualizar a lista de livros após edição
            $livros = LivroFisicoController::listarLivrosFisicos();
        } catch (Exception $e) {
            $mensagem = "<p class='error'>Erro ao atualizar o livro: " . htmlspecialchars($e->getMessage()) . "</p>";
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
    <title>Editar Livro Físico</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Editar Livro Físico</h1>
    </header>

    <main class="form-container">
        <?= $mensagem ?>

        <?php if ($livro): ?>
            <form method="POST" class="form">
                <input type="hidden" name="id" value="<?= htmlspecialchars($livro['id']) ?>">

                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($livro['titulo']) ?>" required>

                <label for="autor">Autor:</label>
                <input type="text" name="autor" id="autor" value="<?= htmlspecialchars($livro['autor']) ?>" required>

                <label for="lancamento">Ano de Lançamento:</label>
                <input type="number" name="lancamento" id="lancamento" value="<?= htmlspecialchars($livro['lancamento']) ?>" required>

                <label for="preco">Preço:</label>
                <input type="number" name="preco" id="preco" step="0.01" value="<?= htmlspecialchars($livro['preco']) ?>" required>

                <label for="id_genero">Gênero:</label>
                <input type="number" name="id_genero" id="id_genero" value="<?= htmlspecialchars($livro['id_genero']) ?>" required>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Atualizar Livro</button>
                    <a href="../../index.html" class="btn-secondary">Voltar ao Menu</a>
                </div>
            </form>
        <?php endif; ?>

        <h3>Lista de Livros Físicos Cadastrados</h3>
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
                        <th>Ações</th>
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
                            <td>
                                <a href="editar_livro_fisico.php?id=<?= htmlspecialchars($livro['id']) ?>" class="btn-primary">Editar</a>
                            </td>
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