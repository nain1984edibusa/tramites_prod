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



<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once ('adm_include.php');
        $prc = new clsregprof; // declaro un objeto de la clase de la pagina que gestiono
    	///   acciones sobre registros
		$acc = get("acc");
		$tra = get("tra");
		$d = get("d");
		$m=get("m");
		$a=get("a");
		
		
		// recogemos la accion cero por defecto
		switch ($acc){ // evaluamos la accion
	    
	    case 1: // ingresar a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   
			   $tra = get("tra");
			   $prc->carga_tra_codigo($tra);
			   
			   $prc->carga_pai_codigo($_POST["selpain"]);
			   $prc->carga_rpes_codigo($_POST["selesp"]);
			  		   
			   $prc->carga_regp_ciudad($_POST["txtciudad"]);
			   $prc->carga_regp_cedula($_POST["txtced"]);
			   $prc->carga_regp_nombre($_POST["txtnom"]);
			   $prc->carga_regp_acuerdo($_POST["rdgllevo"]);
			  
			   $prc->regprof_insertar(); // inserto registro
			   $rsprc = $prc->regprof_seleccionarultimo();
			   $ultprc = mysql_fetch_row($rsprc);
			   
			   
			  
			 												
		     break;
		case 2: // modificamos a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $reg = get("reg"); // recojo el registro seleccionado
			   $prc->carga_rol_codigo($reg); // cargo en la clase
			   $prc->carga_rol_nombre($_POST["txtnom"]);
			   $prc->rol_actualizar();
		     break;
		case 3: // eliminamos de la base
			   $reg = get("reg"); // recojo el registro seleccionado
			   $prc->carga_rol_codigo($reg); // cargo en la clase
			   $prc->rol_eliminar();		    
			 break;	 	  
	} // fin switch
  ?>
	<title>Sistema de seguimiento de proyectos Vive patrimonio</title>
    	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<script src="js/jquery.min.js"></script>
		 <!-- Custom Theme files -->
        <link href="admestilos.css" rel="stylesheet" type="text/css" />
		<link href="css/style.css" rel='stylesheet' type='text/css' />
        <link href="grafico.css" rel="stylesheet" type="text/css" />
		<meta name="description" content="INPC, solicitud del certificado de bienes no patrimoniales">
		<meta name="keywords" content="bienes no patrimoniales, solicitud, certificado, INPC, salida del pais, solicitud de informe tecnico, inspeccion">
	
	<?php setlocale(LC_ALL,"es_ES");?>
        
        
<!-- javascrips -->
    

<script type="text/javascript" >
window.onload = function () {
    document.getElementById("rdgllevo_1").onclick = modificarEstado;
    document.getElementById("rdgllevo_2").onclick = modificarEstado;
}
 
function modificarEstado(){
    if (document.getElementById("rdgllevo_1").checked) {
		
        document.getElementById("selmet").disabled = true;
        
		
    } else {
        document.getElementById("selmet").disabled = false;
        document.getElementById("selmet").value = "";
        
    }
}
 
</script>
<!--Llamada al WS-->
<script>
function realizaProceso( valorCaja2){
        var parametros = {
             
                "valorCaja2" : valorCaja2
        };
        $.ajax({
                data:  parametros,
                url:   'clw_registro.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        document.getElementById("txtdespry").value = (response);
                }
        });
}
</script>

 <!-- webfonts -->
 <link href='http://fonts.googleapis.com/css?family=Raleway:200,400,300,600,500,900,700,100,800|Comfortaa:700' rel='stylesheet' type='text/css'>
 <link href='http://fonts.googleapis.com/css?family=Comfortaa:700,300,400' rel='stylesheet' type='text/css'>
 <!-- webfonts -->
