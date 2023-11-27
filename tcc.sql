-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/11/2023 às 00:40
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentario`
--

CREATE TABLE `comentario` (
  `id` int(5) NOT NULL,
  `comentario` mediumtext NOT NULL,
  `id_usuario_comentario` int(5) NOT NULL,
  `id_ticket_comentario` int(5) NOT NULL,
  `datainsert` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentario`
--

INSERT INTO `comentario` (`id`, `comentario`, `id_usuario_comentario`, `id_ticket_comentario`, `datainsert`) VALUES
(1, 'RESOLVIDO!', 1, 9, '2023-11-27 19:54:14'),
(6, 'Espere um momentinho!', 1, 26, '2023-11-27 19:59:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(5) NOT NULL,
  `razao_social` varchar(50) NOT NULL,
  `empresa` varchar(50) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `razao_social`, `empresa`, `cnpj`, `ativo`, `data`) VALUES
(1, 'Etec Professor Jadyr Salles', 'TCC', '12312312312312', 1, '2022-09-08 20:42:30'),
(9, 'Porto Brasil', 'Porto Brasil', '25435723647234', 1, '2022-10-24 17:36:43'),
(10, 'Aquário', 'Aquário Petshop', '12354325345325', 1, '2022-10-25 17:56:06'),
(30, 'Ideal', 'Papelaria Ideal', '12321435436543', 1, '2022-11-07 14:22:15'),
(31, 'Vidro Porto', 'Vidro Porto', '31254523452345', 1, '2022-11-10 17:52:02');

-- --------------------------------------------------------

--
-- Estrutura para tabela `nivel`
--

