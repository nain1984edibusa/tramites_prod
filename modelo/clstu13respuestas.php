<?php

Class clstu13respuestas extends clstramiterespuestas{	 
    //campos de la tabla 
    private $marco_legal;
	 
    //////////////////////////////   funciones get y set //////////////////////
    function getMarco_legal() {
        return $this->marco_legal;
    }

    function setMarco_legal($marco_legal) {
        $this->marco_legal = $marco_legal;
    }

    public function tuc_insertar(){
        $bd=Db::getInstance();
        //$this->carga_rol_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        $bd->carga_valores("'".$this->getTuc_tipo_contestacion()."','".$this->getTuc_rutaarchivo()."','".$this->getMarco_legal()."','".$this->getTuc_cumple()."','".$this->getTuc_observaciones()."','".$this->getTu_id()."','".$this->getUsu_ejecutor()."'"); // valores a insertae
        $bd->carga_campos("tuc_tipocontestacion,tuc_rutaarchivo,tuc_marcolegal, tuc_cumple, tuc_observaciones,tu_id,usu_ejecutor"); // campos a ser insertados
        if($bd->insertar("_ct_tramite13_respuestas")) // insertar
          return $bd->lastID();  // exito
        else 
          return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }
    public function tuc_actualizar_respuesta($actualizador){
        $bd=Db::getInstance();
        if($actualizador=="aprobador"){
            $add=", usu_aprobador='".$this->getUsu_aprobador()."' ";
        }elseif($actualizador=="ejecutor"){
            $add=", usu_ejecutor='".$this->getUsu_ejecutor()."' ";
        }
        //$this->carga_rol_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        $sql= "update _ct_tramite13_respuestas set tuc_tipocontestacion='".$this->getTuc_tipo_contestacion()."',tuc_rutaarchivo='".$this->getTuc_rutaarchivo()."',tuc_marcolegal='".$this->getMarco_legal()."', tuc_cumple='".$this->getTuc_cumple()."'".$add." WHERE tuc_id='".$this->getTuc_id()."'";
        //echo $sql;
        //exit();
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }
    public function tuc_actualizar_respuesta_firma($actualizador){
        $bd=Db::getInstance();
        if($actualizador=="aprobador"){
            $add=", usu_aprobador='".$this->getUsu_aprobador()."' ";
        }elseif($actualizador=="ejecutor"){
            $add=", usu_ejecutor='".$this->getUsu_ejecutor()."' ";
        }
        //$this->carga_rol_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        $sql= "update _ct_tramite13_respuestas set tuc_rutaarchivo='".$this->getTuc_rutaarchivo()."'".$add." WHERE tu_id='".$this->getTu_id()."'";
        //echo $sql;
        //exit();
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }
}  
?>