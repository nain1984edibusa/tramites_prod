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

	require_once(dirname(__FILE__).'/../html2pdf.class.php');
	//Variables por GET
        $id_consultora= intval($_GET["id_consultora"]);
        $id_vendedor = intval($_GET["id_vendedor"]);
	$fecha = $_GET["fecha"];
        $catcam = $_GET["catcam"];
        $num_orden = $_GET["num_orden"];
        $total_pedido = number_format($_GET["total_pedido"],2,'.','');
        $abono = number_format($_GET["abono"],2,'.','');
        $reprogramacion =$_GET["reprogramacion"];
        $repro_descripcion = $_GET["repro_descripcion"]; 
        $repro_descripcion = str_replace("<br>","\n", $repro_descripcion);
     ob_start();
     include(dirname('__FILE__').'/res/pedido_html.php');
    $content = ob_get_clean();
    try
    {
        $html2pdf = new HTML2PDF('P', 'A5', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('pedido.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
