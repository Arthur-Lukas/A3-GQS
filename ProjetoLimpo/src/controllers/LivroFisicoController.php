<?php
include_once '../config/Conexao.php';
include_once '../models/LivroFisico.php';

class LivroFisicoController {
    public static function cadastrarLivroFisico($titulo, $autor, $lancamento, $preco, $id_genero) {
        $conexao = Conexao::conectar();
        $sql = "INSERT INTO livros_fisicos (titulo, autor, lancamento, preco, id_genero) VALUES (:titulo, :autor, :lancamento, :preco, :id_genero)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':lancamento', $lancamento);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':id_genero', $id_genero);
        $stmt->execute();
    }

    public static function listarLivrosFisicos() {
        $conexao = Conexao::conectar();
        $sql = "SELECT * FROM livros_fisicos ORDER BY id";
        $stmt = $conexao->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function editarLivroFisico($id, $titulo, $autor, $lancamento, $preco, $id_genero) {
        $conexao = Conexao::conectar();
        $sql = "UPDATE livros_fisicos SET titulo = :titulo, autor = :autor, lancamento = :lancamento, preco = :preco, id_genero = :id_genero WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':lancamento', $lancamento);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':id_genero', $id_genero);
        $stmt->execute();
    }

    public static function excluirLivroFisico($id) {
        $conexao = Conexao::conectar();
        $sql = "DELETE FROM livros_fisicos WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>