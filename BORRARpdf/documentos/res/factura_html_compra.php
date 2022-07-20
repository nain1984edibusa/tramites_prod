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
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
} 
-->
</style>
<page backtop="38mm" backbottom="5mm" backleft="16mm" backright="20mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
    </page_footer>
<?php
//BORRAR LO QUE HAYA ESTADO EN DETALLE MOVIMIENTOS
mysqli_query($$_SESSION['bd_comercial'],"DELETE from detalle_movimiento WHERE id_movimiento='$idm'");
$nums=1;
$sumador_total=0;
$sql=mysqli_query($$_SESSION['bd_comercial'], "select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");
$iva="";
$iva0=0;
$ivax=0;
$count=0;
date_default_timezone_set('America/Guayaquil');
$fechacompleta=date("Y-m-d H:i:s");
//$idm=date("YmdHis").$_SESSION['user_id'];
while ($row=mysqli_fetch_array($sql))
{
        $count++;
	$id_tmp=$row["id_tmp"];
	$id_producto=$row["id_producto"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['nombre_producto'];
	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=number_format($precio_venta,4,'.','');//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=round($precio_venta_r,4)*$cantidad;
	$precio_total_f=number_format($precio_total,2,'.','');//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
	/*if($row['IVA']=="SI")
        {
            $preciov=$precio_venta+$precio_venta*TAX/100;
            $preciov_m=number_format($preciov,2,'.','');
            $preciot=round($preciov,2)*$cantidad;
            $preciot_m=number_format($preciot,2,'.','');
        }else
        {
            $preciov_m=number_format($precio_venta,2,'.','');
            $preciot=$precio_venta*$cantidad;
            $preciot_m=number_format($preciot,2,'.','');
        } */
        $preciov_m=number_format($precio_venta,4,'.','');
        $preciot=round($precio_venta,4)*$cantidad;
        $preciot_m=number_format($preciot,2,'.','');
        if($row['IVA']=="SI"){
            //$sum_b_imponible+=$precio_total_r;
            //$sum_b_imponible+=$preciot;
            $iva=TAX;
        }else{
            //$sum_b_cero+=$precio_total_r;
            //$sum_b_cero+=$preciot;
            $iva=0;
        }   
	$insert_detail=mysqli_query($$_SESSION['bd_comercial'], "INSERT INTO detalle_movimiento (id_movimiento, id_producto, cantidad, precio_venta, descuento, iva) VALUES ('".$idm."','$id_producto','$cantidad','$precio_venta_r','','$iva')");
        //echo $_SESSION['bd_comercial']."INSERT INTO detalle_movimiento VALUES ('','".$idm."','$id_producto','$cantidad','$precio_venta_r','$iva')";
    //INSERTAR KARDEX
        if($estadob=="SI"){
            $UKP=mysqli_query($$_SESSION['bd_comercial'], "SELECT existencias_cant,existencias_costo,existencias_total from kardex WHERE id_producto='$id_producto' ORDER BY id_kardex DESC LIMIT 0,1");
            $resUKP=  mysqli_fetch_array($UKP);
            //$ultimocosto=$resUKP["existencias_costo"];
            $cantidad_stock=$resUKP["existencias_cant"];
            $ultimototal=$resUKP["existencias_total"];
            $total_mov=number_format($precio_venta_r*$cantidad,4,".",'');
            $nueva_cant=$cantidad_stock+$cantidad;
            $nuevo_total=$ultimototal+$total_mov;
            $nuevo_total=number_format($nuevo_total,4,".",'');
            $nuevo_costo=$nuevo_total/$nueva_cant;
            $nuevo_costo=number_format($nuevo_costo,4,".",'');
            $insert_kardex=mysqli_query($$_SESSION['bd_comercial'], "INSERT INTO kardex VALUES ('','".$id_producto."','$fechacompleta','COM','$idm','$cantidad','$precio_venta_r','$total_mov','','','','$nueva_cant','$nuevo_costo','$nuevo_total')");
            $update_stock_producto=mysqli_query($$_SESSION['bd_comercial'],"UPDATE products set stock = stock + ".$cantidad." where id_producto='".$id_producto."'");
             mysqli_query($$_SESSION['bd_comercial'],"UPDATE movimientos SET compest_borrador='1' where id_movimiento='".$idm."'");   //AFECTA INVENTARIO
        }else{
            mysqli_query($$_SESSION['bd_comercial'],"UPDATE movimientos SET compest_borrador='' where id_movimiento='".$idm."'");  //NO AFECTA INVENTARIO
        }
        $nums++;
}
	/*$subtotal=($sum_b_imponible/(1+TAX/100))+$sum_b_cero;
        $sum_b_imponible=$sum_b_imponible/(1+TAX/100);
        $subtotal=number_format($subtotal,2,'.','');*/
        /*$descuento=0;
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
        }*/
        //$bimponible=$subtotal-$descuento;
        /*$bimponible0=number_format($bimponible0,2,'.','');
        $bimponible=number_format($bimponible,2,'.','');
        $total_iva=($bimponible * TAX )/100;
        $total_iva=number_format($total_iva,2,'.','');
        $total_factura=$bimponible0+$bimponible+$total_iva;*/
?>

</page>

<?php
date_default_timezone_set('America/Guayaquil');
$date=date("Y-m-d H:i:s");
//$insert=mysqli_query($$_SESSION['bd_comercial'],"INSERT INTO movimientos(id_movimiento,numero_factura,factura,fecha_movimiento,proceso,id_proveedor,condiciones,num_retencion,retencion_iva, retencion_fuente,bimponible_iva0,bimponible_ivax,importe_iva,iva,total_venta,estado_factura) VALUES ('".$idm."','".$numero_factura."','".$factura."','$date','$proceso_factura','$id_proveedor','$condiciones','$num_retencion','$retencion_iva','$retencion_fuente','$bimponible0','$bimponible','$total_iva','".TAX."','$total_factura','1')");
$delete=mysqli_query($$_SESSION['bd_comercial'],"DELETE FROM tmp WHERE session_id='".$session_id."'");
//echo "INSERT INTO movimientos(id_movimiento,numero_factura,fecha_movimiento,proceso,id_proveedor,condiciones,num_retencion,retencion_iva, retencion_fuente,bimponible_iva0,bimponible_ivax,importe_iva,iva,total_venta,estado_factura) VALUES ('','".$numero_factura."','$date','$proceso_factura','$id_proveedor','$condiciones','$num_retencion','$retencion_iva','$retencion_fuente',$baseimponible_iva0','$baseimponible_ivax','$total_iva','".TAX."','$total_factura','1')";
//exit();
	echo "<script>alert('Los itmes de la compra se han asociado correctamente')</script>";
        echo "<script>opener.location='../../inventario_compras.php';window.close(); </script>";
	//echo "<script>opener.location.reload();window.close(); </script>";
	exit;
?>