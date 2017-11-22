-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12-Nov-2017 às 22:52
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `restaurante`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nm_cliente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nr_cracha` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa` int(10) unsigned NOT NULL,
  `nr_cep` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `nr_casa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ds_complemento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dt_cadastro` date NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sn_senha_atual` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clientes_empresa_foreign` (`empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ds_empresa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empresas_ds_empresa_unique` (`ds_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fones`
--

CREATE TABLE IF NOT EXISTS `fones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente` int(10) unsigned NOT NULL,
  `nr_fone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tp_fone` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `obs_fone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fones_cliente_foreign` (`cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ds_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vl_item` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_11_12_201534_create_empresas_table', 1),
('2017_11_12_201633_create_items_table', 1),
('2017_11_12_201929_create_clientes_table', 1),
('2017_11_12_202731_create_fones_table', 1),
('2017_11_12_203011_create_registros_table', 1),
('2017_11_12_203826_create_pgto_clientes_table', 1),
('2017_11_12_204357_CreateTrigger', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pgto_clientes`
--

CREATE TABLE IF NOT EXISTS `pgto_clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `registro` int(10) unsigned NOT NULL,
  `dt_pgto` date NOT NULL,
  `nr_valor` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pgto_clientes_registro_foreign` (`registro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `registros`
--

CREATE TABLE IF NOT EXISTS `registros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente` int(10) unsigned NOT NULL,
  `item` int(10) unsigned NOT NULL,
  `vl_preco` decimal(10,2) NOT NULL,
  `dt_registro` date NOT NULL,
  `sn_pago` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `qt_compra` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Acionadores `registros`
--
DROP TRIGGER IF EXISTS `trg_insert_pay`;
DELIMITER //
CREATE TRIGGER `trg_insert_pay` AFTER UPDATE ON `registros`
 FOR EACH ROW BEGIN

                           INSERT INTO pgto_clientes VALUES (NULL, NEW.id, NOW(), NEW.vl_preco );
                      END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sn_ativo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `sn_senha_atual` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `sn_ativo`, `sn_senha_atual`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Carlos', 'cbcarlos08@gmail.com', '$2y$10$OXEbl9rb.l4.2PkWMXmkc.vWWDL.MZexTuyiNUP8jemqcvNWri6T.', 'S', 'S', 'oldkmlUw5RvJ6BGbgbtXz2xU1BGzsYF6wG5uOreZqaBLd1HjhKzmrJAT3kfZ', '2017-11-13 01:05:57', '2017-11-13 01:33:27');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_empresa_foreign` FOREIGN KEY (`empresa`) REFERENCES `empresas` (`id`);

--
-- Limitadores para a tabela `fones`
--
ALTER TABLE `fones`
  ADD CONSTRAINT `fones_cliente_foreign` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id`);

--
-- Limitadores para a tabela `pgto_clientes`
--
ALTER TABLE `pgto_clientes`
  ADD CONSTRAINT `pgto_clientes_registro_foreign` FOREIGN KEY (`registro`) REFERENCES `registros` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
