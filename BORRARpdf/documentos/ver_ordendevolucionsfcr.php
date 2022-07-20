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
	$id_movimiento=$_GET["id_movimiento"];
        require_once(dirname(__FILE__).'/../html2pdf.class.php');
        // get the HTML
        ob_start();
        include(dirname('__FILE__').'/res/ver_ordendevolucionsfcr_html.php');
        $content = ob_get_clean();
try
{
    // init HTML2PDF
    $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    // display the full page
    $html2pdf->pdf->SetDisplayMode('fullpage');
    //$html2pdf->setDefaultFont("helvetica");
    //$html2pdf->setDefaultFont("dejavuserif");
    // convert
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    // send the PDF
    $html2pdf->Output('OrdenDevolucion'.$id_movimiento.'.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}