<?php
//CAMPOS ESPECÍFICOS DEL TRÁMITE 12
require_once '../modelo/clstramite12.php';
require_once '../modelo/clstramiterequisitos.php';
require_once '../modelo/clsturequisitos.php';
require_once '../modelo/clstramiteanexos.php';
require_once '../modelo/clstuanexos.php';
$te_ambito=$_POST["ambitos"];
$te_cantidad_fichas=$_POST["cantidad_fichas"];
$te_persona_responsable=$_POST["persona_responsable"];
$te_fecha_ingreso=$_POST["fecha_ingreso"];
$te_tecnico_responsable=$_POST["tecnico_responsable"];
$te_fecha_revision=$_POST["fecha_revision"];
//CREANDO EL TRÁMITE
$clstut = new clstramite12();
$clstut->setTu_codigo($clstramiteusuario->getTu_codigo());
$clstut->setUsu_eid($clstramiteusuario->getUsu_eid());
$clstut->setTra_id($clstramiteusuario->getTra_id());
$clstut->setTu_fecha_ingreso($clstramiteusuario->getTu_fecha_ingreso());
$clstut->setTu_fecha_aprocont($clstramiteusuario->getTu_fecha_aprocont());
$clstut->setTu_fecha_contcont($clstramiteusuario->getTu_fecha_contcont());
/*ADD1/1*/
$clstut->setTu_fecha_iniciocoa($fecha_ingreso);
$clstut->setTu_fecha_concoa($fecha_control_coa);
/*add*/
$clstut->setReg_id($clstramiteusuario->getReg_id());
$clstut->setEt_id($clstramiteusuario->getEt_id());
$clstut->setUsu_iid($clstramiteusuario->getUsu_iid());
$clstut->setTe_ambito($te_ambito);
$clstut->setTe_cantidad_fichas($te_cantidad_fichas);
$clstut->setTe_persona_responsable($te_persona_responsable);
$clstut->setTe_fecha_ingreso($te_fecha_ingreso);
$clstut->setTe_tecnico_responsable($te_tecnico_responsable);
$clstut->setTe_fecha_revision($te_fecha_revision);
$tu12_id=$clstut->tu_insertar();
//OBTENIENDO REQUISITOS
$fileTmpPath_fichas = $_FILES['rfichas']['tmp_name'];
$fileName_fichas = $_FILES['rfichas']['name'];
$id_rfichas=$_POST['rfichas_id'];
$ruta_subirarchivo=RUTA_ARCHIVOSTRAMITES.$clstramiteusuario->getTu_codigo()."/";
$fichas=subir_archivo($fileTmpPath_fichas, $fileName_fichas, $ruta_subirarchivo);
if($fichas!==0){
    //REGISTRANDO REQUISITOS EN LA BASE DE DATOS
    $regreq = new clsturequisitos();
    $regreq->setTra_id($tramite);
    $regreq->setTur_rutaarchivo($ruta_subirarchivo.$fichas);
    $regreq->setTu_id($tu12_id);
    $regreq->setReq_id($id_rfichas);
    if($regreq->tur_insertar()==1){
        /*REGISTRAR LOS ANEXOS BASE-VACIOS*/
        $anexos=new clstramiteanexos();
        $anexos->setTra_id($tramite);
        $nanexos=$anexos->obtener_tramiteanexos();
        $anexoe=new clstuanexos();
        while($ranexo=mysqli_fetch_array($nanexos)){
            //echo $tu8_id."ID<br/>";
            $anexoe->setTu_id($tu12_id);
            $anexoe->setTra_id($tramite);
            $anexoe->setTua_codigoe("");
            $anexoe->setTua_rutaarchivo("");
            $anexoe->setAnx_id($ranexo["anx_id"]);
            $anexoe->tua_insertar();
        }
        $band=1;
    }else{
        //SI NO SE INSERTARON LOS ARCHIVOS PONER EL TRAMITE INACTIVO
        $band=0;
        $clstut->setTu_estado("INACTIVO");
        $clstut->tu_cambiar_estado();
    }
}else{
    //SI NO SE INSERTARON LOS ARCHIVOS PONER EL TRAMITE INACTIVO
    $band=0;
    $clstut->setTu_estado("INACTIVO");
    $clstut->tu_cambiar_estado();
}