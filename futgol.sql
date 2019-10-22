-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-10-2019 a las 19:38:57
-- Versión del servidor: 5.7.27-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `futgol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancha`
--

CREATE TABLE `cancha` (
  `id` int(11) NOT NULL,
  `complejo_id` int(11) NOT NULL,
  `jugadores` int(11) NOT NULL,
  `abierta` tinyint(1) NOT NULL DEFAULT '1',
  `caracteristicas` varchar(255) DEFAULT NULL,
  `tipo_superficie_id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cancha`
--

INSERT INTO `cancha` (`id`, `complejo_id`, `jugadores`, `abierta`, `caracteristicas`, `tipo_superficie_id`, `nombre`) VALUES
(5, 1, 12, 0, 'Cancha 1', 2, 'Cancha 1'),
(6, 1, 12, 1, ' Cancha 2', 1, 'Cancha 2'),
(7, 4, 10, 0, 'fsdfsdfsd', 2, 'Cancha 3'),
(8, 4, 10, 1, 'se requiere llevar camisetas', 3, 'Cancha 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre`) VALUES
(1, 'Viedma'),
(2, 'Patagones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complejo`
--

CREATE TABLE `complejo` (
  `id` int(11) NOT NULL,
  `ciudad_id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `complejo`
--

INSERT INTO `complejo` (`id`, `ciudad_id`, `nombre`, `direccion`, `telefono`, `email`, `usuario_id`) VALUES
(1, 1, 'Villa Congreso', 'zatti 123', '1542658', 'b@b.com', 2),
(2, 1, 'Los hermanos', 'Caseros 1231', '1542658', 'adas@fas.com', 2),
(3, 1, 'Pasion por el futbol', 'Rio Limay 123', '232', 'dsasd', 2),
(4, 1, 'Todo futbol', 'Laprida 123', '4522654', 'eliasrelmuan@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia_semana`
--

CREATE TABLE `dia_semana` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dia_semana`
--

INSERT INTO `dia_semana` (`id`, `descripcion`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sábado'),
(7, 'Domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_complejo`
--

CREATE TABLE `imagen_complejo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `path` varchar(255) NOT NULL,
  `complejo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitacion`
--

CREATE TABLE `invitacion` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `partido_id` int(11) NOT NULL,
  `aceptada` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `invitacion`
--
DELIMITER $$
CREATE TRIGGER `triger_usuario_acepta_invitacion` AFTER UPDATE ON `invitacion` FOR EACH ROW INSERT INTO
  jugador(partido_id, usuario_id, id)
VALUES(old.partido_id, old.usuario_id, null)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `partido_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `id` int(11) NOT NULL,
  `reserva_id` int(11) NOT NULL,
  `reglas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`id`, `reserva_id`, `reglas`) VALUES
(1, 49, ''),
(2, 52, NULL),
(3, 56, NULL),
(4, 57, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cancha_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cancelada` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id`, `usuario_id`, `cancha_id`, `fecha`, `cancelada`) VALUES
(49, 1, 8, '2019-10-07 15:00:00', 0),
(52, 1, 7, '2019-10-09 12:00:00', 0),
(56, 1, 5, '2019-10-25 20:00:00', 0),
(57, 1, 5, '2019-10-25 21:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'Jugador'),
(2, 'Administrador'),
(3, 'Programador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `icono` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`, `icono`) VALUES
(2, 'Baños', 'fa fa-bath'),
(3, 'Petvet', 'fa fa-dsd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_complejo`
--

CREATE TABLE `servicio_complejo` (
  `servicio_id` int(11) NOT NULL,
  `complejo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_superficie`
--

CREATE TABLE `tipo_superficie` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_superficie`
--

INSERT INTO `tipo_superficie` (`id`, `nombre`) VALUES
(1, 'Cemento'),
(2, 'Sintético'),
(3, 'Tierra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `id` int(11) NOT NULL,
  `dia` varchar(25) NOT NULL,
  `hora_desde` time NOT NULL,
  `cancha_id` int(11) NOT NULL,
  `hora_hasta` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`id`, `dia`, `hora_desde`, `cancha_id`, `hora_hasta`) VALUES
(2, '1', '15:00:00', 8, '23:00:00'),
(3, '3', '15:00:00', 7, '00:00:00'),
(4, '3', '14:00:00', 5, '00:00:00'),
(5, '4', '18:00:00', 5, '00:00:00'),
(6, '7', '20:00:00', 6, '00:00:00'),
(7, '5', '15:00:00', 6, '23:00:00'),
(8, '5', '16:00:00', 5, '23:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `pwd` varchar(20) NOT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `rol_id` int(11) NOT NULL DEFAULT '1',
  `usuario` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `nombre`, `apellido`, `activo`, `pwd`, `imagen`, `rol_id`, `usuario`) VALUES
(1, 'a@a.com', 'Alvaro', 'AA', 1, 'seu.8HpuOxyTU', NULL, 1, NULL),
(2, 'b@b.com', 'Beto', 'BB', 1, 'seu.8HpuOxyTU', NULL, 1, NULL),
(4, 'bati@gmail.com', 'Rodrigo', 'Bati', 1, 'seu.8HpuOxyTU', NULL, 1, NULL),
(5, 'arce@mail.com', 'arcingui', 'arce', 1, 'seu.8HpuOxyTU', NULL, 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cancha`
--
ALTER TABLE `cancha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Cancha_Complejo_idx` (`complejo_id`),
  ADD KEY `fk_Cancha_Tipo_superficie1_idx` (`tipo_superficie_id`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `complejo`
--
ALTER TABLE `complejo`
  ADD PRIMARY KEY (`id`,`usuario_id`),
  ADD KEY `fk_Complejo_Localidad1_idx` (`ciudad_id`),
  ADD KEY `fk_Complejo_Usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `dia_semana`
--
ALTER TABLE `dia_semana`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagen_complejo`
--
ALTER TABLE `imagen_complejo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_imagen_complejo_complejo1_idx` (`complejo_id`);

--
-- Indices de la tabla `invitacion`
--
ALTER TABLE `invitacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Invitacion_Usuario1_idx` (`usuario_id`),
  ADD KEY `fk_Invitacion_Partido1_idx` (`partido_id`);

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Partido_has_Usuario_Usuario1_idx` (`usuario_id`),
  ADD KEY `fk_Partido_has_Usuario_Partido1_idx` (`partido_id`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`id`,`reserva_id`),
  ADD KEY `fk_Partido_Reserva1_idx` (`reserva_id`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reserva_de_cancha` (`cancha_id`,`fecha`) USING BTREE,
  ADD KEY `fk_Reserva_Usuario1_idx` (`usuario_id`),
  ADD KEY `fk_Reserva_Cancha1_idx` (`cancha_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicio_complejo`
--
ALTER TABLE `servicio_complejo`
  ADD PRIMARY KEY (`servicio_id`,`complejo_id`);

--
-- Indices de la tabla `tipo_superficie`
--
ALTER TABLE `tipo_superficie`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Turno_Cancha1_idx` (`cancha_id`),
  ADD KEY `fk_turno_dia_idx` (`dia`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`,`rol_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_Usuario_Rol1_idx` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cancha`
--
ALTER TABLE `cancha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `complejo`
--
ALTER TABLE `complejo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `dia_semana`
--
ALTER TABLE `dia_semana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `imagen_complejo`
--
ALTER TABLE `imagen_complejo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `invitacion`
--
ALTER TABLE `invitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipo_superficie`
--
ALTER TABLE `tipo_superficie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cancha`
--
ALTER TABLE `cancha`
  ADD CONSTRAINT `fk_Cancha_Complejo` FOREIGN KEY (`complejo_id`) REFERENCES `complejo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cancha_Tipo_superficie1` FOREIGN KEY (`tipo_superficie_id`) REFERENCES `tipo_superficie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `complejo`
--
ALTER TABLE `complejo`
  ADD CONSTRAINT `fk_Complejo_Localidad1` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Complejo_Usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `imagen_complejo`
--
ALTER TABLE `imagen_complejo`
  ADD CONSTRAINT `fk_imagen_complejo_complejo1` FOREIGN KEY (`complejo_id`) REFERENCES `complejo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `invitacion`
--
ALTER TABLE `invitacion`
  ADD CONSTRAINT `fk_Invitacion_Partido1` FOREIGN KEY (`partido_id`) REFERENCES `partido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Invitacion_Usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD CONSTRAINT `fk_Partido_has_Usuario_Partido1` FOREIGN KEY (`partido_id`) REFERENCES `partido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Partido_has_Usuario_Usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `partido`
--
ALTER TABLE `partido`
  ADD CONSTRAINT `fk_Partido_Reserva1` FOREIGN KEY (`reserva_id`) REFERENCES `reserva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_Reserva_Cancha1` FOREIGN KEY (`cancha_id`) REFERENCES `cancha` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reserva_Usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `turno`
--
ALTER TABLE `turno`
  ADD CONSTRAINT `fk_Turno_Cancha1` FOREIGN KEY (`cancha_id`) REFERENCES `cancha` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Rol1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
