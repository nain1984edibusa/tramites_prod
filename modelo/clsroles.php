<?php

Class clsroles{	 
         //    definio los campos de la tabla 
     private $rol_id;
	 private $rol_nombre;
	 private $rol_fechcreacion;
	 private $rol_fechcmodifica;
	 private $rol_usucreacion;   
	 private $rol_usumodificacion;
	 private $rol_nombreaplicacion;
	 
	 //////////////////////////////   funciones //////////////////////
	
	public function carga_rol_id($rol_id){
	    	    $this->rol_id=$rol_id;
	}
	
	public function carga_rol_nombre($rol_nombre){
	    	    $this->rol_nombre=$rol_nombre;
	}
	
	public function carga_rol_fechcreacion($rol_fechcreacion){
	    	    $this->rol_fechcreacion=$rol_fechcreacion;
	}
	
	public function carga_rol_fechmodifica($rol_fechmodifica){
	    	    $this->rol_fechmodifica=$rol_fechmodifica;
	}
	
	public function carga_rol_usucreacion($rol_usucreacion){
	    	    $this->rol_usucreacion=$rol_usucreacion;
	}
	
	public function carga_rol_usumodificacion($rol_usumodificacion){
	    	    $this->rol_usumodificacion=$rol_usumodificacion;
	}
	
	public function carga_rol_nombreaplicacion($rol_nombreaplicacion){
	    	    $this->rol_nombreaplicacion=$rol_nombreaplicacion;
	}
	
		////////   insertar cantones   //////////////////
	public function rol_insertar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$this->carga_rol_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
			$bd->carga_valores($this->rol_id.",'".$this->rol_nombre."'"); // valores a insertae
			$bd->carga_campos("rol_id,rol_nombre"); // campos a ser insertados
			if($bd->insertar("ct_roles")) // insertar
			  return 1;  // exito
			else 
			  return 0;  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	//////   actualizar cantones    ///////////////////
	public function rol_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="rol_nombre = '$this->rol_nombre'";
			$bd->carga_valores("rol_id = ".$this->rol_id);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_roles"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar cantones    ///////////////////
	public function rol_seleccionar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select rol_id, rol_nombre FROM ct_roles WHERE rol_id = ".$this->rol_id;
			$rsprv = $bd->ejecutar($sql);
			$bd->cerrar();
			return $rsprv;
	}
	
	
	/////// ELIMINAR PAISES
	public function rol_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM ct_roles WHERE rol_id = ".$this->rol_id;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	//////   seleccionar cantones por provincia    ///////////////////
	public function rol_seleccionarpagina($inicio, $pagina){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select rol_id, rol_nombre FROM ct_roles ORDER BY rol_id LIMIT '.$inicio.','.$pagina;
			$rsprv = $bd->ejecutar($sql);
			$bd->cerrar();
			return $rsprv;
	}
	//////   seleccionar cantones por provincia    ///////////////////
	public function rol_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select rol_id, rol_nombre FROM ct_roles  ';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	/////////////////////////////    fin de provicnias      ///////////////////////
}
?>