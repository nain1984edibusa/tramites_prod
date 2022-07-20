/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$(function() {
    $('#login-form-link').click(function(e) {
    	$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});

$('#ModalOlvidoPass').on('shown.bs.modal', 
    function (e) { 
    $(this).find('form[data-toggle=validator]').validator() ;
        //PROCESO DE ENVIO DE CLAVE Y MENSAJE 
        $('#ModalOlvidoPass').modal('hide');
    }
);

