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

    <!-- Morris Charts CSS -->
    <link href="css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div id="wrapper">
         <?php include  'nav.php' ?>
<br>
<br>
        <div class="container-fluid" id="cuerpo"> 

  <!-- comienza slider-->
  <section id="mislider" class="carousel slide">
    <ol class="carousel-indicators">
     <li data-target="#mislider" data-slide-to="0" class="active"></li>
     <li data-target="#mislider" data-slide-to="1"></li>
     <li data-target="#mislider" data-slide-to="2"></li>
     <li data-target="#mislider" data-slide-to="3"></li>
     
   </ol>
   <div class="carousel-inner">
    <div class="item active">
      <img src="img/banner1.jpg" class="adaptar">
    </div>
    <div class="item">
      <img src="img/banner4.jpg" class="adaptar">
    </div>
      <div class="item">
     <img src="img/banner6.jpg" class="adaptar">
   </div>
   <div class="item">
     <img src="img/banner5.jpg" class="adaptar">
   </div>
 </div>
 <a href="#mislider" class="left carousel-control" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
 <a href="#mislider" class="right carousel-control" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</section>
<br>
<br>
<div class="row">

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="img/noticia1.png" alt="...">
      <div class="caption">
        <h3>Thumbnail label</h3>
        <p>...</p>
        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="img/noticia2.jpg" alt="...">
      <div class="caption">
        <h3>Thumbnail label</h3>
        <p>...</p>
        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="img/noticia3.jpg" alt="...">
      <div class="caption">
        <h3>Thumbnail label</h3>
        <p>...</p>
        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
      </div>
    </div>
  </div>
  <nav>
  <ul class="pager">
    <li><a href="#">Previous</a></li>
    <li><a href="noticias.php">Next</a></li>
  </ul>
</nav>
</div>
</div>
</div>


    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
  $('.carousel').carousel({
        interval: 5000 //changes the speed
      });
</script>
    <script src="js/raphael.min.js"></script>
    <script src="js/morris.min.js"></script>
    <script src="js/morris-data.js"></script>





</body>
</html>