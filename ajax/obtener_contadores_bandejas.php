<?php
include_once("../config/variables.php");
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once("../modelo/clstramiteusuario.php");
/*CONTEO BANDEJAS*/
if(!session_id()){
    session_start();
}
$tramites_br = new clstramiteusuario();
$estados=array("0","1","2","3","4","5","6");
//ELABORACION
$tramites=$tramites_br->tra_contar_all_byusu($_SESSION["codusuario"],$estados[0],$_SESSION["codperfil"]);
$t_elaboracion= mysqli_fetch_array($tramites);
//VALIDACION
$tramites=$tramites_br->tra_contar_all_byusu($_SESSION["codusuario"],$estados[1],$_SESSION["codperfil"]);
$t_validacion= mysqli_fetch_array($tramites);
$tramites=$tramites_br->tra_contar_all_byusugrupo($_SESSION["codusuario"],$estados[1],$_SESSION["codperfil"],"D");
$t_validacion_d= mysqli_fetch_array($tramites);
$tramites=$tramites_br->tra_contar_all_byusugrupo($_SESSION["codusuario"],$estados[1],$_SESSION["codperfil"],"W");
$t_validacion_w= mysqli_fetch_array($tramites);
//ANALISIS
$tramites=$tramites_br->tra_contar_all_byusu($_SESSION["codusuario"],$estados[2],$_SESSION["codperfil"]);
$t_analisis= mysqli_fetch_array($tramites);
$tramites=$tramites_br->tra_contar_all_byusugrupo($_SESSION["codusuario"],$estados[2],$_SESSION["codperfil"],"D");
$t_analisis_d= mysqli_fetch_array($tramites);
$tramites=$tramites_br->tra_contar_all_byusugrupo($_SESSION["codusuario"],$estados[2],$_SESSION["codperfil"],"W");
$t_analisis_w= mysqli_fetch_array($tramites);
//CONVALIDACION
$tramites=$tramites_br->tra_contar_all_byusu_ve($_SESSION["codusuario"],array($estados[3],$estados[4]),$_SESSION["codperfil"]);
$t_convalidacion= mysqli_fetch_array($tramites);
$tramites=$tramites_br->tra_contar_all_byusugrupo_ve($_SESSION["codusuario"],array($estados[3],$estados[4]),$_SESSION["codperfil"],"D");
$t_convalidacion_d= mysqli_fetch_array($tramites);
$tramites=$tramites_br->tra_contar_all_byusugrupo_ve($_SESSION["codusuario"],array($estados[3],$estados[4]),$_SESSION["codperfil"],"W");
$t_convalidacion_w= mysqli_fetch_array($tramites);
//CONTESTADOS EN REVISIÓN
$tramites=$tramites_br->tra_contar_all_byusu($_SESSION["codusuario"],$estados[5],$_SESSION["codperfil"]);
$t_contestados_r= mysqli_fetch_array($tramites);
$tramites=$tramites_br->tra_contar_all_byusugrupo($_SESSION["codusuario"],$estados[5],$_SESSION["codperfil"],"D");
$t_contestados_r_d= mysqli_fetch_array($tramites);
$tramites=$tramites_br->tra_contar_all_byusugrupo($_SESSION["codusuario"],$estados[5],$_SESSION["codperfil"],"W");
$t_contestados_r_w= mysqli_fetch_array($tramites);
//CONTESTADOS DESPACHADOS
$tramites=$tramites_br->tra_contar_all_byusu($_SESSION["codusuario"],$estados[6],$_SESSION["codperfil"]);
$t_contestados= mysqli_fetch_array($tramites);
/*$_SESSION["bandeja_elaboracion"]=$t_elaboracion["total"];
$_SESSION["bandeja_validacion"]=$t_validacion["total"];
$_SESSION["bandeja_analisis"]=$t_analisis["total"];
$_SESSION["bandeja_convalidacion"]=$t_convalidacion["total"];
$_SESSION["bandeja_contestados"]=$t_contestados["total"];*/
$return = array();
$return_array["bandeja_elaboracion"]=$t_elaboracion["total"];
$return_array["bandeja_validacion"]=$t_validacion["total"];
$return_array["bandeja_validacion_d"]=$t_validacion_d["total"];
$return_array["bandeja_validacion_w"]=$t_validacion_w["total"];
$return_array["bandeja_analisis"]=$t_analisis["total"];
$return_array["bandeja_analisis_d"]=$t_analisis_d["total"];
$return_array["bandeja_analisis_w"]=$t_analisis_w["total"];
$return_array["bandeja_convalidacion"]=$t_convalidacion["total"];
$return_array["bandeja_convalidacion_d"]=$t_convalidacion_d["total"];
$return_array["bandeja_convalidacion_w"]=$t_convalidacion_w["total"];
$return_array["bandeja_contestados_revision"]=$t_contestados_r["total"];
$return_array["bandeja_contestados_revision_d"]=$t_contestados_r_d["total"];
$return_array["bandeja_contestados_revision_w"]=$t_contestados_r_w["total"];
$return_array["bandeja_contestados"]=$t_contestados["total"];
array_push($return, $return_array);
//echo $_SESSION["codusuario"];
if(!isset($index)){
echo json_encode($return);
}