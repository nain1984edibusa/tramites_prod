<?php
/*ACTUALIZAR INFORMACIÓN DEL REQUISITO DEL TRÁMITE*/
require_once '../modelo/clstramiteusuario.php';
require_once '../modelo/clstramite'.$id_tramite.'.php';
switch($id_tramite){
    case "5": $clste= new clstramite5(); break;
    case "8": $clste= new clstramite8(); break;
    case "12": $clste= new clstramite12(); break;
    case "13": $clste= new clstramite13(); break;
    case "16": $clste= new clstramite16(); break;
    case "18": $clste= new clstramite18(); break;
}
$clste->setTu_codigo($codigo_tu);
$restue=$clste->tra_seleccionar_bycodigo();
$idtue= mysqli_fetch_array($restue);
$idtue=$idtue["tu_id"];//ID TRAMITE ESPECIFICO USUARIO
$clstuanexo->setTu_id($idtue);
$clstuanexo->setTra_id($id_tramite);
$anx_correcto=$clstuanexo->tua_contar_validacionanexos("CORRECTO");
$anx_incorrecto=$clstuanexo->tua_contar_validacionanexos("INCORRECTO");
$anx_pendiente=$clstuanexo->tua_contar_validacionanexos("PENDIENTE");
$clsturespuesta->setTu_id($idtue);
$clsturespuesta->setTra_id($id_tramite);
$respuesta=mysqli_fetch_array($clsturespuesta->obtener_tramiterespuestas());

