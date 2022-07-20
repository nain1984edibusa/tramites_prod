<?php

	 
Class clsregional{	 


     private $reg_codigo;
	 private $reg_nombre;
	 private $reg_direccion;
	 private $reg_prov;
		
	 //////////////////////////////   funciones //////////////////////
	
	public function carga_reg_codigo($reg_codigo){
	    	    $this->reg_codigo=$reg_codigo;
	}

	public function carga_reg_nombre($reg_nombre){
	    	    $this->reg_nombre=$reg_nombre;
	}
	
	public function carga_reg_direccion($reg_direccion){
	    	    $this->reg_direccion=$reg_direccion;
	}
	public function carga_reg_prov($reg_prov){
	    	    $this->reg_prov=$reg_prov;
	}
	
	
	
		////////   insertar cantones   //////////////////
	public function regional_insertar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$this->carga_reg_codigo($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
			$bd->carga_valores($this->reg_codigo.",'".$this->reg_nombre."','".$this->reg_direccion."'"); // valores a insertae
			$bd->carga_campos("reg_codigo,reg_nombre,reg_direccion"); // campos a ser insertados
			if($bd->insertar("rg_regional")) // insertar
			  return 1;  // exito
			else 
			  return 0;  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	//////   actualizar cantones    ///////////////////
	public function regional_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="reg_nombre = '$this->reg_nombre',reg_direccion = '$this->reg_direccion'";
			$bd->carga_valores("reg_codigo = ".$this->reg_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("rg_regional"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar cantones    ///////////////////
	public function regional_seleccionar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select reg_codigo,reg_nombre,reg_direccion,reg_prov FROM rg_regional WHERE reg_codigo = ".$this->reg_codigo;
			
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function regional_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select reg_codigo,reg_nombre, reg_direccion,reg_prov,reg_ciudad FROM rg_regional";
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
	/////// ELIMINAR PAISES
	public function regional_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM rg_regional WHERE reg_codigo = ".$this->reg_codigo;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	

}
?>