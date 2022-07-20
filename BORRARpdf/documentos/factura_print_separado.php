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
	$session_id= session_id();
	/*$sql_count=mysqli_query($$_SESSION['bd_comercial'],"select * from tmp where session_id='".$session_id."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('No hay productos agregados a la factura')</script>";
	echo "<script>window.close();</script>";
	exit;
	}*/
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
        
        $id_movimiento=$_GET['id_movimiento'];
        $conexion=$_GET['con'];
        $id_cliente=$_GET['id_cliente'];
        //$idm=$_GET['idmov'];
        //$estadob=$_GET['estadob'];
        ob_start();
        include(dirname('__FILE__').'/res/factura_html_separado_print.php');
    /*$content = ob_get_clean();
    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', array(210,297), 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
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
