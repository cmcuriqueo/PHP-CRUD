-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2016 a las 09:25:50
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `usuario`
--
CREATE DATABASE IF NOT EXISTS `usuario` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `usuario`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicacion`
--

CREATE TABLE `aplicacion` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `fecha_alta` date NOT NULL,
  `url` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aplicacion`
--

INSERT INTO `aplicacion` (`id`, `descripcion`, `fecha_alta`, `url`) VALUES
(1, 'PRIMER APP PHP', '2016-09-08', 'LOCALHOST/PRIMERPROYECTOPHP/'),
(2, 'PRIMER APP JAVA', '2016-09-08', 'LOCALHOST/PRIMERPROYECTOJAVA/');

--
-- Disparadores `aplicacion`
--
DELIMITER $$
CREATE TRIGGER `logger_delete_aplicacion` BEFORE DELETE ON `aplicacion` FOR EACH ROW INSERT INTO logger ( id_registro, fecha ,usuario ,tabla ,accion ,dato) VALUES (OLD.id, now(), user(), 'APLICACION' ,'DELETE' ,CONCAT( OLD.descripcion,', ', OLD.fecha_alta,', ',OLD.url))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `logger_update_aplicacion` BEFORE UPDATE ON `aplicacion` FOR EACH ROW INSERT INTO logger ( id_registro, fecha ,usuario ,tabla ,accion ,dato) VALUES (OLD.id, now(), user(), 'APLICACION' ,'UPDATE' ,CONCAT( OLD.descripcion,', ', OLD.fecha_alta,', ',OLD.url))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicacion_permiso`
--

CREATE TABLE `aplicacion_permiso` (
  `id_aplicacion` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aplicacion_permiso`
--

INSERT INTO `aplicacion_permiso` (`id_aplicacion`, `id_permiso`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicacion_usuario`
--

CREATE TABLE `aplicacion_usuario` (
  `id_aplicacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aplicacion_usuario`
--

INSERT INTO `aplicacion_usuario` (`id_aplicacion`, `id_usuario`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logger`
--

CREATE TABLE `logger` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `tabla` varchar(30) NOT NULL,
  `accion` varchar(6) NOT NULL,
  `dato` text NOT NULL,
  `id_registro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `logger`
--

INSERT INTO `logger` (`id`, `fecha`, `usuario`, `tabla`, `accion`, `dato`, `id_registro`) VALUES
(1, '2016-09-06', 'root@localhost', 'PERFIL', 'DELETE', 'PEPE, ARGENTO, 39443529, 1945-02-02', 1),
(2, '2016-09-07', 'root@localhost', 'PERFIL', 'UPDATE', 'PIPO, ARGENTO, 20456456, 1965-09-05', 1),
(3, '2016-09-07', 'root@localhost', 'ROL', 'DELETE', 'MODIFICADOR', 3),
(4, '2016-09-15', 'root@localhost', 'PERFIL', 'DELETE', 'PEPE, ARGENTO, 20456456, 1965-09-05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `referido_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `referido_id`) VALUES
(1, NULL),
(2, NULL);

--
-- Disparadores `perfil`
--
DELIMITER $$
CREATE TRIGGER `persona` AFTER INSERT ON `perfil` FOR EACH ROW -- Edit trigger body code below this line. Do not edit lines above this one
INSERT INTO `persona` (id) VALUES (NEW.id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `descripcion`) VALUES
(1, 'SELECT'),
(2, 'INSERT'),
(3, 'UPDATE'),
(4, 'DELETE');

--
-- Disparadores `permiso`
--
DELIMITER $$
CREATE TRIGGER `logger_delete_permiso` BEFORE DELETE ON `permiso` FOR EACH ROW INSERT INTO logger ( id_registro, fecha ,usuario, tabla ,accion ,dato) VALUES (OLD.id, now(), user(), 'PERMISO', 'DELETE' ,CONCAT( OLD.descripcion))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `logger_update_permiso` BEFORE UPDATE ON `permiso` FOR EACH ROW INSERT INTO logger ( id_registro, fecha ,usuario, tabla ,accion ,dato) VALUES (OLD.id, now(), user(), 'PERMISO', 'UPDATE' ,CONCAT( OLD.descripcion))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_rol`
--

CREATE TABLE `permiso_rol` (
  `id_permiso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso_rol`
--

INSERT INTO `permiso_rol` (`id_permiso`, `id_rol`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_usuario`
--

