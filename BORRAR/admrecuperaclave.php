
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	   
       <?php require_once 'adm_include.php'; // incluir las clases
       $acc = get("acc"); // recogemos la accion cero por defecto
	   switch ($acc){ // evaluamos la accion
	    case 1: 			   
		     break;
		case 2:
		     break;
		case 3:		    
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
     	<!-- container -->
		<div id="cabecera"><?php require_once ("cabecera.php");?></div>
					<!-- Products -->
					<div class="products">
						<div class="container">
							<div class="col-md-9 products-left">
								<div class="error-page">
									<?php require_once 'menu.php';?>
                                    <!--   parte para contenidos-->
                                        <form id="form" action="?log=1" method="post" oninput="range_control_value.value = range_control.valueAsNumber">
											<table class="table table-responsive">
												<tr>
												  <th colspan="2" align="center"><h4>RECUPERACIÓN DE CLAVE</h4></th>
												</tr>
												<tr>
												  <th align="center">Favor ingrese su correo electrónico</th>
												  <th align="center"><img class="lar"  src='images/perfil.png'></th>
												</tr>
												
												<tr>
												  <th width="196" class="alert-info"><h1><span>Correo :</span></h1></th>
												  <th width="262"><input class="form-control" name="txtcor" autofocus required type="email" id="txtcor" placeholder="Ingresar correo electrónico"  ></th>
												</tr>
												<tr>
													<th><input type="submit" class="btn btn-primary" name="Submit" value="Enviar"></th>
												</tr>
											</table>
											
                                            <?php 
											if(get("error"))
								
								{?>
									<div class="alert alert-danger">
                                      <strong>Correo electrónico incorrecto!</strong> Favor contactarse con el Administrador del Sistema.
                                    </div>
                                    
                                   
								<?php }?>
										</form>

									<?php
                                        $log = get("log");
                                        $envio = 0;
                                        if ($log == 1){ // if1 viene el fomulario con datos
                                               $usu = new clsusuarios;
                                               
                                               $usu->carga_usu_correo($_POST["txtcor"]);
                                               $rsusu = $usu->usuario_clave();
                                               $registros = mysql_num_rows($rsusu);
                                               if($registros > 0){// if2 encontro registros correctos
                                                    $usuarray = mysql_fetch_array($rsusu);
                                                    $correo = $usuarray[3];
                                                    
													 // Envio correo
													$subject = 'Solicitud de entrega de clave';   // Asunto
																					
													/** Incluir destinatarios. El nombre es opcional **/
													$mail1 = $usuarray[3];
													$mail2 = 'edibusa_1991@hpotmail.com';
																					
																														
													$body    ="Estimado Usuario, su solicitud de env[io de contrase;a se ha registrado con éxito, a continuación se detalla sus datos:\r\n";
													$body    = $body."<strong>Datos del Solicitante </strong>
													<p> Apellidos y Nombres: " . $usuarray[1]. " </p>
													<p> Nro. Identificación: " . $usuarray[4]. " </p>
													<p> Nro. Celular: " . $usuarray[5] . " </p>
													<p> Usuario:".$usuarray[6] ."</p>
													<p>Contrase;a " . $usuarray[2] ."</p>";
																						
													envio_mail($body,$subject,$mail1,$mail2);
													 
                                                    
                                                    $envio = 1;	
                                                    
                                                } // fin if2 	
                                                else
                                                    redireccionar("admrecuperaclave.php?error=1"); 
                                         }// fin if1 
                                    ?>
								</div>


											<div class="container">	
												
												  
													 <?php
														if($envio != 1){
													 ?>
													<?php }
													else{
													?>
													 <div class="alert alert-success"> Un correo electrónico ha sido enviado a <strong><?php echo $correo?>,</strong> con las credenciales de acceso, por favor revíselo.</div>
													<?php }?>
                                                    
                                                   
													
												
											</div>
                
						</div>
                                    <!-- fin contenidos-->
                       </div>
					</div>
                     
		<!-- /container -->
	</body>
   
</html>

