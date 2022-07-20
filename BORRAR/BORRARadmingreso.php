<?php session_start();?>
<?php require_once 'adm_include.php'?>
<?php
     /// recoger las variables del ingreso
	 $clsusu = new clsusuarios;
	 $clsusu->carga_usu_nombre($_POST["txtusu"]);
	 $clsusu->carga_usu_contrasena($_POST["txtcla"]); 
	 $rsusu = $clsusu->usu_ingreso();
	 $registros = mysql_num_rows($rsusu);
	 
	 
	 if($registros > 0){
		////poner case con el sec dependiendo de la pagina
		 
		 $filausu = mysql_fetch_array($rsusu);
		 $_SESSION["perfil"] = $filausu[2];
		 $_SESSION["codusuario"] = $filausu[0];
		 $_SESSION["usuario"]  = $_POST["txtusu"];
		 $_SESSION["solopanas"] = 100; 
		 
		 switch ($filausu[2]){
			 case 1: //administrador
			      redireccionar("admadmin.php");
				
				  break;
			 case 4: // usuario
			      redireccionar("admuserusuario.php");	   
				  break;
			 case 2: // tecinoc	  
			     redireccionar("admtecnico.php");
				 break;
			case 3: // direccion
			     redireccionar("admdirector.php");	
				 break; 
		 }/// fin switch
		  
	 }
	 else{
	     redireccionar("login.php?error=1"); 
		 echo $registros;
	 }
	 
?>