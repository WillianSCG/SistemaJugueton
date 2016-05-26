<?php
require("../../lib/database.php");
$sql = "SELECT * FROM usuarios";
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
  	$alias = $_POST['alias'];
  	$clave = $_POST['clave'];
  	try
    {
      	if($alias != "" && $clave != "")
  		{
  			$sql = "SELECT * FROM usuarios WHERE alias = ?";
		    $param = array($alias);
		    $data = Database::getRow($sql, $param);
		    if($data != null)
		    {
		    	$hash = $data['clave'];
		    	if(password_verify($clave, $hash)) 
		    	{
			    	session_start();
			    	$_SESSION['id_usuario'] = $data['id_usuario'];
			      	$_SESSION['nombre_usuario'] = $data['nombres']." ".$data['apellidos'];
			      	header("location: index.php");
				}
				else 
				{
					throw new Exception("La clave ingresada es incorrecta.");
				}
		    }
		    else
		    {
		    	throw new Exception("El alias ingresado no existe.");
		    }
	  	}
	  	else
	  	{
	    	throw new Exception("Debe ingresar un alias y una clave.");
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
			<input id='alias' type='text' name='alias' class='validate' required/>
	    	<label for='alias'>Usuario</label>
		</div>
		<div class='input-field col m6 offset-m3 s12'>
			<i class='material-icons prefix'>vpn_key</i>
			<input id='clave' type='password' name='clave' class="validate" required/>
			<label for='clave'>Contraseña</label>
		</div>
	</div>
	<button type='submit' class='btn blue'><i class='material-icons right'>verified_user</i>Aceptar</button>
</form>
<?php
Page::footer();
?>