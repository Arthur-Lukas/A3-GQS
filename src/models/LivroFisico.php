<?php
class LivroFisico {
    public $id;
    public $titulo;
    public $autor;
    public $lancamento;
    public $preco;
    public $id_genero;

    public function __construct($titulo, $autor, $lancamento, $preco, $id_genero) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->lancamento = $lancamento;
        $this->preco = $preco;
        $this->id_genero = $id_genero;
    }
}
?>