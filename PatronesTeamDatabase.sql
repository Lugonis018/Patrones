-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-07-2019 a las 19:24:34
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mydb`
--
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `mydb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignar`
--

CREATE TABLE `asignar` (
  `id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `Trabajos_id` int(11) NOT NULL,
  `fecha_asignacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignar`
--

INSERT INTO `asignar` (`id`, `usuarios_id`, `Trabajos_id`, `fecha_asignacion`) VALUES
(1, 1, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_documentos`
--

CREATE TABLE `tbl_documentos` (
  `id_documento` int(11) NOT NULL,
  `titulo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` mediumtext COLLATE utf8_unicode_ci,
  `tamanio` int(10) DEFAULT NULL,
  `tipo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_archivo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Trabajos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_trabajo`
--

CREATE TABLE `tipos_trabajo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_trabajo`
--

INSERT INTO `tipos_trabajo` (`id`, `nombre`) VALUES
(1, 'Servicio Técnico'),
(2, 'Desarrollo de Software'),
(3, 'Instalación de redes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos`
--

CREATE TABLE `trabajos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` text,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT 'En trabajo esta culminado o no.\n',
  `Tipos_trabajo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `trabajos`
--

INSERT INTO `trabajos` (`id`, `nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`, `status`, `Tipos_trabajo_id`) VALUES
(1, 'Casa Ricoleta1', 'Se necesita solucionar problemas entre los laboratorios de cï¿½mputo del centro', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1),
(2, 'Desarrollo Web', 'Desarrollo de un sitio web que pueda gustarte', '2019-07-03 04:50:00', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `apaterno` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `amaterno` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `usuario` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `clave` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tipo` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT 'el usuario esta activo o no',
  `fregistro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `apaterno`, `amaterno`, `nombre`, `usuario`, `clave`, `tipo`, `status`, `fregistro`) VALUES
(1, 'Aparcana', 'Tasayco', 'AndrÃ©s', 'aaparcana', '82670075', 1, 1, '2019-06-27 13:00:00'),
(2, 'PÃ©rez', 'Ventura', 'JosÃ©', 'jperez', '123456789', 2, 1, '2019-06-27 00:45:50'),
(3, 'Gonzales', 'PatrÃ³n', 'Luis', 'lgonzales', '987654321', 2, 1, '2019-06-27 00:50:34');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignar`
--
ALTER TABLE `asignar`
  ADD PRIMARY KEY (`id`,`usuarios_id`,`Trabajos_id`) USING BTREE,
  ADD KEY `fk_usuarios_has_Trabajos_Trabajos1_idx` (`Trabajos_id`),
  ADD KEY `fk_usuarios_has_Trabajos_usuarios_idx` (`usuarios_id`);

--
-- Indices de la tabla `tbl_documentos`
--
ALTER TABLE `tbl_documentos`
  ADD PRIMARY KEY (`id_documento`,`Trabajos_id`),
  ADD KEY `fk_tbl_documentos_Trabajos1_idx` (`Trabajos_id`);

--
-- Indices de la tabla `tipos_trabajo`
--
ALTER TABLE `tipos_trabajo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  ADD PRIMARY KEY (`id`,`Tipos_trabajo_id`),
  ADD KEY `fk_Trabajos_Tipo_trabajo1_idx` (`Tipos_trabajo_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignar`
--
ALTER TABLE `asignar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_documentos`
--
ALTER TABLE `tbl_documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_trabajo`
--
ALTER TABLE `tipos_trabajo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignar`
--
ALTER TABLE `asignar`
  ADD CONSTRAINT `fk_usuarios_has_Trabajos_Trabajos1` FOREIGN KEY (`Trabajos_id`) REFERENCES `trabajos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_has_Trabajos_usuarios` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_documentos`
--
ALTER TABLE `tbl_documentos`
  ADD CONSTRAINT `fk_tbl_documentos_Trabajos1` FOREIGN KEY (`Trabajos_id`) REFERENCES `trabajos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `trabajos`
--
ALTER TABLE `trabajos`
  ADD CONSTRAINT `fk_Trabajos_Tipo_trabajo1` FOREIGN KEY (`Tipos_trabajo_id`) REFERENCES `tipos_trabajo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
