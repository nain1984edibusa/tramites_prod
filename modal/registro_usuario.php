<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
?>

<div class="modal fade" tabindex="-1" role="dialog" id="ModalRegistroUsuario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="controller/registrar_usuario.php" autocomplete="off" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">Registro de Usuarios</h4>
                </div>
                </br>
                <div class="modal-body">
                    <p>Ingrese la información personal solicitada. El correo electrónico que registre le permitirá activar su cuenta, por lo tanto ingrese una cuenta de correo electrónico a la cual tenga acceso.</p>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <span>Tipo de identificación <span class="sp-requerido">*</span></span>
                                <select id="tipo_identificacion" name="tipo_identificacion" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" <!--title="Elija su tipo de indentificación"-->>
                                    <option value="" disabled="" selected="">Selecciona una opción</option>
                                    <option value="CI">CI</option>
                                    <option value="RUC">RUC</option>
                                    <option value="PASAPORTE">Pasaporte</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="identificacion" name="identificacion" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: 0603487656" required="" maxlength="70" data-toggle="tooltip" data-placement="top"  onKeyUp="this.value = this.value.toUpperCase();"><!--title="Escriba su número de identificación"-->
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Identificación <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="nombres" name="nombres" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Carlos Manuel" required="" maxlength="70" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus nombres completos"--> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombres <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="apellidos" name="apellidos" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Silva Cuadrado" required="" maxlength="50" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus apellidos completos"--> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Apellidos <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="provincia" name="provincia" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Cotopaxi" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione su provincia de residencia" onKeyUp="this.value = this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Provincia <span class="sp-requerido">*</span></label>
                                <input type="hidden" name="id_provincia" id="id_provincia"/>
                                <input type="hidden" name="id_regional" id="id_regional"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="canton" name="canton" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Latacunga" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione su cantón de residencia" onKeyUp="this.value = this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Cantón <span class="sp-requerido">*</span></label>
                                <input type="hidden" name="id_canton" id="id_canton"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="parroquia" name="parroquia" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Juan Montalvo" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione su parroquia de residencia" onKeyUp="this.value = this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Parroquia <span class="sp-requerido">*</span></label>
                                <input type="hidden" name="id_parroquia" id="id_parroquia"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="telefono" name="telefono" type="text" class="tooltips-general material-control" placeholder="Ej: 0999979648 / 032956765" minlength="9" maxlength="10" data-toggle="tooltip" data-placement="top" onkeypress="return valida_solonumeros(event)">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Teléfono</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="group-material">
                                <input id="direccion" name="direccion" type="text" class="material-control tooltips-general" placeholder="Por ejemplo: Benalcázar 2340 y 9 de Octubre" required="" maxlength="100" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba la dirección de su domicilio" -->
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Dirección <span class="sp-requerido">*</span></label>
                            </div>
                        </div>                  
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="group-material">
                                <input id="email" name="email" type="text" class="material-control tooltips-general" required="" placeholder="Por ejemplo: abc@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" data-toggle="tooltip" data-placement="top" title="Escriba un correo personal al cual recibir el email de activación de su cuenta">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Correo Electrónico <span class="sp-requerido">*</span></label>
                            </div>
                        </div>                  
                    </div>
                    <div class="row" id="alert_clave"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="clave" name="clave" type="password" class="tooltips-general material-control" placeholder="Por ejemplo:ABcd12.5" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Debe contener al menos 1 MAYÚSCULA, 1 minúscula, y números o carateres especiales (longitud mínima: 8)">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Clave <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="reclave" name="reclave" type="password" class="tooltips-general material-control" placeholder="Escriba aquí nuevamente su clave de ingreso (confirmación)" required="" maxlength="50" data-toggle="tooltip" data-placement="top">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Repetir clave <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <img src="./includes/captcha.php" alt="CAPTCHA" class="captcha-image">
                            <i class="zmdi zmdi-refresh-alt refresh-captcha"></i>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="txtcaptcha" name="txtcaptcha" class="tooltips-general material-control " required="" type="text" id="captcha" name="captcha_challenge" pattern="[A-Z]{6}" onKeyUp="this.value = this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label for="captcha">Captcha <span class="sp-requerido">*</span></label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 checkbox">
                            <div class="group-material">
                                <input id="checkbox2" required="" type="checkbox" name="remember" kl_vkbd_parsed="true">
                                <label for="checkbox2">Al registrarme, acepto el <a href="#" data-toggle="modal" data-target="#ModalAcuerdoResponsabilidad">acuerdo de responsabilidad</a></label> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal"><i class="zmdi zmdi-close"></i> &nbsp; Cancelar</button>
                        </div>
                        <div class="col-xs-6 text-center">
                            <button type="submit" disabled id="btn_registrarse" class="btn btn-success"><i class="zmdi zmdi-account-add"></i> &nbsp; Registrarse</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>