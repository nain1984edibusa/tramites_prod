<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
	//var_dump($_POST);
	//no superar el peso en MB establecido por el servicio web (unico archivo)
	if (isset($_SERVER["CONTENT_LENGTH"])) {
		$post_max_size = (int)ini_get('post_max_size');
		if ($_SERVER["CONTENT_LENGTH"] > ($post_max_size * 1024 * 1024)) {
			echo "<script>
				alert('Documento(s) exede(n) peso permitido para firmar, máximo hasta $post_max_size MB');
				window.history.go(-1);
			</script>";
		}
	}
        
        $mb = 1024;//representación MB
        
	//fclose($fpconfig);
	// Limite peso total para firmar	
        $sizeDocumento = 10485760;
	// Limite caracteres nombre documento
        $sizeNombreDocumento = 180;
	// Sistema
	//$sistema = "pruebas";
        $sistema = "inpcTramitesPre";
	//$x_api_key = "pruebas";
        $x_api_key = "inpctramites";
	// Cedula
        $cedula = $_SESSION["identificacion"];//DESACTIVAR
	//$cedula= "0603031568";
        // n Copias
	$copia = 1;
        //ruta del documento generado mediante respuesta 
	$data = file_get_contents($archivo_firmar);
	// Documento en Base64
	$base64 = base64_encode($data);
        // URL servicio REST
	$urlws = "https://impws.firmadigital.gob.ec/servicio/documentos";
        	
        $rutaArchivo = $archivo_firmar; 
	$nombre = pathinfo($rutaArchivo, PATHINFO_FILENAME);
	$extension= pathinfo($rutaArchivo, PATHINFO_EXTENSION);
	
	$nombre_documento = $nombre.".".$extension;
	$pre="&pre=true";
        $certificadoDigital = "&tipo_certificado=".$_SESSION["certificado"];
        //$estampado = "&llx=260&lly=91&estampado=QR&razon=firmaEC";
        if($_SESSION["codperfil"]==APROBADOR){
            $estampado = "&llx=130&lly=95&estampado=QR&razon=firmaEC";
        }else{
            $estampado = "&llx=390&lly=95&estampado=QR&razon=firmaEC";
        }


	$documento_base64 = $base64;

	//no superar el limite de caracteres establecido para el nombre del documento
	if(strlen($nombre_documento)>=$sizeNombreDocumento){
	echo "<script>
			alert('Nombre del documento es muy extenso y no debe exeder $sizeNombreDocumento caracteres'); 
			window.history.go(-1);
		</script>";
	}
	//no permitir caracteres especiales


	$pattern =  '/["!@#$%&\/()]/';
	if (preg_match($pattern, $nombre_documento)) {
		echo "<script>
                        alert('Nombre del documento contiene caracteres especiales no permitidos'); 
                        window.history.go(-1);
                </script>";

	}
	//repetir n veces documento
	$repeatBody = "";
	for($i=0;$i<$copia;$i++) {
		$repeatBody = $repeatBody."{
			\"nombre\": \"".$i."-firmado-".$nombre_documento."\",
			\"documento\": \""."$documento_base64"."\"
		},";
	}
	$repeatBody = substr($repeatBody, 0 ,-1);
	// Body
	$body = "{
                \"cedula\": \"".$cedula."\",
                \"sistema\": \"".$sistema."\",
                \"documentos\":[".$repeatBody."]
        }";
// ------------------------------------------------------------------
	//no superar el peso en MB establecido por el servicio web (varios archivos)
	if(strlen($body)<=$sizeDocumento){
		$headers = array("Content-Type: application/json", "X-API-KEY: ".$x_api_key);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $urlws);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $body);                
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$token = curl_exec($curl);  //JWT Retornado por firmaEC                
		curl_close($curl);
	}else{
		$mb = 1024;
		$size_limit = ($sizeDocumento-3145728)/$mb/$mb;
		echo "<script>
			alert('Documento(s) exede(n) peso permitido para firmar, máximo hasta $size_limit MB'); 
			window.history.go(-1);
		</script>";
	}
// ------------------------------------------------------------------
?>


