<?php
	 
Class clsproyecto{	 
     private $pry_codigo;
	 private $pry_coorx;
	 private $pry_coory;
	 private $tfi_codigo;
	 private $tpr_codigo;
	 private $par_codigo;
	 private $pry_nombre;
	 private $pry_descripcion;
	 private $pry_monto_contrato_ejecucion;
	 private $pry_tiempo_anio;
	 private $pry_tiempo_mes;
	 private $pry_tiempo_dias;
	 private $pry_fecha_inicio;
	 private $pry_fecha_fin;
	 private $pry_direccion;
	 private $pry_regimen;
	 private $pry_ctr_ad_nombre;
	 private $pry_ctr_ad_correo;
	 private $pry_ctr_ad_direccion;
	 private $usu_codigo;
	 
  //////////////////////////////   funciones //////////////////////
	
	public function carga_pry_codigo($pry_codigo){
	    	    $this->pry_codigo=$pry_codigo;
	}
	public function carga_pry_coorx($pry_coorx){
	    	    $this->pry_coorx=$pry_coorx;
	}
	public function carga_pry_coory($pry_coory){
	    	    $this->pry_coory=$pry_coory;
	}
	public function carga_tfi_codigo($tfi_codigo){
	    	    $this->tfi_codigo=$tfi_codigo;
	}
	public function carga_tpr_codigo($tpr_codigo){
	    	    $this->tpr_codigo=$tpr_codigo;
	}
	public function carga_par_codigo($par_codigo){
	    	    $this->par_codigo=$par_codigo;
	}
	public function carga_pry_nombre($pry_nombre){
	    	    $this->pry_nombre=$pry_nombre;
	}
	public function carga_pry_descripcion($pry_descripcion){
	    	    $this->pry_descripcion=$pry_descripcion;
	}
	public function carga_pry_monto_contrato_ejecucion($pry_monto_contrato_ejecucion){
	    	    $this->pry_monto_contrato_ejecucion=$pry_monto_contrato_ejecucion;
	}
	public function carga_pry_tiempo_anio($pry_tiempo_anio){
	    	    $this->pry_tiempo_anio=$pry_tiempo_anio;
	}
	public function carga_pry_tiempo_mes($pry_tiempo_mes){
	    	    $this->pry_tiempo_mes=$pry_tiempo_mes;
	}
	public function carga_pry_tiempo_dias($pry_tiempo_dias){
	    	    $this->pry_tiempo_dias=$pry_tiempo_dias;
	}
	public function carga_pry_fecha_inicio($pry_fecha_inicio){
	    	    $this->pry_fecha_inicio=$pry_fecha_inicio;
	}
	public function carga_pry_fecha_fin($pry_fecha_fin){
	    	    $this->pry_fecha_fin=$pry_fecha_fin;
	}
	public function carga_pry_direccion($pry_direccion){
	    	    $this->pry_direccion=$pry_direccion;
	}
	public function carga_pry_regimen($pry_regimen){
	    	    $this->pry_regimen=$pry_regimen;
	}
	public function carga_pry_ctr_ad_nombre($pry_ctr_ad_nombre){
	    	    $this->pry_ctr_ad_nombre=$pry_ctr_ad_nombre;
	}
	public function carga_pry_ctr_ad_correo($pry_ctr_ad_correo){
	    	    $this->pry_ctr_ad_correo=$pry_ctr_ad_correo;
	}
	public function carga_pry_ctr_ad_telefono($pry_ctr_ad_telefono){
	    	    $this->pry_ctr_ad_telefono=$pry_ctr_ad_telefono;
	}
	public function carga_usu_codigo($usu_codigo){
	    	    $this->usu_codigo=$usu_codigo;
	}
	
	
		////////   insertar proyecto   //////////////////
	public function proyecto_insertar(){
	       	// abro conexión a bases de datos
			
			$bd=Db::getInstance();
			$this->carga_pry_codigo($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
			$bd->carga_valores($this->pry_codigo.",'".$this->pry_nombre."',".$this->pry_monto_contrato_ejecucion.",'".$this->pry_descripcion."',".$this->pry_tiempo_anio.",'".$this->pry_fecha_inicio."','".$this->pry_fecha_fin."',".$this->tpr_codigo.",".$this->tfi_codigo.",".$this->par_codigo.",'".$this->pry_direccion."','".$this->pry_regimen."','".$this->pry_coorx."','".$this->pry_coory."',".$this->usu_codigo.""); // valores a insertae
			$bd->carga_campos("pry_codigo,pry_nombre,pry_monto_contrato_ejecucion,pry_descripcion,pry_tiempo_anio,pry_fecha_inicio,pry_fecha_fin,tpr_codigo,tfi_codigo,par_codigo,pry_direccion,pry_regimen,pry_coorx,pry_coory,usu_codigo"); // campos a ser insertados
			if($bd->insertar("ct_proyecto")) // insertar
			  return $this->pry_codigo;  // exito
		     
			else 
			 //return 0;
			  // error
			$bd->cerrar();  // cerrar coneccion
			
		           
	}
	
	
	//////   actualizar cantones    ///////////////////
	public function proyecto_actualizar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="pry_codigo = $this->pry_codigo, men_codigo = $this->men_codigo, nac_codigo = $this->nac_codigo, pry_nombre = '$this->pry_nombre',pry_fecha_fin = '$this->pry_fecha_fin',pry_monto_contrato_ejecucion = '$this->pry_monto_contrato_ejecucion',pry_tiempo_anio = '$this->pry_tiempo_anio',pry_direccion = '$this->pry_direccion', pry_fecha_inicio_salida = '$this->pry_fecha_inicio_salida', sol_direccion_origen = '$this->sol_direccion_origen', pry_descripcion = '$this->pry_descripcion', sol_estado = $this->sol_estado,pry_regimen = $this->pry_regimen, tid_codigo= $this->tid_codigo, pry_nombre_transporta = '$this->pry_nombre_transporta', pry_fecha_fin_transporta = '$this->pry_fecha_fin_transporta'";
			$bd->carga_valores("pry_codigo = ".$this->pry_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_proyecto"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar cantones    ///////////////////
	public function proyecto_seleccionar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select pry_codigo,pry_nombre,pry_monto_contrato_ejecucion,pry_descripcion,pry_tiempo_anio,pry_fecha_inicio,pry_fecha_fin,tpr_codigo,tfi_codigo,par_codigo,pry_direccion,pry_regimen,pry_coorx,pry_coory,usu_codigo
			FROM ct_proyecto 
			WHERE pry_codigo = ".$this->pry_codigo;
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
		public function proyecto_seleccionarcert(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select ct_proyecto.pry_codigo,par_nombre,can_nombre,pro_nombre,ct_regional.reg_codigo, pry_nombre,pry_descripcion,pry_fecha_fin, pry_monto_contrato_ejecucion, pry_regimen,tfi_nombre,tpr_nombre,pry_tiempo_anio,pry_direccion, pry_fecha_fin,pry_fecha_inicio,pry_coorx,pry_coory 
			FROM ct_proyecto 
			inner join ct_parroquia on ct_proyecto.par_codigo=ct_parroquia.par_codigo 
			inner join ct_canton on ct_parroquia.can_codigo=ct_canton.can_codigo 
			inner join ct_provincia on ct_canton.pro_codigo=ct_provincia.pro_codigo 
			inner join ct_regional on ct_provincia.reg_codigo=ct_regional.reg_codigo 
			inner join ct_tipofinanciamiento on ct_proyecto.tfi_codigo=ct_tipofinanciamiento.tfi_codigo 
			inner join ct_tpoproyecto on ct_proyecto.tpr_codigo=ct_tpoproyecto.tpr_codigo 
			WHERE ct_proyecto.pry_codigo = ".$this->pry_codigo;
					
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	/////// ELIMINAR PAISES
	public function proyecto_eliminar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "DELETE FROM ct_proyecto WHERE pry_codigo = ".$this->pry_codigo;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function proyecto_inactivar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="pry_regimen = 0, pry_fecha_inicio = now()";
			$bd->carga_valores("pry_codigo = ".$this->pry_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_proyecto"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	
		public function proyecto_asignar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="sol_estado = 2";
			$bd->carga_valores("pry_codigo = ".$this->pry_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_proyecto"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	public function proyecto_certificar(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			
			$parametros ="sol_estado = 3";
			$bd->carga_valores("pry_codigo = ".$this->pry_codigo);
			$bd->carga_campos($parametros);
			if($bd->actualizar("ct_proyecto"))
			  return 1;
			else 
			  return 0;  
            $bd->cerrar();
	}
	
	//////   seleccionar cantones por provincia    ///////////////////
	public function proyecto_seleccionarpagina($inicio, $pagina){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select pry_codigo, pry_codigo, par_codigo, men_codigo, nac_codigo, pry_nombre, pry_fecha_fin, pry_monto_contrato_ejecucion, pry_tiempo_anio,pry_direccion, pry_fecha_inicio_salida,sol_direccion_origen,pry_descripcion,sol_estado,pry_regimen FROM ct_proyecto where pry_regimen = "1" ORDER BY pry_fecha_inicio DESC LIMIT '.$inicio.','.$pagina;
			$rsprv = $bd->ejecutar($sql);
			$bd->cerrar();
			return $rsprv;
	}
	//////   seleccionar cantones por provincia    ///////////////////
	public function proyecto_seleccionartodo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select * FROM ct_proyecto';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	public function proyecto_seleccionarpaginausu($inicio, $pagina){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select pry_codigo,pry_nombre,ct_provincia.pro_nombre,ct_canton.can_nombre,ct_parroquia.par_nombre, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, pry_fecha_inicio, now())) HORAS, pry_fecha_inicio 
FROM ct_proyecto inner join ct_parroquia on ct_proyecto.par_codigo = ct_parroquia.par_codigo
inner join ct_canton on ct_parroquia.can_codigo = ct_canton.can_codigo
inner join ct_provincia on ct_canton.pro_codigo = ct_provincia.pro_codigo
inner join ct_regional on ct_provincia.reg_codigo = ct_regional.reg_codigo
 where ct_proyecto.usu_codigo = '.$this->usu_codigo.' ORDER BY pry_codigo LIMIT '.$inicio.','.$pagina;
			$rsprv = $bd->ejecutar($sql);
			return $rsprv;
	}
	public function proyecto_seleccionarseg($pry){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select pry_codigo,pry_nombre,ct_provincia.pro_nombre,ct_canton.can_nombre,ct_parroquia.par_nombre, pry_fecha_inicio 
FROM ct_proyecto inner join ct_parroquia on ct_proyecto.par_codigo = ct_parroquia.par_codigo
inner join ct_canton on ct_parroquia.can_codigo = ct_canton.can_codigo
inner join ct_provincia on ct_canton.pro_codigo = ct_provincia.pro_codigo
inner join ct_regional on ct_provincia.reg_codigo = ct_regional.reg_codigo
 where ct_proyecto.pry_codigo = '.$this->pry_codigo.' ORDER BY pry_codigo ';
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			
			return $rsprv;
	}
	public function proyecto_seleccionarregional($reg_codigo){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select ct_proyecto.pry_codigo,pry_codigo, men_codigo,nac_codigo, pry_nombre,pry_descripcion,pry_fecha_fin,pry_monto_contrato_ejecucion, pry_fecha_inicio,pry_direccion,
			 pry_fecha_inicio_salida,sol_direccion_origen, sol_estado,pry_regimen,tur_dia,tur_hora , tec_codigo
			  FROM ct_proyecto 
			  inner join rg_turno on rg_turno.pry_codigo = ct_proyecto.pry_codigo
			  inner join rg_regional on rg_turno.reg_codigo = rg_regional.reg_codigo 
			  where ct_regional.reg_codigo = '.$reg_codigo.'
			order by pry_fecha_inicio DESC';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	
	public function proyecto_retornaregional(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select rg_regional.reg_codigo
			FROM ct_proyecto 
			inner join rg_parroquia on ct_proyecto.par_codigo = rg_parroquia.par_codigo
			inner join rg_canton on rg_parroquia.can_codigo = rg_canton.can_codigo
			inner join rg_provincia on rg_canton.pro_codigo = rg_provincia.pro_codigo
			inner join rg_regional on rg_provincia.reg_codigo = rg_regional.reg_codigo
			where pry_codigo = '.$this->pry_codigo;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function proyecto_seleccionartipofinanciamientopreinv($regional){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select ct_proyecto.pry_codigo,pry_nombre, pry_monto_contrato_ejecucion,pry_fecha_inicio,pry_fecha_fin,ct_provincia.pro_nombre,ct_canton.can_nombre,
(SELECT sum(SEG_AVA_FIS_ACUMULADO) as porcentaje FROM ct_seguimiento WHERE ct_seguimiento.PRY_CODIGO=ct_proyecto.pry_codigo) avafis,(SELECT sum(SEG_AVA_FIn_ACUMULADO) as financiero FROM ct_seguimiento WHERE ct_seguimiento.PRY_CODIGO=ct_proyecto.pry_codigo) avafin
			FROM ct_proyecto 
			inner join ct_tipofinanciamiento on ct_proyecto.tfi_codigo=ct_tipofinanciamiento.tfi_codigo 
			inner join ct_tpoproyecto on ct_proyecto.tpr_codigo=ct_tpoproyecto.tpr_codigo 
			inner join ct_parroquia on ct_proyecto.par_codigo = ct_parroquia.par_codigo 
			inner join ct_canton on ct_parroquia.can_codigo = ct_canton.can_codigo 
			inner join ct_provincia on ct_canton.pro_codigo = ct_provincia.pro_codigo 
			inner join ct_regional on ct_provincia.reg_codigo = ct_regional.reg_codigo 
			where ct_tipofinanciamiento.tfi_codigo=1 and ct_regional.reg_codigo = '.$regional;
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function proyecto_seleccionartipofinanciamientoinv($regional){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select ct_proyecto.pry_codigo,pry_nombre, pry_monto_contrato_ejecucion,pry_fecha_inicio,pry_fecha_fin,ct_provincia.pro_nombre,ct_canton.can_nombre ,
(SELECT sum(SEG_AVA_FIS_ACUMULADO) as porcentaje FROM ct_seguimiento WHERE ct_seguimiento.PRY_CODIGO=ct_proyecto.pry_codigo) avafis,(SELECT sum(SEG_AVA_FIn_ACUMULADO) as financiero FROM ct_seguimiento WHERE ct_seguimiento.PRY_CODIGO=ct_proyecto.pry_codigo) avafin
			FROM ct_proyecto 
			inner join ct_tipofinanciamiento on ct_proyecto.tfi_codigo=ct_tipofinanciamiento.tfi_codigo 
			inner join ct_tpoproyecto on ct_proyecto.tpr_codigo=ct_tpoproyecto.tpr_codigo 
			inner join ct_parroquia on ct_proyecto.par_codigo = ct_parroquia.par_codigo 
			inner join ct_canton on ct_parroquia.can_codigo = ct_canton.can_codigo 
			inner join ct_provincia on ct_canton.pro_codigo = ct_provincia.pro_codigo 
			inner join ct_regional on ct_provincia.reg_codigo = ct_regional.reg_codigo 
			where ct_tipofinanciamiento.tfi_codigo=2 and ct_regional.reg_codigo = '.$regional;
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function proyecto_seleccionartipofinanciamientopreinvc($canton){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select ct_proyecto.pry_codigo,pry_nombre, pry_monto_contrato_ejecucion,pry_fecha_inicio,pry_fecha_fin,ct_provincia.pro_nombre,ct_canton.can_nombre,
(SELECT sum(SEG_AVA_FIS_ACUMULADO) as porcentaje FROM ct_seguimiento WHERE ct_seguimiento.PRY_CODIGO=ct_proyecto.pry_codigo) avafis,(SELECT sum(SEG_AVA_FIn_ACUMULADO) as financiero FROM ct_seguimiento WHERE ct_seguimiento.PRY_CODIGO=ct_proyecto.pry_codigo) avafin
			FROM ct_proyecto 
			inner join ct_tipofinanciamiento on ct_proyecto.tfi_codigo=ct_tipofinanciamiento.tfi_codigo 
			inner join ct_tpoproyecto on ct_proyecto.tpr_codigo=ct_tpoproyecto.tpr_codigo 
			inner join ct_parroquia on ct_proyecto.par_codigo = ct_parroquia.par_codigo 
			inner join ct_canton on ct_parroquia.can_codigo = ct_canton.can_codigo 
			inner join ct_provincia on ct_canton.pro_codigo = ct_provincia.pro_codigo 
			where ct_tipofinanciamiento.tfi_codigo=1 and ct_canton.can_codigo ='.$canton;
						
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
	public function proyecto_seleccionartipofinanciamientoinvc($canton){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select ct_proyecto.pry_codigo,pry_nombre, pry_monto_contrato_ejecucion,pry_fecha_inicio,pry_fecha_fin,ct_provincia.pro_nombre,ct_canton.can_nombre,
(SELECT sum(SEG_AVA_FIS_ACUMULADO) as porcentaje FROM ct_seguimiento WHERE ct_seguimiento.PRY_CODIGO=ct_proyecto.pry_codigo) avafis,(SELECT sum(SEG_AVA_FIn_ACUMULADO) as financiero FROM ct_seguimiento WHERE ct_seguimiento.PRY_CODIGO=ct_proyecto.pry_codigo) avafin
			FROM ct_proyecto 
			inner join ct_tipofinanciamiento on ct_proyecto.tfi_codigo=ct_tipofinanciamiento.tfi_codigo 
			inner join ct_tpoproyecto on ct_proyecto.tpr_codigo=ct_tpoproyecto.tpr_codigo 
			inner join ct_parroquia on ct_proyecto.par_codigo = ct_parroquia.par_codigo 
			inner join ct_canton on ct_parroquia.can_codigo = ct_canton.can_codigo 
			inner join ct_provincia on ct_canton.pro_codigo = ct_provincia.pro_codigo 
			where ct_tipofinanciamiento.tfi_codigo=2 and ct_canton.can_codigo ='.$canton;
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
		public function proyecto_seleccionartecnico($tec_codigo){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select  ct_proyecto.pry_codigo,pry_codigo, men_codigo,nac_codigo, pry_nombre,pry_descripcion,pry_fecha_fin,pry_monto_contrato_ejecucion, pry_tiempo_anio,pry_direccion, pry_fecha_inicio_salida,sol_direccion_origen, sol_estado,pry_regimen,tur_dia, tur_hora
			FROM ct_proyecto 
			inner join rg_turno on ct_proyecto.pry_codigo = rg_turno.pry_codigo
			where ct_proyecto.sol_estado = 2 and 
			rg_turno.tec_codigo = '.$tec_codigo.'
			order by pry_fecha_inicio DESC';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	public function proyecto_seleccionartipoproyectopi(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'SELECT count(pry_codigo),tfi_codigo from ct_proyecto group by tfi_codigo';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	public function proyecto_seleccionartipoproyectoi(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select count(tfi_codigo) as inversion FROM ct_proyecto where tfi_codigo=2';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	public function proyecto_seleccionarultimo(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = 'select max(pry_codigo) ultimo FROM ct_proyecto';
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
		
	/////////////////////////////    fin de provicnias      ///////////////////////
}
?>