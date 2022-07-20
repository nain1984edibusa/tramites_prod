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
 
	   
<?php require_once 'adm_include.php'; // incluir las clases
    $usu = new clsusuarios; // declaro un objeto de la clase de la pagina que gestiono
    ///   acciones sobre registros
	$acc = get("acc"); // recogemos la accion cero por defecto
	switch ($acc){ // evaluamos la accion
	    case 1: // ingresar a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $usu->carga_usu_usuario($_POST["txtusu"]);
			   $usu->carga_usu_nombre($_POST["txtnom"]);
			   $usu->carga_rol_codigo(4);
			   $usu->carga_usu_cedula($_POST["txtced"]);
			   $usu->carga_gen_codigo($_POST["selgen"]);
			   $usu->carga_par_codigo($_POST["selpar"]);
			   $usu->carga_usu_correo($_POST["txtmai"]);
			   $usu->carga_usu_celular($_POST["txtcel"]);
			   $usu->carga_usu_contrasena($_POST["txtcon"]);
			   $usu->carga_usu_usucreacion("sesion");
			   $usu->usu_insertar(); // inserto registro
			   
			   //////////////////   enviar correo electronico
			   
			   $header = 'From: ' . $mail . " \r\n";
				$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
				$header .= "Mime-Version: 1.0 \r\n";
				$header .= "Content-Type: text/plain";
				
				$mensaje = "Bienvenido al SISTEMA DE ASISTENCIA TÉCNICA PATRIMONIAL \nSu usuario ha sido creado en nuestro sitio web, de acuerdo a las credenciales ingresadas en el formulario de registro en línea.\n\rCredenciales de acceso:\nUsuario:" . $_POST["txtnom"] . "\nClave:" . $_POST["txtcon"] . " \n\rCualquier información adicional, estaremos gustosos de atenderle en la siguiente dirección electrónica direccion.conservacion@inpc.gob.ec \nQuito, Colón Oe 1-93 y Av. 10 de Agosto La Circasiana\nTeléfonos: (5932) 2227 927 / 2549 257 / 2227 969 / 2543 527\nDirección de Conservación y Salvaguardia de Bienes Patrimoniales Culturales: Ext 113, 129, 138\nwww.inpc.gob.ec \n\r";

				
				$mensaje .= "Enviado el " . date('d/m/Y', time());
				$para = $_POST["txtmai"];
				$asunto = 'Registro de Usuario';
				
				mail($para, $asunto, utf8_decode($mensaje), $header);
		     break;
		case 2: // modificamos a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $reg = get("reg"); // recojo el registro seleccionado
			   $usu->carga_usu_codigo($reg); // cargo en la clase
			   $usu->carga_usu_nombre($_POST["txtnom"]);
			   $usu->carga_rol_codigo($_POST["selrol"]);
			   $usu->carga_usu_cedula($_POST["txtced"]);
			   $usu->carga_usu_correo($_POST["txtmai"]);
			   $usu->carga_usu_celular($_POST["txtcel"]);
			   $usu->carga_usu_contrasena($_POST["txtcon"]);
			   $usu->carga_usu_usumodificacion("sesion");
			   $usu->usu_actualizar();
		     break;
		case 3: // eliminamos de la base
			   $reg = get("reg"); // recojo el registro seleccionado
			   $usu->carga_usu_codigo($reg); // cargo en la clase
			   $usu->usu_eliminar();		    
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
         
		 <!---- funcion para validar cedula -->
         <script type="application/x-javascript">
			function validar(formulario){
      			if (formulario.txtced.value.length != 10)
           	{ alert("Debe introducir una cédula de 10 dígitos")}
			}
		</script> 
   		  <!-- webfonts -->
	</head>
	<body>
     	<!-- container -->
		
					<!-- Products -->
					<div class="products">
						<div class="container">
							
								
									<?php require_once 'menu.php';?>
                                    
                                     <!--   parte para contenidos-->
                                        <div id="contenido">
        
            <?php ///////////   inicio contenido
			       $sec = get("sec");
				   switch ($sec){
		                   case 0: //// pagina inicial
			?>			   
		
         <!--   Mostrar registros de la tabla-->
      <!-- <div id="titulo2">Registros Encontrados</div> -->
          
          		<table class="table table-responsive">
                     <tr>
                     </tr>
                     <tr>
                         <th  colspan="2" align="center"><h3>Estimado(a) Señor(a):<?php echo $_POST["txtnom"]?></h3></th>
                     </tr>
                     <tr>
                         <th  colspan="2" align="center"><div align="left">Se creó la cuenta de usuario en el Sistema de Gestión de Trámites</div></th>
                     </tr>
                     <tr>
                         <th colspan="2" align="center">
                           <div align="left">
                             <p>Se ha enviado un correo electrónico de registro a la siguiente dirección: <?php echo $_POST["txtmai"]?>, con las credenciales de acceso, si no puede visualizar el correo.</p>
                             <p>Buscar en la carpeta de correo no deseado (SPAM) </p>
                           </div>
                         </th>
                     </tr>
                     <tr>
                         <th  colspan="2" align="center"><h4><div align="justify">Confirme su registro Ingresando por la opción Iniciar Sesión de su menú principal</div></h4></th>
                     </tr>
                </table>
              
          
                      			   
			<?php                   break;  //////////   fin case 0
						   case 1: //////////////  fomrulario para ingreso de datos	
			?>	
             <div id="titulo2">Ingresar datos para Registro en el Sistema</div>	<br/>	   
              
				<div class="col-md-12">
					<form  class="form-horizontal" id="nuevo" method="post" action="?acc=1"> 
						<div class="form-group col-sm-6">
							<div class="help-block with-errors">Usuario</div>
							<input name="txtusu" id="txtusu" placeholder="Nombre del Usuario*" class="form-control" type="text" required data-error="Por favor ingresa el nombre del usuario" > 
							<div class="input-group-icon"><i class="fa fa-address-card"></i></div>
						</div><!-- end form-group -->
						<div class="form-group col-sm-6">
							<div class="help-block with-errors">Apellidos y Nombres</div>
							<input name="txtnom" id="txtnom" placeholder="Apellidos y Nombres*" class="form-control" type="text" required data-error="Por favor ingresa tus Apellidos y Nombres" > 
							<div class="input-group-icon"><i class="fa fa-address-card"></i></div>
						</div><!-- end form-group -->
						<div class="form-group col-sm-6">
							<div class="help-block with-errors">Cédula</div>
							<input name="txtced" id="txtced" placeholder="Cédula*" class="form-control" type="text" required data-error="Por favor ingresa tu Número de Identificación" maxlength="10" size="10" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" > 
							<div class="input-group-icon"><i class="fa fa-address-card"></i></div>
						</div><!-- end form-group -->
						<div class="form-group col-sm-6">
							<div class="help-block with-errors">Género</div>		
                            <select name="selgen" class="form-control" required data-error="Por favor selecciona el género" >
                            <option value="">Seleccione Tipo de género</option> 
                            <?php 
							   $sel1 = new clsgenero;
							   $rstpo = $sel1->gen_seleccionartodo();
							   while($row = mysql_fetch_row($rstpo)){
							?>
                            <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                            <?php } // fin while?>
                            </select>
							<div class="input-group-icon"><i class="fa fa-street-view"></i></div> 
						</div><!-- end form-group -->
						<div class="form-group col-sm-6">
                            <div class="help-block with-errors">Provincia</div>		
                            <select name="selpro" id="selpro" class="form-control" required data-error="Por favor selecciona provincia" >
							<option  value="">Seleccione Provincia</option> 
                            <?php
                                $pro = new clsprovincia;
                                $rspro = $pro->provincia_seleccionartodo();
                                while($row=mysql_fetch_row($rspro)){
                            ?>	
                            <option value="<?php echo $row[0]?>"><?php echo $row[2]?></option>
                            <?php  } // fin while?>
                            </select>
							<div class="input-group-icon"><i class="fa fa-street-view"></i></div> 
						</div><!-- end form-group -->
						<div class="form-group col-sm-6">
							<div class="help-block with-errors">Cantón</div>		
                            <select name="selcan" id="selcan" class="form-control" >
                            <option value="">Seleccione Canton</option> 
                            </select>
							<div class="input-group-icon"><i class="fa fa-street-view"></i></div> 
						</div><!-- end form-group -->
						<div class="form-group col-sm-6">
							<div class="help-block with-errors">Parroquia</div>		
                            <select name="selpar" id="selpar" class="form-control" >
                            <option value="">Seleccione Parroquia</option> 
                            </select>
							<div class="input-group-icon"><i class="fa fa-street-view"></i></div> 
						</div><!-- end form-group -->

                     <div class="form-group col-sm-6">
							<div class="help-block with-errors">Email</div>
							<input name="txtmai" id="txtmai" placeholder="Tu E-mail*" pattern=".*@\w{2,}\.\w{2,}" class="form-control" type="email" required data-error="Por favor ingresa un correo electrónico válido">
							<div class="input-group-icon"><i class="fa fa-envelope"></i></div>
					 </div><!-- end form-group -->
                     <div class="form-group col-sm-6">
							<div class="help-block with-errors">Número Celular</div>
							<input name="txtcel" id="txtcel" placeholder="Celular*" class="form-control" type="tel" required data-error="Por favor ingresa tu número de teléfono" pattern="[0-9]{10}" maxlength="10" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
							<div class="input-group-icon"><i class="fa fa-phone"></i></div> 
							</div><!-- end form-group -->
                     <div class="form-group col-sm-6">
							<div class="help-block with-errors">Contraseña</div>
							<input name="txtcon" id="txtcon" placeholder="Contraseña*" class="form-control" type="text" required data-error="Por favor ingresa tu Contraseña" > 
							<div class="input-group-icon"><i class="fa fa-address-card"></i></div>
                     </div><!-- end form-group -->
                    
                    
                        
                                                           
                   
                    <div class="col-sm-12"><input type="submit" class="btn btn-primary" name="button" id="button" value="Guardar Registro" /></div>
                  </form>	
	   <!-- fin sec_contedor-->
	
						      
			<?php                   break;  //////   fin case 1
						   case 2:   ////////   formulario para modificar
						        $reg = get("reg");
								$usu->carga_usu_codigo($reg);
						        $rsusu = $usu->usu_seleccionar();
						        $usufila = mysql_fetch_array($rsusu);
								
		    ?>	
			<div id="secc">
	   <div id="titulo2">Editar Registro</div>
	   <div id="sec_contedor">
	      <form id="editar" method="post" action="?acc=2&reg=<?php echo $reg?>">  
			<div id="frmetiquetas">Usuarios:</div>
			<div id="frmcampo"><input value="<?php echo $usufila[1]?>" name="txtnom" id="txtnom" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" />
			</div>
			<div id="frmetiquetas">Rol:</div>
			<div id="frmcampo">
			  <select name="selrol" id="selrol" autofocus required>
			           <option value="">Rol</option>
					   
					   <?php 
					           $sel1 = new clsroles;
							   $rstpo = $sel1->rol_seleccionartodo();    
							   while ($row = mysql_fetch_row($rstpo)){
							        if($usufila[2] == $row[0])
									    $selected = "selected";
									else
									    $selected = "";	
					   ?>
			           <option value="<?php echo $row[0]?>" <?php echo $selected?>><?php echo $row[1]?></option>
					   
					   <?php    }// fin while}?>
                       
			    </select>
                
			  </div>
              <div id="frmetiquetas">cedula:</div>
			<div id="frmcampo"><input value="<?php echo $usufila[3]?>" name="txtced" id="txtced" type="text" autofocus required /></div>
            <div id="frmetiquetas" class="form-inline">Género:</div>
                    <div id="frmcampo">
                      <select class="form-control" name="selgen" id="selgen" autofocus required>
                               <option value="">Género</option>
                               <?php 
                                       $sel1 = new clsgenero;
                                       $rstpo = $sel1->gen_seleccionartodo();    
                                       while ($row = mysql_fetch_row($rstpo)){
                                            if($usufila[2] == $row[0])
                                                $selected = "selected";
                                            else
                                                $selected = "";	
                               ?>
                               <option value="<?php echo $row[0]?>" <?php echo $selected?>><?php echo $row[1]?></option>
                               <?php    }// fin while}?>
                        </select>
                      </div>
            <div id="frmetiquetas">Email:</div>
			<div id="frmcampo"><input value="<?php echo $usufila[4]?>" name="txtmai" id="txtmai" type="text" autofocus required /></div>
            <div id="frmetiquetas">celular:</div>
			<div id="frmcampo"><input value="<?php echo $usufila[5]?>" name="txtcel" id="txtcel" type="text" autofocus required /></div>
            <div id="frmetiquetas">telefono:</div>
			<div id="frmcampo"><input value="<?php echo $usufila[6]?>" name="txttel" id="txttel" type="text" autofocus required /></div>
            <div id="frmetiquetas">Contraseña:</div>
			<div id="frmcampo"><input value="<?php echo $usufila[7]?>" name="txtcon" id="txtcon" type="text" autofocus required /></div>
			<div id="frmcampo"><input type="submit" class="btn btn-primary" name="button" id="button" value="Guardar" /></div>
            
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
   <!-- carga cantones -->
    
<script language="javascript">
$(document).ready(function(){
    $("#selpro").on('change', function () {
        $("#selpro option:selected").each(function () {
            elegido=$(this).val();
            $.post("selcan.php", { elegido: elegido }, function(data){
                $("#selcan").html(data);
            });			
        });
   });
});
</script>
   
<!-- carga parroquias -->
<script language="javascript">
$(document).ready(function(){
    $("#selcan").on('change', function () {
        $("#selcan option:selected").each(function () {
            elegido=$(this).val();
            $.post("selpar.php", { elegido: elegido }, function(data){
                $("#selpar").html(data);
            });			
        });
   });
});
</script>		
		<!-- /container -->
	</body>
   
</html>

