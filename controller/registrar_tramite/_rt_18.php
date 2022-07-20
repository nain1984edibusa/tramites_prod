<?php
//CAMPOS ESPECÍFICOS DEL TRÁMITE 18
require_once '../modelo/clstramite18.php';
//require_once '../modelo/clstramiterequisitos.php';
//require_once '../modelo/clsturequisitos.php';
require_once '../modelo/clstramiteanexos.php';
require_once '../modelo/clstuanexos.php';
$te_evento=$_POST["selevento"];
$te_institucion=$_POST["txtnomins"];
$te_tema=$_POST["txttemeve"];
$te_aforo=$_POST["txtaforo"];
$te_persona_acargo=$_POST["txtnoma"];
$te_duracion=$_POST["txtdura"];
$te_fecha1=$_POST["txtfec"];
$te_hora=$_POST["txthor"];

//CREANDO EL TRÁMITE
$clstut = new clstramite18();
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
$clstut->setTe_evento($te_evento);
$clstut->setTe_institucion($te_institucion);
$clstut->setTe_tema($te_tema);
$clstut->setTe_aforo($te_aforo);
$clstut->setTe_persona_acargo($te_persona_acargo);
$clstut->setTe_duracion($te_duracion);
$clstut->setTe_fecha1($te_fecha1);
$clstut->setTe_hora($te_hora);

$tu18_id=$clstut->tu_insertar();
if($tu18_id!=0){
    /*REGISTRAR LOS ANEXOS BASE-VACIOS*/
    $anexos=new clstramiteanexos();
    $anexos->setTra_id($tramite);
    $nanexos=$anexos->obtener_tramiteanexos();
    $anexoe=new clstuanexos();
    while($ranexo=mysqli_fetch_array($nanexos)){
        //echo $tu8_id."ID<br/>";
        $anexoe->setTu_id($tu18_id);
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