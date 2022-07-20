<?php

	 
Class clsparroquia{	 
    private $par_id;
    private $can_id;
    private $par_nombre;
		
    function getPar_id() {
        return $this->par_id;
    }

    function getCan_id() {
        return $this->can_id;
    }

    function getPar_nombre() {
        return $this->par_nombre;
    }

    function setPar_id($par_id) {
        $this->par_id = $par_id;
    }

    function setCan_id($can_id) {
        $this->can_id = $can_id;
    }

    function setPar_nombre($par_nombre) {
        $this->par_nombre = $par_nombre;
    }

            ////////   insertar cantones   //////////////////
    public function parroquia_insertar(){
            // abro conexión a bases de datos
            $bd=Db::getInstance();
            $this->carga_par_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
            $bd->carga_valores($this->par_id.",".$this->can_id.",'".$this->par_nombre."'"); // valores a insertae
            $bd->carga_campos("par_id,can_id,par_nombre,"); // campos a ser insertados
            if($bd->insertar("ct_parroquia")) // insertar
              return 1;  // exito
            else 
              return 0;  // error
            $bd->cerrar();  // cerrar coneccion


    }

    //mostrar parroquias pertenecientes a un cantón, conforme un criterio de búsqueda
    public function parroquia_seleccionar_bycriterio($criterio){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select par_id,par_nombre FROM ct_parroquia WHERE can_id='".$this->can_id."' and par_nombre like '%".$criterio."%'";
        //echo $sql;
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    //////   actualizar cantones    ///////////////////
    public function parroquia_actualizar(){
            // abro conexión a bases de datos
                    $bd=Db::getInstance();

                    $parametros ="can_id = $this->can_id, par_nombre = '$this->par_nombre'";
                    $bd->carga_valores("par_id = ".$this->par_id);
                    $bd->carga_campos($parametros);
                    if($bd->actualizar("ct_parroquia"))
                      return 1;
                    else 
                      return 0;  
        $bd->cerrar();
    }

    //////   seleccionar cantones    ///////////////////
    public function parroquia_seleccionar(){
            // abro conexión a bases de datos
                    $bd=Db::getInstance();
                    $sql = "select par_id,can_id,par_nombre FROM ct_parroquia WHERE par_id = ".$this->par_id;

                    $rsprv = $bd->ejecutar($sql);
                    //$bd->cerrar();
                    return $rsprv;
    }


    public function parroquia_seleccionarcanton(){
            // abro conexión a bases de datos
                    $bd=Db::getInstance();
                    $sql = "select par_id,can_id,par_nombre FROM ct_parroquia WHERE can_id = ".$this->can_id;

                    $rsprv = $bd->ejecutar($sql);
                    //$bd->cerrar();
                    return $rsprv;
    }

    public function parroquia_seleccionartodo(){
            // abro conexión a bases de datos
                    $bd=Db::getInstance();
                    $sql = "select par_id,can_id,par_nombre FROM ct_parroquia";
                    $rsprv = $bd->ejecutar($sql);
                    //$bd->cerrar();
                    return $rsprv;
    }


    /////// ELIMINAR PAISES
    public function parroquia_eliminar(){
            // abro conexión a bases de datos
                    $bd=Db::getInstance();
                    $sql = "DELETE FROM ct_parroquia WHERE par_id = ".$this->par_id;
                    $rsprv = $bd->ejecutar($sql);
                    //$bd->cerrar();
                    return $rsprv;
    }
	

}
?>