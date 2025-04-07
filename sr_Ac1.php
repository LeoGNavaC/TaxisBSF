<?php
    include("conexion.php");

    header("Content-Type: application/json");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['id']) && isset($_POST['viaje'])) {
            $id = $_POST['id'];
            $viaje  = $_POST['viaje'];

            $stmt = $conn->prepare("UPDATE registro SET viaje = ? WHERE id = ?");
            $stmt->bind_param("si", $viaje, $id);

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