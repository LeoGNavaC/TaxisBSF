<?php 
    include("conexion.php");

    //configuramos cabeceras para que el contenido sea en formato JSON
    header("Content-Type: application/json");

    //Vefiricamos que sea POST la peticion
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Verificamos que si se encuentren todos los datos en el POST
        if (isset($_POST['id']) && isset($_POST['tarifabase']) && isset($_POST['tarifaporkm']) && isset($_POST['iva']) && isset($_POST['propina'])) {
            $id     = $_POST['id'];
            $tarifb = $_POST['tarifabase'];
            $tarifk = $_POST['tarifaporkm'];
            $iva    = $_POST['iva'];
            $propin = $_POST['propina'];

            $stmt = $conn->prepare("UPDATE tarifas SET tarifabase = ?, tarifaporkm = ?, iva = ?, propina = ? WHERE id = ?");
            $stmt->bind_param("ddddi", $tarifb, $tarifk, $iva, $propin, $id);

            if($stmt->execute()){
                echo json_encode(["status" => "success", "message" => "Datos actualizados correctamente"]);
            } else {
                echo json_encode(["status" => "success", "message" => "Error al actualizar contacte a sistemas: soporte3@cgcsf.mx"]);
            }

            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Metodo no permitido"]);
    }
?>