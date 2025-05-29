<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\controllers\EbookController;
use App\controllers\GeneroController;
use App\repositories\EbookRepository;
use App\repositories\GeneroRepository;

$pdo = \App\config\Conexao::conectar();

$repoGenero = new GeneroRepository($pdo);
$controllerGenero = new GeneroController($repoGenero);

$repoEbook = new EbookRepository($pdo);
$controllerEbook = new EbookController($repoEbook);

$mensagem = '';

try {
    $generos = $controllerGenero->listarGeneros();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao carregar gêneros: " . htmlspecialchars($e->getMessage()) . "</p>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $lancamento = $_POST['lancamento'];
    $paginas = $_POST['paginas'];
    $id_genero = $_POST['id_genero'];

    $validacaoErro = validarDadosEbook($titulo, $autor, $lancamento, $paginas, $id_genero);

    if ($validacaoErro) {
        $mensagem = "<p class='error'>{$validacaoErro}</p>";
    } else {
        try {
            $controllerEbook->cadastrarEbook($titulo, $autor, $lancamento, $paginas, $id_genero);
            $mensagem = "<p class='success'>E-book cadastrado com sucesso!</p>";
        } catch (Exception $e) {
            $mensagem = "<p class='error'>Erro ao cadastrar e-book: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
}

/**
 * Função de validação dos dados
 */
function validarDadosEbook($titulo, $autor, $lancamento, $paginas, $id_genero): ?string {
    if (!preg_match('/^[\p{L}\s\'\-\.]+$/u', $autor)) {
        return "O campo Autor deve conter apenas letras, espaços, apóstrofos, hífens e pontos!";
    }
    if (empty($titulo) || empty($autor) || empty($lancamento) || empty($paginas) || empty($id_genero)) {
        return "Todos os campos são obrigatórios!";
    }
    if ($lancamento <= 0 || $paginas <= 0) {
        return "Os números devem ser positivos!";
    }
    return null;
}

/**
 * Função para renderizar opções de gêneros
 */
function renderizarOpcoesGenero(array $generos): string {
    if (empty($generos)) {
        return '<option value="" disabled>Nenhum gênero disponível</option>';
    }

    $html = '';
    foreach ($generos as $genero) {
        $html .= '<option value="' . htmlspecialchars($genero['id']) . '">' . htmlspecialchars($genero['nome']) . '</option>';
    }
    return $html;
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
                <?= renderizarOpcoesGenero($generos) ?>
            </select>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Cadastrar</button>
                <a href="../../index.html" class="btn-secondary">Voltar ao Menu</a>
            </div>
        </form>
    </main>
</body>
</html>