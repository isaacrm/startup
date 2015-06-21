-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2015 a las 10:41:08
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `winefun`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas`
--

CREATE TABLE IF NOT EXISTS `caracteristicas` (
`id_caracteristica` int(11) NOT NULL,
  `titulo` varchar(8) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_caracteristicas`
--

CREATE TABLE IF NOT EXISTS `detalles_caracteristicas` (
`id_detalle_caracteristica` int(11) NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `id_caracteristica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
`id_empleado` int(11) NOT NULL,
  `nombres` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `identificador` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `foto` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombres`, `apellidos`, `identificador`, `telefono`, `correo`, `sexo`, `fecha_nacimiento`, `foto`) VALUES
(6, 'Jorge Isaac', 'RodrÃ­guez MÃ©ndez', '05429426-1', '7182-7243', 'mendezisaac.11@gmail.com', 'Masculino', '1997-06-14', 'img_empleados/05429426-1.jpg'),
(8, 'dfghjk', 'jhgfrdeswe', '06464610-1', '6242-5254', 'mendezisaac.11@gmail.com', 'Femenino', '1997-06-06', 'img_empleados/1490742_779574108726394_1619493180_o.jpg'),
(13, 'Kun ', 'AgÃ¼ero ', '04527525-9', '2234-5678', 'mendezisaac.11@gmail.com', 'Masculino', '1996-07-19', 'img_empleados/01234567-8.jpg'),
(14, 'Lala', 'sadsad', '98765432-1', '2645-7875', 'mendezisaac.11@gmail.com', 'Masculino', '1997-06-06', 'img_empleados/98765432-1.jpg'),
(16, 'Jajajajjajaja', 'Lopez', '32145698-5', '6549-8987', 'sadasd@asdas.sd', 'Masculino', '1997-06-01', 'img_empleados/16.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
`id_equipo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `cargo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `frase` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_servicios`
--

CREATE TABLE IF NOT EXISTS `imagenes_servicios` (
`id_imagen` int(11) NOT NULL,
  `url` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `id_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
`id_noticia` int(11) NOT NULL,
  `titulo` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `subtitulo` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `leyenda` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id_noticia`, `titulo`, `subtitulo`, `leyenda`, `foto`) VALUES
(10, 'WineFun', 'Creando tu mundo', 'asdasdasdas', 'img_noticias/10.jpg'),
(11, 'Comidas 2x1', 'Grandes promociones 100pre', 'Excelentes', 'img_noticias/11.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

CREATE TABLE IF NOT EXISTS `paginas` (
`id_pagina` int(11) NOT NULL,
  `encabezado` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `frase` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `politicas`
--

CREATE TABLE IF NOT EXISTS `politicas` (
`id_politica` int(11) NOT NULL,
  `titulo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE IF NOT EXISTS `preguntas` (
`id_pregunta` int(11) NOT NULL,
  `pregunta` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `respuesta` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
`id_servicio` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `precio` decimal(7,2) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuarios`
--

CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
`id_tipo_usuario` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `agregar` tinyint(1) NOT NULL,
  `modificar` tinyint(1) NOT NULL,
  `eliminar` tinyint(1) NOT NULL,
  `consultar` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_usuarios`
--

INSERT INTO `tipos_usuarios` (`id_tipo_usuario`, `nombre`, `descripcion`, `agregar`, `modificar`, `eliminar`, `consultar`) VALUES
(25, 'Administrador', 'El que controla todo', 1, 1, 1, 1),
(26, 'hola xD', 'asdsadsadsa', 1, 1, 0, 0),
(27, 'ghjfgdf', 'kkkkk', 0, 1, 1, 0),
(28, 'erwtyuy', 'rtyuuyttr', 0, 0, 0, 1),
(29, 'adsdsd', 'sadsadsadsa', 0, 1, 0, 0),
(30, 'wqewqewqe', 'wqewqewqeqw', 0, 0, 1, 1),
(31, 'sadsaddfgdg', 'dfgdfgfgfdg', 0, 1, 0, 0),
(32, 'dsadsadsad', 'sadsadsadsadas', 1, 0, 0, 0),
(33, 'dhhfghg', 'dhgfhd', 1, 1, 0, 0),
(35, 'fhghgfhgf', 'hgfghfghgfhfd', 0, 0, 1, 0),
(36, 'sdfgdgsdgf', 'dgdfgdfgdf', 0, 0, 1, 0),
(37, 'dsfsfdsfd', 'sfdsfdsf', 0, 1, 0, 0),
(51, 'Gerente', 'sadsadsdasda', 1, 1, 0, 0),
(68, 'xcdfghjklÃ±', 'lkjhgfd', 1, 0, 0, 0),
(70, ' Gerente de Sucursal', 'asdsadas', 1, 0, 0, 0),
(71, 'asdsadsadsad asdasdasdsa asda ssd sa sada ', 'dasdsadasda', 1, 0, 0, 0),
(72, 'asdsad', 'sasdsa', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id_usuario` int(11) NOT NULL,
  `alias` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `alias`, `contrasena`, `estado`, `id_empleado`, `id_tipo_usuario`) VALUES
(3, 'Isaac', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 6, 25),
(7, 'Chaco', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 8, 70),
(13, 'Asdf', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 13, 70),
(14, 'Aaaa', '3da541559918a808c2402bba5012f6c60b27661c', 1, 14, 37),
(16, 'Jojojo', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 16, 32);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
 ADD PRIMARY KEY (`id_caracteristica`), ADD UNIQUE KEY `titulo` (`titulo`);

--
-- Indices de la tabla `detalles_caracteristicas`
--
ALTER TABLE `detalles_caracteristicas`
 ADD PRIMARY KEY (`id_detalle_caracteristica`), ADD KEY `id_caracteristica` (`id_caracteristica`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
 ADD PRIMARY KEY (`id_empleado`), ADD UNIQUE KEY `identificador` (`identificador`,`telefono`,`correo`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
 ADD PRIMARY KEY (`id_equipo`);

--
-- Indices de la tabla `imagenes_servicios`
--
ALTER TABLE `imagenes_servicios`
 ADD PRIMARY KEY (`id_imagen`), ADD UNIQUE KEY `titulo` (`titulo`), ADD UNIQUE KEY `titulo_2` (`titulo`), ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
 ADD PRIMARY KEY (`id_noticia`), ADD UNIQUE KEY `titulo` (`titulo`);

--
-- Indices de la tabla `paginas`
--
ALTER TABLE `paginas`
 ADD PRIMARY KEY (`id_pagina`), ADD UNIQUE KEY `encabezado` (`encabezado`);

--
-- Indices de la tabla `politicas`
--
ALTER TABLE `politicas`
 ADD PRIMARY KEY (`id_politica`), ADD UNIQUE KEY `titulo` (`titulo`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
 ADD PRIMARY KEY (`id_pregunta`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
 ADD PRIMARY KEY (`id_servicio`), ADD UNIQUE KEY `tipo` (`tipo`);

--
-- Indices de la tabla `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
 ADD PRIMARY KEY (`id_tipo_usuario`), ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `alias` (`alias`), ADD KEY `id_personal` (`id_empleado`,`id_tipo_usuario`), ADD KEY `fk_tipos_usuarios` (`id_tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
MODIFY `id_caracteristica` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalles_caracteristicas`
--
ALTER TABLE `detalles_caracteristicas`
MODIFY `id_detalle_caracteristica` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagenes_servicios`
--
ALTER TABLE `imagenes_servicios`
MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `paginas`
--
ALTER TABLE `paginas`
MODIFY `id_pagina` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `politicas`
--
ALTER TABLE `politicas`
MODIFY `id_politica` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_caracteristicas`
--
ALTER TABLE `detalles_caracteristicas`
ADD CONSTRAINT `fk_caracteristicas_detalles` FOREIGN KEY (`id_caracteristica`) REFERENCES `caracteristicas` (`id_caracteristica`);

--
-- Filtros para la tabla `imagenes_servicios`
--
ALTER TABLE `imagenes_servicios`
ADD CONSTRAINT `fk_servicios_imagenes` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
ADD CONSTRAINT `fk_empleados_usuarios` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`),
ADD CONSTRAINT `fk_tipos_usuarios` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipos_usuarios` (`id_tipo_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
