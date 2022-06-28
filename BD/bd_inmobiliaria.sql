-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2022 a las 00:05:44
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `nombre_ciudad` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `id_pais`, `nombre_ciudad`) VALUES
(1, 1, 'Armenia'),
(2, 1, 'Cali');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `propiedad1` int(11) DEFAULT NULL,
  `propiedad2` int(11) DEFAULT NULL,
  `propiedad3` int(11) DEFAULT NULL,
  `propiedad4` int(11) DEFAULT NULL,
  `propiedad5` int(11) DEFAULT NULL,
  `propiedad6` int(11) DEFAULT NULL,
  `oficina_central` varchar(400) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono1` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono2` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `email_contacto` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `horarios` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `mapa` varchar(400) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `facebook` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `twitter` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo_visualizacion_propiedades` varchar(1) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `user` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `password` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `email_administrador` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `propiedad1`, `propiedad2`, `propiedad3`, `propiedad4`, `propiedad5`, `propiedad6`, `oficina_central`, `telefono1`, `telefono2`, `email_contacto`, `horarios`, `mapa`, `facebook`, `twitter`, `tipo_visualizacion_propiedades`, `user`, `password`, `email_administrador`) VALUES
(1, 0, 0, 0, 0, 0, 0, 'Aun no', '3178980783', '', 'slash2130kevin@gmail.com', '', 'mapa', '', '', 'f', 'admin', 'admin', 'slash2130kevin@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `id_propiedad` int(11) NOT NULL,
  `nombre_foto` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`id`, `id_propiedad`, `nombre_foto`) VALUES
(6, 13, '26b0fa6a2a8a83f1abf1cbddb96834c09cdfd582.jpg'),
(7, 14, 'b8fdc50662f1792aeccbaabab938f1f2f2137dab.jpg'),
(8, 14, '6fea324c7c8b6feb4db40879621a06eb2aa7ab38.jpg'),
(9, 14, '26b0fa6a2a8a83f1abf1cbddb96834c09cdfd582.jpg'),
(10, 14, '4bf2f4c9c0e9345287368631d884ea654a308f1d.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `nombre_pais` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `nombre_pais`) VALUES
(1, 'Colombia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id` int(11) NOT NULL,
  `fecha_alta` date NOT NULL,
  `titulo` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `tipo` int(11) NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ubicacion` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `habitaciones` varchar(2) COLLATE utf8mb4_spanish_ci NOT NULL,
  `banios` varchar(2) COLLATE utf8mb4_spanish_ci NOT NULL,
  `pisos` varchar(2) COLLATE utf8mb4_spanish_ci NOT NULL,
  `garage` varchar(2) COLLATE utf8mb4_spanish_ci NOT NULL,
  `dimensiones` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `url_foto_principal` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `pais` int(11) NOT NULL,
  `ciudad` int(11) NOT NULL,
  `propietario` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono_propietario` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `fecha_alta`, `titulo`, `descripcion`, `tipo`, `estado`, `ubicacion`, `habitaciones`, `banios`, `pisos`, `garage`, `dimensiones`, `precio`, `url_foto_principal`, `pais`, `ciudad`, `propietario`, `telefono_propietario`) VALUES
(13, '2022-06-12', 'tret', 'rtert', 1, 'Venta', 'Armenia', '1', '1', '1', 'No', '123123', 12312312, 'fotos/13/VMP7D7JF2BFKPLHOBL3WDBPNZY.jpg', 1, 1, 'Kevin', '+573178980783'),
(14, '2022-06-16', 'Casa la fachada', 'Descripcion propiedad', 1, 'Alquiler', 'Armenia', '2', '1', '2', 'Si', '40 metros cuadraros', 50000000, 'fotos/14/cdbdee7a-aec8-42c2-9bce-7a08c2427e4e.png', 1, 1, 'Kevin', '573178980783');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL,
  `nombre_tipo` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `nombre_tipo`) VALUES
(1, 'Casa Comun'),
(2, 'Chalet');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
