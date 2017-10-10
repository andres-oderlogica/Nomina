-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2017 a las 21:11:09
-- Versión del servidor: 10.1.22-MariaDB
-- Versión de PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nomina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id_config` int(11) NOT NULL,
  `nombre_empresa` varchar(200) DEFAULT NULL,
  `nit` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `ciudad` varchar(70) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `id_contrato` int(11) NOT NULL,
  `numero_contrato` varchar(200) DEFAULT NULL,
  `id_tipocontrato` int(11) DEFAULT NULL,
  `vigencia` varchar(10) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `valor_contrato` double DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `id_salario` int(11) DEFAULT NULL,
  `id_trabajador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`id_contrato`, `numero_contrato`, `id_tipocontrato`, `vigencia`, `fecha_inicio`, `fecha_fin`, `valor_contrato`, `id_estado`, `id_salario`, `id_trabajador`) VALUES
(21, 'CONT - 1', 1, '2017', '2017-01-01', '2018-01-01', 9528000, 1, 1, 6),
(22, 'CONT - 22', 1, '2017', '2017-01-01', '2018-06-01', 13498000, 1, 1, 6),
(24, 'CONT - 23', 3, '2017', '2017-01-01', '2017-02-01', 1000000, 1, 3, 6);

--
-- Disparadores `contrato`
--
DELIMITER $$
CREATE TRIGGER `	update_contrato` BEFORE UPDATE ON `contrato` FOR EACH ROW BEGIN
set @meses = period_diff(date_format(new.fecha_fin,'%Y%m'),date_format(new.fecha_inicio,'%Y%m'));
set @pago = (select valor_salario from salario where salario.id_salario = new.id_salario);
set @aux = (select aux_transporte from salario where salario.id_salario = new.id_salario);
IF (new.id_salario = 1) THEN
        SET @total = (@pago + @aux) * @meses;
        SET new.valor_contrato =  @total;
    ELSE
        SET @total = @pago * @meses;
        SET new.valor_contrato =  @total;
    END IF;



END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `num_contrato` BEFORE INSERT ON `contrato` FOR EACH ROW BEGIN
set @meses = period_diff(date_format(new.fecha_fin,'%Y%m'),date_format(new.fecha_inicio,'%Y%m'));
set @pago = (select valor_salario from salario where salario.id_salario = new.id_salario);
set @aux = (select aux_transporte from salario where salario.id_salario = new.id_salario);
IF (new.id_salario = 1) THEN
        SET @total = (@pago + @aux) * @meses;
        SET new.valor_contrato =  @total;
    ELSE
        SET @total = @pago * @meses;
        SET new.valor_contrato =  @total;
    END IF;

set @id = (select max(id_contrato) from contrato);
set @prefijo = 'CONT - ';
IF (@id>0 || @id = null) THEN
        SET new.numero_contrato = CONCAT(@prefijo,'',@id+1);
    ELSE
        SET new.numero_contrato = CONCAT(@prefijo,'',1);
    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidad`
--

CREATE TABLE `entidad` (
  `id_entidad` int(11) NOT NULL,
  `codigo` varchar(70) DEFAULT NULL,
  `nombre_entidad` varchar(100) DEFAULT NULL,
  `estado_entidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entidad`
--

INSERT INTO `entidad` (`id_entidad`, `codigo`, `nombre_entidad`, `estado_entidad`) VALUES
(1, '1900100046495', 'HOGAR GENIECILLOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidadxtrabajador`
--

