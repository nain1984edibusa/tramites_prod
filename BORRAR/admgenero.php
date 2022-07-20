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
	   
       <?php require_once 'adm_include.php'; // incluir las clases
    $rol = new clsgenero; // declaro un objeto de la clase de la pagina que gestiono
    ///   acciones sobre registros
	$acc = get("acc"); // recogemos la accion cero por defecto
	switch ($acc){ // evaluamos la accion
	    case 1: // ingresar a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $rol->carga_gen_nombre($_POST["txtnom"]);
			   $rol->gen_insertar(); // inserto registro
			   
		     break;
		case 2: // modificamos a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $reg = get("reg"); // recojo el registro seleccionado
			   $rol->carga_gen_codigo($reg); // cargo en la clase
			   $rol->carga_gen_nombre($_POST["txtnom"]);
			   $rol->gen_actualizar();
		     break;
		case 3: // eliminamos de la base
			   $reg = get("reg"); // recojo el registro seleccionado
			   $rol->carga_gen_codigo($reg); // cargo en la clase
			   $rol->gen_eliminar();		    
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
                                    
                                    <h1>Administrador:<?php echo $_SESSION["usuario"] ?></h1>
                                    <div>Bienvenido al sistema de Asesoria </div>
                                    
                                    <!--   parte para contenidos-->
                                         <div id="contenido">
		    
			<?php ///////////   inicio contenido
			       $sec = get("sec");
				   switch ($sec){
		                   case 0: //// pagina inicial
			?>			   
			             <div id="secc">
   <!--   Mostrar registros de la tabla-->
      <div id="titulo2">Registros Encontrados</div>
      <div id="sec_contedor">
			<table>
			<tr>
			  <td colspan="4" class="nuevo">Nuevo registro <a href="?sec=1"><img src="img/plus1.png" alt="Nuevo" width="20" height="20" /></a></td>
			  </tr>
			<tr><th>Id</th><th>Género</th><th>Editar</th><th>Eliminar</th></tr>
			 <?php  
			 
			  $desde = get("desde"); // recoger la pagina actual
			  if($desde == 0)
			    $desde = 0; // poner pagina 0 en la primera entada
			  $pagina = 3; // numero de registros por página
			  $des = $desde * $pagina;  // registros de todo el universo 
			 
			  $rspaireg = $rol->gen_seleccionartodo(); // selecciono todos los registros
			  $registros = mysql_num_rows($rspaireg);  // selecciono el total de regitros 
			  $rspai = $rol->gen_seleccionarpagina($des,$pagina); // seleccion los siguientes $pagina(10) resitros desde $des(20)
			  while($row = mysql_fetch_row($rspai)){ // recorro los registros devueltos y muestro en las filas
				 ?>
          <tr class="fila">
               <td class="number"><?php echo $row[0]?></td>
				<td><?php echo $row[1]?></td>
				<td class="boton"><a href="?sec=2&reg=<?php echo $row[0]?>"><img src="img/edit1.png" alt="Editar" /></a></td>
				<td class="boton"><a href="javascript:;" onclick="confirmar('?acc=3&reg=<?php echo $row[0]?>'); return false;">
				<img src="img/minus1.png"/></a></td>
          </tr>
            <?php }// fin while?>
            <tr><td colspan="4" class="paginas">Páginas <?php $p=1; // paginar
			              for($i=0;$i<$registros;$i=$i+$pagina){
							    $des = $p-1;
							    echo '<a href="?desde='.$des.'">'.$p.'</a>  ' ;
								$p++;
						  }
			?></td></tr>
			</table>
		   
       </div> <!--fin sec_contedor-->
   </div>              			   
			<?php                   break;  //////////   fin case 0
						   case 1: //////////////  fomrulario para ingreso de datos	
			?>			   
				<div id="secc">
	   <div id="titulo2">Ingresar Registro</div>
	   <div id="sec_contedor">
	      <form id="nuevo" method="post" action="?acc=1">  
			<div id="frmetiquetas">Género:</div>
            
			<div id="frmcampo"><input class="form-control" name="txtnom" id="txtnom" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" />
			</div>
			
			<div id="frmcampo"><input type="submit" name="button" id="button" value="Guardar" /></div>
		  </form>	
	   </div> <!-- fin sec_contedor-->
	
						      
			<?php                   break;  //////   fin case 1
						   case 2:   ////////   formulario para modificar
						        $reg = get("reg");
								$rol->carga_gen_codigo($reg);
						        $rsrol = $rol->gen_seleccionar();
						        $rolfila = mysql_fetch_array($rsrol);
		    ?>	
			<div id="secc">
	   <div id="titulo2">Editar Registro</div>
	   <div id="sec_contedor">
	      <form id="editar" method="post" action="?acc=2&reg=<?php echo $reg?>">  
			<div id="frmetiquetas">Rol:</div>
			<div id="frmcampo"><input value="<?php echo $rolfila[1]?>" name="txtnom" id="txtnom" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" />
			</div>
			
			<div id="frmcampo"><input type="submit" name="button" id="button" value="Guardar" /></div>
		  </form>	
	   </div> <!-- fin sec_contedor-->
	</div><!-- fin secc 2-->			   
			<?php			       break;  ////////  fin case 2
			      } ///   fin switch
				  
				   /////////////  fin contenido
			?>
		
		
		
		</div>
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

