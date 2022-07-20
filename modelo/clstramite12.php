<?php
Class clstramite12 extends clstramiteusuario{
    private $te_ambito;
    private $te_cantidad_fichas;
    private $te_persona_responsable;
    private $te_fecha_ingreso;
    private $te_tecnico_responsable;
    private $te_fecha_revision;
    private $te_cumple;
    private $te_observaciones;
    function getTe_ambito() {
        return $this->te_ambito;
    }

    function getTe_persona_responsable() {
        return $this->te_persona_responsable;
    }

    function getTe_fecha_ingreso() {
        return $this->te_fecha_ingreso;
    }

    function getTe_tecnico_responsable() {
        return $this->te_tecnico_responsable;
    }

    function getTe_fecha_revision() {
        return $this->te_fecha_revision;
    }

    function setTe_ambito($te_ambito) {
        $this->te_ambito = $te_ambito;
    }

    function getTe_cantidad_fichas() {
        return $this->te_cantidad_fichas;
    }

    function setTe_cantidad_fichas($te_cantidad_fichas) {
        $this->te_cantidad_fichas = $te_cantidad_fichas;
    }

    
    function setTe_persona_responsable($te_persona_responsable) {
        $this->te_persona_responsable = $te_persona_responsable;
    }

    function setTe_fecha_ingreso($te_fecha_ingreso) {
        $this->te_fecha_ingreso = $te_fecha_ingreso;
    }

    function setTe_tecnico_responsable($te_tecnico_responsable) {
        $this->te_tecnico_responsable = $te_tecnico_responsable;
    }

    function setTe_fecha_revision($te_fecha_revision) {
        $this->te_fecha_revision = $te_fecha_revision;
    }
    
    function getTe_cumple() {
        return $this->te_cumple;
    }

    function getTe_observaciones() {
        return $this->te_observaciones;
    }

    function setTe_cumple($te_cumple) {
        $this->te_cumple = $te_cumple;
    }

    function setTe_observaciones($te_observaciones) {
        $this->te_observaciones = $te_observaciones;
    }

    
    public function tu_insertar(){
        $bd=Db::getInstance();
        //$this->carga_rol_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        $bd->carga_valores("'".$this->getTu_codigo()."','".$this->getUsu_eid()."','".$this->getUsu_iid()."','".$this->getTra_id()."','".$this->getTu_fecha_ingreso()."','".$this->getTu_fecha_contcont()."','".$this->getTu_fecha_aprocont()."','".$this->getReg_id()."','".$this->getEt_id()."','".$this->te_ambito."','".$this->te_cantidad_fichas."','".$this->te_persona_responsable."','".$this->te_fecha_ingreso."','".$this->te_tecnico_responsable."','".$this->te_fecha_revision."'"); // valores a insertae
        $bd->carga_campos("tu_codigo,usu_extid,usu_intid,tra_id,tu_fecha_ingreso,tu_fecha_contcont,tu_fecha_aprocont,reg_id,et_id,te_ambito,te_cantidad_fichas,te_persona_responsable,te_fecha_ingreso,te_tecnico_responsable,te_fecha_revision"); // campos a ser insertados
        if($bd->insertar("_ct_tramite12")) // insertar
          return $bd->lastID();  // exito
        else 
          return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }
    public function tra_seleccionar_bycodigo(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select _ct_tramite12.* FROM _ct_tramite12 "
                //." inner join ct_provincia ON _ct_tramite8.te_provincia=ct_provincia.pro_id inner join ct_canton ON _ct_tramite8.te_canton=ct_canton.can_id inner join ct_parroquia ON _ct_tramite8.te_parroquia=ct_parroquia.par_id "
                . " WHERE _ct_tramite12.tu_codigo='".$this->getTu_codigo()."'";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }
    
    public function tra_enviarconval(){ //varios estados
        $bd=Db::getInstance();
        $parametros ="te_ambito = '".$this->getTe_ambito()."', te_cantidad_fichas = '".$this->getTe_cantidad_fichas()."', te_persona_responsable = '".$this->getTe_persona_responsable()."', te_fecha_ingreso = '".$this->getTe_fecha_ingreso()."', te_tecnico_responsable='".$this->getTe_tecnico_responsable()."',te_fecha_revision='".$this->getTe_fecha_revision()."', te_cumple = 'PENDIENTE'";
        $bd->carga_valores("tu_id = ".$this->getTu_id());
        $bd->carga_campos($parametros);
        if($bd->actualizar("_ct_tramite12")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    
    public function tra_validar_formsolicitud(){ //varios estados
        $bd=Db::getInstance();
        $parametros ="te_cumple = '".$this->getTe_cumple()."', te_observaciones = '".$this->getTe_observaciones()."'";
        $bd->carga_valores("tu_codigo = ".$this->getTu_codigo());
        $bd->carga_campos($parametros);
        if($bd->actualizar("_ct_tramite12")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    
    public function tra_contar_validacionrequisitos($estado){
        $bd=Db::getInstance();
        $sql="SELECT count(*) as total from _ct_tramite12 WHERE te_cumple='".$estado."' and  _ct_tramite12.tu_codigo='".$this->getTu_codigo()."'";
        //echo $sql;
        $ttdisp = $bd->ejecutar($sql);
        $res= mysqli_fetch_array($ttdisp);
        //$bd->cerrar();
        return $res["total"];      
    }
    
}

