-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-01-2021 a las 23:55:30
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_auditoria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actualizacion`
--

CREATE TABLE `actualizacion` (
  `id_actualizacion` int(11) NOT NULL,
  `nom_tabla` varchar(50) NOT NULL,
  `nom_campo` varchar(50) NOT NULL,
  `accion` enum('Actualización','Eliminación') NOT NULL,
  `id_registro` int(11) NOT NULL,
  `registro` varchar(100) NOT NULL,
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_usuario_creacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos`
--

CREATE TABLE `anexos` (
  `id_anexo` int(11) NOT NULL,
  `id_ejecucion_auditoria` int(11) NOT NULL,
  `nombre_anexo` varchar(255) NOT NULL,
  `estado_anexo` tinyint(1) NOT NULL,
  `ruta_anexo` varchar(255) NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `anexos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL,
  `id_usuario_encargado` int(11) NOT NULL,
  `nombre_unidad` varchar(45) NOT NULL,
  `certificado` enum('si certificado','no certificado') NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `areas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria_programacion`
--

CREATE TABLE `auditoria_programacion` (
  `id_auditoria` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_usu_auditor` int(11) NOT NULL,
  `tipo_auditoria` varchar(45) NOT NULL,
  `fecha_programacion` date NOT NULL,
  `estado_auditoria` enum('Programada','En proceso','Finalizada') NOT NULL COMMENT 'Agregar los estados de una auditoria',
  `observacion` mediumtext DEFAULT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `auditoria_programacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `backup`
--

CREATE TABLE `backup` (
  `id_backup` int(11) NOT NULL,
  `dia_respaldo` int(11) NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejecucion_auditoria`
--

CREATE TABLE `ejecucion_auditoria` (
  `id_ejecucion_auditoria` int(11) NOT NULL,
  `id_auditoria_programada` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date DEFAULT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ejecucion_auditoria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hallazgo`
--

CREATE TABLE `hallazgo` (
  `id_hallazgo` int(11) NOT NULL,
  `id_ejecucion_auditoria` int(11) NOT NULL,
  `fecha_hallazgo` datetime NOT NULL,
  `tema_hallazgo` mediumtext NOT NULL,
  `acciones_planteadas` mediumtext NOT NULL,
  `aspecto_mejora` mediumtext NOT NULL,
  `ruta_evidencia` varchar(255) NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hallazgo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `nombre_pri_per` varchar(45) NOT NULL,
  `nombre_seg_per` varchar(45) DEFAULT NULL,
  `apellido_pri_per` varchar(45) NOT NULL,
  `apellido_seg_per` varchar(45) DEFAULT NULL,
  `tipo_doc_per` varchar(45) NOT NULL,
  `num_documento` varchar(45) NOT NULL,
  `num_celular` varchar(45) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fecha_nac_per` date NOT NULL,
  `genero_per` enum('Masculino','Femenino','Prefiero no decirlo') NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_mejoramiento`
--

CREATE TABLE `plan_mejoramiento` (
  `id_plan_mejoramiento` int(11) NOT NULL,
  `id_hallazgo` int(11) NOT NULL,
  `fecha_evidencia` date NOT NULL,
  `ruta_evidencia` varchar(255) DEFAULT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado_plaMejor` enum('Abierto','Sin avance','Cerrado','Vencido') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prorroga_mejoramiento`
--

CREATE TABLE `prorroga_mejoramiento` (
  `id_prorroga_mejoramiento` int(11) NOT NULL,
  `id_plan_mejoramiento` int(11) NOT NULL,
  `fecha_adicional` varchar(45) NOT NULL,
  `estado_prorroga` tinyint(1) NOT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(45) NOT NULL,
  `estado_rol` tinyint(4) NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trasa_anexos`
--

CREATE TABLE `trasa_anexos` (
  `id_trasa_anexos` int(11) NOT NULL,
  `id_anexo` int(11) NOT NULL,
  `id_usuario_validacion` int(11) NOT NULL,
  `fecha_validacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `observa_anexo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `trasa_anexos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `cod_contrato_usu` varchar(45) NOT NULL,
  `pass_usu` varchar(150) NOT NULL,
  `estado_usu` tinyint(4) NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id_usuario_rol` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_rol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--

CREATE TABLE `vacaciones` (
  `id_vacaciones` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado_vacaciones` tinyint(4) NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actualizacion`
--
ALTER TABLE `actualizacion`
  ADD PRIMARY KEY (`id_actualizacion`);

--
-- Indices de la tabla `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`id_anexo`),
  ADD KEY `fk_anexo_ejecuAud` (`id_ejecucion_auditoria`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_area`),
  ADD UNIQUE KEY `nombre_unidad` (`nombre_unidad`),
  ADD KEY `fk_unidadNegocio_usuario` (`id_usuario_encargado`);

--
-- Indices de la tabla `auditoria_programacion`
--
ALTER TABLE `auditoria_programacion`
  ADD PRIMARY KEY (`id_auditoria`),
  ADD KEY `fk_auditoria_area` (`id_area`),
  ADD KEY `fk_auditoria_usuario` (`id_usu_auditor`);

--
-- Indices de la tabla `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`id_backup`);

--
-- Indices de la tabla `ejecucion_auditoria`
--
ALTER TABLE `ejecucion_auditoria`
  ADD PRIMARY KEY (`id_ejecucion_auditoria`),
  ADD KEY `fk_audP_audE` (`id_auditoria_programada`);

--
-- Indices de la tabla `hallazgo`
--
ALTER TABLE `hallazgo`
  ADD PRIMARY KEY (`id_hallazgo`),
  ADD KEY `fk_hallazgo_auditoria` (`id_ejecucion_auditoria`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `plan_mejoramiento`
--
ALTER TABLE `plan_mejoramiento`
  ADD PRIMARY KEY (`id_plan_mejoramiento`),
  ADD KEY `fk_plan_hallazgo` (`id_hallazgo`);

--
-- Indices de la tabla `prorroga_mejoramiento`
--
ALTER TABLE `prorroga_mejoramiento`
  ADD PRIMARY KEY (`id_prorroga_mejoramiento`),
  ADD KEY `fk_prorroga_planMejora` (`id_plan_mejoramiento`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `trasa_anexos`
--
ALTER TABLE `trasa_anexos`
  ADD PRIMARY KEY (`id_trasa_anexos`),
  ADD KEY `fk_tras_anexo` (`id_anexo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuario_persona` (`id_persona`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id_usuario_rol`),
  ADD KEY `fk_usuarioRol_rol` (`id_rol`),
  ADD KEY `fk_usuarioRol_usuarios` (`id_usuario`);

--
-- Indices de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`id_vacaciones`),
  ADD KEY `fk_vaciones_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actualizacion`
--
ALTER TABLE `actualizacion`
  MODIFY `id_actualizacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `anexos`
--
ALTER TABLE `anexos`
  MODIFY `id_anexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `auditoria_programacion`
--
ALTER TABLE `auditoria_programacion`
  MODIFY `id_auditoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `backup`
--
ALTER TABLE `backup`
  MODIFY `id_backup` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ejecucion_auditoria`
--
ALTER TABLE `ejecucion_auditoria`
  MODIFY `id_ejecucion_auditoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `hallazgo`
--
ALTER TABLE `hallazgo`
  MODIFY `id_hallazgo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `plan_mejoramiento`
--
ALTER TABLE `plan_mejoramiento`
  MODIFY `id_plan_mejoramiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prorroga_mejoramiento`
--
ALTER TABLE `prorroga_mejoramiento`
  MODIFY `id_prorroga_mejoramiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `trasa_anexos`
--
ALTER TABLE `trasa_anexos`
  MODIFY `id_trasa_anexos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  MODIFY `id_usuario_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `id_vacaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anexos`
--
ALTER TABLE `anexos`
  ADD CONSTRAINT `fk_anexo_ejecuAud` FOREIGN KEY (`id_ejecucion_auditoria`) REFERENCES `ejecucion_auditoria` (`id_ejecucion_auditoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `fk_unidadNegocio_usuario` FOREIGN KEY (`id_usuario_encargado`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auditoria_programacion`
--
ALTER TABLE `auditoria_programacion`
  ADD CONSTRAINT `fk_auditoria_area` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_auditoria_usuario` FOREIGN KEY (`id_usu_auditor`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ejecucion_auditoria`
--
ALTER TABLE `ejecucion_auditoria`
  ADD CONSTRAINT `fk_audP_audE` FOREIGN KEY (`id_auditoria_programada`) REFERENCES `auditoria_programacion` (`id_auditoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `hallazgo`
--
ALTER TABLE `hallazgo`
  ADD CONSTRAINT `fk_hallazgo_auditoria` FOREIGN KEY (`id_ejecucion_auditoria`) REFERENCES `ejecucion_auditoria` (`id_ejecucion_auditoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `plan_mejoramiento`
--
ALTER TABLE `plan_mejoramiento`
  ADD CONSTRAINT `fk_plan_hallazgo` FOREIGN KEY (`id_hallazgo`) REFERENCES `hallazgo` (`id_hallazgo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prorroga_mejoramiento`
--
ALTER TABLE `prorroga_mejoramiento`
  ADD CONSTRAINT `fk_prorroga_planMejora` FOREIGN KEY (`id_plan_mejoramiento`) REFERENCES `plan_mejoramiento` (`id_plan_mejoramiento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `trasa_anexos`
--
ALTER TABLE `trasa_anexos`
  ADD CONSTRAINT `fk_tras_anexo` FOREIGN KEY (`id_anexo`) REFERENCES `anexos` (`id_anexo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `fk_usuarioRol_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuarioRol_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD CONSTRAINT `fk_vaciones_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
