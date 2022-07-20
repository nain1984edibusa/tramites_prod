<?php
Class clsferiadosanio{	 
     //defino los campos de la tabla 
    private $fa_fechainicio;
    private $fa_fechafin;
    private $fa_regional;
    
    function getFa_fechainicio() {
        return $this->fa_fechainicio;
    }

    function getFa_fechafin() {
        return $this->fa_fechafin;
    }

    function setFa_fechainicio($fa_fechainicio) {
        $this->fa_fechainicio = $fa_fechainicio;
    }

    function setFa_fechafin($fa_fechafin) {
        $this->fa_fechafin = $fa_fechafin;
    }
    
    function getFa_regional() {
        return $this->fa_regional;
    }

    function setFa_regional($regional) {
        $this->fa_regional = $regional;
    }

    public function get_count_diasferiado(){
        $bd=Db::getInstance();
        $sql = "SELECT count(*) as total FROM ct_feriados_anio JOIN ct_feriados ON (ct_feriados.fer_id=ct_feriados_anio.fer_id) WHERE ('".$this->fa_fechafin."'>=fea_fecha and '".$this->fa_fechainicio."'<=fea_fecha) and (ct_feriados.fer_tipo='Global' or (ct_feriados.fer_tipo='Local' AND ct_feriados.reg_id='".$this->fa_regional."'))";     
        //echo $sql;
        $rsprv = $bd->ejecutar($sql);
        return $rsprv;
    }
}