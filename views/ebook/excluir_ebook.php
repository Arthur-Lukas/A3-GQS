<!-- filepath: c:\xampp\htdocs\ProjetoLimpo\views\excluir_ebook.php -->
<?php
include_once '../src/controllers/EbookController.php';

$mensagem = '';

try {
    // Buscar todos os e-books para exibição
    $ebooks = EbookController::listarEbooks();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao listar e-books: " . htmlspecialchars($e->getMessage()) . "</p>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        try {
            EbookController::excluirEbook($id);
            $mensagem = "<p class='success'>E-book excluído com sucesso!</p>";
            // Atualizar a lista de e-books após exclusão
            $ebooks = EbookController::listarEbooks();
        } catch (Exception $e) {
            $mensagem = "<p class='error'>Erro ao excluir e-book: " . htmlspecialchars($e->getMessage()) . "</p>";
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
    <title>Excluir E-book</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Excluir E-book</h1>
    </header>

    <main class="form-container">
        <?= $mensagem ?>

        <form method="POST" class="form">
            <label for="id">Selecione o E-book para excluir:</label>
            <select name="id" id="id" required>
                <?php if (!empty($ebooks)): ?>
                    <?php foreach ($ebooks as $ebook): ?>
                        <option value="<?= htmlspecialchars($ebook['id']) ?>"><?= htmlspecialchars($ebook['titulo']) ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="" disabled>Nenhum e-book disponível</option>
                <?php endif; ?>
            </select>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Excluir E-book</button>
                <a href="../index.html" class="btn-secondary">Voltar ao Menu</a>
            </div>
        </form>

        <h3>Lista de E-books Disponíveis:</h3>
        <?php if (empty($ebooks)): ?>
            <p class="info">Nenhum e-book cadastrado.</p>
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
                    <?php foreach ($ebooks as $ebook): ?>
                        <tr>
                            <td><?= htmlspecialchars($ebook['id']) ?></td>
                            <td><?= htmlspecialchars($ebook['titulo']) ?></td>
                            <td><?= htmlspecialchars($ebook['autor']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>


</body>
</html>