CREATE TABLE `permiso_usuario` (
  `id_permiso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(20) DEFAULT NULL,
  `dni` varchar(12) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `apellido`, `dni`, `fecha_nacimiento`) VALUES
(1, NULL, NULL, NULL, NULL),
(2, 'CESAR MATIAS', 'CURIQUEO', '39443529', '1996-06-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `descripcion`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'CREADOR');

--
-- Disparadores `rol`
--
DELIMITER $$
CREATE TRIGGER `logger_delete_rol` BEFORE DELETE ON `rol` FOR EACH ROW INSERT INTO logger ( id_registro,fecha ,usuario ,tabla,accion ,dato) VALUES (OLD.id, now(), user(), 'ROL','DELETE' ,CONCAT( OLD.descripcion))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `logger_update_rol` BEFORE UPDATE ON `rol` FOR EACH ROW INSERT INTO logger ( id_registro,fecha ,usuario ,tabla,accion ,dato) VALUES (OLD.id, now(), user(), 'ROL','UPDATE' ,CONCAT( OLD.descripcion))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `id_rol` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_alta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol_usuario`
--

INSERT INTO `rol_usuario` (`id_rol`, `id_usuario`, `fecha_alta`) VALUES
(1, 1, '2016-09-01'),
(2, 2, '2016-09-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `contrasenia` varchar(44) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `contrasenia`, `estado`) VALUES
(1, 'PEPE', '3d72e9967fe1a33d2ba707551bec221eca7ebebf', 1),
(2, 'CESAR', '875a051cdfc598717693a67f5dc653d0129341c9', 1);

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `USUARIO` BEFORE INSERT ON `usuario` FOR EACH ROW SET NEW.contrasenia = SHA1(NEW.contrasenia)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `logger_delete_usuario` BEFORE DELETE ON `usuario` FOR EACH ROW INSERT INTO logger ( id_registro, fecha ,usuario ,accion ,dato) VALUES (OLD.id, now(), user(),'DELETE' ,CONCAT(OLD.nombre,', ',OLD.contrasenia,', ',OLD.estado))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `logger_update_usuario` BEFORE UPDATE ON `usuario` FOR EACH ROW INSERT INTO logger ( id_registro,fecha ,usuario ,accion ,dato) VALUES (OLD.id, now(), user(),'UPDATE',CONCAT(OLD.nombre,', ',OLD.contrasenia,', ',OLD.estado))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `perfil` AFTER INSERT ON `usuario` FOR EACH ROW -- Edit trigger body code below this line. Do not edit lines above this one

INSERT INTO logger ( id ) VALUES (NEW.id)
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aplicacion`
--
ALTER TABLE `aplicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `aplicacion_permiso`
--
ALTER TABLE `aplicacion_permiso`
  ADD PRIMARY KEY (`id_aplicacion`,`id_permiso`),
  ADD KEY `id_aplicacion` (`id_aplicacion`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `aplicacion_usuario`
--
ALTER TABLE `aplicacion_usuario`
  ADD PRIMARY KEY (`id_aplicacion`,`id_usuario`),
  ADD KEY `id_aplicacion` (`id_aplicacion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `logger`
--
ALTER TABLE `logger`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permiso_rol`
--
ALTER TABLE `permiso_rol`
  ADD PRIMARY KEY (`id_permiso`,`id_rol`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  ADD PRIMARY KEY (`id_permiso`,`id_usuario`),
  ADD KEY `id_permiso` (`id_permiso`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD PRIMARY KEY (`id_rol`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aplicacion`
--
ALTER TABLE `aplicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `logger`
--
ALTER TABLE `logger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aplicacion_permiso`
--
ALTER TABLE `aplicacion_permiso`
  ADD CONSTRAINT `aplicacion_permiso_ibfk_1` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `aplicacion_permiso_ibfk_2` FOREIGN KEY (`id_aplicacion`) REFERENCES `aplicacion` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `aplicacion_usuario`
--
ALTER TABLE `aplicacion_usuario`
  ADD CONSTRAINT `aplicacion_usuario_ibfk_1` FOREIGN KEY (`id_aplicacion`) REFERENCES `aplicacion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `aplicacion_usuario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `permiso_rol`
--
ALTER TABLE `permiso_rol`
  ADD CONSTRAINT `permiso_rol_ibfk_1` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `permiso_rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  ADD CONSTRAINT `permiso_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `permiso_usuario_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_persona_perfil1` FOREIGN KEY (`id`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD CONSTRAINT `rol_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rol_usuario_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`id`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
