<?php
include("conexion.php"); // Incluye la conexión a la BD
header("Content-Type: application/json"); // Indicamos que devolvemos un JSON

// Verifica que la solicitud sea POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /*imprimimos los datos en un log que se guarda
    file_put_contents("debug.log", print_r($_POST, true));*/

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
    $tag    = $_POST['tag'] ?? null;
    ($tag === "" || is_nan($tag)) ? $tag = null : $tag = $_POST['tag'];//Asignamos valor null si viene vacio

    $horasex    = $_POST['horasex'] ?? null;
    ($horasex === "" || is_nan($horasex)) ? $horasex = null : $horasex = $_POST['horasex'];//Asignamos valor null si viene vacio

    $descuento  = $_POST['descuento'] ?? null;
    ($descuento == "" || is_nan($descuento)) ? $descuento = null : $descuento = $_POST['descuento'];//Asignamos valor null si viene vacio

    $sumaTotal = $_POST['sumaTotal'] ?? null;
    $comentario = $_POST['comentario'] ?? null;
    $idConductor = $_POST['seleccionConductores'] ?? null; // Recibe el ID del conductor

    // Validamos que los datos requeridos no estén vacíos
    if (!$formaP || !$accion || !$origen || !$destino || !$colonia || !$comentario || !$idConductor) {
        echo json_encode(["status" => "error", "message" => "Faltan datos obligatorios"]);
        exit;
    }

    // OBTENEMOS EL NOMBRE Y LA UNIDAD DEL CONDUCTOR
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

    // PREPARAMOS LA CONSULTA INSERT
    $stmt = $conn->prepare("INSERT INTO registro (fecha, formadepago, accion, nombredelsocio, solicituddellamada, origen, destino, colonia, tag, km, horasex, descuento, sumatotaldeviaje, comentario, conductor, unidad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Error en la preparación de la consulta"]);
        exit;
    }

    // Convertimos los valores numéricos correctamente
    $km = floatval($km);
    $sumaTotal = floatval($sumaTotal);

    // Convertimos `solicituddellamada` a `DATETIME` si solo tiene la hora
    if ($soloLla) {
        $soloLla = date("Y-m-d") . " " . $soloLla;
    }

    // Vinculamos los parámetros (usamos el nombre en lugar del ID)
    $stmt->bind_param("sssssssssddddsss", $fecha, $formaP, $accion, $accionN, $soloLla, $origen, $destino, $colonia, $tag, $km, $horasex, $descuento, $sumaTotal, $comentario, $nombreConductor, $unidadC);

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
