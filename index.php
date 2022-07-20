<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="INPC";
$opcion="Portal de trámites";
//INCLUIR CLASES
include_once("./config/variables.php");
include_once("./includes/header.php");
if(isset($_COOKIE['usu_tinpc'])){
    //echo "si tengo cookies";
    //header("Location:controller/login.php");
}else{
    //echo "no tengo cookies";
}
?>
<div class="login-container full-cover-background">
    <div class="form-container">
        <div class="form-bgdark">
            <figure>
                <img src="assets/img/logotipo.png" alt="INPC" class="img-responsive center-box logotipo">
            </figure>
        </div>
        <div class="tel-index">
            <h4 class="text-center all-tittles titulo-login">Trámites en línea</h4>
        </div>
        <form class="form-login"  action="controller/login.php" method="post">
            <div class="form-container-body form-bglight">  
            <?php include_once './includes/errores.php'; ?>
                <div class="group-material-login">
                    <input type="text" id="txtusu" name="txtusu" tabindex="1" class="material-login-control" required="" maxlength="70">
                    <span class="highlight-login"></span>
                    <span class="bar-login"></span>
                    <label><i class="zmdi zmdi-account"></i> &nbsp; Usuario</label>
                </div>
                <div class="group-material-login">
                    <input type="password" name="txtcla" class="material-login-control" required="" maxlength="70">
                    <span class="highlight-login"></span>
                    <span class="bar-login"></span>
                    <label><i class="zmdi zmdi-lock"></i> &nbsp; Contraseña</label>
                </div>
                <!--<div class="group-material-login">
                    <select class="material-control-login" name="tipo_usuario">
                        <option value="" disabled="" selected="">Tipo de usuario</option>
                        <option value="UExterno">Usuario Externo</option>
                        <option value="UInterno">Usuario Interno</option>
                        <option value="UAdministador">Administrador</option>
                    </select>
                </div>-->
                <div class="group-material-login nopadd">
                    <div class="row">
                        <div class="col-xs-6 col-md-6 checkbox">
                            <input id="checkbox1" type="checkbox" name="remember" kl_vkbd_parsed="true">
                            <label for="checkbox1">Recuérdame</label> 
                        </div>
                        <div class="col-xs-6 col-md-6 text-right">
                            <a href="#" data-toggle="modal" data-target="#ModalOlvidoPass">Olvidó su contraseña?</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-container-body form-bgmdark-bottom">
                <!--<button class="btn-login" type="submit">Ingresar al sistema &nbsp; <i class="zmdi zmdi-arrow-right"></i></button>-->
                <div class="row">
                    <div class="col-xs-6 text-center">
                        <button type="reset" id="registrarse" class="btn btn-info" data-toggle="modal" data-target="#ModalRegistroUsuario"> Registrarse &nbsp;&nbsp; <i class="zmdi zmdi-account-add"></i></button>       
                    </div>
                    <div class="col-xs-6 text-center">
                        <button type="submit" class="btn btn-primary"> Ingresar &nbsp;&nbsp;<i class="zmdi zmdi-arrow-right"></i></button> 
                    </div>
                </div>
            </div>
        </form>
    </div>   
  </div>
<?php 
include_once('./modal/olvido_password.php'); 
include_once('./modal/registro_usuario.php'); 
include_once('./modal/acuerdo_responsabilidad.php'); 
?>
<script type="text/javascript" src='./js/funciones_generales.js'></script>
<script type="text/javascript" src='./js/index.js'></script>
<script type="text/javascript" src='./js/autocompletar_ubicacion.js'></script>
</body>
</html>
			
								
							
   


