$(document).ready(function(){
    //Cargamos los datos de tarifas y los metemos de una vez
    let tarifas = {};

    function obtenerTarifas() {
        $.ajax({
            url: "registroOb.php",
            type: "GET",
            dataType: "json",
            success: function(datos){
                if (datos.status === "success") {
                    tarifas = {
                        banderazo: parseFloat(datos.tarifaBase),
                        tarifakm: parseFloat(datos.tarifaPorKm),
                        iva: parseFloat(datos.iva),
                        propina: parseFloat(datos.propina)
                    };
                } else {
                    alert("Error al obtener las tarifas");
                }
            },
            error: function() {
                alert("Error en la consulta AJAX");
            }
        });
    }

    obtenerTarifas(); // llamamos a la funcion y traemos los datos

    //Con esto detectamos algunos cambios en el campo KM y calculamos automaticamente
    $("#txtkm").on("input", function() {
        let km = parseFloat($(this).val()); //obtenemos el valor del campo KM

        if (isNaN(km) || km <= 0) {
            $("#sumaTotal").val("");//limpiamos si el valor no es valido
            return;
        }

        //realizamos los calculos
        let resultado1  = (km * tarifas.tarifakm) + tarifas.banderazo; 
        let propinaR    = resultado1 * (tarifas.propina/100); 
        let resultado2  = propinaR + resultado1; 
        let ivaR    = resultado2 * (tarifas.iva/100); 
        let grantotal1   = ivaR + resultado2;

        //Redondeo hacia arriba
        grantotal   = Math.round(grantotal1);

        //mostramos el resultado en el campo de sumaTotal
        $("#sumaTotal").val(grantotal);
    });
});