<?php 
require("../lib/page.php");
require("../../lib/permisos.php");
Page::header("Categorías");
$idcuenta = isset($_GET['ident']) ? $_GET['ident'] : 0;
if ($idcuenta === 0) {
	header('../index.php')
}
 ?>

 <div class="container">
 	<form method='post' class='row'>
 		<div class='input-field col s6 m4'>
 			<i class='material-icons prefix'>search</i>
 			<input id='buscar' type='text' name='buscar' class='validate'/>
 			<label for='buscar'>Búsqueda</label>
 		</div>
 		<div class='input-field col s6 m4'>
 			<button type='submit' class='btn grey left'><i class='material-icons right'>pageview</i>Aceptar</button> 	
 		</div>
 		<div class='input-field col s12 m4'>
 			<a href='save.php' class='btn indigo'><i class='material-icons right'>note_add</i>Nuevo</a>
 		</div>
 	</form>
</div>
<?php
$data = permiso::obtenerTodosPermisosDe($id_cuenta);
 ?>
<table class='responsive-table centered striped'>
	<thead>
		<tr>
			<th>Clase de permiso</th>
			<th>Formulario</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
<?php 
if($data != null)
{
	
	foreach($data as $row)
	{
		$fila = "";
		$fila .=	"<tr>
			<td>$row[0]</td>
			<td><p class='truncate'>$row[1]</p></td>
			<td>
				<a href='delete.php?id=$row[2]&ident=$idcuenta' class='btn red'><i class='material-icons'>delete</i></a>
			</td>
		</tr>";
		print($fila);
	}
}
else
{
	print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros.</div>");
}
 ?>
	</tbody>
</table>
<?php 
Page::footer();
?>