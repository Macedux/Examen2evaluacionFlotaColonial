-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 07-05-2026 a las 20:05:47
-- Versión del servidor: 9.5.0
-- Versión de PHP: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `colonial_fleet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `naves`
--

CREATE TABLE `naves` (
  `id` int NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo` enum('Batalla','Carguera','Cientifica') NOT NULL,
  `estado` enum('Activa','Dañada','Destruida') NOT NULL,
  `velocidadFTL` tinyint(1) DEFAULT NULL,
  `capacidadPasajeros` int DEFAULT NULL,
  `armamento` varchar(100) DEFAULT NULL,
  `puntosCasco` int DEFAULT (100),
  `clasificacion` enum('Battlestar','Escolta','Destructor') DEFAULT NULL,
  `tipoCarga` enum('Armamento','Ciudadanos','Secreto') DEFAULT NULL,
  `capacidadCarga` int DEFAULT NULL,
  `numLaboratorios` int DEFAULT NULL,
  `especialidad` varchar(100) DEFAULT NULL,
  `cylonSospechoso` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `naves`
--

INSERT INTO `naves` (`id`, `nombre`, `tipo`, `estado`, `velocidadFTL`, `capacidadPasajeros`, `armamento`, `puntosCasco`, `clasificacion`, `tipoCarga`, `capacidadCarga`, `numLaboratorios`, `especialidad`, `cylonSospechoso`) VALUES
(6, 'Proteus', 'Batalla', 'Activa', 1, 1222, 'Cañones riel', 100, 'Escolta', NULL, NULL, NULL, NULL, 0),
(7, 'Menora', 'Carguera', 'Activa', 0, 50, 'Cañones riel', 100, 'Battlestar', 'Secreto', 500000, 1, 'xenologia', 1),
(8, 'Zeus', 'Batalla', 'Activa', 1, 500, 'Cañones medios', 100, 'Destructor', NULL, NULL, NULL, NULL, 0),
(9, 'Nostramo', 'Carguera', 'Dañada', 0, 80000, NULL, 50, NULL, 'Armamento', 500000, NULL, NULL, 0),
(10, 'Mimico', 'Batalla', 'Activa', 1, 5000, 'nucleares', 90, 'Battlestar', NULL, NULL, NULL, NULL, 0),
(11, 'Caprica', 'Batalla', 'Activa', 1, 50000, 'Cañones de batalla', 100, 'Battlestar', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `idioma` enum('Spanish','English') DEFAULT NULL,
  `rol` enum('admin','usuario') DEFAULT 'usuario',
  `colorFondo` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `idioma`, `rol`, `colorFondo`) VALUES
(1, 'Martinez', '$2y$10$YkGKrrpRmjKNGdo3c6rmSutOt.x.1xk4mnH7lSgAPVpiJTBhKfhFC', NULL, 'usuario', NULL),
(5, 'Almirante', '$2y$10$k17ZrTkHeI9iegoAScGyluoP3LRMUCNhQakH2obXqEYY6NftxNX2u', NULL, 'admin', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `naves`
--
ALTER TABLE `naves`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `naves`
--
ALTER TABLE `naves`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
