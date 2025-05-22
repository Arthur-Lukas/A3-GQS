<?php
require_once '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\models\Ebook;

class EbookTest extends TestCase
{
    public function testEbookConstructorAndGetters()
    {
        $ebook = new Ebook(1, "Título", "Autor", "2024-01-01", 2, 300);

        $this->assertEquals(1, $ebook->getId());
        $this->assertEquals("Título", $ebook->getTitulo());
        $this->assertEquals("Autor", $ebook->getAutor());
        $this->assertEquals("2024-01-01", $ebook->getLancamento());
        $this->assertEquals(2, $ebook->getIdGenero());
        $this->assertEquals(300, $ebook->getPaginas());
    }

    public function testSetPaginas()
    {
        $ebook = new Ebook(1, "Título", "Autor", "2024-01-01", 2, 300);
        $ebook->setPaginas(150);
        $this->assertEquals(150, $ebook->getPaginas());
    }
}