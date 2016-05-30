<?php
require("../lib/page.php");
require("../../lib/database.php");
require("../../lib/validator.php");


if(empty($_GET['id'])) 
{
    $id = null;
    $nombre = null;
    $direccion = null;
}
else
{
    $id = $_GET['id'];
    $sql = "SELECT * FROM sucursales WHERE id_sucursal = ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $nombre = $data['sucursal'];
    $direccion = $data['direccion_sucursal'];
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    if($direccion == "")
    {
        $direccion = null;
    }

    try 
    {
        if($nombre == "")
        {
            throw new Exception("Datos incompletos.");
        }

        if($id == null)
        {
            $sql = "INSERT INTO sucursales(sucursal, direccion_sucursal) VALUES(?, ?)";
            $params = array($nombre, $direccion);
        }
        else
        {
            $sql = "UPDATE sucursales SET sucursal = ?, direccion_sucursal = ? WHERE id_sucursal = ?";
            $params = array($nombre, $direccion, $id);
        }
        Database::executeRow($sql, $params);
        header("location: index.php");
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
    Page::header("Modificar Sucursal");
    Page::main();
?>
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>add</i>
            <input id='nombre' type='text' name='nombre' class='validate' length='50' maxlenght='50' value='<?php print($nombre); ?>' required/>
            <label for='nombre'>Nombre</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='direccion' type='text' name='direccion' class='validate' length='200' maxlenght='200' value='<?php print($direccion); ?>'/>
            <label for='direccion'>Direccion</label>
        </div>
    </div>
    <a href='index.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
 	<button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
<?php
Page::footer();
?>