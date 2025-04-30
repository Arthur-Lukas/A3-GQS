<?php
include_once __DIR__ . '/../src/config/Conexao.php';
include_once __DIR__ . '/../src/controllers/LivroFisicoController.php';

// Buscar livro pelo ID passado via GET
$livro = null;
if (isset($_GET['id'])) {
    $livro = LivroFisicoController::buscarPorId($_GET['id']);
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
        LivroFisicoController::editarLivroFisico($id, $titulo, $autor, $lancamento, $preco, $id_genero);
        header("Location: listar_livros.php?mensagem=Livro atualizado com sucesso!");
        exit();
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro Físico</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <script defer src="../assets/scripts.js"></script>
</head>
<body>
    <div class="container">
        <h2>Editar Livro Físico</h2>

        <?php if (isset($erro)): ?>
            <p class="erro"><?= $erro ?></p>
        <?php endif; ?>

        <form method="post" id="formLivro">
            <input type="hidden" name="id" value="<?= $livro['id'] ?? '' ?>">

            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?= $livro['titulo'] ?? '' ?>" required>

            <label for="autor">Autor:</label>
            <input type="text" name="autor" id="autor" value="<?= $livro['autor'] ?? '' ?>" required>

            <label for="lancamento">Lançamento:</label>
            <input type="date" name="lancamento" id="lancamento" value="<?= $livro['lancamento'] ?? '' ?>" required>

            <label for="preco">Preço:</label>
            <input type="text" name="preco" id="preco" value="<?= $livro['preco'] ?? '' ?>" required>

            <label for="id_genero">Gênero:</label>
            <input type="number" name="id_genero" id="id_genero" value="<?= $livro['id_genero'] ?? '' ?>" required>

            <button type="submit">Atualizar Livro</button>
        </form>

        <a href="listar_livros_fisicos.php" class="btn-voltar">Voltar para Lista</a>
    </div>
</body>
</html>