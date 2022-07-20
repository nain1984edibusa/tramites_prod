<?php
//CAMBIOS DE CONVALIDACIÓN ESPECÍFICOS DEL TRÁMITE 8
$res=1;
if($tespecifico["te_cumple"]=="INCORRECTO"):  //ACTUALIZAR FORMULARIO
    $te_ambito=$_POST["ambitos"];
    $te_cantidad_fichas=$_POST["cantidad_fichas"];
    $te_persona_responsable=$_POST["persona_responsable"];
    $te_fecha_ingreso=$_POST["fecha_ingreso"];
    $te_tecnico_responsable=$_POST["tecnico_responsable"];
    $te_fecha_revision=$_POST["fecha_revision"];
    $tramitee->setTe_ambito($te_ambito);
    $tramitee->setTe_cantidad_fichas($te_cantidad_fichas);
    $tramitee->setTe_persona_responsable($te_persona_responsable);
    $tramitee->setTe_fecha_ingreso($te_fecha_ingreso);
    $tramitee->setTe_tecnico_responsable($te_tecnico_responsable);
    $tramitee->setTe_fecha_revision($te_fecha_revision);
    $form=$tramitee->tra_enviarconval();
    $res=$res*$form;
endif;
$ruta_subirarchivo=RUTA_ARCHIVOSTRAMITES.$tra_codigo."/";

if(isset($_FILES['rfichas']['tmp_name'])){
    $fileTmpPath_fichas = $_FILES['rfichas']['tmp_name'];
    $fileName_fichas = $_FILES['rfichas']['name'];
    $id_rfichas=$_POST['rfichas_id']; //ID DEL REQUISITO 12 TUR_ID
    $croquis=subir_archivo($fileTmpPath_fichas, $fileName_fichas,$ruta_subirarchivo);
    $regreq = new clsturequisitos();
    $regreq->setTra_id($tra_id);
    $regreq->setTur_rutaarchivo($ruta_subirarchivo.$croquis);
    $regreq->setTur_id($id_rfichas);
    $proceso=$regreq->tur_convalidar_requisito();
    $res=$res*$proceso;
}