<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
?>
<script type="text/javascript" src='./js/funciones_generales.js'></script>
<div class="modal fade" tabindex="-1" role="dialog" id="ModalOlvidoPass">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="./controller/recuperar_passwd_email.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">Recuperación de Contraseña</h4>
                </div>
                <input type="hidden" id="banderaRecuperaCont" name="banderaRecuperaCont" value = "1">
                <div class="modal-body">
                    <p>Ingrese su correo electrónico de registro y haga clic en el botón "Recuperar clave". Le enviaremos a su e-mail instrucciones de como cambiar su contraseña.</p>
                    <input type="text" id="recuperaEmailInput" name="recuperaEmailInput" class="material-control" required="" placeholder="Escribe aquí tu correo electrónico" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="zmdi zmdi-close"></i> &nbsp; Cancelar</button>
                        </div>
                        <div class="col-xs-6 text-center">
                            <button type="submit" class="btn btn-success"><i class="zmdi zmdi-key" ></i> &nbsp; Recuperar Clave</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>