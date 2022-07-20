<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	  
       <?php require_once 'adm_include.php'; // incluir las clases
    $rol = new clsroles; // declaro un objeto de la clase de la pagina que gestiono
    ///   acciones sobre registros
	$acc = get("acc"); // recogemos la accion cero por defecto
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
	   <title>Proyecto administrador</title>
        
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
     	<!-- container -->
		<div id="cabecera"><?php require_once ("cabecera.php");?></div>
					<!-- Products -->
					<div class="products">
						<div class="container">
							<div class="col-md-9 products-left">
								<div class="error-page">
									<?php require_once 'menu.php';?>
                                    
                                   
                                    <div>Bienvenido al sistema de Seguimiento </div>
                                    
                                    <!--   parte para contenidos-->
                                    
 <div class="table-responsive">
  <table width="700px">
   <div id="contenido">  </div>
    <tr>
      <td width="343"><a href="documentos_inpc\manuales\MANUAL_DE_USUARIO_EXTERNO.pdf" target="_blank"> Manual Usuario </a></td>
      <td width="345">&nbsp;</td>
      </tr>
    <tr class="even">
      <td><a href="documentos_inpc\manuales\MANUAL_DE_USUARIO_EXTERNO.pdf" target="_blank"> <img src="image/pdf-icon.png" /></a></td>
      
      </tr>
    <tr>
      <td></td>
      <td>  </td>
      </tr>
   </table>
</div>
                                    
                                    
                                       
                                    <!-- fin contenidos-->
                                </div>
							</div>
                           
					   </div>
						</div>			
						
				</div>	
		
		<!-- /container -->
	</body>
   
</html>

