<?php
Class clstramite16 extends clstramiteusuario{
    private $te_area;
    private $te_tema;
    
    function getTe_area() {
        return $this->te_area;
    }

    function getTe_tema() {
        return $this->te_tema;
    }

   
    function setTe_area($te_area) {
        $this->te_area = $te_area;
    }

    function setTe_tema($te_tema) {
        $this->te_tema = $te_tema;
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
        $bd->carga_valores("'".$this->getTu_codigo()."','".$this->getUsu_eid()."','".$this->getUsu_iid()."','".$this->getTra_id()."','".$this->getTu_fecha_ingreso()."','".$this->getTu_fecha_contcont()."','".$this->getTu_fecha_aprocont()."','".$this->getReg_id()."','".$this->getEt_id()."','".$this->te_area."','".$this->te_tema."'"); // valores a insertae
        $bd->carga_campos("tu_codigo,usu_extid,usu_intid,tra_id,tu_fecha_ingreso,tu_fecha_contcont,tu_fecha_aprocont,reg_id,et_id,te_area,te_tema"); // campos a ser insertados
        if($bd->insertar("_ct_tramite16")) // insertar
          return $bd->lastID();  // exito
        else 
          return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }
    public function tra_seleccionar_bycodigo(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select _ct_tramite16.* FROM _ct_tramite16 "
                //." inner join ct_provincia ON _ct_tramite8.te_provincia=ct_provincia.pro_id inner join ct_canton ON _ct_tramite8.te_canton=ct_canton.can_id inner join ct_parroquia ON _ct_tramite8.te_parroquia=ct_parroquia.par_id "
                . " WHERE _ct_tramite16.tu_codigo='".$this->getTu_codigo()."'";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }
    
    public function tra_enviarconval(){ //varios estados
        $bd=Db::getInstance();
        $parametros ="te_area = '".$this->getTe_area()."', te_tema = '".$this->getTe_tema()."', te_cumple = 'PENDIENTE'";
        $bd->carga_valores("tu_id = ".$this->getTu_id());
        $bd->carga_campos($parametros);
        if($bd->actualizar("_ct_tramite16")) // insertar
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
        if($bd->actualizar("_ct_tramite16")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    
    public function tra_contar_validacionrequisitos($estado){
        $bd=Db::getInstance();
        $sql="SELECT count(*) as total from _ct_tramite16 WHERE te_cumple='".$estado."' and  _ct_tramite16.tu_codigo='".$this->getTu_codigo()."'";
        //echo $sql;
        $ttdisp = $bd->ejecutar($sql);
        $res= mysqli_fetch_array($ttdisp);
        //$bd->cerrar();
        return $res["total"];      
    }
    
}

