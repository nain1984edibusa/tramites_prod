<?php

Class clsgenero{	 
         //    definio los campos de la tabla 
     private $gen_codigo;
	 private $gen_nombre;
	 private $gen_fechcreacion;
	 private $gen_fechcmodifica;
	 private $gen_usucreacion;   
	 private $gen_usumodificacion;
	 private $gen_nombreaplicacion;
	 
	 //////////////////////////////   funciones //////////////////////
	
	public function carga_gen_codigo($gen_codigo){
	    	    $this->gen_codigo=$gen_codigo;
	}
	
	public function carga_gen_nombre($gen_nombre){
	    	    $this->gen_nombre=$gen_nombre;
	}
	
	public function carga_gen_fechcreacion($gen_fechcreacion){
	    	    $this->gen_fechcreacion=$gen_fechcreacion;
	}
	
	public function carga_gen_fechmodifica($gen_fechmodifica){
	    	    $this->gen_fechmodifica=$gen_fechmodifica;
	}
	
	public function carga_gen_usucreacion($gen_usucreacion){
	    	    $this->gen_usucreacion=$gen_usucreacion;
	}
	
	public function carga_gen_usumodificacion($gen_usumodificacion){
	    	    $this->gen_usumodificacion=$gen_usumodificacion;
	}
	
	public function carga_gen_nombreaplicacion($gen_nombreaplicacion){
	    	    $this->gen_nombreaplicacion=$gen_nombreaplicacion;
	}
	
		////////   insertar género   //////////////////
	public function gen_insertar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$this->carga_gen_codigo($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
			$bd->carga_valores($this->gen_codigo.",'".$this->gen_nombre."'"); // valores a insertae
			$bd->carga_campos("gen_codigo,gen_nombre"); // campos a ser insertados
			if($bd->insertar("ct_genero")) // insertar
			  return 1;  // exito
			else 
			  return 0;  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	//////   actualizar género    ///////////////////
	public function gen_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="gen_nombre = '$this->gen_nombre'";
			$bd->carga_valores("gen_codigo = ".$this->gen_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_genero"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar género    ///////////////////
	public function gen_seleccionar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select gen_codigo, gen_nombre FROM ct_genero WHERE gen_codigo = ".$this->gen_codigo;
			$rsprv = $bd->ejecutar($sql);
			$bd->cerrar();
			return $rsprv;
	}
	
	
	/////// ELIMINAR género
	public function gen_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM ct_genero WHERE gen_codigo = ".$this->gen_codigo;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	//////   seleccionar género por provincia    ///////////////////
	public function gen_seleccionarpagina($inicio, $pagina){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select gen_codigo, gen_nombre FROM ct_genero ORDER BY gen_codigo LIMIT '.$inicio.','.$pagina;
			$rsprv = $bd->ejecutar($sql);
			$bd->cerrar();
			return $rsprv;
	}
	//////   seleccionar género por provincia    ///////////////////
	public function gen_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select gen_codigo, gen_nombre FROM ct_genero  ';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	/////////////////////////////    fin de provicnias      ///////////////////////
}
?>