<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
?>
<div class="container-fluid">
    <div class="container-flat-form">
        <div class="title-flat-form title-flat-blue">Formulario de Información</div>
        <form method="post" class="form-padding" action="controller/registrar_tramite.php">
            <input type="hidden" name="idt" id="idt" value="<?php echo $_GET["idt"];?>">
            <input type="hidden" name="estadot" id="estadot" value="<?php echo $estado_inicial;?>">
            <input type="hidden" name="duraciont" id="duraciont" value="<?php echo $tramite_tiempo;?>">
            <input type="hidden" name="iniciat" id="iniciat" value="<?php echo $inicia_tramite; ?>">
            <div class="row">
                <div class="col-xs-12">
                    <p class="instrucciones_formularios_ct">Recuerde que los campos marcados con <span class="sp-requerido">*</span> son requeridos.</p>
                </div>
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-view-dashboard"></i> &nbsp; Información de la Propiedad / Terreno</legend>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Provincia <span class="sp-requerido">*</span></span>
                        <select class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elija una provincia">
                            <option value="" disabled="" selected="">Selecciona una provincia</option>
                            <option value="categoria">Azuay</option>
                            <option value="categoria">Cañar</option>
                            <option value="categoria">....</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Cantón <span class="sp-requerido">*</span></span>
                        <select class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elija un Cantón">
                            <option value="" disabled="" selected="">Selecciona un Cantón</option>
                            <option value="categoria">Cuenca</option>
                            <option value="categoria">Gualaceo</option>
                            <option value="categoria">Paute</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Ciudad <span class="sp-requerido">*</span></span>
                        <select class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elija una ciudad">
                            <option value="" disabled="" selected="">Selecciona una provincia</option>
                            <option value="categoria">Quito</option>
                            <option value="categoria">Guayaquil</option>
                            <option value="categoria">Cuenca</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Parroquia <span class="sp-requerido">*</span></span>
                        <select class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elija una parroquia">
                            <option value="" disabled="" selected="">Selecciona una Ciudad</option>
                            <option value="categoria">San Sebastían</option>
                            <option value="categoria">Sayausi</option>
                            <option value="categoria">...</option>
                        </select>
                    </div>
                </div>                             
                
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input type="text" class="tooltips-general material-control" placeholder="Ingrese el código del bien inmueble" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Ingrese el código del bien inmueble">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Código de Inventario Bien Inmueble<span class="sp-requerido">*</span></label>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input type="file" class="tooltips-general material-control" required="">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Registro de la propiedad vigente emitido por el GAD<span class="sp-requerido">*</span></label>
                    </div>
                </div>
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