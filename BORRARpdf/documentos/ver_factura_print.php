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
	$id_movimiento= $_GET['id_movimiento'];
        $conexion= $_GET['con'];
	$sql_count=mysqli_query($$conexion,"select * from movimientos where id_movimiento='".$id_movimiento."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('Factura no encontrada')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	$sql_factura=mysqli_query($$conexion,"select * from movimientos where id_movimiento='".$id_movimiento."'");
	$rw_factura=mysqli_fetch_array($sql_factura);
	$numero_factura=$rw_factura['numero_factura'];
        $factura=$rw_factura['factura'];
	$id_cliente=$rw_factura['id_cliente'];
	$id_vendedor=$rw_factura['id_vendedor'];
	$fecha_movimiento=$rw_factura['fecha_movimiento'];
        $descuento=$rw_factura['descuento'];
	//$condiciones=$rw_factura['condiciones'];
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
    // get the HTML
    //ob_start();
    include(dirname('__FILE__').'/res/ver_factura_html_print.php');
    //$content = ob_get_clean();
    /*try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', array(210,297), 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        //$html2pdf->setDefaultFont("helvetica");
        //$html2pdf->setDefaultFont("dejavuserif");
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output($numero_factura.'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }*/
    echo "<script>window.close();</script>";