<?php
require("../lib/page.php");
require("../../lib/database.php");
require("../../lib/validator.php");

if(empty($_GET['id'])) 
{
    Page::header("Agregar noticia");
    $id = null;
    $informacion = null;
    $fechai =  null;
    $fechaf = null;
}
else
{
    Page::header("Modificar noticia");
    $id = $_GET['id'];
    $sql = "SELECT * FROM noticias WHERE id_noticia = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $informacion = $data['informacion'];
    $fechai = $data['fecha_inicio'];
    $fechaf = $data['fecha_fin'];
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$informacion = $_POST['informacion'];
    $fechai = $_POST['fecha_inicio'];
    $fechaf = $_POST['fecha_fin'];
    if($informacion == "")
    {
        $informacion = null;
    }

    try 
    {
      	
        if($id == null)
        {
        	$sql = "INSERT INTO noticias(informacion, fecha_inicio, fecha_fin) VALUES(?, ?,?)";
            $params = array($informacion, $fechai, $fechaf);
        }
        else
        {
            $sql = "UPDATE noticias SET informacion = ?, fecha_inicio = ?, fecha_fin = ? WHERE id_noticia = ?";
            $params = array( $informacion, $fechai, $fechaf, $id);
        }
        Database::executeRow($sql, $params);
        header("location: index.php");
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
          	<input id='nombre' type='text' name='informacion' class='validate' length='50' maxlenght='50' value='<?php print($informacion); ?>' required/>
          	<label for='nombre'>Nombre</label>
        </div>
        <div class='input-field col s12 m6'>
          	<i class='material-icons prefix'>description</i>
          	<input id='descripcion' type='date' name='fecha_inicio' class='validate' length='200' maxlenght='200' value='<?php print($fechai); ?>'/>
          	
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='descripcion' type='date' name='fecha_fin' class='validate' length='200' maxlenght='200' value='<?php print($fechaf); ?>'/>
            
        </div>
    </div>
    <a href='index.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
 	<button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
<?php
Page::footer();
?>