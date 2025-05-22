<?php
include_once 'Livro.php';
class LivroFisico extends Livro
{
    protected float $preco;

    public function __construct(int $id, string $titulo, string $autor, string $lancamento, int $id_genero, float $preco)
    {
        parent::__construct($id, $titulo, $autor, $lancamento, $id_genero);
        $this->preco = $preco;
    }
}
?>