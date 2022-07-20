<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
?>
<div class="modal fade" tabindex="-1" role="dialog" id="ConvalidarTramite">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="./controller/convalidar_tramite.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">Convalidar Trámite</h4>
                </div>
                <div class="modal-body">
                    <p><strong>CUT: </strong><span id="ccut"></span></p>
                    <input type="hidden" name="cid_tu_r" id="cid_tu_r"/>
                    <input type="hidden" name="ccod_tra" id="ccod_tra"/>
                    <input type="hidden" name="cid_tra" id="cid_tra"/>
                    <input type="hidden" name="reg_id" id="reg_id"/>
                    <div class="col-xs-12 col-sm-12">
                        <div class="group-material">
                            <span>Observaciones adicionales</span>
                            <textarea name="observaciones_c" id="observaciones_c" class="tooltips-general material-control" placeholder="Incluir observaciones/indicaciones relevantes para el usuario que recibirá el trámite." maxlength="200" data-toggle="tooltip" data-placement="top"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal"><i class="zmdi zmdi-close"></i> &nbsp; Cancelar</button>
                        </div>
                        <div class="col-xs-6 text-center">
                            <button type="submit" class="btn btn-success"><i class="zmdi zmdi-rotate-ccw"></i> &nbsp; Convalidar Trámite</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>