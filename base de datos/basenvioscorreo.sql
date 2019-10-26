-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-03-2019 a las 02:09:48
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `basenvioscorreo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `año`
--

CREATE TABLE `año` (
  `idaño` int(11) NOT NULL,
  `año_numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `año`
--

INSERT INTO `año` (`idaño`, `año_numero`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `idcontacto` int(11) NOT NULL,
  `usu_idusuario` int(11) NOT NULL,
  `sec_idseccion` int(11) NOT NULL,
  `con_nombre_apellido` varchar(250) DEFAULT NULL,
  `con_correo` text,
  `con_telefono` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`idcontacto`, `usu_idusuario`, `sec_idseccion`, `con_nombre_apellido`, `con_correo`, `con_telefono`) VALUES
(2, 1, 14, 'nombre', 'correo@correo.com', 654654);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `idmensaje` int(11) NOT NULL,
  `contacto_mensaje` int(11) NOT NULL,
  `men_asunto` varchar(250) DEFAULT NULL,
  `men_descripcion` text,
  `men_archivo` text,
  `men_fecha_envio` datetime DEFAULT NULL,
  `men_estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`idmensaje`, `contacto_mensaje`, `men_asunto`, `men_descripcion`, `men_archivo`, `men_fecha_envio`, `men_estado`) VALUES
(2, 2, 'asunto', 'sdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adf', '', '2019-03-05 19:40:30', '1'),
(3, 2, 'dos asunto', 'sdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adf', '', '2019-03-05 19:40:47', '1'),
(4, 2, 'tres asunto', 'sdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adfsdlk asdlkjas dlk jsadfl sadfkl sadflkjasdlfj adslkfj sadflj adf', 'C:xampphtdocsSistemaEnvioCorreosmodelo/Archivos/1551829280--nuevo.png', '2019-03-05 19:41:20', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `idseccion` int(11) NOT NULL,
  `año_idaño` int(11) NOT NULL,
  `sec_descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`idseccion`, `año_idaño`, `sec_descripcion`) VALUES
(1, 1, 'a'),
(2, 1, 'b'),
(3, 1, 'c'),
(4, 1, 'd'),
(5, 2, 'a'),
(6, 2, 'b'),
(7, 2, 'c'),
(8, 2, 'd'),
(9, 3, 'a'),
(10, 3, 'b'),
(11, 3, 'c'),
(12, 3, 'd'),
(13, 4, 'a'),
(14, 4, 'b'),
(15, 4, 'c'),
(16, 4, 'd'),
(17, 5, 'a'),
(18, 5, 'b'),
(19, 5, 'c'),
(20, 5, 'd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `usu_cedula` varchar(25) DEFAULT NULL,
  `usu_nombre_apellido` varchar(250) DEFAULT NULL,
  `usu_telefono` int(11) DEFAULT NULL,
  `usu_correo` text,
  `usu_contrasena` text,
  `usu_olvido_contrasena` text,
  `usu_foto` text,
  `usu_cargo` varchar(150) DEFAULT NULL,
  `usu_fecha_registro` datetime DEFAULT NULL,
  `usu_estado` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usu_cedula`, `usu_nombre_apellido`, `usu_telefono`, `usu_correo`, `usu_contrasena`, `usu_olvido_contrasena`, `usu_foto`, `usu_cargo`, `usu_fecha_registro`, `usu_estado`) VALUES
(1, '2634564', 'juan', 5656545, '97juandcm11@gmail.com', '$2y$12$ffzKMVpKfwqSUdGbE/DO6eRvv8jkJ6qs741A2CmZX0bGl.8w.us1K', '', 'C:xampphtdocsSistemaEnvioCorreosmodelo/Archivos/1551832200--Sin título.png', NULL, '2019-03-05 10:14:49', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `verificacion_usuario`
--

CREATE TABLE `verificacion_usuario` (
  `idverificacion_usuario` int(11) NOT NULL,
  `usu_idusuario` int(11) NOT NULL,
  `pregunta_seguridad` text,
  `respuesta_seguridad` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `verificacion_usuario`
--

INSERT INTO `verificacion_usuario` (`idverificacion_usuario`, `usu_idusuario`, `pregunta_seguridad`, `respuesta_seguridad`) VALUES
(1, 1, 'pregunta', 'respuesta');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `año`
--
ALTER TABLE `año`
  ADD PRIMARY KEY (`idaño`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`idcontacto`),
  ADD KEY `fk_contacto_usuario1_idx` (`usu_idusuario`),
  ADD KEY `fk_contacto_seccion1_idx` (`sec_idseccion`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`idmensaje`),
  ADD KEY `fk_mensaje_contacto1_idx` (`contacto_mensaje`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`idseccion`),
  ADD KEY `fk_seccion_año1_idx` (`año_idaño`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `verificacion_usuario`
--
ALTER TABLE `verificacion_usuario`
  ADD PRIMARY KEY (`idverificacion_usuario`),
  ADD KEY `fk_verificacion_usuario_idx` (`usu_idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `año`
--
ALTER TABLE `año`
  MODIFY `idaño` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `idcontacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `idmensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `idseccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `verificacion_usuario`
--
ALTER TABLE `verificacion_usuario`
  MODIFY `idverificacion_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `fk_contacto_seccion1` FOREIGN KEY (`sec_idseccion`) REFERENCES `seccion` (`idseccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contacto_usuario1` FOREIGN KEY (`usu_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_mensaje_contacto1` FOREIGN KEY (`contacto_mensaje`) REFERENCES `contacto` (`idcontacto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD CONSTRAINT `fk_seccion_año1` FOREIGN KEY (`año_idaño`) REFERENCES `año` (`idaño`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `verificacion_usuario`
--
ALTER TABLE `verificacion_usuario`
  ADD CONSTRAINT `fk_verificacion_usuario` FOREIGN KEY (`usu_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
