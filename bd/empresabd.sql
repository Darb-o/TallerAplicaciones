-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2021 a las 02:18:52
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empresabd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deducciones`
--

CREATE TABLE `deducciones` (
  `id` int(11) NOT NULL,
  `anticipo` double DEFAULT NULL,
  `valor_p` double DEFAULT NULL,
  `cuota` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `deducciones`
--

INSERT INTO `deducciones` (`id`, `anticipo`, `valor_p`, `cuota`, `fecha`) VALUES
(1101, 150000, 20000, 4, '2021-05-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devengados`
--

CREATE TABLE `devengados` (
  `id` int(11) NOT NULL,
  `dias_v` int(11) DEFAULT NULL,
  `dias_i` int(11) DEFAULT NULL,
  `tipo_i` char(1) DEFAULT NULL,
  `extra` int(11) DEFAULT NULL,
  `recargo` int(11) DEFAULT NULL,
  `dominicales` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `devengados`
--

INSERT INTO `devengados` (`id`, `dias_v`, `dias_i`, `tipo_i`, `extra`, `recargo`, `dominicales`) VALUES
(1101, 23, 21, 'd', 0, 0, 421);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `sueldo` double NOT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `costo` varchar(50) DEFAULT NULL,
  `dia_l` int(11) DEFAULT NULL,
  `ite` varchar(50) DEFAULT NULL,
  `clase_r` varchar(2) DEFAULT NULL,
  `centro_t` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `nombre`, `apellido`, `sueldo`, `cargo`, `costo`, `dia_l`, `ite`, `clase_r`, `centro_t`) VALUES
(1101, 'Jota Mario', 'Valencia', 1500000, 'Asistente Varios', 'Las Delicias', 30, 'Medio', 'II', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `deducciones`
--
ALTER TABLE `deducciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `devengados`
--
ALTER TABLE `devengados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `deducciones`
--
ALTER TABLE `deducciones`
  ADD CONSTRAINT `deducciones_ibfk_1` FOREIGN KEY (`id`) REFERENCES `empleado` (`id`);

--
-- Filtros para la tabla `devengados`
--
ALTER TABLE `devengados`
  ADD CONSTRAINT `devengados_ibfk_1` FOREIGN KEY (`id`) REFERENCES `empleado` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
