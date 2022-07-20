<?php
//CAMPOS ESPECÍFICOS DEL TRÁMITE 16
require_once '../modelo/clstramite16.php';
//require_once '../modelo/clstramiterequisitos.php';
//require_once '../modelo/clsturequisitos.php';
require_once '../modelo/clstramiteanexos.php';
require_once '../modelo/clstuanexos.php';
$te_area=$_POST["area"];
$te_tema=$_POST["tema"];

//CREANDO EL TRÁMITE
$clstut = new clstramite16();
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
$clstut->setTe_area($te_area);
$clstut->setTe_tema($te_tema);

$tu16_id=$clstut->tu_insertar();
if($tu16_id!=0){
    /*REGISTRAR LOS ANEXOS BASE-VACIOS*/
    $anexos=new clstramiteanexos();
    $anexos->setTra_id($tramite);
    $nanexos=$anexos->obtener_tramiteanexos();
    $anexoe=new clstuanexos();
    while($ranexo=mysqli_fetch_array($nanexos)){
        //echo $tu8_id."ID<br/>";
        $anexoe->setTu_id($tu16_id);
        $anexoe->setTra_id($tramite);
        $anexoe->setTua_codigoe("");
        $anexoe->setTua_rutaarchivo("");
        $anexoe->setAnx_id($ranexo["anx_id"]);
        $anexoe->tua_insertar();
    }
    $band=1;
}else{
    $band=0;
}