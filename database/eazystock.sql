-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2026 a las 14:20:57
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eazystock`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `id` int(11) NOT NULL,
  `trabajador_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha_asignacion` datetime DEFAULT current_timestamp(),
  `fecha_devolucion` datetime DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `comentario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`id`, `trabajador_id`, `material_id`, `usuario_id`, `fecha_asignacion`, `fecha_devolucion`, `ciudad`, `comentario`) VALUES
(1, 3, 4, NULL, '2026-05-20 21:16:47', '2026-05-20 21:17:39', 'Barcelona', 'Se reasigna por tener 2 monitores debido a su puesto de trabajo.'),
(2, 1, 4, NULL, '2026-05-22 16:52:30', NULL, 'Madrid', 'Asignado por necesidad de doble pantalla.'),
(3, 4, 10, NULL, '2026-05-23 21:06:46', NULL, 'Amsterdam', 'Se le asigna el 20/05/2026 temporalmente.'),
(4, 4, 1, NULL, '2026-05-27 21:06:35', '2026-05-27 21:07:31', 'Amsterdam', 'Sustitucion portátil'),
(5, 3, 1, NULL, '2026-05-27 21:19:53', NULL, 'Barcelona', ''),
(8, 5, 12, 1, '2026-06-01 14:19:04', NULL, 'Zaragoza', 'Necesidad de tarjeta gráfica externa.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_material`
--

CREATE TABLE `historial_material` (
  `id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `accion` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `tipo` enum('Portátil','Sobremesa','Monitor','Móvil','Dockstation','Tablet','Surface') NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `numero_serie` varchar(150) NOT NULL,
  `estado` enum('Disponible','Asignado','Reparación','Baja') DEFAULT 'Disponible',
  `ubicacion` varchar(100) DEFAULT 'Almacén IT',
  `fecha_compra` date DEFAULT NULL,
  `fecha_garantia` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`id`, `tipo`, `marca`, `modelo`, `numero_serie`, `estado`, `ubicacion`, `fecha_compra`, `fecha_garantia`, `activo`) VALUES
(1, 'Portátil', 'HP', 'EliteBook 840', 'HP-ABC-001', 'Asignado', 'Barcelona', NULL, NULL, 1),
(2, 'Monitor', 'Dell', 'P2422H', 'DLL-998877', 'Asignado', 'Barcelona', NULL, NULL, 1),
(3, 'Dockstation', 'Dell', 'D6000', '1235123A', 'Baja', 'Baleares', '2026-04-12', '2028-04-12', 0),
(4, 'Dockstation', 'Dell', 'D6000', '12312', 'Asignado', 'Madrid', '2024-04-12', '2027-04-12', 1),
(5, 'Portátil', 'Asus', 'B1502', '123123', 'Baja', 'Almacén IT', '2026-05-22', '2029-05-22', 0),
(6, 'Portátil', 'Asus', 'B1502', '123456789', 'Baja', 'Almacén IT', '0000-00-00', '0000-00-00', 0),
(10, 'Móvil', 'Samsung', 'Galaxy A54', '32165416546546', 'Asignado', 'Amsterdam', '2026-05-15', '2028-05-15', 1),
(12, 'Portátil', 'MSI', 'GL76 Pulse', '125348', 'Asignado', 'Zaragoza', '2024-04-12', '2027-04-12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id`, `nombre`, `apellidos`, `correo`, `telefono`, `departamento`, `ciudad`, `activo`) VALUES
(1, 'Juan', 'Pérez', 'juan.perez@empresa.com', '600111222', 'Marketing', 'Madrid', 1),
(2, 'Ana prueba', 'López', 'ana.lopez@empresa.com', '600333444', 'Finanzas', 'Barcelona', 0),
(3, 'Prueba 1', 'López', 'prueba1@asd.com', '123456789', 'Marketing', 'Barcelona', 1),
(4, 'Petunia', 'Ramirez del Monte', 'lapetu@dominio.com', '123456789', 'Administración', 'Amsterdam', 1),
(5, 'Eduardo', 'del Río Dominguez', 'edelrio@gmail.com', '650254691', 'Automoción', 'Zaragoza', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol_id`, `activo`) VALUES
(1, 'Samuel', 'Administrador', 'admin@eazystock.com', '0192023a7bbd73250516f069df18b500', 1, 1),
(2, 'admin2', 'Administrador', 'admin2@eazystock.com', '0192023a7bbd73250516f069df18b500', 1, 1),
(3, 'Carlos', 'IT', 'carlos@eazystock.com', '401cec94d3ed586d8cb895c10c0f7db6', 2, 1),
(4, 'Marta', 'IT', 'marta@eazystock.com', '401cec94d3ed586d8cb895c10c0f7db6', 2, 1),
(5, 'David', 'IT', 'david@eazystock.com', '401cec94d3ed586d8cb895c10c0f7db6', 2, 1),
(11, 'Samuel', 'Kinghorn', 'skinghorn@gmail.com', '6051b063d62e17744b222f1b82c81e25', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trabajador_id` (`trabajador_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indices de la tabla `historial_material`
--
ALTER TABLE `historial_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_serie` (`numero_serie`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `historial_material`
--
ALTER TABLE `historial_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`),
  ADD CONSTRAINT `asignaciones_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`);

--
-- Filtros para la tabla `historial_material`
--
ALTER TABLE `historial_material`
  ADD CONSTRAINT `historial_material_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
