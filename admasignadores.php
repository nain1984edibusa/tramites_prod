
<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Administrador";
$opcion="Usuarios";
//require_once ("./adm_include.php"); // incluir las clases
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./modelo/util.php");
include_once("./modelo/clsusuarios.php");
include_once("./modelo/clsgenero.php");
include_once("./modelo/clsregional.php");

?>
<?php
$asignador = new clsusuarios; // declaro un objeto de la clase de la pagina que gestiono
    ///   acciones sobre registros
	$acc = get("acc"); // recogemos la accion cero por defecto
	switch ($acc){ // evaluamos la accion
	    case 1: // ingresar a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $asignador->setUsu_usuario($_POST["txtusu"]);
			   $asignador->setUsu_nombre($_POST["txtnom"]);
			   $asignador->setUsu_apellido($_POST["txtape"]);
			   $asignador->setUsu_correo($_POST["txtemail"]);
			   $asignador->setRol_id(3);
			   $asignador->setUsu_identificador($_POST["txtced"]);
			   $asignador->carga_gen_codigo($_POST["selgen"]);
			  // $asignador->carga_aaset_codigo($_POST["selarea"]);
			   $asignador->setUsu_contrasena(password_hash($_POST["txtpass"],PASSWORD_BCRYPT));
			   $asignador->setUsu_fechcreacion(date('Y-m-d H:i:s'));
         $asignador->setUsu_certificado($_POST["txtcert"]);                                               
			   $asignador->setReg_id($_POST["selreg"]);
			   $asignador->setUsu_estado("ACTIVO");//CAMBIAR A INACTIVO
			   $asignador->setUsu_tidentificacion("CI");	
			   $asignador->setPro_id("17");
   			   $asignador->setCan_id("1701");
   			   $asignador->setPar_id("170101");   
    
	   
			   
			   $asignador->usu_insertar(); // inserto registro
			   
		     break;
		case 2: // modificamos a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $reg = get("reg"); // recojo el registro seleccionado
			   $asignador->setUsu_id($reg); // cargo en la clase
			   $asignador->setUsu_identificador($_POST["txtced"]);
			   $asignador->setUsu_nombre($_POST["txtnom"]);
			   $asignador->setUsu_apellido($_POST["txtape"]);
			   $asignador->setUsu_correo($_POST["txtemail"]);
			   $asignador->setUsu_contrasena(password_hash($_POST["txtpass"],PASSWORD_BCRYPT));
         $asignador->setUsu_certificado($_POST["txtcert"]);
			   $asignador->usu_actualizar();
		     break;
		case 3: // eliminamos de la base
			   $reg = get("reg"); // recojo el registro seleccionado
			   $asignador->carga_usu_codigo($reg); // cargo en la clase
			   $asignador->usu_eliminar();		    
			 break;	 	  
	} // fin switch

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            Bienvenido a esta sección, en la cual se muestra la tabla de Asignadores del sistema, en la cuál se pueden ingresar más opciones.
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 lead">
            <ol class="breadcrumb">
                <li><a href="<?php echo RUTA_BANDEJAS_UI;?>">Inicio</a></li>
                <li class="active"><?php echo $modulo?></li>
                <li class="active"><?php echo $opcion?></li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
    <form class="col-md-8" style="" autocomplete="off">
        <div class="group-material">
            <input type="search" style="display: inline-block !important; width: 50%;" class="material-control tooltips-general" placeholder="Buscar trámite" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚ ]{1,50}" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe el código único del trámite">
            <button class="btn" style="margin: 0; height: 43px; background-color: transparent !important;">
                <i class="zmdi zmdi-search" style="font-size: 25px;"></i>
            </button>
        </div>
    </form>
    <div class="col-md-4 text-right">
        <p class="subtitulo-inner text-right">Enlaces de Descarga</p>
        <ul class=''>
            <a href="#" data-toggle="tooltip" data-placement="top" title="Versión PDF"><img class="icono-descarga" src='./assets/icons/pdf.png'/></a>
            <a href="#" data-toggle="tooltip" data-placement="top" title="Versión Hojas de Cálculo"><img class="icono-descarga" src='./assets/icons/excel.png'/></a>
        </ul>
    </div>
