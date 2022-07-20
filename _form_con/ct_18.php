<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once("./modelo/clstramite18.php");
include_once("./modelo/clstipoevento.php");
//include_once("./modelo/clsturequisitos.php");
//OBTENER CAMPOS ESPECÍFICOS DEL TRÁMITE
$tramitee=new clstramite18();
$tramitee->setTu_codigo($tra_codigo);
$tespecifico=$tramitee->tra_seleccionar_bycodigo();
$tespecifico= mysqli_fetch_array($tespecifico);

//Obtener el evento
$evento = new clstipoevento();
$eventos=$evento->tipoevento_seleccionartodo();
$evento->carga_tev_codigo($tespecifico["te_evento"]);
$evento=mysqli_fetch_array($evento->tipoevento_seleccionar());

//OBTENER REQUISITOS
/*$requisitose=new clsturequisitos();
$requisitose->setTu_id($tespecifico["tu_id"]);
$requisitose->setTra_id($tra_id);
$requisitos8=$requisitose->tur_seleccionar_byte();*/
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
                    <legend><i class="zmdi zmdi-info-outline"></i> &nbsp; Información General</legend>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <input id="institucion" name="institucion" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Instituto Nacional de Patrimonio Cultural" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribael nombre de la institucion" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $tespecifico["te_institucion"] ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Institución a la que pertenece<span class="sp-requerido">*</span></label>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Ámbitos <span class="sp-requerido">*</span></span>
                        <select name="eventos" id="eventos" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija un evento">
                            <?php while($amb= mysqli_fetch_array($eventos)){ ?>
                            <option <?php if($tespecifico["te_evento"]==$amb["tev_codigo"]): echo "selected";endif;?> value="<?php echo $amb["tev_codigo"] ?>"><?php echo $amb["tev_nombre"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <input name="tema" id="tema" required="" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Tema" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba el tema del evento" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $tespecifico["te_tema"] ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Tema del Evento<span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="aforo" name="aforo" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: 10 personas" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba el aforo" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $tespecifico["te_aforo"] ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Aforo del evento <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="duracion" name="duracion" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: 1 dia" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba la duracion del evento" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $tespecifico["te_duracion"] ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Duración del evento <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <input name="persona_acargo" id="persona_acargo" required="" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Persona a cargo" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba el nombre de la persona que se hara cargo del espacio" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $tespecifico["te_persona_acargo"] ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Nombre de la persona que se hara cargo del espacio<span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="fecha1" name="fecha1" type="text" class="tooltips-general material-control" placeholder=Escoja una fecha para su cita" step="1" max="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" data-toggle="tooltip" data-placement="top" value="<?php echo $tespecifico["te_fecha1"] ?>"> <!--title="Escribe el código correlativo del libro, solamente números"-->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de atencion <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                
                               
                
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="hora" name="hora" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: 1 dia" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba la duracion del evento" onKeyUp="this.value = this.value.toUpperCase();" value="<?php echo $tespecifico["te_hora"] ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Hora de atencion <span class="sp-requerido">*</span></label>
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