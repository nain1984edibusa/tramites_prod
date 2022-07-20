<?php
//CAMBIOS DE CONVALIDACIÓN ESPECÍFICOS DEL TRÁMITE 18
$res=1;
if($tespecifico["te_cumple"]=="INCORRECTO"):  //ACTUALIZAR FORMULARIO
    $te_evento=$_POST["eventos"];
    $te_institucion=$_POST["institucion"];
    $te_tema=$_POST["tema"];
    $te_aforo=$_POST["aforo"];
    $te_persona_acargo=$_POST["persona_acargo"];
    $te_duracion=$_POST["duracion"];
	$te_fecha1=$_POST["fecha1"];
	$te_hora=$_POST["hora"];
    $tramitee->setTe_evento($te_evento);
    $tramitee->setTe_institucion($te_institucion);
    $tramitee->setTe_tema($te_tema);
    $tramitee->setTe_aforo($te_aforo);
    $tramitee->setTe_persona_acargo($te_persona_acargo);
    $tramitee->setTe_duracion($te_duracion);
	$tramitee->setTe_fecha1($te_fecha1);
	$tramitee->setTe_hora($te_hora);
	
    $form=$tramitee->tra_enviarconval();
    $res=$res*$form;
endif;
$ruta_subirarchivo=RUTA_ARCHIVOSTRAMITES.$tra_codigo."/";

if(isset($_FILES['rfichas']['tmp_name'])){
    $fileTmpPath_fichas = $_FILES['rfichas']['tmp_name'];
    $fileName_fichas = $_FILES['rfichas']['name'];
    $id_rfichas=$_POST['rfichas_id']; //ID DEL REQUISITO 18 TUR_ID
    $croquis=subir_archivo($fileTmpPath_fichas, $fileName_fichas,$ruta_subirarchivo);
    $regreq = new clsturequisitos();
    $regreq->setTra_id($tra_id);
    $regreq->setTur_rutaarchivo($ruta_subirarchivo.$croquis);
    $regreq->setTur_id($id_rfichas);
    $proceso=$regreq->tur_convalidar_requisito();
    $res=$res*$proceso;
}