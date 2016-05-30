<?php 
require("../lib/page.php");
require("../../lib/productos.php");

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

$nombre 		= isset($_POST['nombre']) ?			$_POST['nombre'] 		:		'' ;
$descripcion 	= isset($_POST['descripcion']) ?	$_POST['descripcion'] 	:		'' ;
$precio_no 		= isset($_POST['precio_no']) ?		$_POST['precio_no'] 	:		'' ;
$precio_of 		= isset($_POST['precio_of']) ?		$_POST['precio_of'] 	:		'' ;
$precio_af 		= isset($_POST['precio_af']) ?		$_POST['precio_af'] 	:		'' ;
$categoria 		= isset($_POST['categoria']) ?		$_POST['categoria'] 	:		 0 ;
$clasificacion 	= isset($_POST['clasificacion']) ?	$_POST['clasificacion'] :		 0 ;
$marca 			= isset($_POST['marca']) ?			$_POST['marca'] 		:		 0 ;
$estado_oferta 	= isset($_POST['estado_oferta']) ?	'true' 					:  'false' ;

$errores = '';

if (empty($_POST)) {

} else{
	$errores .= productos::validar($nombre, $descripcion, $precio_no, $precio_of, $precio_af, $categoria, $clasificacion, $marca);
	
	if (mb_strlen($errores) < 1) {
		$errores = productos::crearProducto($nombre, $descripcion, $precio_no, $precio_of, $precio_af, $categoria, $clasificacion, $marca, $estado_oferta);
	}
	if (mb_strlen($errores)==0) {
		header('index.php');	
	}
}

page::header("Crear producto");
Page::main();

 ?>
<div class="container">
	<form method='post' class='row'>
		<div class="row">
			<div class='input-field col s12 m6'>
				<div class="row">
					<div class="col s12 input-field">
						<input id="nombre" name="nombre" type="text" class="validate" length="300" <?php echo !empty($nombre) ? ' value="'.$nombre.'" ' : ''; ?>>
						<label for="nombre">Nombre</label>
					</div>
				</div>
			</div>
			<div class='input-field col s12 m6'>
				<div class="row">
					<div class="col s12 input-field">
						<input id="descripcion" name="descripcion" type="text" class="validate" length="9" <?php echo !empty($descripcion) ? ' value="'.$descripcion.'" ' : ''; ?>>
						<label for="descripcion">Descripcion</descripcion>
					</div>
				</div>
			</div>
			<div class='input-field col s12 m6'>
				<div class="row">
					<div class="col s12 input-field">
						<input id="precio_no" name="precio_no" type="number" class="validate" max="99999.99" min="0.01" step="any" <?php echo !empty($precio_no) ? ' value="'.$precio_no.'" ' : ''; ?>>
						<label for="precio_no">Precio normal</label>
					</div>
				</div>
			</div>
			<div class='input-field col s12 m6'>
				<div class="row">
					<div class="col s12 input-field">
						<input id="precio_of" name="precio_of" type="number" class="validate" max="99999.99" min="0.01" step="any" <?php echo !empty($precio_of) ? ' value="'.$precio_of.'" ' : ''; ?>>
						<label for="precio_of">Precio oferta</label>
					</div>
				</div>
			</div>
			<div class='input-field col s12 m6'>
				<div class="row">
					<div class="col s12 input-field">
						<input id="precio_af" name="precio_af" type="number" class="validate" max="99999.99" min="0.01" step="any" <?php echo !empty($precio_af) ? ' value="'.$precio_af.'" ' : ''; ?>>
						<label for="precio_af">Precio afiliado</label>
					</div>
				</div>
			</div>
			<div class="input-field col s12 m6">
				<select name="categoria">
					<option value="0" disabled selected>Elija una categoría</option>
<?php 
$sql = "SELECT * FROM categorias;";
$filas = Database::getRows($sql, null);
if (!empty($filas))
	foreach ($filas as $fila)
		print(
			"<option value='".$fila[0]."'".( $fila[0] == $categoria ? ' selected ' : '').">".$fila[1]."</option>"
			);
?>
				</select>
				<label>Categorías</label>
			</div>

			<div class="input-field col s12 m6">
				<select name="clasificacion">
					<option value="0" disabled selected>Elija una clasificación</option>
<?php 
$sql = "SELECT * FROM clasificaciones;";
$filas = Database::getRows($sql, null);
if (!empty($filas))
	foreach ($filas as $fila)
		print(
			"<option value='".$fila[0]."'".( $fila[0] == $clasificacion ? ' selected ' : '').">".$fila[1]."</option>"
			);
?>
				</select>
				<label>Clasificaciones</label>
			</div>

			<div class="input-field col s12 m6">
				<select name="marca">
					<option value="0" disabled selected>Elija una marcas</option>
<?php 
$sql = "SELECT * FROM marcas;";
$filas = Database::getRows($sql, null);
if (!empty($filas))
	foreach ($filas as $fila)
		print(
			"<option value='".$fila[0]."'".( $fila[0] == $marca ? ' selected ' : '').">".$fila[1]."</option>"
			);
?>
				</select>
				<label>Marcas</label>
			</div>
			<div class="input-field col s12 m6">
				<p>
					<input type="checkbox" id="chk_activo" name="estado_oferta" <?php echo ($estado_oferta == 'true') ? 'checked="checked"' : '' ;; ?>>
					<label for="chk_activo">Está en oferta</label>
				</p>
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