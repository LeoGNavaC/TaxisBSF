$(document).ready(function(){
    $("#form-conductor").submit(function(e){
        e.preventDefault(); // Evita que la página se recargue

        let nombre = $("#txtncon").val();
        let unidad = $("#txtuni").val();

        $.ajax({
            url: "tarifasAg2.php",
            type: "POST",
            data: {
                nombre: nombre, 
                unidad: unidad
            },
            dataType: "json",
            success: function(respuesta){
                $("#mensaje").text(respuesta.message);

                if (respuesta.status === "success") {
                    setTimeout(() => {
                        window.location.href = "tarifas.php"; // Redirigir después de 1.5s
                    }, 1500);
                }
            }, 
            error: function(xhr, status, error) {
                console.error("Error en AJAX:", error);
                $("#mensaje").text("Error en la inserción");
            }
        });
    });
});
