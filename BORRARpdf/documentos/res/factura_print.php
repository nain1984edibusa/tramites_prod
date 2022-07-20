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
	$sql_count=mysqli_query($$_SESSION['bd_comercial'],"select * from tmp where session_id='".$session_id."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('No hay productos agregados a la factura')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
        $proceso_factura=$_GET['proceso'];
    if($proceso_factura=="VEN"){
	//Variables por GET
	$id_cliente=intval($_GET['id_cliente']);
	$id_vendedor=intval($_GET['id_vendedor']);
        $factura=$_GET['factura'];
        $descuento=$_GET['descuento'];
        $i_efectivo=$_GET['i_efectivo'];
        $i_dineroe=$_GET['i_dineroe'];
        $i_tarjetac=$_GET['i_tarjetac'];
        $id_tarjetac=$_GET['id_tarjetac'];
        $i_otros=$_GET['i_otros'];
        $i_compens=$_GET['i_compens'];
        $i_tarjetad=$_GET['i_tarjetad'];
        $id_tarjetad=$_GET['id_tarjetad'];
        $id_otros=$_GET['id_otros'];
        $id_compens=$_GET['id_compens'];
        $i_creditod=$_GET['i_creditod'];
        $ifl_creditod=$_GET['ifl_creditod'];
        $fpruc2=$_GET['fpruc2'];
        $fpruc3=$_GET['fpruc3'];
     include(dirname('__FILE__').'/res/factura_html_print.php');
    }elseif($proceso_factura=="COM"){
	/*$id_proveedor=intval($_GET['id_proveedor']);
        $factura=$_GET['factura'];
        $numero_factura=$_GET['num_factura'];
	$condiciones=$_GET['condiciones'];
        $num_retencion = $_GET['num_retencion'];
        $retencion_iva = $_GET['retencion_iva'];
        $retencion_fuente = $_GET['retencion_fuente'];*/
        $idm=$_GET['idmov'];
        $estadob=$_GET['estadob'];
        ob_start();
        include(dirname('__FILE__').'/res/factura_html_compra.php');
    }elseif($proceso_factura=="SEP"){
	/*$id_proveedor=intval($_GET['id_proveedor']);
        $factura=$_GET['factura'];
        $numero_factura=$_GET['num_factura'];
	$condiciones=$_GET['condiciones'];
        $num_retencion = $_GET['num_retencion'];
        $retencion_iva = $_GET['retencion_iva'];
        $retencion_fuente = $_GET['retencion_fuente'];*/
        $id_cliente=intval($_GET['id_cliente']);
	$id_vendedor=intval($_GET['id_vendedor']);
        $factura=$_GET['factura'];
        $descuento=$_GET['descuento'];
        //$idm=$_GET['idmov'];
        //$estadob=$_GET['estadob'];
        ob_start();
        include(dirname('__FILE__').'/res/factura_html_separado.php');
        //exit();
    }
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
