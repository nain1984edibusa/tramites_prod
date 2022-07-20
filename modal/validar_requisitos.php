<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
?>
<div class="modal fade" tabindex="-1" role="dialog" id="ValidarRequisito">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center all-tittles">Validar Requisito</h4>
            </div>
            <form action="controller/validar_requisito.php" method="post">
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="group-material">
                            <input type="hidden" name="etu_codigo" id="etu_codigo" value=""/>
                            <input type="hidden" name="etu_id" id="etu_id" value=""/>
                            <input type="hidden" name="etur_id" id="etur_id" value=""/>
                            <input type="hidden" name="etra_id" id="etra_id" value=""/>
                            <input type="hidden" name="etu_convalidar" id="etu_convalidar" value=""/>
                            <span>Estado del requisito <span class="sp-requerido">*</span></span>
                            <select name="cumple" id="cumple" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elija una opción" required="">
                                <option value="" selected="">Selecciona una opción</option>
                                <option value="CORRECTO">Correcto</option>
                                <option value="INCORRECTO">Incorrecto</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="group-material">
                            <span>Observaciones<span class="sp-requerido"></span></span>
                            <textarea id="observaciones" name="observaciones" class="tooltips-general material-control" placeholder="Escriba las razones por las cuales el requisito no cumple los parámetros" data-toggle="tooltip" data-placement="top" title="Escriba las razones"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal"><i class="zmdi zmdi-close"></i> &nbsp; Cancelar</button>
                        </div>
                        <div class="col-xs-6 text-center">
                            <button type="submit" class="btn btn-success"><i class="zmdi zmdi-check-all"></i> &nbsp; Registrar Validación</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
