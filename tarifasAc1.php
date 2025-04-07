<?php
    include("conexion.php");

    // Configurar cabeceras para que el contenido sea JSON
    header("Content-Type: application/json");

    // Verificar que la solicitud es POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar que las variables existen en $_POST
        if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['unidad'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $unidad = $_POST['unidad'];

            $stmt = $conn->prepare("UPDATE conductores SET nombre = ?, unidad = ? WHERE id = ?");
            $stmt->bind_param("ssi", $nombre, $unidad, $id);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Datos actualizados correctamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al actualizar los datos contacte a sistemas: soporte3@cgcsf.mx"]);
            }

            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Método no permitido"]);
    }

    $conn->close();
?>
