-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2024 a las 00:28:03
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_textil`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciontareas`
--

CREATE TABLE `asignaciontareas` (
  `id_tarea` int(11) NOT NULL,
  `nombre_tarea` varchar(255) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `id_unidad` int(11) DEFAULT NULL,
  `id_produccion` int(11) DEFAULT NULL,
  `fecha_asignacion` date DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'En Proceso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignaciontareas`
--

INSERT INTO `asignaciontareas` (`id_tarea`, `nombre_tarea`, `id_empleado`, `id_unidad`, `id_produccion`, `fecha_asignacion`, `estado`) VALUES
(47, 'Todos en talla 34', 2, 2, 71, '2024-10-18', 'Completada'),
(50, 'Confeccionar con hilo rojo', 1, 4, 72, '2024-10-18', 'En Proceso'),
(51, 'Eliminar el estampado actual', 3, 4, 72, '2024-10-18', 'En Proceso'),
(53, 'gsdfgsdfgs', 3, 1, 73, '2024-10-18', 'En Proceso'),
(54, '50 gorras de color azul', 2, 3, 74, '2024-10-18', 'En Proceso'),
(55, '20 Calcetines color rojo', 3, 3, 75, '2024-10-19', 'Completada'),
(56, 'asdgasdg', 2, 5, 75, '2024-10-19', 'Completada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacoraacciones`
--

CREATE TABLE `bitacoraacciones` (
  `id_accion` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `accion` varchar(255) NOT NULL,
  `fecha_accion` datetime NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `telefono_cliente` varchar(20) DEFAULT NULL,
  `email_cliente` varchar(100) DEFAULT NULL,
  `direccion_cliente` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribucion`
--

CREATE TABLE `distribucion` (
  `id_distribucion` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `fecha_envio` date NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `estado_envio` varchar(50) DEFAULT 'En Camino',
  `metodo_envio` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `nombre_empleado` varchar(255) NOT NULL,
  `puesto_empleado` varchar(100) DEFAULT NULL,
  `fecha_contratacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre_empleado`, `puesto_empleado`, `fecha_contratacion`) VALUES
(1, 'Juan', 'Encargado de corte', '2024-07-22'),
(2, 'Maria', 'Encargado de fabricación ', '2024-03-10'),
(3, 'Frank', 'Indiferente', '2024-10-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialcomprasmateriaprima`
--

CREATE TABLE `historialcomprasmateriaprima` (
  `id_historial_compra` int(11) NOT NULL,
  `id_materia_prima` int(11) DEFAULT NULL,
  `cantidad_comprada` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inspeccioncalidad`
--

CREATE TABLE `inspeccioncalidad` (
  `id_inspeccion` int(11) NOT NULL,
  `id_producto_terminado` int(11) DEFAULT NULL,
  `resultado_inspeccion` varchar(50) NOT NULL,
  `fecha_inspeccion` date NOT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiaprima`
--

CREATE TABLE `materiaprima` (
  `id_materia_prima` int(11) NOT NULL,
  `nombre_materia_prima` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `unidad_medida` varchar(50) DEFAULT NULL,
  `stock_actual` int(11) DEFAULT 0,
  `stock_minimo` int(11) DEFAULT 0,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materiaprima`
--

INSERT INTO `materiaprima` (`id_materia_prima`, `nombre_materia_prima`, `descripcion`, `unidad_medida`, `stock_actual`, `stock_minimo`, `precio_unitario`, `id_proveedor`) VALUES
(1, 'Lana', 'Para coser', 'Libras', 200, 20, '15.00', NULL),
(2, 'poliéster', 'Para fabricar', 'Metros', 500, 30, '20.00', 2),
(3, 'algodón', 'Para fabricar', 'Libras', 100, 20, '10.00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenescompra`
--

CREATE TABLE `ordenescompra` (
  `id_orden_compra` int(11) NOT NULL,
  `id_materia_prima` int(11) DEFAULT NULL,
  `cantidad_pedida` int(11) NOT NULL,
  `fecha_orden` date NOT NULL,
  `fecha_estimada_entrega` date DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_producto_terminado` int(11) DEFAULT NULL,
  `cantidad_pedida` int(11) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'Pendiente',
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion`
--

CREATE TABLE `produccion` (
  `id_produccion` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `cantidad_producida` int(11) NOT NULL,
  `id_materia_prima` int(11) DEFAULT NULL,
  `id_unidad` int(11) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin_estimada` date DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'En Proceso',
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `produccion`
--

INSERT INTO `produccion` (`id_produccion`, `nombre_producto`, `cantidad_producida`, `id_materia_prima`, `id_unidad`, `fecha_inicio`, `fecha_fin_estimada`, `estado`, `id_usuario`, `fecha_fin`) VALUES
(68, 'Playeras', 300, NULL, 2, '2024-10-17', NULL, 'En Proceso', 1, NULL),
(69, 'Abrigos', 10, NULL, 4, '2024-10-17', NULL, 'Completada', 2, '2024-10-18'),
(70, 'Playera Estampada', 50, NULL, 5, '2024-10-17', NULL, 'Completada', 1, '2024-10-18'),
(71, 'Pantalones', 30, NULL, 2, '2024-10-17', NULL, 'Completada', 1, '2024-10-18'),
(72, 'Abrigos', 60, NULL, 4, '2024-10-17', NULL, 'En Proceso', 2, NULL),
(73, 'Calcetines', 80, NULL, 5, '2024-10-17', NULL, 'En Proceso', 4, NULL),
(74, 'Gorras', 90, NULL, 5, '2024-10-18', NULL, 'En Proceso', 4, NULL),
(75, 'Calsetines', 40, NULL, 2, '2024-10-18', NULL, 'Completada', 1, '2024-10-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productosterminados`
--

CREATE TABLE `productosterminados` (
  `id_producto_terminado` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `cantidad_disponible` int(11) DEFAULT 0,
  `fecha_fabricacion` date NOT NULL,
  `id_produccion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(255) NOT NULL,
  `nit_proveedor` varchar(50) NOT NULL,
  `telefono_proveedor` varchar(20) DEFAULT NULL,
  `email_proveedor` varchar(100) DEFAULT NULL,
  `direccion_proveedor` varchar(255) DEFAULT NULL,
  `condiciones_pago` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre_proveedor`, `nit_proveedor`, `telefono_proveedor`, `email_proveedor`, `direccion_proveedor`, `condiciones_pago`) VALUES
(2, 'Frank', 'c/f', '12345678 ', 'frank12@gamil.com', 'Guatemala', 'Efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidadesproduccion`
--

CREATE TABLE `unidadesproduccion` (
  `id_unidad` int(11) NOT NULL,
  `nombre_unidad` varchar(255) DEFAULT NULL,
  `tipo_unidad` varchar(100) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'Operativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `unidadesproduccion`
--

INSERT INTO `unidadesproduccion` (`id_unidad`, `nombre_unidad`, `tipo_unidad`, `capacidad`, `estado`) VALUES
(1, 'Corte', 'Corte', 10000, 'Operativa'),
(2, 'fabricar', 'fabricar', 300, 'Operativa'),
(3, 'Teñido', 'Teñito', 10000, 'Operativa'),
(4, 'Confección', 'Confección ', 10000, 'Operativa'),
(5, 'Tejido', 'Tejido', 10000, 'Operativa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `rol` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `rol`, `email`, `password`) VALUES
(1, 'Jeff-Corte', 'Cortador', 'Jeff100@gmail.com', 'Jeff100'),
(2, 'Carlos-Teñido', 'Teñido', 'car1234@hotmail.com', 'car1234'),
(3, 'Lucia-Confección', 'Confección', 'Lucia03@gmail.com', 'Luci103'),
(4, 'Juana-Tejido', 'Tejido', 'Juana004@gmail.com', 'Juana104');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciontareas`
--
ALTER TABLE `asignaciontareas`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `id_produccion` (`id_produccion`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_unidad` (`id_unidad`);

--
-- Indices de la tabla `bitacoraacciones`
--
ALTER TABLE `bitacoraacciones`
  ADD PRIMARY KEY (`id_accion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `distribucion`
--
ALTER TABLE `distribucion`
  ADD PRIMARY KEY (`id_distribucion`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `historialcomprasmateriaprima`
--
ALTER TABLE `historialcomprasmateriaprima`
  ADD PRIMARY KEY (`id_historial_compra`),
  ADD KEY `id_materia_prima` (`id_materia_prima`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `inspeccioncalidad`
--
ALTER TABLE `inspeccioncalidad`
  ADD PRIMARY KEY (`id_inspeccion`),
  ADD KEY `id_producto_terminado` (`id_producto_terminado`);

--
-- Indices de la tabla `materiaprima`
--
ALTER TABLE `materiaprima`
  ADD PRIMARY KEY (`id_materia_prima`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `ordenescompra`
--
ALTER TABLE `ordenescompra`
  ADD PRIMARY KEY (`id_orden_compra`),
  ADD KEY `id_materia_prima` (`id_materia_prima`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_producto_terminado` (`id_producto_terminado`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD PRIMARY KEY (`id_produccion`),
  ADD KEY `id_materia_prima` (`id_materia_prima`),
  ADD KEY `id_unidad` (`id_unidad`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `productosterminados`
--
ALTER TABLE `productosterminados`
  ADD PRIMARY KEY (`id_producto_terminado`),
  ADD KEY `id_produccion` (`id_produccion`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `unidadesproduccion`
--
ALTER TABLE `unidadesproduccion`
  ADD PRIMARY KEY (`id_unidad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciontareas`
--
ALTER TABLE `asignaciontareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `bitacoraacciones`
--
ALTER TABLE `bitacoraacciones`
  MODIFY `id_accion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `distribucion`
--
ALTER TABLE `distribucion`
  MODIFY `id_distribucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historialcomprasmateriaprima`
--
ALTER TABLE `historialcomprasmateriaprima`
  MODIFY `id_historial_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inspeccioncalidad`
--
ALTER TABLE `inspeccioncalidad`
  MODIFY `id_inspeccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materiaprima`
--
ALTER TABLE `materiaprima`
  MODIFY `id_materia_prima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ordenescompra`
--
ALTER TABLE `ordenescompra`
  MODIFY `id_orden_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `produccion`
--
ALTER TABLE `produccion`
  MODIFY `id_produccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `productosterminados`
--
ALTER TABLE `productosterminados`
  MODIFY `id_producto_terminado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `unidadesproduccion`
--
ALTER TABLE `unidadesproduccion`
  MODIFY `id_unidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciontareas`
--
ALTER TABLE `asignaciontareas`
  ADD CONSTRAINT `asignaciontareas_ibfk_1` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`),
  ADD CONSTRAINT `asignaciontareas_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`),
  ADD CONSTRAINT `asignaciontareas_ibfk_3` FOREIGN KEY (`id_unidad`) REFERENCES `unidadesproduccion` (`id_unidad`);

--
-- Filtros para la tabla `bitacoraacciones`
--
ALTER TABLE `bitacoraacciones`
  ADD CONSTRAINT `bitacoraacciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `distribucion`
--
ALTER TABLE `distribucion`
  ADD CONSTRAINT `distribucion_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historialcomprasmateriaprima`
--
ALTER TABLE `historialcomprasmateriaprima`
  ADD CONSTRAINT `historialcomprasmateriaprima_ibfk_1` FOREIGN KEY (`id_materia_prima`) REFERENCES `materiaprima` (`id_materia_prima`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historialcomprasmateriaprima_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `inspeccioncalidad`
--
ALTER TABLE `inspeccioncalidad`
  ADD CONSTRAINT `inspeccioncalidad_ibfk_1` FOREIGN KEY (`id_producto_terminado`) REFERENCES `productosterminados` (`id_producto_terminado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `materiaprima`
--
ALTER TABLE `materiaprima`
  ADD CONSTRAINT `materiaprima_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenescompra`
--
ALTER TABLE `ordenescompra`
  ADD CONSTRAINT `ordenescompra_ibfk_1` FOREIGN KEY (`id_materia_prima`) REFERENCES `materiaprima` (`id_materia_prima`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_producto_terminado`) REFERENCES `productosterminados` (`id_producto_terminado`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD CONSTRAINT `produccion_ibfk_1` FOREIGN KEY (`id_materia_prima`) REFERENCES `materiaprima` (`id_materia_prima`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `produccion_ibfk_2` FOREIGN KEY (`id_unidad`) REFERENCES `unidadesproduccion` (`id_unidad`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `produccion_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `productosterminados`
--
ALTER TABLE `productosterminados`
  ADD CONSTRAINT `productosterminados_ibfk_1` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
