<?php
require_once '../../vendor/autoload.php';

use App\controllers\LivroFisicoController;
use App\controllers\GeneroController;
use App\config\Conexao;

$pdo = Conexao::conectar();
$repoGenero = new \App\repositories\GeneroRepository($pdo);
$repoLivroFisico = new \App\repositories\LivroFisicoRepository($pdo);

$controllerGenero = new GeneroController($repoGenero);
$controllerLivroFisico = new LivroFisicoController($repoLivroFisico);

$mensagem = '';

try {
    // Buscar todos os gêneros para exibição no select
    $generos = $controllerGenero->listarGeneros();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao carregar gêneros: " . htmlspecialchars($e->getMessage()) . "</p>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $lancamento = filter_var($_POST['lancamento'], FILTER_VALIDATE_INT);
    $preco = filter_var($_POST['preco'], FILTER_VALIDATE_FLOAT);
    $id_genero = filter_var($_POST['id_genero'], FILTER_VALIDATE_INT);

    // Validação de dados
    if (!preg_match('/^[\p{L}\s\'\-\.]+$/u', $autor)) {
        $mensagem = "<p class='error'>O campo Autor deve conter apenas letras, espaços, apóstrofos, hífens e pontos!</p>";
    } elseif (!$titulo || !$autor || !$lancamento || !$preco || !$id_genero) {
        $mensagem = "<p class='error'>Todos os campos são obrigatórios!</p>";
    } elseif ($lancamento <= 0 || $preco <= 0) {
        $mensagem = "<p class='error'>Ano de lançamento e preço devem ser positivos!</p>";
    } else {
        try {
            $resultado = $controllerLivroFisico->cadastrarLivroFisico($titulo, $autor, $lancamento, $preco, $id_genero);

            if ($resultado === true) {
                $mensagem = "<p class='success'>Livro cadastrado com sucesso!</p>";
            } else {
                $mensagem = "<p class='error'>Erro ao cadastrar livro: " . htmlspecialchars($resultado['error'] ?? 'Erro desconhecido') . "</p>";
            }
        } catch (Exception $e) {
            $mensagem = "<p class='error'>Erro ao cadastrar livro: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro Físico</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Cadastrar Novo Livro Físico</h1>
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

            <label for="preco">Preço:</label>
            <input type="number" name="preco" id="preco" step="0.01" required min="0.01">

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