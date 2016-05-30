<?php
require("../lib/page.php");
require("../../lib/database.php");
Page::header("Eventos");
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
  	<div class='input-field col s12 m4'>
		<a href='save.php' class='btn indigo'><i class='material-icons right'>note_add</i>Nuevo</a>
  	</div>
</form>
<?php
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM eventos WHERE descripcion LIKE ? ORDER BY fecha_inicio";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM eventos ORDER BY fecha_inicio";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{
	$tabla = 	"<table class='centered striped'>
					<thead>
			    		<tr>
				    		<th>EVENTO</th>
				    		<th>FECHA INICIO</th>
				    		<th>FECHA FIN</th>
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)
		{
	        $tabla .=	"<tr>
	            			<td>$row[descripcion]</td>
	            			  			<td><img src='data:image/*;base64,$row[imagen_evento]' class='materialboxed' width='100' height='100'></td>
	            			<td><p class='truncate'>$row[fecha_inicio]</p></td>
	            			<td><p class='truncate'>$row[fecha_fin]</p></td>
	            			<td>";
if ($row['esta_activo'] == 'false') {
	$tabla .= "<p>
      <input type='checkbox' checked='checked' disabled='disabled' />
      <label class='blue-text'>Deshabilitado</label>
    </p>";
}
else {
	$tabla .= "<p>
      <input type='checkbox' checked='checked'/>
      <label class='blue-text'>Habilitado</label>
    </p>";
}
			$tabla .= 				"</td>
	            			<td>
	            				<a href='save.php?id=$row[id_evento]' class='btn blue'><i class='material-icons'>mode_edit</i></a>
								<a href='delete.php?id=$row[id_evento]' class='btn red'><i class='material-icons'>delete</i></a>
							</td>
	        			</tr>";
		}
		$tabla .= 	"</tbody>
    			</table>";
	print($tabla);
}
else
{
	print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros.</div>");
}
Page::footer();
?>