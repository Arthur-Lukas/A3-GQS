<?php
include_once '../../src/config/Conexao.php';
include_once '../../src/models/Ebook.php';

class EbookController {
    public static function cadastrarEbook($titulo, $autor, $lancamento, $paginas, $id_genero) {
        try {
            $conexao = Conexao::conectar();
            $sql = "INSERT INTO ebooks (titulo, autor, lancamento, paginas, id_genero) VALUES (:titulo, :autor, :lancamento, :paginas, :id_genero)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':lancamento', $lancamento);
            $stmt->bindParam(':paginas', $paginas);
            $stmt->bindParam(':id_genero', $id_genero);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar eBook: " . $e->getMessage());
            return false;
        }
    }

    public static function listarEbooks() {
        $conexao = Conexao::conectar();
        $sql = "SELECT e.*, g.nome AS nome_genero
                FROM ebooks e
                JOIN genero g ON e.id_genero = g.id";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function editarEbook($id, $titulo, $autor, $lancamento, $paginas, $id_genero) {
        try {
            $conexao = Conexao::conectar();
            $sql = "UPDATE ebooks SET titulo = :titulo, autor = :autor, lancamento = :lancamento, paginas = :paginas, id_genero = :id_genero WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':lancamento', $lancamento);
            $stmt->bindParam(':paginas', $paginas);
            $stmt->bindParam(':id_genero', $id_genero);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao editar eBook: " . $e->getMessage());
            return false;
        }
    }

    public static function excluirEbook($id) {
        try {
            $conexao = Conexao::conectar();
            $sql = "DELETE FROM ebooks WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao excluir eBook: " . $e->getMessage());
            return false;
        }
    }

    public static function buscarPorId($id) {
        try {
            $conexao = Conexao::conectar();
            $sql = "SELECT * FROM ebooks WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $ebook = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$ebook) {
                http_response_code(404); // Define o código HTTP como 404
                return ["error" => "Livro não encontrado"];
            }

            return $ebook;
        } catch (PDOException $e) {
            error_log("Erro ao buscar eBook por ID: " . $e->getMessage());
            return ["error" => "Erro ao acessar o banco"];
        }
    }
}
?>