<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/*REGISTRAR TRÁMITE*/
/*Recibe las variables del formulario de registro del trámite, registra su información básica, e
 * incluye otros archivos sobre el tratamiento de cada trámite según sus características específicas */
session_start();
require_once '../config/variables.php';
require_once '../modelo/Db.class.php';
require_once '../modelo/Config.class.php';
require_once '../includes/functions.php';
require_once "../modelo/util.php";
/*OBTENCIÓN DE DATOS DEL FORMULARIO*/
$codigo_tu=$_POST["atu_codigo"];
$id_tu=$_POST["atu_id"];
$id_tramite= $_POST["atra_id"]; //id del trámite
$id_tua= $_POST["atua_id"]; //id del requisito del trámite
$cumple= $_POST["acumple"];
$observaciones= $_POST["aobservaciones"];

//ANEXOS
require_once '../modelo/clstuanexos.php';
$clstuanexo = new clstuanexos();
$clstuanexo->setTu_id($id_tu);
$clstuanexo->setTua_id($id_tua);
$clstuanexo->setTra_id($id_tramite);
//$tra_correcto=$tra_incorrecto=$tra_pendiente=0;
$clstuanexo->setTua_cumple($cumple);
$clstuanexo->setTua_observaciones($observaciones);
$validar=$clstuanexo->tua_validar_anexo();
//PONER EL CAMPO RELACIONADO AL TRAMITE USUARIO X
require_once '../modelo/clstramiterespuestas.php';
$clsturespuesta = new clstramiterespuestas();
//VERIFICAR ESTADO DE LOS ANEXOS Y RESPUESTAS
include("verificar_estado_anxres.php");
if(($respuesta["tuc_cumple"]=="PENDIENTE")||($anx_pendiente>0)){
    $convalidar=-1;
}elseif(($respuesta["tuc_cumple"]=="CORRECTO")&&($anx_incorrecto==0)&&($anx_pendiente==0)){
    $convalidar=0;
}elseif(($respuesta["tuc_cumple"]=="INCORRECTO")||($anx_incorrecto>0)){
    $convalidar=1;
}
//echo $convalidar;
//exit();
//echo "ID".$clste->getTu_id();
$clste->setTu_band_convanxres($convalidar);
$clste->tra_cambiar_bandanxres("_ct_tramite".$id_tramite);
$clste->tra_cambiar_bandanxres("ct_tramite_usuario");
if($validar==0){
    redireccionar("../ui_visualizacion_tramite.php?idtu=".$id_tu."&proc=valanx&est=0");
}else{
    redireccionar("../ui_visualizacion_tramite.php?idtu=".$id_tu."&proc=valanx&est=1");
}
?>
