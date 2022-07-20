<?php

Class clstramiterequisitos{	 
    //campos de la tabla 
    private $req_id;
    private $req_nombre;
    private $req_rutaformato;
    private $req_estado;
    private $tra_id;
	 
    //////////////////////////////   funciones get y set //////////////////////
    function getReq_id() {
        return $this->req_id;
    }

    function getReq_nombre() {
        return $this->req_nombre;
    }

    function getReq_rutaformato() {
        return $this->req_rutaformato;
    }

    function getReq_estado() {
        return $this->req_estado;
    }

    function getTra_id() {
        return $this->tra_id;
    }

    function setReq_id($req_id) {
        $this->req_id = $req_id;
    }

    function setReq_nombre($req_nombre) {
        $this->req_nombre = $req_nombre;
    }

    function setReq_rutaformato($req_rutaformato) {
        $this->req_rutaformato = $req_rutaformato;
    }

    function setReq_estado($req_estado) {
        $this->req_estado = $req_estado;
    }

    function setTra_id($tra_id) {
        $this->tra_id = $tra_id;
    }
    
    public function obtener_tramiterequisitos(){
        $bd=Db::getInstance();
        $sql="SELECT * from ct_tramiterequisitos WHERE tra_id='".$this->tra_id."'";
        //echo $sql;
        $ttdisp = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $ttdisp;      
    }
    public function obtener_tramiterequisitos_byestado(){
        $bd=Db::getInstance();
        $sql="SELECT * from ct_tramiterequisitos WHERE tra_id='".$this->tra_id."'";
        //echo $sql;
        $ttdisp = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $ttdisp;      
    }
}  
?>