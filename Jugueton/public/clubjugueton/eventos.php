<?php 

function Mes($numero)
{
	$Numero = 0 + $numero;
	switch ($Numero) {
		case '1':
			return 'Ene';
		case '2':
			return 'Feb';
		case '3':
			return 'Mar';
		case '4':
			return 'Abr';
		case '5':
			return 'May';
		case '6':
			return 'Jun';
		case '7':
			return 'Jul';
		case '8':
			return 'Ago';
		case '9':
			return 'Sept';
		case '10':
			return 'Oct';
		case '11':
			return 'Nov';
		case '12':
			return 'Dic';
	}
}

 ?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Club Jugueton</title>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">
<link href="css/eventos.css" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="css/morris.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>
<!-- Bootstrap Core CSS -->
</head>
<body>


	<?php include  'nav.php' ?>

		<div class="container">
		<div id="page-wrapper">
		<div class="row">

	<?php 
		require("../../lib/database.php");
		$sql = "SELECT * FROM eventos";
		$data = Database::getRows($sql, null);
		if($data != null)
		{
			$clubjugueton = "";
			foreach ($data as $row) 
		{		
/*$fecha_inicio = strptime($row['fecha_inicio'], 'o-M-j');
$dia = date('j', $fecha_inicio);
$mes = date('M', $fecha_inicio);
$año = date('o', $fecha_inicio);*/


$fecha = explode("-",$row['fecha_inicio']);
			$clubjugueton .= 	"<div class=' col-xs-12 col-sm-offset-2 col-sm-8 '>

			<ul class='event-list'>
		<li>
			<time datetime='2014-07-20'>
				<span class='day'>$fecha[2]</span>
				<span class='month'>".Mes($fecha[1])."</span>
				
			</time>
			<img src='data:image/*;base64,$row[imagen_evento]' class='img-responsive'>
			<div class='info'>
				<h2 class='title'>$row[descripcion]</h2>
				<p class='desc'>Fecha fin $row[fecha_fin]</p>
			</div>

		</li>
		</ul>
		</div>";
}
print($clubjugueton);
}
	?>
			</div>
		</div>
	</div>
</body>
</html>