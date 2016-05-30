

CREATE TABLE `acciones` (
  `id_accion` int(11) UNSIGNED NOT NULL,
  `accion` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) UNSIGNED NOT NULL,
  `categoria` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `ruta_imagen_categoria` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_juegos`
--

CREATE TABLE `categorias_juegos` (
  `id_categoria_juego` int(11) UNSIGNED NOT NULL,
  `categoria_juego` varchar(35) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificaciones`
--

CREATE TABLE `clasificaciones` (
  `id_clasificacion` int(11) UNSIGNED NOT NULL,
  `clasificacion` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `ruta_imagen_clasificacion` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) UNSIGNED NOT NULL,
  `usuario_cliente` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `contra_cliente` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nombres_cliente` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos_cliente` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `telefono_fijo` int(8) DEFAULT NULL,
  `telefono_movil` int(8) DEFAULT NULL,
  `direccion_primaria` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion_secundaria` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creacion_cliente` date NOT NULL,
  `ultimo_acceso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_club`
--

CREATE TABLE `cuentas_club` (
  `id_cuenta_club` int(11) UNSIGNED NOT NULL,
  `usuario_cliente` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nombres_cuenta_club` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos_cuenta_club` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `contra_cuenta_club` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `creacion_cuenta_club` date NOT NULL,
  `ultimo_acceso_cuenta_club` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id_descuento` int(11) UNSIGNED NOT NULL,
  `porcentaje` int(3) UNSIGNED NOT NULL,
  `codigo_identificador` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `usado_cupon` enum('false','true') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `creador_id_cuenta_club` int(11) UNSIGNED NOT NULL,
  `padre_id_cliente` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_ventas`
--

CREATE TABLE `detalles_ventas` (
  `id_detalle_ventas` int(11) UNSIGNED NOT NULL,
  `id_venta` int(11) UNSIGNED NOT NULL,
  `id_producto` int(11) UNSIGNED NOT NULL,
  `cantidad_producto` int(10) UNSIGNED DEFAULT NULL,
  `cantidad_pagada` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `duis`
--

CREATE TABLE `duis` (
  `id_dui` int(11) UNSIGNED NOT NULL,
  `codigo_identificador` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `esta_activa` enum('false','true') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `id_cliente` int(11) UNSIGNED DEFAULT NULL,
  `id_cuenta_club` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) UNSIGNED NOT NULL,
  `usuario_empleado` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nombres_empleado` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos_empleado` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `correo_empleado` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `contra_empleado` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `creacion_cuenta_empleado` date NOT NULL,
  `ultimo_acceso_cuenta_empleado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_sucursal` int(11) UNSIGNED NOT NULL,
  `idsesion` char(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encarrito`
--

CREATE TABLE `encarrito` (
  `id_encarrito` int(11) UNSIGNED NOT NULL,
  `id_producto` int(11) UNSIGNED NOT NULL,
  `cantidad_producto` int(2) UNSIGNED NOT NULL,
  `id_cliente` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) UNSIGNED NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `esta_activo` enum('false','true') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_juegos`
--

CREATE TABLE `imagenes_juegos` (
  `id_imagene_juego` int(11) UNSIGNED NOT NULL,
  `id_juego` int(11) UNSIGNED NOT NULL,
  `ruta_imagene_juego` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `es_primario` enum('false','true') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_productos`
--

CREATE TABLE `imagenes_productos` (
  `id_imagene_producto` int(11) UNSIGNED NOT NULL,
  `id_producto` int(11) UNSIGNED NOT NULL,
  `ruta_imagene_producto` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_slider`
--

CREATE TABLE `imagenes_slider` (
  `id_imagen_slider` int(11) UNSIGNED NOT NULL,
  `ruta` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `esta_activo` enum('false','true') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true',
  `slider_padre` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id_juego` int(11) UNSIGNED NOT NULL,
  `id_categoria_juego` int(11) UNSIGNED NOT NULL,
  `nombre_juego` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_juego` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ruta_juego` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) UNSIGNED NOT NULL,
  `marca` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `ruta_imagen_marcas` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id_noticia` int(11) UNSIGNED NOT NULL,
  `cabecera` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `informacion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pantallas`
--

CREATE TABLE `pantallas` (
  `id_pantalla` int(11) UNSIGNED NOT NULL,
  `nombre_pantalla` varchar(35) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) UNSIGNED NOT NULL,
  `id_accion` int(11) UNSIGNED NOT NULL,
  `id_pantalla` int(11) UNSIGNED NOT NULL,
  `id_empleado` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) UNSIGNED NOT NULL,
  `nombre_producto` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_producto` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `existencias_producto` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `precio_normal_producto` decimal(7,2) UNSIGNED NOT NULL,
  `precio_oferta_producto` decimal(7,2) UNSIGNED NOT NULL,
  `precio_afiliado_producto` decimal(7,2) UNSIGNED NOT NULL,
  `id_categoria` int(11) UNSIGNED NOT NULL,
  `id_clasificacion` int(11) UNSIGNED NOT NULL,
  `id_marca` int(11) UNSIGNED NOT NULL,
  `estado_oferta` enum('false','true') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id_promocion` int(11) UNSIGNED NOT NULL,
  `promocionactivada` enum('false','true') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `id_producto` int(11) UNSIGNED NOT NULL,
  `promo_cantidad` int(4) UNSIGNED DEFAULT NULL,
  `precio_promocion` decimal(7,2) UNSIGNED NOT NULL,
  `promo_fecha_ini` date NOT NULL,
  `promo_fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recompensas`
--

CREATE TABLE `recompensas` (
  `id_recompensa` int(11) UNSIGNED NOT NULL,
  `id_juego` int(11) UNSIGNED NOT NULL,
  `puntaje_record_necesario` int(7) DEFAULT NULL,
  `esta_activa` enum('false','true') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true',
  `porcentaje_recompensa` int(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `records`
--

CREATE TABLE `records` (
  `id_record` int(11) UNSIGNED NOT NULL,
  `id_juego` int(11) UNSIGNED NOT NULL,
  `id_cuenta_club` int(11) UNSIGNED NOT NULL,
  `puntaje_record` int(7) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id_sucursal` int(11) UNSIGNED NOT NULL,
  `sucursal` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_sucursal` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id_sucursal`, `sucursal`, `direccion_sucursal`) VALUES
(1, 'Metrocentro', 'Metrocento 1° etapa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) UNSIGNED NOT NULL,
  `id_cliente` int(11) UNSIGNED NOT NULL,
  `fecha_venta` date NOT NULL,
  `cantidad_a_pagar_total` decimal(8,2) DEFAULT NULL,
  `cantidad_descuento` decimal(8,2) DEFAULT NULL,
  `cantidad_a_pagar_total_final` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id_accion`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `categoria` (`categoria`);

--
-- Indices de la tabla `categorias_juegos`
--
ALTER TABLE `categorias_juegos`
  ADD PRIMARY KEY (`id_categoria_juego`),
  ADD UNIQUE KEY `categoria_juego` (`categoria_juego`);

--
-- Indices de la tabla `clasificaciones`
--
ALTER TABLE `clasificaciones`
  ADD PRIMARY KEY (`id_clasificacion`),
  ADD UNIQUE KEY `clasificacion` (`clasificacion`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `usuario_cliente` (`usuario_cliente`);

--
-- Indices de la tabla `cuentas_club`
--
ALTER TABLE `cuentas_club`
  ADD PRIMARY KEY (`id_cuenta_club`),
  ADD UNIQUE KEY `usuario_cliente` (`usuario_cliente`),
  ADD UNIQUE KEY `nombres_cuenta_club` (`nombres_cuenta_club`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id_descuento`),
  ADD UNIQUE KEY `codigo_identificador` (`codigo_identificador`),
  ADD KEY `creador_id_cuenta_club` (`creador_id_cuenta_club`,`padre_id_cliente`),
  ADD KEY `padre_id_cliente` (`padre_id_cliente`);

--
-- Indices de la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  ADD PRIMARY KEY (`id_detalle_ventas`),
  ADD KEY `id_producto` (`id_producto`,`id_venta`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `duis`
--
ALTER TABLE `duis`
  ADD PRIMARY KEY (`id_dui`),
  ADD UNIQUE KEY `codigo_identificador` (`codigo_identificador`),
  ADD KEY `id_cliente` (`id_cliente`,`id_cuenta_club`),
  ADD KEY `id_cuenta_club` (`id_cuenta_club`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD UNIQUE KEY `usuario_empleado` (`usuario_empleado`),
  ADD UNIQUE KEY `nombres_empleado` (`nombres_empleado`),
  ADD UNIQUE KEY `correo_empleado` (`correo_empleado`),
  ADD KEY `id_sucursal` (`id_sucursal`);

--
-- Indices de la tabla `encarrito`
--
ALTER TABLE `encarrito`
  ADD PRIMARY KEY (`id_encarrito`),
  ADD UNIQUE KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_cliente_2` (`id_cliente`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indices de la tabla `imagenes_juegos`
--
ALTER TABLE `imagenes_juegos`
  ADD PRIMARY KEY (`id_imagene_juego`),
  ADD UNIQUE KEY `ruta_imagene_juego` (`ruta_imagene_juego`),
  ADD KEY `id_juego` (`id_juego`);

--
-- Indices de la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  ADD PRIMARY KEY (`id_imagene_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `imagenes_slider`
--
ALTER TABLE `imagenes_slider`
  ADD PRIMARY KEY (`id_imagen_slider`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id_juego`),
  ADD UNIQUE KEY `nombre_juego` (`nombre_juego`),
  ADD UNIQUE KEY `ruta_juego` (`ruta_juego`),
  ADD KEY `id_categoria_juego` (`id_categoria_juego`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`),
  ADD UNIQUE KEY `marca` (`marca`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_noticia`);

--
-- Indices de la tabla `pantallas`
--
ALTER TABLE `pantallas`
  ADD PRIMARY KEY (`id_pantalla`),
  ADD UNIQUE KEY `nombre_pantalla` (`nombre_pantalla`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `id_accion` (`id_accion`,`id_pantalla`,`id_empleado`),
  ADD KEY `id_pantalla` (`id_pantalla`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `nombre_producto` (`nombre_producto`),
  ADD UNIQUE KEY `descripcion_producto` (`descripcion_producto`),
  ADD KEY `id_categoria` (`id_categoria`,`id_clasificacion`,`id_marca`),
  ADD KEY `id_clasificacion` (`id_clasificacion`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id_promocion`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `recompensas`
--
ALTER TABLE `recompensas`
  ADD PRIMARY KEY (`id_recompensa`),
  ADD KEY `id_juego` (`id_juego`);

--
-- Indices de la tabla `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id_record`),
  ADD KEY `id_juego` (`id_juego`,`id_cuenta_club`),
  ADD KEY `id_cuenta_club` (`id_cuenta_club`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id_sucursal`),
  ADD UNIQUE KEY `nombre_sucursal` (`sucursal`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categorias_juegos`
--
ALTER TABLE `categorias_juegos`
  MODIFY `id_categoria_juego` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clasificaciones`
--
ALTER TABLE `clasificaciones`
  MODIFY `id_clasificacion` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cuentas_club`
--
ALTER TABLE `cuentas_club`
  MODIFY `id_cuenta_club` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id_descuento` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  MODIFY `id_detalle_ventas` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `duis`
--
ALTER TABLE `duis`
  MODIFY `id_dui` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `encarrito`
--
ALTER TABLE `encarrito`
  MODIFY `id_encarrito` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagenes_juegos`
--
ALTER TABLE `imagenes_juegos`
  MODIFY `id_imagene_juego` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  MODIFY `id_imagene_producto` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagenes_slider`
--
ALTER TABLE `imagenes_slider`
  MODIFY `id_imagen_slider` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id_juego` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_noticia` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id_promocion` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `recompensas`
--
ALTER TABLE `recompensas`
  MODIFY `id_recompensa` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `records`
--
ALTER TABLE `records`
  MODIFY `id_record` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id_sucursal` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD CONSTRAINT `descuentos_ibfk_1` FOREIGN KEY (`creador_id_cuenta_club`) REFERENCES `cuentas_club` (`id_cuenta_club`),
  ADD CONSTRAINT `descuentos_ibfk_2` FOREIGN KEY (`padre_id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  ADD CONSTRAINT `detalles_ventas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `detalles_ventas_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);

--
-- Filtros para la tabla `duis`
--
ALTER TABLE `duis`
  ADD CONSTRAINT `duis_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `duis_ibfk_2` FOREIGN KEY (`id_cuenta_club`) REFERENCES `cuentas_club` (`id_cuenta_club`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`);

--
-- Filtros para la tabla `encarrito`
--
ALTER TABLE `encarrito`
  ADD CONSTRAINT `encarrito_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `encarrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `imagenes_juegos`
--
ALTER TABLE `imagenes_juegos`
  ADD CONSTRAINT `imagenes_juegos_ibfk_1` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`);

--
-- Filtros para la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  ADD CONSTRAINT `imagenes_productos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD CONSTRAINT `juegos_ibfk_1` FOREIGN KEY (`id_categoria_juego`) REFERENCES `categorias_juegos` (`id_categoria_juego`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_accion`) REFERENCES `acciones` (`id_accion`),
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`id_pantalla`) REFERENCES `pantallas` (`id_pantalla`),
  ADD CONSTRAINT `permisos_ibfk_3` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_clasificacion`) REFERENCES `clasificaciones` (`id_clasificacion`),
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`);

--
-- Filtros para la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD CONSTRAINT `promociones_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `recompensas`
--
ALTER TABLE `recompensas`
  ADD CONSTRAINT `recompensas_ibfk_1` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`);

--
-- Filtros para la tabla `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_ibfk_1` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`),
  ADD CONSTRAINT `records_ibfk_2` FOREIGN KEY (`id_cuenta_club`) REFERENCES `cuentas_club` (`id_cuenta_club`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
