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
$id_usuario = $_GET["idUser"];
$correoUsuario = $_GET['email'];

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
        <form class="form-login"  action="./controller/recupera_passwd.php" method="post">
            <div class="form-container-body form-bglight">
                
                <input type="hidden" id="idUsuario" name="idUsuario" value = "<?php echo $id_usuario?>">
                
            <?php include_once './includes/errores.php'; ?>
                <div class="group-material-login">
                    <input type="text" id="txtusu" name="txtusu" tabindex="1" disabled="true" class="material-login-control" required="" maxlength="70" value="<?php echo $correoUsuario?>">
                    <span class="highlight-login"></span>
                    <span class="bar-login"></span>
                    
                </div>
                <div class="group-material-login">
                    <input type="password" name="clave" class="material-login-control" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="" maxlength="70" title="Debe contener al menos 1 MAYÚSCULA, 1 minúscula, y números o carateres especiales (longitud mínima: 8)">
                    <span class="highlight-login"></span>
                    <span class="bar-login"></span>
                    <label><i class="zmdi zmdi-lock"></i> &nbsp; Contraseña</label>
                </div>
                <div class="group-material-login">
                    <input type="password" name="reclave" class="material-login-control" required="" maxlength="70">
                    <span class="highlight-login"></span>
                    <span class="bar-login"></span>
                    <label><i class="zmdi zmdi-lock"></i> &nbsp;Repita la Contraseña</label>
                </div>
                <!--<div class="group-material-login">
                    <select class="material-control-login" name="tipo_usuario">
                        <option value="" disabled="" selected="">Tipo de usuario</option>
                        <option value="UExterno">Usuario Externo</option>
                        <option value="UInterno">Usuario Interno</option>
                        <option value="UAdministador">Administrador</option>
                    </select>
                </div>-->
                
            </div>
            <div class="form-container-body form-bgmdark-bottom">
                <!--<button class="btn-login" type="submit">Ingresar al sistema &nbsp; <i class="zmdi zmdi-arrow-right"></i></button>-->
                <div class="row">
                    
                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn btn-primary"> Recuperar Contraseña &nbsp;&nbsp;<i class="zmdi zmdi-arrow-right"></i></button> 
                    </div>
                </div>
            </div>
        </form>
    </div>   
  </div>

<script type="text/javascript" src='./js/funciones_generales.js'></script>
<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript" src='./js/autocompletar_ubicacion.js'></script>
</body>

			
								
							
   


