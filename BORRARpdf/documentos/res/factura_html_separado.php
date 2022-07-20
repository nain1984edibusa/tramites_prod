<?php
#$nums=1;
require 'res/escpos-php-development/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
$sumador_total=0;
$conexion=$_SESSION['bd_comercial'];
$ips=array(IP_COMERCIAL_1,IP_COMERCIAL_2,IP_COMERCIAL_3);
    $tmpdir = sys_get_temp_dir();
    $file =  tempnam($tmpdir, 'ctk');
    $connector = new FilePrintConnector($file);
    $printer = new Printer($connector);
    $claveacceso="";
    $url="";
    $sql=mysqli_query($$_SESSION['bd_comercial'], "select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."' and tmp.conexion='".$conexion."'");
    if(mysqli_num_rows($sql)>0){
        ?>
        <?php 
        $largo_encabezado=33; 
        $separador="================================================"; #48 ESPACIOS
        $separadorin="----------------------------------------------------------------"; #64 ESPACIOS
        $Data  = "";
        $Cuerpo ="";
        $Enc = "";
        $Fin = "";
        $printer -> setFont(Printer::FONT_A);
        $printer -> setTextSize(1, 1);#normal
            $printer -> setJustification(Printer::JUSTIFY_CENTER); #centro
            $printer -> setEmphasis(true); #negrita
            //$img = EscposImage::load("res/logo.jpg");
            //$printer -> graphics($img);
            $Enc="\n\n"."------------- PRODUCTO SEPARADO -------------"."\n\n";
            $printer -> setJustification(Printer::JUSTIFY_LEFT); #centro
            $printer -> setEmphasis(false); #negrita
            $printer -> text($Enc);
        #DATOS DE LOS CLIENTES Y FECHA
        $sql_cliente=mysqli_query($$_SESSION['bd_comercial'],"select * from clientes where id_cliente='$id_cliente'");
        $rw_cliente=mysqli_fetch_array($sql_cliente);
        date_default_timezone_set('America/Guayaquil');
        $date=date("d-m-Y H:i:s");
        $fecha=fechaCastellano($date);
        $cli="CLIENTE      : ".encabezado($rw_cliente['nombre_cliente'],$largo_encabezado);
        $ruc="RUC/CI       : ".encabezado($rw_cliente['ruc_ci'],$largo_encabezado);
        $dir="DIRECCION    : ".encabezado($rw_cliente['direccion_cliente'],$largo_encabezado);
        $lfe="FECHA:  ".encabezado($fecha,$largo_encabezado);
        $email_cliente=$rw_cliente['email_cliente'];
        $Enc = "\n"."\n";
        $Enc .= $cli."\n";
        $Enc .= $ruc."\n";
        $Enc .= $dir."\n";
        $Enc .= $lfe."\n\n";
        $printer -> text($Enc);
        $Cuerpo="";
            $enp = "CANT COD    DESCRIPCION                           P UNIT P TOTAL"; #24 espacios mas
        //$Data .= $separador.$espacioentrefacturas.$separador."\n";
        $Cuerpo .= $separadorin."\n".$enp."\n".$separadorin."\n";
        ?>
        <?php
        $iva="";
        $iva0=0;
        $ivax=0;
        $count=0;
        $date2=date("Y-m-d H:i:s");
        $sum_b_imponible=0;
        $sum_b_cero=0;
        $subtotal=0;
        $descuentototal=0;
        $idm=date("YmdHis").$_SESSION['user_id'];
        while ($row=mysqli_fetch_array($sql))
        {
            $descuentop=number_format($row['descuento_tmp'],2,'.','');
            $descuentototal+=$row['descuento_tmp'];
            $count++;
            $id_tmp=$row["id_tmp"];
            $id_producto=$row['id_producto'];
            $codigo_producto=$row['codigo_adc'];
            $codigo_adc=$row['codigo_adc'];
            $cantidad=$row['cantidad_tmp'];
            $nombre_producto=$row['nombre_producto'];
            $precio_venta=$row['precio_tmp'];
            $precio_venta_f=number_format($precio_venta,4,'.','');#Formateo variables
            $precio_venta_r=str_replace(",","",$precio_venta_f);#Reemplazo las comas
            $precio_total=round($precio_venta_r,2)*$cantidad;
            $precio_total_f=number_format($precio_total,2,'.','');#Precio total formateado
            $precio_total_r=str_replace(",","",$precio_total_f);#Reemplazo las comas
            $sumador_total+=$precio_total_r;#Sumador
                $preciov_m=number_format($precio_venta,4,'.','');
                $preciot=round($precio_venta,2)*$cantidad;
                $preciot_m=number_format($preciot,2,'.','');
            if($row['IVA']=="SI"){
                //$sum_b_imponible+=$precio_total_r;
                $sum_b_imponible+=$preciot-$row['descuento_tmp'];
                $iva=TAX;
            }else{
                //$sum_b_cero+=$precio_total_r;
                $sum_b_cero+=$preciot-$row['descuento_tmp'];
                $iva=0;
            }  
            $subtotal+=$preciot;
            //$prod=encabezado($cantidad,5)." ".encabezado($nombre_producto,38)." ".precios($precio_venta_f,9)." ".precios($precio_total_f,9);
            $prod=" ".encabezado($cantidad,3)." ".encabezado($codigo_producto,6)." ".encabezado($nombre_producto,35)." ".precios($preciov_m,8)." ".precios($preciot_m,7);
            $Cuerpo .= $prod."\n";
            if(strlen($nombre_producto)>35){
                $res=strlen($nombre_producto)-35;
                $recorrido=0;
                $empieza=35;
                $Cuerpo.="             ".substr($nombre_producto, $empieza,35)."\n";
                $count++;
            }
            //Insert en la tabla detalle_cotizacion
            $insert_detail=mysqli_query($$_SESSION['bd_comercial'], "INSERT INTO detalle_movimiento (id_movimiento, id_producto, cantidad, precio_venta,descuento, iva) VALUES ('".$idm."','$id_producto','$cantidad','$precio_venta_r','$descuentop','$iva')");
            $update_stock_producto=mysqli_query($$_SESSION['bd_comercial'],"UPDATE products set cant_separados = cant_separados + ".$cantidad." where id_producto='".$id_producto."'");
        }
        $fcount=$count;
        //$subtotal=$sum_b_imponible+$sum_b_cero;
        $subtotal=number_format($subtotal,2,'.','');
        $bimponible0=$sum_b_cero;
        $bimponible=$sum_b_imponible;
        $desc_dolares=$descuentototal;
        $desc_dolares=number_format($desc_dolares,2,'.','');
        //$bimponible=$subtotal-$descuento;
        $bimponible0=number_format($bimponible0,2,'.','');
        $bimponible=number_format($bimponible,2,'.','');
	$total_iva=($bimponible * TAX )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$bimponible0+$bimponible+$total_iva;
        $total_factura=  number_format($total_factura,2,'.','');
        $espacioext="";
        $espacioext="                        ";
        $inf0 = $separadorin;
        $inf1 = $espacioext."                    SUBTOTAL $ ".precios(number_format($subtotal,2,'.',''),9); //26 largo hasta $
        $inf2 = $espacioext."                   DESCUENTO $ ".precios($desc_dolares,9);
        $inf3 = $espacioext."                      IVA 0% $ ".precios(number_format($bimponible0,2,'.',''),9);
        $inf4 = $espacioext."                   B IMP ".TAX."% $ ".precios(number_format($bimponible,2,'.',''),9);
        $inf5 = $espacioext."                     IVA ".TAX."% $ ".precios(number_format($total_iva,2,'.',''),9);
        $inf6 = $espacioext."                       TOTAL $ ".precios(number_format($total_factura,2,'.',''),9);
        
        $Cuerpo .=$inf0."\n";
        $Cuerpo .=$inf1."\n";
        $Cuerpo .=$inf2."\n";
        $Cuerpo .=$inf3."\n";
        $Cuerpo .=$inf4."\n";
        $Cuerpo .=$inf5."\n";
        $Cuerpo .=$inf6."\n";
        date_default_timezone_set('America/Guayaquil');
        $date=date("Y-m-d H:i:s");
        $insert=mysqli_query($$_SESSION['bd_comercial'],"INSERT INTO movimientos(id_movimiento,fecha_movimiento,proceso,id_cliente,id_vendedor,factura,bimponible_iva0,bimponible_ivax,importe_iva,iva,total_venta,estado_factura,descuento,conexion,fp_creditodirecto,fp_creddir_abono,fp_creddir_saldo) VALUES ('".$idm."','$date','$proceso_factura','$id_cliente','$id_vendedor','$factura','$bimponible0','$bimponible','$total_iva','".TAX."','$total_factura','0','$desc_dolares','$conexion','$total_factura','0.00','$total_factura')");
        //echo "INSERT INTO movimientos(id_movimiento,fecha_movimiento,proceso,id_cliente,id_vendedor,factura,bimponible_iva0,bimponible_ivax,importe_iva,iva,total_venta,estado_factura,descuento,conexion) VALUES ('".$idm."','$date','$proceso_factura','$id_cliente','$id_vendedor','$factura','$bimponible0','$bimponible','$total_iva','".TAX."','$total_factura','0','$desc_dolares','$conexion',)";
        $Data.="\n";
        $Data.="\n";
        $Data.="\n";
        $Data.="\n";
        $Data.="\n";
        $Data.="\n";
        $Data.="\n";
        $Data.="\n";
        $Data.="\n";
        $Data.="\n";
        //$printer -> text($Enc);
        $printer -> setFont(Printer::FONT_B);
        $printer -> setTextSize(1, 1);
        $printer -> text($Cuerpo);
        $printer -> selectPrintMode(); # Reset
        $printer -> text($Fin);
        $printer -> cut();
        $printer -> close();
        //copy($file, "//".$ips[0]); DESACTIVE PARA NO IMPRIMIR
        unlink($file);
    }
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
?>