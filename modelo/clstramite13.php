<?php
Class clstramite13 extends clstramiteusuario{
    private $te_provincia;
    private $te_canton;
    private $te_parroquia;
    private $te_regional;
    private $te_direccion;
    private $te_codigo_inventario; 
    private $te_dueno_nom;
    private $te_dueno_cedula; 
    private $te_dueno_email;
    private $te_dueno_telf;
    private $te_benef_nom;
    private $te_benef_cedula;
    private $te_benef_email;
    private $te_benef_telf;
    private $te_cumple;
    private $te_observaciones;
    
    function getTe_observaciones() {
        return $this->te_observaciones;
    }

    function setTe_observaciones($te_observaciones): void {
        $this->te_observaciones = $te_observaciones;
    }

        function getTe_cumple() {
        return $this->te_cumple;
    }

    function setTe_cumple($te_cumple): void {
        $this->te_cumple = $te_cumple;
    }

    
        function getTe_provincia() {
        return $this->te_provincia;
    }

    function getTe_canton() {
        return $this->te_canton;
    }

    function getTe_parroquia() {
        return $this->te_parroquia;
    }

    function getTe_regional() {
        return $this->te_regional;
    }

    function getTe_direccion() {
        return $this->te_direccion;
    }

    function getTe_codigo_inventario() {
        return $this->te_codigo_inventario;
    }

    function getTe_dueno_nom() {
        return $this->te_dueno_nom;
    }

    function getTe_dueno_cedula() {
        return $this->te_dueno_cedula;
    }

    function getTe_dueno_email() {
        return $this->te_dueno_email;
    }

    function getTe_dueno_telf() {
        return $this->te_dueno_telf;
    }

    function getTe_benef_nom() {
        return $this->te_benef_nom;
    }

    function getTe_benef_cedula() {
        return $this->te_benef_cedula;
    }

    function getTe_benef_email() {
        return $this->te_benef_email;
    }

    function getTe_benef_telf() {
        return $this->te_benef_telf;
    }

    function setTe_provincia($te_provincia) {
        $this->te_provincia = $te_provincia;
    }

    function setTe_canton($te_canton) {
        $this->te_canton = $te_canton;
    }

    function setTe_parroquia($te_parroquia) {
        $this->te_parroquia = $te_parroquia;
    }

    function setTe_regional($te_regional) {
        $this->te_regional = $te_regional;
    }

    function setTe_direccion($te_direccion) {
        $this->te_direccion = $te_direccion;
    }

    function setTe_codigo_inventario($te_codigo_inventario) {
        $this->te_codigo_inventario = $te_codigo_inventario;
    }

    function setTe_dueno_nom($te_dueno_nom) {
        $this->te_dueno_nom = $te_dueno_nom;
    }

    function setTe_dueno_cedula($te_dueno_cedula) {
        $this->te_dueno_cedula = $te_dueno_cedula;
    }

    function setTe_dueno_email($te_dueno_email) {
        $this->te_dueno_email = $te_dueno_email;
    }

    function setTe_dueno_telf($te_dueno_telf) {
        $this->te_dueno_telf = $te_dueno_telf;
    }

    function setTe_benef_nom($te_benef_nom) {
        $this->te_benef_nom = $te_benef_nom;
    }

    function setTe_benef_cedula($te_benef_cedula) {
        $this->te_benef_cedula = $te_benef_cedula;
    }

    function setTe_benef_email($te_benef_email) {
        $this->te_benef_email = $te_benef_email;
    }

    function setTe_benef_telf($te_benef_telf) {
        $this->te_benef_telf = $te_benef_telf;
    }

    
   /* function setTe_codigo_inventario($te_codigo_inventario) {
        $this->te_codigo_inventario = $te_codigo_inventario;
    }*/

    public function tu_insertar(){
        $bd=Db::getInstance();
        //$this->carga_rol_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        
        //$bd->carga_valores("'".$this->getTu_codigo()."','".$this->getUsu_eid()."','".$this->getUsu_iid()."','".$this->getTra_id()."','".$this->getTu_fecha_ingreso()."','".$this->getTu_fecha_contcont()."','".$this->getTu_fecha_aprocont()."','".$this->getReg_id()."'"); // valores a insertae
        $bd->carga_valores( "'".$this->getTu_codigo()."', "
                . "'".$this->getUsu_eid()."', "
                . "'".$this->getUsu_iid()."', "
                . "'".$this->getTra_id()."', "
                . "'".$this->getTu_fecha_ingreso()."', "
                . "'".$this->getTu_fecha_contcont()."',"
                . "'".$this->getTu_fecha_aprocont()."', "
                . "'".$this->getReg_id()."',"
                . "'".$this->getEt_id()."' ,"
                . "'".$this->getTu_estado()."' ,"
                . "'".$this->getTe_provincia()."' ,"
                . "'".$this->getTe_canton()."' ,"
                . "'".$this->getTe_parroquia()."' ,"
                . "'".$this->getTe_regional()."' ,"
                . "'".$this->getTe_direccion()."',"
                . "'".$this->getTe_codigo_inventario()."', "
                . "'".$this->getTe_dueno_nom()."', "
                . "'".$this->getTe_dueno_cedula()."', "
                . "'".$this->getTe_dueno_email()."', "
                . "'".$this->getTe_dueno_telf()."', "
                . "'".$this->getTe_benef_nom()."', "
                . "'".$this->getTe_benef_cedula()."', "
                . "'".$this->getTe_benef_email()."', "
                . "'".$this->getTe_benef_telf()."'");
 
         $bd->carga_campos( "tu_codigo, "
        . "usu_extid, "
                . "usu_intid, "
                . "tra_id, "
                . "tu_fecha_ingreso, "
                . "tu_fecha_contcont, "
                . "tu_fecha_aprocont, "
                . "reg_id, "
                . "et_id, "
                . "tu_estado, "
                . "te_provincia, "
                . "te_canton, "
                . "te_parroquia, "
                . "te_regional, "
                . "te_direccion, "
                . "te_codigo_inventario, "
                . "tur_dueno_nom, "
                . "tur_dueno_cedula, "
                . "tur_dueno_email, "
                . "tur_dueno_telf, "
                . "tur_benef_nom, "
                . "tur_benef_cedula, "
                . "tur_benef_email, "
                . "tur_benef_telf");
  
        try {
            //connect('username','password','database','host');
            $bd->insertar("_ct_tramite13");
            return $bd->lastID();
            //echo 'Connected to database';
        } catch (Exception $e) {
            echo $e->errorMessage();
            return $e->errorMessage();
        }
        //if($bd->insertar("_ct_tramite13")) // insertar
            //Debe realizar el proceso de insertar los requisitos una vez insertado el trámite 

          //return $bd->lastID();  // exito
        //else 
          //return 0;  // error
        $bd->cerrar();  // cerrar coneccion


    }
    public function tra_seleccionar_13bycodigo(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        //$sql = "select _ct_tramite13.*, ct_provincia.pro_nombre, ct_canton.can_nombre, ct_parroquia.par_nombre FROM _ct_tramite8 "
        //        ." inner join ct_provincia ON _ct_tramite13.te_provincia=ct_provincia.pro_id inner join ct_canton ON _ct_tramite8.te_canton=ct_canton.can_id inner join ct_parroquia ON _ct_tramite8.te_parroquia=ct_parroquia.par_id "
        //        . " WHERE _ct_tramite8.tu_codigo='".$this->getTu_codigo()."'";
        
        
        $sql = "SELECT *FROM _ct_tramite13 as tr13
                INNER JOIN _ct_tramite13_requisitos AS tr13_req
                ON tr13.tu_id = tr13_req.tu_id
                INNER JOIN ct_parroquia as parr
                ON tr13.te_parroquia = parr.par_id
                INNER JOIN ct_canton as can
                ON can.can_id = parr.can_id
                INNER JOIN ct_provincia as prov
                ON prov.pro_id = can.pro_id
                WHERE tr13.tu_codigo = '".$this->getTu_codigo()."'";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }
    
        
    public function tur_seleccionAll(){
        $bd=Db::getInstance();
        $sql = "SELECT *FROM _ct_tramite13 as tr13
                INNER JOIN _ct_tramite13_requisitos AS tr13_req
                ON tr13.tu_id = tr13_req.tu_id
                INNER JOIN _ct_tramite13_respuestas as tr13resp
                ON tr13resp.tu_codigo = tr13.tu_codigo
                INNER JOIN _ct_tramite_13_resp_anexos as tr13anx
                ON tr13anx.fk_ct_tramite13_resp_id = tr13resp.tu_resp_id
                WHERE tr13.tu_codigo = '".$this->getTu_codigo()."'";
        $res = $bd->ejecutar($sql);
        $bd->cerrar();
        return $res;
        
    }

    public function tra_seleccionar_bycodigo(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select _ct_tramite13.*, ct_provincia.pro_nombre, ct_canton.can_nombre, ct_parroquia.par_nombre FROM _ct_tramite13 "
                ." inner join ct_provincia ON _ct_tramite13.te_provincia=ct_provincia.pro_id inner join ct_canton ON _ct_tramite13.te_canton=ct_canton.can_id inner join ct_parroquia ON _ct_tramite13.te_parroquia=ct_parroquia.par_id "
                . " WHERE _ct_tramite13.tu_codigo='".$this->getTu_codigo()."'";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }

    public function tra_contar_validacionrequisitos($estado){
        $bd=Db::getInstance();
        $sql="SELECT count(*) as total from _ct_tramite13 WHERE te_cumple='".$estado."' and  _ct_tramite13.tu_codigo='".$this->getTu_codigo()."'";
        //echo $sql;
        $ttdisp = $bd->ejecutar($sql);
        $res= mysqli_fetch_array($ttdisp);
        //$bd->cerrar();
        return $res["total"];      
    }
    
     public function tra_enviarconval(){ //varios estados
        $bd=Db::getInstance();
        $parametros ="te_provincia = '".$this->getTe_provincia()."', te_canton = '".$this->getTe_canton()."', te_parroquia = '".$this->getTe_parroquia()."', te_direccion = '".$this->getTe_direccion()."', te_codigo_inventario='".$this->getTe_codigo_inventario()."', te_regional = '".$this->getTe_regional()."', te_cumple = 'PENDIENTE'"
                . ",tur_dueno_cedula = '".$this->getTe_dueno_cedula()."'"
                . ",tur_dueno_nom = '".$this->getTe_dueno_nom()."' "
                . ",tur_dueno_email = '".$this->getTe_dueno_email()."'"
                . ",tur_dueno_telf = '".$this->getTe_dueno_telf()."'"
                . ",tur_benef_cedula = '".$this->getTe_benef_cedula()."'"
                . ",tur_benef_nom = '".$this->getTe_benef_nom()."'"
                . ",tur_benef_email = '".$this->getTe_benef_email()."'"
                . ",tur_benef_telf = '".$this->getTe_benef_telf()."'";
        
        $bd->carga_valores("tu_id = ".$this->getTu_id());
        $bd->carga_campos($parametros);
        if($bd->actualizar("_ct_tramite13")) // insertar
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
        if($bd->actualizar("_ct_tramite13")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    

    
}

