-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2024 a las 01:22:07
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
-- Base de datos: `apffu`
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
(53, 'gsdfgsdfgs', 3, 1, 73, '2024-10-18', 'En Proceso'),
(0, 'asdfasdfasdfasdf', 1, 1, 81, '2024-10-25', 'Completada'),
(0, 'Pintar', 1, 1, 78, '2024-10-25', 'Completada');

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
-- Estructura de tabla para la tabla `egresomateriaprima`
--

CREATE TABLE `egresomateriaprima` (
  `id_egreso` int(11) NOT NULL,
  `codigo_materia_prima` varchar(50) NOT NULL,
  `nombre_materia_prima` varchar(255) NOT NULL,
  `cantidad_egresada` int(11) NOT NULL,
  `fecha_egreso` date NOT NULL,
  `id_produccion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `egresomateriaprima`
--

INSERT INTO `egresomateriaprima` (`id_egreso`, `codigo_materia_prima`, `nombre_materia_prima`, `cantidad_egresada`, `fecha_egreso`, `id_produccion`) VALUES
(0, '2023', '', 2, '2024-10-23', 0),
(0, '2023', '', 5, '2024-10-23', 0),
(0, '1010', '', 10, '2024-10-24', 0),
(0, '1111', '', 300, '2024-10-25', 0),
(0, '1010', '', 10, '2024-10-25', 0),
(0, '1111', '', 10, '2024-10-25', 0),
(0, '1111', '', 20, '2024-10-25', 0);

--
-- Disparadores `egresomateriaprima`
--
DELIMITER $$
CREATE TRIGGER `after_insert_egreso` AFTER INSERT ON `egresomateriaprima` FOR EACH ROW BEGIN
    -- Intentar actualizar el registro si el código de materia prima ya existe
    UPDATE inventariomateriaprima
    SET total_egreso = total_egreso + NEW.cantidad_egresada
    WHERE codigo_materia_prima = NEW.codigo_materia_prima;

    -- Si no se actualizó ninguna fila (porque no existe), insertar un nuevo registro
    IF ROW_COUNT() = 0 THEN
        INSERT INTO inventariomateriaprima (codigo_materia_prima, nombre_materia_prima, unidad_medida, total_ingreso, total_egreso)
        VALUES (NEW.codigo_materia_prima, NEW.nombre_materia_prima, '', 0, NEW.cantidad_egresada);
    END IF;
END
$$
DELIMITER ;

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
(2, 'Maria', 'Encargado de fabricación', '2024-03-10'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingresomateriaprima`
--

INSERT INTO `ingresomateriaprima` (`id_ingreso`, `codigo_materia_prima`, `nombre_materia_prima`, `descripcion`, `unidad_medida`, `cantidad_comprada`, `precio_unitario`, `fecha_ingreso`, `id_proveedor`) VALUES
(8, '1', 'd', 'prueba finalizada ', 'M', 10, '20.00', '2024-10-23', 2),
(9, '1010', 'Poliéster', 'Esta es una nueva materia prima ', 'M', 80, '20.00', '2024-10-23', 2),
(10, '1111', 'Lana', 'la buena', 'Libras', 170, '20.00', '2024-10-24', 2);

--
-- Disparadores `ingresomateriaprima`
--
DELIMITER $$
CREATE TRIGGER `after_insert_ingreso` AFTER INSERT ON `ingresomateriaprima` FOR EACH ROW BEGIN
    -- Intentar actualizar el registro si el código de materia prima ya existe
    UPDATE inventariomateriaprima
    SET total_ingreso = total_ingreso + NEW.cantidad_comprada
    WHERE codigo_materia_prima = NEW.codigo_materia_prima;

    -- Si no se actualizó ninguna fila (porque no existe), insertar un nuevo registro
    IF ROW_COUNT() = 0 THEN
        INSERT INTO inventariomateriaprima (codigo_materia_prima, nombre_materia_prima, unidad_medida, total_ingreso, total_egreso)
        VALUES (NEW.codigo_materia_prima, NEW.nombre_materia_prima, NEW.unidad_medida, NEW.cantidad_comprada, 0);
    END IF;
END
$$
DELIMITER ;

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
-- Estructura de tabla para la tabla `inventariomateriaprima`
--

CREATE TABLE `inventariomateriaprima` (
  `id_inventario` int(11) NOT NULL,
  `codigo_materia_prima` varchar(50) NOT NULL,
  `nombre_materia_prima` varchar(255) NOT NULL,
  `unidad_medida` varchar(50) NOT NULL,
  `total_ingreso` int(11) NOT NULL DEFAULT 0,
  `total_egreso` int(11) NOT NULL DEFAULT 0,
  `saldo_actual` int(11) GENERATED ALWAYS AS (`total_ingreso` - `total_egreso`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventariomateriaprima`
--

INSERT INTO `inventariomateriaprima` (`id_inventario`, `codigo_materia_prima`, `nombre_materia_prima`, `unidad_medida`, `total_ingreso`, `total_egreso`) VALUES
(14, '1010', 'd', 'M', 30, 20),
(15, '2023', 'Tela de algodon', 'M', 10, 7),
(16, '1', 'd', 'M', 10, 0),
(17, '1111', 'Lana', 'Libras', 500, 330);

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
(72, 'Abrigos', 60, NULL, 4, '2024-10-17', NULL, 'Completada', 2, '2024-10-25'),
(73, 'PRUEBA5', 12, NULL, 3, '2024-10-23', NULL, 'Completada', 1, '2024-10-25'),
(74, 'PRUEBA5', 1, NULL, 3, '2024-10-23', NULL, 'Completada', 1, '2024-10-25'),
(75, 'PRUEBA5', 5, NULL, 1, '2024-10-23', NULL, 'Completada', 1, '2024-10-25'),
(76, 'PRUEBA6', 2, NULL, 1, '2024-10-23', NULL, 'Completada', 1, '2024-10-25'),
(77, 'Tigre', 10, NULL, 5, '2024-10-24', NULL, 'Completada', 4, '2024-10-25'),
(78, 'Gorra', 300, NULL, 5, '2024-10-25', NULL, 'Completada', 4, '2024-10-25'),
(79, 'Camisas', 10, NULL, 3, '2024-10-25', NULL, 'Completada', 1, '2024-10-25'),
(80, 'Corpiños', 10, NULL, 2, '2024-10-25', NULL, 'Completada', 2, '2024-10-25'),
(81, 'Prueba', 20, NULL, 1, '2024-10-25', NULL, 'Completada', 1, '2024-10-25');

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
(2, 'Frank', 'c/f', '12345678', 'frank12@gamil.com', 'Guatemala', 'Efectivo');

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
(4, 'Confección', 'Confección', 10000, 'Operativa'),
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
-- Indices de la tabla `ingresomateriaprima`
--
ALTER TABLE `ingresomateriaprima`
  ADD PRIMARY KEY (`id_ingreso`);

--
-- Indices de la tabla `inventariomateriaprima`
--
ALTER TABLE `inventariomateriaprima`
  ADD PRIMARY KEY (`id_inventario`);

--
-- Indices de la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD PRIMARY KEY (`id_produccion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ingresomateriaprima`
--
ALTER TABLE `ingresomateriaprima`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `inventariomateriaprima`
--
ALTER TABLE `inventariomateriaprima`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `produccion`
--
ALTER TABLE `produccion`
  MODIFY `id_produccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
