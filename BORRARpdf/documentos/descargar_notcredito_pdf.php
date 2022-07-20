<?php
	/*-------------------------
	Autor: GRUPO DIGITAL
	Mail: gdsistemasmultimedia@gmail.com
	---------------------------*/
        session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
		exit;
        }
	/* Connect To Database*/
	include("../../config/db.php");
	include("../../config/conexion.php");
        include("../../includes/funciones.php");
	$id_movimiento=$_GET["id_movimiento"];
	$sql_count=mysqli_query($con1,"select * from movimientos where id_movimiento='".$id_movimiento."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('Nota de crédito no encontrada')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	$sql_factura=mysqli_query($con1,"select movimientos.*, clientes.* from movimientos INNER JOIN clientes ON clientes.id_cliente=movimientos.id_cliente where id_movimiento='".$id_movimiento."'");
        //echo "select movimientos.*, clientes.* from movimientos INNER JOIN clientes ON clientes.id_cliente=movimientos.id_cliente where id_movimiento='".$id_movimiento."'";
	$rowgasto=mysqli_fetch_array($sql_factura);
	$numero_factura=$rowgasto['numero_factura'];
        $ivap=$rowgasto['iva'];
        $fecha_emision=substr($rowgasto["fecha_movimiento"],0,10);
        $razonsocial=$rowgasto["nombre_cliente"];
        $direccion=$rowgasto["direccion_cliente"];
        $idprov=$rowgasto["id_proveedor"];
        $ruc=$rowgasto["ruc_ci"];
        $autorizacion=$rowgasto["claveacceso"];
        $numero_factura=$rowgasto["numero_factura"];
        $base0=$rowgasto["bimponible_iva0"];
        $base_imponibleiva=$rowgasto["bimponible_ivax"];
        $iva=$rowgasto["importe_iva"];
        $total=$rowgasto["total_venta"];
        $efectivo=$rowgasto["fp_efectivo"];
        $tardeb=$rowgasto["fp_tarjetadeb"];
        $tarcred=$rowgasto["fp_tarjetacre"];
        $dielec=$rowgasto["fp_dineroe"];
        $otros=$rowgasto["fp_otros"];
        $compensacion=$rowgasto["fp_compdeudas"];
        $endoso=$rowgasto["fp_endosot"];
        /*$numero_retencion=$rowgasto["num_retencion"];
        $tipoeretencion=$rowgasto["temision_ret"];
        $emir="";
        if($tipoeretencion=="E"){
            $emir="ELECTRÓNICA";
        }else
        {
            $emir="FISICA";
        }
        $fechaemisionretencion=$rowgasto["fecha_emision_ret"];
        $porrenta=$rowgasto["por_retencion_fuente"];
        $imprenta=$rowgasto["retencion_fuente"];
        $poriva=$rowgasto["por_retencion_iva"];
        $valiva=$rowgasto["retencion_iva"];
        $codigo_retret=$rowgasto["codigo_retencionret"];
        $estado_factura=$rowgasto["estado_factura"];*/
        $subtotal2factura=$base0+$base_imponibleiva;
        //$descuento=$rw_factura['descuento'];
	//$condiciones=$rw_factura['condiciones'];
	require_once($_SERVER['DOCUMENT_ROOT'].'/syscatleia/pdf/html2pdf.class.php');
    // get the HTML
        ob_start();
        include($_SERVER['DOCUMENT_ROOT'].'/syscatleia/pdf/documentos/res/ver_notacredito_pdf.php');
        $content = ob_get_clean();
    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output("n".$autorizacion.'.pdf');
        //$html2pdf->Output($_SERVER['DOCUMENT_ROOT'].'/syscatleia/xml/docelectronicos/pdfs/n'.$autorizacion.'.pdf', 'F'); 
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
