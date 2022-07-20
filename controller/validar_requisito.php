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
$codigo_tu=$_POST["etu_codigo"];
$id_tu=$_POST["etu_id"];
$id_tramite= $_POST["etra_id"]; //id del trámite
$id_tur= $_POST["etur_id"]; //id del requisito del trámite
$cumple= $_POST["cumple"];
$observaciones= $_POST["observaciones"];
$convalidar=$_POST["etu_convalidar"];
/*$matriz_convalidar= explode("/", $convalidar);
$convalidar=1;
if($cumple=="INCORRECTO"){
    $convalidar=0;
}else{
    for($i=0;$i<count($matriz_convalidar);$i++)
    {
        $convalidar*=$matriz_convalidar[$i];
    }
}*/
//echo $convalidar;
//INCLUIR TRAMITE ESPECÍFICO
//require_once '../modelo/clstramite'.$id_tramite.'.php';
/*--fin--*/
/*ACTUALIZAR INFORMACIÓN DEL REQUISITO DEL TRÁMITE*/
require_once '../modelo/clstramiteusuario.php';
require_once '../modelo/clstramite'.$id_tramite.'.php';
switch($id_tramite){
    case "5": $clste= new clstramite5(); $req=1; break; //1=TIENEN REQUISITOS 0=NO TIENEN REQUISITOS
    case "8": $clste= new clstramite8(); $req=1; break; //1=TIENEN REQUISITOS 0=NO TIENEN REQUISITOS
    case "12": $clste= new clstramite12(); $req=0; break;
    case "13": $clste= new clstramite13(); $req=1; break;
    case "16": $clste= new clstramite16(); $req=0; break;
    case "18": $clste= new clstramite18(); $req=0; break;
}
$clste->setTu_codigo($codigo_tu);
$restue=$clste->tra_seleccionar_bycodigo();
$idtue= mysqli_fetch_array($restue);
$idtue=$idtue["tu_id"];//ID TRAMITE ESPECIFICO USUARIO
//echo "id tramite e:".$idtue;
//REQUISITOS
require_once '../modelo/clsturequisitos.php';
$clsturequisito = new clsturequisitos();
$clsturequisito->setTu_id($id_tu);
$clsturequisito->setTur_id($id_tur);
$clsturequisito->setTra_id($id_tramite);
//$tra_correcto=$tra_incorrecto=$tra_pendiente=0;
if($id_tur=="SOLIC"){
    $clste->setTe_cumple($cumple);
    $clste->setTe_observaciones($observaciones);
    $validar=$clste->tra_validar_formsolicitud();
}else{
    $clsturequisito->setTur_cumple($cumple);
    $clsturequisito->setTur_observaciones($observaciones);
    $validar=$clsturequisito->tur_validar_requisito();
}
//PONER EL CAMPO RELACIONADO AL TRAMITE USUARIO X
$clsturequisito->setTu_id($idtue);
if($req==1){
    $req_correcto=$clsturequisito->tur_contar_validacionrequisitos("CORRECTO");
    $req_incorrecto=$clsturequisito->tur_contar_validacionrequisitos("INCORRECTO");
    $req_pendiente=$clsturequisito->tur_contar_validacionrequisitos("PENDIENTE");
}else{
    $req_correcto=$req_incorrecto=$req_pendiente=0;
}
$tra_correcto=$clste->tra_contar_validacionrequisitos("CORRECTO");
$tra_incorrecto=$clste->tra_contar_validacionrequisitos("INCORRECTO");
$tra_pendiente=$clste->tra_contar_validacionrequisitos("PENDIENTE");
if(($req_pendiente+$tra_pendiente)>0){
    //echo "HAY VARIOS PENDIENTES 1";
    $convalidar=-1;
}elseif(($req_incorrecto+$tra_incorrecto)>0){
    //echo "HAY VARIOS INCORRECTOS 0";
    $convalidar=1;
}else{
    //echo "TODOS SON CORRECTOS";
    $convalidar=0;
}
$clste->setTu_band_convalidar($convalidar);
$clste->tra_cambiar_bandconvalidacion("_ct_tramite".$id_tramite);
$clste->tra_cambiar_bandconvalidacion("ct_tramite_usuario");
//exit();
if($validar==0){
    redireccionar("../ui_visualizacion_tramite.php?idtu=".$id_tu."&proc=valreq&est=0");
}else{
    redireccionar("../ui_visualizacion_tramite.php?idtu=".$id_tu."&proc=valreq&est=1");
}
?>