</div>
<div class="container-fluid">
    <!--<h3 class="text-center all-tittles encabezado-tabla">Listado de devoluciones pendientes</h3>-->
    <div class="outer_div">			
        <div class="table-responsive">
            <table class="table table-hover">
				<?php ///////////   inicio contenido
					$sec = get("sec");
					switch ($sec){
		               case 0: //// pagina inicial
				?>			   
			            <div id="secc">
   							<!--   Mostrar registros de la tabla-->
      					    <div id="titulo2">Registros Encontrados</div>
      						<div id="sec_contedor">
							<table class="table table-hover">
								<thead>
									<tr class="info">
										<td colspan="10" class="nuevo">Nuevo registro <a href="?sec=1"><img src="img/plus1.png" alt="Nuevo" width="20" height="20" /></a></td>
									</tr>
									<tr class="info">
										                    <th style="width:5%">Código</th>
                                        <th style="width:10%">Cédula</th>
										                    <th style="width:10%">Usuario</th>
                                        <th style="width:10%">Nombres</th>
                                        <th style="width:10%">Apellidos</th>
                                        <th style="width:25%">Correo</th>
                                        <th style="width:5%">Zonal</th>
                                        <th style="width:10%">Contraseña</th>
                                        <th style="width:5%">Certificado</th>
										                    <th style="width:10%;" class="text-right">Acciones</th>
									</tr>
								</thead>
									 <?php  
								
									  $desde = get("desde"); // recoger la pagina actual
									  if($desde == 0)
									  $desde = 0; // poner pagina 0 en la primera entada
									  $pagina = 10; // numero de registros por página
									  $des = $desde * $pagina;  // registros de todo el universo 
									 
									  $rspaireg = $asignador->usu_seleccionartodo(); // selecciono todos los registros
									  $registros = mysqli_num_rows($rspaireg);  // selecciono el total de regitros 
									  $rspai = $asignador->usu_seleccionarpaginaasig($des,$pagina); // seleccion los siguientes $pagina(10) resitros desde $des(20)
									  while($row = mysqli_fetch_row($rspai)){ // recorro los registros devueltos y muestro en las filas
									?>
								<tbody>
									  <tr>
										  <td class="number"><?php echo $row[0]?></td>
										  <td><?php echo $row[4]?></td>
                                          <td><?php echo $row[1]?></td>
                                          <td><?php echo $row[5]?></td>
                                          <td><?php echo $row[6]?></td>
                                          <td><?php echo $row[13]?></td>
                                          <td><?php echo $row[12]?></td>
                                          <td><?php echo $row[14]?></td>
                                          <td><?php echo $row[17]?></td>
                                                                                   
										  <td class="text-right">
                          <a href="?sec=2&reg=<?php echo $row[0]?>" class='btn btn-default' title='Editar' ><i class="zmdi zmdi-edit"></i></a>
										      <a href="javascript:;" class='btn btn-default' title='Eliminar' onclick="confirmar('?acc=3&reg=<?php echo $row[0]?>'); return false;"><i class="zmdi zmdi-delete"></i></a>
                         
                                                                                      
									  </tr>
									<?php }// fin while?>
									 <tr><td colspan="6" class="paginas">Páginas <?php $p=1; // paginar
									 for($i=0;$i<$registros;$i=$i+$pagina){
									 $des = $p-1;
									 echo '<a href="?desde='.$des.'">'.$p.'</a>  ' ;
									 $p++;
									 }
									?></td></tr>
								</tbody>
							</table>
		   
       						</div> <!--fin sec_contedor-->
   						</div>              			   
						<?php break;  //////////   fin case 0
						case 1: //////////////  fomrulario para ingreso de datos	
						?>			   
						<div id="secc">
							<div id="titulo2">Ingresar Usuario</div>
							<div id="sec_contedor">
								<form id="nuevo" method="post" action="?acc=1">  
								<div class="help-block with-errors">Usuario</div>
                                <div id="frmcampo"><input class="form-control" name="txtusu" id="txtusu" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                
                                <div class="help-block with-errors">Nombre del Usuario</div>
                                <div id="frmcampo"><input class="form-control" name="txtnom" id="txtnom" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                <div class="help-block with-errors">Apellido del Usuario</div>
                                <div id="frmcampo"><input class="form-control" name="txtape" id="txtape" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                <div class="help-block with-errors">Cédula del Usuario</div>
                                <div id="frmcampo"><input class="form-control" name="txtced" id="txtced" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <span>Género del Usuario <span class="sp-requerido">*</span></span>
                         <select name="selgen" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Selecciona el género">
                          <option value="" disabled="" selected="">Seleccione género</option> 
                         <?php 
                            $area = new clsgenero;
                            $rsarea = $area->gen_seleccionartodo();
                            while($row = $rsarea->fetch_row()){
                                                  
                          ?>
                          <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                          <?php  } // fin while?>
                        </select>
                       
                        
                    </div>
                </div>
                                <div class="help-block with-errors">correo del Usuario</div>
                                <div id="frmcampo"><input class="form-control" name="txtemail" id="txtemail" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                <div class="help-block with-errors">contraseña del Usuario</div>
                                <div id="frmcampo"><input class="form-control" name="txtpass" id="txtpass" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                 <div class="help-block with-errors">Certificado del Usuario</div>
                                <div id="frmcampo"><input class="form-control" name="txtcert" id="txtcert" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                
                                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <span>Escoger la Regional a la que pertenece el asignador <span class="sp-requerido">*</span></span>
                         <select name="selreg" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Selecciona la regional">
                          <option value="" disabled="" selected="">Seleccione regional</option> 
                         <?php 
                            $area = new clsregional;
                            $rsarea = $area->regional_seleccionartodo();
                            while($row = $rsarea->fetch_row()){
                                                  
                          ?>
                          <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                          <?php  } // fin while?>
                        </select>
                       
                        
                    </div>
                </div>
								<div id="frmcampo"><input class='btn btn-default' type="submit" name="button" id="button" value="Guardar" /></div>
								</form>	
							</div> <!-- fin sec_contedor-->
						</div>
						      
						<?php break;  //////   fin case 1
						case 2:   ////////   formulario para modificar
						        $reg = get("reg");
								$asignador->setUsu_id($reg);
						        $rsrol = $asignador->usu_seleccionar_byid();
						        $asignadorfila = mysqli_fetch_array($rsrol);
						?>	
						<div id="secc">
							<div id="titulo2">Editar Usuario</div>
							<div id="sec_contedor">
									<form id="editar" method="post" action="?acc=2&reg=<?php echo $reg?>">  
                                        <div class="help-block with-errors">Cedula</div>
										<div id="frmcampo"><input class="form-control" value="<?php echo $asignadorfila[4]?>" name="txtced" id="txtced" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
										</div>
                                        <div class="help-block with-errors">Nombre</div>
										<div id="frmcampo"><input class="form-control" value="<?php echo $asignadorfila[5]?>" name="txtnom" id="txtnom" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
										</div>
                                        <div class="help-block with-errors">Apellido</div>
                                        <div id="frmcampo"><input class="form-control" value="<?php echo $asignadorfila[6]?>" name="txtape" id="txtape" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
										</div>
                                        <div class="help-block with-errors">Correo</div>
                                        <div id="frmcampo"><input class="form-control" value="<?php echo $asignadorfila[13]?>" name="txtemail" id="txtemail" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
										</div>
                                        <div class="help-block with-errors">Contraseña</div>
                                        <div id="frmcampo"><input class="form-control" value="<?php echo $asignadorfila[14]?>" name="txtpass" id="txtpass" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
										</div>
                                         <div class="help-block with-errors">Certificado</div>
                                        <div id="frmcampo"><input class="form-control" value="<?php echo $asignadorfila[17]?>" name="txtcert" id="txtcert" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
										</div>
										<div id="frmcampo"><input class='btn btn-default' type="submit" name="button" id="button" value="Guardar" /></div>
									</form>	
								
						   </div> <!-- fin sec_contedor-->
						</div><!-- fin secc 2-->			   
						<?php break;  ////////  fin case 2
			      } ///   fin switch
				  
				   /////////////  fin contenido
			?>  
				
				
            </table>
            
        </div>
    </div>
</div>
<?php
include_once("./includes/footer.php"); 
//include_once('./modal/reset_passwd_administrador.php');
?>