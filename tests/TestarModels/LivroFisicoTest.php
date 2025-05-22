<?php
require_once '../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\models\LivroFisico;

class LivroFisicoTest extends TestCase
{
    public function testLivroFisicoConstructorAndGetters()
    {
        $livro = new LivroFisico(1, "Título do Livro", "Autor do Livro", "2024-01-01", 2, 20.00);

        $this->assertEquals(1, $livro->getId());
        $this->assertEquals("Título do Livro", $livro->getTitulo());
        $this->assertEquals("Autor do Livro", $livro->getAutor());
        $this->assertEquals("2024-01-01", $livro->getLancamento());
        $this->assertEquals(2, $livro->getIdGenero());
        $this->assertEquals(20.00, $livro->getPreco());
    }

    public function testSetPreco()
    {
        $livro = new LivroFisico(1, "Título", "Autor", "2024-01-01", 2, 20.00);
        $livro->setPreco(15.50);
        $this->assertEquals(15.50, $livro->getPreco());
    }
}