<?php

  function obtenerDatosW($cedula) {
       	$servicio = "https://www.bsg.gob.ec/sw/RC/BSGSW03_Consultar_Ciudadano?wsdl"; //url del servicio RC
        $servicio1 = "https://www.bsg.gob.ec/sw/STI/BSGSW08_Acceder_BSG?wsdl";  //url del servicio BSG
        $par = array();
        $parametros1 = array(); //parametros de la llamada
        $parametros1["Cedula"] = "1713677901"; // cedula de acceso
		$parametros1["Urlsw"] = "https://www.bsg.gob.ec/sw/RC/BSGSW03_Consultar_Ciudadano?wsdl";
        $parametros2["ValidarPermisoPeticion"] = $parametros1;
        $client1 = new SoapClient($servicio1, $par);
        $error = 0;
        try {
            $info1 = $client1->ValidarPermiso($parametros2);
        } catch (SoapFault $fault) {
            $error = 1;
            print(" 
            alert(' ERROR: " . $fault->faultcode . "-" . $fault->faultstring . ".'); 
            ");
        }
       
        $info2 = obj2array($info1);
        $result = $info2["return"];
		$digest = $result["Digest"];
        $nonce = $result["Nonce"];
        $fecha1 = $result["Fecha"];
        $fecha2 = $result["FechaF"];
		//print_r($result);
       // echo '------------------  RESPUESTA DE PETICION DE TOKEN   --------------------';
        //print_r($info2);
       
        $client = new SoapClient($servicio, $par);
        $ap_param = array();
        $ap_param['CodigoInstitucion'] = "3";
        $ap_param['CodigoAgencia'] = "156";
        $ap_param['NUI'] = $cedula;                               
        $ap_param['Usuario'] = "inpc1";
        $ap_param['Contrasenia'] = "NpYmX8%C";
        
        $ap_param2['BusquedaPorCedula'] = $ap_param;
        $ns = "http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd";
        $user = "1713677901";
        $xml2 = '<wss:Security xmlns:wss="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
        <wss:UsernameToken>
            <wss:Username>' . $user . '</wss:Username>
            <wss:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordDigest">' . $digest . '</wss:Password>
            <wss:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary">' . $nonce . '</wss:Nonce>
            <wsu:Created xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">' . $fecha1 . '</wsu:Created>
         </wss:UsernameToken>
       <wsu:Timestamp xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" wsu:Id="Timestamp-2">
       <wsu:Created>' . $fecha1 . '</wsu:Created>
       <wsu:Expires>' . $fecha2 . '</wsu:Expires>
      </wsu:Timestamp> 
      </wss:Security>';
        
        $headVar = new SoapVar($xml2, XSD_ANYXML);
        
        $headers = new SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd', 'Security', $headVar, true);
        
        
        $error = 0;
        try {
            $client->__setSoapHeaders($headers);
           // echo '</br>--------------- PETICION DEL CLIENTE ---------------- </br> ';
           // print_r($client);
           
            $info = $client->__call('BusquedaPorNui', $ap_param2);
            
        } catch (SoapFault $fault) {
            $error = 1;
          //   echo '</br>--------------- RESPUESTA DEL SERVICIO ---------------- </br> ';
           // print("alert(' ERROR: " . $fault->faultcode . "-" . $fault->faultstring . $fault->__toString() . ".');");
        }

        $res = obj2array($info);        
        //print_r($res);
		//echo $res[1];
       
	   return $res['return']['Nombre'];
        /*$arr=array('cedula'=>$res['Cedula'],'CondicionCedulado'=>$res['CondicionCedulado'],
                    'FechaNacimiento'=>$res['FechaNacimiento'],'Genero'=>$res['Genero'],
                    'LugarNacimiento'=>$res['LugarNacimiento']);
                    $objeto[]=$arr; 
					echo $objeto;      */ 
        
        
    }

     function obj2array($obj) {
        $out = array();
        foreach ($obj as $key => $val) {
            switch (true) {
                case is_object($val):
                    $out[$key] = obj2array($val);
                    break;
                case is_array($val):
                    $out[$key] = obj2array($val);
                    break;
                default:
                    $out[$key] = $val;
            }
        }
        return $out;
    }
   
   //echo obtenerDatosW("1712531886");
    ?>