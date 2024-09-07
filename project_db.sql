-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/09/2024 às 22:49
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
-- Banco de dados: `project_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_email`, `admin_name`, `admin_password`) VALUES
(1, 'admin@shop.com.br', 'admin', '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Estrutura para tabela `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `shipping_city` varchar(255) DEFAULT NULL,
  `shipping_uf` varchar(2) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `shipping_city`, `shipping_uf`, `shipping_address`, `order_date`) VALUES
(41, 99.99, 'on_hold', 1, 'São Paulo', 'SP', 'Rua A, 123', '2024-09-06 14:27:53'),
(42, 149.50, 'paid', 2, 'Rio de Janeiro', 'RJ', 'Rua B, 456', '2024-09-06 14:27:53'),
(43, 79.99, 'shipped', 3, 'Belo Horizonte', 'MG', 'Rua C, 789', '2024-09-06 14:27:53'),
(44, 120.00, 'delivered', 4, 'Porto Alegre', 'RS', 'Rua D, 101', '2024-09-06 14:27:53'),
(45, 85.00, 'on_hold', 5, 'Curitiba', 'PR', 'Rua E, 202', '2024-09-06 14:27:53'),
(46, 200.00, 'paid', 6, 'Fortaleza', 'CE', 'Rua F, 303', '2024-09-06 14:27:53'),
(47, 55.00, 'shipped', 7, 'Salvador', 'BA', 'Rua G, 404', '2024-09-06 14:27:53'),
(48, 70.00, 'delivered', 8, 'Recife', 'PE', 'Rua H, 505', '2024-09-06 14:27:53'),
(49, 95.00, 'on_hold', 9, 'Manaus', 'AM', 'Rua I, 606', '2024-09-06 14:27:53'),
(50, 110.00, 'paid', 10, 'Brasília', 'DF', 'Rua J, 707', '2024-09-06 14:27:53'),
(51, 130.00, 'shipped', 1, 'Natal', 'RN', 'Rua K, 808', '2024-09-06 14:27:53'),
(52, 140.00, 'delivered', 2, 'São Luís', 'MA', 'Rua L, 909', '2024-09-06 14:27:53'),
(53, 175.00, 'on_hold', 3, 'Belém', 'PA', 'Rua M, 1010', '2024-09-06 14:27:53'),
(54, 65.00, 'paid', 4, 'João Pessoa', 'PB', 'Rua N, 1111', '2024-09-06 14:27:53'),
(55, 90.00, 'shipped', 5, 'Aracaju', 'SE', 'Rua O, 1212', '2024-09-06 14:27:53'),
(56, 80.00, 'delivered', 6, 'Teresina', 'PI', 'Rua P, 1313', '2024-09-06 14:27:53'),
(57, 105.00, 'on_hold', 7, 'Goiânia', 'GO', 'Rua Q, 1414', '2024-09-06 14:27:53'),
(58, 115.00, 'paid', 8, 'Maceió', 'AL', 'Rua R, 1515', '2024-09-06 14:27:53'),
(59, 60.00, 'shipped', 9, 'Campo Grande', 'MS', 'Rua S, 1616', '2024-09-06 14:27:53'),
(60, 50.00, 'delivered', 10, 'Vitória', 'ES', 'Rua T, 1717', '2024-09-06 14:27:53'),
(61, 99.99, 'on_hold', 1, 'São Paulo', 'SP', 'Rua A, 123', '2024-09-06 14:34:35'),
(62, 149.50, 'paid', 2, 'Rio de Janeiro', 'RJ', 'Rua B, 456', '2024-09-06 14:34:35'),
(63, 79.99, 'shipped', 3, 'Belo Horizonte', 'MG', 'Rua C, 789', '2024-09-06 14:34:35'),
(64, 120.00, 'delivered', 4, 'Porto Alegre', 'RS', 'Rua D, 101', '2024-09-06 14:34:35'),
(65, 85.00, 'on_hold', 5, 'Curitiba', 'PR', 'Rua E, 202', '2024-09-06 14:34:35'),
(66, 200.00, 'paid', 6, 'Fortaleza', 'CE', 'Rua F, 303', '2024-09-06 14:34:35'),
(67, 55.00, 'shipped', 7, 'Salvador', 'BA', 'Rua G, 404', '2024-09-06 14:34:35'),
(68, 70.00, 'delivered', 8, 'Recife', 'PE', 'Rua H, 505', '2024-09-06 14:34:35'),
(69, 95.00, 'on_hold', 9, 'Manaus', 'AM', 'Rua I, 606', '2024-09-06 14:34:35'),
(70, 110.00, 'paid', 10, 'Brasília', 'DF', 'Rua J, 707', '2024-09-06 14:34:35'),
(71, 130.00, 'shipped', 1, 'Natal', 'RN', 'Rua K, 808', '2024-09-06 14:34:35'),
(72, 140.00, 'delivered', 2, 'São Luís', 'MA', 'Rua L, 909', '2024-09-06 14:34:35'),
(73, 175.00, 'on_hold', 3, 'Belém', 'PA', 'Rua M, 1010', '2024-09-06 14:34:35'),
(74, 65.00, 'paid', 4, 'João Pessoa', 'PB', 'Rua N, 1111', '2024-09-06 14:34:35'),
(75, 90.00, 'shipped', 5, 'Aracaju', 'SE', 'Rua O, 1212', '2024-09-06 14:34:35'),
(76, 80.00, 'delivered', 6, 'Teresina', 'PI', 'Rua P, 1313', '2024-09-06 14:34:35'),
(77, 105.00, 'on_hold', 7, 'Goiânia', 'GO', 'Rua Q, 1414', '2024-09-06 14:34:35'),
(78, 115.00, 'paid', 8, 'Maceió', 'AL', 'Rua R, 1515', '2024-09-06 14:34:35'),
(79, 60.00, 'shipped', 9, 'Campo Grande', 'MS', 'Rua S, 1616', '2024-09-06 14:34:35'),
(80, 50.00, 'delivered', 10, 'Vitória', 'ES', 'Rua T, 1717', '2024-09-06 14:34:35'),
(81, 99.99, 'on_hold', 1, 'São Paulo', 'SP', 'Rua A, 123', '2024-09-06 14:34:39'),
(82, 149.50, 'paid', 2, 'Rio de Janeiro', 'RJ', 'Rua B, 456', '2024-09-06 14:34:39'),
(83, 79.99, 'shipped', 3, 'Belo Horizonte', 'MG', 'Rua C, 789', '2024-09-06 14:34:39'),
(84, 120.00, 'delivered', 4, 'Porto Alegre', 'RS', 'Rua D, 101', '2024-09-06 14:34:39'),
(85, 85.00, 'on_hold', 5, 'Curitiba', 'PR', 'Rua E, 202', '2024-09-06 14:34:39'),
(86, 200.00, 'paid', 6, 'Fortaleza', 'CE', 'Rua F, 303', '2024-09-06 14:34:39'),
(87, 55.00, 'shipped', 7, 'Salvador', 'BA', 'Rua G, 404', '2024-09-06 14:34:39'),
(88, 70.00, 'delivered', 8, 'Recife', 'PE', 'Rua H, 505', '2024-09-06 14:34:39'),
(89, 95.00, 'on_hold', 9, 'Manaus', 'AM', 'Rua I, 606', '2024-09-06 14:34:39'),
(90, 110.00, 'paid', 10, 'Brasília', 'DF', 'Rua J, 707', '2024-09-06 14:34:39'),
(91, 130.00, 'shipped', 1, 'Natal', 'RN', 'Rua K, 808', '2024-09-06 14:34:39'),
(92, 140.00, 'delivered', 2, 'São Luís', 'MA', 'Rua L, 909', '2024-09-06 14:34:39'),
(93, 175.00, 'on_hold', 3, 'Belém', 'PA', 'Rua M, 1010', '2024-09-06 14:34:39'),
(94, 65.00, 'paid', 4, 'João Pessoa', 'PB', 'Rua N, 1111', '2024-09-06 14:34:39'),
(95, 90.00, 'shipped', 5, 'Aracaju', 'SE', 'Rua O, 1212', '2024-09-06 14:34:39'),
(96, 80.00, 'delivered', 6, 'Teresina', 'PI', 'Rua P, 1313', '2024-09-06 14:34:39'),
(97, 105.00, 'on_hold', 7, 'Goiânia', 'GO', 'Rua Q, 1414', '2024-09-06 14:34:39'),
(98, 115.00, 'paid', 8, 'Maceió', 'AL', 'Rua R, 1515', '2024-09-06 14:34:39'),
(99, 60.00, 'shipped', 9, 'Campo Grande', 'MS', 'Rua S, 1616', '2024-09-06 14:34:39'),
(100, 50.00, 'delivered', 10, 'Vitória', 'ES', 'Rua T, 1717', '2024-09-06 14:34:39'),
(105, 85.00, 'on_hold', 5, 'Curitiba', 'PR', 'Rua E, 202', '2024-09-06 14:34:43'),
(106, 200.00, 'paid', 6, 'Fortaleza', 'CE', 'Rua F, 303', '2024-09-06 14:34:43'),
(107, 55.00, 'shipped', 7, 'Salvador', 'BA', 'Rua G, 404', '2024-09-06 14:34:43'),
(108, 70.00, 'delivered', 8, 'Recife', 'PE', 'Rua H, 505', '2024-09-06 14:34:43'),
(109, 95.00, 'on_hold', 9, 'Manaus', 'AM', 'Rua I, 606', '2024-09-06 14:34:43'),
(110, 110.00, 'paid', 10, 'Brasília', 'DF', 'Rua J, 707', '2024-09-06 14:34:43'),
(111, 130.00, 'shipped', 1, 'Natal', 'RN', 'Rua K, 808', '2024-09-06 14:34:43'),
(112, 140.00, 'delivered', 2, 'São Luís', 'MA', 'Rua L, 909', '2024-09-06 14:34:43'),
(113, 175.00, 'on_hold', 3, 'Belém', 'PA', 'Rua M, 1010', '2024-09-06 14:34:43'),
(114, 65.00, 'paid', 4, 'João Pessoa', 'PB', 'Rua N, 1111', '2024-09-06 14:34:43'),
(115, 90.00, 'shipped', 5, 'Aracaju', 'SE', 'Rua O, 1212', '2024-09-06 14:34:43'),
(116, 80.00, 'delivered', 6, 'Teresina', 'PI', 'Rua P, 1313', '2024-09-06 14:34:43'),
(117, 105.00, 'on_hold', 7, 'Goiânia', 'GO', 'Rua Q, 1414', '2024-09-06 14:34:43'),
(118, 115.00, 'paid', 8, 'Maceió', 'AL', 'Rua R, 1515', '2024-09-06 14:34:43'),
(119, 60.00, 'shipped', 9, 'Campo Grande', 'MS', 'Rua S, 1616', '2024-09-06 14:34:43'),
(120, 50.00, 'delivered', 10, 'Vitória', 'ES', 'Rua T, 1717', '2024-09-06 14:34:43');

