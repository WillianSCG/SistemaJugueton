<?php
require("../lib/page.php");
require("../../lib/database.php");
require("../../lib/validator.php");

if(empty($_GET['id'])) 
{
    Page::header("Nuevo Evento");
    $id = null;
    $descripcion = null;
    $fechai =  null;
    $fechaf = null;
    $estado = 1;
}
else
{
    Page::header("Modificar evento");
    $id = $_GET['id'];
    $sql = "SELECT * FROM eventos WHERE id_evento= ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $descripcion = $data['descripcion'];
    $fechai = $data['fecha_inicio'];
    $fechaf = $data['fecha_fin'];
    $estado = $data['esta_activo'];
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$descripcion = $_POST['descripcion'];
    $fechai = $_POST['fecha_inicio'];
    $fechaf = $_POST['fecha_fin'];
    $estado = $_POST['esta_activo'];
    if($descripcion == "")
    {
        $descripcion = null;
    }

    try 
    {
      	
        if($id == null)
        {
        	$sql = "INSERT INTO eventos(descripcion, fecha_inicio, fecha_fin,esta_activo) VALUES(?, ?,?,?)";
            $params = array($descripcion, $fechai, $fechaf, $estado);
        }
        else
        {
            $sql = "UPDATE eventos SET descripcion = ?, fecha_inicio = ?, fecha_fin = ?, esta_activo = ? WHERE id_evento = ?";
            $params = array( $descripcion, $fechai, $fechaf,$estado, $id);
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
          	<input id='nombre' type='text' name='descripcion' class='validate' length='50' maxlenght='50' value='<?php print($descripcion); ?>' required/>
          	<label for='nombre'>Descripcion</label>
        </div>
        <div class='input-field col s12 m6'>
          	<i class='material-icons prefix'>Fecha inicio</i>
          	<input id='descripcion' type='date' name='fecha_inicio' class='validate' length='200' maxlenght='200' value='<?php print($fechai); ?>'/>
          	
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>Fecha fin</i>
            <input id='descripcion' type='date' name='fecha_fin' class='validate' length='200' maxlenght='200' value='<?php print($fechaf); ?>'/>
            
        </div>
        <div class='input-field col s12 m6'>
            <label>Estado:</label>
              <input id='activo' type='radio' name='esta_activo' class='with-gap' value='1' <?php print(($estado == 1)?"checked":""); ?>/>
              <label for='activo'><i class='material-icons'>visibility</i></label>
            <input id='inactivo' type='radio' name='esta_activo' class='with-gap' value='0' <?php print(($estado == 0)?"checked":""); ?>/>
            <label for='inactivo'><i class='material-icons'>visibility_off</i></label>
            </div>
    </div>
    <a href='index.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
 	<button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
<?php
Page::footer();
?>