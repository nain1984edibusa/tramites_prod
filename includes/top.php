<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
?>
<div class="content-page-container full-reset custom-scroll-containers">
<nav class="navbar-user-top full-reset">
    <ul class="list-unstyled full-reset">
        <!--<figure>
           <img src="assets/img/user01.png" alt="user-picture" class="img-responsive img-circle center-box">
        </figure>-->
        <li  class="tooltips-general exit-system-button" data-href="logout.php" data-placement="bottom" title="Salir del sistema">
            <i class="zmdi zmdi-power"></i>
        </li>
        <li  class="tooltips-general btn-help" data-placement="bottom" title="Ayuda">
            <i class="zmdi zmdi-help-outline zmdi-hc-fw"></i>
        </li>
        <li class="tooltips-general info-user-button"  data-placement="bottom" title="Fecha del Sistema">
            <i class="zmdi zmdi-calendar-alt"></i>
            <span class="all-tittles infotop"><?php echo date("Y-m-d"); ?></span>
        </li>
        <li class="tooltips-general info-user-button" data-placement="bottom" title="Información del usuario">
            <a href="#" data-toggle="modal" data-target= "#infoCuenta">
            <i class="zmdi zmdi-account-o"></i>
            <span class="all-tittles infotop"><?php echo $_SESSION["nombre"];?> <i>(<?php echo $_SESSION["perfil"]; ?>)</i></span></a>
        </li>
        <!--<li  class="tooltips-general search-book-button" data-href="searchbook.html" data-placement="bottom" title="Buscar libro">
            <i class="zmdi zmdi-search"></i>
        </li>-->
        <li class="mobile-menu-button visible-xs" style="float: left !important;">
            <i class="zmdi zmdi-menu"></i>
        </li>
        <li class="desktop-menu-button hidden-xs" style="float: left !important;">
            <i class="zmdi zmdi-swap"></i>
        </li>
    </ul>
</nav>
<div class="container contenedor-principal">
    <div class="page-header">
        <h1 class="all-tittles miga-pan"><?php echo $modulo;?>&nbsp;&nbsp;<small><?php echo $opcion;?></small></h1>
    </div>