<?php
namespace App\repositories;

use App\config\Conexao;
use PDO;
use PDOException;

class GeneroRepository
{
    public function cadastrar($nome)
    {
        if (empty($nome)) {
            return [
                'sucesso' => false,
                'mensagem' => 'Nome do gênero é obrigatório.'
            ];
        }

        try {
            $conexao = \App\config\Conexao::conectar();

            // Verifica se já existe um gênero com o mesmo nome
            $sqlVerifica = "SELECT COUNT(*) FROM genero WHERE nome = :nome";
            $stmtVerifica = $conexao->prepare($sqlVerifica);
            $stmtVerifica->bindParam(':nome', $nome);
            $stmtVerifica->execute();
            $existe = $stmtVerifica->fetchColumn();

            if ($existe > 0) {
                return [
                    'sucesso' => false,
                    'mensagem' => 'Informe outro gênero, este já está cadastrado!'
                ];
            }

            $sql = "INSERT INTO genero (nome) VALUES (:nome)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->execute();
            return [
                'sucesso' => true,
                'mensagem' => 'Gênero cadastrado com sucesso.'
            ];
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar gênero: " . $e->getMessage());
            return [
                'sucesso' => false,
                'mensagem' => 'Erro ao cadastrar gênero.'
            ];
        }
    }

    public function listarTodos()
    {
        try {
            $conexao = \App\config\Conexao::conectar();
            $sql = "SELECT * FROM genero ORDER BY id";
            $stmt = $conexao->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar gêneros: " . $e->getMessage());
            return [];
        }
    }

    public function excluir($id)
    {
        try {
            $conexao = \App\config\Conexao::conectar();
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

    public function buscarPorId($id)
    {
        try {
            $conexao = \App\config\Conexao::conectar();
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