<?php
Class Conf{
  // private $_domain;
   private $_userdb;
   private $_passdb;
   private $_hostdb;
   private $_puertodb;
   private $_db;

   static $_instance;

   private function __construct(){

      $this->_userdb=USUARIO;
      $this->_passdb=CLAVE;
      $this->_hostdb=HOST;
      $this->_puertodb=PUERTO;
      $this->_db=BD;
   }

   private function __clone(){ }

   public static function getInstance(){
      if (!(self::$_instance instanceof self)){
         self::$_instance=new self();
      }
      return self::$_instance;
   }

   public function getUserDB(){
      $var=$this->_userdb;
      return $var;
   }

   public function getHostDB(){
      $var=$this->_hostdb;
      return $var;
   }

   public function getPassDB(){
      $var=$this->_passdb;
      return $var;
   }

   public function getDB(){
      $var=$this->_db;
      return $var;
   }
   
   function getPuertoDB() {
       return $this->_puertodb;
   }

}
?>