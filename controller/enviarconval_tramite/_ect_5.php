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

if(isset($_FILES['rproyecto']['tmp_name'])){
    $fileTmpPath_rproyecto = $_FILES['rproyecto']['tmp_name'];
    $fileName_rproyecto = $_FILES['rproyecto']['name'];
    $id_rproyecto=$_POST['rproyecto_id']; //ID DEL REQUISITO 8 TUR_ID
    $rproyecto=subir_archivo($fileTmpPath_rproyecto, $fileName_rproyecto,$ruta_subirarchivo);
    $regreq = new clsturequisitos();
    $regreq->setTra_id($tra_id);
    $regreq->setTur_rutaarchivo($ruta_subirarchivo.$rproyecto);
    $regreq->setTur_id($id_rproyecto);
    $proceso=$regreq->tur_convalidar_requisito();
    $res=$res*$proceso;
}

if(isset($_FILES['rcarta']['tmp_name'])){
    $fileTmpPath_rcarta = $_FILES['rcarta']['tmp_name'];
    $fileName_rcarta = $_FILES['rcarta']['name'];
    $id_rcarta=$_POST['rcarta_id']; //ID DEL REQUISITO 8 TUR_ID
    $rcarta=subir_archivo($fileTmpPath_rcarta, $fileName_rcarta,$ruta_subirarchivo);
    $regreq = new clsturequisitos();
    $regreq->setTra_id($tra_id);
    $regreq->setTur_rutaarchivo($ruta_subirarchivo.$rcarta);
    $regreq->setTur_id($id_rcarta);
    $proceso=$regreq->tur_convalidar_requisito();
    $res=$res*$proceso;
}

