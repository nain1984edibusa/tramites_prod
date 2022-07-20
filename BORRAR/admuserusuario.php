<?php require_once 'admsesion.php'?>
<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="PRINCIPAL";
$opcion="Inicio";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
?>


	<head>
	   
	   <title>VivePatrimonio - administrador</title>
      
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
			
									
                                   
                                    <div class="container-fluid descripcion-container">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-2 col-md-2">
                                                <img src="assets/img/bienvenida.png" alt="user" class="img-responsive center-box">
                                            </div>
                                            <div class="col-xs-12 col-sm-10 col-md-10 text-justify lead">
                                                <?php echo BIENVENIDA;?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid text-center">
                                        <a href="admseltramites.php" class="btn btn-primary"><i class="zmdi zmdi-file-plus"></i> &nbsp;Nuevo Trámite</a>
                                    </div>
                                     
                                     <section class="full-reset text-center">
                                        <article class="tile">
                                            <div class="tile-icon full-reset"><i class="zmdi zmdi-edit"></i></div>
                                            <div class="tile-name all-tittles"> <a href="admconstraelab.php"> en elaboración </a></div>
                                            <div class="tile-num full-reset">7</div>
                                        </article>
                                        <article class="tile">
                                            <div class="tile-icon full-reset"><i class="zmdi zmdi-eye"></i></div>
                                            <div class="tile-name all-tittles"> <a href="admconstraelab.php">en revisión </a> </div>
                                            <div class="tile-num full-reset">2</div>
                                        </article>
                                            <article class="tile">
                                            <div class="tile-icon full-reset"><i class="zmdi zmdi-assignment-return"></i></div>
                                            <div class="tile-name all-tittles"> <a href="admconstraelab.php">por convalidar </a></div>
                                            <div class="tile-num full-reset">1</div>
                                        </article>
                                        <article class="tile">
                                            <div class="tile-icon full-reset"><i class="zmdi zmdi-assignment-check"></i></div>
                                            <div class="tile-name all-tittles"> <a href="admconstraelab.php">contestados </a></div>
                                            <div class="tile-num full-reset">3</div>
                                        </article>
                                    </section>
                                    
                    
									
	<?php include_once("./includes/footer.php"); ?>				
					
					<!-- /footer -->
					
	
	<!-- /container -->
	</body>
    


