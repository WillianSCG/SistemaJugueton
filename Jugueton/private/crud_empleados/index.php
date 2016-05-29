<?php 
require("../lib/page.php");
require("../../lib/usuarios.php");

Page::header("Categorías");
Page::main();

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
 		</div>
 	</form>
</div>
<?php
	$data = usuarios::listaUsuarios();
 ?>
<table class='responsive-table centered striped'>
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Usuario</th>
			<th>Sucursal</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
<?php 
if($data != null)
	foreach($data as $row)
	{
		$fila = "
		<tr>
			<td>$row[0]</td>
			<td><p class='truncate'>$row[1]</p></td>
			<td><p class='truncate'>$row[2]</p></td>
			<td>
				<a href='delete.php?id=$row[0]' class='btn red tooltipped' data-position='bottom' data-delay='50' data-tooltip='Borrar'><i class='material-icons'>delete</i></a>
				<a href='delete.php?id=$row[0]' class='btn red tooltipped' data-position='bottom' data-delay='50' data-tooltip='Ver permisos'><i class='material-icons'>delete</i></a>
			</td>
		</tr>";
		print($fila);
	}
else
	print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros.</div>");
 ?>
 		<tr>
 			<td></td>
 			<td></td>
 			<td></td>
 			<td>
 				<a href='crear.php' class='btn indigo'><i class='material-icons right'>note_add</i>Nuevo</a>
 			</td>
 		</tr>
	</tbody>
</table>
<?php 
Page::footer();
?>