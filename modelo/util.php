<?php

/*Incluimos el fichero de la clase Db*/
//require_once 'Db.class.php';
/*Incluimos el fichero de la clase Conf*/
//require_once 'Config.class.php';

/*Creamos la instancia del objeto. Ya estamos conectados*/
//$bd=Db::getInstance();

 function limpiar_textos($string,$corte = null)
   {

        $caracters_no_permitidos = array("'","insert","update","drop","exec");
        # paso los caracteres entities tipo &aacute; $gt;etc a sus respectivos html
        $s = html_entity_decode($string,ENT_COMPAT,'UTF-8');
        # quito todas las etiquetas html y php
        $s = strip_tags($s);
        # en todos los espacios en blanco le añado un <br /> para después eliminarlo
        $s = preg_replace('/(?<!>)n/', "<br />n", $s);
        # elimino caracteres en blanco
        $s = preg_replace('/[ ]+/', ' ', $s);
        $s = preg_replace('/<!--[^-]*-->/', '', $s);
        # vuelvo a hacer el strip para quitar el <br /> que he añadido antes para eliminar las saltos de carro y nuevas lineas
        $s  = strip_tags($s);
        # elimino los caracters como comillas dobles y simples
        $s = str_replace($caracters_no_permitidos,"",$s);

       if (isset($corte) && (is_numeric($corte)))

        {
           $s = mb_substr($s,0,$corte, 'UTF-8');

        }

       return $s;

    }
	// funcion para login
	function per_autentificacion($usuario, $clave){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql="SELECT PER_NOMBRE, PER_APELLIDO, PER_IDENTIFICACION FROM PER_PERSONA WHERE PER_EMAIL = '$usuario' AND PER_CLAVE = '$clave'";
			$stmt=$bd->ejecutar($sql);
			$vale = 0;
			if($bd->registros($stmt)==1){
				$vale = 1;
			}
			//$bd->cerrar();
			return $vale;
	}
	
	
	// funcion para login admin
	function adm_login($usuario, $clave){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql="SELECT USU_USUARIO FROM SIT_USUARIO WHERE USU_CLAVE = '$clave' and USU_USUARIO = '$usuario'";
			$stmt=$bd->ejecutar($sql);
			$vale = 0;
			if($bd->registros($stmt)==1){
				$vale = 1;
			}
			//$bd->cerrar();
			return $vale;
	}
	
	// funcion para login
	function adm_inicio(){
	       	// abro conexión a bases de datos
			$bd=Db::getInstance();
			$sql="SELECT * FROM SIT_USUARIO WHERE USU_CODIGO = 1";
			
            $stmt=$bd->ejecutar($sql);
			//$bd->cerrar();
			return $stmt;
	}
	
	
	function GET($name=NULL, $value=false, $option="default")
{
    $option=false; // Old version depricated part
    $content=(!empty($_GET[$name]) ? trim($_GET[$name]) : (!empty($value) && !is_array($value) ? trim($value) : false));
    if(is_numeric($content))
        return preg_replace("@([^0-9])@Ui", "", $content);
    else if(is_bool($content))
        return ($content?true:false);
    else if(is_float($content))
        return preg_replace("@([^0-9\,\.\+\-])@Ui", "", $content);
    else if(is_string($content))
    {
        if(filter_var ($content, FILTER_VALIDATE_URL))
            return $content;
        else if(filter_var ($content, FILTER_VALIDATE_EMAIL))
            return $content;
        else if(filter_var ($content, FILTER_VALIDATE_IP))
            return $content;
        else if(filter_var ($content, FILTER_VALIDATE_FLOAT))
            return $content;
        else
            return preg_replace("@([^a-zA-Z0-9\+\-\_\*\@\$\!\;\.\?\#\:\=\%\/\ ]+)@Ui", "", $content);
    }
    else false;
}



       function redireccionar($pagina){
	   ?>
           <script type="text/javascript">

  window.location="<?php echo $pagina?>";
 //tiempo expresado en milisegundos
</script>
       <?php  }
		 
		 
	function decimal($numero){
		$dec = floatval(str_replace(",", ".", $numero));	
		return $dec;
    }	 
     	
		
		
		
	function sacarPrimeraPalabra($cadena){
		
		//explodeamos por los espacios
		$Ecadena=explode(' ',$cadena);
		
		//contamos cuantas palabras hay
		$Ccadena=count($Ecadena);
		
		
		//le restamos 1 ya que el array empieza de 0
		$CRcadena=$Ccadena-1; 
		
		//contamos los caracteres de la ultima palabra
		$Cletras=strlen($Ecadena[$CRcadena]);
		
		//contamos cuantos caracteres tiene la cadena completa
		$Cletras2=strlen($cadena);
		
		//restamos
		$CTotal=$Cletras2-$Cletras;
		
		//seteamos lo que queremos mostrar
		$cadena=substr($cadena,0,$CTotal);
		
		return trim($cadena);
	} 


	function sacarUltimaPalabra($cadena){
		
		//explodeamos por los espacios
		$Ecadena=explode(' ',$cadena);
		
		//contamos cuantas palabras hay
		$Ccadena=count($Ecadena);
		//le restamos 1 ya que el array empieza de 0
		$CRcadena=$Ccadena-1; 
		
		//contamos los caracteres de la ultima palabra
		$Cletras=strlen($Ecadena[$CRcadena]);
		
		//contamos cuantos caracteres tiene la cadena completa
		$Cletras2=strlen($cadena);
		
		//restamos
		$CTotal=$Cletras2-$Cletras;
		
		//seteamos lo que queremos mostrar
		$cadena=substr($cadena,-$Cletras);
		
		return trim($cadena);
	} 


    function calendario($mes,$anio,$tra){
	    
		$fecha = $anio."-".$mes."-01T00:00:00";
		$dia_semana = 1 + date('N', strtotime($fecha));  // identifica el dia de la semana + 1
		
		$month = $anio.'-'.$mes;
		$aux = date('Y-m-d', strtotime("{$month} + 1 month"));
		$dia_fin = date('d', strtotime("{$aux} - 1 day"));  // ultimo dia del mes
		
		
		$recorre = 1;
		$inicia_recorrido = 0;
		$salida = "";
		
		if ($dia_semana == 2)
		   $inicia_recorrido = 1;
		
		 while ($recorre <= $dia_fin){
		    $salida .= "<tr>";	
			for($i=1;$i<8;$i++){
				if($inicia_recorrido==0){			
				   if($i<$dia_semana){
					  $salida=$salida."<td></td>";
					  if($dia_semana-2==$i){
					    $inicia_recorrido=1;
					  }
				   }
				}// 
				else{// recorre dias del mes
				    if($recorre<=$dia_fin){
						if($i<6){
					       $salida=$salida."<td><a href='?&tra=$tra&m=$mes&a=$anio&d=$recorre'> $recorre</a></td>";
						}
						else{
						    $salida=$salida."<td>$recorre</td>";	
						}
					}
					else{
					     $salida=$salida."<td></td>";
					}
					$recorre++;
				}
			}// fin for
			$salida = $salida ."</tr>";
		}// fin while
		echo $salida;
	}
    
	
	
	function mes_letras($mes,$anio){
	     switch ($mes){
		     case '01':
			       echo "Enero ".$anio; break;
			 case '02':
			       echo "Febrero ".$anio; break; 
			 case '03':
			       echo "Marzo ".$anio; break;
		     case '04':
			       echo "Abril ".$anio; break;
			 case '05':
			       echo "Mayo ". $anio; break;
			 case '06':
			       echo "Junio ".$anio; break;
			 case '07':
			       echo "Julio ".$anio; break;
			 case '08':
			       echo "Agosto ".$anio; break;
			 case '09':
			       echo "Septiembre ". $anio;break;
		     case '10':
			       echo "Octubre ".$anio; break;
			 case '11':
			       echo "Noviembre ".$anio; break;
			 case '12':
			       echo "Diciembre ".$anio; break;
				   	   	 
		 }
	} 
	
	
	function obtenerFechaEnLetra($fecha){
		$dia= conocerDiaSemanaFecha($fecha);
		$num = date("j", strtotime($fecha));
		$anno = date("Y", strtotime($fecha));
		$mes = array('enero', 'Febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
		$mes = $mes[(date('m', strtotime($fecha))*1)-1];
		return $dia.', '.$num.' de '.$mes.' del '.$anno;
	}
	
	function conocerDiaSemanaFecha($fecha) {
		$dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
		$dia = $dias[date('w', strtotime($fecha))];
		return $dia;
	}
	
	function messiguiente($mes,$anio){
		if ($mes == 12)
		   return 1;
		else
		  return $mes + 1;   
		
	}
	function aniosiguiente($mes,$anio){
		if ($mes == 12)
		   return $anio+1;
		else
		  return $anio;   
		
	}
	
	function mesantes($mes,$anio){
		if ($mes == 1)
		   return 12;
		else
		  return $mes - 1;   
		
	}
	function anioantes($mes,$anio){
		if ($mes == 1)
		   return $anio-1;
		else
		  return $anio;   
		
	}
	 function asDollars($value) {
	 return '$' . number_format($value, 2);
  }
       
?>
<script language="JavaScript"> 
function confirmar(url){ /funcion para preguntar si desea elimnar registro/
	if (!confirm("¿Está seguro de que desea eliminar el registro?")) { 
	  return false; 
	} 
	else { 
		document.location= url; 
		return true; 
	} 
} 

function resetPasswdFromSuperadmin(email, idUsuario){ /funcion para preguntar si desea elimnar registro/
	if (!confirm("¿Desea restablecer el password del usuario?  " + email + " " + idUsuario)) { 
            
	  return false; 
	} 
	else {
            
	  return true; 
	} 
} 
</script>