<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
?>
<div class="modal fade" tabindex="-1" role="dialog" id="ReasignarFirmarTramite">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="./controller/reasignar_tramite.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">Firmar y Reasignar Trámite</h4>
                </div>
                <div class="modal-body">
                    <p><strong>CUT: </strong><span id="cut_f"></span></p>
                    <input type="hidden" name="id_tu_r_f" id="id_tu_r_f"/>
                    <input type="hidden" name="cod_tra_f" id="cod_tra_f"/>
                    <input type="hidden" name="id_tra_f" id="id_tra_f"/>
                    <input type="hidden" name="firmar" id="firmar"/>
                    <div class="col-xs-12 col-sm-12">
                        <div class="group-material">
                            <span>Usuarios disponibles para reasignación <span class="sp-requerido">*</span></span>
                            <select name="reasignado_firmar_a" id="reasignado_firmar_a" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elija un profesional del listado" required="">         
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <div class="group-material">
                            <span>Observaciones</span>
                            <textarea name="observaciones_firmar_r" id="observacioens_firmar_r" class="tooltips-general material-control" placeholder="Incluir observaciones/indicaciones relevantes para el usuario que recibirá el trámite." maxlength="200" data-toggle="tooltip" data-placement="top"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal"><i class="zmdi zmdi-close"></i> &nbsp; Cancelar</button>
                        </div>
                        <div class="col-xs-6 text-center">
                            <button type="submit" class="btn btn-success"><i class="zmdi zmdi-border-color"></i> &nbsp; Firmar y Reasignar Trámite</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>