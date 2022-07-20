<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
?>
<tr class="row-light">
    <th colspan='4'><i class="zmdi zmdi-check"></i> Requisitos</th>
</tr>
<tr>
    <td colspan="2"><a href="" onclick="VentanaCentrada('<?php echo DIRDOWNLOAD?>/formatos/requisito_tipo.pdf','Factura','','1024','768','true');">Registro de la propiedad vigente emitido por el GAD</a></td>
    <td>Pendiente</td>
    <td><?php if(($_SESSION["codperfil"]==ASIGNADOR)||($_SESSION["codperfil"]==EJECUTOR)):?><button href="#" class='btn btn-default'  title='Validar Requisito' data-toggle="modal" data-target="#ValidarRequisito"><i class="zmdi zmdi-check-all"></i> Validar Requisito</button><?php endif;?></td>
</tr>
<tr class="row-light">
    <th colspan='4'><i class="zmdi zmdi-assignment-o"></i> Formulario de Información</th>
</tr>
<tr>
    <th class="text-right">Provincia:</th><td>Chimborazo</td><th class="text-right">Cantón:</th><td>Riobamba</td>
</tr>
<tr>
    <th class="text-right">Ciudad:</th><td>Riobamba</td><th class="text-right">Parroquia:</th><td>Velasco</td>
</tr>
<tr>
    <th class="text-right">Código de Inventario:</th><td>BI29222e929</td>
</tr>

