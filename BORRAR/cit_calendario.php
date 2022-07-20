<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1"/>
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
	<title>Solicitud de Certificado de Bienes NO Patrimoniales</title>
	<!-- set your website meta description and keywords -->
	<meta name="description" content="INPC, solicitud del certificado de bienes no patrimoniales">
	<meta name="keywords" content="bienes no patrimoniales, solicitud, certificado, INPC, salida del pais, solicitud de informe tecnico, inspeccion">
	<!-- Bootstrap Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Font Awesome Stylesheets -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Template Main Stylesheets -->
	<link rel="stylesheet" href="css/contact-form.css" type="text/css">	
	<?php setlocale(LC_ALL,"es_ES");?>
        <?php require_once ('adm_include.php');
		      $m=get("m");
			  $a=get("a");
			  $sol= get("sol");
			  $reg= get("reg");
			  if($reg == 0)
			     $reg = $_POST["rdg_lugar"];
		 ?>
</head>

<body>
	
	<section id="contact-form-section" class="form-content-wrap">
		<div class="container">
			<div class="row">
				<div class="tab-content">
					<div class="col-sm-12">
                    <div class="col-sm-12">
									                    
						<div class="item-wrap">
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
                                           <h2 class="item-title text-center"><a href="?reg=<?php echo $reg?>&sol=<?php echo $sol?>&m=<?php echo mesantes($m,$a)?>&a=<?php echo anioantes($m,$a)?>">Anterior</a></h2>
                                     </div>
								     <div class="form-group col-sm-4">
								    <div class="item-info">
											<h2 class="item-title text-center"><?php mes_letras($m,$a)?></h2>
									
										</div><!--End item-info -->
                                      </div>  
                                       <div class="form-group col-sm-4">
                                     <h2 class="item-title text-center"><a href="?reg=<?php echo $reg?>&sol=<?php echo $sol?>&m=<?php echo messiguiente($m,$a)?>&a=<?php echo aniosiguiente($m,$a)?>">Siguiente</a></h2>
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
                                            <?php calendario($m,$a,$sol,$reg)?>
                                        </tbody>
                                    
                                    </table>
									
								</div>
							</div><!--End row -->
							
						
								
							
							<!-- Popup end -->
							
						</div><!-- end item-wrap -->
					</div><!--End col -->
				</div><!--End tab-content -->
			</div><!--End row -->
		</div><!--End container -->
	</section>
	
		
	<div class="colBottomMargin">
		&nbsp;<div class="colBottomMargin">&nbsp;</div>
	</div>	
	
	<div id="footer" class="footer">
		<div class="container">			
			
			<div class="row">					
				<div class="footer-top col-sm-12">
					<p class="text-center copyright">&copy; 2020 <a href="https://www.patrimoniocultural.gob.ec/" class="footer-site-link">INPC</a> todos los derechos reservados. </p>
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
	
 	<!-- carga cudades -->   



		<!-- carga cantones -->
    

    
    	<!-- carga parroqias -->

    
</body>
</html>
