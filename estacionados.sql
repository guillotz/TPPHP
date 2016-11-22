-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2016 a las 01:48:15
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `estacionados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autos`
--

CREATE TABLE `autos` (
  `idUser` int(11) NOT NULL,
  `pat` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `ingreso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `autos`
--

INSERT INTO `autos` (`idUser`, `pat`, `ingreso`) VALUES
(0, 'aaa232', 1479239398),
(0, 'sda123', 1479239363),
(0, 'wsw211', 1479237423);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salio`
--

CREATE TABLE `salio` (
  `idUser` int(10) NOT NULL,
  `fechaIn` int(11) NOT NULL,
  `fechaOut` int(11) NOT NULL,
  `pat` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `salio`
--

INSERT INTO `salio` (`idUser`, `fechaIn`, `fechaOut`, `pat`) VALUES
(0, 1479237277, 1479237289, 'sws222'),
(0, 1479237443, 1479237453, 'ttt222'),
(0, 1479237662, 1479237667, 'gtr321'),
(0, 1479237492, 1479237830, 'hhh444'),
(0, 1479237866, 1479237872, 'qwe212'),
(0, 1479237885, 1479237891, 'qwe212'),
(0, 1479237926, 1479237929, 'yty656');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `admin`) VALUES
(1, 'guillermo', 'asd', 1),
(2, 'user', 'user', 0),
(3, 'admin', 'admin', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`pat`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
