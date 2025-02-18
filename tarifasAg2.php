<?php 
    include("conexion.php");
    header("Content-Type: application/json"); // Asegurar JSON

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $unidad = $_POST['unidad'];

        $stmt = $conn->prepare("INSERT INTO conductores (nombre, unidad) VALUES (?, ?)");
        $stmt->bind_param("si", $nombre, $unidad);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Datos insertados correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error en la inserción"]);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Método no permitido"]);
    }
?>
