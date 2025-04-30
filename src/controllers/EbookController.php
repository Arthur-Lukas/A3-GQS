<?php
include_once '../src/config/Conexao.php';
include_once '../src/models/Ebook.php';

class EbookController {
        public static function cadastrarEbook($titulo, $autor, $lancamento, $paginas, $id_genero) {
            $conexao = Conexao::conectar();
            $sql = "INSERT INTO ebooks (titulo, autor, lancamento, paginas, id_genero) VALUES (:titulo, :autor, :lancamento, :paginas, :id_genero)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':lancamento', $lancamento);
            $stmt->bindParam(':paginas', $paginas);
            $stmt->bindParam(':id_genero', $id_genero);
            $stmt->execute();
        }

        public static function listarEbooks() {
            $conexao = Conexao::conectar();
            $sql = "SELECT * FROM ebooks ORDER BY id";
            $stmt = $conexao->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function editarEbook($id, $titulo, $autor, $lancamento, $paginas, $id_genero) {
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
        }

        public static function excluirEbook($id) {
            $conexao = Conexao::conectar();
            $sql = "DELETE FROM ebooks WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
    }
?>