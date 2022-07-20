<?php

Class clstramiteturno{	 
    //campos de la tabla 
    private $tt_id;
    private $tt_hora_inicio;
    private $tt_hora_fin;
    private $tt_tra_id;
    private $tt_orden;   
	 
    //////////////////////////////   funciones get y set //////////////////////
    function getTt_id() {
        return $this->tt_id;
    }

    function getTt_hora_inicio() {
        return $this->tt_hora_inicio;
    }

    function getTt_hora_fin() {
        return $this->tt_hora_fin;
    }

    function getTt_tra_id() {
        return $this->tt_tra_id;
    }

    function getTt_orden() {
        return $this->tt_orden;
    }

    function setTt_id($tt_id) {
        $this->tt_id = $tt_id;
    }

    function setTt_hora_inicio($tt_hora_inicio) {
        $this->tt_hora_inicio = $tt_hora_inicio;
    }

    function setTt_hora_fin($tt_hora_fin) {
        $this->tt_hora_fin = $tt_hora_fin;
    }

    function setTt_tra_id($tt_tra_id) {
        $this->tt_tra_id = $tt_tra_id;
    }

    function setTt_orden($tt_orden) {
        $this->tt_orden = $tt_orden;
    }

    public function obtener_tramite_turnosdisp($fecha,$tramite){
        $bd=Db::getInstance();
        $sql="SELECT * from ct_tramite_turno WHERE ct_tramite_turno.tra_id='".$tramite."' and ct_tramite_turno.tt_hora_inicio NOT IN (SELECT ct_tramite_usuario_turno.tut_hora from ct_tramite_usuario_turno WHERE ct_tramite_usuario_turno.tut_dia='".$fecha."' and ct_tramite_usuario_turno.tra_id='".$tramite."') ORDER BY ct_tramite_turno.tt_orden ASC";
        //echo $sql;
        $ttdisp = $bd->ejecutar($sql);
        $bd->cerrar();
        return $ttdisp;
        
    }
}  
?>