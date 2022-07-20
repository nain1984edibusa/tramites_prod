<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Reportes y estadísticas";
$opcion="Inner Tabs";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
?>
<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li role="presentation" class='active'><a href="#bitacora" aria-controls="bitacora" role="tab" data-toggle="tab">Linea de Tiempo</a></li>
        <li role="presentation"><a href="#reports" aria-controls="reports" role="tab" data-toggle="tab">Reportes y fichas</a></li>
        <li role="presentation"><a href="#statistics" aria-controls="statistics" role="tab" data-toggle="tab">Estadísticas</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="bitacora">
            <div class="container-fluid descripcion-container">
                <div class="row">
                    <div class="col-xs-12 col-sm-2 col-md-2">
                        <img src="assets/img/user-sesion.png" alt="users-sesion" class="img-responsive center-box">
                    </div>
                    <div class="col-xs-12 col-sm-10 col-md-10 text-justify lead">
                        Bienvenido al área de bitácora, aquí se muestran los registros de los últimos 15 usuarios (personal administrativo, docentes, administradores y estudiantes) que han iniciado sesión en el sistema. Recuerda eliminar los registros de la bitácora cada año para que el sistema funcione correctamente.
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <section id="cd-timeline" class="cd-container">
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img">
                            <img src="assets/img/user01.png" alt="user-picture">
                        </div>
                        <div class="cd-timeline-content">
                            <h4 class="text-center">1 - Nombre (Administrador)</h4>
                            <p class="text-center">
                                <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Inicio: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                                <i class="zmdi zmdi-time zmdi-hc-fw"></i> Finalización: <em>7:17 AM</em>
                            </p>
                            <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2016</span>
                        </div>
                    </div>  
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img">
                            <img src="assets/img/user02.png" alt="user-picture">
                        </div>
                        <div class="cd-timeline-content">
                            <h4 class="text-center">2 - Nombre (Docente)</h4>
                            <p class="text-center">
                                <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Inicio: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                                <i class="zmdi zmdi-time zmdi-hc-fw"></i> Finalización: <em>7:17 AM</em>
                            </p>
                            <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2016</span>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img">
                            <img src="assets/img/user03.png" alt="user-picture">
                        </div>
                        <div class="cd-timeline-content">
                            <h4 class="text-center">3 - Nombre (Estudiante)</h4>
                            <p class="text-center">
                                <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Inicio: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                                <i class="zmdi zmdi-time zmdi-hc-fw"></i> Finalización: <em>7:17 AM</em>
                            </p>
                            <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2016</span>
                        </div>
                    </div>
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img">
                            <img src="assets/img/user05.png" alt="user-picture">
                        </div>
                        <div class="cd-timeline-content">
                            <h4 class="text-center">4 - Nombre (Personal Ad.)</h4>
                            <p class="text-center">
                                <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Inicio: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                                <i class="zmdi zmdi-time zmdi-hc-fw"></i> Finalización: <em>7:17 AM</em>
                            </p>
                            <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2016</span>
                        </div>
                    </div>   
                </section>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="statistics">
            <div class="container-fluid descripcion-container">
                <div class="row">
                    <div class="col-xs-12 col-sm-2 col-md-2">
                        <img src="assets/img/chart.png" alt="chart" class="img-responsive center-box">
                    </div>
                    <div class="col-xs-12 col-sm-10 col-md-10 text-justify lead">
                        Bienvenido al área de estadísticas, aquí puedes ver las diferentes estadísticas de los préstamos y libros.
                    </div>
                </div>
            </div>
            <div class="container-fluid">        
                <div class="page-header">
                  <h2 class="all-tittles subtitulo-pagina">préstamos <small>por sección</small></h2>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h3 class="text-center all-tittles encabezado-tabla">Título del reporte, datos del año 20xx</h3>
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr class="info">
                                        <th class="text-center">Sección</th>
                                        <th class="text-center">N. Préstamos</th>
                                        <th class="text-center">Porcentaje</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sección 1</td>
                                        <td>5</td>
                                        <td>50%</td>
                                    </tr>
                                    <tr class="danger">
                                        <td>Sección 2</td>
                                        <td>10</td>
                                        <td>10%</td>
                                    </tr>
                                    <tr class="warning">
                                        <td>Sección 3</td>
                                        <td>40</td>
                                        <td>40%</td>
                                    </tr>
                                    <tr>
                                        <td>Sección 4</td>
                                        <td>0</td>
                                        <td>0%</td>
                                    </tr>
                                    <tr>
                                        <td>Sección 5</td>
                                        <td>0</td>
                                        <td>0%</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="active">
                                        <th class="text-center">Total</th>
                                        <th class="text-center">0</th>
                                        <th class="text-center">0%</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <p class="lead text-center"><strong><i class="zmdi zmdi-info-outline"></i>&nbsp; ¡Importante!</strong> Para imprimir esta tabla ve a la sección de reportes y selecciona “Préstamos entregados (por sección)”</p>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="reports">
            <div class="container-fluid descripcion-container">
                <div class="row">
                    <div class="col-xs-12 col-sm-2 col-md-2">
                        <img src="assets/img/pdf.png" alt="pdf" class="img-responsive center-box">
                    </div>
                    <div class="col-xs-12 col-sm-10 col-md-10 text-justify lead">
                        Bienvenido al área de reportes, aquí puedes generar fichas de préstamos vacías de estudiantes, docentes o visitantes en formato pdf, también puedes generar reportes de inventario entre otros.
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="page-header">
                    <h2 class="all-tittles subtitulo-pagina">fichas <small>vacías</small></h2>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 opc-seleccionable">
                        <div class="full-reset report-content">
                            <p class="text-center">
                                <i class="zmdi zmdi-file-text zmdi-hc-5x"></i>
                            </p>
                            <h4 class="text-center opciones-box">Ficha estudiante</h4>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 opc-seleccionable">
                        <div class="full-reset report-content">
                            <p class="text-center">
                                <i class="zmdi zmdi-file-text zmdi-hc-5x"></i>
                            </p>
                            <h4 class="text-center opciones-box">Ficha docente</h4>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 opc-seleccionable">
                        <div class="full-reset report-content">
                            <p class="text-center">
                                <i class="zmdi zmdi-file-text zmdi-hc-5x"></i>
                            </p>
                            <h4 class="text-center opciones-box">Ficha personal administrativo</h4>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 opc-seleccionable">
                        <div class="full-reset report-content">
                            <p class="text-center">
                                <i class="zmdi zmdi-file-text zmdi-hc-5x"></i>
                            </p>
                            <h4 class="text-center opciones-box">Ficha visitante</h4>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <h2 class="all-tittles subtitulo-pagina">reportes <small>generales</small></h2>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 opc-seleccionable">
                        <div class="full-reset report-content">
                            <p class="text-center">
                                <i class="zmdi zmdi-trending-up zmdi-hc-5x"></i>
                            </p>
                            <h4 class="text-center opciones-box">Reporte General de Inventario</h4>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 opc-seleccionable">
                        <div class="full-reset report-content">
                            <p class="text-center">
                                <i class="zmdi zmdi-trending-up zmdi-hc-5x"></i>
                            </p>
                            <h4 class="text-center opciones-box">Reporte Libros por Categoría</h4>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 opc-seleccionable">
                        <div class="full-reset report-content">
                            <p class="text-center">
                                <i class="zmdi zmdi-trending-up zmdi-hc-5x"></i>
                            </p>
                            <h4 class="text-center opciones-box">Préstamos entregados (por usuarios)</h4>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 opc-seleccionable">
                        <div class="full-reset report-content">
                            <p class="text-center">
                                <i class="zmdi zmdi-trending-up zmdi-hc-5x"></i>
                            </p>
                            <h4 class="text-center opciones-box">Préstamos entregados (por sección)</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("./includes/footer.php"); ?>