<?php
require("../lib/page.php");
require("../../lib/database.php");
Page::header("Eliminar producto");

if(!empty($_GET['id'])) 
{
    $id = $_GET['id'];
}
else
{
    header("location: marca.php");
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM marcas WHERE id_marca = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    header("location: marca.php");
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
	<a href='clasificacion.php' class='btn grey'><i class='material-icons right'>cancel</i>No</a>
</form>
<?php
Page::footer();
?>