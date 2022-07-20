$(document).ready(function(){
    load(1);
});

function load(page){
    var q= $("#q").val();
    //$("#loader").fadeIn('slow');
    $.ajax({
        url:'./ajax/_ue_bandeja_convalidacion.php?action=ajax&page='+page+'&q='+q,
        beforeSend: function(objeto){
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $(".resultados").html(data).fadeIn('slow');
            $('#loader').html('');
        }
    })
}

