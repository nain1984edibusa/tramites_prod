<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Administrador";
$opcion="Inicio";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./includes/functions.php");

?>

<div class="descripcion-container">
    <div class="row">
        <div class="col-xs-12 col-sm-2 col-md-2">
            <img src="assets/img/bienvenida.png" alt="user" class="img-responsive center-box">
        </div>
        <div class="col-xs-12 col-sm-10 col-md-10 text-justify lead">
            <?php echo BIENVENIDAADMIN;?>
        </div>
    </div>
</div>
<?php
include_once("./includes/footer.php"); 
?>



