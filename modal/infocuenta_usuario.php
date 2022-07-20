<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once './modelo/clsusuarios.php';
 $objUsuario = new clsusuarios();
 $objUsuario->setUsu_id($_SESSION["codusuario"]);
 $resultadoUsuario = mysqli_fetch_array($objUsuario->usu_seleccionar_byid());
 

?>

<div class="modal fade" tabindex="-1" role="dialog" id="infoCuenta">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="actualiza_usuarios.php" autocomplete="off">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">Información de la Cuenta</h4>
                </div>
                </br>
                <div class="modal-body">
                    
                    <div class="row">
                        
                        
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                
                                 <input id="tipo_identificacion" name="tipo_identificacion" type="text" value="<?php echo $resultadoUsuario["usu_tidentificador"]?>" disabled="true" class="tooltips-general material-control"> 
                                 <label>Tipo de Identificación <span class="sp-requerido">*</span></label>
                                <!--
                                
                                <span>Tipo de identificación <span class="sp-requerido">*</span></span>
                                <select id="tipo_identificacion" name="tipo_identificacion" class="tooltips-general material-control" data-toggle="tooltip" required="true" data-placement="top">
                                    <option value="" disabled="" selected="">Selecciona una opción</option>
                                    <option value="CI">CI</option>
                                    <option value="RUC">RUC</option>
                                    <option value="PASAPORTE">Pasaporte</option>
                                </select> -->
                                <label>Tipo de Identificación </label>
                            </div>
                            
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="identificacion" name="identificacion" type="text" value="<?php echo $resultadoUsuario["usu_identificador"]?>" disabled="true" class="tooltips-general material-control" placeholder="Por ejemplo: 0603487656" required="" maxlength="70" data-toggle="tooltip" data-placement="top"  onKeyUp="this.value = this.value.toUpperCase();"><!--title="Escriba su número de identificación"-->
                                
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Identificación </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="nombres" name="nombres" type="text" value="<?php echo $resultadoUsuario["usu_nombre"]?>" disabled="true" class="tooltips-general material-control" placeholder="Por ejemplo: Carlos Manuel" required="" maxlength="70" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus nombres completos"--> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombres </label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="apellidos" name="apellidos" type="text" value="<?php echo $resultadoUsuario["usu_apellido"]?>" disabled="true" class="tooltips-general material-control" placeholder="Por ejemplo: Silva Cuadrado" required="" maxlength="50" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus apellidos completos"--> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Apellidos </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input type="text" value="<?php echo $resultadoUsuario["pro_nombre"]?>" disabled="true" class="tooltips-general material-control" placeholder="Por ejemplo: Cotopaxi" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione su provincia de residencia" onKeyUp="this.value = this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Provincia </label>
                                
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input type="text"  value="<?php echo $resultadoUsuario["can_nombre"]?>" disabled="true" class="tooltips-general material-control" placeholder="Por ejemplo: Latacunga" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione su cantón de residencia" onKeyUp="this.value = this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Cantón </label>                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input type="text" value="<?php echo $resultadoUsuario["par_nombre"]?>" disabled="true" class="tooltips-general material-control" placeholder="Por ejemplo: Juan Montalvo" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione su parroquia de residencia" onKeyUp="this.value = this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Parroquia </label>                                
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="mod_telefono" name="mod_telefono" type="text" value="<?php echo $resultadoUsuario["usu_telefono"]?>" disabled="true" class="tooltips-general material-control" placeholder="Ej: 0999979648 / 032956765" minlength="9" maxlength="10" data-toggle="tooltip" data-placement="top" onkeypress="return valida_solonumeros(event)">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Teléfono</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="group-material">
                                <input type="text" value="<?php echo $resultadoUsuario["usu_direccion"]?>" disabled="true" class="material-control tooltips-general" placeholder="Por ejemplo: Benalcázar 2340 y 9 de Octubre" required="" maxlength="100" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba la dirección de su domicilio" -->
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Dirección </label>
                            </div>
                        </div>                  
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="group-material">
                                <input id="email" name="email" type="text" value="<?php echo $resultadoUsuario["usu_correo"]?>" disabled="true" class="material-control tooltips-general" required="" placeholder="Por ejemplo: abc@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" data-toggle="tooltip" data-placement="top" title="Escriba un correo personal al cual recibir el email de activación de su cuenta">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Correo Electrónico </label>
                            </div>
                        </div>                  
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="group-material">
                                <input id="tipoToken" name="tipoToken" type="text" value="<?php echo $_SESSION["certificado"]?>" disabled="true" class="material-control tooltips-general" required="" placeholder="Por ejemplo: abc@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" data-toggle="tooltip" data-placement="top" title="Escriba un correo personal al cual recibir el email de activación de su cuenta">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Tipo Certificado </label>
                            </div>
                        </div>                  
                    </div>
                    <div class="row" id="alert_clave"></div>
                    
                  
                    
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <button  class="btn btn-secondary" data-dismiss="modal"><i class="zmdi zmdi-close"></i> &nbsp; Cancelar</button>
                        </div>
                        <div class="col-xs-6 text-center">
                            <button type="submit" id="btn_registrarse" class="btn btn-success"><i class="zmdi zmdi-account-add"></i> &nbsp; Actualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
