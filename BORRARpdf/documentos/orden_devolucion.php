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
	echo "<script>alert('No hay productos agregados a la orden de devolución')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
        $proceso_devolucion=$_GET['proceso'];
    //if($proceso_devolucion=="ODS"){ // ORDEN DE DEVOLUCION SIN FACTURA REGISTRADA
	$estadob=$_GET['estadob'];
	$id_proveedor=$_GET['prov'];
        $id_movimiento=$_GET['mov'];
        $mod=$_GET['mod'];
        //$mod=$_GET['mod'];
        $fecha=$_GET['fecha'];
        $num_factura=$_GET['numf'];
        include(dirname('__FILE__').'/res/ordendevs_html.php');
    //}elseif($proceso_devolucion=="ODE"){ //ORDEN DE DEVOLUCION CON FACTURA REGISTRADA
        //$idm=$_GET['idmov'];
        //$estadob=$_GET['estadob'];
        //ob_start();
        //include(dirname('__FILE__').'/res/factura_html_compra.php');
    //}
    echo "<script>window.close();</script>";
