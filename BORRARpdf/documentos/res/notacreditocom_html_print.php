<?php
#$nums=1;
/*require 'res/escpos-php-development/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;*/
$sumador_total=0;
    //$tmpdir = sys_get_temp_dir();
    //$file =  tempnam($tmpdir, 'ctk');
    //$connector = new FilePrintConnector($file);
    //$printer = new Printer($connector);
    //$claveacceso="";
    //$url="";
    date_default_timezone_set('America/Guayaquil');
    $idnc=date("YmdHis").$_SESSION['user_id'];
    $sql_factura=mysqli_query($$_SESSION['bd_comercial'],"SELECT movimientos.*, proveedores.* from movimientos INNER JOIN proveedores ON movimientos.id_proveedor=proveedores.id_proveedor WHERE id_movimiento='$idm'");
    $rsql_factura=  mysqli_fetch_array($sql_factura);
    $docmodificado=$rsql_factura["numero_factura"];
    $idproveedor=$rsql_factura["id_proveedor"];
    $fechaemisionsustento=$rsql_factura["fecha_movimiento"];
    /*$sql_ncnum ="SELECT notacredito_siguiente from notascredito WHERE notacredito_estado=1 ORDER BY id_notacredito DESC LIMIT 0,1";
    $res_ncnum = mysqli_query($$_SESSION['bd_comercial'], $sql_ncnum);
    $res_ncnum=  mysqli_fetch_array($res_ncnum);
    $ncs=$res_ncnum["notacredito_siguiente"];*/
    $fechamov=date("Y-m-d H:i:s");
    $conexion=$$_SESSION['bd_comercial'];
    $con=$_SESSION['bd_comercial'];
    $sql_nc=mysqli_query($$_SESSION['bd_comercial'],"INSERT INTO movimientos (id_movimiento,numero_factura,fecha_movimiento,proceso,id_proveedor,iva,conexion,autorizacion)VALUES('$idnc','$ncs','$fechaemision','NCD','$idproveedor','".TAX."','$con','$aut')");
    //echo "INSERT INTO movimientos (id_movimiento,numero_factura,fecha_movimiento,proceso,id_cliente,iva,conexion)VALUES('$idnc','$ncs','$fechamov','NCR','$idcliente','12','con1')";
    //$sql=mysqli_query($$_SESSION["bd_comercial"],"SELECT detalle_movimiento.*, products.nombre_producto from detalle_movimiento INNER JOIN products ON products.id_producto=detalle_movimiento.id_producto where id_movimiento='".$id_movimiento."'");
    if(mysqli_num_rows($sql_factura)>0){
        ?>
        <?php 
        /*$largo_encabezado=33; 
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
        $img = EscposImage::load("res/logo.jpg");
        $printer -> graphics($img);
        $Enc="\n\n"."------------- NOTA DE CRÉDITO -------------"."\n\n";
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
        #DATOS DE LOS CLIENTES Y FECHA
        $id_cliente=$rsql_factura["id_cliente"];
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
         * 
         */
        $iva="";
        $iva0=0;
        $ivax=0;
        $count=0;
        $date2=date("Y-m-d H:i:s");
        $sum_b_imponible=0;
        $sum_b_cero=0;
        $subtotalNC=0;
        //$descuentototal=0;
        //OJOTE ITEMS
        $items = trim($items, ';');
        $rows=explode(";",$items);
        //RESETEAR CANT DEV
        $movreset=mysqli_query($$_SESSION['bd_comercial'], "SELECT * from detalle_movimiento WHERE id_movimiento='$idm'");
        while($row=mysqli_fetch_array($movreset)){
            $pro=$row["id_producto"];
            $can=$row["cantidad"];
            mysqli_query($$_SESSION['bd_comercial'], "UPDATE products set cant_ordendev=cant_ordendev-'$can' WHERE id_producto='$pro'");
        }
        for($i=0;$i<count($rows);$i++){
            if($rows!="")
            {
                $rowi=explode(",",$rows[$i]);
                $detalleid=$rowi[0];
                $cantidad=$rowi[1];
                $precio=$rowi[2];
                $detallemovo=mysqli_query($$_SESSION['bd_comercial'], "SELECT detalle_movimiento.*, products.codigo_adc, products.nombre_producto, products.IVA from detalle_movimiento INNER JOIN products ON detalle_movimiento.id_producto=products.id_producto WHERE id_detalle='$detalleid'");
                $resdetallemovo=mysqli_fetch_array($detallemovo);
                $id_producto=$resdetallemovo["id_producto"];
                $cantg=$resdetallemovo["cantidad"];
                //mysqli_query($$_SESSION['bd_comercial'], "UPDATE products set cant_ordendev=cant_ordendev-'$cantg' WHERE id_producto='$id_producto'");
                //VALORES DE LA FACTURA ORIGEN
                //$pventag=$resdetallemovo["precio_venta"];
                $precio=floatval($precio);
                $cantidad=intval($cantidad);
                $iva=$resdetallemovo["iva"];
                //CON QUE VALORES SE VA
                $subtotal=$precio*$cantidad;
                $subtotal=round($subtotal,2);
                //$subtotalNC+=$subtotal;
                $pv=number_format($precio,2,'.','');
                $insert_detail=mysqli_query($$_SESSION['bd_comercial'], "INSERT INTO detalle_movimiento (id_movimiento, id_producto, cantidad, precio_venta,descuento, iva) VALUES ('".$idnc."','$id_producto','$cantidad','$pv','','$iva')");
                //CONSULTAR COSTO ENTRADA KARDEX  Y GENERAR TOTALES
                /*$CPV=mysqli_query($$_SESSION['bd_comercial'], "SELECT * from kardex WHERE id_producto='$id_producto' and id_movimiento='$idm'");
                $resCPV=  mysqli_fetch_array($CPV);
                $costoventa=$resCPV["entradas_costo"];*/
                //echo "SELECT * from kardex WHERE id_producto='$id_producto' and id_movimiento='$idm'";
                $UKP=mysqli_query($$_SESSION['bd_comercial'], "SELECT existencias_cant,existencias_costo,existencias_total from kardex WHERE id_producto='$id_producto' ORDER BY id_kardex DESC LIMIT 0,1");
                $resUKP=  mysqli_fetch_array($UKP);
                $ultimocosto=$resUKP["existencias_costo"];
                $cantidad_stock=$resUKP["existencias_cant"];
                $ultimototal=$resUKP["existencias_total"];
                $total_mov=number_format($precio*$cantidad,4,".",'');
                $nueva_cant=$cantidad_stock-$cantidad;
                $nuevo_total=$ultimototal-$total_mov;
                $nuevo_total=number_format($nuevo_total,4,".",'');
                $nuevo_costo=$nuevo_total/$nueva_cant;
                $nuevo_costo=number_format($nuevo_costo,4,".",'');
                $costoventa= number_format($precio,4,'.','');
                if($resdetallemovo['IVA']=="SI"){
                    $sum_b_imponible+=$subtotal;
                    $iva=$resdetallemovo["iva"];
                }else{
                    //$sum_b_cero+=$precio_total_r;
                    $sum_b_cero+=$subtotal;
                    $iva=0;
                }  
                //$subtotal+=$preciot;
                $insert_kardex=mysqli_query($$_SESSION['bd_comercial'], "INSERT INTO kardex VALUES ('','".$id_producto."','$fechamov','DEVC','$idnc','','','','$cantidad','$costoventa','$total_mov','$nueva_cant','$nuevo_costo','$nuevo_total')");
                //echo "INSERT INTO kardex VALUES ('','".$id_producto."','$fechamov','DEVC','$idnc','','','','$cantidad','$costoventa','$total_mov','$nueva_cant','$nuevo_costo','$nuevo_total')";
                //exit();
                $update_stock_producto=mysqli_query($$_SESSION['bd_comercial'],"UPDATE products set stock = stock - ".$cantidad." where id_producto='".$id_producto."'");
                $count++;
                /*$codigo_producto=$resdetallemovo['codigo_adc'];
                $nombre_producto=$resdetallemovo['nombre_producto'];
                //$prod=encabezado($cantidad,5)." ".encabezado($nombre_producto,38)." ".precios($precio_venta_f,9)." ".precios($precio_total_f,9);
                $prod=" ".encabezado($cantidad,3)." ".encabezado($codigo_producto,6)." ".encabezado($nombre_producto,35)." ".precios($pv,8)." ".precios($subtotal,7);
                $Cuerpo .= $prod."\n";
                if(strlen($nombre_producto)>35){
                    $res=strlen($nombre_producto)-35;
                    $recorrido=0;
                    $empieza=35;
                    $Cuerpo.="             ".substr($nombre_producto, $empieza,35)."\n";
                    $count++;
                } */
            }
        }
        $importeiva=$sum_b_imponible*$iva;
        $importeiva=number_format($importeiva,2,'.','');
        $totalnc=$sum_b_cero+$sum_b_imponible+$importeiva;
        $sum_b_imponible=number_format($sum_b_imponible,2,'.','');
        $sum_b_cero=number_format($sum_b_cero,2,'.','');
        $importeiva=number_format($importeiva,2,'.','');
        $totalnc=  number_format($totalnc,2,'.','');
        //items
        /*$fcount=$count;
        //$subtotal=$sum_b_imponible+$sum_b_cero;
        $subtotal=number_format($subtotalNC,2,'.','');
        $bimponible0=$sum_b_cero;
        $bimponible=$sum_b_imponible;
        $desc_dolares=$descuentototal;
        $desc_dolares=number_format($desc_dolares,2,'.','');
        $bimponible0=number_format($bimponible0,2,'.','');
        $bimponible=number_format($bimponible,2,'.','');
	$total_iva=($bimponible * TAX )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$bimponible0+$bimponible+$total_iva;*/
        /*$espacioext="";
        if($_SESSION['bd_comercial']=="con1"): $espacioext="                        "; endif;
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
        $Cuerpo .=$inf6."\n";*/
        $tar0=number_format($tar0,2,'.','');
        $tarx=number_format($tarx,2,'.','');
        $iiva=number_format($iiva,2,'.','');
        $itotal=number_format($itotal,2,'.','');
        $sql_n2=mysqli_query($$_SESSION['bd_comercial'],"UPDATE movimientos SET bimponible_iva0='".$tar0."',bimponible_ivax='".$tarx."',importe_iva='".$iiva."',total_venta='".$itotal."'  where id_movimiento='$idnc'");
        $sql_FC=mysqli_query($$_SESSION['bd_comercial'],"UPDATE movimientos SET modifica='$idm' WHERE id_movimiento='$idnc'");
        //mysqli_query($$_SESSION['bd_comercial'],"UPDATE notascredito SET notacredito_siguiente=notacredito_siguiente+1 WHERE notacredito_siguiente='$ncs'");
        //echo "UPDATE movimientos SET bimponible_iva0='".number_format($bimponible0,2,'.','')."',bimponible_ivax='".number_format($bimponible,2,'.','')."',importeiva='".number_format($total_iva,2,'.','')."',descuento='".number_format($desc_dolares,2,'.','')."', total_venta='".number_format($total_factura,2,'.','')."' where id_movimiento='$idnc'";
        //date_default_timezone_set('America/Guayaquil');
        //$date=date("Y-m-d H:i:s");
        //$total_factura=number_format($total_factura,2,'.','');
        //mysqli_query($$_SESSION['bd_comercial'],"UPDATE notascredito SET notacredito_siguiente=notacredito_siguiente+1 WHERE notacredito_siguiente='$ncs'");
        /*$Data.="\n";
        require_once ("../../includes/sendemail.php");
        include("../../xml/ncredito_xml_crear.php");
        include('../../pdf/documentos/crear_notcredito_pdf.php');
        if($email_cliente!=""){
                $template=$_SERVER['DOCUMENT_ROOT']."/syscatleia/includes/email_template.html";
                sendemail(EMAIL_ELECTRONICO_1,EMAIL_PASS_1,EMAIL_ELECTRONICO_1,"Notificacion Comprobante Electronico - ".RAZON_SOCIAL_1,$email_cliente,"<h3>Has recibido un comprobante electrónico de CATLEIA.</h3>","CATLEIA COMPROBANTE ELECTRONICO",$template,"n".$claveacceso.".pdf","n".$claveacceso.".xml");
            }
        $Enc="Nota de Credito: ".ESTABLECIMIENTO_1."-".PUNTOEMISION_1."-".formato_cadena($secuencia,9)."\n";
        $Enc.="Clave Acceso: ".$claveacceso."\n";
        $Fin.="Aplica a:".$docm."\n";
        $Fin.="Motivo: DEVOLUCION\n\n\n\n\n\n\n\n\n\n";
        $Fin.="***Recibi Conforme***";
        $Fin.="\n\n"."Estimado cliente puede consultar sus facturas electronicas en http://catleia.grupodigital.ec en las siguientes 24 horas, o en la pagina web del SRI."."\n";
        $k=0;
            while($k<3){
                $Fin .= "\n";
                $k++;
            }
            $printer -> text($Enc);
        }
        //
        //echo $Enc.$Cuerpo.$Fin;
        //exit();
        $printer -> setFont(Printer::FONT_B);
        $printer -> setTextSize(1, 1);
        $printer -> text($Cuerpo);
        $printer -> selectPrintMode(); # Reset
        $printer -> text($Fin);
        $printer -> cut();
        $printer -> close();
        copy($file, "//".IP_COMERCIAL_1);
        unlink($file);
//$delete=mysqli_query($$_SESSION['bd_comercial'],"DELETE FROM tmp WHERE session_id='".$session_id."'");
//FUNCIONES NO BORRAR*/
}
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
