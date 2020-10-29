-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2020 a las 15:05:29
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
-- Base de datos: `codeigniter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `ID_Administrador` int(11) NOT NULL COMMENT 'Identificacion del administrador',
  `Nombre_Administrador` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del administrador',
  `Apellido_Administrador` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Apellido del administrador',
  `Email_Administrador` text COLLATE utf8_spanish_ci NOT NULL COMMENT 'Correo para acceder al sistema',
  `Password_Administrador` text COLLATE utf8_spanish_ci NOT NULL COMMENT 'Contraseña para acceder al sistema'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`ID_Administrador`, `Nombre_Administrador`, `Apellido_Administrador`, `Email_Administrador`, `Password_Administrador`) VALUES
(1, 'Julio', 'Paucar', 'jp@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID_Cliente` int(11) NOT NULL COMMENT 'Identificador del cliente',
  `Nombre_Cliente` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del cliente',
  `Apellido_Cliente` varchar(40) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Apellido del cliente',
  `Telefono_Cliente` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Telefono del cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ID_Cliente`, `Nombre_Cliente`, `Apellido_Cliente`, `Telefono_Cliente`) VALUES
(3, 'Andrea', 'Rodriguez', '0968521145'),
(4, 'Roxana Maria', 'Perez', '0956855284'),
(5, 'David Alejandro', 'Paucar Briones', '0992896820');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_otploteo`
--

