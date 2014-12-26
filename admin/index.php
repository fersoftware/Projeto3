<?php
ob_start();
date_default_timezone_set('America/Sao_Paulo');
ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);
$caminho = parse_url("HTTP://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$pagina = substr($caminho['path'],1,strlen($caminho['path'])); // tira a primeira / <-(barra)

session_start();

require_once "../conexaoDB.php";
$conn = conexaoDB();

$retorna_site = strstr($_SERVER['REQUEST_URI'],'retorna-site');

if(strlen($retorna_site) >= 1 )
{
    header("Location: " . "HTTP://".$_SERVER['HTTP_HOST'] . "/home");
}

$current_link = strstr($_SERVER['REQUEST_URI'],'admin/');
   
if(strlen($current_link) == 0 )
{
    header("Location: admin/");
}

if(!isset($_SESSION['login']) AND $_SESSION['login'] != "1")
{
   $localiza = strstr($_SERVER['REQUEST_URI'],'admin/');
   
   if(strlen($localiza) == 0 )
   {
        header("Location: admin/login.php");
   }
   else
   {
        header("Location: login.php");
   }
}


function verificaExistencia($pagina)
{   
    $pagina = str_replace('.php','',$pagina);
    $pagina = str_replace('admin/','',$pagina);
    
    if(strlen($pagina) == 0 || $pagina == 'index')
    {
        $pagina = 'principal_adm';
    }
    //Se não existir mostrara pagina nao encontrada
    if(!file_exists('includes/'.$pagina.'.php'))
    {
        $pagina = 'page_404';
    }
    return $pagina;
}
?>
<!DOCTYPE html>
<html lang="pt_br">
	<head>
		<meta charset="utf-8">
		<title>GeReNcIaDoR v1</title>
		<meta name="description" content="description">
		<meta name="author" content="Fersoftware">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="plugins/select2/select2.css" rel="stylesheet">
		<link href="plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">
		<link href="css/style_v2.css" rel="stylesheet">
		<link href="plugins/chartist/chartist.min.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
 </head>
<body>

<!--Start Header-->
<div id="screensaver">
	<canvas id="canvas"></canvas>
	<i class="fa fa-lock" id="screen_unlock"></i>
</div>
<div id="modalbox">
	<div class="devoops-modal">
		<div class="devoops-modal-header">
			<div class="modal-header-name">
				<span>Basic table</span>
			</div>
			<div class="box-icons">
				<a class="close-link">
					<i class="fa fa-times"></i>
				</a>
			</div>
		</div>
		<div class="devoops-modal-inner">
		</div>
		<div class="devoops-modal-bottom">
		</div>
	</div>
</div>
<header class="navbar">
	<div class="container-fluid expanded-panel">
		<div class="row">
			<div id="logo" class="col-xs-12 col-sm-2">
				<a href="principal_adm">GeReNcIaDoR v1</a>
			</div>
			<div id="top-panel" class="col-xs-12 col-sm-10">
				<div class="row">
					<div class="col-xs-8 col-sm-4">
						<div id="search">
						
						</div>
					</div>
					<div class="col-xs-4 col-sm-8 top-panel-right">
						<ul class="nav navbar-nav pull-right panel-menu">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle account" data-toggle="dropdown">
									<div class="avatar">
										<img src="img/avatar.jpg" class="img-circle" alt="avatar" />
									</div>
									<i class="fa fa-angle-down pull-right"></i>
									<div class="user-mini pull-right">
										<span class="welcome">Bem Vindo,</span>
										<span>Administrador</span>
									</div>
								</a>
								<ul class="dropdown-menu">									
									<li>
										<a href="logout">
											<i class="fa fa-power-off"></i>
											<span>Logout</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!--End Header-->


<!--Start Container-->
<div id="main" class="container-fluid">
	<div class="row">
		<div id="sidebar-left" class="col-xs-2 col-sm-2">
			<ul class="nav main-menu">
            
            <li class="dropdown">
					<a href="page_adm_home" class="dropdown-toggle">
						<i class="fa fa-list"></i>
						<span>Alterar Páginas</span>
					</a>					
			</li>
            
            <li class="dropdown">
					<a href="retorna-site" class="dropdown-toggle">
						<i class="fa fa-list"></i>
						<span>Acessar Site</span>
					</a>					
			</li>
            
				<li>
					<a href="logout">
						<i class="fa fa-power-off"></i>
						<span class="hidden-xs">Logout</span>
					</a>
				</li>
			</ul>
		</div>
		<!--Start Content-->
		<div id="content" class="col-xs-12 col-sm-10">
			<div id="about">
			</div>
			<div class="preloader">
				<img src="img/devoops_getdata.gif" class="devoops-getdata" alt="preloader"/>
			</div>
            <!--
<div id="ajax-content"></div>
-->
<?php
    require('includes/'.verificaExistencia($pagina).'.php');
?>
<script type="text/javascript">
// Run Select2 plugin on elements
function DemoSelect2(){
	$('#s2_with_tag').select2({placeholder: "Select OS"});
	$('#s2_country').select2();
}
// Run timepicker
function DemoTimePicker(){
	$('#input_time').timepicker({setDate: new Date()});
}
</script>        
        </div>
		<!--End Content-->
	</div>
</div>
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script src="plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
<!--
	$(document).ready(function()
{
	// Create Wysiwig editor for textare
	TinyMCEStart('#wysiwig_simple', null);
	TinyMCEStart('#wysiwig_full', 'extreme');
	// Add slider for change test input length
	FormLayoutExampleInputLength($( ".slider-style" ));
	// Initialize datepicker
	$('#input_date').datepicker({setDate: new Date()});
	// Load Timepicker plugin
	LoadTimePickerScript(DemoTimePicker);
	// Add tooltip to form-controls
	$('.form-control').tooltip();
	LoadSelect2Script(DemoSelect2);
	// Load example of form validation
	LoadBootstrapValidatorScript(DemoFormValidator);
	// Add drag-n-drop feature to boxes
	WinMove();
});
-->
</script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/justified-gallery/jquery.justifiedGallery.min.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<script src="plugins/tinymce/jquery.tinymce.min.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="js/devoops.js"></script>
</body>
</html>