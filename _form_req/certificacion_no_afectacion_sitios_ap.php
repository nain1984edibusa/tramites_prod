<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
?>	
<div class="container-fluid">
    <div class="alert alert-warning alert-dismissible" role="alert">
        <strong>Importante:</strong> Para acceder a este trámites es importante que su predio sea menor o igual a 1 Hectárea.						
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
</div>
<div class="container-fluid">
    <div class="container-flat-form formularios_ct">
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
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <span>Objeto de la solicitud <span class="sp-requerido">*</span></span>
                        <textarea class="tooltips-general material-control" placeholder="Escriba la razón de su solicitud" required="" data-toggle="tooltip" data-placement="top" title="Escribe la razón de tu solicitud"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-calendar-alt"></i> &nbsp; Datos del Predio</legend>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Provincia <span class="sp-requerido">*</span></span>
                        <select class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elige la provincia">
                            <option value="" disabled="" selected="">Selecciona una Provincia</option>
                            <option value="categoria">Azuay</option>
                            <option value="categoria">Chimborazo</option>
                            <option value="categoria">Tungurahua</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Cantón <span class="sp-requerido">*</span></span>
                        <select class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elige la categoría del libro">
                            <option value="" disabled="" selected="">Selecciona un Cantón</option>
                            <option value="categoria">Alausí</option>
                            <option value="categoria">Guano</option>
                            <option value="categoria">Riobamba</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Parroquia <span class="sp-requerido">*</span></span>
                        <select class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elija la provincia">
                            <option value="" disabled="" selected="">Selecciona una Parroquia</option>
                            <option value="categoria">Maldonado</option>
                            <option value="categoria">Velasco</option>
                            <option value="categoria">Lizarzaburu</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input type="text" class="tooltips-general material-control" placeholder="Escriba el sector de ubicación" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe el código correlativo del libro, solamente números">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Sector <span class="sp-requerido">*</span></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input type="text" class="tooltips-general material-control" placeholder="Escriba la calle o vía principal del predio" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe el código correlativo del libro, solamente números">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Vía Principal <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input type="text" class="tooltips-general material-control" placeholder="Escriba la calle o vía secundaria del predio" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe el código correlativo del libro, solamente números">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Vía Secundaria <span class="sp-requerido">*</span></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input type="number" class="tooltips-general material-control" placeholder="Ingrese la extensión del predio en ha" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe el código correlativo del libro, solamente números">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Extensión<span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input type="text" class="tooltips-general material-control" placeholder="Escriba el número de predio" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe el código correlativo del libro, solamente números">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Número de Predio<span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input type="text" class="tooltips-general material-control" placeholder="Escriba el número de catastro" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe el código correlativo del libro, solamente números">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Número Catastro<span class="sp-requerido">*</span></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <span>Ubicación del Predio en Google Maps<span class="sp-requerido">*</span></span>
                        <p class="texto_small"><strong>Latitud:</strong> Desconocida <strong>Longitud:</strong> Desconocida</p>
                        <div class="mapa_ubicacion_gm">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-calendar-alt"></i> &nbsp; Archivos/Requisitos</legend>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input type="file" class="tooltips-general material-control" placeholder="Ingrese la extensión del predio en ha" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Suba una fotografía del predio que facilite su ubicación">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Foto del Predio (PDF)<span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input type="file" class="tooltips-general material-control" placeholder="Escriba el número de predio" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Suba el documento de uso de Suelo, Línea de Fábrica o IRM">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Uso de Suelo, Línea de Fábrica o IRM (PDF)<span class="sp-requerido">*</span></label>
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