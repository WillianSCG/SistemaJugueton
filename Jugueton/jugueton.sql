#create database jugueton;

create table if not exists marcas( #M
	id_marca int(11) unsigned not null auto_increment primary key,
	marca varchar(35) unique not null,
	ruta_imagen_marcas varchar(300) not null
);

create table if not exists categorias( #M
	id_categoria int(11) unsigned not null auto_increment primary key,
	categoria varchar(35) unique not null,
	ruta_imagen_categoria varchar(300) not null
);

create table if not exists clasificaciones( #M
	id_clasificacion int(11) unsigned not null auto_increment primary key,
	clasificacion varchar(35) unique not null,
	ruta_imagen_clasificacion varchar(300) not null
);

create table if not exists productos( #M
	id_producto int(11) unsigned not null auto_increment primary key,
	nombre_producto varchar(150) unique not null,
	descripcion_producto varchar(350) unique not null,
	existencias_producto int unsigned not null default 0,
	precio_normal_producto decimal(7,2) unsigned not null,
	precio_oferta_producto decimal(7,2) unsigned not null,
	precio_afiliado_producto decimal(7,2) unsigned not null,
	id_categoria int(11) unsigned not null,
	id_clasificacion int(11) unsigned not null,
	id_marca int(11) unsigned not null, 
	estado_oferta enum('false','true') default 'false' not null,
	index (id_categoria, id_clasificacion, id_marca),
	foreign key (id_categoria) references jugueton.categorias(id_categoria) on update restrict on delete restrict,
	foreign key (id_clasificacion) references jugueton.clasificaciones(id_clasificacion) on update restrict on delete restrict,
	foreign key (id_marca) references jugueton.marcas(id_marca) on update restrict on delete restrict
);

create table if not exists imagenes_productos( #M
	id_imagene_producto int(11) unsigned not null auto_increment primary key,
	id_producto int(11) unsigned not null,
	ruta_imagene_producto varchar(300) not null,
	index(id_producto),
	foreign key (id_producto) references jugueton.productos(id_producto) on update restrict on delete restrict
);

create table if not exists promociones( #M
	id_promocion int(11) unsigned not null auto_increment primary key,
	promocionactivada enum('false','true') default 'false' not null,
	id_producto int(11) unsigned not null,
	promo_cantidad int(4) unsigned,
	precio_promocion decimal(7,2) unsigned not null,
	promo_fecha_ini date not null,
	promo_fecha_fin date not null,
	index(id_producto),
	foreign key (id_producto) references jugueton.productos(id_producto) on update restrict on delete restrict
);

create table if not exists clientes( #I
    id_cliente int(11) unsigned not null auto_increment primary key,
	usuario_cliente varchar(25) unique not null,
	contra_hash_cliente varchar(200) not null,
	nombres_cliente varchar(100) not null,
	apellidos_cliente varchar(200) not null,
	telefono_fijo int(8),
	telefono_movil int(8),
	direccion_primaria varchar(250),
	direccion_secundaria varchar(250),
	creacion_cliente date not null,
	ultimo_acceso timestamp not null
);

create table if not exists cuentas_club( #I
	id_cuenta_club int(11) unsigned not null auto_increment primary key,
	nombre_cuenta_club varchar(20) unique not null,
	contra_hash_cuenta_club  varchar(150) not null,
	creacion_cuenta_club date not null,
	ultimo_acceso_cuenta_club timestamp not null
);

create table if not exists duis( #M
	id_dui int(11) unsigned not null auto_increment primary key,
	codigo_identificador varchar(20) unique not null,
	fecha_creacion date not null,
	esta_activa enum('false', 'true') default 'false' not null,
	id_cliente int(11) unsigned,
	id_cuenta_club int(11) unsigned,
	index(id_cliente, id_cuenta_club),
	foreign key (id_cliente) references jugueton.clientes(id_cliente) on update restrict on delete restrict,
	foreign key (id_cuenta_club) references jugueton.cuentas_club(id_cuenta_club) on update restrict on delete restrict
);

create table if not exists ventas( #P
	id_venta int(11) unsigned not null auto_increment primary key,
	id_cliente int(11) unsigned not null,
	fecha_venta date not null,
	cantidad_a_pagar_total decimal(8,2),
	cantidad_descuento decimal(8,2),
	cantidad_a_pagar_total_final decimal(8,2),
	index(id_cliente), 
	foreign key (id_cliente) references jugueton.clientes(id_cliente) on update restrict on delete restrict
);

create table if not exists detalles_ventas(#P
    id_detalle_ventas int(11) unsigned not null auto_increment primary key,
	id_venta int(11) unsigned not null,
	id_producto int(11) unsigned not null,
	cantidad_producto int unsigned,
	cantidad_pagada decimal(7,2) not null,
	index(id_producto, id_venta),
	foreign key (id_producto) references jugueton.productos(id_producto)  on update restrict on delete restrict,
	foreign key (id_venta) references jugueton.ventas(id_venta)  on update restrict on delete restrict
);

