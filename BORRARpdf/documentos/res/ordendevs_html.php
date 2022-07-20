<?php
$sumador_total=0;
date_default_timezone_set('America/Guayaquil');
$conexion=$_SESSION['bd_comercial'];
$eb="";
if($estadob=="NO"){
    $eb='1';
}
if($id_movimiento==""){
    $id_movimiento=date("YmdHis").$_SESSION['user_id'];
    //AQUI HAY QUE OBTENER UN NUMERO DE ORDEN DE DEVOLUCION
    $num_ordendev=mysqli_query($$_SESSION['bd_comercial'],"SELECT ordendev_siguiente FROM ordenes_devolucion WHERE ordendev_estado=1");
    $res_ordendev=  mysqli_fetch_array($num_ordendev);
    $nordendev=$res_ordendev["ordendev_siguiente"];
    $res=mysqli_query($$_SESSION['bd_comercial'],"INSERT INTO movimientos (id_movimiento,numero_factura,fecha_movimiento,proceso,id_proveedor,iva,conexion,compest_borrador,modifica)VALUES('$id_movimiento','$num_factura','$fecha','$proceso_devolucion','$id_proveedor','".TAX."','$conexion','$eb','$nordendev')");
    mysqli_query($$_SESSION['bd_comercial'],"UPDATE ordenes_devolucion SET ordendev_siguiente=ordendev_siguiente+1 WHERE ordendev_estado=1");
    mysqli_query($$_SESSION['bd_comercial'],"UPDATE movimientos SET modifica='$id_movimiento' WHERE id_movimiento='$mod'");
}else{
    mysqli_query($$_SESSION['bd_comercial'],"DELETE from detalle_movimiento WHERE id_movimiento='$id_movimiento'");
}
$iva="";
$iva0=0;
$ivax=0;
$count=0;
$sum_b_imponible=0;
$sum_b_cero=0;
$subtotalNC=0;
$descuentototal=0;
//ITEMS
$sql_detalle=mysqli_query($$_SESSION['bd_comercial'], "select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."' and tmp.conexion='".$conexion."'");
while($row_detalle=  mysqli_fetch_array($sql_detalle))
{
    $id_producto=$row_detalle["id_producto"];
    $cantidad=$row_detalle["cantidad_tmp"]; //cantidad
    $precio=$row_detalle["precio_tmp"];
    $observacion=$row_detalle["observac_tmp"];
    //CON QUE VALORES SE VA
    $subtotal=$precio*$cantidad;
    $subtotalt=round($subtotal,2);
    $subtotalNC+=$subtotalt;
    $iva=0;
    if($row_detalle["IVA"]=="SI"){
        $iva=TAX;
        $sum_b_imponible+=$subtotalt;
    }else{
        $sum_b_cero+=$subtotalt;
    }
    $insert_detail=mysqli_query($$_SESSION['bd_comercial'], "INSERT INTO detalle_movimiento (id_movimiento, id_producto, cantidad, precio_venta,descuento,iva,observaciones) VALUES ('".$id_movimiento."','$id_producto','$cantidad','$precio','','$iva','$observacion')");
    if($estadob=="SI"){
        /*$UKP=mysqli_query($$_SESSION['bd_comercial'], "SELECT existencias_cant,existencias_costo,existencias_total from kardex WHERE id_producto='$id_producto' ORDER BY id_kardex DESC LIMIT 0,1");
        $resUKP=  mysqli_fetch_array($UKP);
        $ultimocosto=$resUKP["existencias_costo"]; //ultimo costo kardex
        $cantidad_stock=$resUKP["existencias_cant"]; //ultima cantidad kardex
        $ultimototal=$resUKP["existencias_total"]; //ultimo total kardex
        $total_mov=number_format($precio*$cantidad,4,'.',''); //PROCESO ACTUAL ORDEN
        $nueva_cant=$cantidad_stock-$cantidad; //ultima cantidad añadir
        $nuevo_total=$ultimototal-$total_mov; 
        $nuevo_total=number_format($nuevo_total,4,".",''); //ultimo total añadir
        $nuevo_costo=$nuevo_total/$nueva_cant;
        $nuevo_costo=number_format($nuevo_costo,4,".",''); //ultimo costo añadir
        $costoventa= number_format($precio,4,'.','');  //costo venta
        if($resdetallemovo['IVA']=="SI"){
            $sum_b_imponible+=$totalitem;
            //$iva=TAX;
        }else{
            //$sum_b_cero+=$precio_total_r;
            $sum_b_cero+=$totalitem;
            //$iva=0;
        }  
        $subtotal=  number_format($subtotal,4,'.','');
        $insert_kardex=mysqli_query($$_SESSION['bd_comercial'], "INSERT INTO kardex VALUES ('','".$id_producto."','$fecha','ODS','$id_movimiento','','','','$cantidad','$costoventa','$subtotal','$nueva_cant','$nuevo_costo','$nuevo_total')");
        $update_stock_producto=mysqli_query($$_SESSION['bd_comercial'],"UPDATE products set stock = stock - ".$cantidad." where id_producto='".$id_producto."'");*/
        $update_stock_producto=mysqli_query($$_SESSION['bd_comercial'],"UPDATE products set cant_ordendev = cant_ordendev + ".$cantidad." where id_producto='".$id_producto."'");
    }
}
$total_iva=($sum_b_imponible * TAX )/100;
$total_iva=number_format($total_iva,2,'.','');
$total_factura=$sum_b_imponible+$sum_b_cero+$total_iva;
$sql_n2=mysqli_query($$_SESSION['bd_comercial'],"UPDATE movimientos SET bimponible_iva0='".number_format($sum_b_cero,2,'.','')."',bimponible_ivax='".number_format($sum_b_imponible,2,'.','')."',importe_iva='".number_format($total_iva,2,'.','')."',total_venta='".number_format($total_factura,2,'.','')."', compest_borrador='$eb'  where id_movimiento='$id_movimiento'");
$delete=mysqli_query($$_SESSION['bd_comercial'],"DELETE FROM tmp WHERE session_id='".$session_id."'");
function fechaCastellano($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $numeroDia." de ".$nombreMes." de ".$anio;
}
function encabezado($texto,$largo_maximo){
 $contar= strlen($texto);
 $retornar="";
 if($contar>$largo_maximo){
     $retornar=substr($texto, 0,$largo_maximo);
 }else
 {
     $faltante=$largo_maximo-$contar;
     $res="";
     for($i=0;$i<$faltante;$i++) {
         $res.=" ";
     }
     $retornar=$texto.$res;
 }
 return $retornar;
}
function precios($texto,$largo_maximo){
     $contar= strlen($texto);
     $retornar="";
     $faltante=$largo_maximo-$contar;
     $res="";
     for($i=0;$i<$faltante;$i++) {
         $res.=" ";
     }
     $retornar=$res.$texto;
     return $retornar;
}
function validar_cont($valor){
    if($valor==""){
        return $valor;
    }else{
        return number_format($valor,2,'.','');
    }
}