# ProjetoLimpo - Biblioteca Pessoal

## Sobre o Projeto

O **ProjetoLimpo** é um sistema web simples para gerenciamento de uma biblioteca pessoal, desenvolvido em PHP seguindo os princípios de Clean Code. O sistema é uma refatoração do "ProjetoSujo" que é um CRUD feito em Java, criado no primeiro semestre de 2024.

O projeto foi desenvolvido com foco em boas práticas de programação, separação de responsabilidades (MVC), modularidade e facilidade de manutenção.

---

## Funcionalidades

- Cadastro, listagem, e exclusão de gêneros literários
- Cadastro, listagem, edição e exclusão de livros físicos e e-books

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
2. **Coloque a pasta do projeto no diretório do seu servidor local**
   - Exemplo para XAMPP:  
   - Copie a pasta `ProjetoLimpo` para `C:\xampp\htdocs\`

3. **Crie o banco de dados**
   - Acesse o [phpMyAdmin](http://localhost/phpmyadmin)
   - Crie um banco de dados chamado `db_biblioteca` 
   - Importe o script do banco de dados na pasta do repositório (script_sql)

4. **Inicie o servidor Apache e MySQL pelo XAMPP**

5. **Acesse o sistema**
   - No navegador, acesse:  
     [http://localhost/ProjetoLimpo/index.html](http://localhost/ProjetoLimpo/index.html)](http://localhost/ProjetoLimpo/)

---

## Licença

Este projeto é livre para fins acadêmicos e de aprendizado.

