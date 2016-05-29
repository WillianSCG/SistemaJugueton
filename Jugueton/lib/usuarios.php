<?php 

require 'database.php';

/**
cuentas
id_cuenta
nombre_completo_usuario
dui_usuario
cuenta_mantenimiento
contra_hash_cuenta_mantenimiento
creacion_cuenta_mantenimiento
ultimo_acceso_cuenta_mantenimiento
id_sucursal
*/
class usuarios
{
	public static function eliminarCuenta($id_cuenta)
	{
		$sql = "DELETE FROM cuentas WHERE id_cuenta=?;";
		$valores = array($id_cuenta);
		Database::executeRow($sql, $valores);
	}

	public static function actualizar($nombre, $dui_usuario, $id_sucursal, $id_cuenta)
	{
		$res = self::validar($nombre, $dui_usuario, $usuario, $contra, $id_sucursal);
		if (mb_strlen($res) > 1)
			return $res;
		else {
			$sql = "UPDATE cuentas SET nombre_completo_usuario = ?, dui_usuario = ?, id_sucursal = ? WHERE id_cuenta = ? ;";
			$valores = array($nombre, $dui_usuario, $id_sucursal, $id_cuenta);
			Database::executeRow($sql, $valores);
			return $res;
		}
	}

	public static function crearCuenta($nombre, $dui_usuario, $usuario, $contra, $id_sucursal) {
		$res = self::validar($nombre, $dui_usuario, $usuario, $contra, $id_sucursal);
		if (mb_strlen($res) > 1)
			return $res;
		else {
			$sql = "INSERT INTO cuentas(nombre_completo_usuario, dui_usuario, cuenta_mantenimiento, contra_hash_cuenta_mantenimiento, creacion_cuenta_mantenimiento,id_sucursal) VALUES (?,?,?,?,CURDATE(),?)";
			$valores = array($nombre, $dui_usuario, $usuario, $contra, $id_sucursal);
			Database::executeRow($sql, $valores);
			return $res;
		}
	}

	public static function validarActualizacion($nombre, $dui_usuario, $id_sucursal, $id_cuenta)
	{
		$res = "";
		$res .= (empty(trim($nombre))) ? '<p>Nombre incompleto.</p>' : '' ;
		$res .= !(mb_strlen($dui_usuario) === 9) ? '<p>Número de DUI incompleto.</p>' : '';
		$res .= (empty($id_sucursal)) ? '<p>Pendiente información de sucursal.</p>' : '' ;
		return $res;
	}

	public static function validar($nombre, $dui_usuario, $usuario, $contra, $id_sucursal)
	{
		$res = '';
		$res .= (empty(trim($nombre))) ? '<p>Nombre incompleto.</p>' : '' ;
		$res .= !(mb_strlen($dui_usuario)) === 9 ? '<p>Número de DUI incompleto.</p>' : '' ;
		$res .= (empty(trim($usuario))) ? '<p>Nombre de usuario vacío.</p>' : '' ;
		$res .= (empty(trim($contra))) ? '<p>Contraseña vacía.</p>' : '' ;
		$res .= (empty($id_sucursal)) ? '<p>Pendiente información de sucursal.</p>' : '' ;
		return $res;
	}

	public static function listaUsuarios()
	{
		$sql = "
			SELECT cuentas.nombre_completo_usuario, cuentas.cuenta_mantenimiento, sucursales.nombre_sucursal
			FROM cuentas
				LEFT JOIN sucursales
			ON cuentas.id_sucursal = sucursales.id_sucursal";
		$valores = array();
		return Database::getRows($sql, $valores);
	}

	public static function comprobarExistencia($usuario, $dui_usuario)
	{
		$sql = "SELECT cuenta_mantenimiento FROM cuentas WHERE cuenta_mantenimiento=?;";
		$valores = array($usuario);
		$errores = !empty(Database::getRow($sql, $valores)) ? "<p>Esa cuenta de usuario ya está en uso.</p>" : '';

		$sql = "SELECT cuenta_mantenimiento FROM cuentas WHERE dui_usuario=?;";
		$valores = array($dui_usuario);
		$errores .= !empty(Database::getRow($sql, $valores)) ? "<p>Ese dui ya ha sido registrado.</p>" : '';
		
		return $errores;
	}
}

 ?>