<?php

Class clsturequisitos{	 
    //campos de la tabla 
    private $tur_id;
    private $tur_rutaarchivo;
    private $tur_cumple;
    private $tur_observaciones;
    private $tu_id;  
    private $req_id; 
    private $tra_id;
    
    function getTur_id() {
        return $this->tur_id;
    }

    function getTur_rutaarchivo() {
        return $this->tur_rutaarchivo;
    }

    function getTur_cumple() {
        return $this->tur_cumple;
    }

    function getTur_observaciones() {
        return $this->tur_observaciones;
    }

    function getTu_id() {
        return $this->tu_id;
    }

    function getTra_id() {
        return $this->tra_id;
    }

    function setTur_id($tur_id) {
        $this->tur_id = $tur_id;
    }

    function setTur_rutaarchivo($tur_rutaarchivo) {
        $this->tur_rutaarchivo = $tur_rutaarchivo;
    }

    function setTur_cumple($tur_cumple) {
        $this->tur_cumple = $tur_cumple;
    }

    function setTur_observaciones($tur_observaciones) {
        $this->tur_observaciones = $tur_observaciones;
    }

    function setTu_id($tu_id) {
        $this->tu_id = $tu_id;
    }

    function setTra_id($tra_id) {
        $this->tra_id = $tra_id;
    }    
    
    function getReq_id() {
        return $this->req_id;
    }

    function setReq_id($req_id) {
        $this->req_id = $req_id;
    }

        
    //REGISTRAR REQUISITOS (URL) POR TRAMITE (TRA_ID Y TU_ID)
    
    ////// insertar requisito //////
    public function tur_insertar(){
        $bd=Db::getInstance();
        $bd->carga_valores("'".$this->tur_rutaarchivo."','".$this->tu_id."','".$this->req_id."','PENDIENTE'"); // valores a insertae
        $bd->carga_campos("tur_rutaarchivo,tu_id,req_id,tur_cumple"); // campos a ser insertados
        if($bd->insertar("_ct_tramite".$this->getTra_id()."_requisitos")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
    }
    public function tur_seleccionar_byte(){ //CAMBIAR --PENDIENTE
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select _ct_tramite".$this->tra_id."_requisitos.*, ct_tramiterequisitos.req_nombre, ct_tramiterequisitos.req_rutaformato, ct_tramiterequisitos.req_slug FROM _ct_tramite".$this->tra_id."_requisitos "
                ." inner join ct_tramiterequisitos ON _ct_tramite".$this->tra_id."_requisitos.req_id=ct_tramiterequisitos.req_id "
                . " WHERE _ct_tramite".$this->tra_id."_requisitos.tu_id='".$this->tu_id."'";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        return $res;
    }

    public function tur_validar_requisito(){ //varios estados
        $bd=Db::getInstance();
        $parametros ="tur_cumple = '".$this->getTur_cumple()."', tur_observaciones = '".$this->getTur_observaciones()."'";
        $bd->carga_valores("tur_id = ".$this->getTur_id());
        $bd->carga_campos($parametros);
        if($bd->actualizar("_ct_tramite".$this->getTra_id()."_requisitos")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    
    public function tur_convalidar_requisito(){ //varios estados
        $bd=Db::getInstance();
        $parametros ="tur_rutaarchivo = '".$this->getTur_rutaarchivo()."', tur_cumple = 'PENDIENTE'";
        $bd->carga_valores("tur_id = ".$this->getTur_id());
        $bd->carga_campos($parametros);
        if($bd->actualizar("_ct_tramite".$this->getTra_id()."_requisitos")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    
    public function tur_contar_validacionrequisitos($estado){
        $bd=Db::getInstance();
        $sql="SELECT count(*) as total from _ct_tramite".$this->getTra_id()."_requisitos WHERE tur_cumple='".$estado."' and tu_id='".$this->tu_id."'";
        //echo $sql;
        $ttdisp = $bd->ejecutar($sql);
        $res= mysqli_fetch_array($ttdisp);
        //$bd->cerrar();
        return $res["total"];      
    }
}
?>
