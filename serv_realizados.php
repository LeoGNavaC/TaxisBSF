<?php 
    include("conexion.php");

    $filasmax = 10;
    $pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
    $inicio = ($pagina - 1) * $filasmax;

    $sqlusu = mysqli_query($conn, "SELECT id, fecha, formadepago, accion, nombredelsocio, solicituddellamada, origen, destino, colonia, km, tarifa, tiempoextra, tag, sumatotaldeviaje, comentario, conductor, unidad FROM registro ORDER BY id DESC LIMIT $inicio, $filasmax");

    $resultadoMaximo = mysqli_query($conn, "SELECT count(*) AS num_registros FROM registro");
    $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_registros'];
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Servicios Realizados</title>
    </head>
    <body>
        <table border="1">
            <tr>
                <th>Fecha</th>
                <th>UNIDAD</th>
                <th>FORMA DE PAGO</th>
                <th>ACCION</th>
                <th>Nombre</th>
                <th>ORIGEN</th>
                <th>DESTINO</th>
                <th>COLONIA</th>
                <th>KM</th>
                <th>TARIFA</th>
                <th>TAG</th>
                <th>MONTO TOTAL - COBRADO BSF</th>
            </tr>
            <?php 
                if (mysqli_num_rows($sqlusu) > 0) {
                    while ($mostrar = mysqli_fetch_assoc($sqlusu)) {
                        echo "<tr>";
                        echo "<td>" . $mostrar['fecha'] . "</td>";
                        echo "<td>" . $mostrar['unidad'] . "</td>";
                        echo "<td>" . $mostrar['formadepago'] . "</td>";
                        echo "<td>" . $mostrar['accion'] . "</td>";
                        echo "<td>" . $mostrar['nombredelsocio'] . "</td>";
                        echo "<td>" . $mostrar['origen'] . "</td>";
                        echo "<td>" . $mostrar['destino'] . "</td>";
                        echo "<td>" . $mostrar['colonia'] . "</td>";
                        echo "<td>" . $mostrar['km'] . "</td>";
                        echo "<td>" . $mostrar['tarifa'] . "</td>";
                        echo "<td>" . $mostrar['tag'] . "</td>";
                        echo "<td>" . $mostrar['sumatotaldeviaje'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No hay registros disponibles</td></tr>";
                }
            ?>
        </table>

        <div>
            <?php if ($pagina > 1): ?>
                <a href="serv_realizados.php?pag=<?php echo $pagina - 1; ?>">Anterior</a>
            <?php else: ?>
                <a href="#" style="pointer-events: none">Anterior</a>
            <?php endif; ?>

            <?php if (($pagina * $filasmax) < $maxusutabla): ?>
                <a href="serv_realizados.php?pag=<?php echo $pagina + 1; ?>">Siguiente</a>
            <?php else: ?>
                <a href="#" style="pointer-events: none">Siguiente</a>
            <?php endif; ?>
        </div>
    </body>
</html>
