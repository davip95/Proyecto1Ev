-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2023 a las 20:55:46
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bunglebuildficherofoto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `idtarea` int(11) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `poblacion` varchar(45) NOT NULL,
  `codpostal` varchar(45) NOT NULL,
  `provincia` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `fechacreacion` varchar(45) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fechafin` varchar(45) DEFAULT NULL,
  `anotaantes` varchar(45) DEFAULT NULL,
  `anotapost` varchar(45) DEFAULT NULL,
  `fichero` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`idtarea`, `dni`, `nombre`, `apellidos`, `telefono`, `descripcion`, `correo`, `direccion`, `poblacion`, `codpostal`, `provincia`, `estado`, `fechacreacion`, `idusuario`, `fechafin`, `anotaantes`, `anotapost`, `fichero`, `foto`) VALUES
(1, '29485635A', 'Pepe', 'Gómez', '665478153', 'alicatado', 'pepe@gmail.com', 'Calle Falsa 1', 'Huelva', '21005', 'Huelva', 'P', '2022-12-04', 2, '', '', '', NULL, NULL),
(3, '44604768B', 'Juan', 'Bueno', '614 781 650', 'pintura', 'juan@gmail.com', 'Calle Falsa 78', 'Moguer', '21482', 'Huelva', 'C', '2022-12-06', 3, '', NULL, 'El cliente cambio de idea', NULL, NULL),
(4, '41604712P', 'Cristina', 'Carrasco Silva', '632-458-884', 'insonorización', 'cristina@gmail.com', 'Avenida Invent 6', 'Sevilla', '41005', 'Sevilla', 'B', '2022-11-28', 4, NULL, NULL, NULL, NULL, NULL),
(5, '41604712P', 'Cristina', 'Carrasco Silva', '632-458-884', 'soleria baño', 'cristina@gmail.com', 'Avenida Invent 6', 'Sevilla', '41005', 'Sevilla', 'R', '2022-11-14', 4, '2022-11-17', NULL, NULL, NULL, NULL),
(11, '54641646V', 'Daniel', 'Ramos Gomez', '625-470-398', 'escaleras', 'dani@hotmail.com', 'Calle Baja 23', 'Aracena', '21346', 'Huelva', 'R', '2022-12-29', 3, '2022-12-30', '', '', NULL, NULL),
(13, '45776767M', 'Marcos', 'Baena', '655478982', 'marcos de puertas', 'marcos@gmail.com', 'Calle Gomera s/n', 'Fuengirola', '29640', 'Málaga', 'R', '2022-12-29', 2, '2022-12-31', '', '', NULL, NULL),
(14, '42628024P', 'Luis', 'Asencio', '784 542 013', 'cocina', 'luis@gmail.com', 'Calle Alta 42', 'Bormujos', '41235', 'Sevilla', 'R', '2022-12-29', 3, '2022-12-31', '', '', NULL, NULL),
(15, '47954728G', 'Tamara', 'Nuñez', '624870932', 'muro patio', 'tamara@yahoo.es', 'Paseo de la Fuente', 'Valverde', '21057', 'Huelva', 'P', '2022-12-29', 2, '', '', '', NULL, NULL),
(18, '92593892D', 'Manoli', 'Barriga', '667412335', 'enlucido', 'manoli@gmail.com', 'Calle Mesa', 'Niebla', '21670', 'Huelva', 'R', '2022-12-29', 4, '2022-12-30', '', '', NULL, NULL),
(20, '40071949S', 'Leticia', 'Reyes Ochoa', '733-458-906', 'reforma', 'leticia@hotmail.es', 'Avenida de la Libertad s/n', 'Osuna', '41509', 'Sevilla', 'R', '2022-12-30', 3, '2023-01-05', '', '', NULL, NULL),
(23, '41051207W', 'Paco', 'Flores', '698433525', 'alicatado', 'paco@gmail.com', 'Calle Larga 12', 'Gibraleón', '21344', 'Huelva', 'P', '2022-12-30', 2, '', '', '', NULL, NULL),
(25, '26976696L', 'Isaac', 'Coronel', '664722488', 'acabados', 'isaac@hotmail.es', 'Calle Larios', 'Almonte', '21669', 'Huelva', 'R', '2022-12-30', 2, '2022-12-31', '', '', NULL, NULL),
(28, '73811809W', 'Joaquin', 'Rivera', '611234789', 'reforma', 'joaqu@hotmail.es', 'Calle Rosa 35', 'Bollullos', '21667', 'Huelva', 'P', '2023-01-02', 4, '', '', '', NULL, NULL),
(29, '06828048S', 'Leonor', 'Diaz', '722034589', 'reforma', 'leo@gmeil.com', 'Calle La Fuente 2', 'Bonares', '21830', 'Huelva', 'R', '2023-01-02', 4, '2023-01-09', '', '', NULL, NULL),
(30, '79307391X', 'dsfsa', 'ADFDAFD', '655489023', 'sdfsffg', 'asdasa@gmail.com', 'csacadad', 'asdsadsadas', '41006', 'Sevilla', 'R', '2023-01-02', 3, '2023-01-03', '', 'hjfgjffgjjj', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_comunidadesautonomas`
--

