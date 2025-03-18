$(document).ready(function(){
    $(document).on("click", ".Editar-btn", function() {
        let id  = $(this).data("id");
        $("#fila-" + id + " .Editable").attr("contenteditable", "true").focus();
    });

    $(document).on("click", ".Guardar-btn", function() {
        let id  = $(this).data("id");
        let datos   = {};

        $("#fila-" + id + " .Editable").each(function() {
            let columna = $(this).data("columna");
            let valor   = $(this).text();
            datos[columna]  = valor;
        });

        datos["id"] = id;

        console.log("Datos enviados:", datos);

        $.ajax({
            url: "sr_Ac1.php",
            type: "POST",
            data: datos,
            dataType: "json",
            success: function(respuesta) {
                console.log("Respuesta del servidor: ", respuesta);

                if (respuesta.status === "success") {
                    alert(respuesta.message);
                    $("#fila-" + id + " .Editable").attr("contenteditable", "false");
                } else {
                    alert("Error: " + respuesta.message);
                }
            }, 
            error: function(xhr, status, error) {
                console.error("Error en AJAX: ", error);
                alert(`Error en la solicitud AJAX`);
            }
        });
    });
});