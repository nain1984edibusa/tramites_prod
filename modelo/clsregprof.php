<?php
	 
Class clsregprof{	 
     private $regp_codigo;
	 private $tra_codigo;
	 private $pai_codigo;
	 private $usu_codigo;
	 private $regp_fecha;
	 private $rpes_codigo;
	 private $regp_ciudad;
	 private $regp_cedula;
	 private $regp_nombre;
	 private $regp_acuerdo;
	
	 
  //////////////////////////////   funciones //////////////////////
	
	public function carga_regp_codigo($regp_codigo){
	    	    $this->regp_codigo=$regp_codigo;
	}
	public function carga_tra_codigo($tra_codigo){
	    	    $this->tra_codigo=$tra_codigo;
	}
	public function carga_pai_codigo($pai_codigo){
	    	    $this->pai_codigo=$pai_codigo;
	}
	public function carga_usu_codigo($usu_codigo){
	    	    $this->usu_codigo=$usu_codigo;
	}
	public function carga_regp_fecha($regp_fecha){
	    	    $this->regp_fecha=$regp_fecha;
	}
	public function carga_rpes_codigo($rpes_codigo){
	    	    $this->rpes_codigo=$rpes_codigo;
	}
	public function carga_regp_ciudad($regp_ciudad){
	    	    $this->regp_ciudad=$regp_ciudad;
	}
	public function carga_regp_cedula($regp_cedula){
	    	    $this->regp_cedula=$regp_cedula;
	}
	public function carga_regp_nombre($regp_nombre){
	    	    $this->regp_nombre=$regp_nombre;
	}
	public function carga_regp_acuerdo($regp_acuerdo){
	    	    $this->regp_acuerdo=$regp_acuerdo;
	}
	
	
	
		////////   insertar regprof   //////////////////
	public function regprof_insertar(){
	       	// abro conexión a bases de datos
			
			$bd=Db::getInstance();
			$this->carga_regp_codigo($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
			$bd->carga_valores($this->regp_codigo.",'".$this->regp_nombre."',now(),'".$this->regp_acuerdo."','".$this->regp_ciudad."',".$this->rpes_codigo.",".$this->regp_cedula.",'".$this->tra_codigo."','".$this->pai_codigo."'"); // valores a insertae
			$bd->carga_campos("regp_codigo,regp_nombre,regp_fecha,regp_acuerdo,regp_ciudad,rpes_codigo,regp_cedula,tra_codigo,pai_codigo"); // campos a ser insertados
			if($bd->insertar("ct_regprof")) // insertar
			  return $this->regp_codigo;  // exito
		     
			else 
			 //return 0;
			  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	//////   actualizar cantones    ///////////////////
	public function regprof_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="regp_codigo = $this->regp_codigo, regp_nombre = '$this->regp_nombre', regp_acuerdo = '$this->regp_acuerdo'";
			$bd->carga_valores("regp_codigo = ".$this->regp_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_regprof"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar cantones    ///////////////////
	public function regprof_seleccionar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select regp_codigo,regp_nombre,regp_acuerdo,regp_ciudad,rpes_codigo,regp_cedula,tra_codigo,pai_codigo
			FROM ct_regprof 
			WHERE regp_codigo = ".$this->regp_codigo;
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
		
	
	/////// ELIMINAR 
	public function regprof_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM ct_regprof WHERE regp_codigo = ".$this->regp_codigo;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function regprof_inactivar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="pry_regimen = 0, pry_fecha_inicio = now()";
			$bd->carga_valores("regp_codigo = ".$this->regp_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_regprof"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	
		public function regprof_asignar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="sol_estado = 2";
			$bd->carga_valores("regp_codigo = ".$this->regp_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_regprof"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	
	
	//////   seleccionar cantones por provincia    ///////////////////
	public function regprof_seleccionarpagina($inicio, $pagina){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select regp_codigo, regp_codigo, regp_cedula, regp_nombre, regp_acuerdo FROM ct_regprof where pry_regimen = "1" ORDER BY pry_fecha_inicio DESC LIMIT '.$inicio.','.$pagina;
			$rsprv = $bd->ejecutar($sql);
			$bd->cerrar();
			return $rsprv;
	}
	//////   seleccionar cantones por provincia    ///////////////////
	public function regprof_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select * FROM ct_regprof';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	public function regprof_seleccionarpaginausu($inicio, $pagina){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select regp_codigo,regp_nombre,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, regp_fecha, now())) HORAS, regp_fecha FROM ct_regprof ORDER BY regp_codigo LIMIT '.$inicio.','.$pagina;
			$rsprv = $bd->ejecutar($sql);
			return $rsprv;
	}
	public function regprof_seleccionarseg($pry){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select regp_codigo,regp_nombre,ct_provincia.pro_nombre,ct_canton.can_nombre,ct_parroquia.par_nombre, pry_fecha_inicio 
FROM ct_regprof inner join ct_parroquia on ct_regprof.regp_cedula = ct_parroquia.regp_cedula
inner join ct_canton on ct_parroquia.can_codigo = ct_canton.can_codigo
inner join ct_provincia on ct_canton.pro_codigo = ct_provincia.pro_codigo
inner join ct_regional on ct_provincia.reg_codigo = ct_regional.reg_codigo
 where ct_regprof.regp_codigo = '.$this->regp_codigo.' ORDER BY regp_codigo ';
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			
			return $rsprv;
	}
	public function regprof_seleccionarregional($reg_codigo){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select ct_regprof.regp_codigo,regp_codigo, men_codigo,nac_codigo, regp_nombre,regp_acuerdo,pry_fecha_fin,pry_monto_contrato_ejecucion, pry_fecha_inicio,pry_direccion,
			 pry_fecha_inicio_salida,sol_direccion_origen, sol_estado,pry_regimen,tur_dia,tur_hora , tec_codigo
			  FROM ct_regprof 
			  inner join rg_turno on rg_turno.regp_codigo = ct_regprof.regp_codigo
			  inner join rg_regional on rg_turno.reg_codigo = rg_regional.reg_codigo 
			  where ct_regional.reg_codigo = '.$reg_codigo.'
			order by pry_fecha_inicio DESC';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
	public function regprof_retornaregional(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select rg_regional.reg_codigo
			FROM ct_regprof 
			inner join rg_parroquia on ct_regprof.regp_cedula = rg_parroquia.regp_cedula
			inner join rg_canton on rg_parroquia.can_codigo = rg_canton.can_codigo
			inner join rg_provincia on rg_canton.pro_codigo = rg_provincia.pro_codigo
			inner join rg_regional on rg_provincia.reg_codigo = rg_regional.reg_codigo
			where regp_codigo = '.$this->regp_codigo;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function regprof_seleccionartipofinanciamientopreinv($regional){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select ct_regprof.regp_codigo,regp_nombre, pry_monto_contrato_ejecucion,pry_fecha_inicio,pry_fecha_fin,ct_provincia.pro_nombre,ct_canton.can_nombre,
(SELECT sum(SEG_AVA_FIS_ACUMULADO) as porcentaje FROM ct_seguimiento WHERE ct_seguimiento.regp_codigo=ct_regprof.regp_codigo) avafis
			FROM ct_regprof 
			inner join ct_tipofinanciamiento on ct_regprof.rpes_codigo=ct_tipofinanciamiento.rpes_codigo 
			inner join ct_tporegprof on ct_regprof.regp_ciudad=ct_tporegprof.regp_ciudad 
			inner join ct_parroquia on ct_regprof.regp_cedula = ct_parroquia.regp_cedula 
			inner join ct_canton on ct_parroquia.can_codigo = ct_canton.can_codigo 
			inner join ct_provincia on ct_canton.pro_codigo = ct_provincia.pro_codigo 
			inner join ct_regional on ct_provincia.reg_codigo = ct_regional.reg_codigo 
			where ct_tipofinanciamiento.rpes_codigo=1 and ct_regional.reg_codigo = '.$regional;
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function regprof_seleccionartipofinanciamientoinv($regional){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select ct_regprof.regp_codigo,regp_nombre, pry_monto_contrato_ejecucion,pry_fecha_inicio,pry_fecha_fin,ct_provincia.pro_nombre,ct_canton.can_nombre ,
(SELECT sum(SEG_AVA_FIS_ACUMULADO) as porcentaje FROM ct_seguimiento WHERE ct_seguimiento.regp_codigo=ct_regprof.regp_codigo) avafis
			FROM ct_regprof 
			inner join ct_tipofinanciamiento on ct_regprof.rpes_codigo=ct_tipofinanciamiento.rpes_codigo 
			inner join ct_tporegprof on ct_regprof.regp_ciudad=ct_tporegprof.regp_ciudad 
			inner join ct_parroquia on ct_regprof.regp_cedula = ct_parroquia.regp_cedula 
			inner join ct_canton on ct_parroquia.can_codigo = ct_canton.can_codigo 
			inner join ct_provincia on ct_canton.pro_codigo = ct_provincia.pro_codigo 
			inner join ct_regional on ct_provincia.reg_codigo = ct_regional.reg_codigo 
			where ct_tipofinanciamiento.rpes_codigo=2 and ct_regional.reg_codigo = '.$regional;
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
		public function regprof_seleccionartecnico($tec_codigo){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select  ct_regprof.regp_codigo,regp_codigo, men_codigo,nac_codigo, regp_nombre,regp_acuerdo,pry_fecha_fin,pry_monto_contrato_ejecucion, pry_tiempo_anio,pry_direccion, pry_fecha_inicio_salida,sol_direccion_origen, sol_estado,pry_regimen,tur_dia, tur_hora
			FROM ct_regprof 
			inner join rg_turno on ct_regprof.regp_codigo = rg_turno.regp_codigo
			where ct_regprof.sol_estado = 2 and 
			rg_turno.tec_codigo = '.$tec_codigo.'
			order by pry_fecha_inicio DESC';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function regprof_seleccionarultimo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select max(regp_codigo) ultimo FROM ct_regprof';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
		
	/////////////////////////////    fin de provicnias      ///////////////////////
}
?>