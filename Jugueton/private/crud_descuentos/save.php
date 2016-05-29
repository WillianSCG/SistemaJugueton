<?php
require("../lib/page.php");
require("../../lib/database.php");
require("../../lib/validator.php");

if(empty($_GET['id'])) 
{
    Page::header("Descuentos");
    $id = null;
    $porcentaje = null;
    $codigo =  null;
    $estado = 1;
}
else
{
    Page::header("Modificar descuentos");
    $id = $_GET['id'];
    $sql = "SELECT * FROM descuentos WHERE id_descuento_porcentual= ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $porcentaje = $data['porcentaje'];
    $codigo = $data['codigo_identificador'];
    $estado = $data['usado_cupon'];
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$porcentaje = $_POST['porcentaje'];
    $codigo = $_POST['codigo_identificador'];
    $estado = $_POST['usado_cupon'];
    if($porcentaje == "")
    {
        $porcentaje = null;
    }

    try 
    {
      	
        if($id == null)
        {
        	$sql = "INSERT INTO descuentos(porcentaje, codigo_identificador, usado_cupon) VALUES(?, ?,?)";
            $params = array($porcentaje, $codigo, $estado);
        }
        else
        {
            $sql = "UPDATE descuentos SET porcentaje = ?, codigo_identificador = ?, usado_cupon = ? WHERE id_descuento_porcentual = ?";
            $params = array( $porcentaje, $codigo,$estado, $id);
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
          	<i class='material-icons prefix'>%</i>
          	<input id='icon_porcentaje' type='number' name='porcentaje' class='validate'  max="100" min="0" step="any" value='<?php print($porcentaje); ?>' required/>
          
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>location_searching</i>
            <input id='descripcion' type='number' name='codigo_identificador' class='validate' max="16" value='<?php print($codigo); ?>'/>
            
        </div>
        </div>

        <div class="row">
        <div class='input-field col s12 m6'>
            <label>Estado:</label>
              <input id='activo' type='radio' name='usado_cupon' class='with-gap' value='1' <?php print(($estado == 1)?"checked":""); ?>/>
                    <label for="activo">Habilitado</label><i class='material-icons'>visibility</i></label>
            <input id='inactivo' type='radio' name='usado_cupon' class='with-gap' value='0' <?php print(($estado == 0)?"checked":""); ?>/>
            <label for="inactivo">Inhabilitado</label><i class='material-icons'>visibility_off</i></label>
        </div>
        </div>

    <a href='index.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
 	<button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
<?php
Page::footer();
?>