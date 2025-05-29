<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\controllers\GeneroController;
use App\controllers\LivroFisicoController;
use App\config\Conexao;

$pdo = Conexao::conectar();
$repoGenero = new \App\repositories\GeneroRepository($pdo);
$repoLivroFisico = new \App\repositories\LivroFisicoRepository($pdo);

$controllerGenero = new GeneroController($repoGenero);
$controllerLivroFisico = new LivroFisicoController($repoLivroFisico);

$mensagem = '';
$livros = [];
$generos = [];
$livro = null;

try {
    $generos = $controllerGenero->listarGeneros();
    $livros = $controllerLivroFisico->listarLivrosFisicos();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao carregar dados: " . htmlspecialchars($e->getMessage()) . "</p>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $lancamento = filter_var($_POST['lancamento'], FILTER_VALIDATE_INT);
    $preco = filter_var($_POST['preco'], FILTER_VALIDATE_FLOAT);
    $id_genero = filter_var($_POST['id_genero'], FILTER_VALIDATE_INT);

    if (!$id || !$titulo || !$autor || !$lancamento || !$preco || !$id_genero) {
        $mensagem = "<p class='error'>Todos os campos são obrigatórios!</p>";
    } elseif ($lancamento <= 0 || $preco <= 0) {
        $mensagem = "<p class='error'>Ano de lançamento e preço devem ser positivos!</p>";
    } else {
        try {
            $resultado = $controllerLivroFisico->editarLivroFisico($id, $titulo, $autor, $lancamento, $preco, $id_genero);

            if ($resultado === true) {
                $mensagem = "<p class='success'>Livro atualizado com sucesso!</p>";
                $livros = $controllerLivroFisico->listarLivrosFisicos();
                $livro = $controllerLivroFisico->buscarPorId($id);
            } else {
                $mensagem = "<p class='error'>Erro ao atualizar livro: " . htmlspecialchars($resultado['error'] ?? 'Erro desconhecido') . "</p>";
            }
        } catch (Exception $e) {
            $mensagem = "<p class='error'>Erro ao atualizar livro: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
}

if (isset($_GET['id'])) {
    try {
        $livro = $controllerLivroFisico->buscarPorId(filter_var($_GET['id'], FILTER_VALIDATE_INT));
    } catch (Exception $e) {
        $mensagem = "<p class='error'>Erro ao carregar o livro: " . htmlspecialchars($e->getMessage()) . "</p>";
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
                <input type="number" name="lancamento" id="lancamento" value="<?= htmlspecialchars($livro['lancamento']) ?>" required min="1">

                <label for="preco">Preço:</label>
                <input type="number" name="preco" id="preco" value="<?= htmlspecialchars($livro['preco']) ?>" required min="0.01" step="0.01">

                <label for="id_genero">Gênero:</label>
                <select name="id_genero" id="id_genero" required>
                    <?php foreach ($generos as $genero): ?>
                        <option value="<?= htmlspecialchars($genero['id']) ?>" <?= ($livro['id_genero'] == $genero['id']) ? 'selected' : '' ?>>
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
    </div>
</body>
</html>