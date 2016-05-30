<?php
require("../lib/page.php");
require("../../lib/database.php");
require("../../lib/validator.php");

if(empty($_GET['id'])) 
{
    $id = null;
    $imagen = null;
    $descripcion = null;
    $fechai =  null;
    $fechaf = null;
    $estado = 'false';
}
else
{
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM eventos WHERE id_evento= ?";
    $params = array($id);
    $data = Database::getRow($sql, $params);
    $imagen = $data['imagen_evento'];
    $descripcion = $data['descripcion'];
    $fechai = $data['fecha_inicio'];
    $fechaf = $data['fecha_fin'];
    $estado = $data['esta_activo'];
}

if(!empty($_POST))
{
    $_POST = Validator::validateForm($_POST);
    $archivo = $_FILES['imagen'];
    $descripcion = $_POST['descripcion'];
    $fechai = $_POST['fecha_inicio'];
    $fechaf = $_POST['fecha_fin'];
    $estado = isset($_POST['estado']) ?
	    'true' :
	    'false' ;
    if($descripcion == "")
    {
        $descripcion = null;
    }
try 
    {

      if($archivo['name'] != null)
        {
            $base64 = Validator::validateImage($archivo);
            if($base64 != false)
            {
                $imagen = $base64;
            }
            else
            {
                throw new Exception("La imagen seleccionada no es valida.");
            }
        }
        else
        {
            if($imagen == null)
            {
                throw new Exception("Debe seleccionar una imagen.");
            }
        }
        
        if($id == null)
        {
			$sql = "INSERT INTO eventos(imagen_evento,descripcion,fecha_inicio,fecha_fin,esta_activo) VALUES(?,?,?,?,?);";
			$params = array($imagen,$descripcion, $fechai, $fechaf, $estado);
        }
        else
        {
            $sql = "UPDATE eventos SET imagen_evento=?, descripcion = ?, fecha_inicio = ?, fecha_fin = ?, esta_activo = ? WHERE id_evento = ?";
            $params = array($imagen,$descripcion, $fechai, $fechaf, $estado,$id);
        }
       
        Database::executeRow($sql, $params);
        header("location: index.php");
    }
    catch (Exception $error)
    {
        print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
    }
}
Page::header("Modificar evento");
Page::main();
?>
<form method='post' class='row' enctype='multipart/form-data'>
	<div class='row'>
		<div class='input-field col s12 m6'>
			<i class='material-icons prefix'>add</i>
			<input id='nombre' type='text' name='descripcion' class='validate' length='50' maxlenght='50' value='<?php print($descripcion); ?>' required/>
			<label for='nombre'>Titulo</label>
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
			<div class='file-field input-field col s12 m6'>
				<p>
					<input type="checkbox" name="estado" id="check_estado" />
					<label for="check_estado">Habilitar</label>
				</p>
			</div>
		</div>
	</div>
    <a href='index.php' class='btn grey'><i class='material-icons right'>cancel</i>Cancelar</a>
 	<button type='submit' class='btn blue'><i class='material-icons right'>save</i>Guardar</button>
</form>
<?php
Page::footer();
?>