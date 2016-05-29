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
	$sql = "SELECT * FROM descuentos WHERE porcentaje LIKE ? ORDER BY porcentaje";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM descuentos ORDER BY porcentaje";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{
	$tabla = 	"<table class='centered striped'>
					<thead>
			    		<tr>
				    		<th>PORCENTAJE</th>
				    		<th>CODIGO</th>
				    		<th>ESTADO</th>
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)
		{
	        $tabla .=	"<tr>
	            			<td>$row[porcentaje]</td>
	            			<td><p class='truncate'>$row[codigo_identificador]</p></td>
	            			<td><p class='truncate'>$row[usado_cupon]</p></td>
	            			<td>
	            				<a href='save.php?id=$row[id_descuento_porcentual]' class='btn blue'><i class='material-icons'>mode_edit</i></a>
								<a href='delete.php?id=$row[id_descuento_porcentual]' class='btn red'><i class='material-icons'>delete</i></a>
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