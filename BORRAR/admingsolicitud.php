<?php require_once 'admsesion.php'?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml"><head>
	   
       <?php require_once 'adm_include.php'; // incluir las clases
    $slc = new clssolicitudes; // declaro un objeto de la clase de la pagina que gestiono
    ///   acciones sobre registros
	$acc = get("acc");
	 // recogemos la accion cero por defecto
	switch ($acc){ // evaluamos la accion
	    
	    case 1: // ingresar a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $slc->carga_ase_codigo($_POST["selpai"]);
			   $slc->carga_usu_codigo($_SESSION["codusuario"]);
			   $slc->carga_slc_descripcion($_POST["txtdes"]);
			   $slc->carga_slc_coorx($_POST["latitud"]);
			   $slc->carga_slc_coory($_POST["longitud"]);	
			   $slc->carga_slc_direccion($_POST["direccion"]);			   
			   $slc->slc_insertar(); // inserto registro
			   $rsult = $slc->slc_seleccionarultimo();
			   $ultsol = mysql_fetch_row($rsult);
			   $codsol = $ultsol[0];
			   $solfec = $ultsol[2];
			   $usucor = $ultsol[3];
			   ////////  recoger tipos asesoria
			   $asesoria = $_POST["selpro"];
			   for($i=0;$i<count($asesoria);$i++){
     				$slc->slc_insertaasesoria($asesoria[$i],$codsol);
			   }
			   
			   
			   ///////  recoger archivos
			    $archivo = $_FILES['adjunto']['tmp_name'];
				$arcorg = $_FILES['adjunto']['name'];
				$cantidad = count($archivo);
				//INVENTADO NOMBRE DE CARPETA
				$hora = date("His")+8; 
				$carpeta = date("Ymd");
				
				for ($n="0"; $n<$cantidad; $n++) {
					$archivo_codigo = $archivo[$n]; 
					$nombre_archivo = $carpeta."_".$hora."_".$arcorg[$n];
					$archivo_subir = "adjuntos/" . $nombre_archivo;
					
					if (move_uploaded_file($archivo_codigo, $archivo_subir)) {
					   $slc->slc_insertaadjunto($nombre_archivo,$codsol);
					} else {
					print("no subio ningun archivo adjunto.<br/>"); }
				}
				
				$header = 'From: ' . $mail . " \r\n";
				$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
				$header .= "Mime-Version: 1.0 \r\n";
				$header .= "Content-Type: text/plain";
				
				$mensaje = "Estimado Usuari@ Director,\n\rEl Usuario: " . $_SESSION["usuario"] . ", ha solicitado una nueva solicitud de Asistencia técnica.\n\rFavor revisar la bandeja de Solicitudes Ingresadas por el Usuario del sistema de Asesoría  en el siguiente link \n\rhttp://asesoriatecnicapatrimonial.inpc.gob.ec/\n\rCon sus respectivas credenciales\n\r";
				
				$mensaje .= "Mensaje enviado el " . date('d/m/Y', time());
				$para = $usucor;
				$asunto = 'Nueva solicitud de ASISTENCIA TÉCNICA PARA INTERVENCIÓN EN BIENES PATRIMONIALES';
				
				mail($para, $asunto, utf8_decode($mensaje), $header);
												
		     break;
		case 2: // modificamos a la base
		       // recogemos valores que vienen de formulario y cargamos a la clase
			   $reg = get("reg"); // recojo el registro seleccionado
			   $slc->carga_rol_codigo($reg); // cargo en la clase
			   $slc->carga_rol_nombre($_POST["txtnom"]);
			   $slc->rol_actualizar();
		     break;
		case 3: // eliminamos de la base
			   $reg = get("reg"); // recojo el registro seleccionado
			   $slc->carga_rol_codigo($reg); // cargo en la clase
			   $slc->rol_eliminar();		    
			 break;	 	  
	} // fin switch
	
