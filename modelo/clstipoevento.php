<?php

	 
Class clstipoevento{	 


     private $tev_codigo;
	 private $tev_nombre;
	
		
	 //////////////////////////////   funciones //////////////////////
	
	public function carga_tev_codigo($tev_codigo){
	    	    $this->tev_codigo=$tev_codigo;
	}

	public function carga_tev_nombre($tev_nombre){
	    	    $this->tev_nombre=$tev_nombre;
	}
	
	
	
		////////   insertar tipoevento_   //////////////////
	public function tipoevento_insertar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$this->carga_tev_codigo($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
			$bd->carga_valores($this->tev_codigo.",'".$this->tev_nombre."'"); // valores a insertae
			$bd->carga_campos("tev_codigo,tev_nombre,"); // campos a ser insertados
			if($bd->insertar("ct_tpoevento")) // insertar
			  return 1;  // exito
			else 
			  return 0;  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	//////   actualizar cantones    ///////////////////
	public function tipoevento_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="tev_nombre = '$this->tev_nombre'";
			$bd->carga_valores("tev_codigo = ".$this->tev_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_tpoevento"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar cantones    ///////////////////
	public function tipoevento_seleccionar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select * FROM ct_tpoevento WHERE tev_codigo = ".$this->tev_codigo;
			
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function tipoevento_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select * FROM ct_tpoevento";
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
	/////// ELIMINAR PAISES
	public function tipoevento_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM ct_tpoevento WHERE tev_codigo = ".$this->tev_codigo;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	

}
?>