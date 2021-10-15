-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2021 a las 03:53:41
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_presupuestos_impresiones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `id_material` int(11) NOT NULL,
  `nombre_material` varchar(60) NOT NULL,
  `precio_material` int(11) NOT NULL,
  `descripcion_material` varchar(900) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`id_material`, `nombre_material`, `precio_material`, `descripcion_material`) VALUES
(1, 'PLA', 2000, 'EL PLA es una fibra sintética biodegradable, considerado el material plástico más limpio de la gama. Su principal componente deriva de almidones vegetales (maíz, mandioca, caña de azúcar, etc.) llevados a un proceso de fermentación para lograr el acido láctico y posteriormente tratados en laboratorio hasta llegar al acido poliláctico.'),
(12, 'ABS', 2300, 'Muy utilizado en la industria automotríz y de electrodomésticos, de muy buena resistencia mecánica y térmica y buenas propiedades como aislante eléctrico.\r\n\r\nUna de las elecciones obligadas del impresor experimentado.\r\n\r\nEl filamento 3D ABS de Grilon3 permite crear piezas fuertes y duraderas. Es ligero, de alta resistencia al impacto y considerable resistencia química, al calor y a la humedad, duro y de acabado satinado.\r\n\r\nSe puede lijar y pintar e incluso modelar y/o alisar con acetona(*) logrando así un acabado mucho más liso y refinado.\r\n\r\nRecomendamos almacenar cuidadosamente el filamento cuando no se use, para evitar la absorción de humedad por parte del material, el mismo se comercializa sellado, en ambiente controlado y con bolsa de desecante antihumedad.\r\n\r\n(*) Consulte acerca de las técnicas y medidas de seguridad para trabajar con Acetona.'),
(13, 'PETG', 2700, 'Conocido por su uso en botellas plásticas, en este caso modificado con Glicol, ofrece simpleza en su utilización y acabados brillantes con variantes de color translúcido que se destacan y ofrecen infinitas posibilidades creativas.\r\n\r\nPosee muy buena resistencia mecánica y mayor resistencia térmica que el PLA. Excelente relación precio/prestaciones/usabilidad.\r\n\r\nOfrece buena resistencia química y una excelente adherencia entre capas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

CREATE TABLE `presupuestos` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(60) NOT NULL,
  `monto` int(11) NOT NULL,
  `FK_id_material` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `presupuestos`
--

INSERT INTO `presupuestos` (`id_cliente`, `nombre_cliente`, `monto`, `FK_id_material`) VALUES
(1, 'Franco Perez', 2534444, 1),
(12, 'Juan Carlos', 23565, 13),
(13, 'Montoto Carlos', 5689, 12),
(14, 'Lucas Ascazuri', 9874, 13),
(15, 'Mari Jonsh', 4563, 1),
(16, 'Mari Jonsh', 4563, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(20) NOT NULL,
  `nivel_acceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`, `nivel_acceso`) VALUES
(1, 'Usuario', 0),
(2, 'Admin', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `FK_role_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `email`, `password`, `FK_role_id`) VALUES
(1, 'francogabrielperez@gmail.com', '$2y$10$5kulRJGeSqyaLBhcAUnB7eg8MnCO8Gd4qEUd6fAdKEL57uHOImT3G', 2),
(2, 'lucasascazuri@gmail.com', '$2y$10$ESRAQe0WG5wX8Ni3iDVNXe5ZutwYlfYSzM8bGP3k0To4Hdo32EjnK', 2),
(3, 'juancarlos@gmail.com', '$2y$10$0p.brs8VG78VDioi4OoFpO3bjlF6eG5rLJpUFIl1xxjiLzp.NqliS', 2),
(4, 'admin', '$2y$10$eackh8.Ye1.cNdGRp3bE8eAVUDA83GsTpuSAj3I.59StfJrM0Obfy', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`id_material`);

--
-- Indices de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `FK_id_material` (`FK_id_material`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `FK_role_id` (`FK_role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `materiales`
--
ALTER TABLE `materiales`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD CONSTRAINT `presupuestos_ibfk_1` FOREIGN KEY (`FK_id_material`) REFERENCES `materiales` (`id_material`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`FK_role_id`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
