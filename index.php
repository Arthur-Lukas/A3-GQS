<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - Projeto Biblioteca</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }
        header {
            background-color: #0078d7;
            color: white;
            padding: 10px 0;
        }
        main {
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        a {
            display: block;
            margin: 10px 0;
            color: #0078d7;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Projeto Biblioteca</h1>
    </header>
    <main>
        <h2>Bem-vindo ao sistema de biblioteca!</h2>
        <p>Navegue pelas funcionalidades disponíveis:</p>
        <a href="views/cadastrar_genero.php">Cadastrar Gênero</a>
        <a href="views/listar_generos.php">Listar Gêneros</a>
        <a href="views/cadastrar_livro_fisico.php">Cadastrar Livro Físico</a>
        <a href="views/listar_livros_fisicos.php">Listar Livros Físicos</a>
        <a href="views/cadastrar_ebook.php">Cadastrar E-book</a>
        <a href="views/listar_ebooks.php">Listar E-books</a>
        <a href="views/excluir_genero.php">Excluir Gênero</a>
    </main>
    <footer>
        <p>&copy; 2025 Projeto Biblioteca</p>
    </footer>
</body>
</html>