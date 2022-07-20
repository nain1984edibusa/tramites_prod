<?php

Class clstramites{	 
         //    definio los campos de la tabla 
     private $tra_codigo;
	 private $tra_nombre;
	 private $tra_descripcion;
	 private $tra_link;
	 private $usu_codigo;
	 private $req_codigo;
	
	 //////////////////////////////   funciones //////////////////////
	
	public function carga_tra_codigo($tra_codigo){
	    	    $this->tra_codigo=$tra_codigo;
	}
	
	public function carga_tra_nombre($tra_nombre){
	    	    $this->tra_nombre=$tra_nombre;
	}
	public function carga_tra_descripcion($tra_descripcion){
	    	    $this->tra_descripcion=$tra_descripcion;
	}
	public function carga_tra_link($tra_link){
	    	    $this->tra_link=$tra_link;
	}
	public function carga_usu_codigo($usu_codigo){
	    	    $this->usu_codigo=$usu_codigo;
	}
	
	public function carga_req_codigo($req_codigo){
	    	    $this->req_codigo=$req_codigo;
	}
	
		////////   insertar tramites   //////////////////
	public function tra_insertar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$this->carga_tra_codigo($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
			$bd->carga_valores($this->tra_codigo.",'".$this->tra_nombre."','".$this->tra_descripcion."','".$this->tra_link."','".$this->usu_codigo."','".$this->req_codigo."'"); // valores a insertae
			$bd->carga_campos("tra_codigo,tra_nombre,tra_descripcion,tra_link,usu_codigo,req_codigo"); // campos a ser insertados
			if($bd->insertar("ct_tramite")) // insertar
			  return 1;  // exito
			else 
			  return 0;  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	//////   actualizar tramites    ///////////////////
	public function tra_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="tra_nombre = '$this->tra_nombre',tra_descripcion='$this->tra_descripcion',tra_link='$this->tra_link',usu_codigo='$this->usu_codigo' ,req_codigo='$this->req_codigo'";
			$bd->carga_valores("tra_codigo = ".$this->tra_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_tramite"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar tramites    ///////////////////
	public function tra_seleccionar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select tra_codigo, tra_nombre,tra_descripcion,tra_link FROM ct_tramite WHERE tra_codigo = ".$this->tra_codigo;
			echo $sql;
			$rsprv = $bd->ejecutar($sql);
			$bd->cerrar();
			return $rsprv;
	}
	public function tra_seleccionarpagina($inicio, $pagina){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select tra_codigo, tra_nombre FROM ct_tramite ORDER BY tra_codigo LIMIT '.$inicio.','.$pagina;
			$rsprv = $bd->ejecutar($sql);
			$bd->cerrar();
			return $rsprv;
	}
	
	public function tra_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select tra_codigo, tra_nombre,tra_descripcion,tra_link FROM ct_tramite  ';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	/////// ELIMINAR PAISES
	public function tra_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM ct_tramite WHERE tra_codigo = ".$this->tra_codigo;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	}
?>