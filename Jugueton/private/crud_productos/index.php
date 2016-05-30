<?php
require("../lib/page.php");
require("../../lib/productos.php");
Page::header("Empleados");
Page::main();
?>
<form method='post' class='row'>
	<div class='input-field col s6 m4'>
      	<i class='material-icons prefix'>search</i>
      	<input id='buscar' type='text' name='buscar' class='validate'/>
      	<label for='buscar'>Búsqueda</label>
    </div>
    <div class='input-field col s6 m4'>
    	<button type='submit' class='btn grey left'><i class='material-icons right'>pageview</i>Aceptar</button> 	
  	</div>
</form>

<?php
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM noticias WHERE titulo LIKE ? ORDER BY fecha_noticia";
	$params = array("%$search%");
	$data = Database::getRows($sql, $params);
}
else
	$data = productos::obtenerProductos();

?>
<table class='responsive-table centered striped'>
	<thead>
		<tr>
			<th>Nombre Producto</th>
			<th>Descripcion Producto</th>
			<th>Precio normal producto</th>
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
			<td><p class='truncate'>$row[1]</p></td>
			<td><p class='truncate'>$row[2]</p></td>
			<td><p class='truncate'>$row[3]</p></td>
			<td>
				<a href='delete.php?id=$row[0]' class='btn red tooltipped' data-position='bottom' data-delay='50' data-tooltip='Borrar'><i class='material-icons'>delete</i></a>
			</td>
		</tr>";
		print($fila);
	}
?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>
				<a href='crear.php' class='btn blue tooltipped' data-position='top' data-delay='50' data-tooltip='Crear uno nuevo'>
					<i class="material-icons">note_add</i>
				</a>
			</td>
		</tr>
	</tbody>
</table>
<?php 
Page::footer();
?>