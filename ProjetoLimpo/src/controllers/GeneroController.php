<?php
include_once '../config/Conexao.php';
include_once '../models/Genero.php';

class GeneroController {
    public static function cadastrarGenero($nome) {
        $conexao = Conexao::conectar();
        $sql = "INSERT INTO genero (nome) VALUES (:nome)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();
    }

    public static function listarGeneros() {
        $conexao = Conexao::conectar();
        $sql = "SELECT * FROM genero ORDER BY id";
        $stmt = $conexao->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function excluirGenero($id) {
        $conexao = Conexao::conectar();
        $sql = "DELETE FROM genero WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>