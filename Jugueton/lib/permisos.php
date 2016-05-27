<?php 

include 'database.php';

class permiso
{
	public static function obtenerTodosPermisosDe($id_cuenta)
	{
		$sql = '
SELECT acciones.accion, pantallas.nombre_pantalla, permisos.id_permiso, permisos.id_accion, permisos.id_pantalla, permisos.id_cuenta_mantenimiento
FROM jugueton.permisos
    LEFT JOIN jugueton.acciones ON permisos.id_accion = acciones.id_accion
    LEFT JOIN jugueton.pantallas ON permisos.id_pantalla = pantallas.id_pantalla
WHERE (permisos.id_cuenta_mantenimiento =?)';
		return Database::getRows($sql, array($id_cuenta));
	}

	public static function crearPermiso($accion, $pantalla, $usuario)
	{
		$res = '';
		if (empty($accion) || empty($pantalla) || empty($usuario)) {
			$res .=	empty($accion)? "<p>Campo incompleto de accion</p>" : '';
			$res .=	empty($pantalla)? "<p>Campo incompleto de pantalla</p>" : '';
			$res .=	empty($usuario)? "<p>Campo incompleto de usuario</p>" : '';
		} else {
			$sql = "INSERT INTO jugueton.permisos VALUES (?,?,?);";
			$valores = array($accion, $pantalla, $usuario);
			Database::executeRow($sql, $valores);
		}
		return $res;
	}
}

 ?>