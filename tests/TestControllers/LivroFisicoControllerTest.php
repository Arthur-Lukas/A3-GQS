<?php

use PHPUnit\Framework\TestCase;
use App\controllers\LivroFisicoController;
use App\repositories\LivroFisicoRepository;

class LivroFisicoControllerTest extends TestCase
{
    private $mockRepo;
    private $controller;

    protected function setUp(): void
    {
        $this->mockRepo = $this->createMock(LivroFisicoRepository::class);
        $this->controller = new LivroFisicoController($this->mockRepo);
    }

    public function testCadastrarLivroFisico()
    {
        $this->mockRepo->expects($this->once())
            ->method('cadastrar')
            ->willReturn(true);

        $resultado = $this->controller->cadastrarLivroFisico('Título Teste', 'Autor Teste', 2024, 49.99, 1);

        $this->assertTrue($resultado);
    }

    public function testListarLivrosFisicos()
    {
        $livrosMock = [
            ['id' => 1, 'titulo' => 'Livro Teste', 'autor' => 'Autor Teste', 'lancamento' => 2023, 'preco' => 39.99, 'nome_genero' => 'Ficção'],
        ];

        $this->mockRepo->expects($this->once())
            ->method('listarTodos')
            ->willReturn($livrosMock);

        $resultado = $this->controller->listarLivrosFisicos();

        $this->assertSame($livrosMock, $resultado);
    }

    public function testEditarLivroFisico()
    {
        $this->mockRepo->expects($this->once())
            ->method('editar')
            ->willReturn(true);

        $resultado = $this->controller->editarLivroFisico(1, 'Novo Título', 'Novo Autor', 2022, 59.99, 2);

        $this->assertTrue($resultado);
    }

    public function testBuscarPorIdLivroFisico()
    {
        $livroMock = ['id' => 1, 'titulo' => 'Livro Teste', 'autor' => 'Autor Teste', 'lancamento' => 2023, 'preco' => 39.99, 'nome_genero' => 'Ficção'];

        $this->mockRepo->expects($this->once())
            ->method('buscarPorId')
            ->willReturn($livroMock);

        $resultado = $this->controller->buscarPorId(1);

        $this->assertSame($livroMock, $resultado);
    }

    public function testVerificarLivrosPorGenero()
    {
        $this->mockRepo->expects($this->once())
            ->method('verificarLivrosPorGenero')
            ->willReturn(5);

        $resultado = $this->controller->verificarLivrosPorGenero(1);

        $this->assertEquals(5, $resultado);
    }

    public function testExcluirLivroFisico()
    {
        $this->mockRepo->expects($this->once())
            ->method('excluir')
            ->willReturn(true);

        $resultado = $this->controller->excluirLivroFisico(1);

        $this->assertTrue($resultado);
    }
}
?>