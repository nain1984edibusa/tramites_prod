<?php

	 
Class clscanton{	 


         private $can_id;
	 private $pro_id;
	 private $can_nombre;
	
         function setPro_id($pro_id) {
             $this->pro_id = $pro_id;
         }

         		
	 //////////////////////////////   funciones //////////////////////
	
	public function carga_can_id($can_id){
	    	    $this->can_id=$can_id;
	}
	
	public function carga_pro_id($pro_id){
	    	    $this->pro_id=$pro_id;
	}

	public function carga_can_nombre($can_nombre){
	    	    $this->can_nombre=$can_nombre;
	}
	
	
	
		////////   insertar cantones   //////////////////
	public function canton_insertar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$this->carga_can_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
			$bd->carga_valores($this->can_id.",".$this->pro_id.",'".$this->can_nombre."'"); // valores a insertae
			$bd->carga_campos("can_id,pro_id,can_nombre,"); // campos a ser insertados
			if($bd->insertar("ct_canton")) // insertar
			  return 1;  // exito
			else 
			  return 0;  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	//////   actualizar cantones    ///////////////////
	public function canton_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="pro_id = $this->pro_id, can_nombre = '$this->can_nombre'";
			$bd->carga_valores("can_id = ".$this->can_id);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_canton"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar cantones    ///////////////////
	public function canton_seleccionar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select can_id,pro_id,can_nombre FROM ct_canton WHERE can_id = ".$this->can_id;
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
	public function canton_seleccionarprovincia(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select can_id,pro_id,can_nombre FROM ct_canton WHERE pro_id = ".$this->pro_id;
			
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
        
        //mostrar cantones pertenecientes a una provincia, conforme un criterio de búsqueda
        public function canton_seleccionar_bycriterio($criterio){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select can_id,can_nombre FROM ct_canton WHERE pro_id='".$this->pro_id."' and can_nombre like '%".$criterio."%'";
                        //echo $sql;
                        $rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function canton_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select can_id,pro_id,can_nombre FROM ct_canton";
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
	/////// eliminar cantones
	public function canton_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM ct_canton WHERE can_id = ".$this->can_id;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	

}
?>