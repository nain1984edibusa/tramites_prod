<?php

	 
Class clsambito{	 


        private $amb_id;
        private $amb_nombre;
        private $can_nombre;
	
         ////// funciones //////
         
         function getAmb_id() {
             return $this->amb_id;
         }

         function getAmb_nombre() {
             return $this->amb_nombre;
         }

         function getCan_nombre() {
             return $this->can_nombre;
         }

         function setAmb_id($amb_id) {
             $this->amb_id = $amb_id;
         }

         function setAmb_nombre($amb_nombre) {
             $this->amb_nombre = $amb_nombre;
         }

         function setCan_nombre($can_nombre) {
             $this->can_nombre = $can_nombre;
         }

         	
	//////   seleccionar cantones    ///////////////////
	public function ambito_seleccionar_byid(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select * FROM ct_ambito WHERE amb_id = ".$this->amb_id;
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
        
        public function ambito_seleccionar_all(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql = "select * FROM ct_ambito ORDER BY amb_id ASC";
			//echo $sql;
			$rsprv = $bd->ejecutar($sql);
			//$bd->cerrar();
			return $rsprv;
	}
	
}
?>