<?php 
$tmpdir = sys_get_temp_dir();   # ambil direktori temporary untuk simpan file.
$file =  tempnam($tmpdir, 'ctk');  # nama file temporary yang akan dicetak
$handle = fopen($file, 'w');
$condensed = Chr(27) . Chr(33) . Chr(4);
$bold1 = Chr(27) . Chr(69);
$bold0 = Chr(27) . Chr(70);
$initialized = chr(27).chr(64);
$condensed1 = chr(15);
$condensed0 = chr(18);
$largo_encabezado=25;
$separador="========================================"; //40
$Data  = $initialized;
$Data .= $condensed1;
$conexiones=array("con1","con2","con3");
$bds=array("smart_syscatleia_comercial","smart_syscatleia_comercial2","smart_syscatleia_comercial3");
$ips=array(IP_COMERCIAL_1,IP_COMERCIAL_2,IP_COMERCIAL_3);
//DATOS DE LOS CLIENTES Y FECHA
$sql_cliente=mysqli_query($$conexion,"select * from clientes where id_cliente='$id_cliente'");
$rw_cliente=mysqli_fetch_array($sql_cliente);
date_default_timezone_set('America/Guayaquil');
//$date=date("d-m-Y H:i:s");
$date=cambiar_formato($fecha_movimiento);
$fecha=fechaCastellano($date);
$cli="CLIENTE      : ".encabezado($rw_cliente['nombre_cliente'],$largo_encabezado);
$ruc="RUC/CI       : ".encabezado($rw_cliente['ruc_ci'],$largo_encabezado);
$dir="DIREC.       : ".encabezado($rw_cliente['direccion_cliente'],$largo_encabezado);
$lfe="FECHA:  ".encabezado($fecha,$largo_encabezado);
$enp = "CANT COD    DESCRIPCION   P UNIT P TOTAL";
$Data .= "\n"."\n";
if($conexion=="con1"){
    //$Data.="--- ENCABEZADO FACTURA ELECTRONICA---";
};
$Data .= $cli."\n";
$Data .= $ruc."\n";
$Data .= $dir."\n";
$Data .= $lfe."\n";
$Data .= $separador."\n".$enp."\n".$separador."\n";
?>
<?php
//$nums=1;
$sumador_total=0;
$sql=mysqli_query($$conexion, "select * from products, detalle_movimiento, movimientos where products.id_producto=detalle_movimiento.id_producto and detalle_movimiento.id_movimiento=movimientos.id_movimiento and movimientos.id_movimiento='".$id_movimiento."'");
//echo "select * from products, detalle_movimiento, movimientos where products.id_producto=detalle_movimiento.id_producto and detalle_movimiento.id_movimiento=movimientos.numero_factura and movimientos.id_movimiento='".$id_movimiento."'";
$iva="";
$iva0=0;
$ivax=0;
$count=0;
$sum_b_imponible=0;
$sum_b_cero=0;
$piva=0;
while ($row=mysqli_fetch_array($sql))
{
    $count++;
    $id_producto=$row["id_producto"];
    $codigo_producto=$row['codigo_producto'];
    $cantidad=$row['cantidad'];
    $nombre_producto=$row['nombre_producto'];
    $precio_venta=$row['precio_venta'];
    //CALCULO SIN IVA AL TOTAL
    $precio_venta_f=number_format($precio_venta,4,'.','');//Formateo variables
    $precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
    $precio_total=$precio_venta_r*$cantidad;
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
        $preciot=$precio_venta*$cantidad;
        $preciot_m=number_format($preciot,2,'.','');
    //} 
    if($row['IVA']=="SI"){
        //$sum_b_imponible+=$precio_total_r;
        $sum_b_imponible+=$preciot;
    }else{
        //$sum_b_cero+=$precio_total_r;
        $sum_b_cero+=$preciot;
    }   
    //$prod=encabezado($cantidad,5)." ".encabezado($nombre_producto,38)." ".precios($precio_venta_f,9)." ".precios($precio_total_f,9);
    $prod=" ".encabezado($cantidad,3)." ".encabezado($codigo_producto,6)." ".encabezado($nombre_producto,11)." ".precios($preciov_m,8)." ".precios($preciot_m,7);
    $Data .= $prod."\n";
    if(strlen($nombre_producto)>11){
                $res=strlen($nombre_producto)-11;
                $recorrido=0;
                $empieza=11;
                $Data.="             ".substr($nombre_producto, $empieza,11)."\n";
                $count++;
            }else{
                $Data .= "\n";
                $count++;
            }
    //Insert en la tabla detalle_cotizacion
}
$fcount=$count;
if($count<16):
    while($count<16){
        $count++;
        $Data .= "\n";
    }
endif;
$subtotal=$sum_b_imponible+$sum_b_cero;
//$bimponible=$subtotal-$descuento;
$bimponible0=$rw_factura['bimponible_iva0'];
$bimponible=$rw_factura['bimponible_ivax'];
$total_iva=$rw_factura['importe_iva'];
$total_factura=$rw_factura['total_venta'];
$inf0 = $separador;
$inf1 = "                    SUBTOTAL $ ".precios(number_format($subtotal,2,'.',''),9);
$inf2 = "                   DESCUENTO $ ".precios($descuento,9);
$inf3 = "                      IVA 0% $ ".precios(number_format($bimponible0,2,'.',''),9);
$inf4 = "                   B IMP ".TAX."% $ ".precios(number_format($bimponible,2,'.',''),9);
$inf5 = "                     IVA ".TAX."% $ ".precios(number_format($total_iva,2,'.',''),9);
$inf6 = "                       TOTAL $ ".precios(number_format($total_factura,2,'.',''),9);
$Data .=$inf0."\n";
$Data .=$inf1."\n";
$Data .=$inf2."\n";
$Data .=$inf3."\n";
$Data .=$inf4."\n";
$Data .=$inf5."\n";
$Data .=$inf6."\n\n\n\n";
fwrite($handle, $Data);
//fwrite($handle, $written);
fclose($handle);
/*copy($file, "//192.168.10.108/lx300");  # Lakukan cetak*/
$pos=intval(substr($conexion,-1));
copy($file, "//".$ips[$pos-1]);  # PRUEBAS
unlink($file);
//echo $Data;
//exit();
        
//FUNCIONES NO BORRAR
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
function cambiar_formato($fecha_movimiento)
{
    $res1=explode(" ",$fecha_movimiento);
    $res2=explode("-",$res1[0]);
    return ($res2[2]."-".$res2[1]."-".$res2[0]);
}
function precio_fp($precio, $max){
	$auxp=$precio;
	if(strlen($precio)<$max){
		$nl=$max-strlen($precio);
		for($i=0;$i<$nl;$i++){
			$precio=$precio." ";
		}
                $auxp=$precio;
	}
	return $auxp;
}
?>