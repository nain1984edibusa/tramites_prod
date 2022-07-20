<?php

	 
Class clspais{	 


     private $pai_codigo;
	 private $pai_nombre;
	
		
	 //////////////////////////////   funciones //////////////////////
	
	public function carga_pai_codigo($pai_codigo){
	    	    $this->pai_codigo=$pai_codigo;
	}

	public function carga_pai_nombre($pai_nombre){
	    	    $this->pai_nombre=$pai_nombre;
	}
	
	
	
		////////   insertar cantones   //////////////////
	public function pais_insertar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$this->carga_pai_codigo($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
			$bd->carga_valores($this->pai_codigo.",'".$this->pai_nombre."'"); // valores a insertae
			$bd->carga_campos("pai_codigo,pai_nombre,"); // campos a ser insertados
			if($bd->insertar("ct_pais")) // insertar
			  return 1;  // exito
			else 
			  return 0;  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	//////   actualizar cantones    ///////////////////
	public function pais_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="pai_nombre = '$this->pai_nombre'";
			$bd->carga_valores("pai_codigo = ".$this->pai_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_pais"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar cantones    ///////////////////
	public function pais_seleccionar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select pai_codigo,pai_nombre FROM ct_pais WHERE pai_codigo = ".$this->pai_codigo;
			
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function pais_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select pai_codigo,pai_nombre FROM ct_pais";
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
	/////// ELIMINAR PAISES
	public function pais_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM ct_pais WHERE pai_codigo = ".$this->pai_codigo;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	

}
?>