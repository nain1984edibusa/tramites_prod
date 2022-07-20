<?php
include_once("../config/variables.php");
include_once("../includes/functions.php");
/*incluir modelo(s)*/
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once("../modelo/clstramiteusuario.php");
include_once("../modelo/clstuanexos.php");
include_once("../modelo/clsusuarios.php");
/*generar instancias*/
if((isset($_REQUEST["idtu"])&&(!empty($_REQUEST["idtu"])))||(isset($tramite))){ //SI SE RECIBE EL ID DEL TRÁMITE, PROCEDE
    if(isset($_REQUEST["idtu"])){
        $idtu=$_REQUEST["idtu"];
    }else{
        $idtu=$tramite;
    }
    $tramiteusuario = new clstramiteusuario();
    $tramiteusuario->setTu_id($idtu);
    $ttramite = $tramiteusuario->tra_seleccionar_byid();
    $ttramite = mysqli_fetch_array($ttramite);
    $tra_id=$ttramite["tra_id"];
    $tra_codigo=$ttramite["tu_codigo"];
    include_once("../modelo/clstramite".$tra_id.".php");
    include_once("../modelo/clstramiterespuestas.php");
    switch ($tra_id){
        case "5": 
            $tramitee = new clstramite5();
            break;
        case "8": 
            $tramitee = new clstramite8();
            break;
        case "12": 
            $tramitee = new clstramite12();
            break;
        case "13": 
            $tramitee = new clstramite13();
            break;
		case "16": 
            $tramitee = new clstramite16();
            break;
		case "18": 
            $tramitee = new clstramite18();
            break;
    }
    $tramitee->setTu_codigo($tra_codigo);
    $tespecifico=$tramitee->tra_seleccionar_bycodigo();
    $tespecifico= mysqli_fetch_array($tespecifico);
    //$tra_id=$_GET["idt"];
    $tu_id=$tespecifico["tu_id"];
    $respuestas= new clstramiterespuestas();
    $respuestas->setTra_id($tra_id);
    $respuestas->setTu_id($tu_id);
    $trespuestas=$respuestas->obtener_tramiterespuestas();
    $respuesta=mysqli_fetch_array($trespuestas);
    $res_fecha=date("Y-m-d H:i:s");
    //OBTENER ANEXOS
    $anexose=new clstuanexos();
    $anexose->setTu_id($tespecifico["tu_id"]);
    $anexose->setTra_id($tra_id);
    $anexos=$anexose->tua_seleccionar_byte();
    //OBTENER DATOS USUARIOS
    $usuario=new clsusuarios();
    if($respuesta["usu_aprobador"]!=0){
        $usuario->setUsu_id($respuesta["usu_aprobador"]);
        $usuario_aprobador=mysqli_fetch_array($usuario->usu_seleccionar_byid());
    }else{
        $usuario_aprobador["usu_nombre"]=$usuario_aprobador["usu_apellido"]=$usuario_aprobador["usu_direccion"]="NO DEFINIDO";
    }
    if($respuesta["usu_ejecutor"]!=0){
        $usuario->setUsu_id($respuesta["usu_ejecutor"]);
        $usuario_ejecutor=mysqli_fetch_array($usuario->usu_seleccionar_byid());
    }else{
        $usuario_ejecutor["usu_nombre"]=$usuario_ejecutor["usu_apellido"]=$usuario_ejecutor["usu_direccion"]="NO DEFINIDO";
    }
    include('prev_respuesta_pdf/_pr_'.$tra_id.'.php');
    $contenido_respuesta.="<br/><p><small><b>Anexos:</b><br/>";
    while($anexo=mysqli_fetch_array($anexos)){
        $contenido_respuesta.="<i>".$anexo["anx_nombre"]."</i> ".$anexo["tua_codigoe"]." (Nombre del archivo: ".str_replace(RUTA_ARCHIVOSTRAMITES.$tra_codigo."/","",$anexo["tua_rutaarchivo"]).")<br/>";
    }
    $contenido_respuesta.="</small></p></div><br/><br/>";
    $contenido_respuesta.="<p>El solicitante podrá hacer uso del presente documento, como convenga a sus intereses.</p><br/><br/>";
    $contenido_respuesta.="<br/><small>".$usuario_aprobador["usu_nombre"]." ".$usuario_aprobador["usu_apellido"]."<br/><b>".$usuario_aprobador["usu_direccion"]."</b> (Aprobación)</small>";
    $contenido_respuesta.="<br/><br/><small>".$usuario_ejecutor["usu_nombre"]." ".$usuario_ejecutor["usu_apellido"]."<br/><b>".$usuario_ejecutor["usu_direccion"]."</b> (Análisis Técnico)</small>";
    $contenido_respuesta.="<br/><br/><i class='firma_ec'>Documento firmado electrónicamente</i>";
    if(!((isset($firma))&&($firma==1))){
    echo urlencode($contenido_respuesta);
    }
}