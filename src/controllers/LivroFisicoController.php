<?php
// filepath: src/controllers/LivroFisicoController.php
namespace App\controllers;

use App\config\Conexao;
use App\models\LivroFisico;
use PDO;
use PDOException;

class LivroFisicoController
{
    public static function cadastrarLivroFisico($titulo, $autor, $lancamento, $preco, $id_genero)
    {
        try {
            $conexao = Conexao::conectar();
            $sql = "INSERT INTO livros_fisicos (titulo, autor, lancamento, preco, id_genero) VALUES (:titulo, :autor, :lancamento, :preco, :id_genero)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':lancamento', $lancamento);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':id_genero', $id_genero);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar livro físico: " . $e->getMessage());
            return false;
        }
    }

    public static function listarLivrosFisicos() {
        $conexao = Conexao::conectar();
        $sql = "SELECT lf.*, g.nome AS nome_genero
                FROM livrosfisicos lf
                JOIN genero g ON lf.id_genero = g.id";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function editarLivroFisico($id, $titulo, $autor, $lancamento, $preco, $id_genero) {
        try {
            $conexao = Conexao::conectar();
            $sql = "UPDATE livrosfisicos SET titulo = :titulo, autor = :autor, lancamento = :lancamento, preco = :preco, id_genero = :id_genero WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':lancamento', $lancamento);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':id_genero', $id_genero);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao editar livro físico: " . $e->getMessage());
            return false;
        }
    }

    public static function buscarPorId($id) {
        try {
            $conexao = Conexao::conectar();
            $sql = "SELECT * FROM livrosfisicos WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $livro = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$livro) {
                http_response_code(404);
                return ["error" => "Livro físico não encontrado"];
            }
    
            return $livro;
        } catch (PDOException $e) {
            error_log("Erro ao buscar livro físico por ID: " . $e->getMessage());
            return ["error" => "Erro ao acessar o banco"];
        }
    }

    public static function verificarLivrosPorGenero($id_genero) {
        try {
            $conexao = Conexao::conectar();
            $sql = "SELECT COUNT(*) as total FROM livrosfisicos WHERE id_genero = :id_genero";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id_genero', $id_genero, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'];
        } catch (PDOException $e) {
            error_log("Erro ao verificar livros por gênero: " . $e->getMessage());
            return 0;
        }
    }

    public static function excluirLivroFisico($id) {
        try {
            $conexao = Conexao::conectar();
            $sql = "DELETE FROM livrosfisicos WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                http_response_code(404);
                return ["error" => "Livro não encontrado"];
            }

            return true;
        } catch (PDOException $e) {
            error_log("Erro ao excluir livro físico: " . $e->getMessage());
            return false;
        }
    }
}
?>