<?php 
    include("conexion.php");

    $sql = "SELECT tarifabase, tarifaporkm, iva, propina, horasextra FROM tarifas LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row    = $result->fetch_assoc();
        echo json_encode([
            "status" => "success",
            "tarifaBase" => $row["tarifabase"],
            "tarifaPorKm" => $row["tarifaporkm"],
            "iva" => $row["iva"],
            "propina" => $row["propina"],
            "horasExtra"    => $row["horasextra"]
        ]);
    } else {
        echo json_encode(["status" => "error"]);
    }

    $conn->close();
?>