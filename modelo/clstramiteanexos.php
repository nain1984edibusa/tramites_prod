<?php

Class clstramiteanexos{	 
    //campos de la tabla 
    private $anx_id;
    private $anx_nombre;
    private $anx_felectronica;
    private $anx_QR;
    private $anx_requerido;  
    private $anx_rutaformato;
    private $anx_estado;
    private $tra_id;
	 
    //////////////////////////////   funciones get y set //////////////////////
    function getAnx_id() {
        return $this->anx_id;
    }

    function getAnx_nombre() {
        return $this->anx_nombre;
    }

    function getAnx_felectronica() {
        return $this->anx_felectronica;
    }

    function getAnx_QR() {
        return $this->anx_QR;
    }

    function getAnx_requerido() {
        return $this->anx_requerido;
    }

    function getAnx_rutaformato() {
        return $this->anx_rutaformato;
    }

    function getAnx_estado() {
        return $this->anx_estado;
    }

    function getTra_id() {
        return $this->tra_id;
    }

    function setAnx_id($anx_id) {
        $this->anx_id = $anx_id;
    }

    function setAnx_nombre($anx_nombre) {
        $this->anx_nombre = $anx_nombre;
    }

    function setAnx_felectronica($anx_felectronica) {
        $this->anx_felectronica = $anx_felectronica;
    }

    function setAnx_QR($anx_QR) {
        $this->anx_QR = $anx_QR;
    }

    function setAnx_requerido($anx_requerido) {
        $this->anx_requerido = $anx_requerido;
    }

    function setAnx_rutaformato($anx_rutaformato) {
        $this->anx_rutaformato = $anx_rutaformato;
    }

    function setAnx_estado($anx_estado) {
        $this->anx_estado = $anx_estado;
    }

    function setTra_id($tra_id) {
        $this->tra_id = $tra_id;
    }
    
    public function obtener_tramiteanexos(){
        $bd=Db::getInstance();
        $sql="SELECT * from ct_tramiteanexos WHERE tra_id='".$this->tra_id."'";
        //echo $sql;
        $ttdisp = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $ttdisp;      
    }
}  
?>