?>
	   <title>Asesoramiento - administrador</title>
        
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<script src="js/jquery.min.js"></script>
		 <!-- Custom Theme files -->
         <link href="admestilos.css" rel="stylesheet" type="text/css" />
		<link href="css/style.css" rel='stylesheet' type='text/css' />
        <link href="grafico.css" rel="stylesheet" type="text/css" />
   		 <!-- Custom Theme files -->
         
		 <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
   		 
         <script type="text/javascript">
            function cargartipoase(valor) {
                 var arrayValores=new Array( 
				 
				 <?php 
				        $prov = new clstipoasesorias;
						$rsprov = $prov->tpa_seleccionartodoporcodigo();
						while($rowprov = mysql_fetch_row($rsprov)){
				 ?>
                     new Array(<?php echo $rowprov[0]?>,<?php echo $rowprov[1]?>,"<?php echo $rowprov[2]?>"), 
				 <?php }?>	 
                     new Array(1033,4,"opcion3-4") );
                 if(valor==0) {
                      // desactivamos el segundo select 
                     document.getElementById("selpro").disabled=true; 
                 }else{
                     // eliminamos todos los posibles valores que contenga el select2 
                     document.getElementById("selpro").options.length=0; 
                     // añadimos los nuevos valores al select2 
                     document.getElementById("selpro").options[0]=new Option("Seleccione un tipo de Asistencia Técnica Patrimonial", "");
                     for(i=0;i<arrayValores.length;i++) {
                         // unicamente añadimos las opciones que pertenecen al id seleccionado
                         // del primer select 
                         if(arrayValores[i][0]==valor) { 
                             document.getElementById("selpro").options[document.getElementById("selpro").options.length]=new Option(arrayValores[i][2], arrayValores[i][1]); 
                         } 
                     }
                      // habilitamos el segundo select 
                     document.getElementById("selpro").disabled=false;
                } 
            } 
			</script>
   
 <!--   mapas   -->
 <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDmwVufDwjEOtmTjQ4ed9iWS1Rl-wOU4Tc&sensor=false">
</script>
<script type="text/javascript">

// VARIABLES GLOBALES JAVASCRIPT
var geocoder;
var marker;
var latLng;
var latLng2;
var map;

// INICiALIZACION DE MAPA
function initialize() {
  geocoder = new google.maps.Geocoder();	
  latLng = new google.maps.LatLng(-0.19789298766293598 ,-78.49657416343689);
  map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom:15,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.HYBRID  });


// CREACION DEL MARCADOR  
    marker = new google.maps.Marker({
    position: latLng,
    title: 'Arrastra el marcador si quieres moverlo',
    map: map,
    draggable: true
  });
 
 

 
// Escucho el CLICK sobre el mama y si se produce actualizo la posicion del marcador 
     google.maps.event.addListener(map, 'click', function(event) {
     updateMarker(event.latLng);
   });
  
  // Inicializo los datos del marcador
  //    updateMarkerPosition(latLng);
     
      geocodePosition(latLng);
 
  // Permito los eventos drag/drop sobre el marcador
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Arrastrando...');
  });
 
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Arrastrando...');
    updateMarkerPosition(marker.getPosition());
  });
 
  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Arrastre finalizado');
    geocodePosition(marker.getPosition());
  });
  

 
}


// Permito la gesti¢n de los eventos DOM
google.maps.event.addDomListener(window, 'load', initialize);

// ESTA FUNCION OBTIENE LA DIRECCION A PARTIR DE LAS COORDENADAS POS
function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('No puedo encontrar esta direccion.');
    }
  });
}

// OBTIENE LA DIRECCION A PARTIR DEL LAT y LON DEL FORMULARIO
function codeLatLon() { 
      str= document.form_mapa.longitud.value+" , "+document.form_mapa.latitud.value;
      latLng2 = new google.maps.LatLng(document.form_mapa.latitud.value ,document.form_mapa.longitud.value);
      marker.setPosition(latLng2);
      map.setCenter(latLng2);
      geocodePosition (latLng2);
      // document.form_mapa.direccion.value = str+" OK";
}

// OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
function codeAddress() {
        var address = document.form_mapa.direccion.value;
          geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
             updateMarkerPosition(results[0].geometry.location);
             marker.setPosition(results[0].geometry.location);
             map.setCenter(results[0].geometry.location);
           } else {
            alert('ERROR : ' + status);
          }
        });
      }

// OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
function codeAddress2 (address) {
          
          geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
             updateMarkerPosition(results[0].geometry.location);
             marker.setPosition(results[0].geometry.location);
             map.setCenter(results[0].geometry.location);
             document.form_mapa.direccion.value = address;
           } else {
            alert('ERROR : ' + status);
          }
        });
      }

function updateMarkerStatus(str) {
  document.form_mapa.direccion.value = str;
}

// RECUPERO LOS DATOS LON LAT Y DIRECCION Y LOS PONGO EN EL FORMULARIO
function updateMarkerPosition (latLng) {
  document.form_mapa.longitud.value =latLng.lng();
  document.form_mapa.latitud.value = latLng.lat();
}

function updateMarkerAddress(str) {
  document.form_mapa.direccion.value = str;
}

// ACTUALIZO LA POSICION DEL MARCADOR
function updateMarker(location) {
        marker.setPosition(location);
        updateMarkerPosition(location);
        geocodePosition(location);
      }





