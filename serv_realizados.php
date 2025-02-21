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
        <link rel="icon" type="image/*" href="Imagenes/BSFicon.png">
        <link rel="stylesheet" href="estilos/estilos.css">
        <title>Servicios Realizados</title>
    </head>
    <body class="Cuerpo">
        <div class="Tsrealizados">
            <table>
                <thead>
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
                </thead>
                <?php while ($mostrar = mysqli_fetch_assoc($sqlusu)) { ?>
                    <tr>
                        <td><?php echo $mostrar['fecha'] ?></td>
                        <td><?php echo $mostrar['formadepago'] ?></td>
                        <td><?php echo $mostrar['accion'] ?></td>
                        <td><?php echo $mostrar['nombredelsocio'] ?></td>
                        <td><?php echo $mostrar['solicituddellamada'] ?></td>
                        <td><?php echo $mostrar['origen'] ?></td>
                        <td><?php echo $mostrar['destino'] ?></td>
                        <td><?php echo $mostrar['colonia'] ?></td>
                        <td><?php echo $mostrar['km'] ?></td>
                        <td><?php echo $mostrar['tarifa'] ?></td>
                        <td><?php echo $mostrar['tiempoextra'] ?></td>
                        <td><?php echo $mostrar['tag'] ?></td>
                        <td><?php echo $mostrar['sumatotaldeviaje'] ?></td>
                        <td><?php echo $mostrar['comentario'] ?></td>
                        <td><?php echo $mostrar['conductor'] ?></td>
                        <td><?php echo $mostrar['unidad'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <div class="AS">
            <?php if ($pagina > 1): ?>
                <a href="serv_realizados.php?pag=<?php echo $pagina - 1; ?>">Anterior</a>
            <?php else: ?>
                <a href="#">Anterior</a>
            <?php endif; ?>

            <?php if (($pagina * $filasmax) < $maxusutabla): ?>
                <a href="serv_realizados.php?pag=<?php echo $pagina + 1; ?>">Siguiente</a>
            <?php else: ?>
                <a href="#">Siguiente</a>
            <?php endif; ?>
        </div>
        <img src="Imagenes/BSFicon.png" alt="Logo" class="logo2">
        <button class="button" onclick="window.location.href='index.php'">Pagina inicial</button>
    </body>
</html>
