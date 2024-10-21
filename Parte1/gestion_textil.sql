-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2024 a las 00:23:49
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
-- Base de datos: `gestion_textil`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciontareas`
--

CREATE TABLE `asignaciontareas` (
  `id_asignacion` int(11) NOT NULL,
  `id_produccion` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `tarea` varchar(255) NOT NULL,
  `fecha_asignacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresomateriaprima`
--

CREATE TABLE `egresomateriaprima` (
  `id_egreso` int(11) NOT NULL,
  `id_ingreso` int(11) NOT NULL,
  `cantidad_egresada` int(11) NOT NULL,
  `fecha_egreso` date NOT NULL,
  `id_produccion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `nombre_empleado` varchar(255) NOT NULL,
  `puesto_empleado` varchar(100) DEFAULT NULL,
  `fecha_contratacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresomateriaprima`
--

CREATE TABLE `ingresomateriaprima` (
  `id_ingreso` int(11) NOT NULL,
  `codigo_materia_prima` varchar(50) NOT NULL,
  `nombre_materia_prima` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `unidad_medida` varchar(50) DEFAULT NULL,
  `cantidad_comprada` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingresomateriaprima`
--

INSERT INTO `ingresomateriaprima` (`id_ingreso`, `codigo_materia_prima`, `nombre_materia_prima`, `descripcion`, `unidad_medida`, `cantidad_comprada`, `precio_unitario`, `fecha_ingreso`, `id_proveedor`) VALUES
(3, '2023', 'Poliéster', 'Todo bien ', 'M', 100, 20.00, '2024-10-18', 18),
(4, '1010', 'Tela de algodon', 'Todo bien ', 'M', 200, 65.00, '2024-10-19', 16),
(5, '1010', 'Tela de algodon', 'Todo bien ', 'M', 200, 40.00, '2024-10-18', 19);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenescompra`
--

CREATE TABLE `ordenescompra` (
  `id_orden_compra` int(11) NOT NULL,
  `id_ingreso` int(11) DEFAULT NULL,
  `cantidad_pedida` int(11) NOT NULL,
  `fecha_orden` date NOT NULL,
  `fecha_estimada_entrega` date DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion`
--

CREATE TABLE `produccion` (
  `id_produccion` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `cantidad_producida` int(11) NOT NULL,
  `id_ingreso` int(11) DEFAULT NULL,
  `id_unidad` int(11) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin_estimada` date DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'En Proceso',
  `prioridad` varchar(50) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccionmateriaprima`
--

CREATE TABLE `produccionmateriaprima` (
  `id_produccion_materia` int(11) NOT NULL,
  `id_produccion` int(11) DEFAULT NULL,
  `id_ingreso` int(11) DEFAULT NULL,
  `cantidad_utilizada` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre_proveedor`, `nit_proveedor`, `telefono_proveedor`, `email_proveedor`, `direccion_proveedor`, `condiciones_pago`) VALUES
(1, 'Hilos y Cuerdas S.A.', '45678912', '502-1234-5678', 'contacto@hilosycuerdas.com', 'Zona 5, Ciudad de Guatemala', 'Crédito 30 días'),
(2, 'Textiles Premium S.A.', '12345678', '502-8765-4321', 'info@textilespremium.com', 'Zona 10, Ciudad de Guatemala', 'Contado'),
(3, 'Tintas de Calidad S.A.', '98765432', '502-1122-3344', 'ventas@tintascalidad.com', 'Zona 1, Ciudad de Guatemala', 'Crédito 15 días'),
(4, 'Telas y Más S.A.', '19283746', '502-3344-5566', 'atencion@telasymas.com', 'Zona 7, Ciudad de Guatemala', 'Crédito 45 días'),
(5, 'Distribuidora de Hilos S.A.', '11223344', '502-9988-7766', 'hilos@distribuidoradehilos.com', 'Zona 4, Ciudad de Guatemala', 'Contado'),
(6, 'Fibras Naturales S.A.', '44332211', '502-5544-7788', 'contacto@fibrasnaturales.com', 'Zona 9, Ciudad de Guatemala', 'Crédito 30 días'),
(7, 'Colores Textiles S.A.', '66778899', '502-7788-2233', 'soporte@colorestextiles.com', 'Zona 3, Ciudad de Guatemala', 'Crédito 60 días'),
(8, 'Tejidos Finos S.A.', '99887766', '502-4433-2211', 'info@tejidosfinos.com', 'Zona 8, Ciudad de Guatemala', 'Contado'),
(9, 'Tinturas Textiles S.A.', '55443322', '502-6677-8899', 'ventas@tinturastextiles.com', 'Zona 6, Ciudad de Guatemala', 'Crédito 30 días'),
(10, 'Suministros Textiles S.A.', '22114433', '502-2233-5566', 'suministros@suministrostextiles.com', 'Zona 12, Ciudad de Guatemala', 'Crédito 15 días'),
(11, 'Hilos del Sur S.A.', '99881122', '502-3344-2211', 'contacto@hilosdelsur.com', 'Zona 11, Ciudad de Guatemala', 'Crédito 45 días'),
(12, 'Tintas y Más S.A.', '77441199', '502-5566-7788', 'soporte@tintasyamas.com', 'Zona 2, Ciudad de Guatemala', 'Crédito 30 días'),
(13, 'Distribuidora de Telas S.A.', '22334455', '502-8877-6655', 'info@distribuidoradetelas.com', 'Zona 9, Ciudad de Guatemala', 'Contado'),
(14, 'Estampados Creativos S.A.', '11998877', '502-1122-7788', 'ventas@estampadoscreativos.com', 'Zona 7, Ciudad de Guatemala', 'Crédito 30 días'),
(15, 'Proveedora de Hilos S.A.', '88229911', '502-9988-6677', 'contacto@proveedoradehilos.com', 'Zona 4, Ciudad de Guatemala', 'Crédito 60 días'),
(16, 'Telas y Textiles S.A.', '33224411', '502-5544-2233', 'soporte@telastextiles.com', 'Zona 10, Ciudad de Guatemala', 'Contado'),
(17, 'Tintas Rápidas S.A.', '44335566', '502-2233-8899', 'ventas@tintasrapidas.com', 'Zona 6, Ciudad de Guatemala', 'Crédito 15 días'),
(18, 'Hilos Finos S.A.', '66771122', '502-7788-4433', 'contacto@hilosfinos.com', 'Zona 3, Ciudad de Guatemala', 'Crédito 30 días'),
(19, 'Telas Industriales S.A.', '77665544', '502-5566-3344', 'info@telasindustriales.com', 'Zona 5, Ciudad de Guatemala', 'Crédito 45 días'),
(20, 'Suministros y Telas S.A.', '22113344', '502-9988-1122', 'ventas@suministrosytelas.com', 'Zona 12, Ciudad de Guatemala', 'Contado');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciontareas`
--
ALTER TABLE `asignaciontareas`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `id_produccion` (`id_produccion`),
  ADD KEY `id_empleado` (`id_empleado`);

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
-- Indices de la tabla `egresomateriaprima`
--
ALTER TABLE `egresomateriaprima`
  ADD PRIMARY KEY (`id_egreso`),
  ADD KEY `id_ingreso` (`id_ingreso`),
  ADD KEY `id_produccion` (`id_produccion`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `ingresomateriaprima`
--
ALTER TABLE `ingresomateriaprima`
  ADD PRIMARY KEY (`id_ingreso`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `inspeccioncalidad`
--
ALTER TABLE `inspeccioncalidad`
  ADD PRIMARY KEY (`id_inspeccion`),
  ADD KEY `id_producto_terminado` (`id_producto_terminado`);

--
-- Indices de la tabla `ordenescompra`
--
ALTER TABLE `ordenescompra`
  ADD PRIMARY KEY (`id_orden_compra`),
  ADD KEY `id_ingreso` (`id_ingreso`);

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
  ADD KEY `id_ingreso` (`id_ingreso`),
  ADD KEY `id_unidad` (`id_unidad`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `produccionmateriaprima`
--
ALTER TABLE `produccionmateriaprima`
  ADD PRIMARY KEY (`id_produccion_materia`),
  ADD KEY `id_produccion` (`id_produccion`),
  ADD KEY `id_ingreso` (`id_ingreso`);

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
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de la tabla `egresomateriaprima`
--
ALTER TABLE `egresomateriaprima`
  MODIFY `id_egreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingresomateriaprima`
--
ALTER TABLE `ingresomateriaprima`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inspeccioncalidad`
--
ALTER TABLE `inspeccioncalidad`
  MODIFY `id_inspeccion` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_produccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `produccionmateriaprima`
--
ALTER TABLE `produccionmateriaprima`
  MODIFY `id_produccion_materia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productosterminados`
--
ALTER TABLE `productosterminados`
  MODIFY `id_producto_terminado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `unidadesproduccion`
--
ALTER TABLE `unidadesproduccion`
  MODIFY `id_unidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciontareas`
--
ALTER TABLE `asignaciontareas`
  ADD CONSTRAINT `asignaciontareas_ibfk_1` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asignaciontareas_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`) ON DELETE SET NULL ON UPDATE CASCADE;

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
-- Filtros para la tabla `egresomateriaprima`
--
ALTER TABLE `egresomateriaprima`
  ADD CONSTRAINT `egresomateriaprima_ibfk_1` FOREIGN KEY (`id_ingreso`) REFERENCES `ingresomateriaprima` (`id_ingreso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `egresomateriaprima_ibfk_2` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ingresomateriaprima`
--
ALTER TABLE `ingresomateriaprima`
  ADD CONSTRAINT `ingresomateriaprima_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `inspeccioncalidad`
--
ALTER TABLE `inspeccioncalidad`
  ADD CONSTRAINT `inspeccioncalidad_ibfk_1` FOREIGN KEY (`id_producto_terminado`) REFERENCES `productosterminados` (`id_producto_terminado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenescompra`
--
ALTER TABLE `ordenescompra`
  ADD CONSTRAINT `ordenescompra_ibfk_1` FOREIGN KEY (`id_ingreso`) REFERENCES `ingresomateriaprima` (`id_ingreso`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `produccion_ibfk_1` FOREIGN KEY (`id_ingreso`) REFERENCES `ingresomateriaprima` (`id_ingreso`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `produccion_ibfk_2` FOREIGN KEY (`id_unidad`) REFERENCES `unidadesproduccion` (`id_unidad`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `produccion_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `produccionmateriaprima`
--
ALTER TABLE `produccionmateriaprima`
  ADD CONSTRAINT `produccionmateriaprima_ibfk_1` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produccionmateriaprima_ibfk_2` FOREIGN KEY (`id_ingreso`) REFERENCES `ingresomateriaprima` (`id_ingreso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productosterminados`
--
ALTER TABLE `productosterminados`
  ADD CONSTRAINT `productosterminados_ibfk_1` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
