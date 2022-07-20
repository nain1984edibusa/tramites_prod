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
	  <?php require_once 'adm_include.php'; // incluir las clases
	  
    $tra = new clsregprof; // declaro un objeto de la clase de la pagina que gestiono
    ///   acciones sobre registros
	$acc = get("acc"); // recogemos la accion cero por defecto
	//print_r ($acc);
	switch ($acc){ // evaluamos la accion
	    case 1: // ingresar a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $tra->carga_tra_nombre($_POST["txtnom"]);
			   $tra->tra_insertar(); // inserto registro
			   
		     break;
		case 2: // modificamos a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $reg = get("reg"); // recojo el registro seleccionado
			   $tra->carga_tra_codigo($reg); // cargo en la clase
			   $tra->carga_tra_nombre($_POST["txtnom"]);
			   $tra->tra_actualizar();
		     break;
		case 3: // eliminamos de la base
			   $reg = get("reg"); // recojo el registro seleccionado
			   $tra->carga_tra_codigo($reg); // cargo en la clase
			   $tra->tra_eliminar();		    
			 break;	 	  
	} // fin switch
	
?>
	   <title>Proyecto - administrador</title>
        
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
		
					<!-- Products -->
					<div class="products">
						<div class="container">
							<div class="col-md-9 products-left">
								<div class="error-page">
									<?php require_once 'menu.php';?>
                                    
                                   
                                    
                                    
                                    <!--   parte para contenidos-->
                     <div id="titulo2">Registros Encontrados</div>
      					<div id="sec_contedor">
      					  <table width="771">
      					      <tr>
      					        <th>Nro. de Tramite</th>
      					        <th>Nombre del Proyecto</th>
      					        <th>Fecha_Inicio</th>
      					        <th>Tiempo Transcurrido</th>
                                <th colspan="4" align="center">Acciones</th>
   					          </tr>
      					      <?php  
			 
			  $desde = get("desde"); // recoger la pagina actual
			  if($desde == 0)
			  $desde = 0; // poner pagina 0 en la primera entada
			  $pagina = 10; // numero de registros por página
			  $des = $desde * $pagina;  // registros de todo el universo 
			  $tra->carga_usu_codigo($_SESSION["codusuario"]);
			  $rspaireg = $tra->regprof_seleccionartodo(); // selecciono todos los registros
			  $registros = mysql_num_rows($rspaireg);  // selecciono el total de regitros 
			  $rspai = $tra->regprof_seleccionarpaginausu($des,$pagina); // seleccion los siguientes $pagina(10) resitros desde $des(20)
			  while($row = mysql_fetch_row($rspai)){ // recorro los registros devueltos y muestro en las filas
				?>
      					      <tr class="fila">
      					        <td class="number"><?php echo $row[0]?></td>
      					        <td><?php echo $row[1]?></td>
      					        <td><?php echo $row[3]?></td>
      					        <td class="boton"><?php echo str_replace(' ','<br>',$row[3])."<br><br><font color='blue'><b>Tiempo total de tr&aacute;mite:".$row[3].'</font>'?></td>
      					        <td> <a href="adm_verproyecto.php?pry=<?php echo $row[0]?>"  target="_blank"  title="Ver" class="btn btn-sm btn-info"> Ver </a></td>
                                
   					          </tr>
      					      <?php }// fin while?>
      					      <tr>
      					        <td colspan="11" class="paginas">Páginas
      					          <?php $p=1; // paginar
			              for($i=0;$i<$registros;$i=$i+$pagina){
							    $des = $p-1;
							    echo '<a href="?desde='.$des.'">'.$p.'</a>  ' ;
								$p++;
						  }
			?></td>
   					          </tr>
   					        </table></td>
    					    </tr>
      					  </table>
      					</div> <!--fin sec_contedor-->
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

