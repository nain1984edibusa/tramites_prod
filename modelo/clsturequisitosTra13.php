<?php

Class clsturequisitosTra13{	 
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
        $bd->carga_valores("'".$this->tur_rutaarchivo."','".$this->tu_id."','".$this->req_id."','PENDIENTE DE REVISIÓN'"); // valores a insertae
        $bd->carga_campos("tur_ruta_minuta_compraventa,tu_id,req_id,tur_cumple"); // campos a ser insertados
        if($bd->insertar("_ct_tramite".$this->getTra_id()."_requisitos")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
    }
    
       ////// insertar requisito //////
    public function tur_insertarReqTr13($ruta_minuta, $tur_cedula_propietario, $tur_nombres_propietario, $tur_email_propietario,
            $tur_cedula_beneficiario, $tur_nombres_beneficiario, $tur_email_beneficiario, $tu13_id, $tur_parroquia_bi, $tur_telefono_propietario,$tur_telefono_beneficiario, $tur_cod_inventario_bi){
        $bd=Db::getInstance();

        $bd->carga_valores("'".$ruta_minuta."','".$tur_cedula_propietario."','".$tur_nombres_propietario."','".$tur_email_propietario."','".$tur_cedula_beneficiario."','".$tur_nombres_beneficiario."','".$tur_email_beneficiario."','".$tu13_id."','".$tur_parroquia_bi."', '".$tur_telefono_propietario."','".$tur_telefono_beneficiario."', '".$tur_cod_inventario_bi."'"); // valores a insertae
        $bd->carga_campos("tur_ruta_minuta_compra_venta,tur_dueno_cedula, tur_dueno_nom,tur_dueno_email, tur_benef_cedula, tur_benef_nom, tur_benef_email, tu_id, tur_parroquia_bi, tur_dueno_telf, tur_benef_telf, tur_cod_inventario_bi"); // campos a ser insertados        
        try {
            $bd->insertar("_ct_tramite".$this->getTra_id()."_requisitos");
            return 1;
        }catch (mysqli_sql_exception $e) {
            echo $e;
            return 0;

        }
        
    }
    public function tur_seleccionar_byte(){ //CAMBIAR --PENDIENTE
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select _ct_tramite".$this->tra_id."_requisitos.*, ct_tramiterequisitos.req_nombre, ct_tramiterequisitos.req_rutaformato FROM _ct_tramite".$this->tra_id."_requisitos "
                ." inner join ct_tramiterequisitos ON _ct_tramite".$this->tra_id."_requisitos.req_id=ct_tramiterequisitos.req_id "
                . " WHERE _ct_tramite".$this->tra_id."_requisitos.tu_id='".$this->tu_id."'";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        return $res;
    }

}
?>
