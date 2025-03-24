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
                        propina: parseFloat(datos.propina),
                        horasex: parseFloat(datos.horasExtra)
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
    $("#txtkm, #sttag, #txthoex").on("input", function() {
        let km  = parseFloat($("#txtkm").val()); //obtenemos el valor del campo KM
        let tg  = parseFloat($("#sttag").val()); //obtenemos el valor del campo TAG
        let ti  = parseFloat($("#txthoex").val()) || 0; //obtenemos el valor del campo HORAS EXTRA y evitamos que si esta vacio

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

        if (isNaN(tg) && ti === 0) {
            //Redondeo hacia arriba
            let grantotal   = Math.round(grantotal1);

            //mostramos el resultado en el campo de sumaTotal
            $("#sumaTotal").val(grantotal);
        } else {
            let grantotal2  = grantotal1 + tg; //246
            let tiempoR = (ti * tarifas.horasex);
            let grantotal3  = grantotal2 + tiempoR;
         
            //Redondeo hacia arriba
            grantotal   = Math.round(grantotal3);

            //mostramos el resultado en el campo de sumaTotal
            $("#sumaTotal").val(grantotal);
        }
    });
});