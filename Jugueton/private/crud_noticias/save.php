<?php
require("../lib/page.php");
require("../../lib/database.php");
require("../../lib/validator.php");

if(empty($_GET['id'])) 
{
    $id = null;
    $titulo = null;
    $imagen_noticia = null;
    $descripcion = null;
    $fecha = null;
}
else
{
    $id = $_GET['id'];
    $sql = "SELECT * FROM noticias WHERE id_noticia = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $titulo = $data['titulo'];
    $imagen = $data['imagen_noticia'];
    $descripcion = $data['descripcion'];
    $fecha = $data['fecha_noticia'];
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    $titulo = $_POST['titulo'];
    $archivo = $_FILES['imagen'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha_noticia'];
    if($titulo == "")
    {
        $titulo = null;
    }
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
          $sql = "INSERT INTO noticias(titulo, imagen_noticia,descripcion,fecha_noticia) VALUES(?, ?,?,?)";
            $params = array($titulo,$imagen,$descripcion, $fecha);
        }
        else
        {
            $sql = "UPDATE noticias SET titulo = ?,imagen_noticia=?, descripcion = ?, fecha_noticia = ? WHERE id_noticia = ?";
            $params = array( $titulo,$imagen,$descripcion, $fecha, $id);
        }
        Database::executeRow($sql, $params);
        header("location: index.php");
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
Page::header("Modificar noticia");
Page::main();
?>
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>add</i>
            <input id='nombre' type='text' name='titulo' class='validate' length='50' maxlenght='50' value='<?php print($titulo); ?>' required/>
            <label for='nombre'>Titulo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
          	<input id='descripcion' type='date' name='fecha_noticia' class='validate' length='200' maxlenght='200' value='<?php print($fecha_noticia); ?>'/>
          	
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='descripcion' type='text' name='descripcion' class='validate' length='200' maxlenght='200' value='<?php print($descripcion); ?>'/>
            <label for='nombre'>Descripcion</label>
        </div>
    
      <div class='row'>
        <div class='file-field input-field col s12 m6'>
              <div class='btn'>
                    <span>Imagen</span>
                    <input type='file' name='imagen'>
              </div>
                <div class='file-path-wrapper'>
                  <input class='file-path validate' type='text' placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
                </div>
        </div>
        </div>

    <a href='index.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
 	<button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
<?php
Page::footer();
?>