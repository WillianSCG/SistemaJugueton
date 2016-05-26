<?php
session_start();
class Page
{
	public static function header($title)
	{
		ini_set("date.timezone","America/El_Salvador");
		$sesion = false;
		$filename = basename($_SERVER['PHP_SELF']);
		$header = "<!DOCTYPE html>
					<html lang='es'>
					<head>
						<meta charset='utf-8'>
						<title>Dashboard - $title</title>
						<link type='text/css' rel='stylesheet' href='../css/materialize.min.css'/>
						<link type='text/css' rel='stylesheet' href='../css/icons.css'/>
						<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
					</head>
					<body>
					
					<div class='navbar-fixed'>
		    			<nav class='cyan'>
		      				<div class='nav-wrapper'>";
		      	if(isset($_SESSION['nombre_usuario']))
    			{
    				$sesion = true;
	        		$header .= "<a href='../main/' class='brand-logo'>
		        					<i class='material-icons left hide-on-med-and-down'>dashboard</i>Dashboard
		        				</a>
	        					<a href='#' data-activates='mobile' class='button-collapse'><i class='material-icons'>menu</i></a>
	        					<ul class='right hide-on-med-and-down'>
		          					<li><a href='../products/'>Productos</a></li>
		          					<li><a href='../categories/'>Categorias</a></li>
		          					<li><a href='../users/'>Usuarios</a></li>
		          					<li><a class='dropdown-button' href='#' data-activates='dropdown'><i class='material-icons left'>perm_identity</i>$_SESSION[nombre_usuario]</a></li>
		        				</ul>
		        				<ul id='dropdown' class='dropdown-content'>
									<li><a href='../users/profile.php'>Editar perfil</a></li>
									<li><a href='../main/logout.php'>Salir</a></li>
								</ul>
			        			<ul class='side-nav' id='mobile'>
	        						<li><a href='../products/'>Productos</a></li>
			          				<li><a href='../categories/'>Categorias</a></li>
			          				<li><a href='../users/'>Usuarios</a></li>
			          				<li><a class='dropdown-button' href='#' data-activates='dropdown-mobile'>$_SESSION[nombre_usuario]</a></li>
	      						</ul>
	      						<ul id='dropdown-mobile' class='dropdown-content'>
									<li><a href='../users/profile.php'>Editar perfil</a></li>
										<li><a href='../main/logout.php'>Salir</a></li>
								</ul>";
	      		}
	      		else
	      		{
	      			$header .= "<a href='../../' class='brand-logo'>
	        						<i class='material-icons'>web</i>
	    						</a>";
	      		}
		      	$header .= "</div>
		    			</nav>
	  				</div>
	  				<div class='container center-align'>";
	  	print($header);
  		if($sesion)
  		{
  			if($filename != "login.php")
  			{
  				print("<h3>$title</h3>");
  			}
  			else
  			{
  				header("location: index.php");
  			}
  		}
  		else
  		{
  			if($filename != "login.php" && $filename != "register.php")
  			{
  				print("<div class='card-panel red'><a href='../main/login.php'><h5>Debe iniciar sesión.</h5></a></div>");
		  		self::footer();
		  		exit();
  			}
  			else
  			{
  				print("<h3>$title</h3>");
  			}
  		}
	}

	public static function footer()
	{
		$footer = "</div>
					<script src='../../js/jquery-2.2.3.min.js'></script>
	    			<script src='../../js/materialize.min.js'></script>
	    			<script>
	    				$(document).ready(function() { $('.button-collapse').sideNav(); });
	    				$(document).ready(function() { $('.materialboxed').materialbox(); });
	    				$(document).ready(function() { $('select').material_select(); });
	    			</script>
					</body>
					</html>";
		print($footer);
	}

	public static function setCombo($name, $value, $query)
	{
		$data = Database::getRows($query, null);
		$combo = "<select name='$name' required>";
		if($value == null)
		{
			$combo .= "<option value='' disabled selected>Seleccione una opción</option>";
		}
		foreach($data as $row)
		{
			$combo .= "<option value='$row[0]'";
			if(isset($_POST[$name]) == $row[0] || $value == $row[0])
			{
				$combo .= " selected";
			}
			$combo .= ">$row[1]</option>";
		}	
		$combo .= "</select>
				<label style='text-transform: capitalize;'>$name</label>";
		print($combo);
	}
}
?>