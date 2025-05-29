<?php
namespace App\controllers;

use App\repositories\EbookRepository;

class EbookController
{
    private EbookRepository $repo;

    public function __construct(EbookRepository $repo)
    {
        $this->repo = $repo;
    }

    public function cadastrarEbook(string $titulo, string $autor, string $lancamento, int $paginas, int $id_genero): array
    {
        return $this->repo->cadastrar($titulo, $autor, $lancamento, $paginas, $id_genero);
    }

    public function listarEbooks(): array
    {
        return $this->repo->listarTodos();
    }

    public function editarEbook(int $id, string $titulo, string $autor, string $lancamento, int $paginas, int $id_genero): array
    {
        return $this->repo->editar($id, $titulo, $autor, $lancamento, $paginas, $id_genero);
    }

    public function excluirEbook(int $id): bool
    {
        return $this->repo->excluir($id);
    }

    public function obterEbookPorId(int $id): ?array
    {
        return $this->repo->buscarPorId($id) ?: null;
    }
}
?>