-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/06/2024 às 14:36
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ebooks`
--

CREATE TABLE `ebooks` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `lancamento` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `paginas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ebooks`
--

INSERT INTO `ebooks` (`id`, `titulo`, `autor`, `lancamento`, `id_genero`, `paginas`) VALUES
(1, 'A arte da guerra', 'Sun Tzu', -500, 4, 100),
(2, 'O pequeno príncipe', 'Antoine de Saint-Exupéry', 1943, 1, 100),
(3, 'Dom Casmurro', 'Machado de Assis', 1899, 1, 100),
(4, 'O livro dos espíritos', 'Allan Kardec', 1857, 4, 100),
(5, 'O homem mais rico da Babilônia', 'George S. Clason', 1926, 8, 100),
(6, 'A revolução dos bichos', 'George Orwell', 1945, 5, 100),
(7, 'O código da Vinci', 'Dan Brown', 2003, 5, 100),
(8, 'A cabana', 'William P. Young', 2007, 4, 100),
(9, 'A culpa é das estrelas', 'John Green', 2012, 1, NULL),
(10, 'Harry Potter e a Pedra Filosofal', 'J.K. Rowling', 1997, 3, 223),
(11, 'O Hobbit', 'J.R.R. Tolkien', 1937, 3, 310),
(12, 'Orgulho e Preconceito', 'Jane Austen', 1813, 1, 279),
(13, 'O Senhor das Moscas', 'William Golding', 1954, 9, 224),
(14, 'O Diário de Anne Frank', 'Anne Frank', 1947, 11, 283)

-- --------------------------------------------------------

--
-- Estrutura para tabela `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `genero`
--

INSERT INTO `genero` (`id`, `nome`) VALUES
(1, 'Romance'),
(2, 'Terror'),
(3, 'Aventura'),
(4, 'Religioso'),
(5, 'Investigativo'),
(6, 'Fábula'),
(7, 'Clássico'),
(8, 'Auto-ajuda'),
(9, 'Ficção'),
(10, 'Literatura Brasileira'),
(11, 'Literatura Estrangeira'),
(12, 'Espiritualidade'),
(13, 'Ficcao cientifica');

-- --------------------------------------------------------

--
-- Estrutura para tabela `livrosfisicos`
--

CREATE TABLE `livrosfisicos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `lancamento` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `preco` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livrosfisicos`
--

INSERT INTO `livrosfisicos` (`id`, `titulo`, `autor`, `lancamento`, `id_genero`, `preco`) VALUES
(1, 'Bíblia', 'Jesus', -2000, 4, NULL),
(2, 'Sherlock Holmes', 'Arthur Conan Doyle', 1887, 3, NULL),
(5, 'Viagem ao centro da terra', 'Julio Verne', 1864, 3, NULL),
(6, 'O Alquimista', 'Paulo Coelho', 1988, 1, 39.90),
(7, '1984', 'George Orwell', 1949, 9, 45.00),
(8, 'O Senhor dos Anéis', 'J.R.R. Tolkien', 1954, 3, 120.00),
(9, 'Dom Quixote', 'Miguel de Cervantes', 1605, 7, 59.90),
(10, 'Capitães da Areia', 'Jorge Amado', 1937, 10, 34.50);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Índices de tabela `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `livrosfisicos`
--
ALTER TABLE `livrosfisicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_genero` (`id_genero`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `livrosfisicos`
--
ALTER TABLE `livrosfisicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `livrosfisicos`
--
ALTER TABLE `livrosfisicos`
  ADD CONSTRAINT `livrosfisicos_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
