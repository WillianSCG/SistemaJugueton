<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    
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

    <div id="wrappe">

     <?php include  'nav.php' ?>
<br>
<br>
        <div class="container-fluid" id="cuerpo"> 

  <!-- comienza slider-->
  
<br>
 <div class="container">
        <!-- Filter Controls - Simple Mode -->
        <div class="row">
            <!-- A basic setup of simple mode filter controls, all you have to do is use data-filter="all"
            for an unfiltered gallery and then the values of your categories to filter between them -->
            <ul class="simplefilter">
                Categorias:
                <li class="active" data-filter="all">All</li>
                <li data-filter="1">Acción <i class="fa fa-puzzle-piece"></i></li>
                <li data-filter="2">Aventura <i class="fa fa-rocket"></i></li>
                <li data-filter="3">Arcade</li>
                <li data-filter="4">Deportes</li>
                <li data-filter="5">Puzzle</li>
            </ul>
        </div>

        <!-- Search control -->
        <div class="row search-row">
            Búsqueda:
            <input type="text" class="filtr-search" name="filtr-search" data-search>
        </div>

        <div class="row">
            <!-- This is the set up of a basic gallery, your items must have the categories they belong to in a data-category
            attribute, which starts from the value 1 and goes up from there -->
            <div class="filtr-container">
                <div class="col-xs-8 col-sm-6 col-md-4 filtr-item" data-category="1, 5" data-sort="Busy streets">
                    <img class="img-responsive" src="img/city_1.jpg" alt="sample image">
                    <span class="item-desc">Busy Streets</span>
                </div>
                <div class="col-xs-8 col-sm-6 col-md-4 filtr-item" data-category="2, 5" data-sort="Luminous night">
                    <img class="img-responsive" src="img/nature_2.jpg" alt="sample image">
                    <span class="item-desc">Luminous night</span>
                </div>
                <div class="col-xs-8 col-sm-6 col-md-4 filtr-item" data-category="1, 4" data-sort="City wonders">
                    <img class="img-responsive" src="img/city_3.jpg" alt="sample image">
                    <span class="item-desc">city wonders</span>
                </div>
                <div class="col-xs-8 col-sm-6 col-md-4 filtr-item" data-category="3" data-sort="In production">
                    <img class="img-responsive" src="img/industrial_1.jpg" alt="sample image">
                    <span class="item-desc">in production</span>
                </div>
                <div class="col-xs-8 col-sm-6 col-md-4 filtr-item" data-category="3, 4" data-sort="Industrial site">
                    <img class="img-responsive" src="img/industrial_2.jpg" alt="sample image">
                    <span class="item-desc">industrial site</span>
                </div>
                <div class="col-xs-8 col-sm-6 col-md-4 filtr-item" data-category="2, 4" data-sort="Peaceful lake">
                    <img class="img-responsive" src="img/nature_1.jpg" alt="sample image">
                    <span class="item-desc">peaceful lake</span>
                </div>
                <div class="col-xs-8 col-sm-6 col-md-4 filtr-item" data-category="1, 5" data-sort="City lights">
                    <img class="img-responsive" src="img/city_2.jpg" alt="sample image">
                    <span class="item-desc">city lights</span>
                </div>
                <div class="col-xs-8 col-sm-6 col-md-4 filtr-item" data-category="2, 4" data-sort="Dreamhouse">
                    <img class="img-responsive" src="img/nature_3.jpg" alt="sample image">
                    <span class="item-desc">dreamhouse</span>
                </div>
                <div class="col-xs-8 col-sm-6 col-md-4 filtr-item" data-category="3" data-sort="Restless machines">
                    <img class="img-responsive" src="img/industrial_3.jpg" alt="sample image">
                    <span class="item-desc">restless machines</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery & Filterizr -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="filterizr/jquery.filterizr.js"></script>
    <script src="js/controls.js"></script>

    <!-- Kick off Filterizr -->
    <script type="text/javascript">
        $(function() {
            //Initialize filterizr with default options
            $('.filtr-container').filterizr();
        });
    </script>
  
    
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