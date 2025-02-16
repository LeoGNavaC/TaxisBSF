$(document).ready(function() {
    $(document).on("click", ".editar-btn", function() {
        let id = $(this).data("id");
        $("#fila-" + id + " .editable").attr("contenteditable", "true").focus();
    });

    $(document).on("click", ".guardar-btn", function() {
        let id = $(this).data("id");
        let datos = {};

        $("#fila-" + id + " .editable").each(function() {
            let columna = $(this).data("columna");
            let valor = $(this).text();
            datos[columna] = valor;
        });

        datos["id"] = id;

        console.log("Datos enviados:", datos); // Debugging

        $.ajax({
            url: "tarifasAc.php",
            type: "POST",
            data: datos,
            dataType: "json", // IMPORTANTE: Especificar que esperamos un JSON
            success: function(respuesta) {
                console.log("Respuesta del servidor:", respuesta);
                
                if (respuesta.status === "success") {
                    alert(respuesta.message);
                    $("#fila-" + id + " .editable").attr("contenteditable", "false");
                } else {
                    alert("Error: " + respuesta.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en AJAX:", error);
                alert("Error en la solicitud AJAX");
            }
        });
    });
});
