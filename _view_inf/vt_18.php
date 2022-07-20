<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once("./modelo/clstramite18.php");
include_once("./modelo/clstramiterespuestas.php");
include_once("./modelo/clstu18respuestas.php");
include_once("./modelo/clstuanexos.php");
include_once("./modelo/clstipoevento.php");
//OBTENER CAMPOS ESPECÍFICOS DEL TRÁMITE
$tramitee=new clstramite18();
$tramitee->setTu_codigo($tra_codigo);
$tespecifico=$tramitee->tra_seleccionar_bycodigo();
$tespecifico= mysqli_fetch_array($tespecifico);
//Obtener el evento
$evento = new clstipoevento();
$evento->carga_tev_codigo($tespecifico["te_evento"]);
$evento=mysqli_fetch_array($evento->tipoevento_seleccionar());
//OBTENER ANEXOS
$anexose=new clstuanexos();
$anexose->setTu_id($tespecifico["tu_id"]);
$anexose->setTra_id($tra_id);
$anexos18=$anexose->tua_seleccionar_byte();
//OBTENER RESPUESTA
$respuestae=new clstu18respuestas();
$respuestae->setTu_id($tespecifico["tu_id"]);
$respuestae->setTra_id($tra_id);
$respuesta18=$respuestae->obtener_tramiterespuestas();

$bandera_convalidar="";
$bandera_convanxres="";
?>
<tr class="row-light">
    <th colspan='2'><i class="zmdi zmdi-collection-item"></i> Requisitos</th>
    <th colspan='4'><i class="zmdi zmdi-check"></i> Validación</th>
</tr>
<tr>
    <td colspan="6">NA</td>        
</tr>
<tr class="row-light">
    <th colspan='6'><i class="zmdi zmdi-assignment-o"></i> Formulario de Información</th>
</tr>
<tr>
        <th class="text-right">Tipo de Evento:</th><td colspan="3"><?php echo $evento["tev_nombre"]?></td>
        <th class="text-right">Institución Requiriente:</th><td><?php echo $tespecifico["te_institucion"]?></td>
    </tr>
    <tr>
        <th class="text-right">Tema:</th><td colspan="3"><?php echo $tespecifico["te_tema"]?></td>
        <th class="text-right">Persona responsable:</th><td><?php echo $tespecifico["te_persona_acargo"]?></td>
    </tr>
    <tr>
        <th class="text-right">Duración:</th><td colspan="3"><?php echo $tespecifico["te_duracion"]?></td>
        <th class="text-right">Aforo:</th><td><?php echo $tespecifico["te_aforo"]?></td>
    </tr>
	<tr>
        <th class="text-right">Fecha:</th><td colspan="3"><?php echo $tespecifico["te_fecha1"]?></td>
        <th class="text-right">Hora:</th><td><?php echo $tespecifico["te_hora"]?></td>
    </tr>
<tr class="tr_validacion <?php echo "tr_".strtolower($tespecifico["te_cumple"]);?>">
    <th class="text-right"><i class="zmdi zmdi-check"></i> Validación</th>
    <td><?php echo $tespecifico["te_cumple"];?></td>
    <td colspan="3"><?php echo ($tespecifico["te_observaciones"]=="")? "<span>Sin observaciones</span>" : "<span class='sp-requerido'>".$tespecifico["te_observaciones"]."</span>";?></td>
    <td>
        <?php if((($_SESSION["codperfil"]==ASIGNADOR)||($_SESSION["codperfil"]==EJECUTOR))&&($ttramite["et_id"]!=CONVALIDACIÓN_REQUISITOS1)&&($ttramite["et_id"]!=CONVALIDACIÓN_REQUISITOS2)&&($ttramite["tu_band_respuesta"]==0)):?>
            <button href="#" class='btn btn-default'  title='Validar Requisito' data-toggle="modal" data-target="#ValidarRequisito" onclick="cargar_datos_vrte('<?php echo $tra_id ?>','<?php echo $_GET["idtu"];?>','<?php echo $tespecifico["tu_codigo"];?>')"><i class="zmdi zmdi-check-all"></i> Validar Formulario</button>
        <?php endif;?>
        <?php /*if(($_SESSION["codperfil"]==CIUDADANO)&&($tespecifico["te_cumple"]=="INCORRECTO")):?>
            <button href="#" class='btn btn-default'  title='Convalidar Requisito' data-toggle="modal" data-target="#ConvalidarRequisito" onclick="cargar_datos_vrte('<?php echo $tra_id ?>','<?php echo $_GET["idtu"];?>','<?php echo $tespecifico["tu_codigo"];?>')"><i class="zmdi zmdi-rotate-ccw"></i> Convalidar Formulario</button>
        <?php endif;*/?>    
    </td>