CREATE TABLE `nivel` (
  `id` int(5) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `nivel`
--

INSERT INTO `nivel` (`id`, `descricao`, `ativo`) VALUES
(1, 'ADM', 1),
(2, 'Cliente', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `prioridade`
--

CREATE TABLE `prioridade` (
  `id` int(5) NOT NULL,
  `prioridade` varchar(15) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `prioridade`
--

INSERT INTO `prioridade` (`id`, `prioridade`, `ativo`) VALUES
(1, 'Alta', 1),
(2, 'Média', 1),
(3, 'Baixa', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `status`
--

CREATE TABLE `status` (
  `id` int(5) NOT NULL,
  `status` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `status`
--

INSERT INTO `status` (`id`, `status`, `ativo`) VALUES
(1, 'Em aguardo', 1),
(2, 'Resolvido', 1),
(3, 'Aberto', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `subtopico`
--

CREATE TABLE `subtopico` (
  `id` int(5) NOT NULL,
  `subtopico` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `id_topico` int(5) NOT NULL,
  `id_prioridade` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `subtopico`
--

INSERT INTO `subtopico` (`id`, `subtopico`, `ativo`, `id_topico`, `id_prioridade`) VALUES
(9, 'NF-e', 1, 5, 1),
(10, 'Cadastro', 1, 6, 1),
(11, 'Fechamento', 1, 8, 2),
(12, 'Outros(Digite no Titulo)', 1, 7, 1),
(13, 'Finalizar Pedido', 1, 7, 1),
(14, 'Impressão', 1, 5, 1),
(15, 'Problema ao fechar pedido', 1, 6, 1),
(16, 'Documentos', 1, 5, 1),
(17, 'Formulario', 1, 6, 3),
(18, 'Debito', 1, 11, 1),
(19, 'Credito', 1, 11, 1),
(20, 'Enter não funciona ', 1, 12, 3),
(26, 'Pix', 1, 13, 1),
(27, 'Transferência Bancaria', 1, 13, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int(5) NOT NULL,
  `id_topico_ticket` int(5) NOT NULL,
  `id_subtopico` int(5) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `detalhes` varchar(500) NOT NULL,
  `id_empresa_ticket` int(5) NOT NULL,
  `id_usuario` int(5) NOT NULL,
  `data_abertura` datetime NOT NULL,
  `data_encerramento` datetime DEFAULT NULL,
  `id_prioridade_ticket` int(5) NOT NULL,
  `id_status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `id_topico_ticket`, `id_subtopico`, `titulo`, `detalhes`, `id_empresa_ticket`, `id_usuario`, `data_abertura`, `data_encerramento`, `id_prioridade_ticket`, `id_status`) VALUES
(9, 5, 9, 'Esse NF-E não vai', 'Ta dando o erro 413 o que eu faço pra resolver esse problema?', 1, 3, '2022-10-15 16:02:47', NULL, 1, 2),
(26, 5, 14, 'Deu problema', 'Deu problema na impressão do trem aqui ', 10, 1, '2022-11-07 14:17:33', NULL, 1, 3),
(27, 11, 19, 'A opcao credito nao esta funcionando', 'blablablablabla', 30, 1, '2023-11-27 20:00:13', NULL, 1, 3),
(28, 5, 9, 'Nao emite a NF-E', 'Quando clico na opcao emitir NF-E nao esta funcionando esta dando o erro 1321', 9, 3, '2023-11-27 20:36:54', NULL, 1, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `topico`
--

CREATE TABLE `topico` (
  `id` int(5) NOT NULL,
  `topico` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `topico`
--

INSERT INTO `topico` (`id`, `topico`, `ativo`) VALUES
(5, 'Emissão', 1),
(6, 'Salvamento', 1),
(7, 'Outros', 0),
(8, 'Erro', 1),
(11, 'Cartão', 1),
(12, 'Teclado', 1),
(13, 'Pagamento', 1),
(15, 'Ligação', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(5) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `email` varchar(265) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `id_empresa_usuario` int(5) NOT NULL,
  `ativo_user` tinyint(1) NOT NULL,
  `data_criacao_user` datetime NOT NULL,
  `id_nivel` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_user`, `nome`, `email`, `senha`, `id_empresa_usuario`, `ativo_user`, `data_criacao_user`, `id_nivel`) VALUES
(1, 'admin', 'admin@email.com', 'admin', 1, 1, '2022-09-08 20:46:38', 1),
(2, 'Luana Peripato', 'luana@email.com', '123', 1, 1, '2022-09-08 23:37:30', 1),
(3, 'Adilson', 'adilson@email.com', '12345678', 9, 1, '2022-09-26 20:28:35', 2),
(5, 'Jader Ruivo', 'jader@email.com', '12345678', 10, 1, '2022-10-24 17:37:34', 1),
(6, 'Pedro', 'pedro@email.com', '12345678', 30, 1, '2022-10-25 20:58:35', 1),
(7, 'Lucas Pirondi', 'lucas@email.com', '12345678', 31, 1, '2022-11-07 14:44:43', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ticket_comentario` (`id_ticket_comentario`),
  ADD KEY `id_usuario_comentario` (`id_usuario_comentario`);

--
-- Índices de tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices de tabela `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `prioridade`
--
ALTER TABLE `prioridade`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `subtopico`
--
ALTER TABLE `subtopico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_topico` (`id_topico`),
  ADD KEY `id_prioridade` (`id_prioridade`);

--
-- Índices de tabela `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `id_subtopico` (`id_subtopico`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_topico_ticket` (`id_topico_ticket`),
  ADD KEY `id_empresa_ticket` (`id_empresa_ticket`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_prioridade_ticket` (`id_prioridade_ticket`);

--
-- Índices de tabela `topico`
--
ALTER TABLE `topico`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_nivel` (`id_nivel`),
  ADD KEY `id_empresa_usuario` (`id_empresa_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `nivel`
--
ALTER TABLE `nivel`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `prioridade`
--
ALTER TABLE `prioridade`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `subtopico`
--
ALTER TABLE `subtopico`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `topico`
--
ALTER TABLE `topico`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `id_ticket_comentario` FOREIGN KEY (`id_ticket_comentario`) REFERENCES `ticket` (`id_ticket`),
  ADD CONSTRAINT `id_usuario_comentario` FOREIGN KEY (`id_usuario_comentario`) REFERENCES `usuario` (`id_user`);

--
-- Restrições para tabelas `subtopico`
--
ALTER TABLE `subtopico`
  ADD CONSTRAINT `id_prioridade` FOREIGN KEY (`id_prioridade`) REFERENCES `prioridade` (`id`),
  ADD CONSTRAINT `id_topico` FOREIGN KEY (`id_topico`) REFERENCES `topico` (`id`);

--
-- Restrições para tabelas `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `id_empresa_ticket` FOREIGN KEY (`id_empresa_ticket`) REFERENCES `empresa` (`id_empresa`),
  ADD CONSTRAINT `id_prioridade_ticket` FOREIGN KEY (`id_prioridade_ticket`) REFERENCES `prioridade` (`id`),
  ADD CONSTRAINT `id_status` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `id_subtopico` FOREIGN KEY (`id_subtopico`) REFERENCES `subtopico` (`id`),
  ADD CONSTRAINT `id_topico_ticket` FOREIGN KEY (`id_topico_ticket`) REFERENCES `topico` (`id`),
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_user`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `id_empresa_usuario` FOREIGN KEY (`id_empresa_usuario`) REFERENCES `empresa` (`id_empresa`),
  ADD CONSTRAINT `id_nivel` FOREIGN KEY (`id_nivel`) REFERENCES `nivel` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
