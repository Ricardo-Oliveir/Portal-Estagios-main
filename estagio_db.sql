-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/06/2024 às 20:13
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estagio_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `comentario` text NOT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `respondido_por` int(11) DEFAULT NULL,
  `data_resposta` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `usuario_id`, `autor`, `comentario`, `data_envio`, `respondido_por`, `data_resposta`) VALUES
(1, 3, NULL, 'oi poderia verificar meus documentos', '2024-06-21 01:29:24', NULL, NULL),
(6, 3, NULL, 'oi', '2024-06-21 17:29:42', NULL, NULL),
(7, 3, NULL, 'oi Vicente poderia corrigir o documento no item 3', '2024-06-24 16:46:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `curso_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cursos`
--

INSERT INTO `cursos` (`curso_id`, `nome`, `user_id`) VALUES
(1, 'DSM', 4),
(2, 'GPI', NULL),
(3, 'GE', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `status` enum('pendente','aprovado','reprovado') DEFAULT 'pendente',
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `documentos`
--

INSERT INTO `documentos` (`id`, `usuario_id`, `nome`, `arquivo`, `status`, `data_envio`) VALUES
(2, 3, 'Avaliação I - Estrutura de Dados (2022-2).docx', 'PK\0\0\0\0\0!\0\'?0J?\0\0?\n\0\0\0[Content_Types].xml ?(?\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', 'reprovado', '2024-06-21 17:25:53');

-- --------------------------------------------------------

--
-- Estrutura para tabela `relatorio_parcial`
--

CREATE TABLE `relatorio_parcial` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `nomeEmpresa` varchar(255) DEFAULT NULL,
  `nomeSupervisor` varchar(255) DEFAULT NULL,
  `cargoSupervisor` varchar(255) DEFAULT NULL,
  `resposta` text DEFAULT NULL,
  `comentarios_observacoes` text DEFAULT NULL,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `termo`
--

CREATE TABLE `termo` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `concedente` varchar(255) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `nome_representante` varchar(255) DEFAULT NULL,
  `cpf_representante` varchar(14) DEFAULT NULL,
  `nome_estagiario` varchar(255) DEFAULT NULL,
  `rg_estagiario` varchar(20) DEFAULT NULL,
  `endereco_estagiario` varchar(255) DEFAULT NULL,
  `cidade_estagiario` varchar(100) DEFAULT NULL,
  `horario_inicio` varchar(10) DEFAULT NULL,
  `horario_fim` varchar(10) DEFAULT NULL,
  `refeicoes_inicio` varchar(10) DEFAULT NULL,
  `refeicoes_fim` varchar(10) DEFAULT NULL,
  `horas_semanais` int(11) DEFAULT NULL,
  `vigencia_inicio` date DEFAULT NULL,
  `vigencia_fim` date DEFAULT NULL,
  `numero_apolice` varchar(50) DEFAULT NULL,
  `matricula` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `curso` varchar(255) DEFAULT NULL,
  `semestre` varchar(50) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `endereco_concedente` varchar(255) DEFAULT NULL,
  `cargo_supervisor` varchar(255) DEFAULT NULL,
  `telefone_supervisor` varchar(20) DEFAULT NULL,
  `email_representante` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `termo`
--

INSERT INTO `termo` (`id`, `users_id`, `concedente`, `cnpj`, `nome_representante`, `cpf_representante`, `nome_estagiario`, `rg_estagiario`, `endereco_estagiario`, `cidade_estagiario`, `horario_inicio`, `horario_fim`, `refeicoes_inicio`, `refeicoes_fim`, `horas_semanais`, `vigencia_inicio`, `vigencia_fim`, `numero_apolice`, `matricula`, `nome`, `curso`, `semestre`, `endereco`, `bairro`, `telefone`, `cep`, `cidade`, `estado`, `email`, `endereco_concedente`, `cargo_supervisor`, `telefone_supervisor`, `email_representante`) VALUES
(8, 3, 'land', '089912344', 'luiz ricardo de oliveira', '98688', 'Vicente', '1498355', 'Rua Betânia 98', 'jacutinga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13543055', 'Vicente Sartorio', 'dsm', '3', 'Rua Betânia 98', 'Vila Nazaré', '35999175737', '37590-000', 'Jacutinga', 'Jacutinga', 'Vicentesartorio@gmail.com', 'Rua Betânia 98', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `senha`, `email`, `foto`, `role`) VALUES
(2, 'ricardooliveira', '$2y$10$v5HMsCbqp6hNepg.gsrG2OB148.TDHTh72OW3am.Ke4DEzXvYdHGi', '', NULL, 'admin'),
(3, 'Vicente', '$2y$10$2gtMBNdmFkEgk1xNY.2RE.Lmv1oX/uQu8wWaBsuUMV/PexdozC3LK', '', NULL, 'user'),
(4, 'tito', '$2y$10$52HYTKCStSRXVUmOH.6NLujCyD9rAzexN/RBmagu7dlOw2v1s6CwO', '', NULL, 'user');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `respondido_por` (`respondido_por`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`curso_id`);

--
-- Índices de tabela `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `relatorio_parcial`
--
ALTER TABLE `relatorio_parcial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Índices de tabela `termo`
--
ALTER TABLE `termo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `curso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `relatorio_parcial`
--
ALTER TABLE `relatorio_parcial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `termo`
--
ALTER TABLE `termo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`respondido_por`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `relatorio_parcial`
--
ALTER TABLE `relatorio_parcial`
  ADD CONSTRAINT `relatorio_parcial_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `termo`
--
ALTER TABLE `termo`
  ADD CONSTRAINT `termo_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
