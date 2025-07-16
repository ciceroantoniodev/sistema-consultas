-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 16/07/2025 às 15:09
-- Versão do servidor: 8.0.41
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_consultas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda`
--

DROP TABLE IF EXISTS `agenda`;
CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NOT NULL,
  `id_profissional` int NOT NULL,
  `data_agendamento` date NOT NULL,
  `hora_agendamento` time NOT NULL,
  `tipo_agendamento` varchar(30) COLLATE utf8mb3_unicode_ci NOT NULL,
  `obs` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data_cad` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `agenda`
--

INSERT INTO `agenda` (`id`, `id_paciente`, `id_profissional`, `data_agendamento`, `hora_agendamento`, `tipo_agendamento`, `obs`, `status`, `data_cad`) VALUES
(1, 1, 1, '2025-07-04', '13:00:00', 'coleta', 'Agendamento finalizado.', 'atendido', '2025-07-02 19:54:27'),
(2, 2, 0, '1969-12-31', '21:00:00', '', 'Paciente precisa se vacinar contra a gripe.', 'aberto', '2025-07-03 01:02:35'),
(3, 4, 2, '2025-07-17', '09:30:00', 'procedimento', 'Obs.', 'aberto', '2025-07-04 21:21:31'),
(4, 2, 2, '2025-07-16', '11:30:00', 'telemedicina', 'Consulta.', 'cancelado', '2025-07-16 11:33:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
CREATE TABLE IF NOT EXISTS `especialidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `especialidade` varchar(30) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data_cad` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `especialidades`
--

INSERT INTO `especialidades` (`id`, `especialidade`, `status`, `data_cad`) VALUES
(1, 'Clínica Médica', '', '2025-07-01 23:47:18'),
(2, 'Pediatria', '', '2025-07-01 23:47:37'),
(3, 'Ginecologia e Obstetrícia', '', '2025-07-01 23:47:48'),
(4, 'Cirurgia Geral', '', '2025-07-01 23:48:02'),
(5, 'Cardiologia', '', '2025-07-01 23:48:13'),
(6, 'Ortopedia', '', '2025-07-01 23:48:22'),
(7, 'Dermatologia', '', '2025-07-01 23:48:35'),
(8, 'Psiquiatria', '', '2025-07-01 23:48:44'),
(9, 'Anestesiologia', '', '2025-07-01 23:49:02'),
(10, 'Medicina do Trabalho', '', '2025-07-01 23:49:14'),
(11, 'Gastroenterologia', '', '2025-07-04 15:10:17');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` char(1) COLLATE utf8mb3_unicode_ci NOT NULL,
  `cpf` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `rg` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `nome_mae` varchar(60) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nome_pai` varchar(60) COLLATE utf8mb3_unicode_ci NOT NULL,
  `endereco` varchar(80) COLLATE utf8mb3_unicode_ci NOT NULL,
  `bairro` varchar(30) COLLATE utf8mb3_unicode_ci NOT NULL,
  `cidade` varchar(30) COLLATE utf8mb3_unicode_ci NOT NULL,
  `estado` varchar(2) COLLATE utf8mb3_unicode_ci NOT NULL,
  `cep` varchar(11) COLLATE utf8mb3_unicode_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data_cad` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `nome`, `data_nascimento`, `sexo`, `cpf`, `rg`, `nome_mae`, `nome_pai`, `endereco`, `bairro`, `cidade`, `estado`, `cep`, `telefone`, `status`, `data_cad`) VALUES
(1, 'Julio Julio da Mota', '1975-10-08', 'M', '08934533072', '360589066', 'Isabelly Regina Malu', 'Noah Pietro da Mota', 'Quadra Dezesete', 'Nova Marabá', 'Marabá', 'PA', '68508415', '(94) 2751-9283', '', '2025-06-30 21:55:46'),
(2, 'Talita Raquel R Silva', '2000-08-16', 'F', '12345678910', '65656 SSP-BA', 'Sophia Rayssa', 'Danilo Augusto Nascimento', 'Rua Pedro de Góis da Silva', 'Jardim Cotinha', 'Petrolina', 'PE', '56300000', '87-99865-3254', '', '2025-07-03 00:59:05'),
(3, 'Agatha Fátima Isis dos Santos', '2005-01-01', 'F', '55153916162', '262458603', 'Sarah Sabrina Aurora', 'Nicolas Pedro dos Santos', 'Rua Ferdinando Rosa', 'Petrópolis', 'Caxias do Sul', 'RS', '773', '(54) 2849-4439', '', '2025-07-04 15:52:45'),
(4, 'Davi Ryan Costa', '1999-05-15', 'M', '99193309228', '161522488', 'Carolina Catarina Antônia', 'André Mateus Costa', 'Avenida Celestino Pinheiro', 'Nova Esperança', 'Macapá', 'AP', '68901660', '(96) 98142-1056', '', '2025-07-04 15:57:25');

-- --------------------------------------------------------

--
-- Estrutura para tabela `profissionais`
--

DROP TABLE IF EXISTS `profissionais`;
CREATE TABLE IF NOT EXISTS `profissionais` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_especialidade` int NOT NULL,
  `nome` varchar(60) COLLATE utf8mb3_unicode_ci NOT NULL,
  `sexo` char(1) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `documento_tipo` varchar(5) COLLATE utf8mb3_unicode_ci NOT NULL,
  `documento_numero` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data_cad` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `profissionais`
--

INSERT INTO `profissionais` (`id`, `id_especialidade`, `nome`, `sexo`, `data_nascimento`, `documento_tipo`, `documento_numero`, `status`, `data_cad`) VALUES
(1, 5, 'Marciliano Carlos Medeiro', 'M', '1975-03-01', 'CRM', '9283', '', '2025-07-02 00:23:07'),
(2, 3, 'Bruna Sebastiana Melissa das Neves', 'F', '1990-08-01', 'CRM', '456434', '', '2025-07-04 16:29:10'),
(3, 1, 'Joaquim Renan Sérgio Aragão', 'M', '1988-06-13', 'CRM', '83556', '', '2025-07-04 16:31:53');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) COLLATE utf8mb3_unicode_ci NOT NULL,
  `usuario` varchar(30) COLLATE utf8mb3_unicode_ci NOT NULL,
  `senha` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `adm` char(1) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ativo` char(1) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data_cad` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha`, `adm`, `ativo`, `data_cad`) VALUES
(1, 'Cícero Administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'S', 'S', '2025-06-30 17:11:00'),
(2, 'Talita Raquel R Silva', 'talita', 'e10adc3949ba59abbe56e057f20f883e', 'N', 'S', '2025-07-04 13:34:24'),
(3, 'Marcos Lemuel', 'marcos', 'e10adc3949ba59abbe56e057f20f883e', 'N', 'S', '2025-07-04 13:46:31');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
