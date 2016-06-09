<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Club Jugueton</title>
<link href='https://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">
<link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

<!-- Morris Charts CSS -->
<link href="css/morris.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">

</head>

<body>

	<div id="wrapper">

		<!-- Navigation -->
		<?php include  'nav.php' ?>
		<div id="all">


			<div id="content">


				<div class="">
					<br>
					<br>

					<div class="col-sm-11">
						<br>
						<br>
						<ul class="breadcrumb">

							<li><a href="index.php">Inicio</a>
							</li>
							<li><a href="noticias.php">Noticias</a>
							</li>

						</ul>
					</div>


					<div class="col-sm-11" id="blog-listing">

						<div class="box">

							<h1>Blog category name</h1>
							<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper.</p>

						</div>
						<?php
						require("../../lib/database.php");
						$sql = "SELECT * FROM noticias";
						$data = Database::getRows($sql, null);
						if($data != null)
						{
							$clubjugueton = "";
							foreach ($data as $row) 
							{
								$clubjugueton .= "<div class='post'>
								<h2>$row[titulo]</h2>
								<hr>
								<p> <a href='#'><i class='fa fa-calendar-o'></i> $row[fecha_noticia]</a>
								</p>
								<div class='image'>
									<img src='data:image/*;base64,$row[imagen_noticia]' class='img-responsive' alt='Example blog post alt'>
								</a>
							</div>
							<p class='intro'>$row[descripcion]</p>

							</p>
						</div>";
					}
					print($clubjugueton);
				}
					else{
						print("<div class='card-panel yellow'><i class='material-icons left'>warning</i>No hay productos disponibles en este momento.</div>");
					}
					?>
					<ul class="pager">
						<li class="previous"><a href="#">&larr; Older</a>
						</li>
						<li class="next disabled"><a href="#">Newer &rarr;</a>
						</li>
					</ul>



				</div>
				<!-- /.col-md-9 -->

				<!-- *** LEFT COLUMN END *** -->


				<div class="col-md-3">
                    <!-- *** BLOG MENU ***
                    _________________________________________________________ -->
                    
                </div>
                <!-- /.col-md-3 -->






            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
    </div> 
</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/raphael.min.js"></script>
<script src="js/morris.min.js"></script>
<script src="js/morris-data.js"></script>






</body>
</html>