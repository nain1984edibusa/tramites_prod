function previsualizar_respuesta(idtu){
    //$("#loader").fadeIn('slow');
    $.ajax({
        url:'./ajax/prev_respuesta_pdf.php?idtu='+idtu,
        beforeSend: function(objeto){
            //$('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            //alert(data);
            VentanaCentrada('./librerias/pdf/reportes/respuesta_tramite.php?datos='+data,'Respuesta','','1024','768','true');
            //$(".resultados").html(data).fadeIn('slow');
            //$('#loader').html('');
        }
    })
}
