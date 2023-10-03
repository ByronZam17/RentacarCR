-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-08-2023 a las 00:29:38
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectoweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `ID` int(11) NOT NULL,
  `articulos` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`ID`, `articulos`, `cantidad`, `precio`) VALUES
(2, 'GPS', 10, 10000),
(3, 'booster', 25, 10000),
(4, 'asistencia en carretera', 3, 5000),
(5, 'Autolavado', 10, 7000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cedes`
--

CREATE TABLE `cedes` (
  `ID` int(11) NOT NULL,
  `provincia` text NOT NULL,
  `personal` int(11) NOT NULL,
  `disposicion` text NOT NULL,
  `direccion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cedes`
--

INSERT INTO `cedes` (`ID`, `provincia`, `personal`, `disposicion`, `direccion`) VALUES
(4, 'Cartago', 5, 'Abierta', '200 oeste del BN '),
(5, 'Alajuela', 7, 'Abierta', 'Alajuela'),
(6, 'San Jose', 10, 'Mantenimiento', '200 oeste del BAC san jose'),
(7, 'Heredia', 7, 'Abierta', '200 oeste del BN ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rental_data`
--

CREATE TABLE `rental_data` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `Marca` varchar(100) NOT NULL,
  `extras` varchar(200) DEFAULT NULL,
  `rental_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_price` decimal(10,2) NOT NULL,
  `cedula` varchar(20) DEFAULT NULL,
  `estado` enum('activa','cancelada','finalizada') NOT NULL DEFAULT 'activa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rental_data`
--

INSERT INTO `rental_data` (`id`, `tipo`, `Marca`, `extras`, `rental_date`, `total_price`, `cedula`, `estado`) VALUES
(1, 'deportivo', 'Chevrolet ', 'Niños', '2023-08-23 04:02:12', 170015.00, '305450724', 'cancelada'),
(2, 'todorerreno', 'Toyota ', '2, 3', '2023-08-23 20:22:03', 120000.00, '1234', 'activa'),
(3, 'deportivo', '', '2', '2023-08-23 22:19:50', 10000.00, '1234', 'activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `usuario` text NOT NULL,
  `password` text NOT NULL,
  `rol` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `usuario`, `password`, `rol`) VALUES
(1, 'byron', '123', 0),
(13, 'Gustavo', '123', 1),
(16, 'prueba1', '123', 0),
(17, 'prueba2', '111', 1),
(18, 'prueba2', '111', 1),
(19, 'Prueba3', '333', 0),
(20, 'Prueba3', '333', 0),
(21, 'prueba4', '444', 1),
(22, 'prueba4', '444', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `ID` int(11) NOT NULL,
  `placa` text NOT NULL,
  `Marca` text NOT NULL,
  `anio` int(10) NOT NULL,
  `tipo` text NOT NULL,
  `Precio` int(100) NOT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`ID`, `placa`, `Marca`, `anio`, `tipo`, `Precio`, `imagen`) VALUES
(6, '3450009', 'lancer EVO', 2015, 'todoterreno', 100000, 'http://localhost/DesarrolloWeb_proyecto/imagenes/EVO.jpeg'),
(9, '9032m2', 'Chevrolet ', 2015, 'deportivo', 170000, 'http://localhost/DesarrolloWeb_proyecto/imagenes/..imgs.jpg'),
(10, '345', 'Toyota ', 2020, 'todorerreno', 100000, 'http://localhost/DesarrolloWeb_proyecto/imagenes/im.jpg'),
(11, '1111', 'nissan', 2008, 'estandar', 150000, 'http://localhost/DesarrolloWeb_proyecto/imagenes/images.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `cedes`
--
ALTER TABLE `cedes`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `rental_data`
--
ALTER TABLE `rental_data`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cedes`
--
ALTER TABLE `cedes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rental_data`
--
ALTER TABLE `rental_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
