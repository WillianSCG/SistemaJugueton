<?php
require("../lib/page.php");
require("../../lib/permisos.php");

$idcuenta = isset($_GET['ident']) ? $_GET['ident'] : 0;
if ($idcuenta === 0) {
	header('../index.php')
}

Page::header("Eliminar categoría");

if(!empty($_GET['id'])) 
{
    $id = $_GET['id'];
}
else
{
    header("location: ../../index.php");
}
if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM categorias WHERE id_categoria = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    header("location: index.php");
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
	<a href='index.php?ident=$idcuenta' class='btn grey'><i class='material-icons right'>cancel</i>No</a>
</form>
<?php
Page::footer();
?>