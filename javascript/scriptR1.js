//pide los datos para obtener los conductores
$(document).ready(function() {
    $.ajax({
        url: "registroAc1.php",
        type: "GET",
        dataType: "json",
        success: function(respuesta) {
            //console.log("Choferes: ", respuesta);
            let select = $("#select-conductores");
            select.empty(); //Se limpia el select
            select.append('<option value="">CONDUCTOR</option>');
            respuesta.forEach(function(conductor) {
                select.append(`<option value="${conductor.id}" data-unidad="${conductor.unidad}">${conductor.nombre}</option>`);
            });
        },
        error: function(xhr, status, error) {
            console.error("Error al obtener los conductores:", error.responseText);
        }
    });

    //Para detectar si hay un cambio en el select
    $("#select-conductores").change(function() {
        let unidad  = $(this).find(":selected").data("unidad");//obtenemos la unidad del conductor
        $("#unidad-conductor").text(unidad ? unidad : "N/A");//mostramos la unidad
    });
});