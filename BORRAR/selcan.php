<?php

/*Incluimos el fichero de la clase Db*/
require 'modelo/Db.class.php';
/*Incluimos el fichero de la clase Conf*/
require_once 'modelo/Config.class.php';
require_once "modelo/clscanton.php";

	$can = new clscanton;
	$can->carga_pro_codigo($_POST["elegido"]);
	$rscan = $can->canton_seleccionarprovincia();
	$html = '<option value="">Seleccione Canton</option>';
	while($row = mysql_fetch_row($rscan)){
	  $html = $html.'<option value="'. $row[0].'">'. $row[2].'</option>';
  } // fin while
  echo $html;	
?>