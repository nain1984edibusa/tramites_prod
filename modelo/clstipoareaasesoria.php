<?php

	 
Class clstipoareaasesoria{	 


     private $aaset_codigo;
	 private $aaset_nombre;
	
		
	 //////////////////////////////   funciones //////////////////////
	
	public function carga_aaset_codigo($aaset_codigo){
	    	    $this->aaset_codigo=$aaset_codigo;
	}

	public function carga_aaset_nombre($aaset_nombre){
	    	    $this->aaset_nombre=$aaset_nombre;
	}
	
	
	
		////////   insertar tipoareaasesoria_   //////////////////
	public function tipoareaasesoria_insertar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$this->carga_aaset_codigo($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
			$bd->carga_valores($this->aaset_codigo.",'".$this->aaset_nombre."'"); // valores a insertae
			$bd->carga_campos("aaset_codigo,aaset_nombre,"); // campos a ser insertados
			if($bd->insertar("ct_areaasetec")) // insertar
			  return 1;  // exito
			else 
			  return 0;  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	//////   actualizar cantones    ///////////////////
	public function tipoareaasesoria_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="aaset_nombre = '$this->aaset_nombre'";
			$bd->carga_valores("aaset_codigo = ".$this->aaset_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_areaasetec"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar cantones    ///////////////////
	public function tipoareaasesoria_seleccionar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select * FROM ct_areaasetec WHERE aaset_codigo = ".$this->aaset_codigo;
			
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function tipoareaasesoria_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select * FROM ct_areaasetec";
			
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			//return $rsprv;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
	/////// ELIMINAR PAISES
	public function tipoareaasesoria_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM ct_areaasetec WHERE aaset_codigo = ".$this->aaset_codigo;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	

}
?>