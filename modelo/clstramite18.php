<?php
Class clstramite18 extends clstramiteusuario{
    private $te_institucion;
	private $te_evento;
	private $te_tema;
	private $te_aforo;
	private $te_duracion;
	private $te_persona_acargo;
    private $te_fecha1;
	private $te_hora;
    
    function getTe_institucion() {
        return $this->te_institucion;
    }
    function setTe_institucion($te_institucion) {
        $this->te_institucion = $te_institucion;
    }
    
	function getTe_evento() {
        return $this->te_evento;
    }
    function setTe_evento($te_evento) {
        $this->te_evento = $te_evento;
    }
	
	function getTe_tema() {
        return $this->te_tema;
    }
    function setTe_tema($te_tema) {
        $this->te_tema = $te_tema;
    }
	function getTe_aforo() {
        return $this->te_aforo;
    }
    function setTe_aforo($te_aforo) {
        $this->te_aforo = $te_aforo;
    }
	
	function getTe_duracion() {
        return $this->te_duracion;
    }
    function setTe_duracion($te_duracion) {
        $this->te_duracion = $te_duracion;
    }
    function getTe_persona_acargo() {
        return $this->te_persona_acargo;
    }
    function setTe_persona_acargo($te_persona_acargo) {
        $this->te_persona_acargo = $te_persona_acargo;
    }
	function getTe_fecha1() {
        return $this->te_fecha1;
    }
    function setTe_fecha1($te_fecha1) {
        $this->te_fecha1 = $te_fecha1;
    }
	function getTe_hora() {
        return $this->te_hora;
    }
    function setTe_hora($te_hora) {
        $this->te_hora = $te_hora;
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
        $bd->carga_valores("'".$this->getTu_codigo()."','".$this->getUsu_eid()."','".$this->getUsu_iid()."','".$this->getTra_id()."','".$this->getTu_aforo()."','".$this->getTu_fecha_contcont()."','".$this->getTu_fecha_aprocont()."','".$this->getReg_id()."','".$this->getEt_id()."','".$this->te_institucion."',".$this->te_evento.",'".$this->te_tema."','".$this->te_aforo."','".$this->te_duracion."','".$this->te_persona_acargo."','".$this->te_fecha1."','".$this->te_hora."'"); // valores a insertae
        $bd->carga_campos("tu_codigo,usu_extid,usu_intid,tra_id,tu_aforo,tu_fecha_contcont,tu_fecha_aprocont,reg_id,et_id,te_institucion,te_evento,te_tema,te_aforo,te_duracion,te_persona_acargo,te_fecha1,te_hora"); // campos a ser insertados
        if($bd->insertar("_ct_tramite18")) // insertar
          return $bd->lastID();  // exito
        else 
          return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }
    public function tra_seleccionar_bycodigo(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select _ct_tramite18.* FROM _ct_tramite18 "
                //." inner join ct_provincia ON _ct_tramite8.te_provincia=ct_provincia.pro_id inner join ct_canton ON _ct_tramite8.te_canton=ct_canton.can_id inner join ct_parroquia ON _ct_tramite8.te_parroquia=ct_parroquia.par_id "
                . " WHERE _ct_tramite18.tu_codigo='".$this->getTu_codigo()."'";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }
    
    public function tra_enviarconval(){ //varios estados
        $bd=Db::getInstance();
        $parametros ="te_evento = '".$this->getTe_evento()."', te_institucion = '".$this->getTe_institucion()."', te_tema = '".$this->getTe_tema()."', te_aforo = '".$this->getTe_aforo()."', te_persona_acargo='".$this->getTe_persona_acargo()."',te_duracion='".$this->getTe_duracion()."',te_fecha1='".$this->getTe_fecha1()."',te_hora='".$this->getTe_hora()."', te_cumple = 'PENDIENTE'";
        $bd->carga_valores("tu_id = ".$this->getTu_id());
        $bd->carga_campos($parametros);
        if($bd->actualizar("_ct_tramite18")) // insertar
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
        if($bd->actualizar("_ct_tramite18")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    
    public function tra_contar_validacionrequisitos($estado){
        $bd=Db::getInstance();
        $sql="SELECT count(*) as total from _ct_tramite18 WHERE te_cumple='".$estado."' and  _ct_tramite18.tu_codigo='".$this->getTu_codigo()."'";
        //echo $sql;
        $ttdisp = $bd->ejecutar($sql);
        $res= mysqli_fetch_array($ttdisp);
        //$bd->cerrar();
        return $res["total"];      
    }
    
}

