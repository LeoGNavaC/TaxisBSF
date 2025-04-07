<?php 
    include("conexion.php");

    //Definimos los encabezados necesacios para una descarga de un archivo Excel
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment; filename=servicios_realizados.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    //Iniciar la salida del archivo (definimos los encabezados que llevara el archivo excel)(la t es tabulador, para separar cada linea y n para salto de linea)
    echo "Fecha de pedido\tForma de Pago\tAccion del socio\tNombre del socio\tSolicitud de llamada\tOrigen\tDestino\tColonia\tTag\tKm\tHoras Extra\tDescuento\tTotal del viaje\tComentario\tConductor\tUnidad\tViaje\n";

    //Consulta SQL
    $querySVe   = "SELECT fecha, formadepago, accion, nombredelsocio, solicituddellamada, origen, destino, colonia, tag, km, horasex, descuento, sumatotaldeviaje, comentario, conductor, unidad, viaje FROM registro";
    $resultadoSVe   = $conn->query($querySVe);

    if ($resultadoSVe->num_rows > 0) {
        while ($filaSVe = $resultadoSVe->fetch_assoc()) {
            echo $filaSVe['fecha'] . "\t" . $filaSVe['formadepago'] . "\t" . $filaSVe['accion'] . "\t" . $filaSVe['nombredelsocio'] . "\t" . $filaSVe['solicituddellamada'] . "\t" . $filaSVe['origen'] . "\t" . $filaSVe['destino'] . "\t" . 
                $filaSVe['colonia'] . "\t" . $filaSVe['tag'] . "\t" . $filaSVe['km'] . "\t" . $filaSVe['horasex'] . "\t" . $filaSVe['descuento'] . "\t" . $filaSVe['sumatotaldeviaje'] . "\t" . $filaSVe['comentario'] . "\t" . $filaSVe['conductor'] . "\t" . $filaSVe['unidad'] . "\t" . $filaSVe['viaje'] . "\t" . "\n";
        }
    } else {
        echo "No hay registros disponibles\n";
    } 

    $conn->close();
?>