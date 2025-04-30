<?php
class Ebook {
    public $id;
    public $titulo;
    public $autor;
    public $lancamento;
    public $paginas;
    public $id_genero;

    public function __construct($titulo, $autor, $lancamento, $paginas, $id_genero) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->lancamento = $lancamento;
        $this->paginas = $paginas;
        $this->id_genero = $id_genero;
    }
}
?>