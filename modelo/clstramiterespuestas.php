<?php

Class clstramiterespuestas{	 
    //campos de la tabla 
    private $tuc_id;
    private $tuc_rutaarchivo;
    private $tuc_cumple;
    private $tuc_observaciones;
    private $tuc_tipo_contestacion;
    private $usu_aprobador;
    private $usu_ejecutor;
    private $tra_id;
    private $tu_id;
	 
    //////////////////////////////   funciones get y set //////////////////////
    function getTuc_id() {
        return $this->tuc_id;
    }

    function getTuc_rutaarchivo() {
        return $this->tuc_rutaarchivo;
    }

    function getTuc_cumple() {
        return $this->tuc_cumple;
    }

    function getTuc_observaciones() {
        return $this->tuc_observaciones;
    }

    function getTra_id() {
        return $this->tra_id;
    }

    function getTu_id() {
        return $this->tu_id;
    }

    function setTuc_id($tur_id) {
        $this->tuc_id = $tur_id;
    }

    function setTuc_rutaarchivo($tur_rutaarchivo) {
        $this->tuc_rutaarchivo = $tur_rutaarchivo;
    }

    function setTuc_cumple($tur_cumple) {
        $this->tuc_cumple = $tur_cumple;
    }

    function setTuc_observaciones($tur_observaciones) {
        $this->tuc_observaciones = $tur_observaciones;
    }

    function setTra_id($tra_id) {
        $this->tra_id = $tra_id;
    }

    function setTu_id($tu_id) {
        $this->tu_id = $tu_id;
    }

    function getTuc_tipo_contestacion() {
        return $this->tuc_tipo_contestacion;
    }

    function setTuc_tipo_contestacion($tuc_tipo_contestacion) {
        $this->tuc_tipo_contestacion = $tuc_tipo_contestacion;
    }
    
    function getUsu_aprobador() {
        return $this->usu_aprobador;
    }

    function getUsu_ejecutor() {
        return $this->usu_ejecutor;
    }

    function setUsu_aprobador($usu_aprobador) {
        $this->usu_aprobador = $usu_aprobador;
    }

    function setUsu_ejecutor($usu_ejecutor) {
        $this->usu_ejecutor = $usu_ejecutor;
    }

    
    public function obtener_tramiterespuestas(){
        $bd=Db::getInstance();
        $sql="SELECT * from _ct_tramite".$this->getTra_id()."_respuestas WHERE tu_id='".$this->tu_id."' LIMIT 0,1";
        //echo $sql;
        $ttdisp = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $ttdisp;      
    }
    public function tuc_validar_requisito(){ //varios estados
        $bd=Db::getInstance();
        $parametros ="tuc_cumple = '".$this->getTuc_cumple()."', tuc_observaciones = '".$this->getTuc_observaciones()."'";
        $bd->carga_valores("tuc_id = ".$this->getTuc_id());
        $bd->carga_campos($parametros);
        if($bd->actualizar("_ct_tramite".$this->getTra_id()."_respuestas")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
}  
?>