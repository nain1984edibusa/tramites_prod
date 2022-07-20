<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$modulo="Usuario";
$opcion="Editar";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");

include_once("./modelo/Config.class.php");
include_once("./modelo/Db.class.php");
include_once './modelo/clsusuarios.php';
 $objUsuario = new clsusuarios();
 $objUsuario->setUsu_id($_SESSION["codusuario"]);
 $resultadoUsuario = mysqli_fetch_array($objUsuario->usu_seleccionar_byid());
 
?>
<div id="secc">
					
    <div id="sec_contedor">
	<form id="editar" action="controller/actualizar_usuario.php" autocomplete="off" method="POST">  
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                
                                 <input id="tipo_identificacion" name="tipo_identificacion" type="text" value="<?php echo $resultadoUsuario["usu_tidentificador"]?>" disabled="true" class="tooltips-general material-control" placeholder="Por ejemplo: Carlos Manuel" required="" maxlength="70" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> 
                                <!-- 
                                <select id="tipo_identificacion" name="tipo_identificacion" class="tooltips-general material-control" data-toggle="tooltip" required="true" data-placement="top">
                                    <option value="" disabled="" selected="">Selecciona una opción</option>
                                    <option value="CI">CI</option>
                                    <option value="RUC">RUC</option>
                                    <option value="PASAPORTE">Pasaporte</option>
                                </select> -->
                                <label>Tipo de Identificación <span class="sp-requerido">*</span></label>
                            </div>
                            <input id="tipoId" name="tipoId" type="hidden" value="<?php echo $resultadoUsuario["usu_tidentificador"]?>"  >
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="identificacion" name="identificacion" type="text" value="<?php echo $resultadoUsuario["usu_identificador"]?>" disabled="true" class="tooltips-general material-control" placeholder="Por ejemplo: 0603487656" required="" maxlength="70" data-toggle="tooltip" data-placement="top"  onKeyUp="this.value = this.value.toUpperCase();"><!--title="Escriba su número de identificación"-->
                                <input id="idUsuarioH" name="idUsuarioH" type="hidden" value="<?php echo $resultadoUsuario["usu_identificador"]?>">
                                <input id="id_rol" name="id_rol" type="hidden" value="<?php echo $resultadoUsuario["rol_id"]?>"  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Identificación <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="nombres" name="nombres" type="text" value="<?php echo $resultadoUsuario["usu_nombre"]?>" class="tooltips-general material-control" placeholder="Por ejemplo: Carlos Manuel" required="" maxlength="70" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus nombres completos"--> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombres <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="apellidosh" name="apellidosh" type="text" value="<?php echo $resultadoUsuario["usu_apellido"]?>" disabled="true" class="tooltips-general material-control" placeholder="Por ejemplo: Silva Cuadrado" required="" maxlength="50" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus apellidos completos"--> 
                                <input id="apellidos" name="apellidos" type="hidden" value="<?php echo $resultadoUsuario["usu_apellido"]?>"> <!--title="Escriba sus apellidos completos"--> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Apellidos <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="mod_provincia" name="mod_provincia" type="text" value="<?php echo $resultadoUsuario["pro_nombre"]?>" class="tooltips-general material-control" placeholder="Por ejemplo: Cotopaxi" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione su provincia de residencia" onKeyUp="this.value = this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Provincia <span class="sp-requerido">*</span></label>
                                <input type="hidden" name="id_provincia_mod" id="id_provincia_mod" value="<?php echo $resultadoUsuario["pro_id"]?>"/>
                                <input type="hidden" name="id_regional_mod" id="id_regional_mod" value="<?php echo $resultadoUsuario["reg_id"]?>"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="mod_canton" name="mod_canton" type="text"  value="<?php echo $resultadoUsuario["can_nombre"]?>" class="tooltips-general material-control" placeholder="Por ejemplo: Latacunga" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione su cantón de residencia" onKeyUp="this.value = this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Cantón <span class="sp-requerido">*</span></label>
                                <input type="hidden" name="id_canton_mod" id="id_canton_mod" value="<?php echo $resultadoUsuario["can_id"]?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="mod_parroquia" name="mod_parroquia" type="text" value="<?php echo $resultadoUsuario["par_nombre"]?>" class="tooltips-general material-control" placeholder="Por ejemplo: Juan Montalvo" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione su parroquia de residencia" onKeyUp="this.value = this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Parroquia <span class="sp-requerido">*</span></label>
                                <input type="hidden" name="id_parroquia_mod" id="id_parroquia_mod" value="<?php echo $resultadoUsuario["par_id"]?>"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="mod_telefono" name="mod_telefono" type="text" value="<?php echo $resultadoUsuario["usu_telefono"]?>" class="tooltips-general material-control" placeholder="Ej: 0999979648 / 032956765" minlength="9" maxlength="10" data-toggle="tooltip" data-placement="top" onkeypress="return valida_solonumeros(event)">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Teléfono</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="group-material">
                                <input id="direccion_mod" name="direccion_mod" type="text" value="<?php echo $resultadoUsuario["usu_direccion"]?>" class="material-control tooltips-general" placeholder="Por ejemplo: Benalcázar 2340 y 9 de Octubre" required="" maxlength="100" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba la dirección de su domicilio" -->
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Dirección <span class="sp-requerido">*</span></label>
                            </div>
                        </div>                  
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="group-material">
                                <input id="email" name="email" type="text" value="<?php echo $resultadoUsuario["usu_correo"]?>" class="material-control tooltips-general" required="" placeholder="Por ejemplo: abc@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" data-toggle="tooltip" data-placement="top" title="Escriba un correo personal al cual recibir el email de activación de su cuenta">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Correo Electrónico <span class="sp-requerido">*</span></label>
                            </div>
                        </div>                  
                    </div>
                    <div class="row" id="alert_clave"></div>
                    
                    <!--
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="clave" name="clave" type="password" value="<?php echo $resultadoUsuario["usu_contrasena"]?>" class="tooltips-general material-control" placeholder="Por ejemplo:ABcd12.5" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Debe contener al menos 1 MAYÚSCULA, 1 minúscula, y números o carateres especiales (longitud mínima: 8)">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Clave <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="reclave" name="reclave" type="password" value="<?php echo $resultadoUsuario["usu_contrasena"]?>" class="tooltips-general material-control" placeholder="Escriba aquí nuevamente su clave de ingreso (confirmación)" required="" maxlength="50" data-toggle="tooltip" data-placement="top">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Repetir clave <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                    </div>
                    -->
                    
                    <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-6" text-center">
                            <!--<button  class="btn btn-secondary" data-dismiss="modal"><i class="zmdi zmdi-close"></i> &nbsp; Cancelar</button> -->
                            <button type="submit" id="btn_registrarse" class="btn btn-success"><i class="zmdi zmdi-account-add"></i> &nbsp; Actualizar</button>
                        </div>
                     
                    </div>
                </div>
	</form>	
								
    </div> <!-- fin sec_contedor-->
</div><!-- fin secc 2-->
<script type="text/javascript" src='./js/autocompletar_ubicacion_update.js'></script>
