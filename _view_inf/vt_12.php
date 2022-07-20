<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once("./modelo/clstramite12.php");
include_once("./modelo/clsturequisitos.php");
include_once("./modelo/clstramiterespuestas.php");
include_once("./modelo/clstu12respuestas.php");
include_once("./modelo/clstuanexos.php");
include_once("./modelo/clsambito.php");
//OBTENER CAMPOS ESPECÍFICOS DEL TRÁMITE
$tramitee=new clstramite12();
$tramitee->setTu_codigo($tra_codigo);
$tespecifico=$tramitee->tra_seleccionar_bycodigo();
$tespecifico= mysqli_fetch_array($tespecifico);
//Obtener el ámbito
$ambito = new clsambito();
$ambito->setAmb_id($tespecifico["te_ambito"]);
$ambito=mysqli_fetch_array($ambito->ambito_seleccionar_byid());
//OBTENER REQUISITOS
$requisitose=new clsturequisitos();
$requisitose->setTu_id($tespecifico["tu_id"]);
$requisitose->setTra_id($tra_id);
$requisitos12=$requisitose->tur_seleccionar_byte();
//OBTENER ANEXOS
$anexose=new clstuanexos();
$anexose->setTu_id($tespecifico["tu_id"]);
$anexose->setTra_id($tra_id);
$anexos12=$anexose->tua_seleccionar_byte();
//OBTENER RESPUESTA
$respuestae=new clstu12respuestas();
$respuestae->setTu_id($tespecifico["tu_id"]);
$respuestae->setTra_id($tra_id);
$respuesta12=$respuestae->obtener_tramiterespuestas();

$bandera_convalidar="";
$bandera_convanxres="";
?>
<tr class="row-light">
    <th colspan='2'><i class="zmdi zmdi-collection-item"></i> Requisitos</th>
    <th colspan='4'><i class="zmdi zmdi-check"></i> Validación</th>
</tr>
<?php while($requisito=mysqli_fetch_array($requisitos12)){?>
<tr class="<?php echo "tr_".strtolower($requisito["tur_cumple"]);?>">
    <td colspan="2"><a href="" onclick="VentanaCentrada('<?php echo DIRDOWNLOAD.$requisito["tur_rutaarchivo"]?>','Requisito','','1024','768','true');return false;"><?php echo $requisito["req_nombre"]?></a> <a href="<?php echo DIRDOWNLOAD.$requisito["req_rutaformato"]?>" target="_blank"><i class="zmdi zmdi-info-outline"></i></a></td>
    <td class="tr_validacion"><?php echo $requisito["tur_cumple"];?></td>
    <td class="tr_validacion" colspan="2"><?php echo ($requisito["tur_observaciones"]=="")? "<span>Sin observaciones</span>" : "<span class='sp-requerido'>".$requisito["tur_observaciones"]."</span>";?></td>
    <td class="tr_validacion">
        <?php if((($_SESSION["codperfil"]==ASIGNADOR)||($_SESSION["codperfil"]==EJECUTOR))&&($ttramite["et_id"]!=CONVALIDACIÓN_REQUISITOS1)&&($ttramite["et_id"]!=CONVALIDACIÓN_REQUISITOS2)&&($ttramite["tu_band_respuesta"]==0)):?>
            <button href="#" class='btn btn-default'  title='Validar Requisito' data-toggle="modal" data-target="#ValidarRequisito" onclick="cargar_datos_vr('<?php echo $tra_id ?>','<?php echo $requisito["tur_id"];?>','<?php echo $_GET["idtu"];?>','<?php echo $tespecifico["tu_codigo"];?>')"><i class="zmdi zmdi-check-all"></i> Validar Requisito</button>
        <?php endif;?>
        <?php /*if(($_SESSION["codperfil"]==CIUDADANO)&&($requisito["tur_cumple"]=="INCORRECTO")):?>
            <button href="#" class='btn btn-default'  title='Convalidar Requisito' data-toggle="modal" data-target="#ConvalidarRequisito" onclick="cargar_datos_vr('<?php echo $tra_id ?>','<?php echo $requisito["tur_id"];?>','<?php echo $_GET["idtu"];?>','<?php echo $tespecifico["tu_codigo"];?>')"><i class="zmdi zmdi-check-all"></i> Convalidar Requisito</button>
        <?php endif;*/?>  
    </td>
    <?php if($requisito["tur_cumple"]=="INCORRECTO"){
        $bandera_convalidar.="0/";
    }else{
        $bandera_convalidar.="1/";
    } 
    ?>
</tr>
<?php } ?>
<tr class="row-light">
    <th colspan='6'><i class="zmdi zmdi-assignment-o"></i> Formulario de Información</th>
</tr>
<tr>
    <th class="text-right">Ámbito:</th><td colspan="3"><?php echo $ambito["amb_nombre"]?></td>
    <th class="text-right">Cantidad de fichas:</th><td><?php echo $tespecifico["te_cantidad_fichas"]?></td>
</tr>
<tr>
    <th class="text-right">Responsable del Ingreso:</th><td colspan="3"><?php echo $tespecifico["te_persona_responsable"]?></td>
    <th class="text-right">Fecha de Ingreso:</th><td><?php echo $tespecifico["te_fecha_ingreso"]?></td>
</tr>
<tr>
    <th class="text-right">Responsable de Revisión (GAD):</th><td colspan="3"><?php echo $tespecifico["te_tecnico_responsable"]?></td>
    <th class="text-right">Fecha de Revisión:</th><td><?php echo $tespecifico["te_fecha_revision"]?></td>
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
while($anexo=mysqli_fetch_array($anexos12)){
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
$respuesta=mysqli_fetch_array($respuesta12);
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