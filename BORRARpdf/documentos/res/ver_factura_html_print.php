<?php
#$nums=1;
require 'res/escpos-php-development/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
$sumador_total=0;
#BUSCAR POR CONEXIONES
$conexiones=array("con1","con2","con3");
$bds=array("smart_syscatleia_comercial","smart_syscatleia_comercial2","smart_syscatleia_comercial3");
$ips=array(IP_COMERCIAL_1,IP_COMERCIAL_2,IP_COMERCIAL_3);
//for($i=0; $i<count($conexiones);$i++):
    $tmpdir = sys_get_temp_dir();
    $file =  tempnam($tmpdir, 'ctk');
    $connector = new FilePrintConnector($file);
    $printer = new Printer($connector);
    $claveacceso="";
    $url="";
    //$sql=mysqli_query($$conexion, "select * from products, detalle_movimiento, movimientos where products.id_producto=detalle_movimiento.id_producto and detalle_movimiento.id_movimiento=movimientos.id_movimiento and movimientos.id_movimiento='".$id_movimiento."'");
    //$sql=mysqli_query($condb, "select * from ".$bds[$i].".products, smart_syscatleia_base.tmp where ".$bds[$i].".products.id_producto=smart_syscatleia_base.tmp.id_producto and smart_syscatleia_base.tmp.session_id='".$session_id."' and smart_syscatleia_base.tmp.conexion='".$conexiones[$i]."'");
    //if(mysqli_num_rows($sql)>0){
        ?>
        <?php 
        $largo_encabezado=25;
        $separador="========================================"; #40 ESPACIOS
        $separadorin="========================================"; #40 ESPACIOS
        if($conexion=="con1"){
            $largo_encabezado=33; 
            $separador="================================================"; #48 ESPACIOS
            $separadorin="----------------------------------------------------------------"; #64 ESPACIOS
        }
        $Data  = "";
        $Cuerpo ="";
        $Enc = "";
        $Fin = "";
        $printer -> setFont(Printer::FONT_A);
        $printer -> setTextSize(1, 1);#normal
        if($conexion=="con1"){
            $printer -> setJustification(Printer::JUSTIFY_CENTER); #centro
            $printer -> setEmphasis(true); #negrita
            $img = EscposImage::load("res/logo.jpg");
            $printer -> graphics($img);
            $Enc="\n\n"."------------- FACTURA ELECTRONICA -------------"."\n\n";
            $Enc.=NOMBRE_COMERCIAL_1."\n";
            $Enc.=RAZON_SOCIAL_1."\n\n";
            $printer -> text($Enc);
            $printer -> setJustification(Printer::JUSTIFY_LEFT); #centro
            $printer -> setEmphasis(false); #negrita
            $Enc="RUC: ".RUC_1."\n";
            $Enc.="TEL: ".TELEFONO_1."\n";
            $Enc.="DIR: ".DIRESTABLECIMIENTO_1."\n";
            $Enc.="MATRIZ: Riobamba"."\n";
            $Enc.="Obligado a llevar contabilidad"."\n\n";
            $printer -> text($Enc);
        }else{
                $printer -> setFont(Printer::FONT_B);
                $printer -> setTextSize(1, 1);#normal
        }
        #DATOS DE LOS CLIENTES Y FECHA
        $sql_cliente=mysqli_query($$conexion,"select * from clientes where id_cliente='$id_cliente'");
        $rw_cliente=mysqli_fetch_array($sql_cliente);   
        date_default_timezone_set('America/Guayaquil');
        //$date=date("d-m-Y H:i:s");
        $date=cambiar_formato($fecha_movimiento);
        $fecha=fechaCastellano($date);
        $cli="CLIENTE      : ".encabezado($rw_cliente['nombre_cliente'],$largo_encabezado);
        $ruc="RUC/CI       : ".encabezado($rw_cliente['ruc_ci'],$largo_encabezado);
        $dir="DIRECCION    : ".encabezado($rw_cliente['direccion_cliente'],$largo_encabezado);
        $lfe="FECHA:  ".encabezado($fecha,$largo_encabezado);
        $Enc = "\n"."\n";
        //$Enc = $separador."\n"."\n";
        $Enc .= $cli."\n";
        $Enc .= $ruc."\n";
        $Enc .= $dir."\n";
        $Enc .= $lfe."\n\n";
        $printer -> text($Enc);
        $Cuerpo="";
        if($conexion=="con1"){
            $enp = "CANT COD    DESCRIPCION                           P UNIT P TOTAL"; #24 espacios mas
        }else{
            $enp = "CANT COD    DESCRIPCION   P UNIT P TOTAL";
        }
        //$Data .= $separador.$espacioentrefacturas.$separador."\n";
        $Cuerpo .= $separadorin."\n".$enp."\n".$separadorin."\n";
        ?>
        <?php
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
                $preciov=$precio_venta+$precio_venta*TAX/100;
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
                $iva=TAX;
            }else{
                //$sum_b_cero+=$precio_total_r;
                $sum_b_cero+=$preciot;
                $iva=0;
            }   
            //$prod=encabezado($cantidad,5)." ".encabezado($nombre_producto,38)." ".precios($precio_venta_f,9)." ".precios($precio_total_f,9);
            if($conexion=="con1"){
                $prod=" ".encabezado($cantidad,2)." ".encabezado($codigo_producto,7)." ".encabezado($nombre_producto,35)." ".precios($preciov_m,8)." ".precios($preciot_m,7);
                $Cuerpo .= $prod."\n";
                if(strlen($nombre_producto)>35){
                    $res=strlen($nombre_producto)-35;
                    $recorrido=0;
                    $empieza=35;
                    $Cuerpo.="             ".substr($nombre_producto, $empieza,35)."\n";
                    $count++;
                }
            }else{
                $prod=" ".encabezado($cantidad,2)." ".encabezado($codigo_producto,7)." ".encabezado($nombre_producto,11)." ".precios($preciov_m,8)." ".precios($preciot_m,7);
                $Cuerpo .= $prod."\n";
                $strlenres=strlen($nombre_producto)-11;
                $fila=1;
                $empieza=11;
                while(($strlenres>=0)&&($fila<3)){
                    $Cuerpo.="            ".substr($nombre_producto, $empieza,11)."\n";
                    $empieza+=11;
                    $strlenres-=11;
                    $fila++;
                    $count++;
                    /*if(strlen($nombre_producto)>11){
                    $res=strlen($nombre_producto)-11;
                    $recorrido=0;
                    $empieza=11;
                    $Cuerpo.="             ".substr($nombre_producto, $empieza,11)."\n";
                    $count++;
                    }else{
                        $Cuerpo .= "\n";
                        $count++;
                    }*/  
                }
                /*if(strlen($nombre_producto)>11){
                    $res=strlen($nombre_producto)-11;
                    $recorrido=0;
                    $empieza=11;
                    $Cuerpo.="             ".substr($nombre_producto, $empieza,11)."\n";
                    $count++;
                }else{
                    $Cuerpo .= "\n";
                    $count++;
                }*/
            }
        }
        $fcount=$count;
        if($conexion!="con1"){
        if($count<16):
            while($count<16){
                $count++;
                $Cuerpo .= "\n";
            }
        endif;
        }
        $subtotal=$sum_b_imponible+$sum_b_cero;
        //$bimponible=$subtotal-$descuento;
        $bimponible0=$rw_factura['bimponible_iva0'];
        $bimponible=$rw_factura['bimponible_ivax'];
        $total_iva=$rw_factura['importe_iva'];
        $total_factura=$rw_factura['total_venta'];
        $descuento=$rw_factura['descuento'];
        $espacioext="";
        if($conexion=="con1"): $espacioext="                        "; endif;
        $nff="      ";
        if($conexion!="con1"){
            $nff=$rw_factura["numero_factura"];
            if(strlen($numero_factura)<6){
                $canti=strlen($numero_factura);
                while($canti<6){
                   $nff=" ".$nff;
                   $canti++;
                }
            }
        }
        $inf0 = $separadorin;
        $inf1 = $espacioext.$nff."              SUBTOTAL $ ".precios(number_format($subtotal,2,'.',''),9); //26 largo hasta $
        $inf2 = $espacioext."                   DESCUENTO $ ".precios($descuento,9);
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
        
        if($rw_factura["fp_efectivo"]!="0.00")
            $Fin= "EFE: $".$rw_factura["fp_efectivo"];
        if($rw_factura["fp_dineroe"]!="0.00")
            $Fin.= " DIN ELEC: $".$rw_factura["fp_dineroe"];
        if($rw_factura["fp_tarjetacre"]!="0.00")
            $Fin.= " TAR CRE: $".$rw_factura["fp_tarjetacre"];
        if($rw_factura["fp_tarjetadeb"]!="0.00")
            $Fin.= " TAR DEB: $".$rw_factura["fp_tarjetadeb"];
        if($rw_factura["fp_otros"]!="0.00")
            $Fin.= " OTROS: $".$rw_factura["fp_otros"];
       if($rw_factura["fp_compdeudas"]!="0.00")
            $Fin.= " COMPEN: $".$rw_factura["fp_otros"];
        if($rw_factura["fp_creditodirecto"]!="0.00")
            $Fin.= " CRED DIRECTO: $".$rw_factura["fp_creditodirecto"];
        $Fin.="\nNO SE ACEPTAN CAMBIOS NI \nDEVOLUCIONES";
        $Data.="\n";
        if($conexion=="con1"){
            $Enc="Factura Elec: ".ESTABLECIMIENTO_1."-".PUNTOEMISION_1."-".formato_cadena($rw_factura["numero_factura"],9)."\n";
            $Enc.="Clave Acceso: ".$rw_factura["claveacceso"]."\n";
            $consultaaut=mysqli_query($$conexion,"SELECT estado_sri FROM movimientos WHERE id_movimiento='$id_movimiento'");
            $resaut=  mysqli_fetch_array($consultaaut);
            /*if($resaut["estado_sri"]=="AUTORIZADO"){
                $Enc.="Autorizacion: ".$rw_factura["claveacceso"]."\n";
            }else{
                $Enc.="Autorizacion: AUTORIZACION PENDIENTE"."\n\n";
            }*/
            $Fin.="\n\n"."DECLARE A TIEMPO SU IMPUESTO A LA RENTA"."\n"."Estimado cliente puede consultar sus facturas electronicas en http://catleia.grupodigital.ec en las siguientes 24 horas, o en la pagina web del SRI."."\n";
            $k=0;
            while($k<3){
                $Fin .= "\n";
                $k++;
            }
            $printer -> text($Enc);
        }else{
            $k=0;
            //if($conexion!="con1"){
                while($k<3){
                    $Fin .= "\n";
                    $k++;
                }
            //}
        }
        $printer -> setFont(Printer::FONT_B);
        $printer -> setTextSize(1, 1);
        $printer -> text($Cuerpo);
        $printer -> selectPrintMode(); # Reset
        $printer -> text($Fin);
        $printer -> cut();
        $printer -> close();
        $pos=array_search($conexion, $conexiones);
        copy($file, "//".$ips[$pos]);
        unlink($file);
//FUNCIONES NO BORRAR
function fechaCastellano($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  //$dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  //$dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  //$nombredia = str_replace($dias_EN, $dias_ES, $dia);
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
function formato_cadena($cadena,$longitud){
    if(strlen($cadena)<$longitud){
        $faltan=$longitud-strlen($cadena);
        for($i=0;$i<$faltan;$i++){
            $cadena="0".$cadena;
        }
    }
    return $cadena;
}
/*function precio_fp($precio, $max){
	$auxp=$precio;
	if(strlen($precio)<$max){
		$nl=$max-strlen($precio);
		for($i=0;$i<$nl;$i++){
			$precio=$precio." ";
		}
                $auxp=$precio;
	}
	return $auxp;
}*/
?>




