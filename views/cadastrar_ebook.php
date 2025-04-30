<?php
include_once '../src/controllers/EbookController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $lancamento = $_POST['lancamento'];
    $paginas = $_POST['paginas'];
    $id_genero = $_POST['id_genero'];

    EbookController::cadastrarEbook($titulo, $autor, $lancamento, $paginas, $id_genero);
    echo "<p>E-book cadastrado com sucesso!</p>";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar E-book</title>
</head>
<body>
    <h1>Cadastrar Novo E-book</h1>
    <form method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required>

        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor" required>

        <label for="lancamento">Ano de Lançamento:</label>
        <input type="number" name="lancamento" id="lancamento" required>

        <label for="paginas">Número de Páginas:</label>
        <input type="number" name="paginas" id="paginas" required>

        <label for="id_genero">ID do Gênero:</label>
        <input type="number" name="id_genero" id="id_genero" required>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>