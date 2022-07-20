<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/*PROCESO DE AUTENTIFICACION*/
/*Recibe las variables del formulario de login del index.php, busca en la base de datos
 (si existe) genera variables de sesión y redirige a la página principal del usuario 
 (si no existe) redirige al index y envia un error */
?>
<?php
if((isset($_COOKIE["usu_tinpc"]))||(isset($_POST["txtusu"])&&isset($_POST["txtcla"]))){ //SI SE RECIBIERON DATOS DEL FORMULARIO DE LOGIN
    session_start();
    /*if(isset($_COOKIE["usu_tinpc"])){
        $txtusu=$_COOKIE["usu_tinpc"];
        $txtcla=$_COOKIE["pass_tinpc"];
        $recordar=1;
    }else{*/
        $txtusu=$_POST["txtusu"];
        $txtcla=$_POST["txtcla"];
    //}
    require_once '../config/variables.php';
    require_once '../modelo/Db.class.php';
    require_once '../modelo/Config.class.php';
    require_once "../modelo/clsusuarios.php";
    require_once "../modelo/clstramiteusuario.php";
    require_once "../modelo/util.php";
    //require_once '../adm_include.php';
    $clsusu = new clsusuarios;
    $clsusu->setUsu_usuario($txtusu);
    $clave= $clsusu->usu_contrasena();
    //exit();
    $registros = mysqli_num_rows($clave); 
    if($registros > 0){
        $clave= mysqli_fetch_array($clave);
        if(password_verify($txtcla, $clave["usu_contrasena"])) {
            $rsusu = $clsusu->usu_ingreso();
            ////poner case con el sec dependiendo de la pagina
            $filausu = mysqli_fetch_array($rsusu);
            $_SESSION["codperfil"] = $filausu["rol_id"]; //CODIGO DEL ROL O PERFIL
            $_SESSION["perfil"] = $filausu["rol_nombre"]; //NOMBRE DEL PERFIL
            $_SESSION["codusuario"] = $filausu["usu_id"]; //CÓDIGO DEL USUARIO
            $_SESSION["nombre"] = $filausu["usu_nombre"]." ".$filausu["usu_apellido"]; //NOMBRE PERSONAL DEL USUARIO
            $_SESSION["usuario"]  = $txtusu; //NOMBRE DE LA CUENTA DE USUARIO
            $_SESSION["regional"] = $filausu["reg_id"]; //REGIONAL DEL USUARIO
            $_SESSION["alertas_usuario"]="on"; 
            $_SESSION["identificacion"]=$filausu["usu_identificador"];
            $_SESSION["certificado"]=$filausu["usu_certificado"];
            setcookie ("usu_tinpc", $txtusu, time() + 604800,"/");
            setcookie ("pass_tinpc", $txtcla, time() + 604800,"/");
            /*CONTEO BANDEJAS*/
            $index=1;
            require_once '../ajax/obtener_contadores_bandejas.php';
            //exit();
            /*$tramites_br = new clstramiteusuario();
            $estados=array("0","1","2","3","4","5");
            $tramites=$tramites_br->tra_contar_all_byusu($_SESSION["codusuario"],$estados[0],$_SESSION["codperfil"]);
            $t_elaboracion= mysqli_fetch_array($tramites);
            $tramites=$tramites_br->tra_contar_all_byusu($_SESSION["codusuario"],$estados[1],$_SESSION["codperfil"]);
            $t_validacion= mysqli_fetch_array($tramites);
            $tramites=$tramites_br->tra_contar_all_byusu($_SESSION["codusuario"],$estados[2],$_SESSION["codperfil"]);
            $t_analisis= mysqli_fetch_array($tramites);
            $tramites=$tramites_br->tra_contar_all_byusu_ve($_SESSION["codusuario"],array($estados[3],$estados[4]),$_SESSION["codperfil"]);
            $t_convalidacion= mysqli_fetch_array($tramites);
            $tramites=$tramites_br->tra_contar_all_byusu($_SESSION["codusuario"],$estados[5],$_SESSION["codperfil"]);
            $t_contestados= mysqli_fetch_array($tramites);
            $_SESSION["bandeja_elaboracion"]=$t_elaboracion["total"];
            $_SESSION["bandeja_validacion"]=$t_validacion["total"];
            $_SESSION["bandeja_analisis"]=$t_analisis["total"];
            $_SESSION["bandeja_convalidacion"]=$t_convalidacion["total"];
            $_SESSION["bandeja_contestados"]=$t_contestados["total"];*/           
            /*fin*/
            switch ($_SESSION["codperfil"]){
                case 1: //superadministrador
                    redireccionar("../ui_homeadmin.php");
                    break;
                case 5: // ejecutor
                    redireccionar("../ui_home.php");	   
                    break;
                case 3: // asignador	  
                    redireccionar("../ui_home.php");
                    break;
                case 4: // externo
                    redireccionar("../ue_home.php");	
                    break; 
                case 2: // aprobador
                    redireccionar("../ui_home.php");	
                    break; 
            }/// fin switch
        }
        else{
            session_destroy();
            redireccionar("../index.php?proc=ing&est=0");          
        }
    }else{
        session_destroy();
        redireccionar("../index.php?proc=ing&est=0");
    }
}else{
    session_destroy();
    redireccionar("../index.php?proc=ing&est=0");
}
?>

