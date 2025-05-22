<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

// Ajuste o namespace se necessário
require_once __DIR__ . '/../src/controllers/EbookController.php';

class EbookControllerTest extends TestCase
{
    public function testCadastrarEbookRetornaTrue()
    {
        // ATENÇÃO: Este teste irá inserir um registro real no banco de dados!
        // Use dados de teste e limpe o banco após o teste se necessário.

        $titulo = "Teste PHPUnit";
        $autor = "Autor Teste";
        $lancamento = "2024-01-01";
        $paginas = 123;
        $id_genero = 1; // Certifique-se que esse id_genero existe no banco

        $resultado = EbookController::cadastrarEbook($titulo, $autor, $lancamento, $paginas, $id_genero);

        $this->assertTrue($resultado);
    }
}

