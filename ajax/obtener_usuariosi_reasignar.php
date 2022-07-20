<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/*OBTENER LISTADO DE USUARIOS PARA REASIGNAR TRÁMITE*/
/*Recibe el perfil y ubicación (zonal/regional) específica del usuario que puede recibir el trámite para hacer una búsqueda en la tabla ct_usuarios
 * y devuelve el contenido en un listado (listbox) a ser incrustado por ajax en el formulario de reasignación de trámite */
session_start();
require_once '../config/variables.php';
require_once '../modelo/Db.class.php';
require_once '../modelo/Config.class.php';
require_once '../modelo/clsusuarios.php';
require_once '../includes/functions.php';
require_once "../modelo/util.php";
//DETERMINAR EL PERFIL QUE RECIBE, EN BASE AL QUE REASIGNA
$perfil_reasigna=$_POST["perfil"];
$perfil_recibe="";
$nuevo_estado="";
switch ($perfil_reasigna){
    case ASIGNADOR: $perfil_recibe=EJECUTOR; break;
    case EJECUTOR: $perfil_recibe=APROBADOR; break;
    case APROBADOR: $perfil_recibe=EJECUTOR; break;
    default: $perfil_recibe="0"; break;
}
//DETERMINAR SI RECIBE LA REGIONAL O LA ZONAL
$tu=$_POST["idtu"]; //id del trámite usuario específico
$regional_procede=$_POST["reg"];
$respuesta=$_POST["respuesta"];
$regional_recibe="";
switch ($respuesta){
    case "Matriz": $regional_recibe=MATRIZ; break;
    case "Zonal": $regional_recibe=$regional_procede; break;
}
/*CREAR ESTRUCTURA HTML PARA INCLUIRLA EN SELECT*/
$clsusuario = new clsusuarios();
$receptores=$clsusuario->get_usuario_by_zonal_perfil($regional_recibe,$perfil_recibe);
$respuesta="<option value='' selected=''>Selecciona un profesional</option>";
while($receptor= mysqli_fetch_array($receptores)){
    $respuesta.="<option value='".$receptor["usu_id"]."'>".$receptor["usu_apellido"]." ".$receptor["usu_nombre"]." -- ".$receptor["usu_direccion"]."</option>";
}
echo $respuesta;


