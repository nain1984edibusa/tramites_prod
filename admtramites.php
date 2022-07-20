
<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Administrador";
$opcion="Trámites";
//require_once ("./adm_include.php"); // incluir las clases

include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./modelo/util.php");
include_once("./modelo/clstramites.php");

//include_once("./modelo/clsgenero.php");




?>
<?php
$tramites = new cl_tramites; // declaro un objeto de la clase de la pagina que gestiono
    ///   acciones sobre registros
	$acc = get("acc"); // recogemos la accion cero por defecto
	switch ($acc){ // evaluamos la accion
	    case 1: // ingresar a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $tramites->setTra_codigo($_POST["txtcod"]);
			   $tramites->setTra_nombre($_POST["txtnom"]);
			   $tramites->setTra_descripcion($_POST["txtdes"]);
			   $tramites->setTra_tiempo($_POST["txttie"]);
			   $tramites->setTra_reqform($_POST["txtreqform"]);
         $tramites->setTra_resultado($_POST["txtres"]);   
         $tramites->setTra_orden(0); 
         $tramites->setTra_ingreso($_POST["txting"]);  
         $tramites->setTra_respuesta($_POST["txtrep"]);                                             
			   $tramites->setTra_estado($_POST["txtest"]);
			  
			   $tramites->tra_insertar(); // inserto registro
			   
		     break;
		case 2: // modificamos a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $reg = get("reg"); // recojo el registro seleccionado
			   $tramites->setTra_id($reg); // cargo en la clase
			   $tramites->setTra_codigo($_POST["txtcod"]);
			   $tramites->setTra_nombre($_POST["txtnom"]);
			   $tramites->setTra_descripcion($_POST["txtdes"]);
			   $tramites->setTra_tiempo($_POST["txttie"]);
			   $tramites->setTra_reqform($_POST["txtreqform"]);
			   $tramites->setTra_estado($_POST["txtest"]);
			   $tramites->tra_actualizar();
		     break;
		case 3: // eliminamos de la base
			   $reg = get("reg"); // recojo el registro seleccionado
			   $tramites->setTra_id($reg); // cargo en la clase
			   $tramites->tra_eliminar();		    
			 break;	 	  
	} // fin switch

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            Bienvenido a esta sección, en la cual se muestra la tabla de Trámites del sistema, en la cuál se pueden ingresar más opciones.
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
<!--<div class="container-fluid">
    <form class="col-md-8" style="" autocomplete="off">
        <div class="group-material">
            <input type="search" style="display: inline-block !important; width: 50%;" class="material-control tooltips-general" placeholder="Buscar trámite" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚ ]{1,50}" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe el código único del trámite">
            <button class="btn" style="margin: 0; height: 43px; background-color: transparent !important;">
                <i class="zmdi zmdi-search" style="font-size: 25px;"></i>
            </button>
        </div>
    </form>
    
