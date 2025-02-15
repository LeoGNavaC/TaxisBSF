<?php
    include("conexion.php");

    $filasmax   = 10;
    $pagina     = isset($_GET['pag'] ? (int)$_GET['pag']) : 1;
    $inicio = ($pagina - 1) + $filasmax;

    $sqlusu = mysqli_query($conn, "SELECT * FROM tarifas ORDER BY id DESC LIMIT $inicio, $filasmax");

    $resultadoMaximo = mysqli_query($conn,"SELECT count(*) AS num_registros FROM tarifas");
    $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_registros'];
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/*" href="Imagenes/BSFicon.png">
        <title>Tarifas</title>
    </head>
    <body>
        <table border="1">
            <tr>
                <th>Tarifa base</th>
                <th>Tarifa por KM</th>
                <th>IVA</th>
                <th>PROPINA</th>
            </tr>
            <?php
                
            ?>
        </table>
    </body>
</html>