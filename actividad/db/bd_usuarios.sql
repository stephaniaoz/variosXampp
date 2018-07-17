-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2017 a las 21:21:04
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_empleado_rol`
--

CREATE TABLE `tb_empleado_rol` (
  `id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_empleado_rol`
--

INSERT INTO `tb_empleado_rol` (`id`, `empleado_id`, `rol_id`) VALUES
(4, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_roles`
--

CREATE TABLE `tb_roles` (
  `id` int(11) NOT NULL,
  `rol_nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_roles`
--

INSERT INTO `tb_roles` (`id`, `rol_nombre`) VALUES
(1, 'Profesional de proyectos- Desarrollador'),
(2, 'Gerente estrategico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_sexo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_area` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_boletin` tinyint(1) NOT NULL,
  `usuario_descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`usuario_id`, `usuario_nombre`, `usuario_email`, `usuario_sexo`, `usuario_area`, `usuario_boletin`, `usuario_descripcion`) VALUES
(10, 'Nexura', 'nexura@gmail.com', 'Femenino', 'Ventas', 0, 'soy feliz'),
(11, 'bolso', 'bolso@gmail.com', 'Femenino', 'Ventas', 0, 'Soy feliz');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_empleado_rol`
--
ALTER TABLE `tb_empleado_rol`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleado_id_foreign` (`empleado_id`),
  ADD KEY `rol_id_foreign` (`rol_id`);

--
-- Indices de la tabla `tb_roles`
--
ALTER TABLE `tb_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_empleado_rol`
--
ALTER TABLE `tb_empleado_rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tb_roles`
--
ALTER TABLE `tb_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_empleado_rol`
--
ALTER TABLE `tb_empleado_rol`
  ADD CONSTRAINT `empleado_id_foreign` FOREIGN KEY (`empleado_id`) REFERENCES `tb_usuarios` (`usuario_id`),
  ADD CONSTRAINT `rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `tb_roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
