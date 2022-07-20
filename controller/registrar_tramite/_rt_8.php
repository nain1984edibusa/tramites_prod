<?php
//CAMPOS ESPECÍFICOS DEL TRÁMITE 8
require_once '../modelo/clstramite8.php';
require_once '../modelo/clstramiterequisitos.php';
require_once '../modelo/clsturequisitos.php';
require_once '../modelo/clstramiteanexos.php';
require_once '../modelo/clstuanexos.php';
$te_provincia=$_POST["id_provincia"];
$te_canton=$_POST["id_canton"];
$te_parroquia=$_POST["id_parroquia"];
$te_regional=$_POST["id_regional"];
$te_direccion=$_POST["direccion"];
$te_codigo_inventario=$_POST["codigo_inventario"];
//CREANDO EL TRÁMITE
$clstut = new clstramite8();
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
$clstut->setTe_provincia($te_provincia);
$clstut->setTe_canton($te_canton);
$clstut->setTe_parroquia($te_parroquia);
$clstut->setTe_regional($te_regional);
$clstut->setTe_direccion($te_direccion);
$clstut->setTe_codigo_inventario($te_codigo_inventario);
$tu8_id=$clstut->tu_insertar();
//OBTENIENDO REQUISITOS
$fileTmpPath_fotos = $_FILES['rfotos']['tmp_name'];
$fileName_fotos = $_FILES['rfotos']['name'];
$id_rfotos=$_POST['rfotos_id'];
$fileTmpPath_croquis = $_FILES['rcroquis']['tmp_name'];
$fileName_croquis = $_FILES['rcroquis']['name'];
$id_rcroquis=$_POST['rcroquis_id'];
$ruta_subirarchivo=RUTA_ARCHIVOSTRAMITES.$clstramiteusuario->getTu_codigo()."/";
$fotos=subir_archivo($fileTmpPath_fotos, $fileName_fotos, $ruta_subirarchivo);
$croquis=subir_archivo($fileTmpPath_croquis, $fileName_croquis, $ruta_subirarchivo);
if(($fotos!==0)&&($croquis!==0)){
    //REGISTRANDO REQUISITOS EN LA BASE DE DATOS
    $regreq = new clsturequisitos();
    $regreq->setTra_id($tramite);
    $regreq->setTur_rutaarchivo($ruta_subirarchivo.$fotos);
    $regreq->setTu_id($tu8_id);
    $regreq->setReq_id($id_rfotos);
    if($regreq->tur_insertar()==1){
        $regreq->setTur_rutaarchivo($ruta_subirarchivo.$croquis);
        $regreq->setReq_id($id_rcroquis);
        if($regreq->tur_insertar()==1){
            /*REGISTRAR LOS ANEXOS BASE-VACIOS*/
            $anexos=new clstramiteanexos();
            $anexos->setTra_id($tramite);
            $nanexos=$anexos->obtener_tramiteanexos();
            $anexoe=new clstuanexos();
            while($ranexo=mysqli_fetch_array($nanexos)){
                //echo $tu8_id."ID<br/>";
                $anexoe->setTu_id($tu8_id);
                $anexoe->setTra_id($tramite);
                $anexoe->setTua_codigoe("");
                $anexoe->setTua_rutaarchivo("");
                $anexoe->setAnx_id($ranexo["anx_id"]);
                $anexoe->tua_insertar();
            }
            $band=1;
        }
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