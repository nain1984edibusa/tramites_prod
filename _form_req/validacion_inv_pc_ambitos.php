<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once 'modelo/clsambito.php';
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
                    <legend><i class="zmdi zmdi-info-outline"></i> &nbsp; Información General</legend>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Ámbitos <span class="sp-requerido">*</span></span>
                        <select name="ambitos" id="ambitos" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija una ciudad">
                            <option value="" disabled="" selected="">Selecciona un ámbito</option>
                            <?php 
                            $ambito=new clsambito();
                            $ambitos=$ambito->ambito_seleccionar_all();
                            while($ambito= mysqli_fetch_array($ambitos)){
                            ?>
                            <option value="<?php echo $ambito["amb_id"];?>"><?php echo $ambito["amb_nombre"];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="cantidad_fichas" name="cantidad_fichas" type="number" class="tooltips-general material-control" placeholder="Por ejemplo: 100" maxlength="50" min="1" data-toggle="tooltip" data-placement="top" title="Ingrese la cantidad de fichas a validar" required="">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Cantidad de fichas <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <?php while($requisito= mysqli_fetch_array($trequisitos)){ ?>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <input name="<?php echo $requisito["req_slug"];?>" id="<?php echo $requisito["req_slug"];?>" type="file" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" required='' accept="application/pdf"> <!--title="Escribe el código correlativo del libro, solamente números"-->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label><?php echo $requisito["req_nombre"];?> <span class="sp-requerido">*</span></label>
                    </div>
                    <input type="hidden" name="<?php echo $requisito["req_slug"]."_id";?>" value="<?php echo $requisito["req_id"];?>"/>
                </div>
                <?php } ?> 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <input id="persona_responsable" name="persona_responsable" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Luis Alberto Andrade Quezada" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione la provincia de ubicación del bien" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Nombre de la persona responsable para ingresar la ficha inventario <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input name="fecha_ingreso" id="fecha_ingreso" required="" type="date" class="tooltips-general material-control" placeholder="Escoja una fecha para su cita" step="1" max="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" data-toggle="tooltip" data-placement="top" > <!--title="Escribe el código correlativo del libro, solamente números"-->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de ingreso de las fichas de inventario <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <input id="tecnico_responsable" name="tecnico_responsable" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Luis Alberto Andrade Quezada" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione la provincia de ubicación del bien" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Nombre del técnico responsable del GAD para la revisión de las fichas de inventario <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input name="fecha_revision" id="fecha_revision" type="date" class="tooltips-general material-control" placeholder="Escoja una fecha para su cita" step="1" max="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" required="" data-toggle="tooltip" data-placement="top" > <!--title="Escribe el código correlativo del libro, solamente números"-->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de revisión de las fichas de inventario <span class="sp-requerido">*</span></label>
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