CREATE TABLE `detalle_otploteo` (
  `ID_DetalleOTPloteo` int(11) NOT NULL COMMENT 'Identificador del detalle de la orden de trabajo de ploteo',
  `ID_OTPloteo` int(11) NOT NULL COMMENT 'Identificador de la orden de trabajo de ploteo',
  `Precio_OTPloteo` double(255,2) NOT NULL COMMENT 'Precio calculado por los metro ploteados en la orden de trabajo de ploteo',
  `Importe_OTPloteo` double(255,2) NOT NULL COMMENT 'Importe individual de la orden de trabajo de ploteo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_otploteo`
--

INSERT INTO `detalle_otploteo` (`ID_DetalleOTPloteo`, `ID_OTPloteo`, `Precio_OTPloteo`, `Importe_OTPloteo`) VALUES
(73, 78, 2.00, 2.50),
(74, 79, 1.00, 1.25),
(75, 79, 1.00, 1.25),
(76, 79, 1.00, 1.25),
(77, 80, 2.00, 2.50),
(78, 80, 3.00, 3.75),
(79, 79, 1.00, 1.25),
(86, 82, 5.00, 6.25),
(87, 78, 7.00, 8.75);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ot_ploteo`
--

CREATE TABLE `ot_ploteo` (
  `ID_OTPloteo` int(11) NOT NULL COMMENT 'Identificador de la orden de trabajo de ploteo',
  `ID_Cliente` int(11) NOT NULL COMMENT 'Identificador del cliente',
  `ID_Documento` int(11) NOT NULL COMMENT 'Identificador del documento',
  `Subtotal_OTPloteo` double(255,2) NOT NULL COMMENT 'Subtotal de la orden de trabajo de ploteo',
  `Impuesto_OTPloteo` double(255,2) NOT NULL COMMENT 'Impuesto aplicado a la orden de trabajo de ploteo',
  `Total_OTPloteo` double(255,2) NOT NULL COMMENT 'Total de la orden de trabajo de ploteo',
  `NumeroDocumento_OTPloteo` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Numero de documento de la orden de trabajo de ploteo',
  `Serie_OTPloteo` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Serie del documento de la orden de trabajo de ploteo',
  `Fecha_OTPloteo` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de creacion de la orden de trabajo de ploteo',
  `Estado_OTPloteo` tinyint(1) NOT NULL COMMENT 'Estado del documento de la orden de trabajo de ploteo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ot_ploteo`
--

INSERT INTO `ot_ploteo` (`ID_OTPloteo`, `ID_Cliente`, `ID_Documento`, `Subtotal_OTPloteo`, `Impuesto_OTPloteo`, `Total_OTPloteo`, `NumeroDocumento_OTPloteo`, `Serie_OTPloteo`, `Fecha_OTPloteo`, `Estado_OTPloteo`) VALUES
(78, 5, 1, 11.25, 0.00, 11.25, '000035', '001', '2020-09-03 16:44:51', 1),
(79, 3, 2, 5.00, 0.60, 5.60, '000152', '001', '2020-09-03 16:13:08', 1),
(80, 3, 1, 6.25, 0.00, 6.25, '000036', '001', '2020-10-19 01:57:20', 1),
(82, 4, 2, 6.25, 0.75, 7.00, '000156', '001', '2020-10-22 16:14:12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ot_servicio_tecnico`
--

CREATE TABLE `ot_servicio_tecnico` (
  `ID_OTServicioTecnico` int(11) NOT NULL COMMENT 'Identificacion de la orden de trabajo de servicio tecnico',
  `ID_Cliente` int(11) NOT NULL COMMENT 'Identificador del cliente',
  `ID_Documento` int(11) NOT NULL COMMENT 'Identificador del documento',
  `Marca_OTServicioTecnico` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Marca de la orden de trabajo de servicio tecnico',
  `Modelo_OTServicioTecnico` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Modelo de la orden de trabajo de servicio tecnico',
  `Descripcion_OTServicioTecnico` text COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripcion de la orden de trabajo de servicio tecnico',
  `Subtotal_OTServicioTecnico` double(255,2) NOT NULL COMMENT 'Subtotal de la orden de trabajo de servicio tecnico',
  `Impuesto_OTServicioTecnico` double(255,2) NOT NULL COMMENT 'Impuesto de la orden de trabajo de servicio tecnico',
  `Total_OTServicioTecnico` double(255,2) NOT NULL COMMENT 'Total de la orden de trabajo de servicio tecnico',
  `NumeroDocumento_OTServicioTecnico` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Numero del documento de la orden de trabajo de servicio tecnico',
  `Serie_OTServicioTecnico` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Serie del documento de la orden de trabajo de servicio tecnico',
  `Fecha_OTServicioTecnico` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de creacion de la orden de trabajo de servicio tecnico',
  `Estado_OTServicioTecnico` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Estado del documento de la orden de trabajo de servicio tecnico'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ot_servicio_tecnico`
--

INSERT INTO `ot_servicio_tecnico` (`ID_OTServicioTecnico`, `ID_Cliente`, `ID_Documento`, `Marca_OTServicioTecnico`, `Modelo_OTServicioTecnico`, `Descripcion_OTServicioTecnico`, `Subtotal_OTServicioTecnico`, `Impuesto_OTServicioTecnico`, `Total_OTServicioTecnico`, `NumeroDocumento_OTServicioTecnico`, `Serie_OTServicioTecnico`, `Fecha_OTServicioTecnico`, `Estado_OTServicioTecnico`) VALUES
(204, 3, 2, 'Asus', 'df', 'Formateo de lap', 5.00, 0.60, 5.60, '000154', '001', '2020-08-03 20:41:31', 1),
(208, 4, 2, 'HP', 'L4150', 'Reseteo', 3.00, 0.36, 3.36, '000157', '001', '2020-10-27 22:27:22', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `ID_Documento` int(11) NOT NULL COMMENT 'Identificador del documento',
  `Nombre_Documento` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del documento',
  `Impuesto_Documento` int(11) NOT NULL COMMENT 'Impuesto del documento aplicadio si es factura o recibo',
  `Cantidad_Documento` int(11) NOT NULL COMMENT 'Cantidad de documentos generados',
  `Serie_Documento` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Serie del documento, factura o recibo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`ID_Documento`, `Nombre_Documento`, `Impuesto_Documento`, `Cantidad_Documento`, `Serie_Documento`) VALUES
(1, 'Recibo', 0, 38, 001),
(2, 'Factura', 12, 157, 001);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ID_Administrador`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID_Cliente`);

--
-- Indices de la tabla `detalle_otploteo`
--
ALTER TABLE `detalle_otploteo`
  ADD PRIMARY KEY (`ID_DetalleOTPloteo`),
  ADD KEY `ID_OTPloteo` (`ID_OTPloteo`);

--
-- Indices de la tabla `ot_ploteo`
--
ALTER TABLE `ot_ploteo`
  ADD PRIMARY KEY (`ID_OTPloteo`) USING BTREE,
  ADD KEY `ID_Documento` (`ID_Documento`) USING BTREE,
  ADD KEY `ID_Cliente` (`ID_Cliente`) USING BTREE;

--
-- Indices de la tabla `ot_servicio_tecnico`
--
ALTER TABLE `ot_servicio_tecnico`
  ADD PRIMARY KEY (`ID_OTServicioTecnico`) USING BTREE,
  ADD KEY `ID_Cliente` (`ID_Cliente`),
  ADD KEY `ID_Documento` (`ID_Documento`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`ID_Documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `ID_Administrador` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificacion del administrador', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del cliente', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_otploteo`
--
ALTER TABLE `detalle_otploteo`
  MODIFY `ID_DetalleOTPloteo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del detalle de la orden de trabajo de ploteo', AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `ot_ploteo`
--
ALTER TABLE `ot_ploteo`
  MODIFY `ID_OTPloteo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la orden de trabajo de ploteo', AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `ot_servicio_tecnico`
--
ALTER TABLE `ot_servicio_tecnico`
  MODIFY `ID_OTServicioTecnico` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificacion de la orden de trabajo de servicio tecnico', AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `ID_Documento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del documento', AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_otploteo`
--
ALTER TABLE `detalle_otploteo`
  ADD CONSTRAINT `detalle_otploteo_ibfk_1` FOREIGN KEY (`ID_OTPloteo`) REFERENCES `ot_ploteo` (`ID_OTPloteo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ot_ploteo`
--
ALTER TABLE `ot_ploteo`
  ADD CONSTRAINT `ot_ploteo_ibfk_1` FOREIGN KEY (`ID_Documento`) REFERENCES `tipo_documento` (`ID_Documento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ot_ploteo_ibfk_2` FOREIGN KEY (`ID_Cliente`) REFERENCES `cliente` (`ID_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ot_servicio_tecnico`
--
ALTER TABLE `ot_servicio_tecnico`
  ADD CONSTRAINT `ot_servicio_tecnico_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `cliente` (`ID_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ot_servicio_tecnico_ibfk_2` FOREIGN KEY (`ID_Documento`) REFERENCES `tipo_documento` (`ID_Documento`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
