-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/05/2024 às 18:30
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
-- Banco de dados: `ouvidoria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ombudsman_id` bigint(20) UNSIGNED NOT NULL,
  `attachment` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `email_confirmation`
--

CREATE TABLE `email_confirmation` (
  `id` bigint(20) NOT NULL,
  `session_id` varchar(50) NOT NULL,
  `code_verification` int(6) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ombudsman`
--

CREATE TABLE `ombudsman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(500) NOT NULL,
  `service_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `date_birth` date NOT NULL,
  `email` varchar(150) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `password` varchar(24) NOT NULL,
  `password_confirmation` varchar(256) NOT NULL,
  `city` varchar(100) NOT NULL,
  `fu` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `date_birth`, `email`, `telephone`, `whatsapp`, `password`, `password_confirmation`, `city`, `fu`) VALUES
(42, 'DIOGO JOÃO LOBO', '2005-01-10', 'diogolobo444@gmail.com', '(48) 9961-5841', '(24) 2414-1414', 'ef797c8118f02dfb649607dd', '12345678', 'Aroeiras', 'PB');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ombudsman` (`ombudsman_id`);

--
-- Índices de tabela `email_confirmation`
--
ALTER TABLE `email_confirmation`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ombudsman`
--
ALTER TABLE `ombudsman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `fk_ombudsman` FOREIGN KEY (`ombudsman_id`) REFERENCES `ombudsman` (`id`);

--
-- Restrições para tabelas `ombudsman`
--
ALTER TABLE `ombudsman`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
