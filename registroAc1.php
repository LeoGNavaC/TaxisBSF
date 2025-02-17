<?php
    include("conexion.php");
    
    $sqlcon = "SELECT id, nombre, unidad FROM conductores";
    $resultado  = mysqli_query($conn, $sqlcon);

    $conduc = array();

    while ($fila = mysqli_fetch_array($resultado)){
        $conduc[] = $fila; 
    }

    echo json_encode($conduc); //pedimos los datos y los regresamos en formato json
?>