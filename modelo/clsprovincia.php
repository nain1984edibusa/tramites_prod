<?php

	 
Class clsprovincia{	 


     private $pro_id;
	 private $reg_id;
	 private $pro_nombre;
	
		
	 //////////////////////////////   funciones //////////////////////
	
	public function carga_pro_id($pro_id){
	    	    $this->pro_id=$pro_id;
	}
	
	public function carga_reg_id($reg_id){
	    	    $this->reg_id=$reg_id;
	}

	public function carga_pro_nombre($pro_nombre){
	    	    $this->pro_nombre=$pro_nombre;
	}
	
	
	
		////////   insertar cantones   //////////////////
	public function provincia_insertar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$this->carga_pro_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
			$bd->carga_valores($this->pro_id.",".$this->reg_id.",'".$this->pro_nombre."'"); // valores a insertae
			$bd->carga_campos("pro_id,reg_id,pro_nombre,"); // campos a ser insertados
			if($bd->insertar("ct_provincia")) // insertar
			  return 1;  // exito
			else 
			  return 0;  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	//////   actualizar provincias    ///////////////////
	public function provincia_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="reg_id = $this->reg_id, pro_nombre = '$this->pro_nombre'";
			$bd->carga_valores("pro_id = ".$this->pro_id);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_provincia"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar provincias    ///////////////////
	public function provincia_seleccionar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select pro_id,reg_id,pro_nombre FROM ct_provincia WHERE pro_id = ".$this->pro_id;
			
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
        
        public function provincia_seleccionar_bycriterio($criterio){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select pro_id,reg_id,pro_nombre FROM ct_provincia WHERE pro_nombre like '%".$criterio."%'";
			
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
	public function provincia_seleccionarregion(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select pro_id,reg_id,pro_nombre FROM ct_provincia WHERE reg_id = ".$this->reg_id;
			
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function provincia_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select pro_id,reg_id,pro_nombre FROM ct_provincia";
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
	/////// ELIMINAR PAISES
	public function provincia_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM ct_provincia WHERE pro_id = ".$this->pro_id;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	

}
?>