CREATE TABLE `entidadxtrabajador` (
  `id_e_x_t` int(11) NOT NULL,
  `id_entidad` int(11) DEFAULT NULL,
  `id_trabajador` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `descripcion`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mes`
--

CREATE TABLE `mes` (
  `id_mes` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mes`
--

INSERT INTO `mes` (`id_mes`, `descripcion`, `numero`) VALUES
(1, 'ENERO', 1),
(2, 'FEBRERO', 2),
(3, 'MARZO', 3),
(4, 'ABRIL', 4),
(5, 'MAYO', 5),
(6, 'JUNIO', 6),
(7, 'JULIO', 7),
(8, 'AGOSTO', 8),
(9, 'SEPTIEMBRE', 9),
(10, 'OCTUBRE', 10),
(11, 'NOVIEMBRE', 11),
(12, 'DICIEMBRE', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `id_e_x_t` int(11) DEFAULT NULL,
  `id_contrato` int(11) DEFAULT NULL,
  `valor_salario` double DEFAULT NULL,
  `valor_descuentos` double DEFAULT NULL,
  `valor_pagado` double DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salario`
--

CREATE TABLE `salario` (
  `id_salario` int(11) NOT NULL,
  `descripcion_salario` varchar(50) DEFAULT NULL,
  `valor_salario` double NOT NULL,
  `aux_transporte` double DEFAULT NULL,
  `desc_salud` double DEFAULT NULL,
  `desc_pension` double DEFAULT NULL,
  `desc_asociacion` double DEFAULT NULL,
  `desc_cooperativa` double DEFAULT NULL,
  `cesantias` double DEFAULT NULL,
  `primas` double DEFAULT NULL,
  `ahorros` double DEFAULT NULL,
  `comisiones` double DEFAULT NULL,
  `otros` double DEFAULT NULL,
  `caja_compensacion` double DEFAULT NULL,
  `arl` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salario`
--

INSERT INTO `salario` (`id_salario`, `descripcion_salario`, `valor_salario`, `aux_transporte`, `desc_salud`, `desc_pension`, `desc_asociacion`, `desc_cooperativa`, `cesantias`, `primas`, `ahorros`, `comisiones`, `otros`, `caja_compensacion`, `arl`) VALUES
(1, 'SALARIO MINIMO', 757000, 37000, 54000, 54000, 8000, 7000, 757000, 757000, 0, 0, 0, 15000, 2000),
(3, 'DIGITADOR', 1000000, 0, 0, 0, 0, 20000, 0, 0, 10000, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_contrato`
--

CREATE TABLE `tipo_contrato` (
  `id_tipocontrato` int(11) NOT NULL,
  `descripcion` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_contrato`
--

INSERT INTO `tipo_contrato` (`id_tipocontrato`, `descripcion`) VALUES
(1, 'TERMINO FIJO'),
(2, 'TERMINO INDEFINIDO'),
(3, 'PRESTACION DE SERVICIOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipodocumento` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipodocumento`, `descripcion`) VALUES
(1, 'CEDULA DE CIUDADANIA'),
(2, 'TARJETA DE IDENTIDAD'),
(3, 'CEDULA EXTRANJERO'),
(4, 'NIT'),
(5, 'RUT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `id_trabajador` int(11) NOT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `id_tipodocumento` int(11) DEFAULT NULL,
  `documento` varchar(70) DEFAULT NULL,
  `primer_nombre` varchar(50) DEFAULT NULL,
  `segundo_nombre` varchar(50) DEFAULT NULL,
  `primer_apellido` varchar(50) DEFAULT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `barrio` varchar(100) DEFAULT NULL,
  `telefono_fijo` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`id_trabajador`, `codigo`, `id_tipodocumento`, `documento`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `direccion`, `barrio`, `telefono_fijo`, `celular`, `email`, `id_estado`) VALUES
(6, '12345', 1, '10301821', 'ANDRES', 'EDUARDO', 'DAMIAN', 'FLOREZ', 'CENTRO', 'CENTRO', '222222', '222222', 'andrescamila04@hotmail.com', 2),
(25, '12345', 1, '12344', 'ANDRES', 'EDUARDO', 'DAMIAN', 'FLOREZ', 'CENTRO', 'CENTRO', '222222', '222222', 'andrescamila04@hotmail.com', 1),
(26, '12345', 3, '12344', 'ANDRES', '', 'DAMIAN', '', '', '', '', '', 'andrescamila04@hotmail.com', 1),
(27, '12345', 3, '12344', 'ANDRES', '', 'DAMIAN', '', '', '', '', '', 'andrescamila04@hotmail.com', 2),
(28, '', 1, '10301821', 'ANDRES', '', 'DAMIAN', '', '', '', '', '', 'andrescamila04@hotmail.com', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `user_name`, `user_password_hash`, `user_email`, `date_added`) VALUES
(1, 'admin', 'admin', 'admin', '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO', 'admin@admin.com', '2016-05-21 15:06:00'),
(2, 'Juan', 'Andres', 'juan', '$2y$10$AU4u7/QPWg27Gxk9iN16SeHbrr.QsRXt2VQ2H884UAKwJEDGk8A.O', 'juanandres@gmail.com', '2016-10-06 21:21:37'),
(74, 'alex', 'baqueando', 'alexba', '$2y$10$qZaIXRimsy1bj2oe.oYqgOU/f6v9MREbq5sZNiNiSkg1y7UWuDVDy', 'alexba@hotmail.com', '2017-06-07 01:22:14'),
(75, 'alex', 'a', 'bloquear', '$2y$10$vZCXP2zDGTDvnWrtNezs9OMwuM8VE1yHqMDyBYJa0R6Z12ULuu26.', 'b@gmail.com', '2017-06-07 05:21:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id_config`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`id_contrato`),
  ADD KEY `tipoconttrato_idxestado_idx` (`id_tipocontrato`),
  ADD KEY `estadocontrato_idxestado_idx` (`id_estado`),
  ADD KEY `slario_idx_idx` (`id_salario`),
  ADD KEY `trabajador_fxk_idx` (`id_trabajador`);

--
-- Indices de la tabla `entidad`
--
ALTER TABLE `entidad`
  ADD PRIMARY KEY (`id_entidad`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  ADD KEY `estado_idx_idx` (`estado_entidad`);

--
-- Indices de la tabla `entidadxtrabajador`
--
ALTER TABLE `entidadxtrabajador`
  ADD PRIMARY KEY (`id_e_x_t`),
  ADD KEY `trabajadoridx_id_idx` (`id_trabajador`),
  ADD KEY `entidadidx_id_idx` (`id_entidad`),
  ADD KEY `estadoidx_ide_x_t_idx` (`id_estado`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `mes`
--
ALTER TABLE `mes`
  ADD PRIMARY KEY (`id_mes`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `idx_e_x_t_id_idx` (`id_e_x_t`),
  ADD KEY `idx_contrato_id_idx` (`id_contrato`),
  ADD KEY `idx_estado:idpago_idx` (`id_estado`);

--
-- Indices de la tabla `salario`
--
ALTER TABLE `salario`
  ADD PRIMARY KEY (`id_salario`);

--
-- Indices de la tabla `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  ADD PRIMARY KEY (`id_tipocontrato`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipodocumento`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`id_trabajador`),
  ADD KEY `tipo_doc_idxtrabajador_idx` (`id_tipodocumento`),
  ADD KEY `estado_idxtrabajador_idx` (`id_estado`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `entidad`
--
ALTER TABLE `entidad`
  MODIFY `id_entidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `entidadxtrabajador`
--
ALTER TABLE `entidadxtrabajador`
  MODIFY `id_e_x_t` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `mes`
--
ALTER TABLE `mes`
  MODIFY `id_mes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `salario`
--
ALTER TABLE `salario`
  MODIFY `id_salario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  MODIFY `id_tipocontrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipodocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `id_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=76;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `estadocontrato_idxestado` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `slario_idx` FOREIGN KEY (`id_salario`) REFERENCES `salario` (`id_salario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tipoconttrato_idxestado` FOREIGN KEY (`id_tipocontrato`) REFERENCES `tipo_contrato` (`id_tipocontrato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `trabajador_fxk` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajador` (`id_trabajador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `entidad`
--
ALTER TABLE `entidad`
  ADD CONSTRAINT `estado_idx` FOREIGN KEY (`estado_entidad`) REFERENCES `estado` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `entidadxtrabajador`
--
ALTER TABLE `entidadxtrabajador`
  ADD CONSTRAINT `entidadidx_id` FOREIGN KEY (`id_entidad`) REFERENCES `entidad` (`id_entidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `estadoidx_ide_x_t` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `trabajadoridx_id` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajador` (`id_trabajador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `idx_contrato_id` FOREIGN KEY (`id_contrato`) REFERENCES `contrato` (`id_contrato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idx_e_x_t_id` FOREIGN KEY (`id_e_x_t`) REFERENCES `entidadxtrabajador` (`id_e_x_t`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idx_estado_dpago` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD CONSTRAINT `estado_idxtrabajador` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tipo_doc_idxtrabajador` FOREIGN KEY (`id_tipodocumento`) REFERENCES `tipo_documento` (`id_tipodocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
