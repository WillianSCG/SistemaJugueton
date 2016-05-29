<?php 
require("../lib/page.php");
require("../../lib/usuarios.php");

$nombre		 = isset($_POST['nombre']) 	? $_POST['nombre'] 	: '';
$dui_usuario = isset($_POST['dui']) 	? $_POST['dui'] 	: '';
$usuario	 = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$contra		 = isset($_POST['contra1']) ? $_POST['contra1'] : '';
$contra2	 = isset($_POST['contra2']) ? $_POST['contra2'] : '';
$id_sucursal = isset($_POST['sucursal'])? $_POST['sucursal']:  0;

$errores = '';

if (empty($_POST)) {

} else{
	$errores .= usuarios::comprobarExistencia($usuario, $dui_usuario);
	
	if (mb_strlen($errores) < 1) {
		if ($contra === $contra2) 
			$errores = usuarios::crearCuenta($nombre, $dui_usuario, $usuario, $contra, $id_sucursal);
		else $errores .= 'La contraseña no es igual';
	}

	if (mb_strlen($errores)==0) {
		header('index.php');	
	}
}

page::header("Crear usuario");
Page::main();

 ?>
<div class="container">
	<form method='post' class='row'>
		<div class="row">
			<div class='input-field col s12'>
				<div class="row">
					<div class="col s12 input-field">
						<i class="material-icons prefix">account_box</i>
						<input id="nombre" name="nombre" type="text" class="validate" length="300" <?php echo !empty($nombre) ? ' value="'.$nombre.'" ' : ''; ?>>
						<label for="nombre">Nombre completo</label>
					</div>
				</div>
			</div>
			<div class='input-field col s12 m6'>
				<div class="row">
					<div class="col s12 input-field">
						<i class="material-icons prefix">confirmation_number</i>
						<input id="dui" name="dui" type="number" class="validate" length="9" <?php echo !empty($dui_usuario) ? ' value="'.$dui_usuario.'" ' : ''; ?>>
						<label for="dui">DUI</label>
					</div>
				</div>
			</div>
			<div class='input-field col s12 m6'>
				<div class="row">
					<div class="col s12 input-field">
						<i class="material-icons prefix">account_circle</i>
						<input id="usuario" name="usuario" type="text" class="validate" length="9" <?php echo !empty($usuario) ? ' value="'.$usuario.'" ' : ''; ?>>
						<label for="usuario">Nombre de usuario</label>
					</div>
				</div>
			</div>
			<div class='input-field col s12 m6'>
				<div class="row">
					<div class="col s12 input-field">
						<i class="material-icons prefix">lock_outline</i>
						<input id="contraseña" name="contra1" type="password" class="validate" length="20" <?php echo !empty($contra) ? ' value="'.$contra.'" ' : ''; ?>>
						<label for="contraseña">Contraseña</label>
					</div>
				</div>
			</div>
			<div class='input-field col s12 m6'>
				<div class="row">
					<div class="col s12 input-field">
						<i class="material-icons prefix">lock_outline</i>
						<input id="contraseña2" name="contra2" type="password" class="validate" length="20" <?php echo !empty($contra2) ? ' value="'.$contra2.'" ' : ''; ?>>
						<label for="contraseña2">Repita contraseña</label>
					</div>
				</div>
			</div>
			<div class="input-field col s12 m6">
				<select name="sucursal">
					<option value="0" disabled selected>Elija una sucursal</option>
<?php 
$sql = "SELECT * FROM sucursales;";
$filas = Database::getRows($sql, null);
if (!empty($filas))
	foreach ($filas as $fila)
		print(
			"<option value='".$fila[0]."'".( $fila[0] == $id_sucursal ? ' selected ' : '').">".$fila[1]."</option>"
			);
?>
				</select>
				<label>Materialize Select</label>
			</div>
		</div>
		<div class='input-field col s12'>
			<button type='submit' class='btn grey right yuxtapuesto'><i class="material-icons right">note_add</i>Aceptar</button>
			<a href='index.php' class='btn indigo right yuxtapuesto'><i class='material-icons right'>not_interested</i>Cancelar</a>
		</div>
	</form>
<?php
if (mb_strlen($errores) > 0) 
	echo <<<OED
		<div class="row">
			<div class="col s12 m6">
				<div class="card blue-grey darken-1">
					<div class="card-content white-text">
						<span class="card-title">Errores</span>
						<p>$errores</p>
					</div>
				</div>
			</div>
		</div>
OED;

  ?>
</div>
<style>.yuxtapuesto { margin: 5px; }</style>
<?php 
Page::footer();
?>