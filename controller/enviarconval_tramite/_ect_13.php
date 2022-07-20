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
    
    $tramitee->setTe_dueno_cedula($_POST["cedula_propietario"]);
    $tramitee->setTe_dueno_nom($_POST["nombres_propietario"]);
    $tramitee->setTe_dueno_email($_POST["email_propietario"]);
    $tramitee->setTe_dueno_telf($_POST["telefono_propietario"]);
    
    $tramitee->setTe_benef_cedula($_POST["cedula_beneficiario"]);
    $tramitee->setTe_benef_nom($_POST["nombres_beneficiario"]);
    $tramitee->setTe_benef_email($_POST["email_beneficiario"]);
    $tramitee->setTe_benef_telf($_POST["telefono_beneficiario"]);
    
    $form=$tramitee->tra_enviarconval();
    $res=$res*$form;
endif;

$ruta_subirarchivo=RUTA_ARCHIVOSTRAMITES.$tra_codigo."/";

if(isset($_FILES['rminuta']['tmp_name'])){
    $fileTmpPath_rminuta = $_FILES['rminuta']['tmp_name'];
    $fileName_rminuta = $_FILES['rminuta']['name'];
    $id_rminuta=$_POST['rminuta_id']; //ID DEL REQUISITO 8 TUR_ID
    $rminuta=subir_archivo($fileTmpPath_croquis, $fileName_rminuta,$ruta_subirarchivo);
    $regreq = new clsturequisitos();
    $regreq->setTra_id($tra_id);
    $regreq->setTur_rutaarchivo($ruta_subirarchivo.$rminuta);
    $regreq->setTur_id($id_rminuta);
    $proceso=$regreq->tur_convalidar_requisito();
    $res=$res*$proceso;
}

