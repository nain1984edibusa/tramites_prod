<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; height:10px; padding: 2px 2px 3px 2px;}
.superior td{ height: 13px; padding-bottom: 4px;}
.etiqueta{
    font-size: 9pt;
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
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
} 
-->
</style>
<page backtop="10mm" backbottom="5mm" backleft="16mm" backright="20mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
    </page_footer>
    <?php 
            $sql_cliente=mysqli_query($$_SESSION['bd_comercial'],"select * from proveedores where id_proveedor='$id_proveedor'");
            $rw_cliente=mysqli_fetch_array($sql_cliente);
    ?>
    <h3>FACTURA DE COMPRA</h3>
    <table class="superior" cellspacing="0" style="width: 100%;font-size: 8pt;">
        <tr>
            <td colspan="2" style="width:100%; text-align:left;"><span class="etiqueta"><b>Proveedor:</b>&nbsp;&nbsp;</span><span><?php echo $rw_cliente['nombre_proveedor'];?></span></td>
        </tr>
        <tr>
            <td colspan="2" style="width:100%; text-align:left;"><span class="etiqueta"><b>RUC/CI:</b>&nbsp;&nbsp;</span><span><?php echo $rw_cliente['ruc_ci'];?></span></td>
        </tr>
        <tr>
            <td colspan="2" style="width:100%; text-align:left;"><span class="etiqueta"><b>Fecha:</b>&nbsp;&nbsp;</span><span><?php echo substr($fecha_movimiento,0,10);?></span></td>
        </tr>
    </table>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt; margin-top:14px;">
        <tr>
            <th style="width: 12%;text-align:center">CANT.</th>
            <th style="width: 35%">DESCRIPCION</th>
            <th style="width: 17%;text-align: right">P UNIT.</th>
            <th style="width: 18%;text-align: right">P TOTAL</th>
            
        </tr>

<?php
$nums=1;
$sumador_total=0;
$sql=mysqli_query($$_SESSION['bd_comercial'], "select * from products, detalle_movimiento, movimientos where products.id_producto=detalle_movimiento.id_producto and detalle_movimiento.id_movimiento=movimientos.id_movimiento and movimientos.id_movimiento='".$id_movimiento."'");
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
        $codigo_producto=$row['codigo_producto'];
        $cantidad=$row['cantidad'];
        $nombre_producto=$row['nombre_producto'];
        $precio_venta=$row['precio_venta'];
        //CALCULO SIN IVA AL TOTAL
        $precio_venta_f=number_format($precio_venta,2,'.','');//Formateo variables
        $precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
        $precio_total=$precio_venta_r*$cantidad;
        $precio_total_f=number_format($precio_total,2,'.','');//Precio total formateado
        $precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
        $sumador_total+=$precio_total_r;//Sumador
        //CALCULO CON IVA AL DETALLE
        if($row['IVA']=="SI")
        {
            $preciov=$precio_venta+$precio_venta*$row['iva']/100;
            $preciov_m=number_format($preciov,2,'.','');
            $preciot=round($preciov,2)*$cantidad;
            $preciot_m=number_format($preciot,2,'.','');
        }else
        {
            $preciov_m=number_format($precio_venta,2,'.','');
            $preciot=$precio_venta*$cantidad;
            $preciot_m=number_format($preciot,2,'.','');
        } 
        if($row['IVA']=="SI"){
            //$sum_b_imponible+=$precio_total_r;
            $sum_b_imponible+=$preciot;
        }else{
            //$sum_b_cero+=$precio_total_r;
            $sum_b_cero+=$preciot;
        }   
	?>

        <tr>
            <td style="width: 10%; text-align: center"><?php echo $cantidad; ?></td>
            <td style="width: 60%; text-align: left"><?php echo substr ( $nombre_producto , 0, 37 );?></td>
            <td style="width: 15%; text-align: right"><?php echo $preciov_m;?></td>
            <td style="width: 15%; text-align: right"><?php echo $preciot_m;?></td>
            
        </tr>

	<?php 

	
	$nums++;
	}
        if($count<17):
            while($count<17){
            $count++;
            ?>
        <tr><td style="width: 10%; text-align: center"><?php echo " ";?></td><td></td><td></td><td></td></tr>
        <?php
            }
        endif;
	$subtotal=($sum_b_imponible/(1+TAX/100))+$sum_b_cero;
$sum_b_imponible=$sum_b_imponible/(1+TAX/100);
$subtotal=number_format($subtotal,2,'.','');
$descuento=0;
if (isset($_GET["descuento"])){
    $descuento= number_format($_GET["descuento"],2,'.','');      
}
$descuento= number_format($descuento,2,'.','');  
$bimponible0=0;
$bimponible=0;
if(($descuento<$sum_b_cero)&&($sum_b_cero>0)){
    $bimponible0=$sum_b_cero-$descuento;
    $bimponible=$sum_b_imponible;
}else if(($descuento<$sum_b_imponible)&&($sum_b_imponible>0)){
    $bimponible=$sum_b_imponible-$descuento;
    $bimponible0=$sum_b_cero;
}
//$bimponible=$subtotal-$descuento;
$bimponible0=number_format($bimponible0,2,'.','');
$bimponible=number_format($bimponible,2,'.','');
$total_iva=($bimponible * TAX )/100;
$total_iva=number_format($total_iva,2,'.','');
$total_factura=$bimponible0+$bimponible+$total_iva;
?>
	  
        <tr>
            <td colspan="3" style="height:12px;width: 85%; text-align: right;"><b>SUBTOTAL &#36; </b></td>
            <td style="width: 15%; text-align: right;"> <?php echo number_format($subtotal,2,'.','');?></td>
        </tr>
        <tr>
            <td colspan="3" style="height:12px; width: 85%; text-align: right;"><b>DESCUENTO &#36; </b></td>
            <td style="width: 15%; text-align: right;"><?php echo number_format($descuento,2,'.','');?></td>
        </tr>
        <tr>
            <td colspan="3" style="height:12px;width: 85%; text-align: right;"><b>TOTAL IVA 0% &#36; </b></td>
            <td style="width: 15%; text-align: right;"> <?php echo number_format($bimponible0,2,'.','');?></td>
        </tr>
        <tr>
            <td></td><td></td><td><b>TOTAL IVA <?php echo TAX;?> % &#36; </b></td>
            <!--<td colspan="3" style="height:12px;width: 85%; text-align: right;" class="txt_invisible">TOTAL IVA  % &#36; </td>-->
            <td style="width: 15%; text-align: right;"> <?php echo number_format($bimponible,2,'.','');?></td>
        </tr>
		<tr>
                    <td colspan="3" style="height:12px;width: 85%; text-align: right;"><b>IVA (<?php echo TAX; ?>)% &#36; </b></td>
            <td style="width: 15%; text-align: right;"> <?php echo number_format($total_iva,2,'.','');?></td>
        </tr><tr>
            <td colspan="3" style="height:12px;width: 85%; text-align: right;"><b>TOTAL &#36; </b></td>
            <td style="width: 15%; text-align: right;"> <?php echo number_format($total_factura,2,'.','');?></td>
        </tr>
    </table>
</page>

