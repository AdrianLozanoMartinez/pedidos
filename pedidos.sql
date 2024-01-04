-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-01-2024 a las 18:26:55
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pedidos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `CodCat` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`CodCat`, `Nombre`, `Descripcion`) VALUES
(1, 'Comida', 'Platos e ingredientes'),
(2, 'Bedidas sin', 'Bebidas sin alcohol'),
(3, 'Bebidas con', 'Bebidas con alcohol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `CodPed` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Enviado` int(11) NOT NULL,
  `Restaurante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`CodPed`, `Fecha`, `Enviado`, `Restaurante`) VALUES
(79, '2018-12-20 15:50:33', 0, 1),
(80, '2018-12-20 15:51:41', 0, 1),
(81, '2018-12-20 16:41:13', 0, 1),
(82, '2018-12-20 17:29:39', 0, 1),
(83, '2018-12-20 23:13:23', 0, 1),
(84, '2018-12-20 23:14:07', 0, 1),
(85, '2018-12-20 23:15:02', 0, 1),
(86, '2018-12-24 10:56:29', 0, 1),
(98, '2023-11-26 13:30:53', 0, 1),
(99, '2023-11-26 13:42:57', 0, 1),
(100, '2023-11-26 13:45:59', 0, 1),
(101, '2023-11-26 13:47:24', 0, 1),
(102, '2023-11-26 13:54:34', 0, 1),
(103, '2023-11-26 13:54:51', 0, 1),
(104, '2023-11-26 13:57:30', 0, 1),
(105, '2023-11-26 13:59:29', 0, 1),
(106, '2023-11-26 14:00:13', 0, 1),
(107, '2023-11-26 14:24:23', 0, 1),
(108, '2023-11-26 14:25:00', 0, 1),
(109, '2023-11-26 14:25:46', 0, 1),
(110, '2023-11-26 14:26:48', 0, 8),
(111, '2023-11-26 14:27:57', 0, 8),
(112, '2023-11-26 14:31:33', 0, 8),
(113, '2023-11-26 14:32:42', 0, 8),
(114, '2023-11-26 14:33:07', 0, 8),
(115, '2023-11-26 14:34:36', 0, 8),
(116, '2023-11-26 16:12:35', 0, 8),
(117, '2023-11-26 16:13:03', 0, 8),
(118, '2023-11-26 16:20:04', 0, 8),
(119, '2023-11-26 16:21:38', 0, 8),
(120, '2023-11-26 16:21:52', 0, 8),
(121, '2023-11-26 16:22:08', 0, 8),
(122, '2023-11-26 16:22:41', 0, 8),
(123, '2023-11-26 17:14:11', 0, 8),
(124, '2023-11-26 22:01:31', 0, 19),
(125, '2023-11-26 22:18:42', 0, 19),
(126, '2023-11-27 07:55:48', 0, 19),
(127, '2023-11-27 15:48:58', 0, 19),
(128, '2023-11-27 15:50:37', 0, 8),
(129, '2023-11-28 12:27:27', 0, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidosproductos`
--

CREATE TABLE `pedidosproductos` (
  `CodPedProd` int(11) NOT NULL,
  `Pedido` int(11) NOT NULL,
  `Producto` int(11) NOT NULL,
  `Unidades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pedidosproductos`
--

INSERT INTO `pedidosproductos` (`CodPedProd`, `Pedido`, `Producto`, `Unidades`) VALUES
(65, 79, 5, 1),
(66, 79, 2, 4),
(67, 80, 5, 1),
(68, 81, 3, 1),
(69, 81, 4, 1),
(70, 82, 6, 1),
(71, 82, 3, 1),
(72, 83, 5, 1),
(73, 84, 5, 1),
(74, 85, 3, 1),
(75, 86, 6, 1),
(76, 99, 1, 1),
(77, 99, 4, 1),
(78, 100, 1, 1),
(79, 100, 4, 1),
(80, 101, 1, 1),
(81, 101, 4, 1),
(82, 103, 1, 1),
(83, 103, 4, 1),
(84, 104, 1, 1),
(85, 104, 5, 1),
(86, 105, 1, 1),
(87, 105, 4, 3),
(88, 106, 1, 1),
(89, 106, 4, 1),
(90, 107, 1, 1),
(91, 107, 4, 1),
(92, 108, 1, 1),
(93, 108, 4, 1),
(94, 109, 1, 1),
(95, 109, 4, 1),
(96, 110, 1, 1),
(97, 110, 4, 1),
(98, 111, 4, 1),
(99, 111, 1, 1),
(100, 112, 1, 1),
(101, 112, 6, 1),
(102, 112, 5, 1),
(103, 114, 1, 1),
(104, 114, 5, 1),
(105, 115, 1, 1),
(106, 115, 4, 1),
(107, 117, 1, 1),
(108, 117, 4, 1),
(109, 118, 2, 1),
(110, 118, 5, 1),
(111, 120, 1, 1),
(112, 121, 1, 1),
(113, 121, 4, 1),
(114, 122, 1, 1),
(115, 122, 4, 1),
(117, 125, 4, 2),
(118, 125, 3, 3),
(119, 127, 1, 2),
(120, 127, 3, 1),
(121, 128, 1, 1),
(122, 128, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `CodProd` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(90) NOT NULL,
  `Peso` float NOT NULL,
  `Stock` int(11) NOT NULL,
  `Categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`CodProd`, `Nombre`, `Descripcion`, `Peso`, `Stock`, `Categoria`) VALUES
(1, 'Harina', '8 paquetes de 1kg de harina cada uno', 8, 97, 1),
(2, 'Sal', '20 paquetes de 1kg cada uno', 20, 98, 1),
(3, 'Agua 0.5', '100 botellas de 0.5 litros cada una', 51, 96, 2),
(4, 'Agua 1.5', '20 botellas de 1.5 litros cada una', 31, 98, 2),
(5, 'Cerveza Alhambra tercio', '24 botellas de 33cl', 10, 5, 3),
(6, 'Vino tinto Rioja 0.75', '6 botellas de 0.75 ', 5.5, 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `CodRes` int(11) NOT NULL,
  `Correo` varchar(90) NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `Pais` varchar(45) NOT NULL,
  `CP` int(5) DEFAULT NULL,
  `Ciudad` varchar(45) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`CodRes`, `Correo`, `Clave`, `Pais`, `CP`, `Ciudad`, `Direccion`, `Rol`) VALUES
(1, 'madrid1@empresa.com', '1234', 'España', 28002, 'Madrid', 'C/ Padre  Claret, 8', 1),
(2, 'cadiz1@empresa.com', '1234', 'España', 11001, 'Cádiz', 'C/ Portales, 2 ', 0),
(8, 'ghostpilot.678@gmail.com', '1234', 'España', 29603, 'Marbella', 'Marbella', 0),
(19, 'adrianlm1985@gmail.com', '1234', 'España', 29603, 'Marbella', '', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`CodCat`),
  ADD UNIQUE KEY `UN_NOM_CAT` (`Nombre`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`CodPed`),
  ADD KEY `Restaurante` (`Restaurante`);

--
-- Indices de la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  ADD PRIMARY KEY (`CodPedProd`),
  ADD KEY `CodPed` (`Pedido`),
  ADD KEY `CodProd` (`Producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`CodProd`),
  ADD KEY `Categoria` (`Categoria`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`CodRes`),
  ADD UNIQUE KEY `UN_RES_COR` (`Correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `CodCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `CodPed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  MODIFY `CodPedProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `CodProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `CodRes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`Restaurante`) REFERENCES `restaurantes` (`CodRes`);

--
-- Filtros para la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  ADD CONSTRAINT `pedidosproductos_ibfk_1` FOREIGN KEY (`Pedido`) REFERENCES `pedidos` (`CodPed`),
  ADD CONSTRAINT `pedidosproductos_ibfk_2` FOREIGN KEY (`Producto`) REFERENCES `productos` (`CodProd`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`Categoria`) REFERENCES `categorias` (`CodCat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
