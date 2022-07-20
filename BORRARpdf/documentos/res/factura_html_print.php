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
$resefectivo= validar_cont($i_efectivo);
$resdineroe= validar_cont($i_dineroe);
$restarjetac= validar_cont($i_tarjetac);
$restarjetad= validar_cont($i_tarjetad);
$resotros= validar_cont($i_otros);
$rescompens= validar_cont($i_compens);
$rescreditod= validar_cont($i_creditod);
for($i=0; $i<count($conexiones);$i++):
    $tmpdir = sys_get_temp_dir();
    $file =  tempnam($tmpdir, 'ctk');
    $connector = new FilePrintConnector($file);
    $printer = new Printer($connector);
    $claveacceso="";
    $url="";
    $sql=mysqli_query($condb, "select * from ".$bds[$i].".products, smart_syscatleia_base.tmp where ".$bds[$i].".products.id_producto=smart_syscatleia_base.tmp.id_producto and smart_syscatleia_base.tmp.session_id='".$session_id."' and smart_syscatleia_base.tmp.conexion='".$conexiones[$i]."'");
    if(mysqli_num_rows($sql)>0){
        ?>
        <?php 
        $largo_encabezado=25;
        $separador="========================================"; #40 ESPACIOS
        $separadorin="========================================"; #40 ESPACIOS
        if($conexiones[$i]=="con1"){
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
        if($conexiones[$i]=="con1"){
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
        if($conexiones[$i]=="con1"){
            $enp = "CANT COD    DESCRIPCION                           P UNIT P TOTAL"; #24 espacios mas
        }else{
            $enp = "CANT COD    DESCRIPCION   P UNIT P TOTAL";
        }
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
                $sum_b_imponible+=$preciot-$row['descuento_tmp'];
                $iva=TAX;
            }else{
                //$sum_b_cero+=$precio_total_r;
                $sum_b_cero+=$preciot-$row['descuento_tmp'];
                $iva=0;
            }  
            $subtotal+=$preciot;
            //$prod=encabezado($cantidad,5)." ".encabezado($nombre_producto,38)." ".precios($precio_venta_f,9)." ".precios($precio_total_f,9);
            if($conexiones[$i]=="con1"){
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
            }
            //Insert en la tabla detalle_cotizacion
            $insert_detail=mysqli_query($$conexiones[$i], "INSERT INTO detalle_movimiento (id_movimiento, id_producto, cantidad, precio_venta,descuento, iva) VALUES ('".$idm."','$id_producto','$cantidad','$precio_venta_r','$descuentop','$iva')");
            //echo "INSERT INTO detalle_movimiento (id_movimiento, id_producto, cantidad, precio_venta, iva) VALUES ('".$idm."','$id_producto','$cantidad','$precio_venta_r','$descuentop','$iva')";
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
                $Cuerpo .= "\n";
            }
        endif;
        }
        //$subtotal=$sum_b_imponible+$sum_b_cero;
        $subtotal=number_format($subtotal,2,'.','');
        /*$descuento=0;
        if (isset($_GET["descuento"])){
            $descuento= $_GET["descuento"];      
        } */ 
        $bimponible0=$sum_b_cero;
        $bimponible=$sum_b_imponible;
        $desc_dolares=$descuentototal;
        /*if($descuento>0){
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
        }*/
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
        if($conexiones[$i]=="con1"): $espacioext="                        "; endif;
        $sql_facturanum ="SELECT facturero_siguiente from factureros WHERE facturero_estado=1 ORDER BY id_facturero DESC LIMIT 0,1";
        $res_facturanum = mysqli_query($$conexiones[$i], $sql_facturanum);
        $res_factura = mysqli_fetch_array($res_facturanum);
        $numero_factura=$res_factura["facturero_siguiente"];
        $nff="      ";
        if($conexiones[$i]!="con1"){
            $nff=$numero_factura;
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
        /*$k=0;
        if($conexiones[$i]!="con1"){
            while($k<5){
                $Cuerpo .= "\n";
                $k++;
            }
        }*/
        date_default_timezone_set('America/Guayaquil');
        $date=date("Y-m-d H:i:s");
        //AQUI DETERMINAR COMO CONSIDERO LA(S) FORMA(S) DE PAGO
        if($conexiones[$i]=="con1"){
            $estadosri="PENDIENTE";
        }else{
            $estadosri="";
        }
        $queryfp="";
        $total_factura=number_format($total_factura,2,'.','');
        $estado_facturan=1;
        $Fin="";
        if($conexiones[$i]=="con1"){
            if($resefectivo!='0.00'):$Fin.="EFE: $".number_format($resefectivo,2,'.','');endif;
            if($resdineroe!='0.00'):$Fin.=" DIN ELEC: $".number_format($resdineroe,2,'.','');endif;
            if($restarjetac!='0.00'):$Fin.=" TAR CRE: $".number_format($restarjetac,2,'.','');endif;
            if($restarjetad!='0.00'):$Fin.=" TAR DEB: $".number_format($restarjetad,2,'.','');endif;
            if($resotros!='0.00'):$Fin.=" OTROS: $".number_format($resotros,2,'.','');endif;
            if($rescompens!='0.00'):$Fin.=" COMPEN: $".number_format($rescompens,2,'.','');endif;
            if($rescreditod!='0.00'):$Fin.=" CRED DIRECTO: $".number_format($rescreditod,2,'.','');$estado_facturan=0;endif;
            $insert=mysqli_query($$conexiones[$i],"INSERT INTO movimientos(id_movimiento,numero_factura,fecha_movimiento,proceso,id_cliente,id_vendedor,factura,bimponible_iva0,bimponible_ivax,importe_iva,iva,total_venta,estado_factura,descuento,conexion,claveacceso,dir_archivo,estado_sri,fp_efectivo,fp_tarjetacre,fp_tarjetadeb,fp_dineroe,fp_creditodirecto,fp_creddir_abono,fp_creddir_saldo,fp_creddir_limitep,fp_otros,fp_compdeudas,dfp_tarjetacre,dfp_tarjetadeb,dfp_otros,dfp_compdeudas) VALUES ('".$idm."','".$numero_factura."','$date','$proceso_factura','$id_cliente','$id_vendedor','$factura','$bimponible0','$bimponible','$total_iva','".TAX."','$total_factura',$estado_facturan,'$desc_dolares','$conexiones[$i]','$claveacceso','$url','$estadosri','$resefectivo','$restarjetac','$restarjetad','$resdineroe','$rescreditod','0.00','$rescreditod','$ifl_creditod','$resotros','$rescompens','$id_tarjetac','$id_tarjetad','$id_otros','$id_compens')");
        }else{
            $efectivofi=$total_factura;
            $credidfi="0.00";
            $saldocdfi="0.00";
            if($conexiones[$i]=="con2"){
                if($fpruc2=="SI"):
                    $efectivofi="0.00";
                    $credidfi=$total_factura;
                    $saldocdfi=$total_factura;
                    $Fin.=" CREDITO DIRECTO";
                endif;
            }
            if($conexiones[$i]=="con3"){
                if($fpruc3=="SI"):
                    $efectivofi="0.00";
                    $credidfi=$total_factura;
                    $saldocdfi=$total_factura;
                    $Fin.=" CREDITO DIRECTO";
                endif;
            }
            $insert=mysqli_query($$conexiones[$i],"INSERT INTO movimientos(id_movimiento,numero_factura,fecha_movimiento,proceso,id_cliente,id_vendedor,factura,bimponible_iva0,bimponible_ivax,importe_iva,iva,total_venta,estado_factura,descuento,conexion,claveacceso,dir_archivo,estado_sri,fp_efectivo,fp_tarjetacre,fp_tarjetadeb,fp_dineroe,fp_creditodirecto,fp_creddir_abono,fp_creddir_saldo,fp_creddir_limitep,fp_otros,dfp_tarjetacre,dfp_tarjetadeb,dfp_otros) VALUES ('".$idm."','".$numero_factura."','$date','$proceso_factura','$id_cliente','$id_vendedor','$factura','$bimponible0','$bimponible','$total_iva','".TAX."','$total_factura','$estado_facturan','$desc_dolares','$conexiones[$i]','$claveacceso','$url','$estadosri','$efectivofi','0.00','0.00','0.00','$credidfi','0.00','$saldocdfi','0000-00-00','0.00','','','')");
        }
        $Fin.="\nNO SE ACEPTAN CAMBIOS NI \nDEVOLUCIONES";
        //$insert=mysqli_query($$conexiones[$i],"INSERT INTO movimientos(id_movimiento,numero_factura,fecha_movimiento,proceso,id_cliente,id_vendedor,factura,bimponible_iva0,bimponible_ivax,importe_iva,iva,total_venta,estado_factura,descuento,conexion,claveacceso,dir_archivo,estado_sri,fp_efectivo,fp_tarjetacre,fp_tarjetadeb,fpdineroe,fp_creditodirecto,fp_creditodir_abono,fp_creditodir_saldo,fp_creditodir_limitep,fp_otros,dfp_tarjetacre,dfp_tarjetadeb,dfp_otros) VALUES ('".$idm."','".$numero_factura."','$date','$proceso_factura','$id_cliente','$id_vendedor','$factura','$bimponible0','$bimponible','$total_iva','".TAX."','$total_factura','0','$desc_dolares','$conexiones[$i]','$claveacceso','$url','$estadosri',fp_efectivo,fp_tarjetacre,fp_tarjetadeb,fpdineroe,fp_creditodirecto,fp_creditodir_abono,fp_creditodir_saldo,fp_creditodir_limitep,fp_otros,dfp_tarjetacre,dfp_tarjetadeb,dfp_otros)");
        //echo "INSERT INTO movimientos(id_movimiento,numero_factura,fecha_movimiento,proceso,id_cliente,id_vendedor,factura,bimponible_iva0,bimponible_ivax,importe_iva,iva,total_venta,estado_factura,descuento,conexion,claveacceso,dir_archivo,estado_sri) VALUES ('".$idm."','".$numero_factura."','$date','$proceso_factura','$id_cliente','$id_vendedor','$factura','$bimponible0','$bimponible','$total_iva','".TAX."','$total_factura','0','$desc_dolares','$conexiones[$i]','$claveacceso','$url','PENDIENTE')";
        //exit();
        mysqli_query($$conexiones[$i],"UPDATE factureros SET facturero_siguiente=facturero_siguiente+1 WHERE facturero_siguiente='$numero_factura'");
        /*$cumTotal=0;
        $fp_query="";
        $restante_factura=floatval($total_factura);*/
            
        /*if(($resefectivo>0)&&($cumTotal==0)&&($restante_factura>0)){
            //echo $restante_factura." ".$resefectivo;
            if(number_format($restante_factura,2)<=number_format($resefectivo,2)){
                //echo "es menor";
                $fp_query.=" fp_efectivo='".number_format($restante_factura,2,'.','')."', estado_factura=1 ";
                $Fin.="EFEC: $".number_format($restante_factura,2,'.','');
                $cumTotal=1;
                $resefectivo-=$restante_factura;
                $restante_factura=0;
            }else{
                //echo "es mayor";
                $fp_query.=" fp_efectivo='".number_format($resefectivo,2,'.','')."' ";
                $Fin.="EFEC: $".number_format($resefectivo,2,'.','');
                $restante_factura=$restante_factura-$resefectivo;
                $resefectivo=0;
            }
        }
        if(($resdineroe>0)&&($cumTotal==0)&&($restante_factura>0)){
            if($fp_query!="") $fp_query.=", ";
            //echo $restante_factura." ".$resdineroe;
            if(number_format($restante_factura,2)<=number_format($resdineroe,2)){
                $fp_query.=" fp_dineroe='".number_format($restante_factura,2,'.','')."', estado_factura=1 ";
                $Fin.=" DIN ELEC: $".number_format($restante_factura,2,'.','');
                $cumTotal=1;
                $resdineroe-=$restante_factura;
                $restante_factura=0;
            }else{
                $fp_query.=" fp_dineroe='".number_format($resdineroe,2,'.','')."' ";
                $Fin.=" DIN ELEC: $".number_format($resdineroe,2,'.','');
                $restante_factura=$restante_factura-$resdineroe;
                $resdineroe=0;
            }
        };
        if(($restarjetac>0)&&($cumTotal==0)&&($restante_factura>0)){
            if($fp_query!="") $fp_query.=", ";
            //echo $restante_factura." ".$restarjetac;
            if(number_format($restante_factura,2)<=number_format($restarjetac,2)){
                //echo "es menor o igual";
                $fp_query.=" fp_tarjetacre='".number_format($restante_factura,2,'.','')."', dfp_tarjetacre='".$id_tarjetac."', estado_factura=1 ";
                $Fin.=" TAR CRE: $".number_format($restante_factura,2,'.','');
                $cumTotal=1;
                $restarjetac-=$restante_factura;
                $restante_factura=0;
            }elseif($restante_factura>$restarjetac){
                //echo "es mayor";
                $fp_query.=" fp_tarjetacre='".number_format($restarjetac,2,'.','')."', dfp_tarjetacre='".$id_tarjetac."' ";
                $Fin.=" TAR CRE: $".number_format($restarjetac,2,'.','');
                $restante_factura=$restante_factura-$restarjetac;
                $restarjetac=0;
            }
        };
        if(($restarjetad>0)&&($cumTotal==0)&&($restante_factura>0)){
            if($fp_query!="") $fp_query.=", ";
            //echo $restante_factura." ".$restarjetac;
            if(number_format($restante_factura,2)<=number_format($restarjetad,2)){
                //echo "es menor o igual";
                $fp_query.=" fp_tarjetadeb='".number_format($restante_factura,2,'.','')."', dfp_tarjetadeb='".$id_tarjetad."', estado_factura=1 ";
                $Fin.=" TAR DEB: $".number_format($restante_factura,2,'.','');
                $cumTotal=1;
                $restarjetad-=$restante_factura;
                $restante_factura=0;
            }elseif($restante_factura>$restarjetad){
                //echo "es mayor";
                $fp_query.=" fp_tarjetadeb='".number_format($restarjetad,2,'.','')."', dfp_tarjetadeb='".$id_tarjetad."' ";
                $Fin.=" TAR DEB: $".number_format($restarjetad,2,'.','');
                $restante_factura=$restante_factura-$restarjetad;
                $restarjetad=0;
            }
        };
        if(($resotros>0)&&($cumTotal==0)&&($restante_factura>0)){
            //echo $restante_factura." ".$resotros;
            if($fp_query!="") $fp_query.=", ";
            if(number_format($restante_factura,2)<=number_format($resotros,2)){
                $fp_query.=" fp_otros='".number_format($restante_factura,2,'.','')."', dfp_otros='".$id_otros."', estado_factura=1 ";
                $Fin.=" OTROS : $".number_format($restante_factura,2,'.','');
                $cumTotal=1;
                $resotros-=$restante_factura;
                $restante_factura=0;
            }else{
                $fp_query.=" fp_otros='".number_format($resotros,2,'.','')."', dfp_otros='".$id_otros."' ";
                $Fin.=" OTROS : $".number_format($resotros,2,'.','');
                $restante_factura=$restante_factura-$resotros;
                $resotros=0;
            }
        };
        if(($rescreditod>0)&&($cumTotal==0)&&($restante_factura>0)){
            if($fp_query!="") $fp_query.=", ";
            //echo $restante_factura." ".$rescreditod;
            if(number_format($restante_factura,2)<=number_format($rescreditod,2)){
                $fp_query.=" fp_creditodirecto='".number_format($restante_factura,2,'.','')."', fp_creddir_limitep='".$ifl_creditod."', fp_creddir_abono='0.00', fp_creddir_saldo='".$rescreditod."', estado_factura=0 ";
                $Fin.=" CRED DIRECTO: $".number_format($restante_factura,2,'.','');
                $cumTotal=1;
                $rescreditod-=$restante_factura;
                $restante_factura=0;
            }else{
                $fp_query.=" fp_creditodirecto='".number_format($rescreditod,2,'.','')."', fp_creddir_limitep='".$ifl_creditod."', fp_creddir_abono='0.00', fp_creddir_saldo='".$rescreditod."', estado_factura=0 ";
                $Fin.=" CRED DIRECTO: $".number_format($rescreditod,2,'.','');
                $restante_factura=$restante_factura-$rescreditod;
                $rescreditod=0;
            }
        };
        $Data.="\n";
        mysqli_query($$conexiones[$i],"UPDATE movimientos SET ".$fp_query." WHERE id_movimiento='$idm'");
        */
        $Data.="\n";
        if($conexiones[$i]=="con1"){
            require_once ("../../includes/sendemail.php");//Contiene funcion que conecta a la base de datos
            include("../../xml/factura_xml_crear.php");
            include('../../pdf/documentos/crear_factura_pdf.php');
            //sleep(5);
            //include("../../pdf/documents/res/factura_pdf_crear.php");
            //AQUI ENVIAR POR EMAIL ----OJOTE
            if($email_cliente!=""){
                    $template=$_SERVER['DOCUMENT_ROOT']."/syscatleia/includes/email_template.html";
                    sendemail(EMAIL_ELECTRONICO_1,EMAIL_PASS_1,EMAIL_ELECTRONICO_1,"Notificacion Comprobante Electronico - ".RAZON_SOCIAL_1,$email_cliente,"<h3>Has recibido un comprobante electrónico de CATLEIA.</h3>","CATLEIA COMPROBANTE ELECTRONICO",$template,"f".$claveacceso.".pdf","f".$claveacceso.".xml");
            }
            $Enc="Factura Elec: ".ESTABLECIMIENTO_1."-".PUNTOEMISION_1."-".formato_cadena($secuencia,9)."\n";
            $Enc.="Clave Acceso: ".$claveacceso."\n";
            $consultaaut=mysqli_query($$conexiones[$i],"SELECT estado_sri FROM movimientos WHERE id_movimiento='$idm'");
            $resaut=  mysqli_fetch_array($consultaaut);
            /*if($resaut["estado_sri"]=="AUTORIZADO"){
                $Enc.="Autorizacion: ".$claveacceso."\n";
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
        copy($file, "//".$ips[$i]);
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
function validar_cont($valor){
    if($valor==""){
        return $valor;
    }else{
        return number_format($valor,2,'.','');
    }
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