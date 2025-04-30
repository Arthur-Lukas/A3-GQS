<?php
include_once __DIR__ . '/../src/config/Conexao.php';
include_once __DIR__ . '/../src/controllers/GeneroController.php';
include_once __DIR__ . '/../src/controllers/LivroFisicoController.php';

// Buscar todos os gêneros para exibição
$generos = GeneroController::listarGeneros();
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        // Verificar se há livros associados ao gênero
        $livrosRelacionados = LivroFisicoController::verificarLivrosPorGenero($id);

        if ($livrosRelacionados > 0) {
            $mensagem = "<p style='color: red;'>ID não permitido, pois há um livro associado a este gênero!</p>";
        } else {
            $resultado = GeneroController::excluirGenero($id);

            if (is_array($resultado) && isset($resultado['error'])) {
                $mensagem = "<p style='color: red;'>Erro: " . $resultado['error'] . "</p>";
            } else {
                $mensagem = "<p style='color: green;'>Gênero excluído com sucesso!</p>";
            }
        }
    } else {
        $mensagem = "<p style='color: red;'>ID inválido.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Excluir Gênero</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Excluir Gênero</h2>
        <?= $mensagem ?>

        <form method="post">
            <label for="id">Digite o ID do gênero para excluir:</label>
            <input type="number" name="id" required>
            <button type="submit">Excluir Gênero</button>
        </form>

        <h3>Lista de Gêneros Disponíveis:</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
            <?php foreach ($generos as $genero): ?>
                <tr>
                    <td><?= $genero['id'] ?></td>
                    <td><?= $genero['nome'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <a href="listar_generos.php" class="btn-voltar">Voltar para Lista</a>
    </div>
</body>
</html>