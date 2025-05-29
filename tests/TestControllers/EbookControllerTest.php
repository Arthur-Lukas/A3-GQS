<?php
use PHPUnit\Framework\TestCase;
use App\controllers\EbookController;
use App\repositories\EbookRepository;

class EbookControllerTest extends TestCase
{
    private $mockRepo;
    private $controller;

    protected function setUp(): void
    {
        // Criando um mock do repositório
        $this->mockRepo = $this->createMock(EbookRepository::class);
        
        // Criando o controller com o mock
        $this->controller = new EbookController($this->mockRepo);
    }

    public function testListarEbooksRetornaListaComMock()
    {
        // Definir retorno esperado
        $mockData = [['id' => 1, 'titulo' => 'Ebook de Exemplo']];
        $this->mockRepo->method('listarTodos')->willReturn($mockData);

        // Executar método
        $result = $this->controller->listarEbooks();

        // Verificar resultados
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertEquals('Ebook de Exemplo', $result[0]['titulo']);
    }

    public function testListarEbooksRetornaListaVaziaComMock()
    {
        // Mock retorna lista vazia
        $this->mockRepo->method('listarTodos')->willReturn([]);

        // Executar método
        $result = $this->controller->listarEbooks();

        // Verificar que lista está vazia
        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }
}
?>