<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/*FIRMAR TRÁMITE*/
/*crea el pdf de respuesta, almacena la ruta en la base de datos, actualiza información de respuesta, y desencadena el proceso de firma el archivo */
/*de concretarse la firma, se completa la reasignación*/

session_start();
require_once '../config/variables.php';
require_once '../modelo/Db.class.php';
require_once '../modelo/Config.class.php';
require_once '../modelo/clstramiteusuario.php';
require_once '../modelo/clstramiterespuestas.php';
require_once '../modelo/clsauditoria.php';
require_once '../includes/functions.php';
require_once "../modelo/util.php";
/*OBTENCIÓN DE DATOS DEL FORMULARIO*/
$usuario = $_SESSION["codusuario"]; //código usuario
$tramite = $_REQUEST["id_tu_r"]; //id del trámite usuario
$id_tramite= $_REQUEST["id_tra"]; //id del trámite
$cod_tramite= $_REQUEST["cod_tra"]; //código del trámite
$reasignado_a = $_REQUEST["reasignado_a"]; //usuario al que se va a reasignar
//$observaciones_r= $_REQUEST["observaciones_r"]; //observaciones de la reasignación
$firma= $_REQUEST["firma"]; //código del trámite GENERAMOS EL PDF Y FIRMAMOS
if($firma==1){
    require_once '../modelo/clstu'.$id_tramite.'respuestas.php';
    //require_once '../modelo/clstramite'.$id_tramite.'.php';
    switch ($id_tramite){
        case "8": $clstramiteresp = new clstu8respuestas();
            break;
        //case "12": $clstramitee = new clstramite12();break;
    }
    //ACTUALIZAR CONTESTACIÓN, INCLUIDA RUTA PREESTABLECIDA DE LA RESPUESTA
    switch ($_SESSION["codperfil"]){
        case EJECUTOR:  //SI EL EJECUTOR REASIGNA AL APROBADOR, DEBE GENERAR EL PDF Y FIRMAR.
            $clstramiteresp->setUsu_aprobador($reasignado_a); 
            $actualizador="aprobador";
            break;
    }
    /*OTENER INFORMACIÓN DEL TRÁMITE ESPECÍFICO*/
    switch ($id_tramite){
        case "8": $clstramitee = new clstramite8();
            break;
        case "12": $clstramitee = new clstramite12();break;
    }
    $clstramitee->setTu_codigo($cod_tramite);
    $idtue=$clstramitee->tra_seleccionar_bycodigo();
    $idtue= mysqli_fetch_array($idtue);
    $clstramiteresp->setTu_id($idtue["tu_id"]);
    $nombre_archivo=md5(time().$cod_tramite).'.pdf';
    $ruta_archivo=RUTA_RESPUESTAS.$nombre_archivo;
    $clstramiteresp->setTuc_rutaarchivo($ruta_archivo);
    $clstramiteresp->tuc_actualizar_respuesta_firma($actualizador);
    //EL APROBADOR DEBE TENER LA OPCIÓN REASIGNAR (NO FIRMA NI GENERA PDF) O REASIGNAR Y ENVIAR CONTESTACIÓN.
    //CREACION DE PDF 
    include_once("../ajax/prev_respuesta_pdf.php"); 
    include_once("../librerias/pdf/reportes/respuesta_tramite_crearpdf.php"); 
    //FIRMA DEL ARCHIVO --PENDIENTE Y EN UNA SIGUIENTE PÁGINA--
}
?>