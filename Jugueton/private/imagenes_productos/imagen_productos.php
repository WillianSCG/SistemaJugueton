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
    $sql = "SELECT * FROM imagenes_productos WHERE id_imagene_producto = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $imagen = $data['ruta_imagene_producto'];
    $tipo=$data['id_producto'];
}
if(isset($_POST['btnAgregar']))
{
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
        	  $sql = "INSERT INTO imagenes_productos(id_producto, ruta_imagene_producto) VALUES(?,?)";
            $params = array($tipo, $imagen);
        }
        else
        {
            $sql = "UPDATE imagenes_productos  SET id_producto = ?, ruta_imagene_producto = ?  WHERE id_imagene_producto= ?";
            $params = array($tipo,$imagen, $id);
        }
        Database::executeRow($sql, $params);
        header("location: imagen_productos.php");
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
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
            $sql = "SELECT id_producto,nombre_producto FROM productos";
            Page::setCombo("Tipo", $tipo, $sql);
            ?>
            </div>
    </div>
    <a href='categorias.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
 	  <button type='submit' class='btn blue' name="btnAgregar"><i class='material-icons right'>save</i>Guardar</button>
</form>
<br>
<br>
    <div class="z-depth-1  grey lighten-2">
    <div class="row">
      <form method='post' class='row'>
  <div class='input-field col s6 m4'>
        <i class='material-icons prefix'>search</i>
        <input id='buscar' type='text' name='buscar' class='validate'/>
        <label for='buscar'>Búsqueda</label>
    </div>
    <div class='input-field col s4'>
      <button type='submit' class='btn green left' name='btnBuscar'><i class='material-icons right'>pageview</i>Aceptar</button>  
    </div>
    <div class='input-field col s4'>
    <a href='actumenu.php' class='btn red'><i class='material-icons right'>cancel</i>Cancelar</a>
    </div>
</form>
<?php
if(isset($_POST['btnBuscar']))
{
  if(!empty($_POST))
{
   $search = trim($_POST['buscar']);
   $sql = "SELECT id_imagene_producto,nombre_producto,ruta_imagene_producto FROM imagenes_productos,productos WHERE imagenes_productos.id_producto=productos.id_producto  AND productos.nombre_producto LIKE ?" ;
 $params = array("%$search%");
}
else
{  
  $sql = "SELECT id_imagene_producto,nombre_producto,ruta_imagene_producto FROM imagenes_productos,productos WHERE imagenes_productos.id_producto=productos.id_producto ";
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
                  <td><img src='data:image/*;base64,$row[ruta_imagene_producto]' class='materialboxed' width='100' height='100'></td>
                    <td>$row[nombre_producto]</td>
                    <td>
                      <a href='imagen_productos.php?id=$row[id_imagene_producto]' class='btn blue'><i class='material-icons'>mode_edit</i></a>
                <a href='delete.php?id=$row[id_imagene_producto]' class='btn red'><i class='material-icons'>delete</i></a>
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
}
Page::footer();
?>