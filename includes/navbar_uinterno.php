<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
?>
<li><a href="ui_home.php"><i class="zmdi zmdi-home zmdi-hc-fw"></i>Inicio</a></li>
<!--<li><a href="formulario_aut_sal_fra.php"><i class="zmdi zmdi-file-plus zmdi-hc-fw"></i>Nuevo Trámite</a></li>-->
<li>
    <div class="dropdown-menu-button"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>Bandeja de Trámites <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
    <ul class="list-unstyled">
        <?php if($_SESSION["codperfil"]==ASIGNADOR){?>
            <li><a href="ui_bandeja_recibidos.php"><i class="zmdi zmdi-edit zmdi-hc-fw"></i>Recibidos <span class="label label-info pull-right label-mhover navm_bandeja_recibidos"></span></a></li>
        <?php } 
            if (($_SESSION["codperfil"]==EJECUTOR)||($_SESSION["codperfil"]==APROBADOR)){
        ?>
            <li><a href="ui_bandeja_revision.php"><i class="zmdi zmdi-eye zmdi-hc-fw"></i>En Revisión <span class="label label-warning pull-right label-mhover navm_bandeja_revision"></span></a></li>
        <?php } 
            if (($_SESSION["codperfil"]==ASIGNADOR)||($_SESSION["codperfil"]==EJECUTOR)){
        ?>
            <li><a href="ui_bandeja_convalidacion.php"><i class="zmdi zmdi-assignment-return zmdi-hc-fw"></i>En subsanación <span class="label label-danger pull-right label-mhover navm_bandeja_convalidacion"></span></a></li>
        <?php } 
            if($_SESSION["codperfil"]==APROBADOR){
        ?> 
            <li><a href="ui_bandeja_contestados.php"><i class="zmdi zmdi-assignment-check zmdi-hc-fw"></i>Enviados/contestados <span class="label label-success pull-right label-mhover navm_bandeja_contestados"></span></a></li>
        <?php } ?>    
    </ul>
</li>
<li><a href="reportes.php"><i class="zmdi zmdi-trending-up zmdi-hc-fw"></i>Reportes y estadísticas</a></li>
<li><a href="actualiza_usuarios.php" ><i class="zmdi zmdi-settings zmdi-hc-fw"></i>Configuración de la Cuenta</a></li>
<li><a href="ayuda_sistema.php"><i class="zmdi zmdi-help-outline zmdi-hc-fw"></i>Ayuda del Sistema</a></li>