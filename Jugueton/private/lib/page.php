<?php
session_start();
class Page
{
	public static function header($title)
	{
		ini_set("date.timezone","America/El_Salvador");
		$sesion = false;
		$filename = basename($_SERVER['PHP_SELF']);
		$header = "
<!DOCTYPE html>
<html lang='es'>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
        <title>Jugueton - $title</title>
        <!-- CORE CSS-->    
        <link type='text/css' rel='stylesheet' href='../css/materialize.min.css'  media='screen,projection' >
        <link href='../css/style.css' type='text/css' rel='stylesheet' media='screen,projection'>
        <link type='text/css' rel='stylesheet' href='../css/icons.css'>

        <!-- Favicons-->
        <link rel='icon' href='images/favicon/favicon-32x32.png' sizes='32x32'>
        <!-- Favicons-->
        <link rel='apple-touch-icon-precomposed' href='images/favicon/apple-touch-icon-152x152.png'>
        <!-- For iPhone -->
        <meta name='msapplication-TileColor' content='#00bcd4'>
        <meta name='msapplication-TileImage' content='images/favicon/mstile-144x144.png'>
        <!-- For Windows Phone -->
        <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->    
        <link href='../js/plugins/perfect-scrollbar/perfect-scrollbar.css' type='text/css' rel='stylesheet' media='screen,projection'>
        <link href='../js/plugins/jvectormap/jquery-jvectormap.css' type='text/css' rel='stylesheet' media='screen,projection'>
        <link href='../js/plugins/chartist-js/chartist.min.css' type='text/css' rel='stylesheet' media='screen,projection'>
    </head>

<body>
<!-- 
<div id='loader-wrapper'>
<div id='loader'></div>        
<div class='loader-section section-left'></div>
<div class='loader-section section-right'></div>
</div> -->

<div class='nav-wrapper'>
    <div class='navbar-fixed'>
        <nav class='cyan'>
           	 <div class='nav-wrapper'>
                <h1 class='logo-wrapper'><a href='index.html' class='brand-logo darken-1'><img src='images/materialize-logo.png' alt='Jugueton'></a> <span class='logo-text'>Materialize</span></h1>
                <ul class='right hide-on-med-and-down'>
                    <li class='search-out'>
                        <input type='text' class='search-out-text'>
                    </li>
                    <li>    
                        <a href='javascript:void(0);' class='waves-effect waves-block waves-light show-search'><i class='mdi-action-search'></i></a>                              
                    </li>
                    <li><a href='javascript:void(0);' class='waves-effect waves-block waves-light toggle-fullscreen'><i class='mdi-action-settings-overscan'></i></a>
                    </li>
                    <li><a href='javascript:void(0);' class='waves-effect waves-block waves-light'><i class='mdi-social-notifications'></i></a>
                    </li>
                    <!-- Dropdown Trigger -->                        
                    <li><a href='#' data-activates='chat-out' class='waves-effect waves-block waves-light chat-collapse'><i class='mdi-communication-chat'></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>";
print($header);
	}


