<?php
/* Clase encargada de gestionar las conexiones a la base de datos */
Class Db{

   private $servidor;
   private $puerto;
   private $usuario;
   private $password;
   private $base_datos;
   private $link;
   private $stmt;
   private $array;
   private $campos;
   private $valores;

   static $_instance;

   /*La función construct es privada para evitar que el objeto pueda ser creado mediante new*/
   private function __construct(){
      $this->setConexion();
      $this->conectar();
   }
   
   /*inicializar campos*/
   public function carga_campos($campos){
	   $this->campos = $campos;
   }
   
    /*inicializar valores*/
   public function carga_valores($valores){
	   $this->valores = $valores;
   }

   /*Método para establecer los parámetros de la conexión*/
   private function setConexion(){
      $conf = Conf::getInstance();
      $this->servidor=$conf->getHostDB();
      $this->puerto=$conf->getPuertoDB();
      $this->base_datos=$conf->getDB();
      $this->usuario=$conf->getUserDB();
      $this->password=$conf->getPassDB();
   }

   /*Evitamos el clonaje del objeto. Patrón Singleton*/
   private function __clone(){ }

   /*Función encargada de crear, si es necesario, el objeto. Esta es la función que debemos llamar desde fuera de la clase para instanciar el objeto, y así, poder utilizar sus métodos*/
   public static function getInstance(){
      if (!(self::$_instance instanceof self)){
         self::$_instance=new self();
      }
         return self::$_instance;
   }

   /*Realiza la conexión a la base de datos.*/
   private function conectar(){
      $this->link=mysqli_connect($this->servidor, $this->usuario, $this->password, $this->base_datos,$this->puerto);
//      @mysqli_query("SET NAMES 'utf8'");	
//      @mysqli_set_charset($this->link, "utf8");
   }

    /*cierra la conexión a la base de datos.*/
   public function cerrar(){
      mysqli_close($this->link);
     
   }
  
    // realiza nuevos registros en un tabla dada
   public function insertar($tabla){
	   $sql = "insert into ". $tabla . "(" .$this->campos . ") values (".$this->valores . " )";
	   //echo $sql;
	   if( mysqli_query($this->link,$sql)){
	     return 1;
	   }
	   else{
	     return 0;
	   }
   }
   
  // realiza ctualizaciones de registros en un tabla dada
    public function actualizar($tabla){
       $sql = "update ". $tabla . " set " . $this->campos . "  where ". $this->valores;
	//echo $sql;
        //exit();
	   if(mysqli_query($this->link,$sql)){
	     return 1;
	   }
	   else{
	     return 0;
	   }
	   
   }
   
   /*Método para ejecutar una sentencia sql*/
   public function ejecutar($sql){
       //echo $sql;
        $this->stmt=mysqli_query($this->link,$sql);
	return $this->stmt;
   }

   /*Método para obtener una fila de resultados de la sentencia sql*/
   public function obtener_fila($stmt,$fila){
      if ($fila==0){
         $this->array=mysqli_fetch_array($stmt);
      }else{
         mysqli_data_seek($stmt,$fila);
         $this->array=mysqli_fetch_array($stmt);
      }
      return $this->array;
   }

   //Devuelve el último id del insert introducido
   public function lastID(){
      return mysqli_insert_id($this->link);
   }
   
    //Devuelve el último id del insert introducido
   public function registros($stmt){
      return mysqli_num_rows($stmt);
   }
   
  
} 

?>
