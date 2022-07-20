<?php require_once 'admsesion.php'?>
<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Catálogo";
$opcion="Requisitos";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	  
	   <title>Asesoramiento - administrador</title>
       
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<script src="js/jquery.min.js"></script>
		 <!-- Custom Theme files -->
		<link href="css/style.css" rel='stylesheet' type='text/css' />
        <link href="grafico.css" rel="stylesheet" type="text/css" />
   		 <!-- Custom Theme files -->
		 <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
   		 <!-- webfonts -->
   		 <link href='http://fonts.googleapis.com/css?family=Raleway:200,400,300,600,500,900,700,100,800|Comfortaa:700' rel='stylesheet' type='text/css'>
   		 <link href='http://fonts.googleapis.com/css?family=Comfortaa:700,300,400' rel='stylesheet' type='text/css'>
   		  <!-- webfonts -->
	</head>
	<body>
     	<!-- container -->
		<div id="cabecera"><?php require_once ("cabecera.php");?></div>
					<!-- Products -->
					<div class="products">
						<div class="container">
							<div class="col-md-9 products-left">
								<div class="error-page">
									<?php require_once 'menu.php';?>
                                    
                                    <h1>Super-Administrador:<?php echo $_SESSION["usuario"] ?></h1>
                                    <div>Bienvenido al Administardor del sistema de trámites </div>
                                </div>
							</div>
                            <div class="col-md-3 products-right">
						            
							<div class="clearfix"> </div>
						    </div>
					   </div>
					
				</div>	
		
		<!-- /container -->
	</body>
   
</html>

