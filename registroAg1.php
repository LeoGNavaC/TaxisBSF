<?php
include("conexion.php"); // Incluye el archivo de conexión a la BD
header("Content-Type: application/json"); // Indica que se enviará un JSON

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
    $seleccionC = $_POST['seleccionConductores'] ?? null;
    $unidadC = $_POST['unidadConductores'] ?? null;

    // Validamos que los datos requeridos no estén vacíos
    if (!$fecha || !$formaP || !$accion || !$origen || !$destino || !$colonia || !$km || !$sumaTotal || !$comentario || !$seleccionC) {
        echo json_encode(["status" => "error", "message" => "Faltan datos obligatorios"]);
        exit;
    }

    // Preparamos la consulta con sentencias preparadas
    $stmt = $conn->prepare("INSERT INTO registro (fecha, formadepago, accion, nombredelsocio, solicituddellamada, origen, destino, colonia, km, sumatotaldeviaje, comentario, conductor, unidad) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Error en la preparación de la consulta"]);
        exit;
    }

    // Convertimos los valores numéricos correctamente
    $km = floatval($km);
    $sumaTotal = floatval($sumaTotal);

    // Vinculamos los parámetros
    $stmt->bind_param("ssssssssddssi", $fecha, $formaP, $accion, $accionN, $soloLla, $origen, $destino, $colonia, $km, $sumaTotal, $comentario, $seleccionC, $unidadC);

    // Ejecutamos la consulta
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Datos guardados correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al guardar los datos"]);
    }

    // Cerramos la consulta y la conexión
    $stmt->close();
    $conn->close();

} else {
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
}
?>
