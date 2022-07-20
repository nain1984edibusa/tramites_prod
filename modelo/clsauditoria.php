<?php
Class clsauditoria{

    private $aud_id;
    private $aud_fechahora_proceso;
    private $aud_objeto;
    private $aud_proceso;
    private $usu_id;
    private $tu_id;
    private $aud_descripcion;
    
    function getAud_id() {
        return $this->aud_id;
    }

    function getAud_fechahora_proceso() {
        return $this->aud_fechahora_proceso;
    }

    function getAud_objeto() {
        return $this->aud_objeto;
    }

    function getAud_proceso() {
        return $this->aud_proceso;
    }

    function getUsu_id() {
        return $this->usu_id;
    }

    function getTu_id() {
        return $this->tu_id;
    }

    function getAud_descripcion() {
        return $this->aud_descripcion;
    }

    function setAud_id($aud_id) {
        $this->aud_id = $aud_id;
    }

    function setAud_fechahora_proceso($aud_fechahora_proceso) {
        $this->aud_fechahora_proceso = $aud_fechahora_proceso;
    }

    function setAud_objeto($aud_objeto) {
        $this->aud_objeto = $aud_objeto;
    }

    function setAud_proceso($aud_proceso) {
        $this->aud_proceso = $aud_proceso;
    }

    function setUsu_id($usu_id) {
        $this->usu_id = $usu_id;
    }

    function setTu_id($tu_id) {
        $this->tu_id = $tu_id;
    }

    function setAud_descripcion($aud_descripcion) {
        $this->aud_descripcion = $aud_descripcion;
    }

    ////////   insertar auditoria   //////////////////
    public function auditoria_insertar(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $bd->carga_valores("'".$this->aud_fechahora_proceso."','".$this->aud_objeto."','".$this->aud_proceso."','".$this->usu_id."','".$this->tu_id."','".$this->aud_descripcion."'"); // valores a insertae
        $bd->carga_campos("aud_fechahora_proceso,aud_objeto,aud_proceso,usu_id,tu_id,aud_descripcion"); // campos a ser insertados
        if($bd->insertar("ct_auditoria")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }
    
    //////   seleccionar cantones    ///////////////////
    public function auditoria_seleccionar_bytu(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select ct_auditoria.*, ct_usuarios.usu_nombre, ct_usuarios.usu_apellido FROM ct_auditoria INNER JOIN ct_usuarios ON ct_auditoria.usu_id=ct_usuarios.usu_id WHERE tu_id = ".$this->tu_id." ORDER BY aud_id ASC";
        //echo $sql;
        $rsprv = $bd->ejecutar($sql);
        return $rsprv;
    }

    
}

