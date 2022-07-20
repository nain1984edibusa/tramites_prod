<?php

Class clsespecialidad{	 
         //    definio los campos de la tabla 
     private $rpes_codigo;
	 private $rpes_nombre;
	 
	 
	 //////////////////////////////   funciones //////////////////////
	
	public function carga_rpes_codigo($rpes_codigo){
	    	    $this->rpes_codigo=$rpes_codigo;
	}
	
	public function carga_rpes_nombre($rpes_nombre){
	    	    $this->rpes_nombre=$rpes_nombre;
	}
	
	
	
		////////   insertar especialidad   //////////////////
	public function esp_insertar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$this->carga_rpes_codigo($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
			$bd->carga_valores($this->rpes_codigo.",'".$this->rpes_nombre."'"); // valores a insertae
			$bd->carga_campos("rpes_codigo,rpes_nombre"); // campos a ser insertados
			if($bd->insertar("ct_regprofespecialidad")) // insertar
			  return 1;  // exito
			else 
			  return 0;  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	//////   actualizar especialidad    ///////////////////
	public function esp_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="rpes_nombre = '$this->rpes_nombre'";
			$bd->carga_valores("rpes_codigo = ".$this->rpes_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_regprofespecialidad"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar especialidad    ///////////////////
	public function esp_seleccionar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select rpes_codigo, rpes_nombre FROM ct_regprofespecialidad WHERE rpes_codigo = ".$this->rpes_codigo;
			$rsprv = $bd->ejecutar($sql);
			$bd->cerrar();
			return $rsprv;
	}
	
	
	/////// ELIMINAR especialidad
	public function esp_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM ct_regprofespecialidad WHERE rpes_codigo = ".$this->rpes_codigo;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	//////   seleccionar especialidad por provincia    ///////////////////
	public function esp_seleccionarpagina($inicio, $pagina){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select rpes_codigo, rpes_nombre FROM ct_regprofespecialidad ORDER BY rpes_codigo LIMIT '.$inicio.','.$pagina;
			$rsprv = $bd->ejecutar($sql);
			$bd->cerrar();
			return $rsprv;
	}
	//////   seleccionar especialidad por provincia    ///////////////////
	public function esp_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select rpes_codigo, rpes_nombre FROM ct_regprofespecialidad  ';
			echo $sql;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	/////////////////////////////    fin de provicnias      ///////////////////////
}
?>