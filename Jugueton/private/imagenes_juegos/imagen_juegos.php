<?php
require("../lib/page.php");
require("../../lib/database.php");
require("../../lib/validator.php");

if(empty($_GET['id'])) 
{
    Page::header("Agregar imagen");
    $id = null;
    $nombre=null;
    $imagen = null;
    $tipo=null;
}
else
{
    Page::header("Modificar imagen");
    $id = $_GET['id'];
    $sql = "SELECT * FROM imagenes_juegos WHERE id_imagene_juego = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $imagen = $data['ruta_imagene_juego'];
    $tipo=$data['id_juego'];
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    $archivo = $_FILES['imagen'];
    $tipo = $_POST['Tipo'];

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
        	  $sql = "INSERT INTO imagenes_juegos(id_juego, ruta_imagene_juego,es_primario) VALUES(?, ?,?)";
            $params = array($tipo, $imagen,true);
        }
        else
        {
            $sql = "UPDATE imagenes_juegos SET id_juego = ?, ruta_imagene_juego = ?,es_primario=?  WHERE id_imagene_juego= ?";
            $params = array($tipo,$imagen,true, $id);
        }
        Database::executeRow($sql, $params);
        header("location: imagen_juegos.php");
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
?>
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='file-field input-field col s12 m6'>
            <div class='btn'>
                <span>Imagen</span>
                <input type='file' name='imagen'>
            </div>
            <div class='file-path-wrapper'>
                <input class='file-path validate' type='text' >
            </div>
        </div>
           <div class="input-field col s12 m5 l5">
            <?php
            $sql = "SELECT id_juego,nombre_juego FROM juegos";
            Page::setCombo("Tipo", $tipo, $sql);
            ?>
            </div>
    </div>
    <a href='categorias.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
 	  <button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
<br>
<br>

<?php
  $sql = "SELECT id_imagene_juego,nombre_juego,ruta_imagene_juego FROM imagenes_juegos,juegos WHERE imagenes_juegos.id_juego=juegos.id_juego ";
  $params = null;
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
                  <td><img src='data:image/*;base64,$row[ruta_imagene_juego]' class='materialboxed' width='100' height='100'></td>
                    <td>$row[nombre_juego]</td>
                    <td>
                      <a href='imagen_juegos.php?id=$row[id_imagene_juego]' class='btn blue'><i class='material-icons'>mode_edit</i></a>
                <a href='delete.php?id=$row[id_imagene_juego]' class='btn red'><i class='material-icons'>delete</i></a>
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