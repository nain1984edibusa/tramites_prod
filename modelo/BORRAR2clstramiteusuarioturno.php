<?php
Class clstramiteusuarioturno{
    //campos de la tabla 
    private $tut_id;
    private $tra_id;
    private $tu_id;
    private $tut_dia;
    private $tut_hora;
    
    //////////////////////////////   funciones get y set //////////////////////
    
    function getTut_id() {
        return $this->tut_id;
    }

    function getTra_id() {
        return $this->tra_id;
    }

    function getTu_id() {
        return $this->tu_id;
    }

    function getTut_dia() {
        return $this->tut_dia;
    }

    function getTut_hora() {
        return $this->tut_hora;
    }

    function setTut_id($tut_id) {
        $this->tut_id = $tut_id;
    }

    function setTra_id($tra_id) {
        $this->tra_id = $tra_id;
    }

    function setTu_id($tu_id) {
        $this->tu_id = $tu_id;
    }

    function setTut_dia($tut_dia) {
        $this->tut_dia = $tut_dia;
    }

    function setTut_hora($tut_hora) {
        $this->tut_hora = $tut_hora;
    }

    ////// insertar trámite usuario turno //////
    public function tut_insertar(){
        $bd=Db::getInstance();
        //$this->carga_rol_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        $bd->carga_valores("'".$this->tra_id."','".$this->tu_id."','".$this->tut_dia."','".$this->tut_hora."'"); // valores a insertar
        $bd->carga_campos("tra_id,tu_id,tut_dia,tut_hora"); // campos a ser insertados
        if($bd->insertar("ct_tramite_usuario_turno")) // insertar
          return $bd->lastID();  // exito
        else 
          return 0;  // error
        $bd->cerrar();  // cerrar coneccion

    }
}
