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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

    if ($id) {
        try {
            $resultado = $controllerLivroFisico->excluirLivroFisico($id);
            
            if ($resultado === true) {
                $mensagem = "<p class='success'>Livro físico excluído com sucesso!</p>";
                $livros = $controllerLivroFisico->listarLivrosFisicos(); // Atualizar lista após exclusão
            } else {
                $mensagem = "<p class='error'>Erro ao excluir livro físico: " . htmlspecialchars($resultado['error'] ?? 'Erro desconhecido') . "</p>";
            }
        } catch (Exception $e) {
            $mensagem = "<p class='error'>Erro ao excluir livro físico: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        $mensagem = "<p class='error'>ID inválido.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Livro Físico</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Excluir Livro Físico</h1>
    </header>

    <main class="form-container">
        <?= $mensagem ?>

        <form method="POST" class="form">
            <label for="id">Selecione o Livro Físico para excluir:</label>
            <select name="id" id="id" required>
                <?php if (!empty($livros)): ?>
                    <?php foreach ($livros as $livro): ?>
                        <option value="<?= htmlspecialchars($livro['id']) ?>"><?= htmlspecialchars($livro['titulo']) ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="" disabled>Nenhum livro físico disponível</option>
                <?php endif; ?>
            </select>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Excluir Livro</button>
                <a href="../../index.html" class="btn-secondary">Voltar ao Menu</a>
            </div>
        </form>

        <h3>Lista de Livros Físicos Disponíveis:</h3>
        <?php if (empty($livros)): ?>
            <p class="info">Nenhum livro físico cadastrado.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livros as $livro): ?>
                        <tr>
                            <td><?= htmlspecialchars($livro['id']) ?></td>
                            <td><?= htmlspecialchars($livro['titulo']) ?></td>
                            <td><?= htmlspecialchars($livro['autor']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>