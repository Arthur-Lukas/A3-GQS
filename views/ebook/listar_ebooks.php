<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\controllers\EbookController;
use App\repositories\EbookRepository;
use App\config\Conexao;

$pdo = Conexao::conectar();
$repo = new EbookRepository($pdo);
$controller = new EbookController($repo);
$mensagem = '';
$ebooks = [];

try {
    $ebooks = $controller->listarEbooks();
} catch (Exception $e) {
    $mensagem = "<p class='error'>Erro ao listar e-books: " . htmlspecialchars($e->getMessage()) . "</p>";
}

/**
 * Função para exibir tabela de e-books
 */
function renderizarTabelaEbooks(array $ebooks): string {
    if (empty($ebooks)) {
        return "<p class='info'>Nenhum e-book cadastrado.</p>";
    }

    $html = '<table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano de Lançamento</th>
                        <th>Número de Páginas</th>
                        <th>Gênero</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($ebooks as $ebook) {
        $html .= '<tr>
                    <td>' . htmlspecialchars($ebook['id']) . '</td>
                    <td>' . htmlspecialchars($ebook['titulo']) . '</td>
                    <td>' . htmlspecialchars($ebook['autor']) . '</td>
                    <td>' . htmlspecialchars($ebook['lancamento']) . '</td>
                    <td>' . htmlspecialchars($ebook['paginas']) . '</td>
                    <td>' . htmlspecialchars($ebook['nome_genero'] ?? '') . '</td>
                  </tr>';
    }

    $html .= '</tbody></table>';
    
    return $html;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar E-books</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>E-books Cadastrados</h1>
    </header>

    <main class="list-container">
        <?= $mensagem ?>
        <?= renderizarTabelaEbooks($ebooks) ?>

        <div class="actions">
            <a href="../../index.html" class="btn-secondary">Voltar ao Menu</a>
        </div>
    </main>
</body>
</html>