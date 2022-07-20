<?php
  $fullname = "DUQUE FLORES HOMERO FERNANDO";
  /* separar el nombre completo en espacios */
  $tokens = explode(' ', trim($full_name));
  echo $tokens;
  /* arreglo donde se guardan las "palabras" del nombre */
  $names = array();
  //$names = "DUQUE FLORES HOMERO FERNANDO";
  /* palabras de apellidos (y nombres) compuetos */
  $special_tokens = array('da', 'de', 'del', 'la', 'las', 'los', 'mac', 'mc', 'van', 'von', 'y', 'i', 'san', 'santa');
  
  $prev = "";
  foreach($tokens as $token) {
      $_token = strtolower($token);
	  echo $_token;
      if(in_array($_token, $special_tokens)) {
          $prev .= "$token ";
      } else {
          $names[] = $prev. $token;
          $prev = "";
      }
  }
  
  $num_nombres = count($names);
  $nombres = $apellidos = "";
  switch ($num_nombres) {
      case 0:
          $nombres = '';
          break;
      case 1: 
          $nombres = $names[0];
          break;
      case 2:
          $nombres    = $names[0];
          $apellidos  = $names[1];
          break;
      case 3:
          $apellidos = $names[0] . ' ' . $names[1];
          $nombres   = $names[2];
      default:
          $apellidos = $names[0] . ' '. $names[1];
          unset($names[0]);
          unset($names[1]);
          
          $nombres = implode(' ', $names);
          break;
  }
  
  $nombres    = mb_convert_case($nombres, MB_CASE_TITLE, 'UTF-8');
  $apellidos  = mb_convert_case($apellidos, MB_CASE_TITLE, 'UTF-8');
  
  echo $nombres;