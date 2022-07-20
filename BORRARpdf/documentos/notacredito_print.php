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
        $idm=$_GET["mov"];
        $items=$_GET["items"];
include(dirname('__FILE__').'/res/notacredito_html_print.php');
echo "<script>window.close();</script>";
