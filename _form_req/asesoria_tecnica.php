<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once 'modelo/clstipoareaasesoria.php';
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
                        <span>Área <span class="sp-requerido">*</span></span>
                        <select name="area" id="area" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija un area">
                            <option value="" disabled="" selected="">Selecciona un área</option>
                            <?php 
                            $area = new clstipoareaasesoria;
                            $rsarea = $area->tipoareaasesoria_seleccionartodo();
                            while($row= mysqli_fetch_array($rsarea)){
                            ?>
                            <option value="<?php echo $row["aaset_codigo"];?>"><?php echo $row["aaset_nombre"];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <input id="tema" name="tema" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: ayuda en ...." required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione la provincia de ubicación del bien" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Especificar el requerimiento y la necesidad <span class="sp-requerido">*</span></label>
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