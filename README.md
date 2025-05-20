# ProjetoLimpo - Biblioteca Pessoal

## Sobre o Projeto

O **ProjetoLimpo** é um sistema web simples para gerenciamento de uma biblioteca pessoal. O sistema é uma refatoração do "ProjetoSujo" que é um CRUD feito em Java, criado no primeiro semestre de 2024.

### Algumas outras características do projeto
- Foi refatorado inteiramente em PHP para ser uma aplicação WEB. Mas também há HTML, CSS e JS.
- Utiliza o paradigma de orientação á objetos (POO)
- Padrão de arquitetura MVC (model-view-controler)
- Tem uma interface web simples e responsiva
- Aplicação dos princípios SOLID, DRY, KISS e YAGNI.

O projeto foi desenvolvido com foco em boas práticas de programação, utilizando os princípios do "Clean code" para torna-lo mais legivel, modular e facilitar a manutenção e atualização.

---![image](https://github.com/user-attachments/assets/a849b6f0-2df1-4989-bc55-e8737d55d826)


## Funcionalidades

- Cadastro, listagem, e exclusão de gêneros literários
- Cadastro, listagem, edição e exclusão de livros físicos e e-books

---

## Pré-requisitos

- [XAMPP](https://www.apachefriends.org/pt_br/index.html) ou outro servidor local com suporte a PHP e MySQL
- PHP 8.0 ou superior
- Navegador web moderno
- IDE de sua escoha que rode PHP (recomendavel VS-code)

---

## Instalação e Execução

1. **Clone o repositório**
   ```bash
   git clone  https://github.com/Arthur-Lukas/A3-GQS.git
2. **Coloque a pasta do projeto no diretório do seu servidor local**
   - Exemplo para XAMPP:  
   - Copie a pasta `ProjetoLimpo` para `C:\xampp\htdocs\`

3. **Inicie o servidor Apache e MySQL pelo XAMPP**

4. **Crie o banco de dados**
   - Acesse o [phpMyAdmin](http://localhost/phpmyadmin)
   - Crie um banco de dados chamado `db_biblioteca` 
   - Importe o script do banco de dados que está na pasta (script_sql) do repositório 

5. **Acesse o sistema**
   - No navegador, acesse:  
     [http://localhost/ProjetoLimpo/index.html](http://localhost/ProjetoLimpo/index.html)

---

## Licença

Este projeto é livre para fins acadêmicos e de aprendizado.

