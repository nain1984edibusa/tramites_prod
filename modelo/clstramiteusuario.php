<?php
Class clstramiteusuario{
    //campos de la tabla 
    private $tu_id;
    private $tu_codigo;
    private $usu_eid;
    private $usu_iid;
    private $tra_id;
    private $tu_fecha_ingreso;  //FECHA DE INGRESO DEL TRÁMITE
    private $tu_fecha_contcont; //FECHA DE CONTROL DE LA CONTESTACIÓN (NO INCLUYE COLCHON)
    private $tu_fecha_aprocont; //FECHA APROXIMADA DE CONTESTACIÓN (+COLCHON)
    private $tu_fecha_contestacion;
    private $tu_band_convalidar;
    private $tu_band_respuesta;
    private $tu_band_convanxres;
    private $tu_band_firma;
    private $reg_id;
    private $et_id;
    private $tu_estado; //ACTIVO, INACTIVO (si hubo un error en el ingreso a nivel de base de datos)
    /*ADD 1/2*/
    private $tu_fecha_iniciocoa;  //FECHA DE INICIO COA
    private $tu_fecha_convalidacion; //FECHA DE ULTIMA CONVALIDACIÓN
    private $tu_fecha_concon; //FECHA DE CONTROL DE CONVALIDACIÓN
    private $tu_fecha_concoa; //FECHA DE CONTROL COA 
    /*add*/
    //////////////////////////////   funciones get y set //////////////////////
    /*ADD 2/2*/
    function getTu_fecha_iniciocoa() {
        return $this->tu_fecha_iniciocoa;
    }

    function getTu_fecha_convalidacion() {
        return $this->tu_fecha_convalidacion;
    }

    function getTu_fecha_concon() {
        return $this->tu_fecha_concon;
    }

    function getTu_fecha_concoa() {
        return $this->tu_fecha_concoa;
    }

    function setTu_fecha_iniciocoa($tu_fecha_iniciocoa) {
        $this->tu_fecha_iniciocoa = $tu_fecha_iniciocoa;
    }

    function setTu_fecha_convalidacion($tu_fecha_convalidacion) {
        $this->tu_fecha_convalidacion = $tu_fecha_convalidacion;
    }

    function setTu_fecha_concon($tu_fecha_concon) {
        $this->tu_fecha_concon = $tu_fecha_concon;
    }

    function setTu_fecha_concoa($tu_fecha_concoa) {
        $this->tu_fecha_concoa = $tu_fecha_concoa;
    }
    /*add*/
        
    function getTu_id() {
        return $this->tu_id;
    }

    function getTu_codigo() {
        return $this->tu_codigo;
    }

    function getUsu_eid() {
        return $this->usu_eid;
    }

    function getTra_id() {
        return $this->tra_id;
    }

    function getTu_fecha_ingreso() {
        return $this->tu_fecha_ingreso;
    }

    function getTu_fecha_contcont() {
        return $this->tu_fecha_contcont;
    }

    function getTu_fecha_aprocont() {
        return $this->tu_fecha_aprocont;
    }

    function getTu_fecha_contestacion() {
        return $this->tu_fecha_contestacion;
    }

    function getReg_id() {
        return $this->reg_id;
    }

    function getEt_id() {
        return $this->et_id;
    }

    function setTu_id($tu_id) {
        $this->tu_id = $tu_id;
    }

    function setTu_codigo($tu_codigo) {
        $this->tu_codigo = $tu_codigo;
    }

    function setUsu_eid($usu_eid) {
        $this->usu_eid = $usu_eid;
    }

    function setTra_id($tra_id) {
        $this->tra_id = $tra_id;
    }

    function setTu_fecha_ingreso($tu_fecha_ingreso) {
        $this->tu_fecha_ingreso = $tu_fecha_ingreso;
    }

    function setTu_fecha_contcont($tu_fecha_contcont) {
        $this->tu_fecha_contcont = $tu_fecha_contcont;
    }

    function setTu_fecha_aprocont($tu_fecha_aprocont) {
        $this->tu_fecha_aprocont = $tu_fecha_aprocont;
    }

    function setTu_fecha_contestacion($tu_fecha_contestacion) {
        $this->tu_fecha_contestacion = $tu_fecha_contestacion;
    }

    function setReg_id($reg_id) {
        $this->reg_id = $reg_id;
    }

    function setEt_id($et_id) {
        $this->et_id = $et_id;
    }
    
    function getTu_estado() {
        return $this->tu_estado;
    }

    function setTu_estado($tu_estado) {
        $this->tu_estado = $tu_estado;
    }

    function getUsu_iid() {
        return $this->usu_iid;
    }

    function setUsu_iid($usu_iid) {
        $this->usu_iid = $usu_iid;
    }

    function getTu_band_convalidar() {
        return $this->tu_band_convalidar;
    }

    function setTu_band_convalidar($tu_band_convalidar) {
        $this->tu_band_convalidar = $tu_band_convalidar;
    }

    function getTu_band_respuesta() {
        return $this->tu_band_respuesta;
    }

    function setTu_band_respuesta($tu_band_respuesta) {
        $this->tu_band_respuesta = $tu_band_respuesta;
    }

    function getTu_band_convanxres() {
        return $this->tu_band_convanxres;
    }

    function setTu_band_convanxres($tu_band_convanxres) {
        $this->tu_band_convanxres = $tu_band_convanxres;
    }
    
    function getTu_band_firma() {
        return $this->tu_band_firma;
    }

    function setTu_band_firma($tu_band_firma) {
        $this->tu_band_firma = $tu_band_firma;
    }

    
                        
    ////// insertar trámite //////
    public function tu_insertar(){
        $bd=Db::getInstance();
        //$this->carga_rol_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        /*ADD1/1*/
        $bd->carga_valores("'".$this->tu_codigo."','".$this->usu_eid."','".$this->usu_iid."','".$this->tra_id."','".$this->tu_fecha_ingreso."','".$this->tu_fecha_contcont."','".$this->tu_fecha_aprocont."','".$this->reg_id."','".$this->et_id."','".$this->tu_fecha_iniciocoa."','".$this->tu_fecha_concoa."'"); // valores a insertae
        $bd->carga_campos("tu_codigo,usu_extid,usu_intid,tra_id,tu_fecha_ingreso,tu_fecha_contcont,tu_fecha_aprocont,reg_id,et_id,tu_fecha_iniciocoa,tu_fecha_concoa"); // campos a ser insertados
        /*add*/
        if($bd->insertar("ct_tramite_usuario")) // insertar
          return $bd->lastID();  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    
    public function tu_cambiar_estado(){
        $bd=Db::getInstance();
        //$this->carga_rol_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        $sql= "update ct_tramite_usuario set tu_estado='".$this->tu_estado."' WHERE tu_id='".$this->tu_id."'";
        //echo $sql;
        //exit();
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }
    
    /*public function tu_cambiar_bandeja(){
        $bd=Db::getInstance();
        //$this->carga_rol_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        $sql= "update ct_tramite_usuario set et_id='".$this->et_id."', tu_band_convalidar='0' WHERE tu_id='".$this->tu_id."'";
        //echo $sql;
        //exit();
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }*/
    
    //////   seleccionar tramites_usuario por id
    public function tra_seleccionar_byid(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select ct_tramite_usuario.*, ct_tramites.tra_nombre,ct_tramites.tra_respuesta, ct_tramites.tra_resultado, ct_tramites.tra_id, ct_estadotramite.et_nombre, ct_usuarios.usu_nombre, ct_usuarios.usu_apellido, ct_usuarios.usu_tidentificador, ct_usuarios.usu_identificador, ct_usuarios.usu_correo, ct_usuarios.usu_telefono FROM ct_tramite_usuario"
                ." inner join ct_tramites ON ct_tramite_usuario.tra_id=ct_tramites.tra_id inner join ct_estadotramite ON ct_tramite_usuario.et_id=ct_estadotramite.et_id inner join ct_usuarios ON ct_tramite_usuario.usu_extid=ct_usuarios.usu_id "
                . " WHERE ct_tramite_usuario.tu_id='".$this->tu_id."'";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }

    //////   seleccionar todos los tramites_usuario de la bandeja de un determinado usuario (interno o externo) y estado de trámite ///////////////////
    public function tra_seleccionar_all_byusu($usuario,$estado_tramite,$tusuario,$offset,$per_page,$where=""){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $wh="";
        if($tusuario!="4"){
            $wh="usu_intid";
        }else{
            $wh="usu_extid";
        }
        $sql = "select ct_tramite_usuario.*, ct_tramites.tra_nombre,ct_tramites.tra_respuesta, ct_estadotramite.et_nombre FROM ct_tramite_usuario"
                ." inner join ct_tramites ON ct_tramite_usuario.tra_id=ct_tramites.tra_id inner join ct_estadotramite ON ct_tramite_usuario.et_id=ct_estadotramite.et_id "
                ." WHERE ".$wh." = '$usuario' and tu_estado='ACTIVO' and ct_tramite_usuario.et_id='$estado_tramite' ".$where." ORDER BY tu_fecha_ingreso ASC LIMIT $offset,$per_page";
        $res = $bd->ejecutar($sql);
        $bd->cerrar();
        return $res;
    }
    //////   seleccionar todos los tramites_usuario de la bandeja de un determinado usuario externo y estado de trámite ///////////////////
    /*public function tra_seleccionar_all_byusue($usu_externo,$estado_tramite){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select ct_tramite_usuario.*, ct_tramites.tra_nombre, ct_estadotramite.et_nombre FROM ct_tramite_usuario"
                . " inner join ct_tramites ON ct_tramite_usuario.tra_id=ct_tramites.tra_id inner join ct_estadotramite ON ct_tramite_usuario.et_id=ct_estadotramite.et_id "
                . " WHERE usu_extid = '$usu_externo' and ct_tramite_usuario.et_id='$estado_tramite' ORDER BY tu_fecha_ingreso ASC";
        $res = $bd->ejecutar($sql);
        $bd->cerrar();
        return $res;
    }*/
    //////   contar todos los tramites_usuario de la bandeja de un determinado usuario (externo o interno) y estado de trámite ///////////////////
    public function tra_contar_all_byusu($usuario,$estado_tramite,$tusuario,$where=""){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $wh="";
        if($tusuario!="4"){
            $wh="usu_intid";
        }else{
            $wh="usu_extid";
        }
        $sql = "select count(*) as total FROM ct_tramite_usuario"
                //. " inner join ct_tramites ON ct_tramite_usuario.tra_id=ct_tramites.tra_id inner join ct_estadotramite ON ct_tramite_usuario.et_id=ct_estadotramite.et_id "
                . " WHERE ".$wh." = '$usuario' and tu_estado='ACTIVO' and ct_tramite_usuario.et_id='$estado_tramite' ".$where." ORDER BY tu_fecha_ingreso ASC";
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }
    public function tra_contar_all_byusugrupo($usuario,$estado_tramite,$tusuario,$grupo){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        //la fecha de hoy
        date_default_timezone_set('America/Guayaquil');
        $hoy=date("Y-m-d");
        $wh="";
        if($tusuario!="4"){
            $wh="usu_intid";
        }else{
            $wh="usu_extid";
        }
        $wh2="";
        if($grupo=="D"){
            //danger
            $wh2=" and '$hoy' >ct_tramite_usuario.tu_fecha_aprocont ";
        }else{
            //warning
            $wh2=" and ('$hoy'>ct_tramite_usuario.tu_fecha_contcont and '$hoy'<=ct_tramite_usuario.tu_fecha_aprocont) ";
        }
        $sql = "select count(*) as total FROM ct_tramite_usuario"
                //. " inner join ct_tramites ON ct_tramite_usuario.tra_id=ct_tramites.tra_id inner join ct_estadotramite ON ct_tramite_usuario.et_id=ct_estadotramite.et_id "
                . " WHERE ".$wh." = '$usuario' and tu_estado='ACTIVO' and ct_tramite_usuario.et_id='$estado_tramite' $wh2 ORDER BY tu_fecha_ingreso ASC";
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }
    //////   seleccionar todos los tramites_usuario de la bandeja de un determinado usuario (externo o interno) y con un array de estados de trámite ///////////////////
    public function tra_seleccionar_all_byusu_ve($usu_externo,$estados_tramite,$tusuario,$offset,$per_page,$whe=""){ //varios estados
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $where="";
        for($i=0;$i<count($estados_tramite);$i++){
            $where.='ct_tramite_usuario.et_id="'.$estados_tramite[$i].'" or ';
        }
        $wh="";
        if($tusuario!="4"){
            $wh="usu_intid";
        }else{
            $wh="usu_extid";
        }
        $sql = "select ct_tramite_usuario.*, ct_tramites.tra_nombre, ct_tramites.tra_respuesta, ct_estadotramite.et_nombre FROM ct_tramite_usuario"
                . " inner join ct_tramites ON ct_tramite_usuario.tra_id=ct_tramites.tra_id inner join ct_estadotramite ON ct_tramite_usuario.et_id=ct_estadotramite.et_id "
                . " WHERE (".substr($where,0,-3).") and tu_estado='ACTIVO' and ".$wh." = '$usu_externo' ".$whe." ORDER BY tu_fecha_ingreso ASC LIMIT $offset,$per_page";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        $bd->cerrar();
        return $res;
    }
    
    //////   contar todos los tramites_usuario de la bandeja de un determinado usuario (interno o externo) y estado de trámite ///////////////////
    public function tra_contar_all_byusu_ve($usu_externo,$estados_tramite,$tusuario,$whe=""){ //varios estados
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $where="";
        for($i=0;$i<count($estados_tramite);$i++){
            $where.='ct_tramite_usuario.et_id="'.$estados_tramite[$i].'" or ';
        }
        $wh="";
        if($tusuario!="4"){
            $wh="usu_intid";
        }else{
            $wh="usu_extid";
        }
        $sql = "select count(*) as total FROM ct_tramite_usuario"
                //. " inner join ct_tramites ON ct_tramite_usuario.tra_id=ct_tramites.tra_id inner join ct_estadotramite ON ct_tramite_usuario.et_id=ct_estadotramite.et_id "
                . " WHERE (".substr($where,0,-3).") and tu_estado='ACTIVO' and ".$wh." = '$usu_externo' ".$whe." ORDER BY tu_fecha_ingreso ASC";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }
    public function tra_contar_all_byusugrupo_ve($usu_externo,$estados_tramite,$tusuario,$grupo){ //varios estados
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        //la fecha de hoy
        date_default_timezone_set('America/Guayaquil');
        $hoy=date("Y-m-d");
        $where="";
        for($i=0;$i<count($estados_tramite);$i++){
            $where.='ct_tramite_usuario.et_id="'.$estados_tramite[$i].'" or ';
        }
        $wh="";
        if($tusuario!="4"){
            $wh="usu_intid";
        }else{
            $wh="usu_extid";
        }
        $wh2="";
        if($grupo=="D"){
            //danger
            $wh2=" and '$hoy' >ct_tramite_usuario.tu_fecha_aprocont ";
        }else{
            //warning
            $wh2=" and ('$hoy'>ct_tramite_usuario.tu_fecha_contcont and '$hoy'<=ct_tramite_usuario.tu_fecha_aprocont) ";
        }
        $sql = "select count(*) as total FROM ct_tramite_usuario"
                //. " inner join ct_tramites ON ct_tramite_usuario.tra_id=ct_tramites.tra_id inner join ct_estadotramite ON ct_tramite_usuario.et_id=ct_estadotramite.et_id "
                . " WHERE (".substr($where,0,-3).") and tu_estado='ACTIVO' and ".$wh." = '$usu_externo' $wh2 ORDER BY tu_fecha_ingreso ASC";
        //echo $sql;
        //echo $sql;
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }
    
    //////   contar todos los tramites_usuario de la bandeja de un determinado usuario (interno o externo) y estado de trámite ///////////////////
    public function tra_reasignar($tabla){ //varios estados
        $bd=Db::getInstance();
        $parametros ="usu_intid = '$this->usu_iid', et_id = '$this->et_id'";
        $bd->carga_valores("tu_id = ".$this->tu_id);
        $bd->carga_campos($parametros);
        if($bd->actualizar($tabla)) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    
    public function tra_cambiar_bandconvalidacion($tabla){ //varios estados
        $bd=Db::getInstance();
        $parametros ="tu_band_convalidar = '$this->tu_band_convalidar'";
        $bd->carga_valores("tu_codigo = ".$this->tu_codigo);
        $bd->carga_campos($parametros);
        if($bd->actualizar($tabla)) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    
    public function tra_cambiar_bandrespuesta($tabla){ //varios estados
        $bd=Db::getInstance();
        $parametros ="tu_band_respuesta = '$this->tu_band_respuesta'";
        $bd->carga_valores("tu_id = ".$this->tu_id);
        $bd->carga_campos($parametros);
        if($bd->actualizar($tabla)) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    
    public function tra_cambiar_bandanxres($tabla){ //varios estados
        $bd=Db::getInstance();
        $parametros ="tu_band_convanxres = '$this->tu_band_convanxres'";
        $bd->carga_valores("tu_codigo = ".$this->tu_codigo);
        $bd->carga_campos($parametros);
        if($bd->actualizar($tabla)) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    
    /*public function tra_cambiar_bandfirma(){ //varios estados
        $bd=Db::getInstance();
        $parametros ="tu_band_firma = '$this->tu_band_firma'";
        $bd->carga_valores("tu_codigo = ".$this->tu_codigo);
        $bd->carga_campos($parametros);
        if($bd->actualizar("ct_tramite_usuario")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }*/
    
    //////   contar todos los tramites_usuario de la bandeja de un determinado usuario (interno o externo) y estado de trámite ///////////////////
    public function tra_convalidar($tabla){ //varios estados
        $bd=Db::getInstance();
        /*ADD 1/1 Sentencia parametros modificada*/
        $parametros =" et_id = '$this->et_id', tu_fecha_iniciocoa=NULL, tu_fecha_concoa=NULL, tu_fecha_convalidacion = '$this->tu_fecha_convalidacion', tu_fecha_concon = '$this->tu_fecha_concon'";
        /*add*/
        $bd->carga_valores("tu_id = ".$this->tu_id);
        $bd->carga_campos($parametros);
        if($bd->actualizar($tabla)) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    /*ADD 1/1 Aumentada esta función*/
    public function tra_enviarconvalidacion($tabla){ //varios estados
        $bd=Db::getInstance();
        /*ADD 1/1 Sentencia parametros modificada*/
        $parametros =" et_id = '$this->et_id', tu_fecha_iniciocoa='$this->tu_fecha_iniciocoa', tu_fecha_concoa='$this->tu_fecha_concoa', tu_fecha_convalidacion = NULL, tu_fecha_concon = NULL";
        /*add*/
        $bd->carga_valores("tu_id = ".$this->tu_id);
        $bd->carga_campos($parametros);
        if($bd->actualizar($tabla)) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    /*add*/
    public function tra_contestar($tabla){
    $bd=Db::getInstance();
    $parametros =" et_id = '$this->et_id', tu_fecha_contestacion = '$this->tu_fecha_contestacion'";
    $bd->carga_valores("tu_id = ".$this->tu_id);
    $bd->carga_campos($parametros);
    if($bd->actualizar($tabla)) // insertar
      return 1;  // exito
    else 
      return 0;  // error
    }
    //////   seleccionar tramite por id    ///////////////////
    /*public function tra_seleccionar_byid(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select * FROM ct_tramites where tra_id='".$this->tra_id."'";
        $res = $bd->ejecutar($sql);
        $bd->cerrar();
        return $res;
    }*/
    
}

