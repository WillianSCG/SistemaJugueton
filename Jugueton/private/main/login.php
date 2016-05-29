<?php
require("../../lib/database.php");
$sql = "SELECT * FROM empleados";
$data = Database::getRows($sql, null);
if($data == null)
{
    header("location: register.php");
}

require("../lib/page.php");
require("../../lib/validator.php");
Page::header("Iniciar sesión");

if(!empty($_POST))
{
	$_POST = validator::validateForm($_POST);
  	$usuario_empleado = $_POST['usuario_empleado'];
  	$contra_empleado = $_POST['contra_empleado'];
  	try
    {
      	if($alias != "" && $clave != "")
  		{
  			$sql = "SELECT * FROM empleados WHERE usuario_empleado = ?";
		    $param = array($alias);
		    $data = Database::getRow($sql, $param);
		    if($data != null)
		    {
		    	$hash = $data['clave'];
		    	if(password_verify($clave, $hash)) 
		    	{
			    	session_start();
			    	$_SESSION['id_empleado'] = $data['id_empleado'];
			      	$_SESSION['nombre_usuario'] = $data['nombres_empleado']." ".$data['apellidos_empleado'];
			      	header("location: index.php");
				}
				else 
				{
					throw new Exception("La contraseña ingresada es incorrecta.");
				}
		    }
		    else
		    {
		    	throw new Exception("El usuario ingresado no existe.");
		    }
	  	}
	  	else
	  	{
	    	throw new Exception("Debe ingresar un usuario y una contraseña.");
	  	}
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
?>
<form class='row' method='post'>
	<div class='row'>
		<div class='input-field col m6 offset-m3 s12'>
			<i class='material-icons prefix'>person_pin</i>
			<input id='alias' type='text' name='usario_empleado' class='validate' required/>
	    	<label for='alias'>Usuario</label>
		</div>
		<div class='input-field col m6 offset-m3 s12'>
			<i class='material-icons prefix'>vpn_key</i>
			<input id='clave' type='password' name='contra_empleado' class="validate" required/>
			<label for='clave'>Contraseña</label>
		</div>
	</div>
	<button type='submit' class='btn blue'><i class='material-icons right'>verified_user</i>Aceptar</button>
</form>
<?php
Page::footer();
?>