-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-09-2020 a las 17:25:27
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

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
  `ID_Administrador` int(11) NOT NULL,
  `Nombre_Administrador` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido_Administrador` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Email_Administrador` text COLLATE utf8_spanish_ci NOT NULL,
  `Password_Administrador` text COLLATE utf8_spanish_ci NOT NULL
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
  `ID_Cliente` int(11) NOT NULL,
  `Nombre_Cliente` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido_Cliente` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono_Cliente` varchar(10) COLLATE utf8_spanish_ci NOT NULL
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
  `ID_DetalleOTPloteo` int(11) NOT NULL,
  `ID_OTPloteo` int(11) NOT NULL,
  `Precio_OTPloteo` double(255,2) NOT NULL,
  `Importe_OTPloteo` double(255,2) NOT NULL
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
(84, 78, 1.00, 1.25),
(85, 81, 5.00, 6.25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ot_ploteo`
--

CREATE TABLE `ot_ploteo` (
  `ID_OTPloteo` int(11) NOT NULL,
  `ID_Cliente` int(11) NOT NULL,
  `ID_Documento` int(11) NOT NULL,
  `Subtotal_OTPloteo` double(255,2) NOT NULL,
  `Impuesto_OTPloteo` double(255,2) NOT NULL,
  `Total_OTPloteo` double(255,2) NOT NULL,
  `NumeroDocumento_OTPloteo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Serie_OTPloteo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Fecha_OTPloteo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ot_ploteo`
--

INSERT INTO `ot_ploteo` (`ID_OTPloteo`, `ID_Cliente`, `ID_Documento`, `Subtotal_OTPloteo`, `Impuesto_OTPloteo`, `Total_OTPloteo`, `NumeroDocumento_OTPloteo`, `Serie_OTPloteo`, `Fecha_OTPloteo`) VALUES
(78, 5, 1, 3.75, 0.00, 3.75, '000035', '001', '2020-09-03 16:44:51'),
(79, 3, 2, 5.00, 0.60, 5.60, '000152', '001', '2020-09-03 16:13:08'),
(80, 3, 1, 6.25, 0.00, 6.25, '000036', '001', '2020-09-03 15:37:28'),
(81, 5, 1, 6.25, 0.00, 6.25, '000038', '001', '2020-09-03 21:06:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ot_servicio_tecnico`
--

CREATE TABLE `ot_servicio_tecnico` (
  `ID_OTServicioTecnico` int(11) NOT NULL,
  `ID_Cliente` int(11) NOT NULL,
  `ID_Documento` int(11) NOT NULL,
  `Marca_OTServicioTecnico` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Modelo_OTServicioTecnico` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion_OTServicioTecnico` text COLLATE utf8_spanish_ci NOT NULL,
  `Subtotal_OTServicioTecnico` double(255,2) NOT NULL,
  `Impuesto_OTServicioTecnico` double(255,2) NOT NULL,
  `Total_OTServicioTecnico` double(255,2) NOT NULL,
  `NumeroDocumento_OTServicioTecnico` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Serie_OTServicioTecnico` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Fecha_OTServicioTecnico` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ot_servicio_tecnico`
--

INSERT INTO `ot_servicio_tecnico` (`ID_OTServicioTecnico`, `ID_Cliente`, `ID_Documento`, `Marca_OTServicioTecnico`, `Modelo_OTServicioTecnico`, `Descripcion_OTServicioTecnico`, `Subtotal_OTServicioTecnico`, `Impuesto_OTServicioTecnico`, `Total_OTServicioTecnico`, `NumeroDocumento_OTServicioTecnico`, `Serie_OTServicioTecnico`, `Fecha_OTServicioTecnico`) VALUES
(204, 3, 2, 'Asus', 'df', 'Formateo de lap', 1.00, 0.12, 1.12, '000154', '001', '2020-08-03 20:41:31'),
(205, 4, 1, 'asdf', 'asdf', 'asdf', 34.00, 0.00, 34.00, '000037', '001', '2020-09-03 20:51:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `ID_Documento` int(11) NOT NULL,
  `Nombre_Documento` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Impuesto_Documento` int(11) NOT NULL,
  `Cantidad_Documento` int(11) NOT NULL,
  `Serie_Documento` int(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`ID_Documento`, `Nombre_Documento`, `Impuesto_Documento`, `Cantidad_Documento`, `Serie_Documento`) VALUES
(1, 'Recibo', 0, 38, 001),
(2, 'Factura', 12, 154, 001);

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
  MODIFY `ID_Administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_otploteo`
--
ALTER TABLE `detalle_otploteo`
  MODIFY `ID_DetalleOTPloteo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `ot_ploteo`
--
ALTER TABLE `ot_ploteo`
  MODIFY `ID_OTPloteo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `ot_servicio_tecnico`
--
ALTER TABLE `ot_servicio_tecnico`
  MODIFY `ID_OTServicioTecnico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `ID_Documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
