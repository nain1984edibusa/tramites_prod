<?php
//CAMBIOS DE CONVALIDACIÓN ESPECÍFICOS DEL TRÁMITE 8
$res=1;
if($tespecifico["te_cumple"]=="INCORRECTO"):  //ACTUALIZAR FORMULARIO
    $te_provincia=$_POST["id_provincia"];
    $te_canton=$_POST["id_canton"];
    $te_parroquia=$_POST["id_parroquia"];
    $te_regional=$_POST["id_regional"];
    $te_direccion=$_POST["direccion"];
    $te_codigo_inventario=$_POST["codigo_inventario"];
    $tramitee->setTe_provincia($te_provincia);
    $tramitee->setTe_canton($te_canton);
    $tramitee->setTe_parroquia($te_parroquia);
    $tramitee->setTe_codigo_inventario($te_codigo_inventario);
    $tramitee->setTe_direccion($te_direccion);
    $tramitee->setTe_regional($te_regional);
    $form=$tramitee->tra_enviarconval();
    $res=$res*$form;
endif;

$ruta_subirarchivo=RUTA_ARCHIVOSTRAMITES.$tra_codigo."/";

if(isset($_FILES['rcroquis']['tmp_name'])){
    $fileTmpPath_croquis = $_FILES['rcroquis']['tmp_name'];
    $fileName_croquis = $_FILES['rcroquis']['name'];
    $id_rcroquis=$_POST['rcroquis_id']; //ID DEL REQUISITO 8 TUR_ID
    $croquis=subir_archivo($fileTmpPath_croquis, $fileName_croquis,$ruta_subirarchivo);
    $regreq = new clsturequisitos();
    $regreq->setTra_id($tra_id);
    $regreq->setTur_rutaarchivo($ruta_subirarchivo.$croquis);
    $regreq->setTur_id($id_rcroquis);
    $proceso=$regreq->tur_convalidar_requisito();
    $res=$res*$proceso;
}

if(isset($_FILES['rfotos']['tmp_name'])){
    $fileTmpPath_fotos = $_FILES['rfotos']['tmp_name'];
    $fileName_fotos = $_FILES['rfotos']['name'];
    $id_rfotos=$_POST['rfotos_id']; //ID DEL REQUISITO 8 TUR_ID
    $fotos=subir_archivo($fileTmpPath_fotos, $fileName_fotos, $ruta_subirarchivo);
    $regreq = new clsturequisitos();
    $regreq->setTra_id($tra_id);
    $regreq->setTur_rutaarchivo($ruta_subirarchivo.$fotos);
    $regreq->setTur_id($id_rfotos);
    $proceso=$regreq->tur_convalidar_requisito();
    $res=$res*$proceso;
}

