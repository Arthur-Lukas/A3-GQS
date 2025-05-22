<?php
namespace App\models;

class Ebook extends Livro
{
    protected int $paginas;

    public function __construct(int $id, string $titulo, string $autor, string $lancamento, int $id_genero, int $paginas)
    {
        parent::__construct($id, $titulo, $autor, $lancamento, $id_genero);
        $this->paginas = $paginas;
    }

    public function getPaginas(): int
    {
        return $this->paginas;
    }

    public function setPaginas(int $paginas): void
    {
        $this->paginas = $paginas;
    }
}
?>