
<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Administrador";
$opcion="Reportes";
//require_once ("./adm_include.php"); // incluir las clases
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./modelo/util.php");
include_once("./modelo/clsregional.php");
include_once("./modelo/clsrtrausu.php");


$tramites = new clstrausu;

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            Bienvenido a esta sección, en la cual se muestran los reportes del sistema.
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
<?php 
											$sec= get('sec');
												switch ($sec){ // evaluamos la accion
														case 0: //// pagina inicial
				?>			   
			            <div id="secc">
   							<!--   Mostrar registros de la tabla-->
      					    <div id="titulo2">Registros Encontrados</div>
      						<div id="sec_contedor">
							<table class="table table-hover">
								<thead>
									
									<tr class="info">
										<th style="width:2%">ID</th>
										<th style="width:25%">Trámite</th>
										<th style="width:3%">Codigo</th>
                                        <th style="width:15%">Fecha Ingreso</th>
                                        <th style="width:5%">Estado</th>
                                        <th style="width:20%">Ciudadano</th>
                                        <th style="width:10%">Regional</th>
                                        <th style="width:20%">Estado Tramite</th>
                                        
										
									</tr>
								</thead>
									 <?php  
								
									  $desde = get("desde"); // recoger la pagina actual
									  if($desde == 0)
									  $desde = 0; // poner pagina 0 en la primera entada
									  $pagina = 10; // numero de registros por página
									  $des = $desde * $pagina;  // registros de todo el universo 
									 
									  $rspaireg = $tramites->trus_seleccionartodo(); // selecciono todos los registros
									  $registros = mysqli_num_rows($rspaireg);  // selecciono el total de regitros 
									  $rspai = $tramites->trus_seleccionarpagina($des,$pagina); // seleccion los siguientes $pagina(10) resitros desde $des(20)
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
										  <td><?php echo $row[7]?></td>
                                          
                                                                                   
										  <td class="text-right">
											
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
						case 1: ?>
															<div class="row">
																<div class="form-group col-md-12">
																	<div class="container">
																	<fieldset>
																	<legend>Buscar por Regional </legend>
                                                                    
                                                                    <form id="idform" name="idform" method="post"  data-toggle="validator" class="popup-form" action="?sec=2">
																		<div class="form-group col-md-12">
																				
																			<select name="selzon" id="selzon" class="form-control" required data-error="Por favor selecciona la Zonal" >
																			<option  value="">Seleccione Zonssssal<?php echo $sec?></option> 
																			<?php 
																			$reg = new clsregional;  
																			$rsreg = $reg->regional_seleccionartodo();
																			echo $sec;
																			while($row = mysqli_fetch_row($rsreg)){
																			?>
																			<option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
																			<?php } // fin while?>
																																						
																			</select>
																			<input type="submit" class="btn btn-sm btn-info" name="button" id="button" value="Buscar" />
																			
																			
																			</div> 
																	</form>	
                                                                    </fieldset>
                                                                   
                                                                   </div>
																</div>	
																
																		
					     
					      
															</div>
														<?php break;}?>
<?php
include_once("./includes/footer.php"); 

?>
					   