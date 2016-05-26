<?php
require("../../lib/database.php");
$sql = "SELECT * FROM usuarios";
$data = Database::getRows($sql, null);
if($data != null)
{
    header("location: login.php");
}

require("../lib/page.php");
require("../../lib/validator.php");
Page::header("Registrar usuario");

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$nombres = $_POST['nombres'];
  	$apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $alias = $_POST['alias'];
    if($correo == "")
    {
        $correo = null;
    }

    try 
    {
      	if($nombres != "" && $apellidos != "")
        {
            $clave1 = $_POST['clave1'];
            $clave2 = $_POST['clave2'];
            if($alias != "" && $clave1 != "" && $clave2 != "")
            {
                if($clave1 == $clave2)
                {
                    $clave = password_hash($clave1, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO usuarios(nombres, apellidos, correo, alias, clave) VALUES(?, ?, ?, ?, ?)";
                    $param = array($nombres, $apellidos, $correo, $alias, $clave);
                    Database::executeRow($sql, $param);
                    header("location: login.php");
                }
                else
                {
                    throw new Exception("Las claves ingresadas no coinciden.");
                }
            }
            else
            {
                throw new Exception("Debe ingresar todos los datos de autenticación.");
            }
        }
        else
        {
            throw new Exception("Debe ingresar el nombre completo.");
        }
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
else
{
    $nombres = null;
    $apellidos = null;
    $correo = null;
    $alias = null;
}
?>
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='input-field col s12 m6'>
          	<i class='material-icons prefix'>assignment_ind</i>
          	<input id='nombres' type='text' name='nombres' class='validate' length='50' maxlenght='50' value='<?php print($nombres); ?>' required/>
          	<label for='nombres'>Nombres</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>assignment_ind</i>
            <input id='apellidos' type='text' name='apellidos' class='validate' length='50' maxlenght='50' value='<?php print($apellidos); ?>' required/>
            <label for='apellidos'>Apellidos</label>
        </div>
    </div>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>email</i>
            <input id='correo' type='email' name='correo' class='validate' length='100' maxlenght='100' value='<?php print($correo); ?>'/>
            <label for='correo'>Correo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>perm_identity</i>
            <input id='alias' type='text' name='alias' class='validate' length='50' maxlenght='50' value='<?php print($alias); ?>' required/>
            <label for='alias'>Alias</label>
        </div>
    </div>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>lock</i>
            <input id='clave1' type='password' name='clave1' class='validate' length='25' maxlenght='25' required/>
            <label for='clave1'>Clave</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>lock</i>
            <input id='clave2' type='password' name='clave2' class='validate' length='25' maxlenght='25' required/>
            <label for='clave2'>Confirmar clave</label>
        </div>
    </div>
 	<button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
<?php
Page::footer();
?>