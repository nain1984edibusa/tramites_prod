<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
?>
<div class="container-fluid">
    <div class="container-flat-form">
        <div class="title-flat-form title-flat-blue">Formulario de Información</div>
        <form enctype="multipart/form-data" method="post" class="form-padding" action="controller/registrar_tramite.php" autocomplete="off">
            <input type="hidden" name="idt" id="idt" value="<?php echo $_GET["idt"];?>">
            <input type="hidden" name="estadot" id="estadot" value="<?php echo $estado_inicial;?>">
            <input type="hidden" name="duraciont" id="duraciont" value="<?php echo $tramite_tiempo;?>">
            <input type="hidden" name="iniciat" id="iniciat" value="<?php echo $inicia_tramite; ?>">
            <div class="row">
                <div class="col-xs-12">
                    <p class="instrucciones_formularios_ct">Recuerde que los campos marcados con <span class="sp-requerido">*</span> son requeridos.</p>
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
                        <input id="provincia" name="provincia" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Cotopaxi" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione la provincia de ubicación del bien" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Provincia <span class="sp-requerido">*</span></label>
                        <input type="hidden" name="id_provincia" id="id_provincia"/>
                        <input type="hidden" name="id_regional" id="id_regional" value="<?php echo $_SESSION["regional"];?>"/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="canton" name="canton" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Latacunga" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione el cantón de ubicación del bien" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Cantón <span class="sp-requerido">*</span></label>
                        <input type="hidden" name="id_canton" id="id_canton"/>
                    </div>
                </div>
                <!--<div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Ciudad <span class="sp-requerido">*</span></span>
                        <select class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elija una ciudad">
                            <option value="" disabled="" selected="">Selecciona una provincia</option>
                            <option value="categoria">Quito</option>
                            <option value="categoria">Guayaquil</option>
                            <option value="categoria">Cuenca</option>
                        </select>
                    </div>
                </div>-->
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="parroquia" name="parroquia" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Juan Montalvo" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione su parroquia de residencia" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Parroquia <span class="sp-requerido">*</span></label>
                        <input type="hidden" name="id_parroquia" id="id_parroquia"/>
                    </div>
                </div>                             
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="direccion" name="direccion" type="text" class="material-control tooltips-general" placeholder="Por ejemplo: Benalcázar 2340 y 9 de Octubre" required="" maxlength="100" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba la dirección de su domicilio" -->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Dirección <span class="sp-requerido">*</span></label>
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="codigo_inventario" name="codigo_inventario" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: BI12583736333" maxlength="50" data-toggle="tooltip" data-placement="top" title="Ingrese el código del bien mueble" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Código de Inventario</label>
                    </div>
                </div>          
                <?php while($requisito= mysqli_fetch_array($trequisitos)){ ?>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input name="<?php echo $requisito["req_slug"];?>" id="<?php echo $requisito["req_slug"];?>" type="file" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" required='' accept="application/pdf"> <!--title="Escribe el código correlativo del libro, solamente números"-->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label><?php echo $requisito["req_nombre"];?> <span class="sp-requerido">*</span></label>
                    </div>
                    <input type="hidden" name="<?php echo $requisito["req_slug"]."_id";?>" value="<?php echo $requisito["req_id"];?>"/>
                </div>
                <?php } ?> 
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