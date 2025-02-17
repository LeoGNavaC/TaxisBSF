$(document).ready(function(){
    $(document).on("click",".Editar-btn", function() {
        let id = $(this).data("id");
        $("#Fila-" + id + " .Editable").attr("contenteditable","true").focus();
    });

    $(document).on("click",".Guardar-btn", function() {
        let id = $(this).data("id");
        let datos = {}; //Funciona para guardar los datos que nos regrese el json

        $("#Fila-" + id + " .Editable").each(function() {
            let columna = $(this).data("columna");
            let valor   = $(this).text();
            datos[columna] = valor;
        });

        datos["id"] = id;

        console.log("Datos enviados: ", datos); //veos que enviamos

        $.ajax({
            url: "tarifasAc2.php",
            type: "POST",
            data: datos,
            dataType: "json", //Especificar que esperamos un json
            succes: function(respuesta) {
                console.log("Respuesta del servidor:", respuesta);

                if(respuesta.status === "success") {
                    alert(respuesta.message);
                    $("#Fila-" + id + " .Editable").attr("contenteditable", "false");
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