	public static function main()
	{


		$main="
		 <div id='main'>
        <!-- START WRAPPER -->
        <div class='wrapper'>

            <!-- START LEFT SIDEBAR NAV-->
            <aside id='left-sidebar-nav'>
                <ul id='slide-out' class='side-nav fixed leftside-navigation'>
                    <li class='user-details cyan darken-2'>
                        <div class='row'>
                            <div class='col col s4 m4 l4'>
                                <img src='images/avatar.jpg' alt='' class='circle responsive-img valign profile-image'>
                            </div>
                            <div class='col col s8 m8 l8'>
                                <ul id='profile-dropdown' class='dropdown-content'>
                                    <li><a href='#'><i class='mdi-action-face-unlock'></i> Profile</a>
                                    </li>
                                    <li><a href='#'><i class='mdi-action-settings'></i> Settings</a>
                                    </li>
                                    <li><a href='#'><i class='mdi-communication-live-help'></i> Help</a>
                                    </li>
                                    <li class='divider'></li>
                                    <li><a href='#'><i class='mdi-action-lock-outline'></i> Lock</a>
                                    </li>
                                    <li><a href='#'><i class='mdi-hardware-keyboard-tab'></i> Logout</a>
                                    </li>
                                </ul>
                                <a class='btn-flat dropdown-button waves-effect waves-light white-text profile-btn' href='#' data-activates='profile-dropdown'>Willian Stanley<i class='mdi-navigation-arrow-drop-down right'></i></a>
                                <p class='user-roal'>Administrator</p>
                            </div>
                        </div>
                    </li>
                      
                   
                    <li class='no-padding'>
                        <ul class='collapsible collapsible-accordion'>
                            <li class='bold'><a class='collapsible-header waves-effect waves-cyan'><i class='mdi-shopping_cart'></i> Productos</a>
                                <div class='collapsible-body'>
                                    <ul>
                                        <li><a href='../crud_productos/index.php'>Mantenimiento Productos</a>
                                        </li>                                        
                                        <li><a href='../categorias/categorias.php'>Categorias</a>
                                        </li>
                                        <li><a href='../clasificaciones/clasificacion.php'>Clasificaciones</a>
                                        </li>
                                        <li><a href='../Marcas/index.php'>Marca</a>
                                       
                                    </ul>
                                </div>
                            </li>
                            <li class='bold'><a class='collapsible-header  waves-effect waves-cyan'><i class='mdi-image-palette'></i> UI Elements</a>
                                <div class='collapsible-body'>
                                    <ul>
                                        <li><a href='ui-buttons.html'>Buttons</a>
                                        </li>
                                        <li><a href='ui-badges.html'>Badges</a>
                                        </li>
                                        <li><a href='ui-cards.html'>Cards</a>
                                        </li>
                                        <li><a href='ui-collections.html'>Collections</a>
                                        </li>
                                        <li><a href='ui-accordions.html'>Accordian</a>
                                        </li>                                        
                                        <li><a href='ui-navbar.html'>Navbar</a>
                                        </li>
                                        <li><a href='ui-pagination.html'>Pagination</a>
                                        </li>
                                        <li><a href='ui-preloader.html'>Preloader</a>
                                        </li>
                                        <li><a href='ui-modals.html'>Modals</a>
                                        </li>
                                        <li><a href='ui-media.html'>Media</a>
                                        </li>
                                        <li><a href='ui-toasts.html'>Toasts</a>
                                        </li>
                                        <li><a href='ui-tooltip.html'>Tooltip</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class='bold'><a href='app-widget.html' class='waves-effect waves-cyan'><i class='mdi-device-now-widgets'></i> Widgets <span class='new badge'></span></a>
                            </li>
                            <li class='bold'><a class='collapsible-header  waves-effect waves-cyan'><i class='mdi-editor-border-all'></i> Tables</a>
                                <div class='collapsible-body'>
                                    <ul>
                                        <li><a href='table-basic.html'>Basic Tables</a>
                                        </li>
                                        <li><a href='table-data.html'>Data Tables</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class='bold'><a class='collapsible-header  waves-effect waves-cyan'><i class='mdi-editor-insert-comment'></i> Forms</a>
                                <div class='collapsible-body'>
                                    <ul>
                                        <li><a href='form-elements.html'>Form Elements</a>
                                        </li>
                                        <li><a href='form-layouts.html'>Form Layouts</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class='bold'><a class='collapsible-header  waves-effect waves-cyan'><i class='mdi-social-pages'></i> Pages</a>
                                <div class='collapsible-body'>
                                    <ul>                                        
                                        <li><a href='page-login.html'>Login</a>
                                        </li>
                                        <li><a href='page-register.html'>Register</a>
                                        </li>
                                        <li><a href='page-lock-screen.html'>Lock Screen</a>
                                        </li>
                                        <li><a href='page-invoice.html'>Invoice</a>
                                        </li>
                                        <li><a href='page-404.html'>404</a>
                                        </li>
                                        <li><a href='page-500.html'>500</a>
                                        </li>
                                        <li><a href='page-blank.html'>Blank</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class='bold'><a class='collapsible-header waves-effect waves-cyan'><i class='mdi-editor-insert-chart'></i> Charts</a>
                                <div class='collapsible-body'>
                                    <ul>
                                        <li><a href='charts-chartjs.html'>Chart JS</a>
                                        </li>
                                        <li><a href='charts-chartist.html'>Chartist</a>
                                        </li>
                                        <li><a href='charts-morris.html'>Morris Charts</a>
                                        </li>
                                        <li><a href='charts-xcharts.html'>xCharts</a>
                                        </li>
                                        <li><a href='charts-flotcharts.html'>Flot Charts</a>
                                        </li>
                                        <li><a href='charts-sparklines.html'>Sparkline Charts</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class='li-hover'><div class='divider'></div></li>
                    <li class='li-hover'><p class='ultra-small margin more-text'>MORE</p></li>
                    <li><a href='css-grid.html'><i class='mdi-image-grid-on'></i> Grid</a>
                    </li>
                    <li><a href='css-color.html'><i class='mdi-editor-format-color-fill'></i> Color</a>
                    </li>
                    <li><a href='css-helpers.html'><i class='mdi-communication-live-help'></i> Helpers</a>
                    </li>
                    <li><a href='changelogs.html'><i class='mdi-action-swap-vert-circle'></i> Changelogs</a>
                    </li>                    
                    <li class='li-hover'><div class='divider'></div></li>
                    <li class='li-hover'><p class='ultra-small margin more-text'>Daily Sales</p></li>
                    <li class='li-hover'>
                        <div class='row'>
                            <div class='col s12 m12 l12'>
                                <div class='sample-chart-wrapper'>                            
                                    <div class='ct-chart ct-golden-section' id='ct2-chart'></div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <a href='#' data-activates='slide-out' class='sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only darken-2'><i class='mdi-navigation-menu' ></i></a>
            </aside>
  
		";
		 print($main);
	}

