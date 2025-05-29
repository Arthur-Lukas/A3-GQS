<?php
use PHPUnit\Framework\TestCase;
use App\controllers\GeneroController;
use App\repositories\GeneroRepository;

class GeneroControllerTest extends TestCase
{
    public function testCadastrarGeneroComMock()
    {
        // Criando um mock do repositório
        $mockRepo = $this->createMock(GeneroRepository::class);
        
        // Definindo retorno esperado
        $mockRepo->method('cadastrar')->willReturn(['sucesso' => true, 'mensagem' => 'Gênero cadastrado com sucesso.']);

        // Criando o controller com o mock
        $controller = new GeneroController($mockRepo);
        
        // Executando o teste
        $resultado = $controller->cadastrarGenero('Aventura');
        $this->assertTrue($resultado['sucesso']);
        $this->assertEquals('Gênero cadastrado com sucesso.', $resultado['mensagem']);
    }
}
?>