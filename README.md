# A3 da matéria Gestão e Qualidade de software com os professores Henrique Poyatos e Magda no semestre 1/2025

### Integrantes do projeto

- Arthur Lucas Evangelista Machado - RA 324146950
- Cicera Quaresma da Silva – RA 12524150398
- Iago Luiz Simplicio Serra - RA 1272320678
- Joyce Mendonça Paixão - RA 323212772
- Bruno Almeida Vilela - RA 323124929
- Ronildo Santos da Silva – RA 823226546
- Renato Pereira - RA 322441099

# Biblioteca Java - CRUD com POO e MySQL

## Sobre o Projeto

Este projeto é um sistema de gerenciamento de biblioteca pessoal desenvolvido em **Java** utilizando o paradigma de **Programação Orientada a Objetos (POO)** e integração com banco de dados **MySQL**. O sistema permite cadastrar, listar, editar e excluir gêneros, livros físicos e e-books, demonstrando conceitos como herança, polimorfismo, encapsulamento e uso de DAO para persistência.

O projeto foi criado como exercício acadêmico para aplicar conhecimentos básicos em linguagem e lógica de programação.

---

## Funcionalidades

- Cadastro, listagem e exclusão de gêneros literários
- Cadastro, listagem, edição e exclusão de livros físicos e e-books
- Interface via JOptionPane para interação com o usuário

---

## Pré-requisitos

- [Java JDK 8+](https://www.oracle.com/java/technologies/downloads/)
- [Eclipse](https://www.eclipse.org/) ou outra IDE Java
- [XAMPP](https://www.apachefriends.org/pt_br/index.html) ou outro servidor local com suporte a PHP e MySQL
- [MySQL-conector](https://dev.mysql.com/downloads/connector/j/)

---

## Instalação e Execução

1. <u>**Clone o repositório**:</u> (caso já tenha feito, pule para a próxima etapa)
   ```bash
   git clone  https://github.com/Arthur-Lukas/A3-GQS.git 

2. **Abra o XAMPP**: inicialize o apache e o MySQL, e clique no admin do MySQL. OBS: toda vez que for executar o projeto tem que deixar ligado o apache e o MySQL.

3. **Crie o banco de dados**: crie um banco de dados e coloque o nome de "db_biblioteca" na página do MySQL. (caso já tenha feito, pule para a próxima etapa). Depois
importe o arquivo db_biblioteca que está na pasta script.sql.

4. **Configure a conexão JDBC**:
Baixe o driver mysql_conector e adicione ao classpath/libraries do projeto.

5. **Inclua o conector no classpath**:
No arquivo de factory/Conexao.java, ajuste as variáveis de conexão (host, database, user, password) conforme seu ambiente.

6. **Execute**:
Execute a classe Main.java para iniciar o sistema.

---

## Licença

Este projeto é livre para fins acadêmicos e de aprendizado.

