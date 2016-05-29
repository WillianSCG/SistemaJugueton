<?php 
/*
productos
id_producto
nombre_producto
descripcion_producto
existencias_producto
precio_normal_producto
precio_oferta_producto
precio_afiliado_producto
id_categoria
id_clasificacion
id_marca
estado_oferta
*/

/**
* Clase de productos
*/
require 'database.php';

class productos
{
	public static function validar($nombre, $descripcion, $precio_normal, $precio_oferta, $precio_afiliado, $categoria, $clasificacion, $marca)
	{
		$errores = '';
		$errores .= empty($nombre) ? '<p>Nombre de producto vacío</p>' : '';
		$errores .= empty($descripcion) ? '<p>Descripcion de producto vacío</p>' : '';
		$errores .= empty($precio_normal) ? '<p>Precio normal vacío</p>' : '';
		$errores .= empty($precio_oferta) ? '<p>Precio oferta vacío</p>' : '';
		$errores .= empty($precio_afiliado) ? '<p>Precio afiliado vacío</p>' : '';
		$errores .= empty($categoria) ? '<p>categoria no elegida</p>' : '';
		$errores .= empty($clasificacion) ? '<p>Clasificacion no elegido</p>' : '';
		$errores .= empty($marca) ? '<p>Marca no elegida</p>' : '';
		return $errores;
	}

	public static function crear($nombre, $descripcion, $precio_normal, $precio_oferta, $precio_afiliado, $categoria, $clasificacion, $marca, $estado_oferta)
	{
		$sql = "INSERT INTO productos(nombre_producto, descripcion_producto, existencias_producto, precio_normal_producto, precio_oferta_producto, precio_afiliado_producto, id_categoria, id_clasificacion, id_marca, estado_oferta) VALUES(?,?,0, ?,?,?, ?,?,?, ?):";
		$valores = array($nombre, $descripcion, $precio_normal, $precio_oferta, $precio_afiliado, $categoria, $clasificacion, $marca, $estado_oferta);
		Database::executeRow($sql, $valores);
	}

	public static function obtenerProductos()
	{
		$sql = "";

	}
}
 ?>