</div>-->
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
										<td colspan="9" class="nuevo">Nuevo registro <a href="?sec=1"><img src="img/plus1.png" alt="Nuevo" width="20" height="20" /></a></td>
									</tr>
									<tr class="info">
										<th style="width:2%">ID</th>
										<th style="width:3%">Codigo</th>
                                        <th style="width:15%">Nombre</th>
                                        <th style="width:40%">Descripción</th>
                                        <th style="width:5%">Tiempo</th>
                                        <th style="width:10%">Resultado</th>
                                        <th style="width:5%">ReqForm</th>
                                        <th style="width:10%">Estado</th>
										<th style="width:10%;" class="text-right">Acciones</th>
									</tr>
								</thead>
									 <?php  
								
									  $desde = get("desde"); // recoger la pagina actual
									  if($desde == 0)
									  $desde = 0; // poner pagina 0 en la primera entada
									  $pagina = 10; // numero de registros por página
									  $des = $desde * $pagina;  // registros de todo el universo 
									 
									  $rspaireg = $tramites->tra_seleccionartodo(); // selecciono todos los registros
									  $registros = mysqli_num_rows($rspaireg);  // selecciono el total de regitros 
									  $rspai = $tramites->tra_seleccionarpagina($des,$pagina); // seleccion los siguientes $pagina(10) resitros desde $des(20)
									  while($row = mysqli_fetch_row($rspai)){ // recorro los registros devueltos y muestro en las filas
									?>
								<tbody>
									  <tr>
										  <td class="number"><?php echo $row[0]?></td>
										  <td><?php echo $row[1]?></td>
                                          <td><?php echo $row[2]?></td>
                                          <td><?php echo $row[3]?></td>
                                          <td><?php echo $row[4]?></td>
                                          <td><?php echo $row[5]?></td>
                                          <td><?php echo $row[6]?></td>
                                          <td><?php echo $row[10]?></td>
                                                                                   
										  <td class="text-right">
											<a href="?sec=2&reg=<?php echo $row[0]?>" class='btn btn-default' title='Editar' ><i class="zmdi zmdi-edit"></i></a>
										    <a href="javascript:;" class='btn btn-default' title='Eliminar' onclick="confirmar('?acc=3&reg=<?php echo $row[0]?>'); return false;"><i class="zmdi zmdi-delete"></i></a>
									  </tr>
									<?php }// fin while?>
									 <tr><td colspan="9" class="paginas">Páginas <?php $p=1; // paginar
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
							<div id="titulo2">Ingresar Trámite</div>
							<div id="sec_contedor">
								<form id="nuevo" method="post" action="?acc=1">  
								<div class="help-block with-errors">Codigo</div>
                                <div id="frmcampo"><input class="form-control" name="txtcod" id="txtcod" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                
                                <div class="help-block with-errors">Nombre del Trámite</div>
                                <div id="frmcampo"><input class="form-control" name="txtnom" id="txtnom" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                <div class="help-block with-errors">Descripción</div>
                                <div id="frmcampo"><input class="form-control" name="txtdes" id="txtdes" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                <div class="help-block with-errors">Tiempo</div>
                                <div id="frmcampo"><input class="form-control" name="txttie" id="txttie" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                <div class="help-block with-errors">Resultado</div>
                                <div id="frmcampo"><input class="form-control" name="txtres" id="txtres" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                <div class="help-block with-errors">ReqForm</div>
                                <div id="frmcampo"><input class="form-control" name="txtreqform" id="txtreqform" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                <div class="help-block with-errors">Ingreso</div>
                                <div id="frmcampo"><input class="form-control" name="txting" id="txting" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                <div class="help-block with-errors">Respuesta</div>
                                <div id="frmcampo"><input class="form-control" name="txtrep" id="txtrep" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                <div class="help-block with-errors">Estado</div>
                                <div id="frmcampo"><input class="form-control" name="txtest" id="txtest" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                        
                    </div>
                </div>
                                
								<div id="frmcampo"><input class='btn btn-default' type="submit" name="button" id="button" value="Guardar" /></div>
								</form>	
							</div> <!-- fin sec_contedor-->
						</div>
						      
						<?php break;  //////   fin case 1
						case 2:   ////////   formulario para modificar
						        $reg = get("reg");
								$tramites->setTra_id($reg);
						        $rsrol = $tramites->tra_seleccionar_byid();
						        $tramitesfila = mysqli_fetch_array($rsrol);
						?>	
						<div id="secc">
							<div id="titulo2">Editar Trámite</div>
							<div id="sec_contedor">
									<form id="editar" method="post" action="?acc=2&reg=<?php echo $reg?>">  
                                        <div class="help-block with-errors">Código del Trámite</div>
										<div id="frmcampo"><input class="form-control" value="<?php echo $tramitesfila[1]?>" name="txtcod" id="txtcod" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
										</div>
                                        <div class="help-block with-errors">Nombre del Trámite</div>
                                        <div id="frmcampo"><input class="form-control" value="<?php echo $tramitesfila[2]?>" name="txtnom" id="txtnom" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                		<div class="help-block with-errors">Descripción del Trámite</div>
                               			<div id="frmcampo"><input class="form-control" value="<?php echo $tramitesfila[3]?>" name="txtdes" id="txtdes" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                		<div class="help-block with-errors">Tiempo del Trámite</div>
                               			<div id="frmcampo"><input class="form-control" value="<?php echo $tramitesfila[4]?>" name="txttie" id="txttie" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                	<div class="help-block with-errors">Resultado</div>
                                		<div id="frmcampo"><input class="form-control" value="<?php echo $tramitesfila[5]?>" name="txtreqform" id="txtreqform" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                		<div class="help-block with-errors">ReqForm del Trámite</div>
                                		<div id="frmcampo"><input class="form-control" value="<?php echo $tramitesfila[6]?>" name="txtreqform" id="txtreqform" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
								</div>
                                		<div class="help-block with-errors">Estado del Trámite</div>
                                		<div id="frmcampo"><input class="form-control" value="<?php echo $tramitesfila[10]?>" name="txtest" id="txtest" type="text" autofocus required style="text-transform:uppercase;" onblur="javascript:this.value=this.value.toUpperCase();" >
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