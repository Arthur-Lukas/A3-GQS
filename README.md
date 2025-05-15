# A3 da matéria Gestão e Qualidade de software com os professores Henrique Poyatos e Adriano no semestre 1/2025

### Integrantes do projeto

Arthur Lucas Evangelista Machado - RA 324146950
Cicera - RA 12524150398
Iago Luiz Simplicio Serra - RA 1272320678
Joyce Mendonça Paixão - RA 323212772
Bruno Almeida Vilela - RA 323124929
Ronildo Santos da Silva – RA 823226546

# Biblioteca Java - CRUD com POO e MySQL

## Sobre o Projeto

Este projeto é um sistema de gerenciamento de biblioteca pessoal desenvolvido em **Java** utilizando o paradigma de **Programação Orientada a Objetos (POO)** e integração com banco de dados **MySQL**. O sistema permite cadastrar, listar, editar e excluir gêneros, livros físicos e e-books, demonstrando conceitos como herança, polimorfismo, encapsulamento e uso de DAO para persistência.

O projeto foi criado como exercício acadêmico para aplicar boas práticas de Clean Code, modularização e princípios SOLID.

---

## Funcionalidades

- Cadastro, listagem, edição e exclusão de gêneros literários
- Cadastro, listagem, edição e exclusão de livros físicos
- Cadastro, listagem, edição e exclusão de e-books
- Interface via JOptionPane para interação com o usuário

---

## Pré-requisitos

- [Java JDK 8+](https://www.oracle.com/java/technologies/downloads/)
- [MySQL Server](https://dev.mysql.com/downloads/mysql/)
- [Eclipse](https://www.eclipse.org/) ou outra IDE Java (opcional)
- [Connector/J (JDBC Driver)](https://dev.mysql.com/downloads/connector/j/)

---

## Instalação e Execução

1. **Clone o repositório**
   ```bash
   git clone https://github.com/seu-usuario/BibliotecaJava.git

Importe o projeto na sua IDE

Abra o Eclipse (ou outra IDE) e importe o projeto como um projeto Java existente.
Configure o banco de dados

Crie um banco de dados chamado biblioteca no MySQL.
Importe o arquivo banco.sql (fornecido no repositório) para criar as tabelas necessárias.
Configure a conexão JDBC

Baixe o driver JDBC (Connector/J) e adicione ao classpath do projeto.
No arquivo de configuração/conexão (ex: Conexao.java), ajuste as variáveis de conexão (host, database, user, password) conforme seu ambiente.
Compile e execute o projeto

Execute a classe Main.java para iniciar o sistema.

BibliotecaJava/
├── src/
│   ├── aplication/
│   │   └── Main.java
│   ├── dao/
│   │   ├── EbookDao.java
│   │   ├── GeneroDao.java
│   │   └── LivFisDao.java
│   ├── model/
│   │   ├── Ebook.java
│   │   ├── Genero.java
│   │   ├── Livro.java
│   │   └── LivroFisico.java
│   └── config/
│       └── Conexao.java
├── banco.sql
└── [README.md](http://_vscodecontentref_/0)

Adapte o nome do banco, arquivos e o link do repositório conforme necessário!