create table if not exists descuentos( #MV
	id_descuento int(11) unsigned not null auto_increment primary key,
	porcentaje int(3) unsigned not null,
	codigo_identificador char(16) unique not null,
	usado_cupon enum('false', 'true') default 'false' not null,
	creador_id_cuenta_club int(11) unsigned not null,
	padre_id_cliente int(11) unsigned not null,
	index(creador_id_cuenta_club, padre_id_cliente),
	foreign key (creador_id_cuenta_club) references cuentas_club(id_cuenta_club) on update restrict on delete restrict,
	foreign key (padre_id_cliente) references clientes(id_cliente) on update restrict on delete restrict
);

create table if not exists categorias_juegos( #M
	id_categoria_juego int(11) unsigned not null auto_increment primary key,
	categoria_juego varchar(35) unique not null
);

create table if not exists juegos( #M
	id_juego int(11) unsigned not null auto_increment primary key,
	id_categoria_juego int(11) unsigned not null,
	nombre_juego varchar(50) unique not null,
	descripcion_juego varchar(250) not null,
	ruta_juego varchar(150) unique not null,
	index(id_categoria_juego),
	foreign key (id_categoria_juego) references jugueton.categorias_juegos(id_categoria_juego) on update restrict on delete restrict
);

create table if not exists imagenes_juegos( #M
	id_imagene_juego int(11) unsigned not null auto_increment primary key,
	id_juego int(11) unsigned not null,
	ruta_imagene_juego varchar(150) unique not null,
	es_primario enum('false', 'true') default 'true' not null,
	index(id_juego),
	foreign key (id_juego) references jugueton.juegos(id_juego) on update restrict on delete restrict
);

create table if not exists records( #P
	id_record int(11) unsigned not null auto_increment primary key,
	id_juego int(11) unsigned not null,
	id_cuenta_club int(11) unsigned not null,
	puntaje_record int(7) unsigned not null default 0,
	index(id_juego, id_cuenta_club),
	foreign key (id_juego) references jugueton.juegos(id_juego) on update restrict on delete restrict,
	foreign key (id_cuenta_club) references jugueton.cuentas_club(id_cuenta_club) on update restrict on delete restrict
);

create table if not exists recompensas( #M
	id_recompensa int(11) unsigned not null auto_increment primary key,
	id_juego  int(11) unsigned not null,
	puntaje_record_necesario int(7),
	esta_activa enum('false', 'true') default 'true' not null,
	porcentaje_recompensa int(3) unsigned,
	foreign key (id_juego) references jugueton.juegos(id_juego) on update restrict on delete restrict
);

create table if not exists sucursales( #M
	id_sucursal int(11) unsigned not null auto_increment primary key,
	nombre_sucursal varchar(50) unique not null,
	direccion_sucursal varchar(250) not null
);

create table if not exists cuentas( #M
	id_cuenta int(11) unsigned not null auto_increment primary key,
	nombre_completo_usuario varchar(300),
	dui_usuario varchar(12) unique not null,
	cuenta_mantenimiento varchar(35) unique not null,
	contra_hash_cuenta_mantenimiento varchar(200) not null,
	creacion_cuenta_mantenimiento date not null,
	ultimo_acceso_cuenta_mantenimiento timestamp not null,
	id_sucursal int(11) unsigned not null,
	index(id_sucursal),
	foreign key (id_sucursal) references jugueton.sucursales(id_sucursal) on update restrict on delete restrict
);

create table if not exists acciones( #M1
    id_accion int(11) unsigned not null primary key,
    accion int(1) not null
);

create table if not exists pantallas( #M1
    id_pantalla int(11) unsigned not null primary key,
    nombre_pantalla varchar(35) unique not null
);

create table if not exists permisos( #M1
	id_permiso int(11) unsigned not null auto_increment primary key,
	id_accion int(11) unsigned not null,
	id_pantalla int(11) unsigned not null,
    id_cuenta int(11) unsigned not null,
	index(id_accion, id_pantalla, id_cuenta),
	foreign key (id_accion) references jugueton.acciones(id_accion) on update restrict on delete restrict,
	foreign key (id_pantalla) references jugueton.pantallas(id_pantalla) on update restrict on delete restrict,
	foreign key (id_cuenta) references jugueton.cuentas(id_cuenta) on update restrict on delete restrict
);

create table if not exists encarrito( #I
	id_encarrito int(11) unsigned not null auto_increment primary key,
	id_producto int(11) unsigned not null,
	cantidad_producto int(2) unsigned not null,
	id_cliente int(11) unsigned unique not null,
	index(id_cliente, id_producto),
	foreign key (id_cliente) references jugueton.clientes(id_cliente) on update restrict on delete restrict,
	foreign key (id_producto) references jugueton.productos(id_producto)  on update restrict on delete restrict
);

create table if not exists eventos( #M
	id_evento int(11) unsigned not null auto_increment primary key,
	fecha_inicio date not null,
	fecha_fin date not null,
	esta_activo enum('false', 'true') default 'true' not null
);

create table if not exists noticias( #M
	id_noticia int(11) unsigned not null auto_increment primary key,
	cabecera varchar(50) not null,
	informacion varchar(500) not null,
	fecha timestamp not null
);

create table if not exists imagenes_slider( #M
	id_imagen_slider int(11) unsigned not null auto_increment primary key,
	ruta varchar(150) not null,
	esta_activo enum('false', 'true') default 'true' not null,
	slider_padre int(11) unsigned not null #Es como un ID de slider pero no crearemos una tabla de slider por que el usuario no puede crear más sliders.
);