	public static function footer()
	{
		$footer = "</div>

            
            <script src='../js/jquery-2.2.3.min.js'></script> 
           
            <script src='../js/materialize.min.js'></script>
           
            <script type='text/javascript' src='../js/plugins/perfect-scrollbar/perfect-scrollbar.min.js'></script>
               

            <!-- chartist -->
            <script type='text/javascript' src='../js/plugins/chartist-js/chartist.min.js'></script>   

            <!-- chartjs -->
            <script type='text/javascript' src='../js/plugins/chartjs/chart.min.js'></script>
            <script type='text/javascript' src='../js/plugins/chartjs/chart-script.js'></script>

            <!-- sparkline -->
            <script type='text/javascript' src='../js/plugins/sparkline/jquery.sparkline.min.js'></script>
            <script type='text/javascript' src='../js/plugins/sparkline/sparkline-script.js'></script>
            
            <!--jvectormap-->
            <script type='text/javascript' src='../js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
            <script type='text/javascript' src='../js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
            <script type='text/javascript' src='../js/plugins/jvectormap/vectormap-script.js'></script>
            
            
            <!--plugins.js - Some Specific JS codes for Plugin Settings-->
            <script type='text/javascript' src='../js/plugins.js'></script>
<script>
    $('select').material_select();

$(document).ready(function() {
    $('.carousel.carousel-slider').carousel({full_width: true});
    $('.carousel').carousel();
    $('.slider').slider({full_width: true});
    $('.parallax').parallax();
    $('.modal-trigger').leanModal();
    $('.scrollspy').scrollSpy();
    $('.button-collapse').sideNav({'edge': 'left'});
    $('.datepicker').pickadate({selectYears: 20});
    $('select').not('.disabled').material_select();
});
$(document).ready(function() {
    Materialize.updateTextFields();
});
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