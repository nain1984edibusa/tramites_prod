<?php

Class clstuanexos{	 
    //campos de la tabla 
    private $tua_id;
    private $tua_codigoe;
    private $tua_rutaarchivo;
    private $tua_cumple;
    private $tua_observaciones;
    private $tu_id;  
    private $anx_id; 
    private $tra_id;
    //private $anx_codigo;
    
    function getTua_id() {
        return $this->tua_id;
    }

    function getTua_rutaarchivo() {
        return $this->tua_rutaarchivo;
    }

    function getTua_cumple() {
        return $this->tua_cumple;
    }

    function getTua_observaciones() {
        return $this->tua_observaciones;
    }

    function getTu_id() {
        return $this->tu_id;
    }

    function getAnx_id() {
        return $this->anx_id;
    }

    function getTra_id() {
        return $this->tra_id;
    }

    function setTua_id($tua_id) {
        $this->tua_id = $tua_id;
    }

    function setTua_rutaarchivo($tua_rutaarchivo) {
        $this->tua_rutaarchivo = $tua_rutaarchivo;
    }

    function setTua_cumple($tua_cumple) {
        $this->tua_cumple = $tua_cumple;
    }

    function setTua_observaciones($tua_observaciones) {
        $this->tua_observaciones = $tua_observaciones;
    }

    function setTu_id($tu_id) {
        $this->tu_id = $tu_id;
    }

    function setAnx_id($anx_id) {
        $this->anx_id = $anx_id;
    }

    function setTra_id($tra_id) {
        $this->tra_id = $tra_id;
    }

    function getTua_codigoe() {
        return $this->tua_codigoe;
    }

    function setTua_codigoe($tua_codigoe) {
        $this->tua_codigoe = $tua_codigoe;
    }

    /*function getAnx_codigo() {
        return $this->anx_codigo;
    }

    function setAnx_codigo($anx_codigo) {
        $this->anx_codigo = $anx_codigo;
    }*/

                
    //REGISTRAR REQUISITOS (URL) POR TRAMITE (TRA_ID Y TU_ID)
    
    ////// insertar requisito //////
    public function tua_insertar(){
        $bd=Db::getInstance();
        $bd->carga_valores("'".$this->tua_codigoe."','".$this->tua_rutaarchivo."','".$this->tu_id."','".$this->anx_id."','NO INGRESADO'"); // valores a insertae
        $bd->carga_campos("tua_codigoe,tua_rutaarchivo,tu_id,anx_id,tua_cumple"); // campos a ser insertados
        if($bd->insertar("_ct_tramite".$this->getTra_id()."_anexos")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
    }
    public function tua_actualizar(){ //varios estados
        $bd=Db::getInstance();
        $parametros ="tua_codigoe = '".$this->getTua_codigoe()."', tua_rutaarchivo = '".$this->getTua_rutaarchivo()."',tua_cumple='PENDIENTE'";
        $bd->carga_valores("tua_id = ".$this->getTua_id());
        $bd->carga_campos($parametros);
        if($bd->actualizar("_ct_tramite".$this->getTra_id()."_anexos")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    public function tua_seleccionar_byte(){ //CAMBIAR --PENDIENTE
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        /*$sql = "select _ct_tramite".$this->tra_id."_anexos.*, ct_tramiteanexos.anx_id ,ct_tramiteanexos.anx_nombre,ct_tramiteanexos.anx_requerido, ct_tramiteanexos.anx_rutaformato FROM _ct_tramite".$this->tra_id."_anexos "
                ." inner join ct_tramiteanexos ON _ct_tramite".$this->tra_id."_anexos.anx_id=ct_tramiteanexos.anx_id "
                . " WHERE _ct_tramite".$this->tra_id."_anexos.tu_id='".$this->tu_id."' and ct_tramiteanexos.tra_id='".$this->tra_id."'";*/
        $sql = "select _ct_tramite".$this->tra_id."_anexos.*, ct_tramiteanexos.anx_id ,ct_tramiteanexos.anx_nombre,ct_tramiteanexos.anx_requerido, ct_tramiteanexos.anx_rutaformato FROM _ct_tramite".$this->tra_id."_anexos "
                ." inner join ct_tramiteanexos ON _ct_tramite".$this->tra_id."_anexos.anx_id=ct_tramiteanexos.anx_id "
                . " WHERE _ct_tramite".$this->tra_id."_anexos.tu_id='".$this->tu_id."' and ct_tramiteanexos.tra_id='".$this->tra_id."'";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        return $res;
    }
    
    public function tua_eliminar_anexotipo(){
        $bd=Db::getInstance();
        $sql = "delete from _ct_tramite".$this->tra_id."_anexos WHERE _ct_tramite".$this->tra_id."_anexos.tu_id='".$this->tu_id."'";
        $res = $bd->ejecutar($sql);
        return $res;
    }

    public function tua_validar_anexo(){ //varios estados
        $bd=Db::getInstance();
        $parametros ="tua_cumple = '".$this->getTua_cumple()."', tua_observaciones = '".$this->getTua_observaciones()."'";
        $bd->carga_valores("tua_id = ".$this->getTua_id());
        $bd->carga_campos($parametros);
        if($bd->actualizar("_ct_tramite".$this->getTra_id()."_anexos")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    public function tua_contar_validacionanexos($estado){
        $bd=Db::getInstance();
        $sql="SELECT count(*) as total from _ct_tramite".$this->getTra_id()."_anexos WHERE tua_cumple='".$estado."' and tu_id='".$this->tu_id."'";
        //echo $sql;
        $ttdisp = $bd->ejecutar($sql);
        $res= mysqli_fetch_array($ttdisp);
        //$bd->cerrar();
        return $res["total"];      
    }
}
?>
