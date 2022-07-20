<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
session_start();
/*incluir modelo(s)*/
include_once("./modelo/Config.class.php");
include_once("./modelo/Db.class.php");
/*Conteo estado de trámites por estado*/

if(!isset($_SESSION['perfil'])){
    header('Location: ./index.php');
}
?>
<div class="navbar-lateral full-reset">
    <div class="visible-xs font-movile-menu mobile-menu-button"></div>
    <div class="full-reset container-menu-movile nav-lateral-scroll">
        <!--<div class="nav-lateral-divider full-reset"></div>-->
        <div class="full-reset container-logo">
            <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i> 
            <figure>
                <img src="assets/img/logotipo.png" alt="INPC" class="img-responsive inner-logo center-box logotipo">
            </figure>
            <!--<p class="text-center" style="padding-top: 15px;"></p>-->
        </div>
        <div class="nomsistema full-reset all-tittles">
            <?php echo NOMSISTEMA; ?>
        </div>
        <!--<div class="nav-lateral-divider full-reset"></div>-->
        <div class="full-reset nav-lateral-list-menu">
            <ul class="list-unstyled">
<?php
//echo $_SESSION["codperfil"];
if(($_SESSION["codperfil"]==APROBADOR)||($_SESSION["codperfil"]==EJECUTOR)||($_SESSION["codperfil"]==ASIGNADOR)){ //superadministrador
    include_once ("./includes/navbar_uinterno.php");
}elseif($_SESSION["codperfil"]==CIUDADANO){ //externo
    include_once ("./includes/navbar_uexterno.php");
}else{
?>
    <li><a href="ui_homeadmin.php"><i class="zmdi zmdi-home zmdi-hc-fw"></i>Inicio</a></li>
<!--<li><a href="formulario_aut_sal_fra.php"><i class="zmdi zmdi-file-plus zmdi-hc-fw"></i>Nuevo Trámite</a></li>-->
    <li>
        <div class="dropdown-menu-button"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>Administración de Tablas<i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
        <ul class="list-unstyled">
            <li><a href="admgenero.php"><i class="zmdi zmdi-edit zmdi-hc-fw"></i>Género<span class="label label-info pull-right label-mhover"></span></a></li>
            <li><a href="admroles.php"><i class="zmdi zmdi-edit zmdi-hc-fw"></i>Roles<span class="label label-warning pull-right label-mhover"></span></a></li>
            <li><a href="admasignadores.php"><i class="zmdi zmdi-edit zmdi-hc-fw"></i>Usuarios<span class="label label-danger pull-right label-mhover"></span></a></li>
            <li><a href="admtramites.php"><i class="zmdi zmdi-edit zmdi-hc-fw"></i>Trámites<span class="label label-success pull-right label-mhover"></span></a></li>
        </ul>
    </li>
    <li><a href="reportes.php"><i class="zmdi zmdi-trending-up zmdi-hc-fw"></i>Reportes y estadísticas</a></li>
    <li><a href="actualiza_usuarios.php" ><i class="zmdi zmdi-settings zmdi-hc-fw"></i>Configuración de la Cuenta</a></li>
    <li><a href="ayuda_sistema.php"><i class="zmdi zmdi-help-outline zmdi-hc-fw"></i>Ayuda del Sistema</a></li>                            
<?php 
}
?>
            </ul>
        </div>
    </div>
</div>
<?php include_once('./modal/infocuenta_usuario.php'); ?>

