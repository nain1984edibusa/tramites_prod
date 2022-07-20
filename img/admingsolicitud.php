<?php require_once 'admsesion.php'?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml"><head>
	   <?php require_once 'metas.php'?>
       <?php require_once 'adminclude.php'; // incluir las clases
    $slc = new clssolicitudes; // declaro un objeto de la clase de la pagina que gestiono
    ///   acciones sobre registros
	$acc = get("acc");
	 // recogemos la accion cero por defecto
	switch ($acc){ // evaluamos la accion
	    
	    case 1: // ingresar a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $slc->carga_slc_codigo($_POST["selpai"]);
			   $slc->slc_insertar(); // inserto registro
			   
		     break;
		case 2: // modificamos a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $reg = get("reg"); // recojo el registro seleccionado
			   $slc->carga_rol_codigo($reg); // cargo en la clase
			   $slc->carga_rol_nombre($_POST["txtnom"]);
			   $slc->rol_actualizar();
		     break;
		case 3: // eliminamos de la base
			   $reg = get("reg"); // recojo el registro seleccionado
			   $slc->carga_rol_codigo($reg); // cargo en la clase
			   $slc->rol_eliminar();		    
			 break;	 	  
	} // fin switch
	
?>
	   <title>Asesoramiento - administrador</title>
        
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<script src="js/jquery.min.js"></script>
		 <!-- Custom Theme files -->
         <link href="admestilos.css" rel="stylesheet" type="text/css" />
		<link href="css/style.css" rel='stylesheet' type='text/css' />
        <link href="grafico.css" rel="stylesheet" type="text/css" />
   		 <!-- Custom Theme files -->
         
		 <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
   		 
         <script type="text/javascript">
            function cargartipoase(valor) {
                 var arrayValores=new Array( 
				 
				 <?php 
				        $prov = new clstipoasesorias;
						$rsprov = $prov->tpa_seleccionartodoporcodigo();
						while($rowprov = mysql_fetch_row($rsprov)){
				 ?>
                     new Array(<?php echo $rowprov[0]?>,<?php echo $rowprov[1]?>,"<?php echo $rowprov[2]?>"), 
				 <?php }?>	 
                     new Array(1033,4,"opcion3-4") );
                 if(valor==0) {
                      // desactivamos el segundo select 
                     document.getElementById("selpro").disabled=true; 
                 }else{
                     // eliminamos todos los posibles valores que contenga el select2 
                     document.getElementById("selpro").options.length=0; 
                     // añadimos los nuevos valores al select2 
                     document.getElementById("selpro").options[0]=new Option("Selecciona una Asesoria", "");
                     for(i=0;i<arrayValores.length;i++) {
                         // unicamente añadimos las opciones que pertenecen al id seleccionado
                         // del primer select 
                         if(arrayValores[i][0]==valor) { 
                             document.getElementById("selpro").options[document.getElementById("selpro").options.length]=new Option(arrayValores[i][2], arrayValores[i][1]); 
                         } 
                     }
                      // habilitamos el segundo select 
                     document.getElementById("selpro").disabled=false;
                } 
            } 
			</script>
         
         
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
                            <div id="derecha"> <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15959.178963587145!2d-78.4922425!3d-0.1969827!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2sec!4v1475610336375" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> </div>
								<div class="error-page">
									<?php require_once 'menu2.php';?>
                                    
                                    <h1>Usuario:<?php echo $_SESSION["usuario"] ?></h1>
                                    <div>Bienvenido al sistema de Asesoria  </div><br />
                                   
                                                                        
                                    <!--   parte para contenidos-->
                      
                                 <!--   ------------------------------------------------------------------------------------>
                                <form>
                                 <br> Seleccione una Asesoria </br>
                                 	  <div id="frmobjeto"><select class="form-control" id="selpai" name="selpai" onchange='cargartipoase(this.value);' autofocus required>
						                         <option value="">Selecciona una asesoria</option>
												<?php
												    $tca = new clsasesorias;
													$rstca = $tca->ase_seleccionartodo();
													while ($row = mysql_fetch_row($rstca)){
												?>
												 <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
												<?php }// fin while?>
						  					  </select></div>
						  <div id="frmlabel">Tipo de Asesoria: </div>
						  <div id="frmobjeto"><select class="form-control" id="selpro" name="selpro" onchange='cargarselpro(this.value);' autofocus required disabled>
						                        <option value="">Seleccciona un tipo de asesoria</option>
												
						  					  </select></div>
                                <div id="frmlabel">Descripción: </div> 
                                       <input class="form-control" type="text"  placeholder="Descripcion">  
                                 <div id="frmlabel">ADjuntos: </div> 
                                  <input class="form-control" type="file" id="file" name="file"/>
                                  <input type="submit" class="btn btn-primary" formaction="admuserusuario.php" value="Enviar" >
            					  <input type="reset" class="btn btn-default" value="Limpiar">
        						

                                </form>
        							
         									
 
        					
        								
   									
                                    
                                    <!-- fin contenidos-->
                                </div>
							</div>
                            
					   </div>
						</div>			
				
					<div class="footer-bottom">
						
					</div>
					
				</div>	
		
		<!-- /container -->
	</body>
   
</html>

