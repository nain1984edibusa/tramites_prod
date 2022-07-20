<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once("./modelo/clstramite12.php");
include_once("./modelo/clsturequisitos.php");
include_once("./modelo/clsambito.php");
//include_once("./modelo/clsturequisitos.php");
//OBTENER CAMPOS ESPECÍFICOS DEL TRÁMITE
$tramitee=new clstramite12();
$tramitee->setTu_codigo($tra_codigo);
$tespecifico=$tramitee->tra_seleccionar_bycodigo();
$tespecifico= mysqli_fetch_array($tespecifico);
//Obtener el ámbito
$ambito = new clsambito();
$ambitos=$ambito->ambito_seleccionar_all();
$ambito->setAmb_id($tespecifico["te_ambito"]);
$ambito=mysqli_fetch_array($ambito->ambito_seleccionar_byid());
//OBTENER REQUISITOS
$requisitose=new clsturequisitos();
$requisitose->setTu_id($tespecifico["tu_id"]);
$requisitose->setTra_id($tra_id);
$requisitos12=$requisitose->tur_seleccionar_byte();
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
                    <?php while($requisito= mysqli_fetch_array($requisitos12)){
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
                <div class="row">
                <?php if($tespecifico["te_cumple"]=="INCORRECTO"): //SI EL FORMULARIO TIENE INFORMACIÓN INCORRECTA?>
                <div class="col-xs-12 col-sm-12 col-md-12">
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
                    <legend><i class="zmdi zmdi-info-outline"></i> &nbsp; Información General</legend>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Ámbitos <span class="sp-requerido">*</span></span>
                        <select name="ambitos" id="ambitos" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija una ciudad">
                            <?php while($amb= mysqli_fetch_array($ambitos)){ ?>
                            <option <?php if($tespecifico["te_ambito"]==$amb["amb_id"]): echo "selected";endif;?> value="<?php echo $amb["amb_id"] ?>"><?php echo $amb["amb_nombre"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="cantidad_fichas" name="cantidad_fichas" type="number" class="tooltips-general material-control" placeholder="Por ejemplo: 120" maxlength="50" min="1" data-toggle="tooltip" data-placement="top" title="Ingrese la cantidad de fichas" required="" value="<?php echo $tespecifico["te_cantidad_fichas"] ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Cantidad de fichas <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <input id="persona_responsable" name="persona_responsable" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Luis Alberto Andrade Quezada" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione la provincia de ubicación del bien" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $tespecifico["te_persona_responsable"] ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Nombre de la persona responsable para ingresar la ficha inventario <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input name="fecha_ingreso" id="fecha_ingreso" required="" type="date" class="tooltips-general material-control" placeholder="Escoja una fecha para su cita" step="1" max="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" data-toggle="tooltip" data-placement="top" value="<?php echo $tespecifico["te_fecha_ingreso"] ?>"> <!--title="Escribe el código correlativo del libro, solamente números"-->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de ingreso de la ficha de inventario <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <input id="tecnico_responsable" name="tecnico_responsable" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Luis Alberto Andrade Quezada" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione la provincia de ubicación del bien" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $tespecifico["te_tecnico_responsable"] ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Nombre del técnico responsable del GAD para la revisión de la ficha de inventario <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input name="fecha_revision" id="fecha_revision" type="date" class="tooltips-general material-control" placeholder="Escoja una fecha para su cita" step="1" max="<?php echo date("Y-m-d"); ?>" value="<?php echo $tespecifico["te_fecha_revision"] ?>" required="" data-toggle="tooltip" data-placement="top" > <!--title="Escribe el código correlativo del libro, solamente números"-->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de revisión de la ficha de inventario <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <?php endif;?>
            </div>
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