<?php require_once 'admsesion.php'?>
<?php require_once 'adm_include.php'?>
<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Catálogo";
$opcion="Trámites y Formatos";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
?>

	<body>
				<div class="container-fluid descripcion-container">
					<div class="row">
						<div class="col-xs-12 col-sm-2 col-md-2">
							<img src="assets/img/checklist.png" alt="pdf" class="img-responsive center-box">
						</div>
						<div class="col-xs-12 col-sm-10 col-md-10 text-justify lead">
							Bienvenido al catálogo de trámites del Instituto Nacional de Patrimonio Cultural. Aquí encontrará un listado de requisitos (y sus formatos) que deberán cargarse en la plataforma según el trámite seleccionado, así como la opción para iniciar un nuevo trámite.<br>
						</div>
					</div>
				</div>
				<div class="container-fluid">
					<div class="page-header">
						<div class="text-info" >Escoja el Trámite que va a realizar</div>
					</div>
				</div>
					
					<div class="container-fluid descripcion-container">
						<div class="container">
							<form id="idform" name="idform" method="post" data-toggle="validator" class="popup-form" action="?tra=<?php echo $row[0] ?>">
								
													
								
								
									<table class="table table-bordered">
															  <tr>
																<th></th>
																<th scope="col">Trámite</th>
																<th scope="col">Descripción</th>
                                                                <th colspan="4" align="center">Acciones</th>
															  </tr>
																<?php 
																	   $retra = new clstramites;
																	   //echo $pry;
																	  
																	   $rstra = $retra->tra_seleccionartodo();
																	   while ($row = mysql_fetch_row($rstra)){
																?>
															 <tr>
																<td><?php echo $row[0] ?></td>
																<td><?php echo $row[1] ?></td>
																<td><?php echo $row[2] ?></td>
																<td><a href="#!" class="btn btn-light btn-xs"><i class="zmdi zmdi-time-countdown"></i> 5 días laborables</a></td>
																<td><a href="#!" class="btn btn-info btn-xs"><i class="zmdi zmdi-info-outline"></i> Preguntas Frecuentes</a></td>
																<td><a href="#!" class="btn btn-info btn-xs"><i class="zmdi zmdi-collection-text"></i> Requisitos y Formatos</a></td>
																<td> <a href="admregprof.php?tra=<?php echo $row[0]?>&m=<?php echo date("m")?>&a=<?php echo date("Y")?>"  target="_blank"  title="Ir al trámite" class="btn btn-primary btn-xs"> <i class="zmdi zmdi-arrow-right"></i>  Ir al trámite</a></td>
															       
															   
															   
                                                              </tr>
															  
									<?php } //fin while ?>   
									
									</table>
										
							</form> 
                                      
                                                              
                                    
							
						</div>
					</div>
					
									
				
					
				<?php include_once("./includes/footer.php"); ?>	<!-- /footer -->
					
		
		<!-- /container -->
	</body>
    
</html>

