<?php
require("../lib/page.php");
require("../../lib/database.php");
require("../../lib/validator.php");

if(empty($_GET['id'])) 
{
    Page::header("Agregar noticia");
    $id = null;
    
    $informacion = null;
    $imagen = null;
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
    $imagen = $data['imagen_noticia'];
    $fechai = $data['fecha_inicio'];
    $fechaf = $data['fecha_fin'];
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
     
  	$informacion = $_POST['informacion'];
    $archivo = $_FILES['imagen'];
    $fechai = $_POST['fecha_inicio'];
    $fechaf = $_POST['fecha_fin'];
    if($informacion == "")
    {
        $informacion = null;
    }

    

    
	    function mthAgregar($informacion,$imagen,$fechai,$fechaf)
	    {
	    	require("../../lib/database.php");
	        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "INSERT INTO noticias(informacion,imagen_noticia,fecha_inicio,fecha_fin) values(?, ?, ?, ?)";
	        $stmt = $PDO->prepare($sql);
	        $stmt->execute(array($informacion,$imagen,$fechai,$fechaf));
	        $PDO = null;
	        header("location: index.php");
		}

        
    if($imagen['name'] == null) //Si no se ha seleccionado una imagen para el producto.
	    {
	    	//Se dispara la función para agregar un producto y se manda de parámetro el nombre de la imagen por defecto.
	    	mthAgregar($informacion,"123.jpg",$fechai,$fechaf);
	    }
	    else //Si el usuario ha seleccionado una imagen para el producto.
	    {
	    	$error = "";
	    	if($imagen['type'] == "image/jpeg" || $imagen['type'] == "image/png" || $imagen['type'] == "image/x-icon" || $imagen['type'] == "image/gif")
	        {
	        	$info_imagen = getimagesize($imagen['tmp_name']);
	        	$ancho_imagen = $info_imagen[0]; 
				$alto_imagen = $info_imagen[1];
				if ($ancho_imagen == 172 && $alto_imagen == 180)
				{
					$nuevo_id = uniqid(); //Esto sirve para darle un nombre único a cada archivo de imagen.
			        $nombre_archivo = $imagen['tmp_name'];
			        $imagen_producto = $nuevo_id.".png";
			        $destino = "../img/$imagen_producto";
			        move_uploaded_file($nombre_archivo, $destino); //Función para subir archivos al servidor.
			        //Se dispara la función para agregar un producto y se manda de parámetro el nombre de la imagen.
					mthAgregar($informacion,$imagen,$fechai,$fechaf);
				}
				else
				{
					$error = "La dimensión de la imagen no es apropiada.";
				}
	    	}
	    	else
	    	{
	    		$error = "El formato de la imagen no es válido.";
	    	}
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