CREATE TABLE `tbl_comunidadesautonomas` (
  `id` tinyint(4) NOT NULL DEFAULT 0,
  `nombre` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Afiliados de alta';

--
-- Volcado de datos para la tabla `tbl_comunidadesautonomas`
--

INSERT INTO `tbl_comunidadesautonomas` (`id`, `nombre`) VALUES
(1, 'Andalucía'),
(2, 'Aragón'),
(3, 'Asturias (Principado de)'),
(4, 'Balears (IIles)'),
(5, 'Canarias'),
(6, 'Cantabria'),
(8, 'Castilla y León'),
(7, 'Castilla-La Mancha'),
(9, 'Cataluña'),
(18, 'Ceuta'),
(10, 'Comunidad Valenciana'),
(11, 'Extremadura'),
(12, 'Galicia'),
(13, 'Madrid (Comunidad de)'),
(19, 'Melilla'),
(14, 'Murcia (Región de)'),
(15, 'Navarra (Comunidad Foral de)'),
(16, 'País Vasco'),
(17, 'Rioja (La)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_provincias`
--

CREATE TABLE `tbl_provincias` (
  `cod` char(2) NOT NULL DEFAULT '00' COMMENT 'Código de la provincia de dos digitos',
  `nombre` varchar(50) NOT NULL DEFAULT '' COMMENT 'Nombre de la provincia',
  `comunidad_id` tinyint(4) NOT NULL COMMENT 'Código de la comunidad a la que pertenece'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Provincias de españa; 99 para seleccionar a Nacional';

--
-- Volcado de datos para la tabla `tbl_provincias`
--

INSERT INTO `tbl_provincias` (`cod`, `nombre`, `comunidad_id`) VALUES
('01', 'Alava', 16),
('02', 'Albacete', 7),
('03', 'Alicante', 10),
('04', 'Almera', 1),
('05', 'Avila', 8),
('06', 'Badajoz', 11),
('07', 'Balears (Illes)', 4),
('08', 'Barcelona', 9),
('09', 'Burgos', 8),
('10', 'Cáceres', 11),
('11', 'Cádiz', 1),
('12', 'Castellón', 10),
('13', 'Ciudad Real', 7),
('14', 'Córdoba', 1),
('15', 'Coruña (A)', 12),
('16', 'Cuenca', 7),
('17', 'Girona', 9),
('18', 'Granada', 1),
('19', 'Guadalajara', 7),
('20', 'Guipzcoa', 16),
('21', 'Huelva', 1),
('22', 'Huesca', 2),
('23', 'Jaén', 1),
('24', 'León', 8),
('25', 'Lleida', 9),
('26', 'Rioja (La)', 17),
('27', 'Lugo', 12),
('28', 'Madrid', 13),
('29', 'Málaga', 1),
('30', 'Murcia', 14),
('31', 'Navarra', 15),
('32', 'Ourense', 12),
('33', 'Asturias', 3),
('34', 'Palencia', 8),
('35', 'Palmas (Las)', 5),
('36', 'Pontevedra', 12),
('37', 'Salamanca', 8),
('38', 'Santa Cruz de Tenerife', 5),
('39', 'Cantabria', 6),
('40', 'Segovia', 8),
('41', 'Sevilla', 1),
('42', 'Soria', 8),
('43', 'Tarragona', 9),
('44', 'Teruel', 2),
('45', 'Toledo', 7),
('46', 'Valencia', 10),
('47', 'Valladolid', 8),
('48', 'Vizcaya', 16),
('49', 'Zamora', 8),
('50', 'Zaragoza', 2),
('51', 'Ceuta', 18),
('52', 'Melilla', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `pass`, `tipo`) VALUES
(1, 'admin', 'admin', 'administrador'),
(2, 'Manolo', 'm1234', 'operario'),
(3, 'Ana', 'a1234', 'operario'),
(4, 'Toni', 't1234', 'operario'),
(6, 'David', 'd1234', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`idtarea`);

--
-- Indices de la tabla `tbl_comunidadesautonomas`
--
ALTER TABLE `tbl_comunidadesautonomas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tbl_provincias`
--
ALTER TABLE `tbl_provincias`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `nombre` (`nombre`),
  ADD KEY `FK_ComunidadAutonomaProv` (`comunidad_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `idtarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
