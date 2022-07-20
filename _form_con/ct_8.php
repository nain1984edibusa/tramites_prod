<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once("./modelo/clstramite8.php");
include_once("./modelo/clsturequisitos.php");
//OBTENER CAMPOS ESPECÍFICOS DEL TRÁMITE
$tramitee=new clstramite8();
$tramitee->setTu_codigo($tra_codigo);
$tespecifico=$tramitee->tra_seleccionar_bycodigo();
$tespecifico= mysqli_fetch_array($tespecifico);
//OBTENER REQUISITOS
$requisitose=new clsturequisitos();
$requisitose->setTu_id($tespecifico["tu_id"]);
$requisitose->setTra_id($tra_id);
$requisitos8=$requisitose->tur_seleccionar_byte();
?>
<div class="container-fluid">
    <div class="container-flat-form">
        <div class="title-flat-form title-flat-blue">Formulario de Convalidación</div>
        <form enctype="multipart/form-data" method="post" class="form-padding" action="controller/enviarconval_tramite.php" autocomplete="off">
            <input type="hidden" name="idtu" id="idtu" value="<?php echo $_GET["idtu"];?>">
            <input type="hidden" name="tra_codigo" id="tra_codigo" value="<?php echo $tra_codigo;?>">
            <input type="hidden" name="tra_id" id="tra_id" value="<?php echo $tra_id;?>">
                <div class="row">    
                    <div class="col-xs-12">
                        <p class="instrucciones_formularios_ct">Recuerde que los campos marcados con <span class="sp-requerido">*</span> son requeridos.</p>
                    </div>
                </div>
                <div class="row">
                <?php if($tespecifico["te_cumple"]=="INCORRECTO"): //SI EL FORMULARIO TIENE INFORMACIÓN INCORRECTA?>
                <div class="row"> 
                    <div class="container-fluid">
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <strong>Observaciones:</strong> <?php echo $tespecifico["te_observaciones"]?>						
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-gps-dot"></i> &nbsp; Ubicación del bien mueble y/o documental</legend>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 checkbox">
                    <div class="group-material">
                        <input id="ubicacion_domiciliaria" type="checkbox" name="remember" kl_vkbd_parsed="true">
                        <label for="ubicacion_domiciliaria">Corresponde a mi ubicación domiciliaria</label>
                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["codusuario"]; ?>"/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="provincia" name="provincia" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Cotopaxi" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione la provincia de ubicación del bien" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $tespecifico["pro_nombre"] ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Provincia <span class="sp-requerido">*</span></label>
                        <input type="hidden" name="id_provincia" id="id_provincia" value="<?php echo $tespecifico["te_provincia"]; ?>"/>
                        <input type="hidden" name="id_regional" id="id_regional" value="<?php echo $tespecifico["te_regional"];?>"/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="canton" name="canton" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Latacunga" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione el cantón de ubicación del bien" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $tespecifico["can_nombre"] ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Cantón <span class="sp-requerido">*</span></label>
                        <input type="hidden" name="id_canton" id="id_canton" value="<?php echo $tespecifico["te_canton"] ?>"/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="parroquia" name="parroquia" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Juan Montalvo" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione su parroquia de residencia" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $tespecifico["par_nombre"] ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Parroquia <span class="sp-requerido">*</span></label>
                        <input type="hidden" name="id_parroquia" id="id_parroquia" value="<?php echo $tespecifico["te_parroquia"] ?>"/>
                    </div>
                </div>                             
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="direccion" name="direccion" type="text" class="material-control tooltips-general" placeholder="Por ejemplo: Benalcázar 2340 y 9 de Octubre" required="" maxlength="100" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $tespecifico["te_direccion"] ?>"> <!--title="Escriba la dirección de su domicilio" -->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Dirección <span class="sp-requerido">*</span></label>
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="codigo_inventario" name="codigo_inventario" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: BI12583736333" maxlength="50" data-toggle="tooltip" data-placement="top" title="Ingrese el código del bien mueble" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $tespecifico["te_codigo_inventario"] ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Código de Inventario</label>
                    </div>
                </div> 
                <?php endif;?>
            </div>
            <div class="row">
                <?php while($requisito= mysqli_fetch_array($requisitos8)){
                    if($requisito["tur_cumple"]=="INCORRECTO"): //SI EL FORMULARIO TIENE INFORMACIÓN INCORRECTA?>  
                    <div class="col-xs-12 col-sm-6 col-md-6">    
                        <div class="container-fluid">
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <strong>Observaciones:</strong> <?php echo $requisito["tur_observaciones"]?>						
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="group-material">
                            <input name="<?php echo $requisito["req_slug"];?>" id="<?php echo $requisito["req_slug"];?>" type="file" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" required='' accept="application/pdf"> <!--title="Escribe el código correlativo del libro, solamente números"-->
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label><?php echo $requisito["req_nombre"];?> <span class="sp-requerido">*</span></label>
                        </div>
                        <input type="hidden" name="<?php echo $requisito["req_slug"]."_id";?>" value="<?php echo $requisito["tur_id"];?>"/>
                    </div>
                <?php endif;
                    } ?> 
            </div>
                <!--<div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input name="rcroquis" id="rcroquis" type="file" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" required='' accept="application/pdf">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Croquis de Ubicación <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input name="rfotos" id="rfotos" type="file" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" required='' accept="application/pdf"> 
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fotos del bien <span class="sp-requerido">*</span></label>
                    </div>
                </div>-->
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 checkbox">
                    <div class="group-material">
                        <input id="checkbox1" required="" type="checkbox" name="remember" kl_vkbd_parsed="true">
                        <label for="checkbox1">Acepto el presente <a href="#" data-toggle="modal" data-target="#ModalAcuerdoConfidencialidad">acuerdo de responsabilidad</a></label> 
                    </div>
                </div>            
            </div>
            <div class="row">
               <div class="col-xs-12">
                    <p class="text-center">
                        <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                        <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-arrow-right"></i> &nbsp;&nbsp; Enviar</button>
                        <!--<a href="ue_bandeja_enviados.php?proc=regtra&est=1" class="enlace_especial">Completado</a>-->
                    </p>
               </div>
            </div>
       </form>
    </div>
</div>
<?php include_once("./modal/acuerdo_conf.php"); ?>
<?php include_once("./includes/footer.php"); ?>