-- --------------------------------------------------------

--
-- Estrutura para tabela `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `qnt` int(11) NOT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(250) DEFAULT NULL,
  `product_image` varchar(250) DEFAULT NULL,
  `product_image2` varchar(250) DEFAULT NULL,
  `product_image3` varchar(250) DEFAULT NULL,
  `product_image4` varchar(250) DEFAULT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) DEFAULT NULL,
  `product_color` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(4, 'Fone', '', 'fone de ouvido', NULL, NULL, NULL, NULL, 10.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `product_images`
--

INSERT INTO `product_images` (`image_id`, `product_id`, `image_path`) VALUES
(2, 4, '../uploads/Fone-De-Ouvido-Bluetooth-Qcy-T13-Anc-Cancelamento-de-Ru-do-ativo-Bluetooth-Preto-BH22DT10A_1716301147_g.jpeg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'User 1', 'user1@example.com', 'password_hash'),
(2, 'User 2', 'user2@example.com', 'password_hash'),
(3, 'User 3', 'user3@example.com', 'password_hash'),
(4, 'User 4', 'user4@example.com', 'password_hash'),
(5, 'User 5', 'user5@example.com', 'password_hash'),
(6, 'User 6', 'user6@example.com', 'password_hash'),
(7, 'User 7', 'user7@example.com', 'password_hash'),
(8, 'User 8', 'user8@example.com', 'password_hash'),
(9, 'User 9', 'user9@example.com', 'password_hash'),
(10, 'User 10', 'user10@example.com', 'password_hash');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Índices de tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Índices de tabela `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT de tabela `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Restrições para tabelas `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Restrições para tabelas `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Restrições para tabelas `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
