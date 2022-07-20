<?php

Class cl_tramites{	 
    //campos de la tabla 
    private $tra_id;
    private $tra_codigo;
    private $tra_nombre;
    private $tra_descripcion;
    private $tra_tiempo;   
    private $tra_reqform;
    private $tra_orden;
    private $tra_resultado;
    private $tra_ingreso;
    private $tra_respuesta;
  	private $tra_estado;
        

        	 
    //////////////////////////////   funciones get y set //////////////////////
	
    function setTra_id($tra_id) {
        $this->tra_id = $tra_id;
    }

    function setTra_codigo($tra_codigo) {
        $this->tra_codigo = $tra_codigo;
    }

    function setTra_nombre($tra_nombre) {
        $this->tra_nombre = $tra_nombre;
    }

    function setTra_descripcion($tra_descripcion) {
        $this->tra_descripcion = $tra_descripcion;
    }

    function setTra_tiempo($tra_tiempo) {
        $this->tra_tiempo = $tra_tiempo;
    }

    function setTra_reqform($tra_reqform) {
        $this->tra_reqform = $tra_reqform;
    }
    function setTra_orden($tra_orden) {
        $this->tra_orden = $tra_orden;
    }
    function setTra_resultado($tra_resultado) {
        $this->tra_resultado = $tra_resultado;
    }
    function setTra_ingreso($tra_ingreso) {
        $this->tra_ingreso = $tra_ingreso;
    }
    function setTra_respuesta($tra_respuesta) {
        $this->tra_respuesta = $tra_respuesta;
    }
	  function setTra_estado($tra_estado) {
        $this->tra_estado = $tra_estado;
    }
	
    ////////   insertar cantones   //////////////////
	public function tra_insertar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$this->setTra_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
			$bd->carga_valores($this->tra_id.",'".$this->tra_codigo."','".$this->tra_nombre."','".$this->tra_descripcion."','".$this->tra_tiempo."','".$this->tra_reqform."','".$this->tra_estado."', '".$this->tra_resultado."', '".$this->tra_orden."', '".$this->tra_ingreso."', '".$this->tra_respuesta."'"); // valores a insertae
			$bd->carga_campos("tra_id,tra_codigo,tra_nombre,tra_descripcion,tra_tiempo,tra_reqform,tra_estado, tra_resultado, tra_orden, tra_ingreso, tra_respuesta"); // campos a ser insertados
			if($bd->insertar("ct_tramites")) // insertar
			  return 1;  // exito
			else 
			  return 0;  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	
	//////   actualizar cantones    ///////////////////
	public function tra_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="tra_codigo = '$this->tra_codigo',tra_nombre = '$this->tra_nombre', tra_descripcion = '$this->tra_descripcion', tra_tiempo = '$this->tra_tiempo',tra_reqform = '$this->tra_reqform',tra_estado = '$this->tra_estado'";
			$bd->carga_valores("tra_id = ".$this->tra_id);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_tramites"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar todos los tramites    ///////////////////
	public function tra_seleccionar_all(){
	    // abro conexión a bases de datos
            $bd=Db::getInstance();
            $sql = "select * FROM ct_tramites ORDER BY tra_id ASC";
            $res = $bd->ejecutar($sql);
            $bd->cerrar();
            return $res;
	}
        
        //////   seleccionar tramite por id    ///////////////////
	public function tra_seleccionar_byid(){
	    // abro conexión a bases de datos
            $bd=Db::getInstance();
            $sql = "select * FROM ct_tramites where tra_id='".$this->tra_id."'";
            $res = $bd->ejecutar($sql);
            //$bd->cerrar();
            return $res;
	}
        //////   seleccionar ambito de ingreso y respuesta del tramite por id    ///////////////////
	public function tra_seleccionar_ambitobyid(){
	    // abro conexión a bases de datos
            $bd=Db::getInstance();
            $sql = "select tra_ingreso,tra_respuesta FROM ct_tramites where tra_id='".$this->tra_id."'";
            $res = $bd->ejecutar($sql);
            $bd->cerrar();
            return $res;
	}
	
	/////// ELIMINAR PAISES
	public function tra_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM ct_tramites WHERE tra_id = ".$this->tra_id;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	//////   seleccionar cantones por provincia    ///////////////////
	public function tra_seleccionarpagina($inicio, $pagina){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select * FROM ct_tramites ORDER BY tra_id LIMIT '.$inicio.','.$pagina;
			$rsprv = $bd->ejecutar($sql);
			$bd->cerrar();
			return $rsprv;
	}
	//////   seleccionar cantones por provincia    ///////////////////
	public function tra_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select tra_id, tra_nombre FROM ct_tramites ORDER BY tra_orden ASC ';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	/////////////////////////////    fin de provicnias      ///////////////////////*/
}
?>