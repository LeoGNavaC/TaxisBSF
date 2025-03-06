<?php
include("conexion.php"); // Incluye la conexión a la BD
header("Content-Type: application/json"); // Indicamos que devolvemos un JSON

// Verifica que la solicitud sea POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recibimos los datos del formulario
    $fecha = $_POST['fecha'] ?? null;
    $formaP = $_POST['formaPago'] ?? null;
    $accion = $_POST['accion'] ?? null;
    $accionN = $_POST['accionNombre'] ?? null;
    $soloLla = $_POST['soloLlamadas'] ?? null;
    $origen = $_POST['origen'] ?? null;
    $destino = $_POST['destino'] ?? null;
    $colonia = $_POST['colonia'] ?? null;
    $km = $_POST['km'] ?? null;
    $sumaTotal = $_POST['sumaTotal'] ?? null;
    $comentario = $_POST['comentario'] ?? null;
    $idConductor = $_POST['seleccionConductores'] ?? null; // Recibe el ID del conductor

    // Validamos que los datos requeridos no estén vacíos
    if (!$formaP || !$accion || !$origen || !$destino || !$colonia || !$km || !$comentario || !$idConductor) {
        echo json_encode(["status" => "error", "message" => "Faltan datos obligatorios"]);
        exit;
    }

    // 🔹 OBTENEMOS EL NOMBRE Y LA UNIDAD DEL CONDUCTOR
    $nombreConductor = null;
    $unidadC = null;

    $stmtConductor = $conn->prepare("SELECT nombre, unidad FROM conductores WHERE id = ?");
    
    if ($stmtConductor) {
        $stmtConductor->bind_param("i", $idConductor);
        $stmtConductor->execute();
        $stmtConductor->bind_result($nombreConductor, $unidadC);
        $stmtConductor->fetch();
        $stmtConductor->close();
    }

    // 🔹 PREPARAMOS LA CONSULTA INSERT
    $stmt = $conn->prepare("INSERT INTO registro (fecha, formadepago, accion, nombredelsocio, solicituddellamada, origen, destino, colonia, km, sumatotaldeviaje, comentario, conductor, unidad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Error en la preparación de la consulta"]);
        exit;
    }

    // 🔹 Convertimos los valores numéricos correctamente
    $km = floatval($km);
    $sumaTotal = floatval($sumaTotal);

    // 🔹 Convertimos `solicituddellamada` a `DATETIME` si solo tiene la hora
    if ($soloLla) {
        $soloLla = date("Y-m-d") . " " . $soloLla;
    }

    // 🔹 Vinculamos los parámetros (usamos el nombre en lugar del ID)
    $stmt->bind_param("ssssssssddsss", $fecha, $formaP, $accion, $accionN, $soloLla, $origen, $destino, $colonia, $km, $sumaTotal, $comentario, $nombreConductor, $unidadC);

    // 🔹 Ejecutamos la consulta
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Datos guardados correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al guardar los datos"]);
    }

    // 🔹 Cerramos la consulta y la conexión
    $stmt->close();
    $conn->close();

} else {
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
}
?>
