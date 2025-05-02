<!-- filepath: c:\xampp\htdocs\ProjetoLimpo\views\cadastrar_genero.php -->
<?php
include_once '../src/controllers/GeneroController.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);

    if (empty($nome)) {
        $mensagem = "<p class='error'>O nome do gênero é obrigatório!</p>";
    } else {
        try {
            GeneroController::cadastrarGenero($nome);
            $mensagem = "<p class='success'>Gênero cadastrado com sucesso!</p>";
        } catch (Exception $e) {
            $mensagem = "<p class='error'>Erro ao cadastrar gênero: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Gênero</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Cadastrar Gênero</h1>
    </header>

    <main class="form-container">
        <?php echo $mensagem; ?>
        <form method="POST" class="form">
            <label for="nome">Nome do Gênero:</label>
            <input type="text" name="nome" id="nome" aria-label="Nome do Gênero" required>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Cadastrar</button>
                <a href="../index.html" class="btn-secondary">Voltar</a>
                <a href="listar_generos.php" class="btn-secondary">Lista de Gêneros</a>
            </div>
        </form>
    </main>


</body>
</html>