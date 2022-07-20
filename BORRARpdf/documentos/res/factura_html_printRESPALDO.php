<?php
#$nums=1;
$sumador_total=0;
#BUSCAR POR CONEXIONES
$conexiones=array("con1","con2","con3");
$bds=array("smart_syscatleia_comercial","smart_syscatleia_comercial2","smart_syscatleia_comercial3");
$ips=array(IP_COMERCIAL_1,IP_COMERCIAL_2,IP_COMERCIAL_3);
$resefectivo= floatval($i_efectivo);
$resdineroe= floatval($i_dineroe);
$restarjetac= floatval($i_tarjetac);
$resotros= floatval($i_otros);
$rescreditod= floatval($i_creditod);
for($i=0; $i<count($conexiones);$i++):
    $claveacceso="";
    $url="";
    $sql=mysqli_query($condb, "select * from ".$bds[$i].".products, smart_syscatleia_base.tmp where ".$bds[$i].".products.id_producto=smart_syscatleia_base.tmp.id_producto and smart_syscatleia_base.tmp.session_id='".$session_id."' and smart_syscatleia_base.tmp.conexion='".$conexiones[$i]."'");
    if(mysqli_num_rows($sql)>0){
        ?>
        <?php 
        $tmpdir = sys_get_temp_dir();   # ambil direktori temporary untuk simpan file.
        $file =  tempnam($tmpdir, 'ctk');  # nama file temporary yang akan dicetak
        $handle = fopen($file, 'w');
        //$condensed = Chr(27) . Chr(33) . Chr(4);
        $esc=chr(27);
        $par=chr(97);
        $cutpaper=$esc."m";
        $bold_on=$esc."E1";
        $bold_off=$esc."E0";
        $condensed_on=chr(27).chr(15);
        $initialized = chr(27).chr(64);
        //$emphasizedmod=chr(27).chr(33).chr(52); 
        //$condensed1 = chr(15);
        //$condensed0 = chr(18);
        $centradoleft = $esc.$par.chr(0);
        $centradocenter = $esc.$par.chr(1);
        $centradofull = $esc.$par.chr(3);
        $largo_encabezado=25;
        $separador="========================================"; #40 ESPACIOS
        if($conexiones[$i]=="con1"){
            $largo_encabezado=33; 
            $separador="================================================"; #48 ESPACIOS
        }
        $Data  = $initialized;
        if($conexiones[$i]=="con1"){
            $Enc.=$Data."------------- FACTURA ELECTRONICA -------------"."\n\n";
            $Enc.=NOMBRE_COMERCIAL_1."\n";
            $Enc.=RAZON_SOCIAL_1."\n\n";
            $Enc.="RUC: ".RUC_1."\n";
            $Enc.="TEL: ".TELEFONO_1."\n";
            $Enc.="DIR: ".DIRESTABLECIMIENTO_1."\n";
            $Enc.="MATRIZ: Riobamba"."\n";
            $Enc.="Obligado a llevar contabilidad"."\n\n";
        };
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
        if($conexiones[$i]=="con1"){
            $enp = "CANT COD    DESCRIPCION           P UNIT P TOTAL"; #8 espacios mas
        }else{
            $enp = "CANT COD    DESCRIPCION   P UNIT P TOTAL";
        }
        $Data .= "\n"."\n";
        $Data .= $cli."\n";
        $Data .= $ruc."\n";
        $Data .= $dir."\n";
        $Data .= $lfe."\n";
        //$Data .= $separador.$espacioentrefacturas.$separador."\n";
        $Data .= $separador."\n".$enp."\n".$separador."\n";
        ?>
        <?php
        $iva="";
        $iva0=0;
        $ivax=0;
        $count=0;
        $date2=date("Y-m-d H:i:s");
        $sum_b_imponible=0;
        $sum_b_cero=0;
        $idm=date("YmdHis").$_SESSION['user_id'];
        while ($row=mysqli_fetch_array($sql))
        {
            $count++;
            $id_tmp=$row["id_tmp"];
            $id_producto=$row['id_producto'];
            $codigo_producto=$row['codigo_producto'];
            $codigo_adc=$row['codigo_adc'];
            $cantidad=$row['cantidad_tmp'];
            $nombre_producto=$row['nombre_producto'];
            $precio_venta=$row['precio_tmp'];
            $precio_venta_f=number_format($precio_venta,4,'.','');#Formateo variables
            $precio_venta_r=str_replace(",","",$precio_venta_f);#Reemplazo las comas
            $precio_total=$precio_venta_r*$cantidad;
            $precio_total_f=number_format($precio_total,2,'.','');#Precio total formateado
            $precio_total_r=str_replace(",","",$precio_total_f);#Reemplazo las comas
            $sumador_total+=$precio_total_r;#Sumador
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
                $preciot=$precio_venta*$cantidad;
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
            if($conexiones[$i]=="con1"){
                $prod=" ".encabezado($cantidad,3)." ".encabezado($codigo_producto,6)." ".encabezado($nombre_producto,19)." ".precios($preciov_m,8)." ".precios($preciot_m,7);
                $Data .= $prod."\n";
                if(strlen($nombre_producto)>19){
                    $res=strlen($nombre_producto)-19;
                    $recorrido=0;
                    $empieza=19;
                    $Data.="             ".substr($nombre_producto, $empieza,19)."\n";
                    $count++;
                }else{
                    $Data .= "\n";
                    $count++;
                }
                
            }else{
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
            }
            //Insert en la tabla detalle_cotizacion
            $insert_detail=mysqli_query($$conexiones[$i], "INSERT INTO detalle_movimiento (id_movimiento, id_producto, cantidad, precio_venta, iva) VALUES ('".$idm."','$id_producto','$cantidad','$precio_venta_r','$iva')");
            //INSERTAR KARDEX
            $UKP=mysqli_query($$conexiones[$i], "SELECT existencias_cant,existencias_costo,existencias_total from kardex WHERE id_producto='$id_producto' ORDER BY id_kardex DESC LIMIT 0,1");
            $resUKP=  mysqli_fetch_array($UKP);
            $ultimocosto=$resUKP["existencias_costo"];
            $cantidad_stock=$resUKP["existencias_cant"];
            $ultimototal=$resUKP["existencias_total"];
            $total_mov=number_format($ultimocosto*$cantidad,4,".",'');
            $nueva_cant=$cantidad_stock-$cantidad;
            $nuevo_total=$ultimototal-$total_mov;
            $nuevo_total=number_format($nuevo_total,4,".",'');
            $nuevo_costo=$nuevo_total/$nueva_cant;
            $nuevo_costo=number_format($nuevo_costo,4,".",'');
            $insert_kardex=mysqli_query($$conexiones[$i], "INSERT INTO kardex VALUES ('','".$id_producto."','$date2','VEN','$idm','','','','$cantidad','$ultimocosto','$total_mov','$nueva_cant','$nuevo_costo','$nuevo_total')");
            //
            $update_stock_producto=mysqli_query($$conexiones[$i],"UPDATE products set stock = stock - ".$cantidad." where id_producto='".$id_producto."'");
            //$nums++;
        }
        $fcount=$count;
        if($conexiones[$i]!="con1"){
        if($count<16):
            while($count<16){
                $count++;
                $Data .= "\n";
            }
        endif;
        }
        $subtotal=$sum_b_imponible+$sum_b_cero;
        $subtotal=number_format($subtotal,2,'.','');
        $descuento=0;
        if (isset($_GET["descuento"])){
            $descuento= $_GET["descuento"];      
        }  
        $bimponible0=$sum_b_cero;
        $bimponible=$sum_b_imponible;
        $desc_dolares=0;
        if($descuento>0){
            if($sum_b_cero>0){
                //AQUI ME QUEDE
                $des=(number_format($sum_b_cero,2)*$descuento)/100;
                $bimponible0=number_format($sum_b_cero,2)-number_format($des,2);
                $desc_dolares+=number_format($des,2);
            }
            if($sum_b_imponible>0){
                $des=(number_format($sum_b_imponible,2)*$descuento)/100;
                $bimponible=number_format($sum_b_imponible,2)-number_format($des,2);
                $desc_dolares+=number_format($des,2);
            }
        }
        $desc_dolares=number_format($desc_dolares,2,'.','');
        //$bimponible=$subtotal-$descuento;
        $bimponible0=number_format($bimponible0,2,'.','');
        $bimponible=number_format($bimponible,2,'.','');
	$total_iva=($bimponible * TAX )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$bimponible0+$bimponible+$total_iva;
        //$preciof=precio_fp(number_format($total_factura,2,'.',''), 10);
        /*$tcount=$fcount;
        if($fcount<10){
                $tcount=" ".$fcount;
        }
        $cant_prod=$tcount." Producto(s)";*/
        $espacioext="";
        if($conexiones[$i]=="con1"): $espacioext="        "; endif;
        $inf0 = $separador;
        $inf1 = $espacioext."                    SUBTOTAL $ ".precios(number_format($subtotal,2,'.',''),9); //26 largo hasta $
        $inf2 = $espacioext."                   DESCUENTO $ ".precios($desc_dolares,9);
        $inf3 = $espacioext."                      IVA 0% $ ".precios(number_format($bimponible0,2,'.',''),9);
        $inf4 = $espacioext."                   B IMP ".TAX."% $ ".precios(number_format($bimponible,2,'.',''),9);
        $inf5 = $espacioext."                     IVA ".TAX."% $ ".precios(number_format($total_iva,2,'.',''),9);
        $inf6 = $espacioext."                       TOTAL $ ".precios(number_format($total_factura,2,'.',''),9);
        
        $Data .=$inf0."\n";
        $Data .=$inf1."\n";
        $Data .=$inf2."\n";
        $Data .=$inf3."\n";
        $Data .=$inf4."\n";
        $Data .=$inf5."\n";
        $Data .=$inf6."\n";
        $k=0;
        if($conexiones[$i]!="con1"){
            while($k<5){
                $Data .= "\n";
                $k++;
            }
        }

        date_default_timezone_set('America/Guayaquil');
        $date=date("Y-m-d H:i:s");
        //AQUI DETERMINAR COMO CONSIDERO LA(S) FORMA(S) DE PAGO
        if($conexiones[$i]!="con1"){
            $estadosri="PENDIENTE";
        }else{
            $estadosri="";
        }
        $sql_facturanum ="SELECT facturero_siguiente from factureros WHERE facturero_estado=1 ORDER BY id_facturero DESC LIMIT 0,1";
        $res_facturanum = mysqli_query($$conexiones[$i], $sql_facturanum);
        $res_factura = mysqli_fetch_array($res_facturanum);
        $numero_factura=$res_factura["facturero_siguiente"];
        $insert=mysqli_query($$conexiones[$i],"INSERT INTO movimientos(id_movimiento,numero_factura,fecha_movimiento,proceso,id_cliente,id_vendedor,factura,bimponible_iva0,bimponible_ivax,importe_iva,iva,total_venta,estado_factura,descuento,conexion,claveacceso,dir_archivo,estado_sri) VALUES ('".$idm."','".$numero_factura."','$date','$proceso_factura','$id_cliente','$id_vendedor','$factura','$bimponible0','$bimponible','$total_iva','".TAX."','$total_factura','0','$desc_dolares','$conexiones[$i]','$claveacceso','$url','$estadosri')");
        //echo "INSERT INTO movimientos(id_movimiento,numero_factura,fecha_movimiento,proceso,id_cliente,id_vendedor,factura,bimponible_iva0,bimponible_ivax,importe_iva,iva,total_venta,estado_factura,descuento,conexion,claveacceso,dir_archivo,estado_sri) VALUES ('".$idm."','".$numero_factura."','$date','$proceso_factura','$id_cliente','$id_vendedor','$factura','$bimponible0','$bimponible','$total_iva','".TAX."','$total_factura','0','$desc_dolares','$conexiones[$i]','$claveacceso','$url','PENDIENTE')";
        //exit();
        mysqli_query($$conexiones[$i],"UPDATE factureros SET facturero_siguiente=facturero_siguiente+1 WHERE facturero_siguiente='$numero_factura'");
        $cumTotal=0;
        $fp_query="";
        $restante_factura=floatval($total_factura);
        if(($resefectivo>0)&&($cumTotal==0)&&($restante_factura>0)){
            //echo $restante_factura." ".$resefectivo;
            if(number_format($restante_factura,2)<=number_format($resefectivo,2)){
                //echo "es menor";
                $fp_query.=" fp_efectivo='".number_format($restante_factura,2,'.','')."', estado_factura=1 ";
                $Data.="EFEC: $".number_format($restante_factura,2,'.','');
                $cumTotal=1;
                $resefectivo-=$restante_factura;
                $restante_factura=0;
            }else{
                //echo "es mayor";
                $fp_query.=" fp_efectivo='".number_format($resefectivo,2,'.','')."' ";
                $Data.="EFEC: $".number_format($resefectivo,2,'.','');
                $restante_factura=$restante_factura-$resefectivo;
                $resefectivo=0;
            }
        }
        if(($resdineroe>0)&&($cumTotal==0)&&($restante_factura>0)){
            if($fp_query!="") $fp_query.=", ";
            //echo $restante_factura." ".$resdineroe;
            if(number_format($restante_factura,2)<=number_format($resdineroe,2)){
                $fp_query.=" fp_dineroe='".number_format($restante_factura,2,'.','')."', estado_factura=1 ";
                $Data.=" DIN ELEC: $".number_format($restante_factura,2,'.','');
                $cumTotal=1;
                $resdineroe-=$restante_factura;
                $restante_factura=0;
            }else{
                $fp_query.=" fp_dineroe='".number_format($resdineroe,2,'.','')."' ";
                $Data.=" DIN ELEC: $".number_format($resdineroe,2,'.','');
                $restante_factura=$restante_factura-$resdineroe;
                $resdineroe=0;
            }
        };
        if(($restarjetac>0)&&($cumTotal==0)&&($restante_factura>0)){
            if($fp_query!="") $fp_query.=", ";
            //echo $restante_factura." ".$restarjetac;
            if(number_format($restante_factura,2)<=number_format($restarjetac,2)){
                //echo "es menor o igual";
                $fp_query.=" fp_tarjetadc='".number_format($restante_factura,2,'.','')."', dfp_tarjetadc='".$id_tarjetac."', estado_factura=1 ";
                $Data.=" TARJETA: $".number_format($restante_factura,2,'.','');
                $cumTotal=1;
                $restarjetac-=$restante_factura;
                $restante_factura=0;
            }elseif($restante_factura>$restarjetac){
                //echo "es mayor";
                $fp_query.=" fp_tarjetadc='".number_format($restarjetac,2,'.','')."', dfp_tarjetadc='".$id_tarjetac."' ";
                $Data.=" TARJETA: $".number_format($restarjetac,2,'.','');
                $restante_factura=$restante_factura-$restarjetac;
                $restarjetac=0;
            }
        };
        if(($resotros>0)&&($cumTotal==0)&&($restante_factura>0)){
            //echo $restante_factura." ".$resotros;
            if($fp_query!="") $fp_query.=", ";
            if(number_format($restante_factura,2)<=number_format($resotros,2)){
                $fp_query.=" fp_otros='".number_format($restante_factura,2,'.','')."', dfp_otros='".$id_otros."', estado_factura=1 ";
                $Data.=" OTROS : $".number_format($restante_factura,2,'.','');
                $cumTotal=1;
                $resotros-=$restante_factura;
                $restante_factura=0;
            }else{
                $fp_query.=" fp_otros='".number_format($resotros,2,'.','')."', dfp_otros='".$id_otros."' ";
                $Data.=" OTROS : $".number_format($resotros,2,'.','');
                $restante_factura=$restante_factura-$resotros;
                $resotros=0;
            }
        };
        if(($rescreditod>0)&&($cumTotal==0)&&($restante_factura>0)){
            if($fp_query!="") $fp_query.=", ";
            //echo $restante_factura." ".$rescreditod;
            if(number_format($restante_factura,2)<=number_format($rescreditod,2)){
                $fp_query.=" fp_creditodirecto='".number_format($restante_factura,2,'.','')."', fp_creddir_limitep='".$ifl_creditod."', fp_creddir_abono='0.00', fp_creddir_saldo='".$rescreditod."', estado_factura=0 ";
                $Data.=" CRED DIRECTO: $".number_format($restante_factura,2,'.','');
                $cumTotal=1;
                $rescreditod-=$restante_factura;
                $restante_factura=0;
            }else{
                $fp_query.=" fp_creditodirecto='".number_format($rescreditod,2,'.','')."', fp_creddir_limitep='".$ifl_creditod."', fp_creddir_abono='0.00', fp_creddir_saldo='".$rescreditod."', estado_factura=0 ";
                $Data.=" CRED DIRECTO: $".number_format($rescreditod,2,'.','');
                $restante_factura=$restante_factura-$rescreditod;
                $rescreditod=0;
            }
        };
        $Data.="\n";
        mysqli_query($$conexiones[$i],"UPDATE movimientos SET ".$fp_query." WHERE id_movimiento='$idm'");
        if($conexiones[$i]=="con1"){
            include("../../xml/factura_xml_crear.php");
            sleep(8);
            $Enc.="Factura Elec: ".ESTABLECIMIENTO_1."-".PUNTOEMISION_1."-".formato_cadena($secuencia,9)."\n";
            $Enc.="Clave Acceso: ".$claveacceso."\n";
            $consultaaut=mysqli_query($$conexiones[$i],"SELECT estado_sri FROM movimientos WHERE id_movimiento='$idm'");
            $resaut=  mysqli_fetch_array($consultaaut);
            if($resaut["estado_sri"]=="AUTORIZADO"){
                $Enc.="Autorizacion: ".$claveacceso."\n";
            }else{
                $Enc.="Autorizacion: AUTORIZACION PENDIENTE"."\n";
            }
            $Data.="Estimado cliente puede consultar sus facturas electronicas de ".NOMBRE_COMERCIAL_1." en http://catleia.grupodigital.ec en las siguientes 24 horas"."\n";
            $k=0;
            while($k<3){
                $Data .= "\n";
                $k++;
            }
            $Data=$Enc.$Data."\n\n\n";
            $Data.=$cortar;
        }
        //echo "UPDATE movimientos SET ".$fp_query." WHERE id_movimiento='$idm'";
        //OBTENER ULTIMA FACTURA
        //echo "INSERT INTO movimientos(id_movimiento,numero_factura,fecha_movimiento, fecha_pago,proceso,id_cliente,id_vendedor,factura,condiciones,bimponible_iva0,bimponible_ivax,importe_iva,iva,total_venta,estado_factura,descuento) VALUES ('".$idm."','".$numero_factura."','$date','$fechapago','$proceso_factura','$id_cliente','$id_vendedor','$factura','$condiciones','$bimponible0','$bimponible','$total_iva','".TAX."','$total_factura','$estado','$descuento')";
        //exit();
        /*if ($factura=="NO")
        {
        echo "<script>alert('La venta se ha registrado correctamente')</script>";
        echo "<script>opener.location='../../ventas_ventas.php';window.close(); </script>";
        //echo "<script>opener.location.reload();window.close(); </script>";
        //exit;
        }*/
        fwrite($handle, $Data);
        //fwrite($handle, $written);
        fclose($handle);
        //copy($file, "//192.168.10.108/lx300");  # CLIENTE
        copy($file, "//".$ips[$i]);  # PRUEBAS
        unlink($file);
    }
endfor;   
//exit();
$delete=mysqli_query($$_SESSION['bd_comercial'],"DELETE FROM tmp WHERE session_id='".$session_id."'");
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