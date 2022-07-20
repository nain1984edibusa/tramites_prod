<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */

$modulo="Responder";
$opcion="Trámite Recibido";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./includes/functions.php");
/*incluir modelo(s)*/
include_once("./modelo/Config.class.php");
include_once("./modelo/Db.class.php");
include_once("./modelo/clstramites.php");
include_once("./modelo/clstuanexos.php");
//include_once("./modelo/clstramiteanexos.php");
include_once("./modelo/clstramiteusuario.php");
/*generar instancias*/
if((isset($_GET["idtu"])&&(!empty($_GET["idtu"])))){ //SI SE RECIBE EL ID DEL TRÁMITE, PROCEDE
    $tramiteusuario = new clstramiteusuario();
    $tramiteusuario->setTu_id($_GET["idtu"]);
    $ttramite = $tramiteusuario->tra_seleccionar_byid();
    $ttramite = mysqli_fetch_array($ttramite);
    $tra_id=$ttramite["tra_id"];
    $tra_codigo=$ttramite["tu_codigo"];
    include_once("./modelo/clstramite".$tra_id.".php");
    include_once("./modelo/clstramiterespuestas.php");
    switch ($tra_id){
        
        case "5": 
            $tramitee = new clstramite5();
            break;
        case "8": 
            $tramitee = new clstramite8();
            break;
        case "12": 
            $tramitee = new clstramite12();
            break;
        case "13": 
            $tramitee = new clstramite13();
            break;    
		    case "16": 
            $tramitee = new clstramite16();
            break;
		    case "18": 
            $tramitee = new clstramite18();
            break;
    }
    $tramitee->setTu_codigo($tra_codigo);
    $tespecifico=$tramitee->tra_seleccionar_bycodigo();
    $tespecifico= mysqli_fetch_array($tespecifico);
    $tra_id=$_GET["idt"];
    $tu_id=$tespecifico["tu_id"];
    /*$tramite = new cl_tramites();
    $tramite->setTra_id($_GET["idt"]);
    $ntramite = $tramite->tra_seleccionar_byid();
    $ntramite = mysqli_fetch_array($ntramite);*/
    /*$anexos =  new clstramiteanexos();
    $anexos->setTra_id($_GET["idt"]);
    $tanexos=$anexos->obtener_tramiteanexos();*/
    $anexos = new clstuanexos();
    $anexos->setTra_id($_GET["idt"]);
    $anexos->setTu_id($tu_id);
    $tanexos=$anexos->tua_seleccionar_byte();
    $respuestas= new clstramiterespuestas();
    $respuestas->setTra_id($tra_id);
    $respuestas->setTu_id($tu_id);
    $trespuestas=$respuestas->obtener_tramiterespuestas();
?>
<!--<div class="container-fluid descripcion-container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            <?php /*echo $ntramite["tra_descripcion"]?>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 lead">
            <ol class="breadcrumb">
                <li><a href="ui_bandeja_revision.php">Bandeja Trámites en Revisión</a></li>
                <li class="active"><?php echo $modulo?></li>
                <li class="active"><?php echo recortar_texto_bc($opcion);*/?></li>
            </ol>
        </div>
    </div>
</div>-->
<?php
$redireccion="";
switch ($_SESSION["codperfil"]){
    case ASIGNADOR: $redireccion="ui_bandeja_recibidos.php"; break;
    case EJECUTOR: $redireccion="ui_bandeja_revision.php"; break;
    case APROBADOR: $redireccion="ui_bandeja_revision.php"; break;
}
?>
<div class="container-fluid">
    <div class="row msuperior">
        <div class="col-xs-3">
            <a class="btn btn-info btnanchocompleto" href="<?php echo $redireccion?>"><i class="zmdi zmdi-arrow-left"></i> Regresar</a></li>
        </div>
        <?php switch($ttramite["tu_band_respuesta"]){
            case 0:?>
                <div class="col-xs-3">
                    <a href="#" class="btn btn-secondary btnanchocompleto btndesactivado"><i class="zmdi zmdi-border-color btn-desactivado" title="Acción no permitida"></i> Firmar y Contestar</a>
                </div>
            <?php break;
            case 1:
                if($_SESSION["codperfil"]==APROBADOR):?>
                <div class="col-xs-3">
                    <a href="#" data-toggle="modal" data-target="#ReasignarTramite" class='btn btn-secondary btnanchocompleto' onclick="reasignar_tramite('<?php echo $_SESSION["codperfil"] ?>','<?php echo $_GET["idtu"]?>','<?php echo $tra_codigo;?>','<?php echo $ttramite["reg_id"]?>','<?php echo $ttramite["tra_respuesta"]?>','<?php echo $tra_id;?>','2');"><i class="zmdi zmdi-border-color"></i> Firmar y Contestar</a>
                </div>
                <?php endif; 
                if($_SESSION["codperfil"]==EJECUTOR):?>
                    <?php if(($ttramite["tu_band_convanxres"]==1)){ ?>
                        <div class="col-xs-3">
                            <a href="#" class="btn btn-secondary btnanchocompleto btndesactivado"><i class="zmdi zmdi-border-color"></i> Firmar y Reasignar</a>
                        </div>
                    <?php }
                        if($ttramite["tu_band_convanxres"]==-1){?>
                        <div class="col-xs-3">
                            <a href="#" data-toggle="modal" data-target="#ReasignarTramite" class='btn btn-secondary btnanchocompleto' onclick="reasignar_tramite('<?php echo $_SESSION["codperfil"] ?>','<?php echo $_GET["idtu"]?>','<?php echo $tra_codigo;?>','<?php echo $ttramite["reg_id"]?>','<?php echo $ttramite["tra_respuesta"]?>','<?php echo $tra_id;?>','1');"><i class="zmdi zmdi-border-color"></i> Firmar y Reasignar</a>
                        </div>
                    <?php } 
                        ?>
                <?php endif?>
            <?php
            break;
        }
        ?>
    </div>
</div>
<div class="container-fluid">
    <?php include_once './includes/errores.php';?>
</div>
<?php include_once './includes/_visualizar_tramite.php'; ?>
<div class="container-fluid">
    <!--<div class="table-responsive">
        <table class="table">
            <tr class="info">
                <th>Identificación</th>
                <th>Nombre</th>
                <th colspan="2">Contacto</th>	
            </tr>
            <tr>
                <td><?php /*echo $ttramite["usu_identificador"]?></td>
                <td><?php echo $ttramite["usu_apellido"]." ".$ttramite["usu_nombre"]?></td>
                <td colspan="2"><?php echo $ttramite["usu_correo"]." / ".$ttramite["usu_telefono"]?></td>
            </tr>
            <tr class="info">
                <th style="width: 10%">CUT</th>
                <th style="width: 60%">Trámite</th>
                <th style="width: 15%">Fecha de Ingreso</th>
                <th style="width: 15%">Estado actual</th>	
            </tr>
            <tr>
                <td><a href="#" onclick="obtener_auditoria(<?php echo $_GET["idtu"] ?>)" data-toggle="modal" data-target="#AuditoriaTramite"><span class="small"><?php echo $ttramite["tu_codigo"] ?></span></a></td>
                <td><?php echo $ttramite["tra_nombre"] ?></td>
                <td><?php echo $ttramite["tu_fecha_ingreso"] ?></td>
                <td><span class="small"><?php echo $ttramite["et_nombre"] */?></span></td>
            </tr>
        </table>
    </div>-->
    <div class="container-flat-form formularios_ct">
        <div class="title-flat-form title-flat-blue">Generación de respuesta al trámite</div>
        <div class="col-xs-12">
            <legend><i class="zmdi zmdi-collection-item"></i> &nbsp; Anexos</legend>
        </div>
        <?php
        $numanexos=0;
        $numarequeridos=0;
        $totalanexos= mysqli_num_rows($tanexos);
        while($anexo= mysqli_fetch_array($tanexos)){
            if($anexo["anx_requerido"]=="SI"): $numarequeridos+=1; endif;
        ?>
        <form action="controller/registrar_anexo.php" method="post" class="form-padding" enctype="multipart/form-data">
            <?php if($anexo["tua_cumple"]=="INCORRECTO"):?>
            <div class="row">  
                <div class="col-xs-12 col-sm-12">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <strong>Observaciones:</strong> <?php echo $anexo["tua_observaciones"]?>						
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(($anexo["tua_cumple"]=="PENDIENTE")||($anexo["tua_cumple"]=="NO INGRESADO")||($anexo["tua_cumple"]=="INCORRECTO")):?>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <!--ANEXO ID , TU_ID, RUTA_ARCHIVO-->
                        <!--<input type="hidden" id="anexo_id" name="anexo_id" value="<?php //echo $anexo["anx_id"];?>" />-->
                        <input type="hidden" id="tra_codigo" name="tra_codigo" value="<?php echo $tra_codigo;?>"/>
                        <input type="hidden" id="tra_id" name="tra_id" value="<?php echo $_GET["idt"];?>" />
                        <input type="hidden" id="tua_id" name="tua_id" value="<?php echo $anexo["tua_id"];?>" />
                        <!---<input type="hidden" id="tu_id" name="tu_id" value="<?php //echo $tu_id;?>" />-->
                        <input type="hidden" id="tu_idg" name="tu_idg" value="<?php echo $_GET["idtu"];?>" />
                        <input name="anexo_file" id="anexo_file" type="file" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" <?php if($anexo["anx_requerido"]=="SI"):?> required=''<?php endif;?> accept="application/pdf"> <!--title="Escribe el código correlativo del libro, solamente números"-->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label><?php echo $anexo["anx_nombre"];?><?php if($anexo["anx_requerido"]=="SI"):?><span class="sp-requerido">*</span><?php endif; ?></label>
                    </div>
                    <div class="group-material">
                        <input name="anexo_codigo" id="anexo_codigo" type="text" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" placeholder="Código del anexo, ejemplo: INPCZ3-MCH-0987" required='' onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escribe el código correlativo del libro, solamente números"-->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Código/Identificador<span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <p><a href="<?php echo DIRDOWNLOAD.$anexo["anx_rutaformato"];?>" target="_blank">Descargar <strong>Formato</strong></a></p>
                        <?php if (($anexo["tu_id"]==$tu_id)&&($anexo["tua_rutaarchivo"]!=NULL)){
                            $numanexos+=1;
                            ?>
                        <p class="respuesta">
                            <a href="" onclick="VentanaCentrada('<?php echo DIRDOWNLOAD.$anexo["tua_rutaarchivo"]?>','Requisito','','1024','768','true'); return false;">
                                <i class="zmdi zmdi-download"></i> Visualizar/Descargar <strong><?php echo $anexo["anx_nombre"];?></strong></a><?php echo " ".$anexo["tua_codigoe"];?></p>
                        <?php }else{?>
                        <p class="respuesta"><i class="zmdi zmdi-download"></i> Ninguno cargado</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <p class="text-center">
                        <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                        <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-upload"></i> &nbsp;&nbsp; Subir Archivo</button>
                    </p>
                </div>
            </div>
            <?php endif;?>
        </form>
        <?php 
            if($anexo["tua_cumple"]=="CORRECTO"){?>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <?php if (($anexo["tu_id"]==$tu_id)&&($anexo["tua_rutaarchivo"]!=NULL)){
                            $numanexos+=1;
                            ?>
                        <p class="respuesta">
                            <a href="" onclick="VentanaCentrada('<?php echo DIRDOWNLOAD.$anexo["tua_rutaarchivo"]?>','Requisito','','1024','768','true'); return false;">
                                <i class="zmdi zmdi-download"></i> Visualizar/Descargar <strong><?php echo $anexo["anx_nombre"];?></strong></a><?php echo " ".$anexo["tua_codigoe"];?></p>
                        <?php }else{?>
                        <p class="respuesta"><i class="zmdi zmdi-download"></i> Ninguno cargado</p>
                        <?php } ?>
                    </div>
                </div>
            <?php }
        }
        ?>
        <div class="col-xs-12">
            <legend><i class="zmdi zmdi-border-color"></i> &nbsp; Respuesta</legend>
        </div>
        <form action="controller/registrar_respuesta.php" method="post" class="form-padding" method="post">
            <?php 
                $proceso="registrar";
                $tuc_id=0;
                $tipo_contestacion="";
                if(mysqli_num_rows($trespuestas)>0){ 
                    $trespuesta= mysqli_fetch_array($trespuestas);
                    $tipo_contestacion=$trespuesta["tuc_tipocontestacion"];
                    $proceso="editar";
                    $tuc_id=$trespuesta["tuc_id"];
                }
                ?>
            <?php if((mysqli_num_rows($trespuestas)==0)||(mysqli_num_rows($trespuestas)>0)&&($trespuesta["tuc_cumple"]=="INCORRECTO")||($trespuesta["tuc_cumple"]=="PENDIENTE")):?>
            <div class="row">
                <?php if((mysqli_num_rows($trespuestas)>0)&&($trespuesta["tuc_cumple"]=="INCORRECTO")){?>
                <div class="col-xs-12 col-sm-12">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <strong>Observaciones:</strong> <?php echo $trespuesta["tuc_observaciones"]?>						
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <?php } ?>
                <div class="col-xs-12 col-sm-6">
                    <div class="group-material">
                        <input type="hidden" id="proceso" name="proceso" value="<?php echo $proceso ?>"/>
                        <input type="hidden" id="tuc_id" name="tuc_id" value="<?php echo $tuc_id ?>"/>
                        <input type="hidden" id="tuc_id" name="tu_codigo" value="<?php echo $tra_codigo ?>"/>
                        <input type="hidden" id="tra_id" name="tra_id" value="<?php echo $_GET["idt"];?>" />
                        <input type="hidden" id="tu_id" name="tu_id" value="<?php echo $tu_id;?>" />
                        <input type="hidden" id="tu_idg" name="tu_idg" value="<?php echo $_GET["idtu"];?>" />
                        <span>Tipo de contestación <span class="sp-requerido">*</span></span>
                        <select id="tipo_contestacion" name="tipo_contestacion" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" required="">
                            <option value="" disabled="" selected="">Selecciona una opción</option>
                            <option <?php if($tipo_contestacion=="AFIRMATIVO"): echo "selected"; endif?>  value="AFIRMATIVO">AFIRMATIVO</option>
                            <option <?php if($tipo_contestacion=="NEGATIVO"): echo "selected"; endif?> value="NEGATIVO">NEGATIVO</option>
                            <!--<option <?php /*if($tipo_contestacion=="GLOBAL"): echo "selected"; endif*/?> value="GLOBAL">GLOBAL</option>-->
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <?php if($proceso=="editar"){?>
                        <p class="respuesta"><a href="" onclick="previsualizar_respuesta(<?php echo $_GET["idtu"]?>); return false;"><i class="zmdi zmdi-download"></i> Visualizar/Descargar <strong>Respuesta</strong></a></p>
                    <?php }else{?>
                        <p class="respuesta"><i class="zmdi zmdi-download"></i> Ninguno cargado</p>
                    <?php } ?>
                </div>
                <?php include_once '_form_res/rf_'.$tra_id.".php"; ?>
            </div>
            <div class="row">
                <div class="col-xs-12">
                     <p class="text-center">
                         <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                         <!--<button type="button" class="btn btn-primary"><i class="zmdi zmdi-arrow-right"></i> &nbsp;&nbsp; Guardar</button>-->
                         <?php if ($numanexos==$numarequeridos){?>
                            <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-arrow-right"></i> &nbsp;&nbsp; Guardar</button>
                         <?php }else{?>
                            <button type="button" class="btn btn-primary btndesactivado"><i class="zmdi zmdi-arrow-right"></i> &nbsp;&nbsp; Guardar</button>
                         <?php }?>
                     </p>
                </div>
            </div>
            <?php endif;?>
            <?php if((mysqli_num_rows($trespuestas)>0)&&($trespuesta["tuc_cumple"]=="CORRECTO")):?>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <?php if($proceso=="editar"){?>
                        <p class="respuesta"><a href="" onclick="previsualizar_respuesta(<?php echo $_GET["idtu"]?>); return false;"><i class="zmdi zmdi-download"></i> Visualizar/Descargar <strong>Respuesta</strong></a></p>
                    <?php }else{?>
                        <p class="respuesta"><i class="zmdi zmdi-download"></i> Ninguno cargado</p>
                    <?php } ?>
                </div>
            </div>
            <?php endif;?>
        </form>
    </div>
</div>
<?php 
include_once("./includes/footer.php"); 
include_once('./modal/auditoria.php');
include_once('./modal/reasignar_tramite.php'); 
}else{ //SI NO RECIBE EL ID DEL TRÁMITE, REDIRIGE AL CATÁLOGO DE TRÁMITES
    header("Location:".RUTA_BANDEJAS_UI);
}
?>
<script type="text/javascript" src="js/funciones_generales.js"></script>
<script type="text/javascript" src="js/funciones_generales.js"></script>
<script type="text/javascript" src="js/_ui_respuestas_tramites.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>

