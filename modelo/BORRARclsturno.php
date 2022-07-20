<?php


	 
Class clsturno{	 
        private $tur_codigo;
	 private $tra_codigo;
	 private $tur_dia;
	 private $tur_hora;
	 
		
	 //////////////////////////////   funciones //////////////////////
	
	public function carga_tur_codigo($tur_codigo){
	    	    $this->tur_codigo=$tur_codigo;
	}
	
	public function carga_tra_codigo($tra_codigo){
	    	    $this->tra_codigo=$tra_codigo;
	}

	
	public function carga_tur_dia($tur_dia){
	    	    $this->tur_dia=$tur_dia;
	}
	
	public function carga_tur_hora($tur_hora){
	    	    $this->tur_hora=$tur_hora;
	}
	
			////////   insertar cantones   //////////////////
	public function turno_insertar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$this->carga_tur_codigo($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
			$bd->carga_valores($this->tur_codigo.",".$this->tra_codigo.",'".$this->tur_dia."','".$this->tur_hora."'"); // valores a insertae
			$bd->carga_campos("tur_codigo,tra_codigo,tur_dia,tur_hora"); // campos a ser insertados
			if($bd->insertar("ct_turno")) // insertar
			  return $this->tur_codigo;  // exito
			else 
			  return 0;  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	//////   actualizar cantones    ///////////////////
	public function turno_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="sol_codigo = $this->sol_codigo, tec_codigo = '$this->tec_codigo', tur_dia = '$this->tur_dia', tur_hora = '$this->tur_hora'";
			$bd->carga_valores("tur_codigo = ".$this->tur_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_turno"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	
	public function turno_actualizartecnico(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="tec_codigo = $this->tec_codigo";
			$bd->carga_valores("sol_codigo = ".$this->sol_codigo, " and reg_codigo = ".$this->reg_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_turno"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar cantones    ///////////////////
	public function turno_seleccionar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select tur_codigo,sol_codigo,tec_codigo, tur_dia, tur_hora FROM ct_turno WHERE tur_codigo = ".$this->tur_codigo;
			
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
	public function turno_seleccionarsolicitud(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select tur_codigo,sol_codigo,tec_codigo, tur_dia, tur_hora FROM ct_turno WHERE sol_codigo = ".$this->sol_codigo;
			
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
	public function turno_seleccionartecnicorep(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select tur_codigo,sol_codigo,ct_turno.tec_codigo, tur_dia, tur_hora, tec_nombre,tec_correo
			         FROM ct_turno 
					 INNER JOIN rg_tecnico on ct_turno.tec_codigo = rg_tecnico.tec_codigo
					 WHERE sol_codigo = ".$this->sol_codigo;
			
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function turno_seleccionartecnico(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select tur_codigo,sol_codigo,tec_codigo, tur_dia, tur_hora FROM ct_turno WHERE tec_codigo = ".$this->tec_codigo;
			
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function turno_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select tur_codigo,sol_codigo,tec_codigo, tur_dia, tur_hora FROM ct_turno";
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
	public function turno_verificarturno(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select tur_codigo,tra_codigo, tur_dia, tur_hora FROM ct_turno WHERE tur_dia = '".$this->tur_dia."' and tur_hora = '".$this->tur_hora."'";
			
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function turno_seleccionarultimo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select max(tur_codigo) ultimo FROM ct_turno";
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
	public function turno_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM ct_turno WHERE tur_codigo = ".$this->tur_codigo;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	

}
?>