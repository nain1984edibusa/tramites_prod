<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once("./modelo/clstramite5.php");
include_once("./modelo/clsturequisitos.php");
include_once("./modelo/clstramiterespuestas.php");
include_once("./modelo/clstu5respuestas.php");
include_once("./modelo/clstuanexos.php");
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
//OBTENER ANEXOS
$anexose=new clstuanexos();
$anexose->setTu_id($tespecifico["tu_id"]);
$anexose->setTra_id($tra_id);
$anexos5=$anexose->tua_seleccionar_byte();
//OBTENER RESPUESTA
$respuestae=new clstu5respuestas();
$respuestae->setTu_id($tespecifico["tu_id"]);
$respuestae->setTra_id($tra_id);
$respuesta5=$respuestae->obtener_tramiterespuestas();

//s$bandera_convalidar="";
?>
<table class="table">
    <tr class="info">
        <th colspan="6">Detalles del Trámite</th>	
    </tr>
    <tr class="row-light">
        <th colspan='6'><i class="zmdi zmdi-collection-item"></i> Requisitos</th>
    </tr>
    <?php while($requisito=mysqli_fetch_array($requisitos5)){?>
    <tr class="<?php echo "tr_".strtolower($requisito["tur_cumple"]);?>">
        <td colspan="2"><a href="" onclick="VentanaCentrada('<?php echo DIRDOWNLOAD.$requisito["tur_rutaarchivo"]?>','Requisito','','1024','768','true');return false;"><?php echo $requisito["req_nombre"]?></a> <a href="<?php echo DIRDOWNLOAD.$requisito["req_rutaformato"]?>" target="_blank"><i class="zmdi zmdi-info-outline"></i></a></td>
        <td class="tr_validacion"><?php echo $requisito["tur_cumple"];?></td>
        <td class="tr_validacion" colspan="2"><?php echo ($requisito["tur_observaciones"]=="")? "<span>Sin observaciones</span>" : "<span class='sp-requerido'>".$requisito["tur_observaciones"]."</span>";?></td>
        <td colspan="2"><a href="<?php echo DIRDOWNLOAD.$requisito["tur_rutaarchivo"]?>" download="<?php echo $requisito["req_nombre"].$tra_codigo?>"><i class="zmdi zmdi-download"></i>&nbsp;&nbsp;Descargar Archivo</a></td>
    </tr>
    <?php } ?>
                        
    <!--SI EL ESTADO DEL TRAMITE ES 5 NO PERMITIR QUE VE AL CIUDADANO, Y MOSTRARLE EN UN FORMATO SIN VALIDACIÓN-->
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
                while($anexo=mysqli_fetch_array($anexos5)){
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
                $respuesta=mysqli_fetch_array($respuesta5);
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

