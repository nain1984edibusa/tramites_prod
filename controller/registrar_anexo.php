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
require_once '../modelo/clstramiteusuario.php';
require_once '../modelo/clstuanexos.php';
require_once '../includes/functions.php';
require_once "../modelo/util.php";
/*OBTENCIÓN DE DATOS DE LA SESION Y DEL FORMULARIO*/
$codigo_tu = $_POST["tra_codigo"];
$id_tramite = $_POST["tra_id"]; //id del trámite
/*$anexo_id = $_POST["anexo_id"]; //id del trámite
$tu_id = $_POST["tu_id"]; //estado del trámite*/
$tua_id=$_POST["tua_id"];
$tu_idg = $_POST["tu_idg"]; //id del tramite general
$anexo_codigo=$_POST["anexo_codigo"];
//OBTENIENDO REQUISITOS
$fileTmpPath_anexo = $_FILES['anexo_file']['tmp_name'];
$fileName_anexo = $_FILES['anexo_file']['name'];
$ruta_subirarchivo=RUTA_ARCHIVOSTRAMITES.$codigo_tu."/";
$anexo=subir_archivo($fileTmpPath_anexo, $fileName_anexo, $ruta_subirarchivo);
if($anexo!==0){
    //REGISTRAR ANEXO
    $anexor=new clstuanexos();
    $anexor->setTua_id($tua_id);
    $anexor->setTra_id($id_tramite);
    /*$anexor->setAnx_id($anexo_id);
    $anexor->setTu_id($tu_id);
    $anexor->tua_eliminar_anexotipo();*/
    $anexor->setTua_rutaarchivo($ruta_subirarchivo.$anexo);
    $anexor->setTua_codigoe($anexo_codigo);
    //$reg_anexo=$anexor->tua_insertar();
    $reg_anexo=$anexor->tua_actualizar();
    //exit();
    if($reg_anexo==1){
        //ACTUALIZAR BANDERA DE RESPUESTA EN TRAMITE USUARIO Y TRAMITE ESPECIFICO
        $clstramiteusuario=new clstramiteusuario();
        $clstramiteusuario->setTu_id($tu_idg);
        $clstramiteusuario->setTu_codigo($codigo_tu);
        //VERIFICAR QUE TODOS LOS ANEXOS Y RESPUESTAS ESTÁN COMO PENDIENTE O CUMPLIDO, PARA PONER -1
        $clstuanexo = new clstuanexos();
        require_once '../modelo/clstramiterespuestas.php';
        $clsturespuesta = new clstramiterespuestas();
        include("verificar_estado_anxres.php");
        if(($anx_incorrecto==0)&&($respuesta["tuc_cumple"]!="INCORRECTO")){
            //echo "si cambio";
            $clstramiteusuario->setTu_band_convanxres("-1");
            $clstramiteusuario->tra_cambiar_bandanxres("ct_tramite_usuario");
            $clstramiteusuario->tra_cambiar_bandanxres("_ct_tramite".$id_tramite);
        }
        //exit();
        //REDIRECCIONAR
        redireccionar("../ui_respuestas_tramites.php?idt=".$id_tramite."&idtu=".$tu_idg."&proc=reganx&est=1");
    }else{
        //REDIRECCIONAR
        redireccionar("../ui_respuestas_tramites.php?idt=".$id_tramite."&idtu=".$tu_idg."&proc=reganx&est=0");
    }
}else{
    //exit();
    //REDIRECCIONAR
    redireccionar("../ui_respuestas_tramites.php?idt=".$id_tramite."&idtu=".$tu_idg."&proc=reganx&est=0");
}

?>