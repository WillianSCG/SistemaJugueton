<?php
require("../lib/page.php");
require("../../lib/database.php");
Page::header("noticias");
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
  	<div class='input-field col s12 m4'>
		<a href='save.php' class='btn indigo'><i class='material-icons right'>note_add</i>Nuevo</a>
  	</div>
</form>
<?php
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM noticias WHERE titulo LIKE ? ORDER BY fecha_noticia";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM noticias ORDER BY fecha_noticia";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{
	$tabla = 	"<table class='centered striped'>
					<thead>
			    		<tr>
				    		<th>TITULO</th>
				    		<th>IMAGEN</th>
				    		<th>DESCRIPCION</th>
				    		<th>FECHA</th>
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)
		{
	        $tabla .=	"<tr>
	            			<td>$row[titulo]</td>
	            			<td><img src='data:image/*;base64,$row[imagen_noticia]' class='materialboxed' width='100' height='100'></td>
	            			<td>$row[descripcion]</td>
	            			<td><p class='truncate'>$row[fecha_noticia]</p></td>
	            			
	            			<td>
	            				<a href='save.php?id=$row[id_noticia]' class='btn blue'><i class='material-icons'>mode_edit</i></a>
								<a href='delete.php?id=$row[id_noticia]' class='btn red'><i class='material-icons'>delete</i></a>
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