<?php
namespace App\controllers;

use App\repositories\LivroFisicoRepository;

class LivroFisicoController
{
    private $repository;

    public function __construct(LivroFisicoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function cadastrarLivroFisico($titulo, $autor, $lancamento, $preco, $id_genero)
    {
        return $this->repository->cadastrar($titulo, $autor, $lancamento, $preco, $id_genero);
    }

    public function listarLivrosFisicos()
    {
        return $this->repository->listarTodos();
    }

    public function editarLivroFisico($id, $titulo, $autor, $lancamento, $preco, $id_genero)
    {
        return $this->repository->editar($id, $titulo, $autor, $lancamento, $preco, $id_genero);
    }

    public function buscarPorId($id)
    {
        return $this->repository->buscarPorId($id);
    }

    public function verificarLivrosPorGenero($id_genero)
    {
        return $this->repository->verificarLivrosPorGenero($id_genero);
    }

    public function excluirLivroFisico($id)
    {
        return $this->repository->excluir($id);
    }
}