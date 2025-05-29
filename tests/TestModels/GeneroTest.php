<?php
use PHPUnit\Framework\TestCase;
use App\models\Genero;

class GeneroTest extends TestCase
{
    public function testGeneroCreation()
    {
        $genero = new Genero("Ficção");
        $this->assertEquals("Ficção", $genero->getNome());
    }

    public function testGeneroSetAndGetNome()
    {
        $genero = new Genero("Aventura");
        $genero->setNome("Romance");
        $this->assertEquals("Romance", $genero->getNome());
    }
}