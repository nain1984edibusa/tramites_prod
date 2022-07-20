<?php
	 
Class clsusuarios{	 
    //defino los campos de la tabla usuarios
    private $usu_id;
    private $usu_usuario; //EN LOS USUARIOS EXTERNOS, EL MISMO QUE LA CÉDULA
    private $rol_id;
    private $usu_tidentificacion;
    private $usu_identificador;
    private $usu_nombre;
    private $usu_apellido;
    private $pro_id;
    private $can_id; 
    private $par_id;
    private $usu_telefono; 
    private $usu_direccion; //noreq
    private $reg_id;
    private $usu_correo; 
    private $usu_contrasena;
    private $usu_fechcreacion;
    private $usu_estado;
    private $gen_codigo;
    private $usu_certificado;
	 
    //////////////////////////////   funciones  creo mis constructores//////////////////////
	
    function getUsu_id() {
        return $this->usu_id;
    }

    function getUsu_usuario() {
        return $this->usu_usuario;
    }

    function getRol_id() {
        return $this->rol_id;
    }

    function getUsu_tidentificacion() {
        return $this->usu_tidentificacion;
    }

    function getUsu_identificador() {
        return $this->usu_identificador;
    }

    function getUsu_nombre() {
        return $this->usu_nombre;
    }

    function getUsu_apellido() {
        return $this->usu_apellido;
    }
   
    function getPro_id() {
        return $this->pro_id;
    }

    function getCan_id() {
        return $this->can_id;
    }

    function getUsu_direccion() {
        return $this->usu_direccion;
    }

    function getReg_id() {
        return $this->reg_id;
    }

    function getUsu_correo() {
        return $this->usu_correo;
    }

    function getUsu_contrasena() {
        return $this->usu_contrasena;
    }

    function getUsu_fechcreacion() {
        return $this->usu_fechcreacion;
    }

    function getUsu_estado() {
        return $this->usu_estado;
    }

    function setUsu_id($usu_id) {
        $this->usu_id = $usu_id;
    }

    function setUsu_usuario($usu_usuario) {
        $this->usu_usuario = $usu_usuario;
    }

    function setRol_id($rol_id) {
        $this->rol_id = $rol_id;
    }

    function setUsu_tidentificacion($usu_tidentificacion) {
        $this->usu_tidentificacion = $usu_tidentificacion;
    }

    function setUsu_identificador($usu_identificador) {
        $this->usu_identificador = $usu_identificador;
    }

    function setUsu_nombre($usu_nombre) {
        $this->usu_nombre = $usu_nombre;
    }
    
    function setUsu_apellido($usu_apellido) {
        $this->usu_apellido = $usu_apellido;
    } 

    function setPro_id($pro_id) {
        $this->pro_id = $pro_id;
    }

    function setCan_id($can_id) {
        $this->can_id = $can_id;
    }

    function setUsu_direccion($usu_direccion) {
        $this->usu_direccion = $usu_direccion;
    }

    function setReg_id($reg_id) {
        $this->reg_id = $reg_id;
    }

    function setUsu_correo($usu_correo) {
        $this->usu_correo = $usu_correo;
    }

    function setUsu_contrasena($usu_contrasena) {
        $this->usu_contrasena = $usu_contrasena;
    }

    function setUsu_fechcreacion($usu_fechcreacion) {
        $this->usu_fechcreacion = $usu_fechcreacion;
    }

    function setUsu_estado($usu_estado) {
        $this->usu_estado = $usu_estado;
    }
    
    function getPar_id() {
        return $this->par_id;
    }

    function setPar_id($par_id) {
        $this->par_id = $par_id;
    }
    function getUsu_telefono() {
        return $this->usu_telefono;
    }

    function setUsu_telefono($usu_telefono) {
        $this->usu_telefono = $usu_telefono;
    }
    
    public function carga_gen_codigo($gen_codigo){
	    	    $this->gen_codigo=$gen_codigo;
	  }
    function setUsu_certificado($usu_certificado) {
        $this->usu_certificado = $usu_certificado;
    }
        	
    ////////   insertar valores    //////////////////
    public function usu_insertar(){
    // abro conexión a bases de datos
        $bd=Db::getInstance();
        //$this->carga_usu_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        $bd->carga_valores("'".$this->usu_usuario."','".$this->rol_id."','".$this->usu_tidentificacion."','".$this->usu_identificador."','".$this->usu_nombre."','".$this->usu_apellido."','".$this->pro_id."','".$this->can_id."','".$this->par_id."','".$this->usu_telefono."','".$this->usu_direccion."','".$this->reg_id."','".$this->usu_correo."','".$this->usu_contrasena."','".$this->usu_fechcreacion."','".$this->usu_estado."',0"); // valores a insertae
        $bd->carga_campos("usu_usuario,rol_id,usu_tidentificador,usu_identificador,usu_nombre,usu_apellido,pro_id,can_id,par_id,usu_telefono,usu_direccion,reg_id,usu_correo,usu_contrasena,usu_fechcreacion,usu_estado,usu_certificado"); // campos a ser insertados
        if($bd->insertar("ct_usuarios")) {// insertar
            return 1;  // exito
            //echo "carga exitosa"; 
        }
        else 
            return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }
	
    //////   actualizar usuarios    ///////////////////
    public function usu_actualizar(){
        // abro conexi�n a bases de datos
        $bd=Db::getInstance();

        $parametros ="usu_nombre = '$this->usu_nombre', usu_apellido = '$this->usu_apellido',usu_correo ='$this->usu_correo',usu_identificador='$this->usu_identificador',usu_contrasena='$this->usu_contrasena',usu_certificado='$this->usu_certificado'";
        $bd->carga_valores("usu_id = ".$this->usu_id);
        $bd->carga_campos($parametros);
       // echo $parametros;

        if($bd->actualizar("ct_usuarios"))
          return 1;
        else 
          return 0;  
        $bd->cerrar();
    }
    
    //////   activar usuario    ///////////////////
    public function usu_cambiar_estado(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();

        $parametros ="usu_estado = '$this->usu_estado'";
        $bd->carga_valores("usu_identificador = ".$this->usu_identificador);
        $bd->carga_campos($parametros);
        if($bd->actualizar("ct_usuarios"))
          return 1;
        else 
          return 0;  
        $bd->cerrar();
    }
	
    //////   seleccionar usuarios    ///////////////////
    /*public function usu_seleccionar(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select usuario.usu_id,usu_nombre,rol_id,usu_cedula,usu_correo,usu_celular,usu_telefono,usu_contrasena,solicitud.sol_id,SOL_OBSRECHAZO,ase_nombre,tpa_nombre FROM ct_usuarios,solicitud,ttpoasesoria,tipoasesoria,asesoria WHERE usuario.USU_CODIGO=solicitud.USU_CODIGO and ttpoasesoria.tpa_id=tipoasesoria.TPA_CODIGO and asesoria.ASE_CODIGO=tipoasesoria.ASE_CODIGO and usuario.usu_id =".$this->usu_id;
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }*/
    
    //OBTENER USUARIO POR ID
    public function usu_seleccionar_byid(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select ct_usuarios.*, ct_canton.can_nombre, ct_parroquia.par_nombre, ct_provincia.pro_nombre FROM ct_usuarios INNER JOIN ct_provincia ON ct_usuarios.pro_id=ct_provincia.pro_id INNER JOIN ct_canton ON ct_usuarios.can_id=ct_canton.can_id INNER JOIN ct_parroquia ON ct_usuarios.par_id=ct_parroquia.par_id WHERE ct_usuarios.usu_id =".$this->usu_id;
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }
    
    //OBTENER EMAIL USUARIO
    public function usu_email_byid(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select usu_correo, usu_nombre, usu_apellido, usu_tidentificador, usu_identificador FROM ct_usuarios WHERE ct_usuarios.usu_id =".$this->usu_id;
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }
    
    //LOGIN
    public function usu_ingreso(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select usu_id, usu_nombre, usu_apellido, usu_identificador, usu_certificado, reg_id, ct_roles.* FROM ct_usuarios INNER JOIN ct_roles ON ct_usuarios.rol_id=ct_roles.rol_id WHERE usu_estado='ACTIVO' and usu_usuario = '".$this->usu_usuario. "'"; //and usu_contrasena = '".$this->usu_contrasena."'
        //echo $sql;
        //exit();
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }
    
    //OBTENER CLAVE A NIVEL DEL SERVIDOR PARA COMPROBAR HASH
    public function usu_contrasena(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select usu_contrasena FROM ct_usuarios WHERE usu_estado='ACTIVO' and usu_usuario = '".$this->usu_usuario. "'";
        //echo $sql;
        //exit();
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }
    
    //OBTENER USUARIO DE UNA REGIONAL Y UN PERFIL ESPECÍFICO
    public function get_usuario_by_zonal_perfil($regional,$perfil){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select usu_id, usu_nombre, usu_apellido, usu_direccion FROM ct_usuarios WHERE reg_id='".$regional."' and rol_id='".$perfil."' and usu_estado='ACTIVO'";
        //echo $sql;
        //exit();
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }
	
    /////// ELIMINAR 
    public function usu_eliminar(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "DELETE FROM ct_usuarios WHERE usu_id = ".$this->usu_id;
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }
	
    //////   seleccionar usuarios por rol    ///////////////////
    public function usu_seleccionarpaginafis($inicio, $pagina){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = 'select usu_id, usu_nombre FROM ct_usuarios where rol_id=4 ORDER BY usu_id LIMIT '.$inicio.','.$pagina;
        $rsprv = $bd->ejecutar($sql);
        $bd->cerrar();
        return $rsprv;
    }
    public function usu_seleccionarpaginaasig($inicio, $pagina){
        // abro conexi�n a bases de datos
        $bd=Db::getInstance();
        $sql = 'select ct_usuarios.* FROM ct_usuarios ORDER BY usu_id LIMIT '.$inicio.','.$pagina;
        $rsprv = $bd->ejecutar($sql);
        $bd->cerrar();
        return $rsprv;
    }
    public function usu_seleccionarpaginaadm($inicio, $pagina){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = 'select usu_id, usu_nombre FROM ct_usuarios where rol_id=2 ORDER BY usu_id LIMIT '.$inicio.','.$pagina;
        $rsprv = $bd->ejecutar($sql);
        $bd->cerrar();
        return $rsprv;
    }
    //////   seleccionar cantones por provincia    ///////////////////
    public function usu_seleccionartodo(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = 'select usu_id,rol_id,usu_nombre  FROM ct_usuarios  ';
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }
    public function usuario_clave(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select usu_id, usu_nombre, usu_contrasena, usu_correo FROM ct_usuarios 
                 where usu_nombre = '".$this->usu_nombre."' and usu_correo = '".$this->usu_correo."'";
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }
    public function usu_seleccionarfisca(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select usu_id, usu_usuario,usu_nombre, usu_contrasena, usu_correo,rol_id FROM ct_usuarios 
                 where rol_id =4";
        //echo $sql;		 
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }
    public function seleccionarByEmail(){
        $bd = Db::getInstance();
        $sql = "SELECT usu_id, usu_usuario, usu_identificador, usu_nombre, usu_apellido FROM ct_usuarios "
                . "WHERE  usu_correo = '".$this->getUsu_correo()."' AND usu_estado = 'ACTIVO'";
        
        $resultQuery = $bd->ejecutar($sql);        
        $bd->cerrar();        
        return $resultQuery;
    }
    public function recuperaContrasena(){
        $bd = Db::getInstance();
        $sql = "UPDATE ct_usuarios SET usu_contrasena = '".$this->getUsu_contrasena()."'WHERE usu_id = '".$this->getUsu_id()."'";   
        
        $resultQuery = $bd->ejecutar($sql);
        $bd->cerrar();
        return $resultQuery;
    }
    public function usu_actualizarData(){
        // abro conexi�n a bases de datos
        $bd=Db::getInstance();

//        $parametros ="usu_nombre = '$this->usu_nombre', rol_id = $this->rol_id,gen_id = $this->gen_id,usu_fechmodifica = now(),usu_correo ='$this->usu_correo',usu_cedula='$this->usu_cedula',usu_pasaporte='$this->usu_pasaporte',usu_celular='$this->usu_celular',usu_telefono='$this->usu_telefono',usu_contrasena='$this->usu_contrasena',usu_usumodificacion = '$this->usu_usumodificacion', usu_nombreaplicacion = 'asesoria'";
//        $bd->carga_valores("usu_id = ".$this->usu_id);
//        $bd->carga_campos($parametros);
//        echo $parametros;
//
//        if($bd->actualizar("ct_usuarios"))
//          return 1;
//        else 
//          return 0;  
//        $bd->cerrar();
        $sql = "UPDATE ct_usuarios SET "
                . "rol_id = '".$this->getRol_id()."',"
                . "usu_tidentificador = '".$this->getUsu_tidentificacion()."',"
                . "usu_identificador = '".$this->getUsu_identificador()."',"
                . "usu_nombre = '".$this->getUsu_nombre()."',"
                . "usu_apellido = '".$this->getUsu_apellido()."',"
                . "pro_id = '".$this->getPro_id()."',"
                . "can_id = '".$this->getCan_id()."'"
                . ",par_id = '".$this->getPar_id()."',"
                . "usu_telefono = '".$this->getUsu_telefono()."'"
                . ",usu_direccion = '".$this->getUsu_direccion()."',"
                . "reg_id = '".$this->getReg_id()."',"
                . "usu_correo = '".$this->getUsu_correo()."'"
                //. "usu_contrasena = '".$this->getUsu_contrasena()."'"
                . "WHERE usu_id = '".$this->getUsu_id()."'";
        echo $sql;
                             
        if($bd->ejecutar($sql))
          return 1;
        else
          return 0;  
        $bd->cerrar();
    }
	/////////////////////////////    fin de provicnias      ///////////////////////
}
?>