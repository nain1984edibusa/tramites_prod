<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Catálogo";
$opcion="Trámites y Formatos";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
/*incluir modelo(s)*/
include_once("./modelo/Config.class.php");
include_once("./modelo/Db.class.php");
include_once("./modelo/clstramites.php");
/*Listado de todos los trámites ordenados por el campo ct_orden*/
$listado_tramites = new cl_tramites();
$tramites=$listado_tramites->tra_seleccionar_all();
?>
<div class="container-fluid">
    <div class="row">
        <!--<div class="col-xs-12 col-sm-2 col-md-2">
            <img src="assets/img/checklist.png" alt="pdf" class="img-responsive center-box">
        </div>-->
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            Bienvenido al catálogo de trámites del Instituto Nacional de Patrimonio Cultural. Aquí encontrará un listado de requisitos (y sus formatos) que deberán cargarse en la plataforma según el trámite seleccionado, así como la opción para iniciar un nuevo trámite.
        </div>
    </div>
</div>
<div class="container-fluid">
    <form class="col-md-8" style="" autocomplete="off">
        <div class="group-material buscador_unico">
            <input type="search" style="display: inline-block !important; width: 50%;" class="material-control tooltips-general" placeholder="Buscar trámite" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚ ]{1,50}" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe el código del trámite o parte de su nombre">
            <button class="btn" style="margin: 0; height: 43px; background-color: transparent !important;">
                <i class="zmdi zmdi-search" style="font-size: 25px;"></i>
            </button>
        </div>
    </form>
</div>
<!--<div class="container-fluid">
    <div class="page-header">
        <h2 class="all-tittles subtitulo-pagina" >Listado de Trámites</h2>
    </div>
</div>-->
<!--<div class="container-fluid">
    <ul class="list-unstyled text-center list-catalog-container">
        <li class="list-catalog">Categoría</li>
        <li class="list-catalog">Categoría</li>
        <li class="list-catalog">Categoría</li>
    </ul>
</div>-->
<div class="container-fluid">
    <?php while($row= mysqli_fetch_array($tramites)): ?>
        <div class="media media-hover listado_especial">
            <div class="media-left media-middle">
                <!--<a href="#!" class="tooltips-general" data-toggle="tooltip" data-placement="right" title="Más información">
                  <img class="media-object" src="assets/img/book.png" alt="Libro" width="48" height="48">
                </a>-->
            </div>
            <div class="media-body">
                <div class="col-md-12 nopaddlr">
                    <h4 class=" media-heading tlistado_especial nopaddlr"><?php echo $row["tra_orden"];?>) <?php echo $row["tra_nombre"];?></h4>
                </div>
                <div class="col-xs-12 col-md-5 txt-resultados nopaddlr">
                    <span class='small'><strong>CÓDIGO: </strong><?php echo $row["tra_codigo"];?></span>
                    <!--<span class="label label-<?php //echo($row["tra_estado"]=="ACTIVO")? "success": "danger";?>"><?php //echo $row["tra_estado"];?></span>-->
                </div>
                <!--<div class="col-xs-12 col-md-5 txt-resultados nopaddlr">
                    <p><?php //echo $row["tra_descripcion"]?></p>
                    <p><strong>¿Qué obtendré si completo satisfactoriamente el trámite?</strong><br><?php //echo $row["tra_resultado"]?></p>
                </div>-->
                <div class="col-xs-12 col-md-7 nopaddlr">
                    <p class="text-center pull-right">
                        <a href="#!" class="btn btn-light btn-xs"><i class="zmdi zmdi-time-countdown"></i> <?php echo $row["tra_tiempo"]?> días laborables</a>
                        <button data-toggle="modal" data-target="#ModalCatTraInformacion" onclick="mostrar_informacion('<?php echo contenido_informacion_tramite($row["tra_nombre"],$row["tra_descripcion"],$row["tra_resultado"]) ?>','tinformacion','dinformacion')" class="btn btn-info btn-xs"><i class="zmdi zmdi-info"></i> Información</button>
                        <button data-toggle="modal" data-target="#ModalCatTraRequisitos" onclick="cargar_requisitos('<?php echo $row["tra_nombre"];?>','<?php echo $row["tra_id"];?>','tinformacion','dinformacion')" class="btn btn-info btn-xs"><i class="zmdi zmdi-collection-text"></i> Requisitos y Formatos</button>
                        <?php if($row["tra_estado"]=="ACTIVO"){?>
                            <a href="ue_formularios_tramites.php?idt=<?php echo $row["tra_id"]?>" class="btn btn-primary btn-xs"><i class="zmdi zmdi-arrow-right"></i> Iniciar Trámite</a>
                        <?php }else{?>
                            <button data-toggle="modal" data-target="#ModalCatTraNoDisponible"  class="btn btn-light btn-xs"><i class="zmdi zmdi-long-arrow-tab" ></i> No disponible</button>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<?php 
function contenido_informacion_tramite($titulo,$descripcion,$resultado){
    $res= "<h5>".$titulo."</h5>";
    $res.= "<p>".$descripcion."</p>";
    $res.="<p><strong>¿Qué obtendré si completo satisfactoriamente el trámite?</strong><br>".$resultado.'</p>';
    return $res;
}
?>
<script type="text/javascript" src="./js/catalogo_tramites.js">
</script>
<?php include_once("./includes/footer.php"); ?>
<?php include_once("./modal/catalogo_tramites_informacion.php");?>
<?php include_once("./modal/catalogo_tramites_requisitos.php");?>
<?php include_once("./modal/catalogo_tramites_nodisponible.php");?>
