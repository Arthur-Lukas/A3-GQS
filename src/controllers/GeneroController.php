<?php
namespace App\controllers;

use App\repositories\GeneroRepository;

class GeneroController
{
    private $repo;

    public function __construct(GeneroRepository $repo)
    {
        $this->repo = $repo;
    }

    public function cadastrarGenero($nome)
    {
        return $this->repo->cadastrar($nome);
    }

    public function listarGeneros()
    {
        return $this->repo->listarTodos();
    }

    public function excluirGenero($id)
    {
        return $this->repo->excluir($id);
    }

    public function buscarPorId($id)
    {
        return $this->repo->buscarPorId($id);
    }
}
?>