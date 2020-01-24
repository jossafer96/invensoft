-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-01-2020 a las 00:43:38
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `invensoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `box`
--

CREATE TABLE `box` (
  `id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `abreviation` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`, `abreviation`, `created_at`) VALUES
(1, 'Equipo Tecnologico', 'ET', '2019-11-22 08:20:20'),
(2, 'Mobiliario', 'MB', '2020-01-08 09:27:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category_id_sub`
--

CREATE TABLE `category_id_sub` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `category_id_sub`
--

INSERT INTO `category_id_sub` (`id`, `name`, `id_category`) VALUES
(1, 'Computadora', 1),
(2, 'Adaptador HDMI', 1),
(3, 'Servidor', 1),
(4, 'Mesa', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `short` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `kind` int(11) NOT NULL,
  `val` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuration`
--

INSERT INTO `configuration` (`id`, `short`, `name`, `kind`, `val`) VALUES
(1, 'company_name', 'Nombre de la empresa', 2, 'ASJ'),
(2, 'title', 'Titulo del Sistema', 2, 'INVENTARIO ASJ'),
(3, 'admin_email', 'Email Administracion', 2, ''),
(4, 'report_image', 'Imagen en Reportes', 4, 'logoASJ.jpg'),
(5, 'imp-name', 'Nombre Impuesto', 2, 'IVS'),
(6, 'imp-val', 'Valor Impuesto (%)', 2, '15'),
(7, 'currency', 'Simbolo de Moneda', 2, 'L.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d`
--

CREATE TABLE `d` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `d`
--

INSERT INTO `d` (`id`, `name`) VALUES
(1, 'Entregado'),
(2, 'Pendiente'),
(3, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `message`
--

INSERT INTO `message` (`id`, `code`, `message`, `user_from`, `user_to`, `is_read`, `created_at`) VALUES
(1, 'hJ7gZdeGuTAza3k', 'Holaaa', 1, 2, 1, '2019-12-05 10:29:26'),
(2, 'hJ7gZdeGuTAza3k', 'Que tal\r\n', 2, 1, 1, '2019-12-05 10:29:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operation`
--

CREATE TABLE `operation` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_operation` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `stock_destination_id` int(11) DEFAULT NULL,
  `description_operation` varchar(100) NOT NULL,
  `q` float NOT NULL,
  `price_in` double DEFAULT NULL,
  `price_out` double DEFAULT NULL,
  `operation_type_id` int(11) DEFAULT NULL,
  `sell_id` int(11) DEFAULT NULL,
  `is_draft` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `operation`
--

INSERT INTO `operation` (`id`, `product_id`, `user_operation`, `stock_id`, `stock_destination_id`, `description_operation`, `q`, `price_in`, `price_out`, `operation_type_id`, `sell_id`, `is_draft`, `created_at`) VALUES
(20, 471, 0, 1, NULL, 'Traspaso de equipo a otro almacen', 1, 120000, 100000, 2, 16, 0, '2019-11-27 10:02:19'),
(21, 471, 0, 2, NULL, 'Traspaso de equipo a otro almacen', 1, 120000, 100000, 1, 16, 0, '2019-11-27 10:02:19'),
(22, 471, 0, 1, NULL, 'Traspaso de equipo a otro almacen', 1, 120000, 100000, 2, 17, 0, '2019-11-27 10:08:35'),
(23, 471, 0, 2, NULL, 'Traspaso de equipo desde otro almacen', 1, 120000, 100000, 1, 17, 0, '2019-11-27 10:08:35'),
(24, 471, 1, 1, NULL, 'Traspaso de equipo a otro almacen', 1, 120000, 100000, 2, 18, 0, '2019-11-27 10:18:34'),
(25, 471, 1, 2, NULL, 'Traspaso de equipo desde otro almacen', 1, 120000, 100000, 1, 18, 0, '2019-11-27 10:18:34'),
(26, 471, 1, 2, NULL, 'Traspaso de equipo a otro almacen', 5, 120000, 100000, 2, 19, 0, '2019-11-27 10:26:31'),
(27, 471, 1, 1, NULL, 'Traspaso de equipo desde otro almacen', 5, 120000, 100000, 1, 19, 0, '2019-11-27 10:26:31'),
(40, 471, 1, 2, NULL, 'Traspaso de equipo hacia almacenAlmacen 1', 3, 120000, 100000, 2, 27, 0, '2019-11-27 15:00:34'),
(41, 471, 1, 1, NULL, 'Traspaso de equipo desde almacen Almacen 1', 3, 120000, 100000, 1, 27, 0, '2019-11-27 15:00:34'),
(42, 471, 1, 1, NULL, 'Traspaso de equipo desde almacen Principal', 4, 120000, 100000, 2, 28, 0, '2019-11-27 15:16:31'),
(43, 471, 1, 2, NULL, 'Traspaso de equipo desde otro almacen', 4, 120000, 100000, 1, 28, 0, '2019-11-27 15:16:31'),
(44, 471, 1, 1, NULL, 'Venta de Equipo/Producto', 1, 120000, 100000, 2, 34, 0, '2019-11-27 15:41:13'),
(47, 237, 1, 1, NULL, 'Venta de Equipo/Producto', 5, 14000, 14000, 2, 39, 0, '2019-11-28 11:56:24'),
(48, 237, 1, 1, NULL, 'Reabastecimiento de equipo Servidor', 2, 14000, 14000, 1, 40, 0, '2019-11-28 11:57:10'),
(49, 471, 1, 1, NULL, 'Venta de Equipo/Producto', 1, 120000, 100000, 2, 41, 0, '2019-11-29 11:05:48'),
(50, 471, 1, 1, NULL, 'Venta de Equipo/Producto', 2, 120000, 100000, 2, 42, 0, '2019-12-02 07:23:11'),
(51, 237, 1, 1, NULL, 'Venta de Equipo/Producto', 2, 14000, 14000, 2, 43, 0, '2019-12-02 11:58:40'),
(52, 237, 1, 1, NULL, 'Reabastecimiento de equipo Servidor', 10, 14000, 14000, 1, 44, 0, '2019-12-04 13:56:37'),
(53, 471, 1, 1, NULL, 'Reabastecimiento de equipo Servidor HP', 5, 120000, 100000, 1, 45, 0, '2019-12-04 13:57:08'),
(54, 237, 1, 1, NULL, 'Asignacion de equipo a Fernando  Padilla', 1, 14000, 14000, 7, NULL, 0, '2019-12-04 14:32:09'),
(55, 237, 1, 1, NULL, 'Asignacion de equipo a Fernando  Padilla', 1, 14000, 14000, 7, NULL, 0, '2020-01-08 09:21:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operation_type`
--

CREATE TABLE `operation_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `operation_type`
--

INSERT INTO `operation_type` (`id`, `name`) VALUES
(1, 'Entrada'),
(2, 'Salida'),
(3, 'Entrada-Pendiente'),
(4, 'Salida-Pendiente'),
(5, 'Devolucion'),
(6, 'Traspaso'),
(7, 'Asignacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `p`
--

CREATE TABLE `p` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `p`
--

INSERT INTO `p` (`id`, `name`) VALUES
(1, 'Pagado'),
(2, 'Pendiente'),
(3, 'Cancelado'),
(4, 'Credito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `sell_id` int(11) DEFAULT NULL,
  `person_id` int(11) NOT NULL,
  `val` double DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_type`
--

CREATE TABLE `payment_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `payment_type`
--

INSERT INTO `payment_type` (`id`, `name`) VALUES
(1, 'Cargo'),
(2, 'Abono');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `no` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `address1` varchar(50) NOT NULL,
  `address2` varchar(50) NOT NULL,
  `phone1` varchar(50) NOT NULL,
  `phone2` varchar(50) NOT NULL,
  `email1` varchar(50) NOT NULL,
  `email2` varchar(50) NOT NULL,
  `is_active_access` tinyint(1) NOT NULL DEFAULT 0,
  `has_credit` tinyint(1) NOT NULL DEFAULT 0,
  `credit_limit` double DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `kind` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `person`
--

INSERT INTO `person` (`id`, `image`, `no`, `name`, `lastname`, `company`, `address1`, `address2`, `phone1`, `phone2`, `email1`, `email2`, `is_active_access`, `has_credit`, `credit_limit`, `password`, `kind`, `created_at`) VALUES
(2, '', '080198654321', 'CENTROMATIC', 'S.A.', '', 'Col. El Trapiche', '', '12345689', '', 'centromatic@gmail.com', '', 0, 0, NULL, NULL, 2, '2019-11-22 08:49:44'),
(3, '', '08012345678', 'Fernando ', 'Padilla', '', 'Col. El Trapiche', '', '12345689', '', 'fpadilla@asj.com', '', 1, 0, 0, '20787c9074d820735567345733a307c30157ba9b', 1, '2019-11-27 15:26:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `inventary_min` int(11) NOT NULL DEFAULT 10,
  `inventary_in` int(11) DEFAULT NULL,
  `price_in` float NOT NULL,
  `funding` varchar(11) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `date_expire` date NOT NULL,
  `date_warranty` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `asing` varchar(100) NOT NULL,
  `user_responsable` varchar(100) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `category_id_sub` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `barcode`, `image`, `description`, `inventary_min`, `inventary_in`, `price_in`, `funding`, `stock`, `date_expire`, `date_warranty`, `user_id`, `category_id`, `created_at`, `is_active`, `asing`, `user_responsable`, `state`, `unit_id`, `category_id_sub`) VALUES
(237, 'Servidor', 'ET0101', NULL, 'Procesadores:	\r\nFamilia de procesadores Intel®  Xeon®  E5-2400\r\n', 1, NULL, 14000, '0', 0, '0000-00-00', '0000-00-00', 1, 1, '0000-00-00 00:00:00', 1, 'Fernando  Padilla', 'Fernando  Padilla', NULL, 0, 1),
(471, 'Servidor HP', 'ET0102', NULL, 'Procesadores:	\r\nFamilia de procesadores Intel®  Xeon®  E5-2400\r\n', 1, NULL, 120000, '0', 0, '0000-00-00', '0000-00-00', 1, 1, '2019-11-26 14:51:25', 1, 'Fernando  Padilla', 'Carlos Garcia', NULL, 2, 1),
(473, 'Laptop Dell Inspiron N6040', 'ET0103', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu urna non risus semper consequat. ', 0, 0, 15000, '0', 0, '0000-00-00', '0000-00-00', 1, 1, '2020-01-21 11:57:26', 1, '', NULL, 1, 33, 3),
(474, 'Adaptador VGA a HDMI', 'ET160', NULL, '', 0, 0, 12000, '0', 1, '0000-00-00', '0000-00-00', 1, 1, '2020-01-23 13:54:05', 1, '', NULL, 1, 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saving`
--

CREATE TABLE `saving` (
  `id` int(11) NOT NULL,
  `concept` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `date_at` date DEFAULT NULL,
  `kind` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sell`
--

CREATE TABLE `sell` (
  `id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `operation_type_id` int(11) DEFAULT 2,
  `box_id` int(11) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `d_id` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `cash` double DEFAULT NULL,
  `iva` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `is_draft` tinyint(1) NOT NULL DEFAULT 0,
  `stock_to_id` int(11) DEFAULT NULL,
  `stock_from_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sell`
--

INSERT INTO `sell` (`id`, `person_id`, `user_id`, `operation_type_id`, `box_id`, `p_id`, `d_id`, `total`, `cash`, `iva`, `discount`, `is_draft`, `stock_to_id`, `stock_from_id`, `created_at`) VALUES
(2, 2, 1, 1, NULL, 1, 1, 26000, NULL, NULL, NULL, 0, 1, NULL, '2019-11-22 10:53:48'),
(3, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-22 10:56:09'),
(4, 2, 1, 1, NULL, 1, 1, 1200000, NULL, NULL, NULL, 0, 2, NULL, '2019-11-26 14:54:40'),
(5, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-26 14:55:26'),
(6, 2, 1, 1, NULL, 1, 1, 14200, NULL, NULL, NULL, 0, 1, NULL, '2019-11-27 09:13:47'),
(7, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 09:14:48'),
(8, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 09:16:28'),
(9, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 09:25:38'),
(10, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 09:45:55'),
(11, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 09:46:24'),
(12, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 09:51:26'),
(13, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 09:55:29'),
(14, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 09:57:02'),
(15, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 09:59:08'),
(16, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 10:02:18'),
(17, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 10:08:35'),
(18, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 10:18:34'),
(19, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 10:26:31'),
(20, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 14:28:26'),
(21, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 14:29:45'),
(22, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 14:31:01'),
(23, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 14:32:23'),
(24, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 14:39:04'),
(25, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 14:57:17'),
(26, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 14:59:50'),
(27, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 15:00:34'),
(28, NULL, 1, 6, NULL, 1, 1, 0, NULL, 15, 0, 0, NULL, NULL, '2019-11-27 15:16:31'),
(29, 3, 1, 2, NULL, 1, 1, 100000, NULL, 15, 0, 0, 1, NULL, '2019-11-27 15:26:45'),
(30, 3, 1, 2, NULL, 1, 1, 100000, NULL, 15, 0, 0, 1, NULL, '2019-11-27 15:27:22'),
(31, 3, 1, 2, NULL, 1, 1, 100000, NULL, 15, 0, 0, 1, NULL, '2019-11-27 15:32:05'),
(32, 3, 1, 2, NULL, 1, 1, 100000, NULL, 15, 0, 0, 1, NULL, '2019-11-27 15:35:25'),
(33, 3, 1, 2, NULL, 1, 1, 100000, NULL, 15, 0, 0, 1, NULL, '2019-11-27 15:37:16'),
(34, 3, 1, 2, NULL, 1, 1, 100000, NULL, 15, 0, 0, 1, NULL, '2019-11-27 15:41:13'),
(35, 2, 1, 1, NULL, 1, 1, 70000, NULL, NULL, NULL, 0, 1, NULL, '2019-11-28 11:42:35'),
(36, 2, 1, 1, NULL, 1, 1, 70000, NULL, NULL, NULL, 0, 1, NULL, '2019-11-28 11:43:16'),
(37, 2, 1, 1, NULL, 1, 1, 70000, NULL, NULL, NULL, 0, 1, NULL, '2019-11-28 11:51:03'),
(38, 2, 1, 1, NULL, 1, 1, 600000, NULL, NULL, NULL, 0, 1, NULL, '2019-11-28 11:53:51'),
(39, 3, 1, 2, NULL, 1, 1, 70000, NULL, 15, 0, 0, 1, NULL, '2019-11-28 11:56:24'),
(40, 2, 1, 1, NULL, 1, 1, 28000, NULL, NULL, NULL, 0, 1, NULL, '2019-11-28 11:57:10'),
(41, 3, 1, 2, NULL, 1, 1, 100000, NULL, 15, 0, 0, 1, NULL, '2019-11-29 11:05:48'),
(42, NULL, 1, 2, NULL, 1, 1, 200000, NULL, 15, 5000, 0, 1, NULL, '2019-12-02 07:23:11'),
(43, 3, 1, 2, NULL, 1, 1, 28000, NULL, 15, 28000, 0, 1, NULL, '2019-12-02 11:58:40'),
(44, 2, 1, 1, NULL, 1, 1, 140000, NULL, NULL, NULL, 0, 1, NULL, '2019-12-04 13:56:37'),
(45, 2, 1, 1, NULL, 1, 1, 600000, NULL, NULL, NULL, 0, 1, NULL, '2019-12-04 13:57:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `spend`
--

CREATE TABLE `spend` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` double DEFAULT NULL,
  `box_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `spend`
--

INSERT INTO `spend` (`id`, `name`, `price`, `box_id`, `created_at`) VALUES
(1, 'Compra de Materiales', 150000, NULL, '2019-12-04 14:40:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name_state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `states`
--

INSERT INTO `states` (`id`, `name_state`) VALUES
(1, 'Nuevo'),
(2, 'Malo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_principal` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id`, `name`, `is_principal`) VALUES
(1, 'Principal', 1),
(2, 'Almacen 1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `name_unit` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `units`
--

INSERT INTO `units` (`unit_id`, `name_unit`) VALUES
(0, 'Administracion (sps) '),
(1, 'Ajs '),
(2, 'Alac '),
(3, 'Apj (teg) '),
(4, 'Apj (sps) '),
(5, 'Auditoria interna '),
(6, 'Comunicaciones '),
(7, 'Contabilidad '),
(8, 'Cristianos valientes '),
(9, 'Comunidades fuertes '),
(10, 'Direccion comite ejecutivo '),
(11, 'Direccion de fortalecimiento institucional '),
(12, 'Direccion de gobernanza y estudios aplicados '),
(13, 'Direccion de incidencia politica '),
(14, 'Direccion de operaciones '),
(15, 'Direccion de programas '),
(16, 'Direccion de seguridad y justicia '),
(17, 'Direccion social '),
(18, 'Direccion de transparencia '),
(19, 'Direccion de transparencia '),
(20, 'Direccion gestion publica y gobernanza '),
(21, 'I2 '),
(22, 'Informatica '),
(23, 'Investigaciones '),
(24, 'Finanzas '),
(25, 'Paz y justicia (teg) '),
(26, 'Paz y justicia (sps) '),
(27, 'Nuevo edificio '),
(28, 'Pme '),
(29, 'Recursos humanos '),
(30, 'Rescate (teg) '),
(31, 'Rescate (sps) '),
(32, 'Revistazo '),
(33, 'Seguridad '),
(34, 'Transporte '),
(35, 'Transformacion policial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `kind` int(11) NOT NULL DEFAULT 1,
  `stock_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `lastname`, `username`, `email`, `password`, `image`, `status`, `kind`, `stock_id`, `created_at`) VALUES
(1, 'Administrador', '', NULL, 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', NULL, 1, 1, NULL, '2019-11-21 15:07:34'),
(2, 'Fernando ', 'Padilla', 'fpadilla', 'fpadilla@asjhonduras.com', '20787c9074d820735567345733a307c30157ba9b', NULL, 1, 2, 1, '2019-11-22 08:37:30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `box`
--
ALTER TABLE `box`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `category_id_sub`
--
ALTER TABLE `category_id_sub`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ibfk_6` (`id_category`);

--
-- Indices de la tabla `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short` (`short`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `d`
--
ALTER TABLE `d`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_id` (`stock_id`),
  ADD KEY `stock_destination_id` (`stock_destination_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `operation_type_id` (`operation_type_id`),
  ADD KEY `sell_id` (`sell_id`);

--
-- Indices de la tabla `operation_type`
--
ALTER TABLE `operation_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `p`
--
ALTER TABLE `p`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `sell_id` (`sell_id`),
  ADD KEY `payment_type_id` (`payment_type_id`);

--
-- Indices de la tabla `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_ibfk_3` (`state`),
  ADD KEY `product_ibfk_4` (`unit_id`),
  ADD KEY `product_ibfk_1` (`category_id`),
  ADD KEY `product_ibfk_5` (`category_id_sub`);

--
-- Indices de la tabla `saving`
--
ALTER TABLE `saving`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `d_id` (`d_id`),
  ADD KEY `box_id` (`box_id`),
  ADD KEY `operation_type_id` (`operation_type_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indices de la tabla `spend`
--
ALTER TABLE `spend`
  ADD PRIMARY KEY (`id`),
  ADD KEY `box_id` (`box_id`);

--
-- Indices de la tabla `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `box`
--
ALTER TABLE `box`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `category_id_sub`
--
ALTER TABLE `category_id_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `d`
--
ALTER TABLE `d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `operation`
--
ALTER TABLE `operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `operation_type`
--
ALTER TABLE `operation_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `p`
--
ALTER TABLE `p`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=475;

--
-- AUTO_INCREMENT de la tabla `saving`
--
ALTER TABLE `saving`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sell`
--
ALTER TABLE `sell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `spend`
--
ALTER TABLE `spend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `category_id_sub`
--
ALTER TABLE `category_id_sub`
  ADD CONSTRAINT `product_ibfk_6` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `operation`
--
ALTER TABLE `operation`
  ADD CONSTRAINT `operation_ibfk_1` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`id`),
  ADD CONSTRAINT `operation_ibfk_2` FOREIGN KEY (`stock_destination_id`) REFERENCES `stock` (`id`),
  ADD CONSTRAINT `operation_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `operation_ibfk_4` FOREIGN KEY (`operation_type_id`) REFERENCES `operation_type` (`id`),
  ADD CONSTRAINT `operation_ibfk_5` FOREIGN KEY (`sell_id`) REFERENCES `sell` (`id`);

--
-- Filtros para la tabla `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`sell_id`) REFERENCES `sell` (`id`),
  ADD CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`id`);

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`state`) REFERENCES `states` (`id`),
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`),
  ADD CONSTRAINT `product_ibfk_5` FOREIGN KEY (`category_id_sub`) REFERENCES `category_id_sub` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sell`
--
ALTER TABLE `sell`
  ADD CONSTRAINT `sell_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `p` (`id`),
  ADD CONSTRAINT `sell_ibfk_2` FOREIGN KEY (`d_id`) REFERENCES `d` (`id`),
  ADD CONSTRAINT `sell_ibfk_3` FOREIGN KEY (`box_id`) REFERENCES `box` (`id`),
  ADD CONSTRAINT `sell_ibfk_4` FOREIGN KEY (`operation_type_id`) REFERENCES `operation_type` (`id`),
  ADD CONSTRAINT `sell_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `sell_ibfk_6` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`);

--
-- Filtros para la tabla `spend`
--
ALTER TABLE `spend`
  ADD CONSTRAINT `spend_ibfk_1` FOREIGN KEY (`box_id`) REFERENCES `box` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
