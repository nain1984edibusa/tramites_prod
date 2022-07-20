<div class="container-fluid">
    <div class="table-responsive">
        <table class="table">
            <tr class="info">
                <th>Identificación</th>
                <th>Nombre</th>
                <th colspan="2">Correo</th>
                <th>Teléfono</th>
            </tr>
            <tr>
                <td><?php echo $ttramite["usu_identificador"]?></td>
                <td><?php echo $ttramite["usu_apellido"]." ".$ttramite["usu_nombre"]?></td>
                <td colspan="2"><?php echo $ttramite["usu_correo"];?></td>
                <td><?php echo $ttramite["usu_telefono"];?></td>
            </tr>
            <tr class="info">
                <th style="width: 10%">CUT</th>
                <th style="width: 42%">Trámite</th>
                <th style="width: 15%">Fecha de Ingreso</th>
                <th style="width: 15%">Fecha de Respuesta</th>
                <th style="width: 18%">Estado actual</th>	
            </tr>
            <tr>
                <td><a href="#" onclick="obtener_auditoria(<?php echo $_GET["idtu"] ?>)" data-toggle="modal" data-target="#AuditoriaTramite"><span class="small"><?php echo $ttramite["tu_codigo"] ?></span></a></td>
                <td><?php echo $ttramite["tra_nombre"] ?></td>
                <td><?php echo $ttramite["tu_fecha_ingreso"] ?></td>
                <td><?php if($ttramite["tu_fecha_contestacion"]==NULL){echo "<span class='small'>EN PROCESO</span>";}else{echo $ttramite["tu_fecha_contestacion"];}; ?></td>
                <td><span class="small"><?php echo $ttramite["et_nombre"] ?></span></td>
            </tr>
        </table>
    </div>
</div>
