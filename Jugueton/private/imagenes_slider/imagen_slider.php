<?php
require("../lib/page.php");
require("../../lib/database.php");
require("../../lib/validator.php");

if(empty($_GET['id'])) 
{
    Page::header("Agregar slider");
    $id = null;
    $imagen = null;
    $id_padre=null;
}
else
{
    Page::header("Modificar slider");
    $id = $_GET['id'];
    $sql = "SELECT * FROM imagenes_slider WHERE id_imagen_slider = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $imagen = $data['ruta'];
    $id_padre=$data['slider_padre'];
}
if(isset($_POST['btnAgregar']))
{
if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    $archivo = $_FILES['imagen'];
    $id_padre = $_POST['id_padre'];

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
        	  $sql = "INSERT INTO imagenes_slider(ruta, esta_activo,slider_padre) VALUES(?, ?,?)";
            $params = array($imagen,true,$id_padre);
        }
        else
        {
            $sql = "UPDATE imagenes_juegos SET ruta = ?, esta_activo = ?,slider_padre=?  WHERE id_imagen_slider= ?";
            $params = array($imagen,true,$id_padre, $id);
        }
        Database::executeRow($sql, $params);
        header("location: imagen_slider.php");
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
              <div class="input-field col s6"><!--Caja de texto validada para la contra -->
          <i class="material-icons prefix">add_circle</i>
          <input id="icon_prefix" type="text" class="validate" name='id_padre' value='<?php print($id_padre); ?>' required/>
          <label for="icon_prefix">Id</label>
              </div>
    </div>
    <a href='imagen_slider.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
 	  <button type='submit' class='btn blue' name="btnAgregar"><i class='material-icons right'>save</i>Guardar</button>
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
      <button type='submit' class='btn grey left' name="btnBuscar"><i class='material-icons right'>pageview</i>Aceptar</button>  
    </div>
    <div class='input-field col s12 m4'>
    <a href='categorias.php' class='btn indigo'><i class='material-icons right'>note_add</i>Nuevo</a>
    </div>
</form>
<?php

if(!empty($_POST))
{
  $search = trim($_POST['buscar']);
  $sql ="SELECT * FROM imagenes_slider  WHERE id_imagen_slider LIKE ?";
$params = array("%$search%");
}
else{
  $sql = "SELECT * FROM imagenes_slider ";
  $params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{
  $tabla =  "<table class='centered striped'>
          <thead>
              <tr>
              <th>Id</th>
                <th>Imagen</th>
                <th>Estado</th>
                <th></th>
              </tr>
            </thead>
            <tbody>";
    foreach($data as $row)
    {
          $tabla .=   "<tr>
          <td>$row[id_imagen_slider]</td>
                  <td><img src='data:image/*;base64,$row[ruta]' class='materialboxed' width='100' height='100'></td>
                  <td>";
                    if($row['esta_activo']==true)
                    {
                       $tabla .= "<i class='material-icons'>visibility</i>Activo";
                    }
                    if($row['esta_activo']==false)
                    {
                      $tabla .= "<i class='material-icons'>visibility_off</i>Inactivo";
                     }
                     $tabla .="</td>";
                      $tabla.="<td>
                      <a href='imagen_juegos.php?id=$row[id_imagen_slider]' class='btn blue'><i class='material-icons'>mode_edit</i></a>
                <a href='delete.php?id=$row[id_imagen_slider]' class='btn red'><i class='material-icons'>delete</i></a>
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