<?php
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
}
?>