</tr>
<!--SI EL ESTADO DEL TRAMITE ES 5 NO PERMITIR QUE VE AL CIUDADANO, Y MOSTRARLE EN UN FORMATO SIN VALIDACIÓN-->
<tr class="info">
                <th colspan="6">Respuesta</th>	
</tr>
<tr class="row-light">
    <th colspan='2'><i class="zmdi zmdi-collection-item"></i> Anexos</th>
    <th colspan='4'><i class="zmdi zmdi-check"></i> Validación</th>
</tr>
<?php
while($anexo=mysqli_fetch_array($anexos18)){
?>
<tr class="<?php echo "tr_".strtolower($anexo["tua_cumple"]);?>">
    <td colspan="2">
        <?php if (($anexo["tu_id"]==$tespecifico["tu_id"])&&($anexo["tua_rutaarchivo"]!=NULL)){?>
        <a href="" onclick="VentanaCentrada('<?php echo DIRDOWNLOAD.$anexo["tua_rutaarchivo"]?>','Requisito','','1024','768','true');return false;"><?php echo $anexo["anx_nombre"];?></a>
        <?php } else {?>
            <?php echo $anexo["anx_nombre"];?>
        <?php } ?>
    </td>
    <td class="tr_validacion">
        <?php echo ($anexo["tua_cumple"]=="")? "NO INGRESADO" : $anexo["tua_cumple"]; ?>
    </td>
    <td class="tr_validacion" colspan="2"><?php echo ($anexo["tua_observaciones"]=="")? "<span>Sin observaciones</span>" : "<span class='sp-requerido'>".$anexo["tua_observaciones"]."</span>";?></td>
    <td class="tr_validacion">
        <?php if(($_SESSION["codperfil"]==APROBADOR)&&($anexo["tua_rutaarchivo"]!=NULL)):?>
            <button href="#" class='btn btn-default'  title='Validar Anexo' data-toggle="modal" data-target="#ValidarAnexo" onclick="cargar_datos_va('<?php echo $tra_id ?>','<?php echo $anexo["tua_id"];?>','<?php echo $_GET["idtu"];?>','<?php echo $tespecifico["tu_codigo"];?>')"><i class="zmdi zmdi-check-all"></i> Validar Anexo</button>
        <?php endif;?>
        <?php ?>  
    </td>
</tr>
<?php } 
?>
<?php
$respuesta=mysqli_fetch_array($respuesta18);
?>
<tr class="row-light">
    <th colspan='2'><i class="zmdi zmdi-collection-item"></i> Respuesta</th>
    <th colspan='4'><i class="zmdi zmdi-check"></i> Validación</th>
</tr>
<tr class="<?php echo "tr_".strtolower($respuesta["tuc_cumple"]);?>">
    <td colspan="2">
        <?php if (($respuesta["tu_id"]==$tespecifico["tu_id"])&&($respuesta["tuc_rutaarchivo"]!=NULL)){?>
        <a href="" onclick="VentanaCentrada('<?php echo DIRDOWNLOAD.$respuesta["tuc_rutaarchivo"]?>','Requisito','','1024','768','true');return false;"><?php echo "Respuesta";?></a>
        <?php } else {?>
            <?php echo "Respuesta";?>
        <?php } ?>
    </td>
    <td class="tr_validacion">
        <?php echo ($respuesta["tuc_cumple"]=="")? "NO INGRESADO" : $respuesta["tuc_cumple"]; ?>
    </td>
    <td class="tr_validacion" colspan="2"><?php echo ($respuesta["tuc_observaciones"]=="")? "<span>Sin observaciones</span>" : "<span class='sp-requerido'>".$respuesta["tuc_observaciones"]."</span>";?></td>
    <td class="tr_validacion">
        <?php if(($_SESSION["codperfil"]==APROBADOR)&&($respuesta["tuc_rutaarchivo"]!=NULL)):?>
            <button href="#" class='btn btn-default'  title='Validar Respuesta' data-toggle="modal" data-target="#ValidarRespuesta" onclick="cargar_datos_vres('<?php echo $tra_id ?>','<?php echo $respuesta["tuc_id"];?>','<?php echo $_GET["idtu"];?>','<?php echo $tespecifico["tu_codigo"];?>')"><i class="zmdi zmdi-check-all"></i> Validar Respuesta</button>
        <?php endif;?>
        <?php ?>  
    </td>
</tr>