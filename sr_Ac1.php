<?php
    include("conexion.php");

    header("Content-Type: application/json");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['id']) && isset($_POST['fecha']) && isset($_POST['formadepago']) && isset($_POST['accion']) && isset($_POST['nombredelsocio']) && isset($_POST['solicituddellamada']) && isset($_POST['origen']) && isset($_POST['destino']) && isset($_POST['colonia']) && isset($_POST['km']) && isset($_POST['sumatotaldeviaje']) && isset($_POST['comentario']) && isset($_POST['conductor']) && isset($_POST['unidad']) && isset($_POST['viaje'])) {
            $id = $_POST['id'];
            $fecha  = $_POST['fecha'];
            $formadepago    = $_POST['formadepago'];
            $accion = $_POST['accion'];
            $nombredelsocios    = $_POST['nombredelsocio'];
            $solicituddellamada     = $_POST['solicituddellamada'];
            $origen = $_POST['origen'];
            $destino    = $_POST['destino'];
            $colonia    = $_POST['colonia'];
            $km = $_POST['km'];
            $sumatotaldeviaje   = $_POST['sumatotaldeviaje'];
            $comentario = $_POST['comentario'];
            $conductor  = $_POST['conductor'];
            $unidad = $_POST['unidad'];
            $viaje  = $_POST['viaje'];

            $stmt = $conn->prepare("UPDATE registro SET fecha = ?, formadepago = ?, accion = ?, nombredelsocio = ?, solicituddellamada = ?, origen = ?, destino = ?, colonia = ?, km = ?, sumatotaldeviaje = ?, comentario = ?, conductor = ?, unidad = ?, viaje = ? WHERE id = ?");
            $stmt->bind_param("ssssssssddssssi",$fecha, $formadepago, $accion, $nombredelsocios, $solicituddellamada, $origen, $destino, $colonia, $km, $sumatotaldeviaje, $comentario, $conductor,$unidad, $viaje, $id);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Datos actualizados correctamente"]);
            } else {
                echo json_encode(["status" => "success", "message" => "Error al actualizar contacte a sistemas: soporte@cgcsf.mx"]);
            }

            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Metodo no permitido"]);
    }
?>