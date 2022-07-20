/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function validar_archivofe(cut){
    //alert(cut);
    $.ajax({
        type: "POST",
        url: "./ajax/verificar_archivofirmado.php",
        data: 'cut='+cut,
        success: function(datos){
            var resultado=datos.trim();
            if(resultado==="SI"){
                //alert("si guardo");
                $("#form_completarproceso").submit();
            };
            if(resultado==="NO"){
                alert("Error!: No puede completar el trámite mientras no firme electrónicamente la respuesta. Haga clic en el botón 'Recargar Página' para abrir el aplicativo de FirmaEc nuevamente.");
            };
            //$('#actualizar_datos').attr("disabled", false); //ACTIVAR BOTÓN DE ENVIAR
        } 
    });
    //return decision;
}

