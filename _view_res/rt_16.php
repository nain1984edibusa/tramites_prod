<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once("./modelo/clstramite16.php");
include_once("./modelo/clstramiterespuestas.php");
include_once("./modelo/clstu16respuestas.php");
include_once("./modelo/clstuanexos.php");
include_once("./modelo/clstipoareaasesoria.php");
//OBTENER CAMPOS ESPECÍFICOS DEL TRÁMITE
$tramitee=new clstramite16();
$tramitee->setTu_codigo($tra_codigo);
$tespecifico=$tramitee->tra_seleccionar_bycodigo();
$tespecifico= mysqli_fetch_array($tespecifico);
//Obtener el ámbito
$area = new clstipoareaasesoria();
$area->carga_aaset_codigo($tespecifico["te_area"]);
$area=mysqli_fetch_array($area->tipoareaasesoria_seleccionar());
//OBTENER ANEXOS
$anexose=new clstuanexos();
$anexose->setTu_id($tespecifico["tu_id"]);
$anexose->setTra_id($tra_id);
$anexos16=$anexose->tua_seleccionar_byte();
//OBTENER RESPUESTA
$respuestae=new clstu16respuestas();
$respuestae->setTu_id($tespecifico["tu_id"]);
$respuestae->setTra_id($tra_id);
$respuesta16=$respuestae->obtener_tramiterespuestas();

//s$bandera_convalidar="";
?>
<table class="table">
    <tr class="info">
        <th colspan="6">Detalles del Trámite</th>	
    </tr>
    <tr class="row-light">
    <th colspan='6'><i class="zmdi zmdi-check"></i> Requisitos</th>
    </tr>
    <tr>
        <td colspan="6">NA</td>        
    </tr>
    <tr class="row-light">
        <th colspan='6'><i class="zmdi zmdi-assignment-o"></i> Formulario de Información</th>
    </tr>
    <tr>
        <th class="text-right">Área:</th><td colspan="3"><?php echo $area["aaset_nombre"]?></td>
        
    </tr>
    <tr>
        <th class="text-right">Tema:</th><td colspan="3"><?php echo $tespecifico["te_tema"]?></td>
       
    </tr>
    
    <tr class="tr_validacion <?php echo "tr_".strtolower($tespecifico["te_cumple"]);?>">
        <th class="text-right"><i class="zmdi zmdi-check"></i> Validación</th>
        <td><?php echo $tespecifico["te_cumple"];?></td>
        <td colspan="4"><?php echo ($tespecifico["te_observaciones"]=="")? "<span>Sin observaciones</span>" : "<span class='sp-requerido'>".$tespecifico["te_observaciones"]."</span>";?></td>
    </tr>
    <!--SI EL ESTADO DEL TRAMITE ES 5 NO PERMITIR QUE VE AL CIUDADANO, Y MOSTRARLE EN UN FORMATO SIN VALIDACIÓN-->
    <?php //echo "codigo perfil".$_SESSION["codperfil"]; ?>
    <?php if(($_SESSION["codperfil"]==CIUDADANO && $ttramite["et_id"]==CONTESTADO_DESPACHADO)||($_SESSION["codperfil"]!=CIUDADANO)){ ?>
	<tr class="info">
                    <th colspan="6">Respuesta</th>	
    </tr>
    <tr>
        <td colspan="4" style="padding:0px">
            <table class="table">
                <tr class="row-light">
                    <th colspan='3'><i class="zmdi zmdi-collection-item"></i> Anexos</th>
                </tr>
                <?php
                while($anexo=mysqli_fetch_array($anexos16)){
                ?>
                <tr>
                    <td><a href="" onclick="VentanaCentrada('<?php echo DIRDOWNLOAD.$anexo["tua_rutaarchivo"]?>','Requisito','','1024','768','true');return false;"><?php echo $anexo["anx_nombre"];?></a></td>
                    <td><?php echo $anexo["tua_codigoe"]?></td>
                    <td><a href="<?php echo DIRDOWNLOAD.$anexo["tua_rutaarchivo"]?>" download="<?php echo $anexo["anx_nombre"].$tra_codigo?>"><i class="zmdi zmdi-download"></i>&nbsp;&nbsp;Descargar Archivo</a></td>
                </tr>
                <?php } 
                ?>
            </table>
        </td>

        <td colspan="2" style="padding:0px">
            <table class="table">
                <?php
                $respuesta=mysqli_fetch_array($respuesta16);
                ?>
                <tr class="row-light">
                    <th colspan='2'><i class="zmdi zmdi-collection-item"></i> Respuesta</th>
                </tr>
                <tr>
                    <td><a href="" onclick="VentanaCentrada('<?php echo DIRDOWNLOAD.$respuesta["tuc_rutaarchivo"]?>','Requisito','','1024','768','true');return false;"><?php echo "Respuesta";?></a></td>
                    <td><a href="<?php echo DIRDOWNLOAD.$respuesta["tuc_rutaarchivo"]?>" download="<?php echo "respuesta".$tra_codigo?>"><i class="zmdi zmdi-download"></i>&nbsp;&nbsp;Descargar Archivo</a></td>
                </tr>
            </table>
        </td>
    </tr>
	<?php } ?>
</table>