</script>


  <style>
  #mapCanvas {
    width: 600px;
    height: 500px;
    float: center;
  }
 
  </style>
 <!--    fin mapas-->        
         
         <!-- webfonts -->
   		 <link href='http://fonts.googleapis.com/css?family=Raleway:200,400,300,600,500,900,700,100,800|Comfortaa:700' rel='stylesheet' type='text/css'>
   		 <link href='http://fonts.googleapis.com/css?family=Comfortaa:700,300,400' rel='stylesheet' type='text/css'>
   		  <!-- webfonts -->
	</head>
	<body>
     	<!-- container -->
		<div id="cabecera"><?php require_once ("cabecera.php");?></div>
					<!-- Products -->
					<div class="products">
						<div class="container">
                         <div class="error-page">
									<?php require_once 'menu2.php';?>
                                    
                                    <h3>Usuario:<?php echo $_SESSION["usuario"] ?></h3>
                                    <div>Ingreso de solicitudes</div><br />
                                   
                                                                        
                                    <!--   parte para contenidos-->
                                   <?php
								            switch ($acc){
											     case 0:
										?>		 
										 <div id="izquierda">
                                 <!--   ------------------------------------------------------------------------------------>
                                <form  method="post" enctype="multipart/form-data" action="?acc=1" name="form_mapa" >
                                 <br> Servicio requerido:</br>
                                 	  <div id="frmobjeto"><select class="form-control input-sm input-sm" id="selpai" name="selpai" onchange='cargartipoase(this.value);' autofocus required>
						                         <option value=""></option>
												<?php
												    $tca = new clsasesorias;
													$rstca = $tca->ase_seleccionartodo();
													while ($row = mysql_fetch_row($rstca)){
												?>
												 <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
												<?php }// fin while?>
						  					  </select></div>
                                              <div id="frmlabel">Seleccione el tipo de Asistencia Técnica Patrimonial: </div>
                                              <div id="frmobjeto"><select name="selpro[]" size="10" autofocus multiple="multiple" disabled class="form-control input-sm input-sm" id="selpro" onchange='cargarselpro(this.value);' required>
                                              <option value="" selected="selected"></option>
								  </select></div>
                                              <div id="cajon3" style="font-weight:bold"> Utilice la tecla CTRL y seleccione dos o más tipos de asistencia</div><br /> 
                       			  <div id="frmlabel">Descripción de Asistencia Técnica Patrimonial requerida: </div> 
                           		  <input class="form-control input-sm" type="text" id="txtdes" name="txtdes" size="5" placeholder="Descripción">  
                                             <div id="frmlabel"><img src='img/logoadjunto.png'>Adjuntar documento(s) de ayuda: (Tamaño máximo de 2MB)</div> 
                                             <input class="form-control input-sm" type="file" id="adjunto" name="adjunto[]" multiple="multiple" accept="application/pdf"/>
                                              <div id="cajon3" style="font-weight:bold"> Utilice la tecla CTRL para escoger dos o más archivos adjuntos</div><br /> 
                                              <div id="frmlabel">Dirección ubicación del Bien (escoja ubicación desde el Mapa)</div> 
                                       		  <input type="text" name="direccion" id="direccion" value="" class="form-control input-sm" readonly="readonly" /><br />
											  <div id="frmlabel">Latitud</div> 
                                       		  <input type="text" name="latitud" value="-0.19789298766293598" class="form-control input-sm" readonly="readonly"  />	 <br />
											  <div id="frmlabel">Longitud</div> 
                                       		  <input type="text" name="longitud" value="-78.49657416343689" class="form-control input-sm" readonly="readonly" />		 <br />
                                              <input type="submit" class="btn btn-primary" value="Enviar" >
                                  <input type="reset" class="btn btn-default" value="Limpiar">
        						

                                </form></div>
        									  
						          <div id="derecha" >
								  <div id="mapCanvas"></div>
								   </div>	
									
										<?php	 break;
											     case 1:
										?>
                                        <div id="sec_contedor">
          								<table width="460">
                                        <tr>
                                          <th colspan="2" align="center"><h3><strong class="alert-info">Estimado(a) Usuario(a):<?php echo $_SESSION["usuario"] ?></strong></h3></th>
                                        </tr>
                                        <tr>
                                          <th colspan="2" align="center"><strong class="alert-info">Confirmamos la recepción de su solicitud con fecha:<br /> <?php echo $solfec?></strong></th>
                                        </tr>
                                        <tr>
                                          <th colspan="2" align="center"><strong class="alert-info">Un técnico del INPC revisará y atenderá su solicitud</strong></th>
                                          </tr>
                                          <tr>
                                          <th colspan="2" align="center"><strong class="alert-info">Favor revisar el estado de su solicitud en la opción Consultar Solicitud</strong></th>
                                          </tr>
                                        </table>
              
           								</div> <!--fin sec_contedor-->
                                                  
											<?php break;
											
											}
								   ?>	
 
        					        <!-- fin contenidos-->
                                </div>
						
                            
					   </div>
						</div>			
				
					
					
				</div>	
		
		<!-- /container -->
	</body>
   
</html>

