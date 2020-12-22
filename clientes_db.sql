-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Dez-2020 às 01:06
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clientes_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairros`
--

CREATE TABLE `bairros` (
  `Id` int(11) NOT NULL,
  `bairro` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bairros`
--

INSERT INTO `bairros` (`Id`, `bairro`) VALUES
(1, 'Água Fria'),
(2, 'Aeroclube'),
(3, 'Altiplano'),
(4, 'Alto do Céu'),
(5, 'Alto do Mateus'),
(6, 'Anatólia'),
(7, 'Bairro das Indústrias'),
(8, 'Bairro dos Estados '),
(9, 'Bairro dos Ipês'),
(10, 'Bairro dos Novais'),
(11, 'Bancários'),
(12, 'Barra de Gramame'),
(13, 'Bessa 	Leste'),
(14, 'Jardim Brisamar'),
(15, 'Cabo Branco'),
(16, 'Castelo Branco'),
(17, 'Centro'),
(18, 'Cidade dos Colibris'),
(19, 'Costa do Sol'),
(20, 'Costa e Silva'),
(21, 'Cristo Redentor'),
(22, 'Cruz das Armas'),
(23, 'Cuiá'),
(24, 'Distrito Industrial'),
(25, 'Ernesto Geisel'),
(26, 'Ernâni Sátiro'),
(27, 'Expedicionários'),
(28, 'Funcionários II'),
(29, 'Funcionários III'),
(30, 'Gramame'),
(31, 'Grotão Sul'),
(32, 'Ilha do Bispo'),
(33, 'Jaguaribe'),
(34, 'Jardim 13 de Maio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `Id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `bairro` varchar(200) DEFAULT NULL,
  `rua` varchar(200) DEFAULT NULL,
  `numero` varchar(200) DEFAULT NULL,
  `cidade` varchar(200) DEFAULT NULL,
  `estado` varchar(200) DEFAULT NULL,
  `endereco` text NOT NULL,
  `cep` varchar(200) DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`Id`, `nome`, `telefone`, `bairro`, `rua`, `numero`, `cidade`, `estado`, `endereco`, `cep`, `foto`) VALUES
(68, 'Larissa', '(55)55646-4654', '11', 'Rua Alexandrina Joventina da Silva', '56', 'Jo?o Pessoa', 'PB', 'Rua Rua Alexandrina Joventina da Silva nº 56, 11 - Jo?o Pessoa, PB', '', NULL),
(69, 'Chelli', '(55)55646-4654', '2', 'algumaai', '56', 'Joao Pessoa', 'PB', 'Rua algumaai nº 56, 2 - Joao Pessoa, PB', NULL, NULL),
(70, 'Vitoria', '(00)00000-0000', '4', 'Albatroz', '56', 'Joao Pessoa', 'PB', 'Rua Albatroz nº 56, 4 - Joao Pessoa, PB', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `Id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `descricao_pedido` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `valor` varchar(10) NOT NULL,
  `data_pedido` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`Id`, `id_cliente`, `descricao_pedido`, `status`, `valor`, `data_pedido`) VALUES
(5, 69, 'Pacote de Cookies 1', 4, '15.90', '2020-12-02 00:00:00'),
(6, 68, 'Pacote de Cookies 2', 1, '8.90', '2020-11-10 00:00:00'),
(7, 70, 'Pacote de Cookies 3', 1, '4.50', '2021-02-23 00:00:00'),
(8, 70, 'Pacote de Cookies 4', 1, '50.00', '2020-12-22 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `Id` int(11) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`Id`, `status`) VALUES
(1, 'Em aprovação'),
(2, 'Aprovado'),
(3, 'Reprovado'),
(4, 'Em separação'),
(5, 'Enviado'),
(6, 'Entregue');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bairros`
--
ALTER TABLE `bairros`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bairros`
--
ALTER TABLE `bairros`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
