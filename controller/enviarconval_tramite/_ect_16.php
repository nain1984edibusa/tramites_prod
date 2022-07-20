<?php
//CAMBIOS DE CONVALIDACIÓN ESPECÍFICOS DEL TRÁMITE 16
$res=1;
if($tespecifico["te_cumple"]=="INCORRECTO"):  //ACTUALIZAR FORMULARIO
    $te_area=$_POST["area"];
    $te_tema=$_POST["tema"];
   
    $tramitee->setTe_area($te_area);
    $tramitee->setTe_tema($te_tema);
    
    $form=$tramitee->tra_enviarconval();
    $res=$res*$form;
endif;
$ruta_subirarchivo=RUTA_ARCHIVOSTRAMITES.$tra_codigo."/";

if(isset($_FILES['rfichas']['tmp_name'])){
    $fileTmpPath_fichas = $_FILES['rfichas']['tmp_name'];
    $fileName_fichas = $_FILES['rfichas']['name'];
    $id_rfichas=$_POST['rfichas_id']; //ID DEL REQUISITO 16 TUR_ID
    $croquis=subir_archivo($fileTmpPath_fichas, $fileName_fichas,$ruta_subirarchivo);
    $regreq = new clsturequisitos();
    $regreq->setTra_id($tra_id);
    $regreq->setTur_rutaarchivo($ruta_subirarchivo.$croquis);
    $regreq->setTur_id($id_rfichas);
    $proceso=$regreq->tur_convalidar_requisito();
    $res=$res*$proceso;
}