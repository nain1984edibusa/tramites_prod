<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-91084144-1', 'auto');
  ga('send', 'pageview');

</script>
<head>
   <?php require_once 'adm_include.php'; // incluir las clases
    $rol = new clsroles; // declaro un objeto de la clase de la pagina que gestiono
    ///   acciones sobre registros
	
	$acc = get("acc"); // recogemos la accion cero por defecto
	echo $acc;
	switch ($acc){ // evaluamos la accion
	    case 1: // ingresar a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $rol->carga_rol_nombre($_POST["txtnom"]);
			   $rol->rol_insertar(); // inserto registro
			   
		     break;
		case 2: // modificamos a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $reg = get("reg"); // recojo el registro seleccionado
			   $rol->carga_rol_codigo($reg); // cargo en la clase
			   $rol->carga_rol_nombre($_POST["txtnom"]);
			   $rol->rol_actualizar();
		     break;
		case 3: // eliminamos de la base
			   $reg = get("reg"); // recojo el registro seleccionado
			   $rol->carga_rol_codigo($reg); // cargo en la clase
			   $rol->rol_eliminar();		    
			 break;	 	  
	} // fin switch
	
	?>
	<title>VivePatrimonio - administrador</title>
        
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<script src="js/jquery.min.js"></script>
		 <!-- Custom Theme files -->
         <link href="admestilos.css" rel="stylesheet" type="text/css" />
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
    <div id="cabecera"><?php require_once ("cabecera.php");?>
		<div class="container">
			<?php require_once 'menu.php';?>
        </div>
        <div class="sec_contedor" align="center">
		<!--   parte para contenidos-->
         <div align="center"><img src="images/imagen-proyectos1.png" ></div>
        <link href="grafico.css" rel="stylesheet" type="text/css" />
        </div>
    </div>
</body>
<div id="footer" class="footer">
		<div class="container">			
			
			<div class="row">					
				<div class="footer-top col-sm-12">
					<p class="text-center copyright">&copy; 2020 <a href="https://www.patrimoniocultural.gob.ec/" class="footer-site-link">INPC</a> todos los derechos reservados. </p>
				</div><!-- end col --> 
			</div><!-- end row -->
			
		</div><!--End container -->
	</div>
  
</html>