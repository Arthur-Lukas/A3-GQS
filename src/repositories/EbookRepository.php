<?php

namespace App\repositories;

use App\config\Conexao;
use PDO;
use PDOException;

class EbookRepository
{
    private PDO $conexao;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function cadastrar(string $titulo, string $autor, int $lancamento, int $paginas, int $id_genero): array
    {
        try {
            $sql = "INSERT INTO ebooks (titulo, autor, lancamento, paginas, id_genero) 
                    VALUES (:titulo, :autor, :lancamento, :paginas, :id_genero)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':lancamento', $lancamento);
            $stmt->bindParam(':paginas', $paginas);
            $stmt->bindParam(':id_genero', $id_genero);
            $stmt->execute();

            return ["sucesso" => true, "mensagem" => "Ebook cadastrado com sucesso."];
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar eBook: " . $e->getMessage());
            return ["sucesso" => false, "mensagem" => "Erro ao cadastrar ebook."];
        }
    }

    public function listarTodos(): array
    {
        try {
            $sql = "SELECT e.*, g.nome AS nome_genero FROM ebooks e 
                    JOIN genero g ON e.id_genero = g.id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar eBooks: " . $e->getMessage());
            return [];
        }
    }

    public function editar(int $id, string $titulo, string $autor, int $lancamento, int $paginas, int $id_genero): array
    {
        try {
            $sql = "UPDATE ebooks SET titulo = :titulo, autor = :autor, lancamento = :lancamento, paginas = :paginas, id_genero = :id_genero 
                    WHERE id = :id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':lancamento', $lancamento);
            $stmt->bindParam(':paginas', $paginas);
            $stmt->bindParam(':id_genero', $id_genero);
            $stmt->execute();

            return ["sucesso" => true, "mensagem" => "Ebook atualizado com sucesso."];
        } catch (PDOException $e) {
            error_log("Erro ao editar eBook: " . $e->getMessage());
            return ["sucesso" => false, "mensagem" => "Erro ao editar ebook."];
        }
    }

    public function excluir(int $id): bool
    {
        try {
            $sql = "DELETE FROM ebooks WHERE id = :id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao excluir eBook: " . $e->getMessage());
            return false;
        }
    }

    public function buscarPorId(int $id): ?array
    {
        try {
            $sql = "SELECT * FROM ebooks WHERE id = :id";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            error_log("Erro ao buscar eBook por ID: " . $e->getMessage());
            return null;
        }
    }
}
?>