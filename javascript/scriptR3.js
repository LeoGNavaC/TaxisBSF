$(document).ready(function () {
    $("#form-registro").submit(function (e) {
        e.preventDefault(); // Evita que se recargue la página

        // Capturar los valores del formulario
        let datos = {
            fecha: $("#txtfecha").val(),
            formaPago: $("#fopa").val(),
            accion: $("#txtaccion").val(),
            accionNombre: $("#txtaccionnom").val(),
            soloLlamadas: $("#txtsollama").val(),
            origen: $("#txtorigen").val(),
            destino: $("#txtdestino").val(),
            colonia: $("#txtcolonia").val(),
            km: $("#txtkm").val(),
            sumaTotal: $("#sumaTotal").val(),
            comentario: $("#txtcomentario").val(),
            seleccionConductores: $("#select-conductores").val(),
            unidadConductores: $("#unidad-conductor").val()
        };

        console.log("Datos enviados:", JSON.stringify(datos)); // Verifica en la consola

        $.ajax({
            url: "registroAg1.php",
            type: "POST",
            data: datos,
            dataType: "json",
            success: function (respuesta) {
                console.log("Respuesta del servidor:", respuesta);
                $("#mensaje").text(respuesta.message);
                if (respuesta.status === "success") {
                    alert("Datos guardados correctamente");
                    location.reload(); // Recarga la página después de guardar
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en AJAX:", xhr.responseText);
                $("#mensaje").text("Error en la inserción");
            }
        });
    });
});