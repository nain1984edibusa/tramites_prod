<?php
$full_name = "de la cuadra espinoza maria pilar del rocio";
//$nom = explode(",",$nombre);
//$apellido = explode(" ",$nom[0]);
//$nom = $nom[1];

 /* separar el nombre completo en espacios */
  $tokens = explode(' ', trim($full_name));
  /* arreglo donde se guardan las "palabras" del nombre */
  $names = array();
  /* palabras de apellidos (y nombres) compuetos */
  $special_tokens = array('da', 'de', 'del', 'la', 'las', 'los', 'mac', 'mc', 'van', 'von', 'y', 'i', 'san', 'santa');
  //print_r ($special_tokens);
  
  $prev = "";
  foreach($tokens as $token) {
      $_token = strtolower($token);
      if(in_array($_token, $special_tokens)) {
          $prev .= "$token ";
      } else {
          $names[] = $prev. $token;
          $prev = "";
      }
  }
$num_nombres = count($names); //cuenta numero de nombres
  //echo $num_nombres."<br>" ;
  $nombres = $apellidos = "";
  switch ($num_nombres) {
      case 0:
          $nombres = '';
		  echo $nombres."<br>";
          break;
      case 1: 
          $nombres = $names[0];
          break;
      case 2:
          $nombres    = $names[0];
          $apellidos  = $names[1];
          break;
      case 3:
          $nombres = $names[0] . ' ' . $names[1];
          $apellidos = $names[2];
      default:
          $nombres = $names[0] . ' ' . $names[1];
          unset($names[0]);
          unset($names[1]);

          $apellidos = implode(' ', $names);
           break;
	
  }
  
  $nombres    = mb_convert_case($nombres, MB_CASE_TITLE, 'UTF-8');
  $apellidos  = mb_convert_case($apellidos, MB_CASE_TITLE, 'UTF-8');
//echo $nom."<br>";
//echo $apellido[0]."<br>";
//echo $apellido[1]."<br>";
echo $nombres."<br>";
echo $apellidos."<br>";

?>