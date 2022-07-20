<?php

/*Incluimos el fichero de la clase Db*/
require 'modelo/Db.class.php';
/*Incluimos el fichero de la clase Conf*/
require_once 'modelo/Config.class.php';
require_once "modelo/clsparroquia.php";

	$par = new clsparroquia;
	$par->carga_can_codigo($_POST["elegido"]);
	$rspar = $par->parroquia_seleccionarcanton();
	$html = '<option value="">Seleccione Parroquia</option>';
	while($row = mysql_fetch_row($rspar)){
	  $html = $html.'<option value="'. $row[0].'">'. $row[2].'</option>';
  } // fin while
  echo $html;	
?>