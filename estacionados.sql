-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2016 a las 15:33:02
-- Versión del servidor: 5.7.9
-- Versión de PHP: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `estacionados`
--
CREATE DATABASE IF NOT EXISTS `estacionados` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `estacionados`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autos`
--

DROP TABLE IF EXISTS `autos`;
CREATE TABLE IF NOT EXISTS `autos` (
  `idUser` int(11) NOT NULL DEFAULT '0',
  `pat` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `ingreso` int(11) NOT NULL,
  PRIMARY KEY (`pat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `autos`
--

INSERT INTO `autos` (`idUser`, `pat`, `ingreso`) VALUES
(0, 'ass666', 1479794264),
(0, 'dfg343', 1479795999),
(0, 'ikl099', 1479794258),
(0, 'kjj555', 1479794273),
(0, 'mmm900', 1479794284),
(0, 'nng433', 1479796365);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salio`
--

DROP TABLE IF EXISTS `salio`;
CREATE TABLE IF NOT EXISTS `salio` (
  `idUser` int(10) NOT NULL DEFAULT '0',
  `fechaIn` int(11) NOT NULL,
  `fechaOut` int(11) NOT NULL,
  `pat` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `cobrado` text COLLATE latin1_spanish_ci,
  PRIMARY KEY (`pat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `salio`
--

INSERT INTO `salio` (`idUser`, `fechaIn`, `fechaOut`, `pat`, `cobrado`) VALUES
(0, 1479239398, 1479793847, 'aaa232', '150'),
(0, 1479789943, 1479793782, 'ABC123', '80'),
(0, 1479790551, 1479792485, 'cbd321', '80'),
(0, 1479793666, 1479793754, 'dsf432', '10'),
(0, 1479793980, 1479793987, 'gfd444', '10'),
(0, 1479790590, 1479792442, 'gre123', '90'),
(0, 1479237662, 1479237667, 'gtr321', '20'),
(0, 1479237492, 1479237830, 'hhh444', '40'),
(0, 1479239363, 1479793733, 'sda123', '30'),
(0, 1479237277, 1479237289, 'sws222', '60'),
(0, 1479793795, 1479793804, 'tgb543', '60'),
(0, 1479793942, 1479793948, 'thf123', '10'),
(0, 1479237443, 1479237453, 'ttt222', '20'),
(0, 1479794250, 1479796458, 'ttt444', '10'),
(0, 1479237423, 1479794846, 'wsw211', '1550'),
(0, 1479237926, 1479237929, 'yty656', '50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `admin`) VALUES
(1, 'guillermo', 'asd', 1),
(2, 'user', 'user', 0),
(3, 'admin', 'admin', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
