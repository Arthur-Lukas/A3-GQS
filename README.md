```markdown
# ProjetoLimpo - Biblioteca Pessoal

## Sobre o Projeto

O **ProjetoLimpo** é um sistema web simples para gerenciamento de uma biblioteca pessoal, desenvolvido em PHP seguindo os princípios de Clean Code. O sistema permite cadastrar, listar, editar e excluir gêneros, livros físicos e e-books, proporcionando uma experiência organizada e intuitiva para o usuário.

O projeto foi desenvolvido com foco em boas práticas de programação, separação de responsabilidades (MVC), modularidade e facilidade de manutenção.

---

## Funcionalidades

- Cadastro, listagem, edição e exclusão de gêneros literários
- Cadastro, listagem, edição e exclusão de livros físicos
- Cadastro, listagem, edição e exclusão de e-books
- Interface web simples e responsiva

---

## Pré-requisitos

- [XAMPP](https://www.apachefriends.org/pt_br/index.html) ou outro servidor local com suporte a PHP e MySQL
- PHP 8.0 ou superior
- Navegador web moderno

---

## Instalação e Execução

1. **Clone o repositório**
   ```bash
   git clone https://github.com/seu-usuario/ProjetoLimpo.git
   ```

2. **Coloque a pasta do projeto no diretório do seu servidor local**
   - Exemplo para XAMPP:  
     Copie a pasta `ProjetoLimpo` para `C:\xampp\htdocs\`

3. **Crie o banco de dados**
   - Acesse o [phpMyAdmin](http://localhost/phpmyadmin)
   - Crie um banco de dados chamado `biblioteca` (ou o nome definido em `src/config/Conexao.php`)
   - Importe o arquivo SQL fornecido no repositório (ex: `banco.sql`) para criar as tabelas necessárias

4. **Configure a conexão com o banco de dados**
   - Abra o arquivo `src/config/Conexao.php`
   - Ajuste as variáveis de conexão (`host`, `dbname`, `user`, `password`) conforme seu ambiente

5. **Inicie o servidor Apache e MySQL pelo XAMPP**

6. **Acesse o sistema**
   - No navegador, acesse:  
     [http://localhost/ProjetoLimpo/index.html](http://localhost/ProjetoLimpo/index.html)

---

## Estrutura do Projeto

```
ProjetoLimpo/
├── assets/
│   ├── css/
│   └── js/
├── src/
│   ├── config/
│   ├── controllers/
│   ├── models/
│   └── views/
├── index.html
└── banco.sql (caso exista)
```

---

## Contribuição

Sinta-se à vontade para abrir issues ou pull requests com sugestões de melhorias, correções ou novas funcionalidades.

---

## Licença

Este projeto é livre para fins acadêmicos e de aprendizado.

---
```
Adapte o nome do banco e o link do repositório conforme necessário!
