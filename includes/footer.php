<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once("./modal/ayuda.php");
?>
</div>
        <footer class="footer full-reset"> <!---- navbar navbar-fixed-bottom-->
            <div class="container-fluid">
                <div class="nav-lateral-divider-dark full-reset"></div>
                <div class="row bg-bandera">
					<div class="col-xs-12 col-sm-2">
					</div>
                    <div class="col-xs-12 col-sm-5">
                        <!--<h4 class="all-tittles">Acerca de</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam quam dicta et, ipsum quo. Est saepe deserunt, adipisci eos id cum, ducimus rem, dolores enim laudantium eum repudiandae temporibus sapiente.
                        </p>-->
                        <figure>
                            <img src="assets/img/pie-pagins.png" alt="Gobierno de la Pepública del Ecuador" class="img-responsive center-box logogr">
                        </figure>
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <!--<h4 class="all-tittles">Desarrollador</h4>-->
                        <ul class="list-unstyled">
                            <li></i>Av. Colón Oe1-93 y Av 10 de agosto</li>
                            <li></i>Quito - Ecuador</li>
                            <li></i>Teléfono: (593) 2227 927 / 2549 257 / 2227 969 / 2543 527</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright full-reset all-tittles">© 2020 INSTITUTO NACIONAL DE PATRIMONIO CULTURAL</div>
        </footer>
    </div>
<script type="text/javascript">
$(document).ready(function() {	
    var rep=0;
    obtener_contadores_bandejas();
    function obtener_contadores_bandejas() {
        $.ajax({
            type: "POST",
            url: "ajax/obtener_contadores_bandejas.php",
            dataType: 'json',
            success: function(data) {
                var conten=data;
                //alert(data);
                $('.navm_bandeja_elaboracion').html(conten[0].bandeja_elaboracion);
                $('.navm_bandeja_recibidos').html(conten[0].bandeja_validacion);
                $('.navm_bandeja_recibidos_d').html(conten[0].bandeja_validacion_d);
                $('.navm_bandeja_recibidos_w').html(conten[0].bandeja_validacion_w);
                $('.navm_bandeja_revision').html(parseInt(conten[0].bandeja_analisis)+parseInt(conten[0].bandeja_contestados_revision));
                $('.navm_bandeja_revision_d').html(parseInt(conten[0].bandeja_analisis_d)+parseInt(conten[0].bandeja_contestados_revision_d));
                $('.navm_bandeja_revision_w').html(parseInt(conten[0].bandeja_analisis_w)+parseInt(conten[0].bandeja_contestados_revision_w));
                $('.navm_bandeja_enviados').html(parseInt(conten[0].bandeja_validacion)+parseInt(conten[0].bandeja_analisis)+parseInt(conten[0].bandeja_contestados_revision));
                $('.navm_bandeja_convalidacion').html(conten[0].bandeja_convalidacion);
                $('.navm_bandeja_convalidacion_d').html(conten[0].bandeja_convalidacion_d);
                $('.navm_bandeja_convalidacion_w').html(conten[0].bandeja_convalidacion_w);
                /*$('.navm_bandeja_contestados_revision').html(conten[0].bandeja_contestados_revision);
                $('.navm_bandeja_contestados_revision_d').html(conten[0].bandeja_contestados_revision_d);
                $('.navm_bandeja_contestados_revision_w').html(conten[0].bandeja_contestados_revision_w);*/
                $('.navm_bandeja_contestados').html(conten[0].bandeja_contestados);
                
                var ttramites=parseInt(conten[0].bandeja_validacion)+parseInt(conten[0].bandeja_analisis)+parseInt(conten[0].bandeja_convalidacion)+parseInt(conten[0].bandeja_contestados_revision);
                //alert(ttramites);
                <?php if(($_SESSION["alertas_usuario"]=="on")){?>
                    if((ttramites>0)&&(rep==0)){
                        swal({
                            title: "Atención!!",
                            text: "Tienes "+ttramites+" trámites pendientes de validación/análisis/contestación en tus bandeja.",
                            type: "warning",
                            confirmButtonText: "Aceptar",
                        });
                    }
                    rep=1;
                <?php }
                $_SESSION["alertas_usuario"]="off";
                ?>
            }
        });
    }
    setInterval(obtener_contadores_bandejas, 15000);
});
</script>
</body>
</html>
