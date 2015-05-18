-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2015 a las 00:45:35
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
  `titulo` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `id_pagina` int(11) NOT NULL
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id_pagina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones`
--

CREATE TABLE IF NOT EXISTS `funciones` (
`id_funcion` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `funciones`
--

INSERT INTO `funciones` (`id_funcion`, `nombre`, `descripcion`) VALUES
(1, 'Mantenimiento de Funciones', 'Consiste en crear, modificar y ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones_tipos_usuarios`
--

CREATE TABLE IF NOT EXISTS `funciones_tipos_usuarios` (
`id_relacion` int(11) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `id_funcion` int(11) NOT NULL
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
  `leyenda` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

CREATE TABLE IF NOT EXISTS `paginas` (
`id_pagina` int(11) NOT NULL,
  `encabezado` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `frase` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `politicas`
--

CREATE TABLE IF NOT EXISTS `politicas` (
`id_politica` int(11) NOT NULL,
  `titulo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_pagina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE IF NOT EXISTS `preguntas` (
`id_pregunta` int(11) NOT NULL,
  `pregunta` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `respuesta` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `id_pagina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
`id_servicio` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `precio` decimal(7,2) unsigned NOT NULL,
  `id_pagina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuarios`
--

CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
`id_tipo_usuario` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id_usuario` int(11) NOT NULL,
  `alias` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `contraseña` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
 ADD PRIMARY KEY (`id_caracteristica`), ADD UNIQUE KEY `titulo` (`titulo`), ADD KEY `id_pagina` (`id_pagina`);

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
 ADD PRIMARY KEY (`id_equipo`), ADD KEY `id_pagina` (`id_pagina`);

--
-- Indices de la tabla `funciones`
--
ALTER TABLE `funciones`
 ADD PRIMARY KEY (`id_funcion`), ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `funciones_tipos_usuarios`
--
ALTER TABLE `funciones_tipos_usuarios`
 ADD PRIMARY KEY (`id_relacion`), ADD KEY `id_tipo_usuario` (`id_tipo_usuario`,`id_funcion`), ADD KEY `fk_funciones_tipos_usuarios` (`id_funcion`);

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
 ADD PRIMARY KEY (`id_politica`), ADD UNIQUE KEY `titulo` (`titulo`), ADD KEY `id_pagina` (`id_pagina`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
 ADD PRIMARY KEY (`id_pregunta`), ADD KEY `id_pagina` (`id_pagina`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
 ADD PRIMARY KEY (`id_servicio`), ADD UNIQUE KEY `tipo` (`tipo`), ADD KEY `id_pagina` (`id_pagina`);

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
MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `funciones`
--
ALTER TABLE `funciones`
MODIFY `id_funcion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `funciones_tipos_usuarios`
--
ALTER TABLE `funciones_tipos_usuarios`
MODIFY `id_relacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagenes_servicios`
--
ALTER TABLE `imagenes_servicios`
MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT;
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
MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
ADD CONSTRAINT `fk_paginas_caracteristicas` FOREIGN KEY (`id_pagina`) REFERENCES `paginas` (`id_pagina`);

--
-- Filtros para la tabla `detalles_caracteristicas`
--
ALTER TABLE `detalles_caracteristicas`
ADD CONSTRAINT `fk_caracteristicas_detalles` FOREIGN KEY (`id_caracteristica`) REFERENCES `caracteristicas` (`id_caracteristica`);

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
ADD CONSTRAINT `fk_paginas_equipos` FOREIGN KEY (`id_pagina`) REFERENCES `paginas` (`id_pagina`);

--
-- Filtros para la tabla `funciones_tipos_usuarios`
--
ALTER TABLE `funciones_tipos_usuarios`
ADD CONSTRAINT `fk_funciones_tipos_usuarios` FOREIGN KEY (`id_funcion`) REFERENCES `funciones` (`id_funcion`),
ADD CONSTRAINT `fk_tipos_usuarios_funciones` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipos_usuarios` (`id_tipo_usuario`);

--
-- Filtros para la tabla `imagenes_servicios`
--
ALTER TABLE `imagenes_servicios`
ADD CONSTRAINT `fk_servicios_imagenes` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`);

--
-- Filtros para la tabla `politicas`
--
ALTER TABLE `politicas`
ADD CONSTRAINT `fk_equipos_politicas` FOREIGN KEY (`id_pagina`) REFERENCES `paginas` (`id_pagina`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
ADD CONSTRAINT `fk_paginas_preguntas` FOREIGN KEY (`id_pagina`) REFERENCES `paginas` (`id_pagina`);

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
ADD CONSTRAINT `fk_paginas_servicios` FOREIGN KEY (`id_pagina`) REFERENCES `paginas` (`id_pagina`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
ADD CONSTRAINT `fk_empleados_usuarios` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`),
ADD CONSTRAINT `fk_tipos_usuarios` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipos_usuarios` (`id_tipo_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