</head>
<body>
	
	
		
			<div class="container">
				<?php require_once 'menu.php';?>
			</div>   
        <div class="row">
            <div class="tab-content">
				<div class="col-sm-12">
                    <div class="col-sm-12"> 
                		<div class="item-wrap">
							<div class="row">
								<div class="container">
									<div class="col-md-6">
                                   
										<div id="izquierda" >
											<?php
												
												switch ($tra){
											     
												 case 1:
												 
											?>	
											<!--<form id="idform" name="idform" method="post" data-toggle="validator" class="popup-form" action="?acc=1">-->
											<form  method="post" enctype="multipart/form-data" action="?acc=1&tra=<?php echo $tra?>">
												<fieldset>	
												<legend>Carga de Requisitos tra=<?php echo $tra?></legend><br>
													<div class="row">
														<div id="msgContactSubmit" class="hidden"></div>
														 
															<div class="form-group col-sm-6">
																<div class="help-block with-errors">Especialidad </div>		
																		<select name="selesp" class="form-control" required data-error="Por favor selecciona Especialidad" >
																		  <option value="">Seleccione Especialidad</option> 
																		  <?php 
																			$pry = new clsespecialidad;
																			$rspry = $pry->esp_seleccionartodo();
																			
																			while($row = mysql_fetch_row($rspry)){
																		  
																		  ?>
																		  <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
																		  <?php } // fin while?>
																		</select>
															<div class="input-group-icon"><i class="fa fa-street-view"></i></div> 
															</div><!-- end form-group -->
                                                            <div class="form-group col-sm-6">
																<div class="help-block with-errors">Pais de Nacimiento</div>		
																		<select name="selpain" class="form-control" required data-error="Por favor selecciona Pais" >
																		  <option value="">Seleccione Pais</option> 
																		  <?php 
																			$pry = new clspais;
																			$rspry = $pry->pais_seleccionartodo();
																			
																			while($row = mysql_fetch_row($rspry)){
																		  
																		  ?>
																		  <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
																		  <?php } // fin while?>
																		</select>
															<div class="input-group-icon"><i class="fa fa-street-view"></i></div> 
															</div><!-- end form-group -->
                                                            <div class="form-group col-sm-6">
																<div class="help-block with-errors">Pais de Residencia</div>		
																		<select name="selpair" class="form-control" required data-error="Por favor selecciona Pais" >
																		  <option value="">Seleccione Pais</option> 
																		  <?php 
																			$pry = new clspais;
																			$rspry = $pry->pais_seleccionartodo();
																			
																			while($row = mysql_fetch_row($rspry)){
																		  
																		  ?>
																		  <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
																		  <?php } // fin while?>
																		</select>
															<div class="input-group-icon"><i class="fa fa-street-view"></i></div> 
															</div><!-- end form-group -->
                                                            
                                                            <div class="form-group col-sm-6">
																<div class="help-block with-errors">Ciudad de Residencia</div>
																<input name="txtciudad" id="txtciudad" placeholder="Ciudad*" class="form-control" type="text" required data-error="Por favor ingresa la Ciudad" > 
																<div class="input-group-icon"><i class="fa fa-address-card"></i></div>
															</div><!-- end form-group -->
															
															<div class="form-group col-sm-6">
																<div class="help-block with-errors">Cedula</div>
																<input name="txtced" id="txtced" placeholder="Cédula*" class="form-control" type="number" > 
																<div class="input-group-icon"><i class="fa fa-user"></i></div>
															</div><!-- end form-group -->
															
															<div class="form-group col-sm-6">
																<div class="help-block with-errors">Nombre</div>
																<input name="txtnom" id="txtnom" placeholder="nombre*" class="form-control" type="text" required data-error="Por favor ingresa elNombre"> 
																<div class="input-group-icon"><i class="fa fa-user"></i></div>
															</div><!-- end form-group -->
															
													</div><!-- end row -->
												</fieldset>
												
																		
												
												 <fieldset>
													<legend>Acuerdo</legend>
													<div class= "row">
																										
													 <div class="form-group col-sm-12">
														<div class="help-block with-errors">
																Aceptar: 
																	<input name="rdgllevo" type="radio" id="rdgllevo_1" value="1">
																</div>	
															<div class="form-group last col-sm-12">
															<span class="label label-default">* Campos requeridos</span> <br /><br />
															<button type="submit" id="submit" class="btn btn-success"><i class='fa fa-envelope'></i> Siguiente</button>
															<div class="clearfix"></div>
															</div><!-- end form-group -->	  
																	
																						   
		 
													</div><!-- end form-group -->
															 
														
													</div>
										</div> 
									</div>
														
												</fieldset> 	
											
										   
												
												
												
											</form>		
										<?php break;
											case 2:?>
											<!--<form id="idform" name="idform" method="post" data-toggle="validator" class="popup-form" action="?acc=1">-->
											<form  method="post" enctype="multipart/form-data" action="?acc=1&tra=<?php echo $tra?>">
												<fieldset>	
													<legend>Carga de Requisitos tra=<?php echo $tra?></legend><br>
													<div class="row">
														<div class="row">
								
																<div class="col-sm-12">
																	<div class="item-content colBottomMargin">
																		<div class="item-info">
																			<h2 class="item-title text-center">Seleccionar Cita</h2>
																			<p><?php echo "Fecha actual: " . date('d-m-Y'); ?></p>
																		</div><!--End item-info -->
																		
																   </div><!--End item-content -->
																</div><!--End col -->
														   
																<div class="col-md-12">
																	 <div class="form-group col-sm-4">
																		   <h2 class="item-title text-center"><a href="?tra=<?php echo $tra?>&m=<?php echo mesantes($m,$a)?>&a=<?php echo anioantes($m,$a)?>">Anterior</a></h2>
																	 </div>
																	 <div class="form-group col-sm-4">
																		<div class="item-info">
																			<h2 class="item-title text-center"><?php mes_letras($m,$a)?></h2>
																	
																		</div><!--End item-info -->
																	 </div>  
																	 <div class="form-group col-sm-4">
																		<h2 class="item-title text-center"><a href="?tra=<?php echo $tra?>&m=<?php echo messiguiente($m,$a)?>&a=<?php echo aniosiguiente($m,$a)?>">Siguiente</a></h2>
																	 </div>
																	<table id="lookup" class="table table-bordered table-hover">
																		<thead bgcolor="#eeeeee" align="center">
																			<tr>
																				<th>L</th>
																				<th>M</th>
																				<th>M</th>
																				<th>J</th>
																				<th>V</th>
																				<th>S</th>
																				<th>D</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php calendario($m,$a,$tra)?>
																		</tbody>
										
																	</table>
										
																</div>
														</div><!--End row -->
														<div class="row">
								
																<div class="col-sm-12">
																	<div class="item-content colBottomMargin">
																		<div class="item-info">
																			<h2 class="item-title text-center">Seleccionar Hora</h2>
																			<p><?php echo "Fecha de a cita: " .$d.'-'.$m.'-'.$a; ?></p>
																		</div><!--End item-info -->
																		
																   </div><!--End item-content -->
																</div><!--End col -->
																<div class="col-md-12">
																   
																	<table id="lookup" class="table table-bordered table-hover">
																		<thead bgcolor="#eeeeee" align="center">
																			<tr>
												  
																				<th>Hora</th>
																				<th>Cita</th>
																				<th>Seleccionar</th>
																			  
									  
																			</tr>
																		</thead>
																		<tbody>
																		<?php 
																		
																			  $turno = new clsturno;
																			  for($h=8;$h<17;$h++){
																				  for($min=0;$min<2;$min++){
																					  if($min==0)
																						  $mn='00';
																					  else
																						  $mn='30';	
																						  
																				   $turno->carga_tra_codigo($tra);
																				  $turno->carga_tur_dia($a.'-'.$m.'-'.$d);
																				  $turno->carga_tur_hora($h.':'.$mn);
																				  $rstur = $turno->turno_verificarturno();
																				  if (mysql_num_rows($rstur)==0){// esta libre
																		?>
																		   <tr>
																			   <td><?php echo $h?>:<?php echo $mn?></td>
																			   <td></td>
																			   <td><a href="cit_confirmar.php?tra=<?php echo $tra?>&a=<?php echo $a?>&m=<?php echo $m?>&d=<?php echo $d?>&h=<?php echo $h?>&mn=<?php echo $mn?>">seleccionar</a></td>
																		   </tr>
																		 <?php }   ///// if libre
																			   else{
																			?>
																		   <tr>
																			   <td><?php echo $h?>:<?php echo $mn?></td>
																			   <td>ocupado</td>
																			   <td></td>
																		   </tr>
																		 <?php	   
																			  }
																			}// for minutos
																		 }// for horas?>  
																		</tbody>
																	
																	</table>
																	
																</div>
														</div><!--End row -->
							
														 
													</div><!-- end row -->
												</fieldset>
												
																		
												
												<fieldset>
													<legend>Acuerdo</legend>
													<div class= "row">
																										
													 <div class="form-group col-sm-12">
														<div class="help-block with-errors">
																Aceptar: 
																	<input name="rdgllevo" type="radio" id="rdgllevo_1" value="1">
																</div>	
															<div class="form-group last col-sm-12">
															<span class="label label-default">* Campos requeridos</span> <br /><br />
															<button type="submit" id="submit" class="btn btn-success"><i class='fa fa-envelope'></i> Siguiente</button>
															<div class="clearfix"></div>
															</div><!-- end form-group -->	  
																	
																						   
		 
													</div><!-- end form-group -->
															 
														
													</div>
										</div> 
									</div>
														
												</fieldset> 
												
												
												
											</form>		
																						
                                                  
										<?php break;
											}
										?>				
									<!-- end form -->
								  
								</div><!--End container -->
							</div><!--End row -->
						</div><!-- end item-wrap -->
					</div> <!--End col-sm-12 -->
				</div><!--End col-sm-12 -->
			</div><!--End tab content -->
        </div> <!--fin row   -->  
		
	
	
		
	<div class="colBottomMargin">
		&nbsp;<div class="colBottomMargin">&nbsp;</div>
	</div>	
	
	<div id="footer" class="footer">
		<div class="container">			
			
			<div class="row">					
				<div class="footer-top col-sm-12">
					
				</div><!-- end col --> 
			</div><!-- end row -->
			
		</div><!--End container -->
	</div>
	
	<a href="#" class="scrollup"><i class="fa fa-arrow-circle-up"></i></a>
		
	<!-- jQuery Library -->
	<script src="js/jquery-3.2.1.min.js"></script>	
	<!-- Popper js -->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap Js -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Form Validator -->
	<script src="js/validator.min.js"></script>
	<!-- Contact Form Js -->
	<script src="js/contact-form.js"></script>
    
<?php include_once("./includes/footer.php"); ?>
    
</body>
</html>
