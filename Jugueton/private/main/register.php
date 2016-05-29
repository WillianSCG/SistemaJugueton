<?php
require("../../lib/database.php");
$sql = "SELECT * FROM empleados";
$data = Database::getRows($sql, null);
if($data != null)
{
    header("location: login.php");
}

require("../lib/page.php");
require("../../lib/validator.php");
Page::header("Registrar empleado");

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
  	$nombres = $_POST['nombres_empleado'];
  	$apellidos = $_POST['apellidos_empleado'];
    $correo = $_POST['correo_empleado'];
    $alias = $_POST['usuario_empleado'];
    $sucursal = $_POST['sucursal'];
    if($correo == "")
    {
        $correo = null;
    }

    try 
    {
      	if($nombres != "" && $apellidos != "")
        {
            $clave1 = $_POST['contra_empleado1'];
            $clave2 = $_POST['contra_empleado2'];
            if($alias != "" && $clave1 != "" && $clave2 != "")
            {
                if($clave1 == $clave2)
                {
                    $clave = password_hash($clave1, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO empleados(nombres_empleado, apellidos_empleado, correo_empleado, usuario_empleado, contra_empleado, id_sucursal) VALUES(?, ?, ?, ?, ?,?)";
                    $param = array($nombres, $apellidos, $correo, $alias, $clave);
                    Database::executeRow($sql, $param);
                    header("location: login.php");
                }
                else
                {
                    throw new Exception("Las contraseñas ingresadas no coinciden.");
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
    $sucursal = null;
}
?>
<form method='post' class='row' enctype='multipart/form-data'>
    <div class='row'>
        <div class='input-field col s12 m6'>
          	<i class='material-icons prefix'>assignment_ind</i>
          	<input id='nombres' type='text' name='nombres_empleado' class='validate' length='50' maxlenght='50' value='<?php print($nombres); ?>' required/>
          	<label for='nombres'>Nombres</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>assignment_ind</i>
            <input id='apellidos' type='text' name='apellidos_empleado' class='validate' length='50' maxlenght='50' value='<?php print($apellidos); ?>' required/>
            <label for='apellidos'>Apellidos</label>
        </div>
    </div>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>email</i>
            <input id='correo' type='email' name='correo_empleado' class='validate' length='100' maxlenght='100' value='<?php print($correo); ?>'/>
            <label for='correo'>Correo</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>perm_identity</i>
            <input id='alias' type='text' name='usuario_empleado' class='validate' length='50' maxlenght='50' value='<?php print($alias); ?>' required/>
            <label for='alias'>Usuario</label>
        </div>
    </div>
    <div class='row'>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>lock</i>
            <input id='clave1' type='password' name='contra_empleado1' class='validate' length='25' maxlenght='25' required/>
            <label for='clave1'>Contraseña</label>
        </div>
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>lock</i>
            <input id='clave2' type='password' name='contra_empleado2' class='validate' length='25' maxlenght='25' required/>
            <label for='clave2'>Confirmar clave</label>
        </div>
        <div class='input-field col s12 m6'>
                <?php
                $sql = "SELECT id_sucursal, sucursal FROM sucursales";
                Page::setCombo("sucursal", $sucursal, $sql);
                ?>
    </div>
 	<button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
<?php
Page::footer();
?>