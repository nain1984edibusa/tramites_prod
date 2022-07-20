<?php

Class clstrausu{	 
         //    definio los campos de la tabla 
     private $tu_id;
	 private $tu_codigo;
	 private $tu_fecha_ingreso;
	 private $tu_fecha_contcont;
	 private $tu_fecha_aprocont;   
	 private $tu_fecha_contestacion;
	 private $tu_estado;
	 
	 //////////////////////////////   funciones //////////////////////
	
	public function carga_tu_id($tu_id){
	    	    $this->tu_id=$tu_id;
	}
	
	public function carga_tu_codigo($tu_codigo){
	    	    $this->tu_codigo=$tu_codigo;
	}
	
	public function carga_tu_fecha_ingreso($tu_fecha_ingreso){
	    	    $this->tu_fecha_ingreso=$tu_fecha_ingreso;
	}
	
	public function carga_tu_fecha_contcont($tu_fecha_contcont){
	    	    $this->tu_fecha_contcont=$tu_fecha_contcont;
	}
	
	public function carga_tu_fecha_aprocont($tu_fecha_aprocont){
	    	    $this->tu_fecha_aprocont=$tu_fecha_aprocont;
	}
	
	public function carga_tu_fecha_contestacion($tu_fecha_contestacion){
	    	    $this->tu_fecha_contestacion=$tu_fecha_contestacion;
	}
	
	public function carga_tu_estado($tu_estado){
	    	    $this->tu_estado=$tu_estado;
	}
	
		////////   insertar cantones   //////////////////
	public function trus_insertar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$this->carga_tu_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
			$bd->carga_valores($this->tu_id.",'".$this->tu_codigo."'"); // valores a insertae
			$bd->carga_campos("tu_id,tu_codigo"); // campos a ser insertados
			if($bd->insertar("ct_roles")) // insertar
			  return 1;  // exito
			else 
			  return 0;  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	//////   actualizar cantones    ///////////////////
	public function trus_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="tu_codigo = '$this->tu_codigo'";
			$bd->carga_valores("tu_id = ".$this->tu_id);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_roles"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar cantones    ///////////////////
	public function trus_seleccionar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select tu_id, tu_codigo FROM ct_roles WHERE tu_id = ".$this->tu_id;
			$rsprv = $bd->ejecutar($sql);
			$bd->cerrar();
			return $rsprv;
	}
	
	
	/////// ELIMINAR PAISES
	public function trus_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM ct_roles WHERE tu_id = ".$this->tu_id;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	//////   seleccionar cantones por provincia    ///////////////////
	public function trus_seleccionarpagina($inicio, $pagina){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'SELECT tu_id,ct_tramites.tra_nombre,tu_codigo,tu_fecha_ingreso,tu_estado,ct_usuarios.usu_apellido,ct_regional.reg_nombre, ct_estadotramite.et_nombre
FROM ct_tramite_usuario
INNER JOIN ct_usuarios on ct_tramite_usuario.usu_extid=ct_usuarios.usu_id
INNER JOIN ct_regional on ct_tramite_usuario.reg_id=ct_regional.reg_id
INNER JOIN ct_estadotramite on ct_tramite_usuario.et_id=ct_estadotramite.et_id
INNER JOIN ct_tramites on ct_tramite_usuario.tra_id=ct_tramites.tra_id ORDER BY tu_id LIMIT '.$inicio.','.$pagina;
			$rsprv = $bd->ejecutar($sql);
			$bd->cerrar();
			return $rsprv;
	}
	//////   seleccionar cantones por provincia    ///////////////////
	public function trus_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'SELECT tu_id,ct_tramites.tra_nombre,tu_codigo,tu_fecha_ingreso,tu_estado,ct_usuarios.usu_apellido,ct_regional.reg_nombre, ct_estadotramite.et_nombre
FROM ct_tramite_usuario
INNER JOIN ct_usuarios on ct_tramite_usuario.usu_extid=ct_usuarios.usu_id
INNER JOIN ct_regional on ct_tramite_usuario.reg_id=ct_regional.reg_id
INNER JOIN ct_estadotramite on ct_tramite_usuario.et_id=ct_estadotramite.et_id
INNER JOIN ct_tramites on ct_tramite_usuario.tra_id=ct_tramites.tra_id';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	/////////////////////////////    fin de provicnias      ///////////////////////
}
?>