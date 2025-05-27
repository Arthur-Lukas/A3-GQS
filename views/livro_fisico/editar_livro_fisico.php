<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\controllers\GeneroController;
use App\controllers\LivroFisicoController;

$mensagem = '';
$livros = [];
$generos = [];

try {
    $generos = GeneroController::listarGeneros();
    $livros = LivroFisicoController::listarLivrosFisicos();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao carregar dados: " . htmlspecialchars($e->getMessage()) . "</p>";
}

$livro = null;
if (isset($_GET['id'])) {
    try {
        $livro = LivroFisicoController::buscarPorId($_GET['id']);
    } catch (Exception $e) {
        $mensagem = "<p class='error'>Erro ao carregar o livro: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $lancamento = trim($_POST['lancamento'] ?? '');
    $preco = trim($_POST['preco'] ?? '');
    $id_genero = $_POST['id_genero'] ?? '';

    // Validação dos campos numéricos
    if (
        !ctype_digit($lancamento) || (int)$lancamento <= 0 ||
        !is_numeric($preco) || $preco <= 0
    ) {
        $mensagem = "<p class='error'>Ano de lançamento deve ser inteiro positivo e preço deve ser um número positivo!</p>";
    } elseif ($id && $titulo && $autor && $lancamento && $preco && $id_genero) {
        try {
            LivroFisicoController::editarLivroFisico($id, $titulo, $autor, $lancamento, $preco, $id_genero);
            $mensagem = "<p class='success'>Livro atualizado com sucesso!</p>";
            $livros = LivroFisicoController::listarLivrosFisicos();
            $livro = LivroFisicoController::buscarPorId($id);
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
                <input type="text" name="lancamento" id="lancamento" value="<?= htmlspecialchars($livro['lancamento']) ?>" required>

                <label for="preco">Preço:</label>
                <input type="text" name="preco" id="preco" value="<?= htmlspecialchars($livro['preco']) ?>" required>

                <label for="id_genero">Gênero:</label>
                <select name="id_genero" id="id_genero" required>
                    <option value="">Selecione o gênero</option>
                    <?php foreach ($generos as $genero): ?>
                        <option value="<?= htmlspecialchars($genero['id']) ?>"
                            <?= ($livro['id_genero'] == $genero['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($genero['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Atualizar Livro</button>
                    <a href="../../index.html" class="btn-secondary">Voltar ao Menu</a>
                </div>
            </form>
        <?php endif; ?>
    </main>

    <div class="list-container">
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
                        <th>Gênero</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livros as $livroItem): ?>
                        <tr>
                            <td><?= htmlspecialchars($livroItem['id']) ?></td>
                            <td><?= htmlspecialchars($livroItem['titulo']) ?></td>
                            <td><?= htmlspecialchars($livroItem['autor']) ?></td>
                            <td><?= htmlspecialchars($livroItem['lancamento']) ?></td>
                            <td><?= htmlspecialchars($livroItem['preco']) ?></td>
                            <td><?= htmlspecialchars($livroItem['nome_genero'] ?? '') ?></td>
                            <td>
                                <a href="editar_livro_fisico.php?id=<?= htmlspecialchars($livroItem['id']) ?>" class="btn-primary">Editar</a>
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