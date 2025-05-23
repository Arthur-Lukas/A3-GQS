<?php
namespace App\controllers;

use App\config\Conexao;
use App\models\Genero;
use PDO;
use PDOException;

class GeneroController {
    public static function cadastrarGenero($nome) {
        try {
            $conexao = Conexao::conectar();

            // Verifica se já existe um gênero com o mesmo nome
            $sqlVerifica = "SELECT COUNT(*) FROM genero WHERE nome = :nome";
            $stmtVerifica = $conexao->prepare($sqlVerifica);
            $stmtVerifica->bindParam(':nome', $nome);
            $stmtVerifica->execute();
            $existe = $stmtVerifica->fetchColumn();

            if ($existe > 0) {
                return ["error" => "Informe outro gênero, este já está cadastrado!"];
            }

            $sql = "INSERT INTO genero (nome) VALUES (:nome)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar gênero: " . $e->getMessage());
            return false;
        }
    }

    public static function listarGeneros() {
        try {
            $conexao = Conexao::conectar();
            $sql = "SELECT * FROM genero ORDER BY id";
            $stmt = $conexao->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar gêneros: " . $e->getMessage());
            return [];
        }
    }

    public static function excluirGenero($id) {
        try {
            $conexao = Conexao::conectar();
            $sql = "DELETE FROM genero WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                http_response_code(404);
                return ["error" => "Gênero não encontrado"];
            }

            return true;
        } catch (PDOException $e) {
            error_log("Erro ao excluir gênero: " . $e->getMessage());
            return false;
        }
    }

    public static function buscarPorId($id) {
        try {
            $conexao = Conexao::conectar();
            $sql = "SELECT * FROM genero WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $genero = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$genero) {
                http_response_code(404);
                return ["error" => "Gênero não encontrado"];
            }

            return $genero;
        } catch (PDOException $e) {
            error_log("Erro ao buscar gênero por ID: " . $e->getMessage());
            return ["error" => "Erro ao acessar o banco"];
        }
    }
}
?>