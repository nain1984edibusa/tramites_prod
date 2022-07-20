<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Bandeja de Trámites";
$opcion="En Elaboración";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            Bienvenido a esta sección, en la cual se muestran todos los trámites en elaboración: <strong>no enviados, ni en proceso de revisión</strong>.
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 lead">
            <ol class="breadcrumb">
                <li><a href="<?php echo RUTA_BANDEJAS_UE;?>">Inicio</a></li>
                <li class="active"><?php echo $modulo?></li>
                <li class="active"><?php echo $opcion?></li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="alert alert-info alert-dismissible" role="alert">
        <strong>Importante:</strong> Tiene <strong class="navm_bandeja_elaboracion"></strong> trámites en elaboración; complete el trámite y envíelo para iniciar su revisión.						
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<div class="container-fluid">
    <form class="col-md-8" style="" autocomplete="off">
        <div class="group-material">
            <input type="search" style="display: inline-block !important; width: 50%;" class="material-control tooltips-general" placeholder="Buscar trámite" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚ ]{1,50}" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe el código único del trámite">
            <button class="btn" style="margin: 0; height: 43px; background-color: transparent !important;">
                <i class="zmdi zmdi-search" style="font-size: 25px;"></i>
            </button>
        </div>
    </form>
    <div class="col-md-4 text-right">
        <p class="subtitulo-inner text-right">Enlaces de Descarga</p>
        <ul class=''>
            <a href="#" data-toggle="tooltip" data-placement="top" title="Versión PDF"><img class="icono-descarga" src='./assets/icons/pdf.png'/></a>
            <a href="#" data-toggle="tooltip" data-placement="top" title="Versión Hojas de Cálculo"><img class="icono-descarga" src='./assets/icons/excel.png'/></a>
        </ul>
    </div>
</div>
<div class="container-fluid">
    <!--<h3 class="text-center all-tittles encabezado-tabla">Listado de devoluciones pendientes</h3>-->
    <div class="outer_div">			
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="info">
                        <th style="width: 5%">Cod</th>
                        <th style="width: 60%">Trámite</th>
                        <th style="width: 10%">Fecha de Registro</th>
                        <th style="width: 10%">Fecha de Modificación</th>
                        <th style="width: 5%">% de Ingreso</th>
                        <th style="width: 10%;" class="text-right">Acciones</th>	
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>AS2321</td>
                        <td>Autorización de salida de fragmentos o pequeñas muestras arqueológicas o paleontológicas del Patrimonio Cultural</td>
                        <td>2020/03/14</td>
                        <td>2020/03/21</td>
                        <td>70%</td>					
                        <td class="text-right">
                            <a href="#" class='btn btn-default' title='Editar' onclick="reimprimir('');"><i class="zmdi zmdi-edit"></i></a>
                            <a href="#" class='btn btn-default' title='Dar de baja' onclick="reimprimir('');"><i class="zmdi zmdi-delete"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>AI5321</td>
                        <td>Autorización para investigaciones arqueológicas o paleontológicas del Patrimonio Cultural</td>
                        <td>2020/03/11</td>
                        <td>2020/03/20</td>
                        <td>40%</td>					
                        <td class="text-right">
                            <a href="#" class='btn btn-default' title='Editar' onclick="reimprimir('');"><i class="zmdi zmdi-edit"></i></a>
                            <a href="#" class='btn btn-default' title='Dar de baja' onclick="reimprimir('');"><i class="zmdi zmdi-delete"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>AS5321</td>
                        <td>Autorización de salida de fragmentos o pequeñas muestras arqueológicas o paleontológicas del Patrimonio Cultural</td>
                        <td>2020/03/05</td>
                        <td>2020/03/20</td>
                        <td>50%</td>					
                        <td class="text-right">
                            <a href="#" class='btn btn-default' title='Editar' onclick="reimprimir('');"><i class="zmdi zmdi-edit"></i></a>
                            <a href="#" class='btn btn-default' title='Dar de baja' onclick="reimprimir('');"><i class="zmdi zmdi-delete"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>AS5322</td>
                        <td>Autorización de salida de fragmentos o pequeñas muestras arqueológicas o paleontológicas del Patrimonio Cultural</td>
                        <td>2020/02/28</td>
                        <td>2020/03/01</td>
                        <td>20%</td>
                        <td class="text-right">
                            <a href="#" class='btn btn-default' title='Editar' onclick="reimprimir('');"><i class="zmdi zmdi-edit"></i></a>
                            <a href="#" class='btn btn-default' title='Dar de baja' onclick="reimprimir('');"><i class="zmdi zmdi-delete"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>RP5321</td>
                        <td>Registro de Profesionales en el ámbito del Patrimonio Cultural</td>
                        <td>2020/02/28</td>
                        <td>2020/03/01</td>
                        <td>15%</td>
                        <td class="text-right">
                            <a href="#" class='btn btn-default' title='Editar' onclick="reimprimir('');"><i class="zmdi zmdi-edit"></i></a>
                            <a href="#" class='btn btn-default' title='Dar de baja' onclick="reimprimir('');"><i class="zmdi zmdi-delete"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>RP5331</td>
                        <td>Registro de Profesionales en el ámbito del Patrimonio Cultural</td>
                        <td>2012/12/20</td>
                        <td>2020/03/01</td>
                        <td>25%</td>
                        <td class="text-right">
                            <a href="#" class='btn btn-default' title='Editar' onclick="reimprimir('');"><i class="zmdi zmdi-edit"></i></a>
                            <a href="#" class='btn btn-default' title='Dar de baja' onclick="reimprimir('');"><i class="zmdi zmdi-delete"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>RP5321</td>
                        <td>Registro de Profesionales en el ámbito del Patrimonio Cultural</td>
                        <td>2012/12/10</td>
                        <td>2020/02/01</td>
                        <td>10%</td>
                        <td class="text-right">
                            <a href="#" class='btn btn-default' title='Editar' onclick="reimprimir('');"><i class="zmdi zmdi-edit"></i></a>
                            <a href="#" class='btn btn-default' title='Dar de baja' onclick="reimprimir('');"><i class="zmdi zmdi-delete"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php include_once("./includes/paginador.php"); ?>
        </div>
    </div>
</div>
<?php include_once("./includes/footer.php"); ?>