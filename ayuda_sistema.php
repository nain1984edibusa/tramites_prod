<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Administrador";
$opcion="Ayuda del Sistema de Trámites";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./includes/functions.php");    
	
?>
	   
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            Bienvenido a esta sección, en la cual se muestran los diferentes manuales del sistema.
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 lead">
            <ol class="breadcrumb">
                <li><a href="<?php echo RUTA_BANDEJAS_UI;?>">Inicio</a></li>
                <li class="active"><?php echo $modulo?></li>
                <li class="active"><?php echo $opcion?></li>
            </ol>
        </div>
    </div>
</div>

<div class="container-fluid">
  <table width="700px">
   
    <tr>
      <td width="343"><a href="formatos\manualusuinterno.pdf" target="_blank"> <i class="zmdi zmdi-file"></i> Manual Usuario Interno</a></td>
    </tr>
    <tr>
      <td width="343"><a href="formatos\manualusuexterno.pdf" target="_blank"> <i class="zmdi zmdi-file"></i> Manual Usuario Externo</a></td>
    </tr>
      
    
   </table>
</div>
<?php
include_once("./includes/footer.php"); 

?>