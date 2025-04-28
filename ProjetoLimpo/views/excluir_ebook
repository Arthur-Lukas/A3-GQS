<?php
include_once '../controllers/EbookController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    EbookController::excluirEbook($id);
    echo "<p>E-book excluído com sucesso!</p>";
}

// Listar e-books para seleção
$ebooks = EbookController::listarEbooks();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Excluir E-book</title>
</head>
<body>
    <h1>Excluir E-book</h1>
    <form method="POST">
        <label for="id">Selecione o E-book para excluir:</label>
        <select name="id" id="id" required>
            <?php foreach ($ebooks as $ebook): ?>
                <option value="<?= $ebook['id'] ?>"><?= $ebook['titulo'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Excluir</button>
    </form>
</body>
</html>