<?php
require("../lib/page.php");
require("../../lib/database.php");
Page::header("Eliminar imagenes");

if(!empty($_GET['id'])) 
{
    $id = $_GET['id'];
}
else
{
    header("location: imagen_slider.php");
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM imagenes_slider WHERE id_imagen_slider = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    header("location: imagen_slider.php");
	} 
	catch (Exception $error) 
	{
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
	}
}
?>
<form method='post' class='row'>
	<input type='hidden' name='id' value='<?php print($id); ?>'/>
	<button type='submit' class='btn red'><i class='material-icons right'>done</i>Si</button>
	<a href='imagen_slider.php' class='btn grey'><i class='material-icons right'>cancel</i>No</a>
</form>
<?php
Page::footer();
?>