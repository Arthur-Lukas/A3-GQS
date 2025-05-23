<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\controllers\GeneroController;
use App\controllers\EbookController;

$mensagem = '';

try {
    // Buscar todos os gêneros para exibição no select
    $generos = GeneroController::listarGeneros();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao carregar gêneros: " . htmlspecialchars($e->getMessage()) . "</p>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $lancamento = $_POST['lancamento'];
    $paginas = $_POST['paginas'];
    $id_genero = $_POST['id_genero'];

    // Validação: autor só pode conter letras, espaços e caracteres especiais comuns de nomes
    if (!preg_match('/^[\p{L}\s\'\-\.]+$/u', $autor)) {
        $mensagem = "<p class='error'>O campo Autor deve conter apenas letras, espaços, apóstrofos, hífens e pontos!</p>";
    } elseif (empty($titulo) || empty($autor) || empty($lancamento) || empty($paginas) || empty($id_genero)) {
        $mensagem = "<p class='error'>Todos os campos são obrigatórios!</p>";
    } elseif ($lancamento <= 0 || $paginas <= 0) {
        $mensagem = "<p class='error'>Os números devem ser positivos!</p>";
    } else {
        try {
            EbookController::cadastrarEbook($titulo, $autor, $lancamento, $paginas, $id_genero);
            $mensagem = "<p class='success'>E-book cadastrado com sucesso!</p>";
        } catch (Exception $e) {
            $mensagem = "<p class='error'>Erro ao cadastrar e-book: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar E-book</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Cadastrar Novo E-book</h1>
    </header>

    <main class="form-container">
        <?= $mensagem ?>

        <form method="POST" class="form">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" required>

            <label for="autor">Autor:</label>
            <input type="text" name="autor" id="autor" required>

            <label for="lancamento">Ano de Lançamento:</label>
            <input type="number" name="lancamento" id="lancamento" required min="1">

            <label for="paginas">Número de Páginas:</label>
            <input type="number" name="paginas" id="paginas" required min="1">

            <label for="id_genero">Gênero:</label>
            <select name="id_genero" id="id_genero" required>
                <?php if (!empty($generos)): ?>
                    <?php foreach ($generos as $genero): ?>
                        <option value="<?= htmlspecialchars($genero['id']) ?>"><?= htmlspecialchars($genero['nome']) ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="" disabled>Nenhum gênero disponível</option>
                <?php endif; ?>
            </select>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Cadastrar</button>
                <a href="../../index.html" class="btn-secondary">Voltar ao Menu</a>
            </div>
        </form>
    </main>
</body>
</html>