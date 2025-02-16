<?php
    include("conexion.php");

    $filasmax1  = 10;
    $filasmax2  = 10;
    $pagina1    = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
    $pagina2    = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
    $inicio1    = ($pagina1 - 1) * $filasmax1;
    $inicio2    = ($pagina2 - 1) * $filasmax2; 

    $sqlusu     = mysqli_query($conn, "SELECT id, tarifabase, tarifaporkm, iva, propina FROM tarifas ORDER BY id DESC LIMIT $inicio1, $filasmax1");
    $sqlcon     = mysqli_query($conn, "SELECT id, nombre, unidad FROM conductores ORDER BY id DESC LIMIT $inicio2, $filasmax2");

    $resultadoMaximo1   = mysqli_query($conn,"SELECT count(*) AS num_registros1 FROM tarifas");
    $resultadoMaximo2   = mysqli_query($conn,"SELECT count(*) AS num_registros2 FROM conductores");

    $maxusutabla1   = mysqli_fetch_assoc($resultadoMaximo1)['num_registros1'];
    $maxusutabla2   = mysqli_fetch_assoc($resultadoMaximo2)['num_registros2'];
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/*" href="Imagenes/BSFicon.png">
        <title>Tarifas</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="javascript/script.js"></script>
    </head>
    <body>
        <div>
            <table border="1">
                <tr>
                    <th>Tarifa base</th>
                    <th>Tarifa por KM</th>
                    <th>IVA</th>
                    <th>PROPINA</th>
                </tr>
                <?php
                    if(mysqli_num_rows($sqlusu) > 0){
                        while($mostrar1 = mysqli_fetch_assoc($sqlusu)){
                            echo "<tr>";
                            echo "<td>" . $mostrar1['tarifabase'] . "</td>";
                            echo "<td>" . $mostrar1['tarifaporkm'] . "</td>";
                            echo "<td>" . $mostrar1['iva'] . "</td>";
                            echo "<td>" . $mostrar1['propina'] . "</td>";
                            echo "</tr>"; 
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay registros disponibles</td></tr>";
                    }
                ?>
            </table>
        </div>

        <div>
            <?php if($pagina1 > 1): ?>
                <a href="tarifas.php?pag=<?php echo $pagina1 - 1; ?>">Anterior</a>
            <?php else: ?>
                <a href="#" style="pointer-events: none;">Anterior</a>
            <?php endif; ?>

            <?php if(($pagina1 * $filasmax1) < $maxusutabla1): ?>
                <a href="tarifas.php?pag=<?php echo $pagina1 + 1; ?>">Siguiente</a>
            <?php else: ?>
                <a href="#" style="pointer-events: none">Siguiente</a>
            <?php endif; ?>
        </div>

        <div>
            <table border="1">
                <tr>
                    <th>CONDUCTOR</th>
                    <th>UNIDAD</th>
                </tr>
                <?php 
                    if(mysqli_num_rows($sqlcon) > 0){
                        while($mostrar2 = mysqli_fetch_assoc($sqlcon)){
                            echo "<tr>";
                                echo "<td>" . $mostrar2['nombre'] . "</td>";
                                echo "<td>" . $mostrar2['unidad'] . "</td>";
                                echo "<td>
                                    <a class='' href=\"modificarC.php\"></a>
                                    <a class='' href=\"eliminarC.php\"></a>
                                </td>"
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay registros</td></tr>";
                    }
                ?>
            </table>
        </div>

        <div>
            <?php if($pagina1 > 1): ?>
                <a href="tarifas.php?pag=<?php echo $pagina1 - 1; ?>">Anterior</a>
            <?php else: ?>
                <a href="#" style="pointer-events: none;">Anterior</a>
            <?php endif; ?>

            <?php if(($pagina1 * $filasmax1) < $maxusutabla1): ?>
                <a href="tarifas.php?pag=<?php echo $pagina1 + 1; ?>">Siguiente</a>
            <?php else: ?>
                <a href="#" style="pointer-events: none">Siguiente</a>
            <?php endif; ?>
        </div>
    </body>
</html>
