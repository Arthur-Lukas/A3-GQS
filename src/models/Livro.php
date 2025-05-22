<?php

namespace App\models;

class Livro
{
    protected int $id;
    protected string $titulo;
    protected string $autor;
    protected string $lancamento;
    protected int $id_genero;

    public function __construct(int $id, string $titulo, string $autor, string $lancamento, int $id_genero)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->lancamento = $lancamento;
        $this->id_genero = $id_genero;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getAutor(): string
    {
        return $this->autor;
    }

    public function getLancamento(): string
    {
        return $this->lancamento;
    }

    public function getIdGenero(): int
    {
        return $this->id_genero;
    }
}
?>