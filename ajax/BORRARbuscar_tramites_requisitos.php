<?php

	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	require_once ("../includes/funciones.php");
        //date_default_timezone_set('America/Guayaquil');
	$conexiones=array("con1","con2","con3");
        $bds=array("smart_syscatleia_comercial","smart_syscatleia_comercial2","smart_syscatleia_comercial3");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
            $saldo_efectivo=0;
            $saldo_tarjetad=0;
            $saldo_tarjetac=0;
            $saldo_dineroe=0;
            $saldo_otros=0;
            $saldo_compd=0;
            for($i=0; $i<count($conexiones);$i++):
                //$sql=mysqli_query($$conexiones[$i], "select * from ".$bds[$i].".products, smart_syscatleia_base.tmp where ".$bds[$i].".products.id_producto=smart_syscatleia_base.tmp.id_producto and smart_syscatleia_base.tmp.session_id='".$session_id."' and smart_syscatleia_base.tmp.conexion='".$conexiones[$i]."'");
                $cod_caja=intval($_GET['id']);
                $selectcajafecha=mysqli_query($$_SESSION['bd_comercial'],"select fecha, id_vendedor from caja where id_caja='".$cod_caja."'"); 
                $selectcfecha=  mysqli_fetch_array($selectcajafecha);
                //AQUI HAY QUE SUMAR LAS VENTAS + saldo de apertura y modificar el valor del saldo de cierre;
		$sel_efec='select sum(fp_efectivo) as efectivo from '.$bds[$i].'.movimientos where DATE(fecha_movimiento)="'.$selectcfecha["fecha"].'" AND anulado=0 and id_vendedor="'.$selectcfecha["id_vendedor"].'"';
                //echo $sel_efec;
                $ressel_efe=mysqli_query($$conexiones[$i],$sel_efec);
		$rowsel_efe=mysqli_fetch_array($ressel_efe);
                $sel_tard='select sum(fp_tarjetadeb) as tarjetadeb from '.$bds[$i].'.movimientos where DATE(fecha_movimiento)="'.$selectcfecha["fecha"].'" AND anulado=0 and id_vendedor="'.$selectcfecha["id_vendedor"].'"';
		$ressel_tard=mysqli_query($$conexiones[$i],$sel_tard);
		$rowsel_tard=mysqli_fetch_array($ressel_tard);
                $sel_tarc='select sum(fp_tarjetacre) as tarjetacre from '.$bds[$i].'.movimientos where DATE(fecha_movimiento)="'.$selectcfecha["fecha"].'" AND anulado=0 and id_vendedor="'.$selectcfecha["id_vendedor"].'"';
		$ressel_tarc=mysqli_query($$conexiones[$i],$sel_tarc);
		$rowsel_tarc=mysqli_fetch_array($ressel_tarc);
                $sel_dine='select sum(fp_dineroe) as dineroe from '.$bds[$i].'.movimientos where DATE(fecha_movimiento)="'.$selectcfecha["fecha"].'" AND anulado=0 and id_vendedor="'.$selectcfecha["id_vendedor"].'"';
		$ressel_dine=mysqli_query($$conexiones[$i],$sel_dine);
		$rowsel_dine=mysqli_fetch_array($ressel_dine);
                $sel_otro='select sum(fp_otros) as otros from '.$bds[$i].'.movimientos where DATE(fecha_movimiento)="'.$selectcfecha["fecha"].'" AND anulado=0 and id_vendedor="'.$selectcfecha["id_vendedor"].'"';
		$ressel_otro=mysqli_query($$conexiones[$i],$sel_otro);
		$rowsel_otro=mysqli_fetch_array($ressel_otro);
                $sel_comp='select sum(fp_compdeudas) as compdeudas from '.$bds[$i].'.movimientos where DATE(fecha_movimiento)="'.$selectcfecha["fecha"].'" AND anulado=0 and id_vendedor="'.$selectcfecha["id_vendedor"].'"';
		$ressel_comp=mysqli_query($$conexiones[$i],$sel_comp);
		$rowsel_comp=mysqli_fetch_array($ressel_comp);
                /*$sel_cred='select sum(fp_creditodirecto) as creditodirecto from '.$bds[$i].'.movimientos where DATE(fecha_movimiento)="'.$selectcfecha["fecha"].'" and anulado=0 and id_vendedor="'.$selectcfecha["id_vendedor"].'"';
		$ressel_cred=mysqli_query($$conexiones[$i],$sel_cred);
		$rowsel_cred=mysqli_fetch_array($ressel_cred);*/
                //AQUI PAGOS_MOVIMIENTOS
                $sel_efec='select sum(fp_efectivo) as efectivo from '.$bds[$i].'.pagos_movimientos where DATE(fecha_pagosmov)="'.$selectcfecha["fecha"].'" AND vendedor="'.$selectcfecha["id_vendedor"].'"';
                $pmressel_efe=mysqli_query($$conexiones[$i],$sel_efec);
		$pmrowsel_efe=mysqli_fetch_array($pmressel_efe);
                $sel_tard='select sum(fp_tarjetadeb) as tarjetadeb from '.$bds[$i].'.pagos_movimientos where DATE(fecha_pagosmov)="'.$selectcfecha["fecha"].'" AND vendedor="'.$selectcfecha["id_vendedor"].'"';
		$pmressel_tard=mysqli_query($$conexiones[$i],$sel_tard);
		$pmrowsel_tard=mysqli_fetch_array($pmressel_tard);
                $sel_tarc='select sum(fp_tarjetacre) as tarjetacre from '.$bds[$i].'.pagos_movimientos where DATE(fecha_pagosmov)="'.$selectcfecha["fecha"].'" AND vendedor="'.$selectcfecha["id_vendedor"].'"';
		$pmressel_tarc=mysqli_query($$conexiones[$i],$sel_tarc);
		$pmrowsel_tarc=mysqli_fetch_array($pmressel_tarc);
                $sel_dine='select sum(fp_dineroe) as dineroe from '.$bds[$i].'.pagos_movimientos where DATE(fecha_pagosmov)="'.$selectcfecha["fecha"].'" AND vendedor="'.$selectcfecha["id_vendedor"].'"';
		$pmressel_dine=mysqli_query($$conexiones[$i],$sel_dine);
		$pmrowsel_dine=mysqli_fetch_array($pmressel_dine);
                $sel_otro='select sum(fp_otros) as otros from '.$bds[$i].'.pagos_movimientos where DATE(fecha_pagosmov)="'.$selectcfecha["fecha"].'" AND vendedor="'.$selectcfecha["id_vendedor"].'"';
		$pmressel_otro=mysqli_query($$conexiones[$i],$sel_otro);
		$pmrowsel_otro=mysqli_fetch_array($pmressel_otro);
                $sel_comp='select sum(fp_compdeudas) as compdeudas from '.$bds[$i].'.pagos_movimientos where DATE(fecha_pagosmov)="'.$selectcfecha["fecha"].'" AND vendedor="'.$selectcfecha["id_vendedor"].'"';
		$pmressel_comp=mysqli_query($$conexiones[$i],$sel_comp);
		$pmrowsel_comp=mysqli_fetch_array($pmressel_comp);
                //fin pagos mov
                $upd1="";
                if($rowsel_efe["efectivo"]==NULL){
                    $saldo_efectivo+=0;
                }else{
                    $saldo_efectivo+=number_format($rowsel_efe["efectivo"],2,'.','');
                } 
                if($rowsel_tard["tarjetadeb"]==NULL){
                    $saldo_tarjetad+=0;
                }else{
                    $saldo_tarjetad+=number_format($rowsel_tard["tarjetadeb"],2,'.','');
                }
                if($rowsel_tarc["tarjetacre"]==NULL){
                    $saldo_tarjetac+=0;
                }else{
                    $saldo_tarjetac+=number_format($rowsel_tarc["tarjetacre"],2,'.','');
                }
                if($rowsel_dine["dineroe"]==NULL){
                    $saldo_dineroe+=0;
                }else{
                    $saldo_dineroe+=number_format($rowsel_dine["dineroe"],2,'.','');
                }
                if($rowsel_otro["otros"]==NULL){
                    $saldo_otros+=0;
                }else{
                    $saldo_otros+=number_format($rowsel_otro["otros"],2,'.','');
                }
                if($rowsel_comp["compdeudas"]==NULL){
                    $saldo_compd+=0;
                }else{
                    $saldo_compd+=number_format($rowsel_comp["compdeudas"],2,'.','');
                }
                //
                if($pmrowsel_efe["efectivo"]==NULL){
                    $saldo_efectivo+=0;
                }else{
                    $saldo_efectivo+=number_format($pmrowsel_efe["efectivo"],2,'.','');
                } 
                if($pmrowsel_tard["tarjetadeb"]==NULL){
                    $saldo_tarjetad+=0;
                }else{
                    $saldo_tarjetad+=number_format($pmrowsel_tard["tarjetadeb"],2,'.','');
                }
                if($pmrowsel_tarc["tarjetacre"]==NULL){
                    $saldo_tarjetac+=0;
                }else{
                    $saldo_tarjetac+=number_format($pmrowsel_tarc["tarjetacre"],2,'.','');
                }
                if($pmrowsel_dine["dineroe"]==NULL){
                    $saldo_dineroe+=0;
                }else{
                    $saldo_dineroe+=number_format($pmrowsel_dine["dineroe"],2,'.','');
                }
                if($pmrowsel_otro["otros"]==NULL){
                    $saldo_otros+=0;
                }else{
                    $saldo_otros+=number_format($pmrowsel_otro["otros"],2,'.','');
                }
                if($pmrowsel_comp["compdeudas"]==NULL){
                    $saldo_compd+=0;
                }else{
                    $saldo_compd+=number_format($pmrowsel_comp["compdeudas"],2,'.','');
                }
            endfor;
                $selret="select sum(monto) as egresos from movimientos_caja where caja='".$cod_caja."' and tipo='EGRESO'";
                $resselret=  mysqli_query($$_SESSION['bd_comercial'], $selret);
                $rowselret=  mysqli_fetch_array($resselret);
                $seldep="select sum(monto) as ingresos from movimientos_caja where caja='".$cod_caja."' and tipo='INGRESO'";
                $resseldep=  mysqli_query($$_SESSION['bd_comercial'], $seldep);
                $rowseldep=  mysqli_fetch_array($resseldep);
                //$saldo_cierre=$saldo_efectivo+$saldo_tarjetadc+$saldo_dineroe+$saldo_otros+$saldo_creditodirecto+$rowselret["egresos"]+$rowseldep["ingresos"];
                $upd1="update caja set estado_caja=0, saldo_ventas_efectivo=".number_format($saldo_efectivo,2,'.','').", saldo_ventas_tarjetas=".number_format($saldo_tarjetad+$saldo_tarjetac,2,'.','').", saldo_ventas_dineroe=".number_format($saldo_dineroe,2,'.','').", saldo_ventas_comp=".number_format($saldo_compd,2,'.','').", saldo_ventas_otros=".number_format($saldo_otros,2,'.','').", ingresos_caja='".number_format($rowseldep["ingresos"],2,'.','')."', egresos_caja=".number_format($rowselret["egresos"],2,'.','')." where id_caja='".$cod_caja."'";
                if ($update1=mysqli_query($$_SESSION['bd_comercial'],$upd1)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Caja cerrada exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo cerrar la caja
			</div>
			<?php
			
		}
                exit();
	}
        if (isset($_GET['ida'])){
		$cod_caja=intval($_GET['ida']);
                $upd1="update caja set estado_caja=1, saldo_ventas_efectivo='0.00',saldo_ventas_tarjetas='0.00',saldo_ventas_dineroe='0.00',saldo_ventas_comp='0.00',saldo_ventas_otros='0.00', ingresos_caja='0.00', egresos_caja='0.00' where id_caja='".$cod_caja."'";
                //echo $upd1;
                //exit();
                if ($update1=mysqli_query($$_SESSION['bd_comercial'],$upd1)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Caja abierta exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo abrir la caja
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         //$q = mysqli_real_escape_string($$_SESSION['bd_comercial'],(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $sTable = " caja INNER JOIN users ON caja.id_vendedor=users.user_id ";
                 $sWhere="";
                 if($_SESSION['tipo_usuario']!="ADM"){
		 $sWhere = " WHERE id_vendedor='".$_SESSION["user_id"]."' ";
                 }
		 //$sWhere.=" WHERE movimientos.id_cliente=clientes.id_cliente and movimientos.id_vendedor=users.user_id";
		/*if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (clientes.nombre_cliente like '%$q%' or movimientos.numero_factura like '%$q%')";
			
		}*/
		
		$sWhere.=" order by fecha desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($$_SESSION['bd_comercial'], "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './ventas_caja.php';
		//main query to fetch the data
		$sql="SELECT caja.*, users.firstname, users.lastname FROM  $sTable $sWhere LIMIT $offset,$per_page";
                //echo $sql;
		$query = mysqli_query($$_SESSION['bd_comercial'], $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($$_SESSION['bd_comercial']);
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
                                        <th>#</th>
					<th>Fecha</th>
                                        <th>Usuario</th>
					<th class='text-right'>Saldo Apertura</th>
					<th class='text-right'>Ventas Efectivo</th>
                                        <th class='text-right'>Ventas Tarjeta C/D.</th>
                                        <th class='text-right'>Ventas Dinero E.</th>
                                        <th class='text-right'>Ventas Otros</th>
                                        <th class='text-right'>Ingresos Caja</th>
                                        <th class='text-right'>Egresos Caja</th>
                                        <th class='text-right'>Saldo Cierre</th>
                                        <th class='text-right'>Comp Deudas</th>
					<th>Estado</th>
                                        <th class='text-right' style="width:15%;">Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
                                            $id_caja=$row['id_caja'];
                                            $fecha=date("d/m/Y",strtotime($row['fecha']));
                                            $saldo_apertura=$row['saldo_apertura'];
                                            $saldo_ventas_efectivo=$row['saldo_ventas_efectivo'];
                                            $saldo_ventas_tarjetas=$row['saldo_ventas_tarjetas'];
                                            $saldo_ventas_dineroe=$row['saldo_ventas_dineroe'];
                                            $saldo_ventas_comp=$row['saldo_ventas_comp'];
                                            $nombre_usuario=$row['lastname']." ".$row['firstname'];
                                            //$saldo_ventas_creditod=$row['saldo_ventas_creditod'];
                                            //$saldo_ventas_separados=$row['saldo_ventas_separados'];
                                            $saldo_ventas_otros=$row['saldo_ventas_otros'];
                                            $ingresos_caja=$row['ingresos_caja'];
                                            $egresos_caja=$row['egresos_caja'];
                                            $saldo_cierre=$saldo_apertura+$saldo_ventas_efectivo+$saldo_ventas_tarjetas+$saldo_ventas_dineroe+$saldo_ventas_otros+$ingresos_caja-$egresos_caja;
                                            //$pendiente_cobro=$row['pendiente_cobro'];
                                            $estado_caja=$row['estado_caja'];
                                            if ($estado_caja==1){$text_estado="Abierta";$label_class='label-success';}
                                            else{$text_estado="Cerrada";$label_class='label-warning';}
					?>
					<tr>
                                                <td><?php echo $id_caja; ?></td>
						<td><?php echo $fecha; ?></td>
                                                <td><?php echo $nombre_usuario; ?></td>
						<td class='text-right'><?php echo number_format ($saldo_apertura,2,'.',''); ?></td>
                                                <td class='text-right'><?php echo number_format ($saldo_ventas_efectivo,2,'.',''); ?></td>
                                                <td class='text-right'><?php echo number_format ($saldo_ventas_tarjetas,2,'.',''); ?></td>
                                                <td class='text-right'><?php echo number_format ($saldo_ventas_dineroe,2,'.',''); ?></td>
                                                <td class='text-right'><?php echo number_format ($saldo_ventas_otros,2,'.',''); ?></td>
                                                <td class='text-right'><?php echo number_format ($ingresos_caja,2,'.',''); ?></td>
                                                <td class='text-right'>(-) <?php echo number_format ($egresos_caja,2,'.',''); ?></td>
                                                <td class='text-right'><?php echo number_format ($saldo_cierre,2,'.',''); ?></td>
                                                <td class='text-right'>NC <?php echo number_format ($saldo_ventas_comp,2,'.',''); ?></td>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>					
                                                <td class="text-right">
                                                <?php if($estado_caja==1){?>
                                                    <a href="#" class='btn btn-default' title='Cerrar caja' onclick="modificar('<?php echo $id_caja; ?>');" onblur="recargar_padre();"><i class="glyphicon glyphicon-lock"></i> </a>
                                                    <?php if($_SESSION['tipo_usuario']!="ADM"){?>
                                                    <a href="#" class='btn btn-default' title='Movimientos de caja' onclick="reiniciar_formulario_ec();obtener_datos('<?php echo $id_caja; ?>');" data-toggle="modal" data-target="#registrarEgresoCaja"><i class="glyphicon glyphicon-share-alt"></i> </a>
                                                    <?php } ?>
                                                    <a href="ventas_editarcajas.php?idcaja=<?php echo $id_caja;?>" class='btn btn-default' title='Gestionar movimientos caja'><i class="glyphicon glyphicon-edit"></i> </a>
                                                <?php }else{?>
                                                <?php if(/*($row['fecha']==date('Y-m-d'))and*/($_SESSION['tipo_usuario']=="ADM")){?>    
                                                    <a href="#" class='btn btn-default' title='Abrir caja' onclick="abrircaja('<?php echo $id_caja; ?>');" onblur="recargar_padre();"><i class="glyphicon glyphicon-off"></i> </a>
                                                <?php }?> 
                                                <?php };?>
                                                    <a href="#" class='btn btn-default' title='Descargar reporte' onclick="imprimir_reporte('<?php echo $id_caja;?>');"><i class="glyphicon glyphicon-download"></i></a> 
                                                
                                                </td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=14><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>