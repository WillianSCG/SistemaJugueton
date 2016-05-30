<?php
require("../lib/page.php");
require("../../lib/database.php");
require("../../lib/validator.php");

if(empty($_GET['id'])) 
{
    Page::header("Agregar clasificaciones");
    $id = null;
    $nombre=null;
    $imagen = null;
}
else
{
    Page::header("Modificar clasificaciones");
    $id = $_GET['id'];
    $sql = "SELECT * FROM clasificaciones WHERE id_clasificacion = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre = $data['clasificacion'];
    $imagen = $data['ruta_imagen_clasificacion'];
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$nombre = $_POST['nombre'];
    $archivo = $_FILES['imagen'];

    try 
    {
      	if($archivo['name'] != null)
        {
           	$base64 = Validator::validateImage($archivo);
           	if($base64 != false)
           	{
           	    $imagen = $base64;
           	}
           	else
           	{
           	    throw new Exception("La imagen seleccionada no es valida.");
           	}
        }
        else
        {
            if($imagen == null)
            {
                throw new Exception("Debe seleccionar una imagen.");
            }
        }

        if($id == null)
        {
        	  $sql = "INSERT INTO clasificaciones(clasificacion, ruta_imagen_clasificacion) VALUES(?, ?)";
            $params = array($nombre, $imagen);
        }
        else
        {
            $sql = "UPDATE clasificaciones SET clasificacion = ?, ruta_imagen_clasificacion = ?  WHERE id_clasificacion= ?";
            $params = array($nombre,$imagen, $id);
        }
        Database::executeRow($sql, $params);
        header("location: clasificacion.php");
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
?>
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='input-field col s12 m6'>
          	<i class='material-icons prefix'>add</i>
          	<input id='nombre' type='text' name='nombre' class='validate' length='50' maxlenght='50' value='<?php print($nombre); ?>' required/>
          	<label for='nombre'>Nombre</label>
        </div>
        <div class='file-field input-field col s12 m6'>
            <div class='btn'>
                <span>Imagen</span>
                <input type='file' name='imagen'>
            </div>
            <div class='file-path-wrapper'>
                <input class='file-path validate' type='text' >
            </div>
        </div>
    </div>
    <a href='categorias.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
 	  <button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
<br>
<br>

<div class="grey lighten-2">
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
    <a href='clasificacion.php' class='btn indigo'><i class='material-icons right'>note_add</i>Nuevo</a>
    </div>
</form>
<?php
if(!empty($_POST))
{
  $search = trim($_POST['buscar']);
  $sql = "SELECT * FROM clasificaciones WHERE  clasificacion LIKE ? ORDER BY clasificacion";
  $params = array("%$search%");
}
else
{
  $sql = "SELECT * FROM clasificaciones ";
  $params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{
  $tabla =  "<table class='centered striped'>
          <thead>
              <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th></th>
              </tr>
            </thead>
            <tbody>";
    foreach($data as $row)
    {
          $tabla .=   "<tr>
                  <td><img src='data:image/*;base64,$row[ruta_imagen_clasificacion]' class='materialboxed' width='100' height='100'></td>
                    <td>$row[clasificacion]</td>
                    <td>
                      <a href='clasificacion.php?id=$row[id_clasificacion]' class='btn blue'><i class='material-icons'>mode_edit</i></a>
                <a href='delete.php?id=$row[id_clasificacion]' class='btn red'><i class='material-icons'>delete</i></a>
              </td>
                </tr>";
    }
    $tabla .= "</tbody>
          </table>";
  print($tabla);
}
else
{
  print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay registros.</div>");
}
Page::footer();
?>