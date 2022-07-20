<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once 'modelo/clstipoevento.php';

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
				<div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <span>Institución a la que pertenece <span class="sp-requerido">*</span></span>
                        <textarea id="txtnomins" name="txtnomins" class="tooltips-general material-control" placeholder="Por ejemplo: Instituto Nacional de Patrimonio Cultural" required="" data-toggle="tooltip" data-placement="top" title="Escribe el nombre de la Institución"></textarea>
                    </div>
                </div>
                
				<div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Tipo de evento que se va a realizar <span class="sp-requerido">*</span></span>
                        <select id="selevento" name="selevento" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Selecciona el Evento" onchange="javascript:showContent();">
                          <option value="" disabled="" selected="">Seleccione Evento</option> 
                          <?php 
                            $evento = new clstipoevento;
                            $rsevento = $evento->tipoevento_seleccionartodo();
                            while($row= mysqli_fetch_array($rsevento)){                      
                          ?>
                          <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                          <?php  } // fin while?>
                        </select>
                         
                    </div>
                </div>
				
				<div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="group-material">
                        <input id="txteve" name="txteve"  type="text" class="tooltips-general material-control" placeholder="Escriba otro tipo de evento"  data-toggle="tooltip" data-placement="top" title="Otro tipo de Evento" >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label><span class="sp-requerido"></span></label>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <span>Tema del Evento<span class="sp-requerido">*</span></span>
                        <textarea id="txttemeve" name="txttemeve" class="tooltips-general material-control" placeholder="Escriba el tema del evento" required="" data-toggle="tooltip" data-placement="top" title="Escribe el nombre de la Institución"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="group-material">
                        <input id="txtaforo" name="txtaforo" type="text" class="tooltips-general material-control" placeholder="Escriba el aforo aproximado" required="" data-toggle="tooltip" data-placement="top" title="Escriba el aforo aproximado">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Aforo del evento <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="group-material">
                        <input id="txtdura" name="txtdura" type="text" class="tooltips-general material-control" placeholder="Escriba la duración aproximada" required="" data-toggle="tooltip" data-placement="top" title="Escriba la duración aproximada">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Duración del evento <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <input id="txtnoma" name="txtnoma" type="text" class="tooltips-general material-control" placeholder="Escriba el nombre de la persona a cargo del evento"  data-toggle="tooltip" data-placement="top" title="Escriba el nombre de la persona a cargo del evento">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Nombre de la persona que se hará cargo del espacio <span class="sp-requerido">*</span></label>
                    </div>
                </div>
            </div>
            <div class="row margensup">
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-calendar-alt"></i> &nbsp; Fecha y Hora de Atención</legend>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="txtfec" name="txtfec" type="date" class="tooltips-general material-control" placeholder="Escoge la fecha" pattern="[0-9]{1,20}"  maxlength="20" data-toggle="tooltip" data-placement="top" title="Escoga la fecha">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de atención <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Horario disponible <span class="sp-requerido">*</span></span>
                        <select id="txthor" name="txthor" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elige la hora">
                            <option value="" disabled="" selected="">Selecciona una hora</option>
                            <option value="08:00 - 08:20">08:00 - 08:20</option>
                            <option value="14:00 - 14:20">14:00 - 14:20</option>
                            <option value="15:30 - 15:50">15:30 - 15:50</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-6">
                 <div class="group-material">
                        <input id="chkfec2" type="checkbox" name="chkfec2" onclick="showFec2()"  >
                        <label for="checkbox">Ingrese otra fecha</label> 
                 </div>
                </div>    
                
            </div>
           
            <div id="fec2" class="row margensup" style="display:none">
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-calendar-alt"></i> &nbsp; Fecha y Hora de Atención 2</legend>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="txtfec2" name="txtfec2" type="date" class="tooltips-general material-control" placeholder="Escoge la fecha" pattern="[0-9]{1,20}"  maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe el código correlativo del libro, solamente números">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de atención <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Horario disponible <span class="sp-requerido">*</span></span>
                        <select id="txthor2" name="txthor2" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elige la hora">
                            <option value="" disabled="" selected="">Selecciona una hora</option>
                            <option value="08:00 - 08:20">08:00 - 08:20</option>
                            <option value="14:00 - 14:20">14:00 - 14:20</option>
                            <option value="15:30 - 15:50">15:30 - 15:50</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
					<div class="group-material">
                        <input id="chkfec3" type="checkbox" name="chkfec3" onclick="showFec3()"  >
                        <label for="checkbox1">Ingrese otra fecha</label> 
					</div>
                </div>   
            </div>
			
			<div id="fec3" class="row margensup" style="display:none">
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-calendar-alt"></i> &nbsp; Fecha y Hora de Atención 3</legend>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="txtfec3" name="txtfec3" type="date" class="tooltips-general material-control" placeholder="Escoge la fecha" pattern="[0-9]{1,20}"  maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe el código correlativo del libro, solamente números">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de atención <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Horario disponible <span class="sp-requerido">*</span></span>
                        <select id="txthor3" name="txthor3" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elige la hora">
                            <option value="" disabled="" selected="">Selecciona una hora</option>
                            <option value="08:00 - 08:20">08:00 - 08:20</option>
                            <option value="14:00 - 14:20">14:00 - 14:20</option>
                            <option value="15:30 - 15:50">15:30 - 15:50</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 ">
					<div class="group-material">
                        <input id="chkfec4" type="checkbox" name="chkfec4" onclick="showFec4()" align="right" >
                        <label for="checkbox1">Ingrese otra fecha</label> 
					</div>
                </div>   
            </div>
			
			<div id="fec4" class="row margensup" style="display:none">
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-calendar-alt"></i> &nbsp; Fecha y Hora de Atención 4</legend>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="txtfec4" name="txtfec4" type="date" class="tooltips-general material-control" placeholder="Escoge la fecha" pattern="[0-9]{1,20}"  maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe el código correlativo del libro, solamente números">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de atención <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Horario disponible <span class="sp-requerido">*</span></span>
                        <select id="txthor4" name="txthor4" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elige la hora">
                            <option value="" disabled="" selected="">Selecciona una hora</option>
                            <option value="08:00 - 08:20">08:00 - 08:20</option>
                            <option value="14:00 - 14:20">14:00 - 14:20</option>
                            <option value="15:30 - 15:50">15:30 - 15:50</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 ">
					<div class="group-material">
                        <input id="chkfec5" type="checkbox" name="chkfec5" onclick="showFec5()" align="right" >
                        <label for="checkbox1">Ingrese otra fecha</label> 
					</div>
                </div>   
            </div>
			<div id="fec5" class="row margensup" style="display:none">
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-calendar-alt"></i> &nbsp; Fecha y Hora de Atención 5</legend>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="txtfec5" name="txtfec5" type="date" class="tooltips-general material-control" placeholder="Escoge la fecha" pattern="[0-9]{1,20}"  maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe el código correlativo del libro, solamente números">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de atención <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Horario disponible <span class="sp-requerido">*</span></span>
                        <select id="txthor5" name="txthor5" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elige la hora">
                            <option value="" disabled="" selected="">Selecciona una hora</option>
                            <option value="08:00 - 08:20">08:00 - 08:20</option>
                            <option value="14:00 - 14:20">14:00 - 14:20</option>
                            <option value="15:30 - 15:50">15:30 - 15:50</option>
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
                <div class="col-xs-12 col-sm-6 col-md-6 checkbox">
                    <div class="group-material">
                        <input id="checkbox2" required="" type="checkbox" name="remember" kl_vkbd_parsed="true">
                        <label for="checkbox2">Acepto el presente <a href="#" data-toggle="modal" data-target="#ModalUsoespacios">Reglamento uso de espacios</a></label> 
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
<?php include_once("./modal/uso_espacios.php"); ?>
<?php include_once("./includes/footer.php"); ?>
<script type="text/javascript">
    function showContent() {
        element2 = document.getElementById("txteve");
		check = document.getElementById("selevento");
        if (check.value != 5) {
            element2.style.display='none';
        }
        else {
            element2.style.display='block';
        }
    }
	
	function showFec2() {
        element2 = document.getElementById("fec2");
		check = document.getElementById("chkfec2");
        if (check.checked) {
            element2.style.display='block';
        }
        else {
            element2.style.display='none';
        }
	}
	function showFec3() {
        element2 = document.getElementById("fec3");
		check = document.getElementById("chkfec3");
        if (check.checked) {
            element2.style.display='block';
        }
        else {
            element2.style.display='none';
        }
	}
	function showFec4() {
        element2 = document.getElementById("fec4");
		check = document.getElementById("chkfec4");
        if (check.checked) {
            element2.style.display='block';
        }
        else {
            element2.style.display='none';
        }
	}
	function showFec5() {
        element2 = document.getElementById("fec5");
		check = document.getElementById("chkfec5");
        if (check.checked) {
            element2.style.display='block';
        }
        else {
            element2.style.display='none';
        }
    }
</script>
<script type="text/javascript">
function ShowSelected() {
	/* Para obtener el valor */
	var cod = document.getElementById("selevento").value;
	document.getElementById("txteve").value = cod;

}
</script>
<a href="#" class="scrollup"><i class="fa fa-arrow-circle-up">sdasdas</i></a>