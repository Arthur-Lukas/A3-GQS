<?php
include_once __DIR__ . '/../src/config/Conexao.php';
include_once __DIR__ . '/../src/controllers/LivroFisicoController.php';

// Buscar todos os livros físicos para exibição
$livros = LivroFisicoController::listarLivrosFisicos();
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        // Verificar se o livro existe
        $livroExiste = LivroFisicoController::buscarPorId($id);

        if (!$livroExiste || isset($livroExiste['error'])) {
            $mensagem = "<p style='color: red;'>ID inválido! O livro físico não existe no banco de dados.</p>";
        } else {
            $resultado = LivroFisicoController::excluirLivroFisico($id);

            if (is_array($resultado) && isset($resultado['error'])) {
                $mensagem = "<p style='color: red;'>Erro: " . $resultado['error'] . "</p>";
            } else {
                $mensagem = "<p style='color: green;'>Livro físico excluído com sucesso!</p>";
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
    <title>Excluir Livro Físico</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Excluir Livro Físico</h2>
        <?= $mensagem ?>

        <form method="post">
            <label for="id">Digite o ID do livro físico para excluir:</label>
            <input type="number" name="id" required>
            <button type="submit">Excluir Livro</button>
        </form>

        <h3>Lista de Livros Físicos Disponíveis:</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
            </tr>
            <?php foreach ($livros as $livro): ?>
                <tr>
                    <td><?= $livro['id'] ?></td>
                    <td><?= $livro['titulo'] ?></td>
                    <td><?= $livro['autor'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <a href="listar_livros_fisicos.php" class="btn-voltar">Voltar para Lista</a>
    </div>
</body>
</html>