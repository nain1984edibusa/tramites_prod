<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
?>
<div class="container-fluid">
    <div class="container-flat-form formularios_ct">
        <div class="title-flat-form title-flat-blue">Formulario de Información</div>
        <form action="controller/registrar_tramite.php" method="post" class="form-padding">
            <div class="row">
                <div class="col-xs-12">
                    <?php include_once './includes/errores.php'; ?>
                    <p class="instrucciones_formularios_ct">Recuerde que los campos marcados con <span class="sp-requerido">*</span> son requeridos.</p>
                </div>
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-calendar-alt"></i> &nbsp; Fecha y Hora de Atención</legend>
                </div>
                <input type="hidden" name="idt" id="idt" value="<?php echo $_GET["idt"];?>">
                <input type="hidden" name="estadot" id="estadot" value="<?php echo $estado_inicial;?>">
                <input type="hidden" name="duraciont" id="duraciont" value="<?php echo $tramite_tiempo;?>">
                <input type="hidden" name="iniciat" id="iniciat" value="<?php echo $inicia_tramite; ?>">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input name="fecha" id="fecha" type="date" class="tooltips-general material-control" placeholder="Escoja una fecha para su cita" step="1" min="<?php echo sumar_ndias_fecha(date("Y-m-d"),1); ?>" max="<?php echo sumar_ndias_fecha(date("Y-m-d"),DIAS_AGENDAS); ?>" value="<?php echo sumar_ndias_fecha(date("Y-m-d"),1); ?>" required="" data-toggle="tooltip" data-placement="top" > <!--title="Escribe el código correlativo del libro, solamente números"-->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de atención <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Horario disponible <span class="sp-requerido">*</span></span>
                        <select name="horario" id="horario" class="tooltips-general material-control" disabled="" data-toggle="tooltip" data-placement="top" title="Elija una hora" required="">
                            <option value="" disabled="" selected="">Selecciona una hora</option>
                        </select>
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
<script type="text/javascript">
$( document ).ready(function() {
    cargar_turnos();
});  
//FUNCION QUE OBTENGA LAS HORAS EN LA FECHA SELECCIONADA QUE ESTEN EN LA TABLA DE TURNOS DEL TRAMITE PERO NO EN LA DE TRAMITES TURNO USUARIO (TURNOS DISPONIBLES)
function cargar_turnos(){
    $.ajax({
        type: "POST",
        url: "./ajax/obtener_turnos_disponibles.php",
        data: 'fecha='+$("#fecha").val()+'&tramite='+<?php echo $_GET["idt"]?>,
        success: function(datos){
            //alert(datos);
            if(datos.length>0){
                $("#horario").html(datos);
                $("#horario").attr("disabled",false);
            }else{
                alert("No existen turnos disponibles en la fecha seleccionada");
            }
        }
    });
}
$("#fecha" ).on( "change", function( event ) {
    cargar_turnos();
});
</script>