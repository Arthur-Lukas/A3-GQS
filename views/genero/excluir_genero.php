<!-- filepath: c:\xampp\htdocs\ProjetoLimpo\views\excluir_genero.php -->
<?php
include_once __DIR__ . '/../src/config/Conexao.php';
include_once __DIR__ . '/../src/controllers/GeneroController.php';
include_once __DIR__ . '/../src/controllers/LivroFisicoController.php';

$mensagem = '';

try {
    // Buscar todos os gêneros para exibição
    $generos = GeneroController::listarGeneros();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao listar gêneros: " . htmlspecialchars($e->getMessage()) . "</p>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        try {
            // Verificar se há livros associados ao gênero
            $livrosRelacionados = LivroFisicoController::verificarLivrosPorGenero($id);

            if ($livrosRelacionados > 0) {
                $mensagem = "<p class='error'>Não é possível excluir. Há livros associados a este gênero!</p>";
            } else {
                GeneroController::excluirGenero($id);
                $mensagem = "<p class='success'>Gênero excluído com sucesso!</p>";
                // Atualizar a lista de gêneros após exclusão
                $generos = GeneroController::listarGeneros();
            }
        } catch (Exception $e) {
            $mensagem = "<p class='error'>Erro ao excluir gênero: " . htmlspecialchars($e->getMessage()) . "</p>";
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
    <title>Excluir Gênero</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
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
                <a href="../index.html" class="btn-secondary">Voltar ao Menu</a>
            </div>
        </form>

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