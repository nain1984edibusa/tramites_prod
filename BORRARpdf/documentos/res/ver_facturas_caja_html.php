<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td,th   { vertical-align: top; height:10px; padding: 3pt; }
.superior td, .superior th{ height: 10px; padding:3pt;}
.etiqueta{
    font-size: 9pt;
    font-weight: bold;
}
.txt_invisible{
    color:white;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
p.formas_pago{
    width:100%; 
    margin:-7px 0px 0px 45px; 
    font-size:8pt;
}
h3{
    color: #006699;
    text-align: center;
}
hr{
    color: #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
.textoexpecifico{
    font-size: 7pt;
    color: #009999;
    float:left;
    display: block;
}
.cancelado{
    color: #669900;  
    font-weight: bold;
}
.nocancelado{
    color:#ff6600;
    font-weight: bold;
}
-->
</style>
<page backtop='38mm' backbottom='20mm' backleft='30mm' backright='25mm' footer='page' >
    <?php 
            $sql_caja=mysqli_query($$_SESSION['bd_comercial'],"select caja.*, users.firstname, users.lastname from caja, users where id_caja='$caja' and caja.id_vendedor=users.user_id"); //
            $rw_caja=mysqli_fetch_array($sql_caja);
    ?>
  <page_footer>
    <!--[[page_cu]]/[[page_nb]]-->
  </page_footer>
    <page_header>
        <img src="../../img/encabezado_landscape.jpg">
        <h3>CIERRE DIARIO DE CAJA</h3>
    </page_header>
    <table class="superior" cellspacing="0" style="margin-left:10%;width: 100%;font-size: 10pt; color: #333333;">
        <tr>
            <td style="width:50%; text-align:left;"><span class="etiqueta">FECHA:&nbsp;&nbsp;</span><span><?php echo $rw_caja["fecha"];?></span></td>
            <td style="width:50%; text-align:left;"><span class="etiqueta">USUARIO CAJA:&nbsp;&nbsp;</span><span><?php echo $rw_caja['firstname']." ".$rw_caja['lastname'];?></span></td>
        </tr>
    </table>
    <hr>
    <H4>VENTAS / FACTURACION</H4>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt; margin-top:14px;">
        <tr style="background-color:grey; color:white; font-size: 10pt">
            <th style="width: 10%;text-align: center"># FACTURA</th>
            <th style="width: 10%;text-align: right">TOTAL</th>
            <th style="width: 10%;text-align: right">EFEC</th>
            <th style="width: 10%;text-align: right">TARC</th>
            <th style="width: 10%;text-align: right">TARD</th>
            <th style="width: 5%;text-align: center">Detalle</th>
            <th style="width: 10%;text-align: right">DINE</th>
            <th style="width: 10%;text-align: right">OTROS</th>
            <th style="width: 5%;text-align: center">Detalle</th>
            <th style="width: 10%;text-align: right">COMP</th>
            <th style="width: 5%;text-align: center">Detalle</th>
            <th style="width: 5%;text-align: right">CRED</th>
            
        </tr>
<?php
$conexiones=array("con1","con2","con3");
$pref=array(ESTABLECIMIENTO_1."-".PUNTOEMISION_1."-",ESTABLECIMIENTO_2."-".PUNTOEMISION_2."-",ESTABLECIMIENTO_3."-".PUNTOEMISION_3."-");
    $ttotal_efectivo=0;
    $ttotal_tarjetasc=0;
    $ttotal_tarjetasd=0;
    $ttotal_dineroe=0;  
    $ttotal_otros=0; 
    $ttotal_comp=0;
    $ttotal_credito=0;
    $ttotal_ventas=0;
for($i=0; $i<count($conexiones);$i++):
    $sql_movimientos=mysqli_query($$conexiones[$i],"select * from movimientos where (DATE(fecha_movimiento)='".$rw_caja["fecha"]."') and proceso='VEN' and id_vendedor='".$rw_caja["id_vendedor"]."' and anulado=0");
    //echo "select * from movimientos where (DATE(fecha_movimiento)='".$rw_caja["fecha"]."') and proceso='VEN' and id_vendedor='".$rw_caja["id_vendedor"]."' and anulado=0";
    $total_efectivo=0;
    $total_tarjetasc=0;
    $total_tarjetasd=0;
    $total_dineroe=0;  
    $total_otros=0; 
    $total_comp=0;
    $total_credito=0;
    $total_ventas=0;
    while ($row=mysqli_fetch_array($sql_movimientos))
    {
        $total_efectivo+=verificar_vacio($row["fp_efectivo"]);
        $total_tarjetasc+=verificar_vacio($row["fp_tarjetacre"]);    
        $total_tarjetasd+=verificar_vacio($row["fp_tarjetadeb"]); 
        $total_dineroe+=verificar_vacio($row["fp_dineroe"]);
        $total_otros+=verificar_vacio($row["fp_otros"]);
        $total_comp+=verificar_vacio($row["fp_compdeudas"]);
        $total_credito+=verificar_vacio($row["fp_creditodirecto"]);
        $total_ventas+=verificar_vacio($row["total_venta"]);
	?>
        <tr>
            <td style="width: 10%; text-align: center"><?php echo $pref[$i].$row["numero_factura"];?></td>
            <td style="width: 10%; text-align: right"><?php echo $row["total_venta"];?></td>
            <td style="width: 10%; text-align: right"><?php echo $row["fp_efectivo"];?></td>
            <td style="width: 10%; text-align: right"><?php echo $row["fp_tarjetacre"];?></td>
            <td style="width: 10%; text-align: right"><?php echo $row["fp_tarjetadeb"];?></td>
            <td style="width: 5%; text-align: right"><?php echo $row["dfp_tarjetacre"].$row["dfp_tarjetadeb"];?></td>
            <td style="width: 10%; text-align: right"><?php echo $row["fp_dineroe"];?></td>
            <td style="width: 10%; text-align: right"><?php echo $row["fp_otros"];?></td>
            <td style="width: 5%; text-align: right"><?php echo $row["dfp_otros"]?></td>
            <td style="width: 10%; text-align: right"><?php echo $row["fp_compdeudas"];?></td>
            <td style="width: 5%; text-align: right"><?php echo $row["dfp_compdeudas"];?></td>
            <td style="width: 5%; text-align: right"><?php echo $row["fp_creditodirecto"];?></td>
        </tr>
<?php
    }
        $ttotal_efectivo+=$total_efectivo;
        $ttotal_tarjetasc+=$total_tarjetasc;    
        $ttotal_tarjetasd+=$total_tarjetasd; 
        $ttotal_dineroe+=$total_dineroe;
        $ttotal_otros+=$total_otros;
        $ttotal_comp+=$total_comp;
        $ttotal_credito+=$total_credito;
        $ttotal_ventas+=$total_ventas;
?>
    <tr style="background-color: #bdc3c7;">
        <td style="width: 10%; text-align: center">TOTAL ESTAB.</td>
        <td style="width: 10%; text-align: right"><?php echo number_format($total_ventas,2,'.','');?></td>
        <td style="width: 10%; text-align: right"><?php echo number_format($total_efectivo,2,'.','');?></td>
        <td style="width: 10%; text-align: right"><?php echo number_format($total_tarjetasc,2,'.','');?></td>
        <td style="width: 10%; text-align: right"><?php echo number_format($total_tarjetasd,2,'.','');?></td>
        <td style="width: 5%;"></td>
        <td style="width: 10%; text-align: right"><?php echo number_format($total_dineroe,2,'.','');?></td>
        <td style="width: 10%; text-align: right"><?php echo number_format($total_otros,2,'.','');?></td>
        <td style="width: 5%;"></td>
        <td style="width: 10%; text-align: right"><?php echo number_format($total_comp,2,'.','');?></td>
        <td style="width: 5%;"></td>
        <td style="width: 5%; text-align: right"><?php echo number_format($total_credito,2,'.','');?></td>
    </tr>
<?php
endfor;
$total_cobrado=$ttotal_efectivo;
?>
        <tr style="color:#006699">
            <th style="text-align: right; padding-top: 5px; color: #006699;">TOTALES</th>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"><?php echo number_format($ttotal_ventas,2,'.','');?></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"><?php echo number_format($ttotal_efectivo,2,'.','');?></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"><?php echo number_format($ttotal_tarjetasc,2,'.','');?></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"><?php echo number_format($ttotal_tarjetasd,2,'.','');?></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"><?php echo number_format($ttotal_dineroe,2,'.','');?></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"><?php echo number_format($ttotal_otros,2,'.','');?></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"><?php echo number_format($ttotal_comp,2,'.','');?></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"><?php echo number_format($ttotal_credito,2,'.','');?></td>
        </tr>
    </table>
    <H4>COMPROBANTES ANULADOS</H4>
        <table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt; margin-top:14px;">
        <tr style="background-color:grey; color:white; font-size: 10pt">
            <th style="width: 15%;text-align: center"># FACTURA</th>
            <th style="width: 15%;text-align: center">Total Venta</th>
        </tr>
<?php
	$total_anulados=0;
    for($i=0; $i<count($conexiones);$i++):
    $sql_movimientos=mysqli_query($$conexiones[$i],"select * from movimientos where (DATE(fecha_movimiento)='".$rw_caja["fecha"]."') and proceso='VEN' and id_vendedor='".$rw_caja["id_vendedor"]."' and anulado=1");
	if(mysqli_num_rows($sql_movimientos)>0){
        while ($row=mysqli_fetch_array($sql_movimientos))
        {
			$total_anulados+=floatval($row["total_venta"]);
			//echo "anulados t".$total_anulados;
            ?>
            <tr>
                <td style="width: 15%; text-align: center"><?php echo $pref[$i].$row["numero_factura"];?></td>
                <td style="width: 10%; text-align: right"><?php echo $row["total_venta"];?></td>
            </tr>
<?php 
        }
    }else{
?>
            <tr><td colspan='2'>NINGUN COMPROBANTE ANULADO PARA <?php echo trim($pref[$i],'-') ?></td></tr>
<?php
    }
    endfor;
?>  
        </table>      
    <H4>VENTAS / CTAS X COBRAR Y SEPARADOS</H4>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt; margin-top:14px;">
        <tr style="background-color:grey; color:white; font-size: 10pt">
            <th style="width: 15%;text-align: center"># FACTURA</th>
            <th style="width: 10%;text-align: right">EFEC</th>
            <th style="width: 10%;text-align: right">TARC</th>
            <th style="width: 10%;text-align: right">TARD</th>
            <th style="width: 5%;text-align: center">Detalle</th>
            <th style="width: 10%;text-align: right">DINE</th>
            <th style="width: 10%;text-align: right">OTROS</th>
            <th style="width: 5%;text-align: center">Detalle</th>
            <th style="width: 10%;text-align: right">COMP</th>
            <th style="width: 5%;text-align: center">Detalle</th>
        </tr>
<?php
function verificar_vacio($valor){
    if($valor=="")
    {
        return 0;
    }else{
        return floatval($valor);
    }
}
$conexiones=array("con1","con2","con3");
$vtotal_efectivo=0;
$vtotal_tarjetasc=0;
$vtotal_tarjetasd=0;
$vtotal_dineroe=0;  
$vtotal_otros=0; 
$vtotal_comp=0;
$vtotal_ventas=0;
$pref=array(ESTABLECIMIENTO_1."-".PUNTOEMISION_1."-",ESTABLECIMIENTO_2."-".PUNTOEMISION_2."-",ESTABLECIMIENTO_3."-".PUNTOEMISION_3."-");
    /*$ttotal_efectivo=0;
    $ttotal_tarjetasc=0;
    $ttotal_tarjetasd=0;
    $ttotal_dineroe=0;  
    $ttotal_otros=0; 
    $ttotal_comp=0;*/
for($i=0; $i<count($conexiones);$i++):
    $sql_movimientos=mysqli_query($$conexiones[$i],"select pagos_movimientos.*,movimientos.numero_factura from pagos_movimientos INNER JOIN movimientos ON movimientos.id_movimiento=pagos_movimientos.id_movimiento where (DATE(fecha_pagosmov)='".$rw_caja["fecha"]."') and vendedor='".$rw_caja["id_vendedor"]."'");
    //echo "select pagos_movimientos.*,movimientos.numero_factura from pagos_movimientos INNER JOIN movimientos ON movimientos.id_movimiento=pagos_movimiento.id_movimiento where (DATE(fecha_pagosmov)='".$rw_caja["fecha"]."') and vendedor='".$rw_caja["id_vendedor"]."'";
    $total_efectivo=0;
    $total_tarjetasc=0;
    $total_tarjetasd=0;
    $total_dineroe=0;  
    $total_otros=0; 
    $total_comp=0;
    while ($row=mysqli_fetch_array($sql_movimientos))
    {
        $total_efectivo+=verificar_vacio($row["fp_efectivo"]);
        $total_tarjetasc+=verificar_vacio($row["fp_tarjetacre"]);    
        $total_tarjetasd+=verificar_vacio($row["fp_tarjetadeb"]); 
        $total_dineroe+=verificar_vacio($row["fp_dineroe"]);
        $total_otros+=verificar_vacio($row["fp_otros"]);
        $total_comp+=verificar_vacio($row["fp_compdeudas"]);
	?>
        <tr>
            <td style="width: 15%; text-align: center"><?php echo $pref[$i].$row["numero_factura"];?></td>
            <td style="width: 10%; text-align: right"><?php echo $row["fp_efectivo"];?></td>
            <td style="width: 10%; text-align: right"><?php echo $row["fp_tarjetacre"];?></td>
            <td style="width: 10%; text-align: right"><?php echo $row["fp_tarjetadeb"];?></td>
            <td style="width: 5%; text-align: right"><?php echo $row["dfp_tarjetacre"].$row["dfp_tarjetadeb"];?></td>
            <td style="width: 10%; text-align: right"><?php echo $row["fp_dineroe"];?></td>
            <td style="width: 10%; text-align: right"><?php echo $row["fp_otros"];?></td>
            <td style="width: 5%; text-align: right"><?php echo $row["dfp_otros"]?></td>
            <td style="width: 10%; text-align: right"><?php echo $row["fp_compdeudas"];?></td>
            <td style="width: 5%; text-align: right"><?php echo $row["dfp_compdeudas"];?></td>
        </tr>
<?php
    }
        $vtotal_efectivo+=$total_efectivo;
        $vtotal_tarjetasc+=$total_tarjetasc;    
        $vtotal_tarjetasd+=$total_tarjetasd; 
        $vtotal_dineroe+=$total_dineroe;
        $vtotal_otros+=$total_otros;
        $vtotal_comp+=$total_comp;
?>
    <tr style="background-color: #bdc3c7;">
        <td style="width: 15%; text-align: center">TOTAL ESTAB.</td>
        <td style="width: 10%; text-align: right"><?php echo number_format($total_efectivo,2,'.','');?></td>
        <td style="width: 10%; text-align: right"><?php echo number_format($total_tarjetasc,2,'.','');?></td>
        <td style="width: 10%; text-align: right"><?php echo number_format($total_tarjetasd,2,'.','');?></td>
        <td style="width: 5%;"></td>
        <td style="width: 10%; text-align: right"><?php echo number_format($total_dineroe,2,'.','');?></td>
        <td style="width: 10%; text-align: right"><?php echo number_format($total_otros,2,'.','');?></td>
        <td style="width: 5%;"></td>
        <td style="width: 10%; text-align: right"><?php echo number_format($total_comp,2,'.','');?></td>
        <td style="width: 5%;"></td>
    </tr>
<?php
endfor;
$total_cobrado+=$vtotal_efectivo;
?>
        <tr style="color:#006699">
            <th style="text-align: right; padding-top: 5px; color: #006699;">TOTALES</th>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"><?php echo number_format($vtotal_efectivo,2,'.','');?></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"><?php echo number_format($vtotal_tarjetasc,2,'.','');?></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"><?php echo number_format($vtotal_tarjetasd,2,'.','');?></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"><?php echo number_format($vtotal_dineroe,2,'.','');?></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"><?php echo number_format($vtotal_otros,2,'.','');?></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"><?php echo number_format($vtotal_comp,2,'.','');?></td>
            <td style="text-align: right; padding-top: 5px; border-top:1px solid grey"></td>
        </tr>
    </table>
     <H4>INGRESOS DE CAJA</H4>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt; margin-top:14px;">
        <tr>
            <th style="width: 80%;text-align: center">DESCRIPCIÓN</th>
            <th style="width: 20%;text-align: right">MONTO</th>
        </tr>
<?php
$sql_movimientos=mysqli_query($$_SESSION['bd_comercial'],"select * from movimientos_caja where caja='".$caja."' and id_vendedor='".$rw_caja["id_vendedor"]."' and tipo='INGRESO'");
//echo "select * from movimientos_caja where caja='".$caja."' and id_vendedor='".$rw_caja["id_vendedor"]."' and tipo='INGRESO'";
$total_ingresos2=0;
if(mysqli_num_rows($sql_movimientos)==0){ echo "<tr><td colspan='2'>NO SE HAN REGISTRADO RETIROS DE CAJA</td></tr>";}
while ($row=mysqli_fetch_array($sql_movimientos))
	{
        $monto=$row["monto"];
        $descripcion=$row["descripcion"];
        $total_ingresos2+=$monto;
	?>
        <tr>
            <td style="width: 80%; text-align: left"><?php echo  $descripcion;?></td>
            <td style="width: 20%; text-align: right"><?php echo $monto; ?></td>
        </tr>
<?php
        }
?>
        <tr style="color:#006699"><th style="text-align: right; padding-top: 5px;">TOTAL</th><th style="text-align: right;padding-top: 5px;border-top:1px solid grey"><?php echo number_format($total_ingresos2,2,'.','');?></th></tr>
    </table>
    <H4>RETIROS DE CAJA</H4>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt; margin-top:14px;">
        <tr>
            <th style="width: 80%;text-align: center">DESCRIPCIÓN</th>
            <th style="width: 20%;text-align: right">MONTO</th>
        </tr>
<?php
$sql_movimientos=mysqli_query($$_SESSION['bd_comercial'],"select * from movimientos_caja where caja='".$caja."' and id_vendedor='".$rw_caja["id_vendedor"]."' and tipo='EGRESO'");
$total_egresos=0;
if(mysqli_num_rows($sql_movimientos)==0){ echo "<tr><td colspan='2'>NO SE HAN REGISTRADO RETIROS DE CAJA</td></tr>";}
while ($row=mysqli_fetch_array($sql_movimientos))
	{
        $monto=$row["monto"];
        $descripcion=$row["descripcion"];
        $total_egresos+=$monto;
	?>
        <tr>
            <td style="width: 80%; text-align: left"><?php echo  $descripcion;?></td>
            <td style="width: 20%; text-align: right"><?php echo $monto; ?></td>
        </tr>
<?php
        }
?>
        <tr style="color:#006699"><th style="text-align: right; padding-top: 5px;">TOTAL</th><th style="text-align: right; padding-top: 5px;border-top:1px solid grey"><?php echo number_format($total_egresos,2,'.','');?></th></tr>
    </table>

    <h4 style="text-decoration:underline;">CIERRE DE CAJA</h4>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt; margin-top:14px;">
        <tr><th style="width: 50%;text-align: right">SALDO APERTURA</th><td style="width: 20%;text-align: right"><?PHP echo $rw_caja["saldo_apertura"];?></td></tr>
        <tr><th style="width: 50%;text-align: right">INGRESOS DINERO (Efectivo ventas+ ctas x cobrar y separados + Ing. caja)</th><td style="width: 20%;text-align: right"><?php echo number_format($total_cobrado+$total_ingresos2,2,'.','');?></td></tr>
        <tr><th style="width: 50%;text-align: right">EGRESOS (Egr caja)</th><td style="width: 20%;text-align: right">(-) <?php echo number_format($total_egresos,2,'.','');?></td></tr>
        <tr style="color:#006699"><th style="width: 50%;text-align: right;">TOTAL (efectivo)</th><th style="width: 20%;text-align: right;border-top:1px solid grey"><?php $tot=$rw_caja["saldo_apertura"]+$total_cobrado+$total_ingresos2-$total_egresos; echo number_format($tot,2,'.','');?></th></tr>
        <tr><th style="width: 50%;text-align: right">INGRESOS ELEC. (Tarjetas+DineroE+Otros)</th><td style="width: 20%;text-align: right">(+) <?php $elec=$ttotal_tarjetasc+$vtotal_tarjetasc+$ttotal_tarjetasd+$vtotal_tarjetasd+$ttotal_dineroe+$vtotal_dineroe+$ttotal_otros+$vtotal_otros; echo number_format($elec,2,'.','');?></td></tr>
        <tr style="color:#006699"><th style="width: 50%;text-align: right">TOTAL (efectivo+elec)</th><th style="width: 20%;text-align: right;border-top:1px solid grey"><?php $tot1=$tot+$elec; echo number_format($tot1,2,'.','');?></th></tr>
        <tr><th style="width: 50%;text-align: right">INGRESOS CRED DIRECTO</th><td style="width: 20%;text-align: right"> <?php echo number_format($ttotal_credito,2,'.','');?></td></tr>
		<tr><th style="width: 50%;text-align: right">ANULADOS</th><td style="width: 20%;text-align: right"> <?php echo number_format($total_anulados,2,'.','');?></td></tr>
	</table>
 <?php
/*
?>   
    <H4>FACTURAS ANULADAS</H4>
    <?php
        $sql_movimientos=mysqli_query($$_SESSION['bd_comercial'],"select * from movimientos where (DATE(fecha_movimiento)='".$rw_caja["fecha"]."' or DATE(fecha_pago)='".$rw_caja["fecha"]."') and proceso='VEN' and id_vendedor='".$rw_caja["id_vendedor"]."' and anulado=1");
        $respuesta="";
    ?>
        <table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt; margin-top:14px;">
    <?php 
        while ($row=mysqli_fetch_array($sql_movimientos))
	{
        $respuesta.="<tr><td>".$row["numero_factura"]."</td></tr>";
        }
        echo $respuesta;*/
	?>
        <!--</table>-->
</page>