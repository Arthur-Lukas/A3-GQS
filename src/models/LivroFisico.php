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

    public static function buscarPorId($id) {
        $conexao = Conexao::conectar();
        $sql = "SELECT * FROM livrosfisicos WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>