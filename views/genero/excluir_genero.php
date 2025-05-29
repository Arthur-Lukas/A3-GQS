<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\controllers\GeneroController;
use App\controllers\LivroFisicoController;
use App\repositories\GeneroRepository;
use App\config\Conexao;

$pdo = Conexao::conectar();
$repoGenero = new GeneroRepository($pdo);
$controllerGenero = new GeneroController($repoGenero);
$repoLivroFisico = new \App\repositories\LivroFisicoRepository($pdo);
$controllerLivroFisico = new LivroFisicoController($repoLivroFisico);

$mensagem = '';

try {
    // Buscar todos os gêneros para exibição
    $generos = $controllerGenero->listarGeneros();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao listar gêneros: " . htmlspecialchars($e->getMessage()) . "</p>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

    if (!$id) {
        $mensagem = "<p class='error'>ID inválido. Digite um número válido.</p>";
    } else {
        try {
            // Verificar se o gênero existe
            $generoExiste = false;
            foreach ($generos as $genero) {
                if ($genero['id'] == $id) {
                    $generoExiste = true;
                    break;
                }
            }

            if (!$generoExiste) {
                $mensagem = "<p class='error'>Gênero não encontrado. Digite uma opção válida.</p>";
            } else {
                // Verificar se há livros associados ao gênero
                $livrosRelacionados = $controllerLivroFisico->verificarLivrosPorGenero($id);

                if ($livrosRelacionados > 0) {
                    $mensagem = "<p class='error'>Não é possível excluir. Há livros associados a este gênero!</p>";
                } else {
                    $resultado = $controllerGenero->excluirGenero($id);
                    if ($resultado === true) {
                        $mensagem = "<p class='success'>Gênero excluído com sucesso!</p>";
                        $generos = $controllerGenero->listarGeneros(); // Atualiza a lista de gêneros
                    } else {
                        $mensagem = "<p class='error'>Erro ao excluir gênero.</p>";
                    }
                }
            }
        } catch (Exception $e) {
            $mensagem = "<p class='error'>Erro ao excluir gênero: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Gênero</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Excluir Gênero</h1>
    </header>

    <main class="form-container">
        <?= $mensagem ?>

        <form method="POST" class="form">
            <label for="id">Digite o ID do gênero para excluir:</label>
            <input type="number" name="id" id="id" aria-label="ID do Gênero" required>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Excluir Gênero</button>
                <a href="../../index.html" class="btn-secondary">Voltar ao Menu</a>
            </div>
        </form>
        <br>
        <h3>Lista de Gêneros Disponíveis:</h3>
        <?php if (empty($generos)): ?>
            <p class="info">Nenhum gênero cadastrado.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($generos as $genero): ?>
                        <tr>
                            <td><?= htmlspecialchars($genero['id']) ?></td>
                            <td><?= htmlspecialchars($genero['nome']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>