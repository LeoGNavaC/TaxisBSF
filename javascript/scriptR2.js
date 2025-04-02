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
                    tarifas = {//trae los datos de la tabla tarifas para ahcer el calculo
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
    $("#txtdescuento, #txtkm, #sttag, #txthoex").on("input", function() {
        let km  = parseFloat($("#txtkm").val()); //obtenemos el valor del campo KM
        let tg  = parseFloat($("#sttag").val()) || 0; //obtenemos el valor del campo TAG y evitamos si esta vacio tomamos cero
        let ti  = parseFloat($("#txthoex").val()) || 0; //obtenemos el valor del campo HORAS EXTRA y evitamos si esta vacio tomamos cero
        let des  = parseFloat($("#txtdescuento").val()) || 0;//obtenemos el valor del campo DESCUENTO y evitamos si esta vacio tomamos cero

        if (isNaN(km) || km <= 0) {
            $("#sumaTotal").val("");//limpiamos si el valor no es valido
            return;
        }

        //Calculo inicial tomando el IVA, KM, Propina, y la tarifa base esos son de cajon
        let resultado1  = (km * tarifas.tarifakm) + tarifas.banderazo; 
        let propinaR    = resultado1 * (tarifas.propina/100); 
        let resultado2  = propinaR + resultado1; 
        let ivaR    = resultado2 * (tarifas.iva/100); 
        let grantotal1   = ivaR + resultado2;

        //Sumamos el TAG si existe
        grantotal1  += tg; 

        //Sumamos las horas extra si existen
        grantotal1 += (ti * tarifas.horasex);

        //Aplicamos descuento si existe
        if (des > 0) {
            let desR    = grantotal1 * (des / 100);
            grantotal1  -= desR;
        }

        $("#sumaTotal").val(Math.round(grantotal1));
    });
});