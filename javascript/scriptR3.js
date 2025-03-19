$(document).ready(function () {
    $("#form-registro").submit(function (e) {
        e.preventDefault();

        // Capturamos los valores correctamente
        let select_conductoresJS = $("#select-conductores").val(); // ID del conductor
        let unidad_conductorJS = $("#unidad-conductor").text(); // Texto de la unidad

        // Verificar qué datos se están enviando
        console.log("Datos enviados:", {
            conductor: select_conductoresJS,
            unidad: unidad_conductorJS
        });

        $.ajax({
            url: "registroAg1.php",
            type: "POST",
            data: {
                fecha: $("#txtfecha").val(),
                formaPago: $("#fopa").val(),
                accion: $("#accion").val(),
                accionNombre: $("#nombre-socio").val(),
                soloLlamadas: $("#txtsollama").val(),
                origen: $("#txtorigen").val(),
                destino: $("#txtdestino").val(),
                colonia: $("#txtcolonia").val(),
                tag: $("#sttag").val(),
                km: $("#txtkm").val(),
                horasex: $("#txthoex").val(),
                sumaTotal: $("#sumaTotal").val(),
                comentario: $("#txtcomentario").val(),
                seleccionConductores: select_conductoresJS, // ID del conductor
                unidadConductores: unidad_conductorJS // Texto de la unidad
            },
            dataType: "json",
            success: function (respuesta) {
                console.log("Respuesta del servidor:", respuesta);
                if (respuesta.status === "success") {
                    alert("Datos guardados correctamente");
                    location.reload();
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en AJAX:", xhr.responseText);
            }
        });
    });
});
