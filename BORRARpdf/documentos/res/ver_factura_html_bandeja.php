<style type="text/css">
<!--
* {
    font-family: Arial;
    //font-family: dejavuserif;
    //font-family: helvetica;

}
table { vertical-align: top; }
tr    { vertical-align: top; }
th {padding-left: 10px;}
td,th    { vertical-align: top; /*height:10px;*/ /*padding: 2px 2px 3px 2px;*/}
.superior td{ padding-right: 10px; /*height: 13px;*/ /*padding-bottom: 5px;*/}
.etiqueta{
    font-size: 8pt;
}
.txt_invisible{
    color:white;
    font-size: 1pt;
    //width: 50%;
   // display:block;
    //float:left;
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
.formas_pago{
    padding-left: 10px;
    font-size: 9pt;
}
.linea{
    border-top:1px solid black;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="20mm" backbottom="4mm" backleft="0mm" backright="5mm" style="font-size: 10pt;" >
        <page_footer>
    </page_footer>
    <?php 
            $sql_cliente=mysqli_query($$conexion,"select * from clientes where id_cliente='$id_cliente'");
            $rw_cliente=mysqli_fetch_array($sql_cliente);
    ?>
    <table class="superior" cellspacing="0" style="width: 100%; font-size: 10pt;">
        <tr>
            <th style="width:24%; text-align:left;">CLIENTE:</th>
            <td style="width:66%"><?php echo substr($rw_cliente['nombre_cliente'],0,28);?></td>
        </tr>
        <tr>
            <th style="width:30%; text-align:left;">RUC/CI:</th>
            <td style="width:70%"><?php echo $rw_cliente['ruc_ci'];?></td><?php //echo $rw_cliente['telefono_cliente'];?>
        </tr>
        <tr>
            <th style="width:30%; text-align:left;">DIR.:</th>
            <td style="width:70%"><?php echo substr($rw_cliente['direccion_cliente'],0,28);?></td>
        </tr>
        <tr>
            <th style="width:30%; text-align:left;">LUGAR/FECHA:</th>
            <td style="width:70%">Riobamba / <?php echo $fecha_movimiento;?></td>
        </tr>
    </table>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt; margin-top:5mm;">
        <tr>
            <th style="width: 10%;text-align:center">CANT</th>
            <th style="width: 10%;text-align:center">COD</th>
            <th style="width: 40%;text-align:center">DESCRIPCION</th>
            <th style="width: 16%;text-align: right">P UNIT</th>
            <th style="width: 16%;text-align: right">P TOTAL</th>
        </tr>

<?php
$nums=1;
$sumador_total=0;
$sql=mysqli_query($$conexion, "select * from products, detalle_movimiento, movimientos where products.id_producto=detalle_movimiento.id_producto and detalle_movimiento.id_movimiento=movimientos.id_movimiento and movimientos.id_movimiento='".$id_movimiento."'");
$iva="";
$iva0=0;
$ivax=0;
$count=0;
$sum_b_imponible=0;
$sum_b_cero=0;
//echo "select * from products, detalle_movimiento, movimientos where products.id_producto=detalle_movimiento.id_producto and detalle_movimiento.id_movimiento=movimientos.numero_factura and movimientos.id_movimiento='".$id_movimiento."'";
while ($row=mysqli_fetch_array($sql))
	{
        $count++;
	$id_producto=$row["id_producto"];
    $codigo_producto=$row['codigo_adc'];
    $cantidad=$row['cantidad'];
    $nombre_producto=$row['nombre_producto'];
    $precio_venta=$row['precio_venta'];
    //CALCULO SIN IVA AL TOTAL
    $precio_venta_f=number_format($precio_venta,4,'.','');//Formateo variables
    $precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
    $precio_total=round($precio_venta_r,2)*$cantidad;
    $precio_total_f=number_format($precio_total,2,'.','');//Precio total formateado
    $precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
    $sumador_total+=$precio_total_r;//Sumador
    //CALCULO CON IVA AL DETALLE
    /*if($row['IVA']=="SI")
    {
        $preciov=$precio_venta+$precio_venta*$row['iva']/100;
        $preciov_m=number_format($preciov,2,'.','');
        $preciot=round($preciov,2)*$cantidad;
        $preciot_m=number_format($preciot,2,'.','');
    }else
    {*/
        $preciov_m=number_format($precio_venta,4,'.','');
        $preciot=round($precio_venta,2)*$cantidad;
        $preciot_m=number_format($preciot,2,'.','');
    //} 
    if($row['IVA']=="SI"){
        //$sum_b_imponible+=$precio_total_r;
        $sum_b_imponible+=$preciot;
    }else{
        //$sum_b_cero+=$precio_total_r;
        $sum_b_cero+=$preciot;
    }   
	?>

        <tr>
            <td style="width: 10%; height:10px; text-align: center"><?php echo $cantidad; ?></td>
            <td style="width: 10%; height:10px; text-align: center"><?php echo $codigo_producto; ?></td>
            <td style="width: 40%; text-align: left"><?php echo substr ( $nombre_producto , 0, 20 );?></td>
            <!--<td style="width: 8%; text-align: right"><?php //echo $precio_venta_f;?></td>
            <td style="width: 8%; text-align: right"><?php //echo $precio_total_f;?></td>-->
            <td style="width: 16%; text-align: right"><?php echo $preciov_m;?></td>
            <td style="width: 16%; text-align: right"><?php echo $preciot_m;?></td>
        </tr>

	<?php 
	$nums++;
	}
        if($count<16):
            while($count<16){
            $count++;
            ?>
        <tr><td style="width: 5%; height:10px; text-align: center" class="txt_invisible"><?php echo "ESTO ES VACÍO";?></td><td></td><td></td><td></td></tr>
        <?php
            }
        endif;
	$subtotal=$sum_b_imponible+$sum_b_cero;
        //$bimponible=$subtotal-$descuento;
        $bimponible0=$rw_factura['bimponible_iva0'];
        $bimponible=$rw_factura['bimponible_ivax'];
	$total_iva=$rw_factura['importe_iva'];
	$total_factura=$rw_factura['total_venta'];
?>
	  
        <tr>
            <td colspan="4" style="height:12px;width: 80%; text-align: right;">SUBTOTAL &#36; </td>
            <td style="width: 20%; text-align: right;"> <?php echo number_format($subtotal,2,'.','');?></td>
        </tr>
        <tr>
            <td colspan="4"  style="height:12px; width: 80%; text-align: right;">DESC. &#36; </td>
            <td style="width: 20%; text-align: right;"><?php echo number_format($descuento,2,'.','');?></td>
        </tr>
        <tr>
            <td colspan="4" style="height:12px;width:20%; text-align: right;">IVA 0% &#36; </td>
            <td style="width: 20%; text-align: right;"> <?php echo number_format($bimponible0,2,'.','');?></td>
        </tr>
        <tr>
            <td colspan="4"  style="height:12px;width: 80%; text-align: right;">BASE IMP.(<?php echo TAX."%";?>)</td>
            <!--<td colspan="3" style="height:12px;width: 85%; text-align: right;" class="txt_invisible">TOTAL IVA  % &#36; </td>-->
            <td style="width: 20%; text-align: right;"> <?php echo number_format($bimponible,2,'.','');?></td>
        </tr>
	<tr>
            <td colspan="4" style="height:12px;width: 80%; text-align: right;">IVA (<?php echo TAX; ?>)% &#36; </td>
            <td style="width: 20%; text-align: right;"> <?php echo number_format($total_iva,2,'.','');?></td>
        </tr><tr>
            <td colspan="4" style="height:12px;width: 80%; text-align: right;">TOTAL &#36; </td>
            <td style="width: 20%; text-align: right;"> <?php echo number_format($total_factura,2,'.','');?></td>
        </tr>              
    </table>
    <br>
    <br>
    <table>
        <tr>
        <th style="width: 30%; height:10px; text-align: center">FORMA DE PAGO</th>
        <th style="width: 20%; height:10px; text-align: right">VALOR</th>
        <th style="width: 50%; height:10px; text-align: left">DETALLE</th>
        </tr>
        <?php
        $sql=mysqli_query($$conexion, "select * from movimientos WHERE movimientos.id_movimiento='".$id_movimiento."'");
        $rw_factura=  mysqli_fetch_array($sql);
        if(floatval($rw_factura["fp_efectivo"])>0):
        ?>
        <tr>
            <td style="text-align: center">Efectivo</td>
            <td style="text-align: right"><?php echo $rw_factura["fp_efectivo"] ?></td>
            <td style="text-align: left"></td>
        </tr>
        <?php 
        endif;
        if(floatval(["fp_dineroe"])>0):
        ?>
        <tr>
            <td style="text-align: center">Dinero Elec</td>
            <td style="text-align: right"><?php echo $rw_factura["fp_dineroe"] ?></td>
            <td style="text-align: left"></td>
        </tr>
        <?php 
        endif;
        if(floatval($rw_factura["fp_tarjetacre"])>0):
        ?>
        <tr>
            <td style="text-align: center">Tar Crédito</td>
            <td style="text-align: right"><?php echo $rw_factura["fp_tarjetacre"] ?></td>
            <td style="text-align: left"><?php echo $rw_factura["dfp_tarjetacre"] ?></td>
        </tr>
        <?php 
        endif;
        if(floatval($rw_factura["fp_tarjetadeb"])>0):
        ?>
        <tr>
            <td style="text-align: center">Tar Débito</td>
            <td style="text-align: right"><?php echo $rw_factura["fp_tarjetadeb"] ?></td>
            <td style="text-align: left"><?php echo $rw_factura["dfp_tarjetadeb"] ?></td>
        </tr>
        <?php 
        endif;
        if(floatval($rw_factura["fp_otros"])>0):
        ?>
        <tr>
            <td style="text-align: center">Otros</td>
            <td style="text-align: right"><?php echo $rw_factura["fp_otros"] ?></td>
            <td style="text-align: left"><?php echo $rw_factura["dfp_otros"] ?></td>
        </tr>
        <?php 
        endif;
        if(floatval($rw_factura["fp_compdeudas"])>0):
        ?>
        <tr>
            <td style="text-align: center">Comp. Deudas</td>
            <td style="text-align: right"><?php echo $rw_factura["fp_compdeudas"] ?></td>
            <td style="text-align: left"><?php echo $rw_factura["dfp_compdeudas"] ?></td>
        </tr>
        <?php 
        endif;
        if(floatval($rw_factura["fp_creditodirecto"])>0):
        ?>
        <tr>
            <td style="text-align: center">Créd. Directo</td>
            <td style="text-align: right"><?php echo $rw_factura["fp_creditodirecto"] ?></td>
            <td style="text-align: left"></td>
        </tr>
        <?php 
        endif;
        ?>
    </table>
</page>

