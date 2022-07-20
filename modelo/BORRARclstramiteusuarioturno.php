<?php
Class cl_tramites{	 
    private $tut_id;
    private $tra_id;
    private $tut_dia;
    private $tut_hora;  
    /*GETS Y SETS*/
    function getTut_id() {
        return $this->tut_id;
    }

    function getTra_id() {
        return $this->tra_id;
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

    function setTut_dia($tut_dia) {
        $this->tut_dia = $tut_dia;
    }

    function setTut_hora($tut_hora) {
        $this->tut_hora = $tut_hora;
    }

    
}
?>
