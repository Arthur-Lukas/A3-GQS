<?php
include_once '../controllers/EbookController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $lancamento = $_POST['lancamento'];
    $paginas = $_POST['paginas'];
    $id_genero = $_POST['id_genero'];

    EbookController::editarEbook($id, $titulo, $autor, $lancamento, $paginas, $id_genero);
    echo "<p>E-book atualizado com sucesso!</p>";
}

// Obter o e-book atual para preencher o formulário
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $ebooks = EbookController::listarEbooks();
    $ebook = null;
    foreach ($ebooks as $item) {
        if ($item['id'] == $id) {
            $ebook = $item;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar E-book</title>
</head>
<body>
    <h1>Editar E-book</h1>
    <?php if ($ebook): ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $ebook['id'] ?>">

            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?= $ebook['titulo'] ?>" required>

            <label for="autor">Autor:</label>
            <input type="text" name="autor" id="autor" value="<?= $ebook['autor'] ?>" required>

            <label for="lancamento">Ano de Lançamento:</label>
            <input type="number" name="lancamento" id="lancamento" value="<?= $ebook['lancamento'] ?>" required>

            <label for="paginas">Número de Páginas:</label>
            <input type="number" name="paginas" id="paginas" value="<?= $ebook['paginas'] ?>" required>

            <label for="id_genero">ID do Gênero:</label>
            <input type="number" name="id_genero" id="id_genero" value="<?= $ebook['id_genero'] ?>" required>

            <button type="submit">Atualizar</button>
        </form>
    <?php else: ?>
        <p>E-book não encontrado.</p>
    <?php endif; ?>
</body>
</html>