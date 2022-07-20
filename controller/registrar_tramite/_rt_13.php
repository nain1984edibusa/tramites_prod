<?php
//CAMPOS ESPECÍFICOS DEL TRÁMITE 13
require_once '../modelo/clstramite13.php';
require_once '../modelo/clstramiterequisitos.php';
require_once '../modelo/clsturequisitos.php';
require_once '../modelo/clstramiteanexos.php';
require_once '../modelo/clstuanexos.php';


//Requisitos específicos del trámite
$te_provincia_bi = $_POST["id_provincia"];
$te_canton_bi=$_POST["id_canton"];
$te_parroquia_bi=$_POST["id_parroquia"];
$te_cod_inventario = $_POST["codigo_inventario"];
$te_cedula_propietario = $_POST["cedula_propietario"];
$te_nombres_propietario = $_POST["nombres_propietario"];
$te_email_propietario = $_POST["email_propietario"];
$te_telefono_propietario = $_POST["telefono_propietario"];
$te_cedula_beneficiario = $_POST["cedula_beneficiario"];
$te_nombres_beneficiario = $_POST["nombres_beneficiario"];
$te_email_beneficiario = $_POST["email_beneficiario"];
$te_telefono_beneficiario = $_POST["telefono_beneficiario"];
$te_regional=$_POST["id_regional"];
$te_direccion=$_POST["direccion"];
//$tur_cod_inventario_bi = $_POST["codigo_inventario"];
//CREANDO EL TRÁMITE
$objtTramite13 = new clstramite13();
$objtTramite13->setTu_codigo($clstramiteusuario->getTu_codigo());
$objtTramite13->setUsu_eid($clstramiteusuario->getUsu_eid());
$objtTramite13->setUsu_iid($clstramiteusuario->getUsu_iid());
$objtTramite13->setTra_id($clstramiteusuario->getTra_id());
$objtTramite13->setTu_fecha_ingreso($clstramiteusuario->getTu_fecha_ingreso());
$objtTramite13->setTu_fecha_aprocont($clstramiteusuario->getTu_fecha_aprocont());
$objtTramite13->setTu_fecha_contcont($clstramiteusuario->getTu_fecha_contcont());
/*ADD1/1*/
$objtTramite13->setTu_fecha_iniciocoa($fecha_ingreso);
$objtTramite13->setTu_fecha_concoa($fecha_control_coa);
/*add*/
$objtTramite13->setReg_id($clstramiteusuario->getReg_id());
$objtTramite13->setEt_id($clstramiteusuario->getEt_id());

$objtTramite13->setTe_codigo_inventario($_POST["codigo_inventario"]);
$objtTramite13->setTe_provincia($te_provincia_bi);
$objtTramite13->setTe_canton($te_canton_bi);
$objtTramite13->setTe_parroquia($te_parroquia_bi);
$objtTramite13->setTe_regional($te_regional);
$objtTramite13->setTe_direccion($te_direccion);


//Datos de Propietario
$objtTramite13->setTe_dueno_cedula($te_cedula_propietario);
$objtTramite13->setTe_dueno_nom($te_nombres_propietario);
$objtTramite13->setTe_dueno_email($te_email_propietario);
$objtTramite13->setTe_dueno_telf($te_telefono_propietario);
//Datos Beneficiario 
$objtTramite13->setTe_benef_cedula($te_cedula_beneficiario);
$objtTramite13->setTe_benef_nom($te_nombres_beneficiario);
$objtTramite13->setTe_benef_email($te_email_beneficiario);
$objtTramite13->setTe_benef_telf($te_telefono_beneficiario);

//$objtTramite13->setTe_provincia($tur_provincia_bi);
//$objtTramite13->setTe_canton($tur_canton_bi);
//$objtTramite13->setTe_parroquia($tur_parroquia_bi);

$tu13_id=$objtTramite13->tu_insertar();
//OBTENIENDO REQUISITOS
if($tu13_id !=0){
    $fileTmpPath_minuta = $_FILES['minuta']['tmp_name'];
    $fileName_minuta = $_FILES['minuta']['name'];
    
    $ruta_subirarchivo=RUTA_ARCHIVOSTRAMITES.$clstramiteusuario->getTu_codigo()."/";
    $minuta=subir_archivo($fileTmpPath_minuta, $fileName_minuta, $ruta_subirarchivo);

    if (isset($_FILES['minuta']) && $_FILES['minuta']['type']=='application/pdf'){

        $ruta_minuta = RUTA_ARCHIVOSTRAMITES.$minuta; //path del archivo
        //Codigo Jhoa Parametrizado
        $regreq = new clsturequisitos();
        $regreq->setTra_id($tramite);
        $regreq->setTur_rutaarchivo($ruta_subirarchivo.$minuta);
        $regreq->setTu_id($tu13_id);
        $regreq->setReq_id('3');
        if ($regreq->tur_insertar() == 1){
            /*REGISTRAR LOS ANEXOS BASE-VACIOS*/
            $anexos=new clstramiteanexos();
            $anexos->setTra_id($tramite);
            $nanexos=$anexos->obtener_tramiteanexos();
            $anexoe=new clstuanexos();
            while($ranexo=mysqli_fetch_array($nanexos)){
                //echo $tu8_id."ID<br/>";
                $anexoe->setTu_id($tu13_id);
                $anexoe->setTra_id($tramite);
                $anexoe->setTua_codigoe("");
                $anexoe->setTua_rutaarchivo("");
                $anexoe->setAnx_id($ranexo["anx_id"]);
                $anexoe->tua_insertar();
            }
            $band=1;
        }
            
        }else{
            //SI NO SE INSERTARON LOS ARCHIVOS PONER EL TRAMITE INACTIVO
            $band=0;
            $objtTramite13->setTu_estado("INACTIVO");
            $objtTramite13->tu_cambiar_estado();
        }


    }else{
            //SI NO SE INSERTARON LOS ARCHIVOS PONER EL TRAMITE INACTIVO
        //echo "No ingresa a validación de archivo ni registro de requisitos";
        $band=0;
        $objtTramite13->setTu_estado("INACTIVO");
        $objtTramite13->tu_cambiar_estado();
}
