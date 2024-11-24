-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db:3306
-- Tiempo de generación: 22-11-2024 a las 18:56:56
-- Versión del servidor: 10.8.2-MariaDB-1:10.8.2+maria~focal
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentos`
--

CREATE TABLE `alimentos` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `fcompra` date NOT NULL,
  `fcaducidad` date NOT NULL,
  `calorias` int(11) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alimentos`
--

INSERT INTO `alimentos` (`id`, `nombre`, `fcompra`, `fcaducidad`, `calorias`, `precio`) VALUES
(1, 'Manzana', '2024-09-28', '2024-10-05', 300, 1.5),
(2, 'Macarrones', '2024-09-29', '2025-01-11', 500, 0.9),
(3, 'Tomate', '2024-09-28', '2024-10-05', 100, 0.97),
(4, 'Chorizo', '2024-09-29', '2024-11-13', 800, 3),
(5, 'Queso', '2024-08-14', '2024-09-30', 400, 4.9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `LogsUsuarios`
--

CREATE TABLE `LogsUsuarios` (
  `idusuario` varchar(300) NOT NULL,
  `correo` varchar(300) NOT NULL,
  `FechaHoraConexion` datetime NOT NULL,
  `Conectado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `dni` text NOT NULL,
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `tel` int(9) NOT NULL,
  `fechanacimiento` date NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `dni`, `nombre`, `apellidos`, `tel`, `fechanacimiento`, `email`, `password`) VALUES
(6, '71314492W', 'Francisco', 'Fernandez Condado', 622622622, '2003-04-17', 'ffernandez032@ikasle.ehu.eus', '$2y$10$sXlAQQQibH4OwuVW3zyKEOKE2k8B6u6kj4zHWpZxUWT67ZZoZXfhK'),
(7, '79135981L', 'Diego', 'Gonzalez Tamayo', 688805996, '2003-05-03', 'dieguito.ander@yahoo.es', '$2y$10$C73YJradDqketdLsaeHeIeGUozSN/ylexV.FFevXGGNHt0rzlNFIm'),
(8, '79008700C', 'Xabier', 'Unzilla Higuero', 684007082, '2024-11-04', 'xunzilla@ikasle.ehu.eus', '$2y$10$wY6BbKAwDpxxPy7wKxYn0OwnHDAUOkUG3HZYPO2Uq9jMwWswLyqAO');


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`,`tel`,`email`) USING HASH;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alimentos`
--
ALTER TABLE `alimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
