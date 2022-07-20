<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once("./modelo/clstramite5.php");
include_once("./modelo/clsturequisitos.php");
//OBTENER CAMPOS ESPECÍFICOS DEL TRÁMITE
$tramitee=new clstramite5();
$tramitee->setTu_codigo($tra_codigo);
$tespecifico=$tramitee->tra_seleccionar_bycodigo();
$tespecifico= mysqli_fetch_array($tespecifico);
//OBTENER REQUISITOS
$requisitose=new clsturequisitos();
$requisitose->setTu_id($tespecifico["tu_id"]);
$requisitose->setTra_id($tra_id);
$requisitos5=$requisitose->tur_seleccionar_byte();
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
                <?php while($requisito= mysqli_fetch_array($requisitos5)){
                    if($requisito["tur_cumple"]=="INCORRECTO"): //SI EL FORMULARIO TIENE INFORMACIÓN INCORRECTA?>  
                    
                        <div class="container-fluid">
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <strong>Observaciones:</strong> <?php echo $requisito["tur_observaciones"]?>						
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                                           
                    <div class="col-xs-12 ">
                        <div class="group-material">
                            <input name="<?php echo $requisito["req_slug"];?>" id="<?php echo $requisito["req_slug"];?>" type="file" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" required='' accept="application/pdf"> <!--title="Escribe el código correlativo del libro, solamente números"-->
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label><?php echo $requisito["req_nombre"];?> <span class="sp-requerido">*</span></label>
                        </div>
                        <input type="hidden" name="<?php echo $requisito["req_slug"]."_id";?>" value="<?php echo $requisito["tur_id"];?>"/>
                        
                    </div>
                    </br>
                    </br>
                    </br>
                    </br>
                    
                <?php endif;
                
                    } ?> 
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
