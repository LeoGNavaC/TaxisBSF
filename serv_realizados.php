<?php 
    include("conexion.php");

    $filasmax = 10;
    $pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
    $inicio = ($pagina - 1) * $filasmax;

    $sqlusu = mysqli_query($conn, "SELECT id, fecha, formadepago, accion, nombredelsocio, solicituddellamada, origen, destino, colonia, tag, km, horasex, descuento, sumatotaldeviaje, comentario, conductor, unidad, viaje FROM registro ORDER BY id DESC LIMIT $inicio, $filasmax");

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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="javascript/scriptSR1excel.js" defer></script><!--Para descargar el excel con el boton-->
        <script src="javascript/scriptSRAc1.js" defer></script><!--Para modificar en tiempo real la tabla-->
    </head>
    <body class="Cuerpo">
        <button class="button" id="btnSRexcel">Descargar Excel</button>
        <div class="Tsrealizados">
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Forma de Pago</th>
                        <th>Accion</th>
                        <th>Nombre</th>
                        <th>Solicitud de Llamada</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Colonia</th>
                        <th>Tag</th>
                        <th>KM</th>
                        <th>Horas Extra</th>
                        <th>Descuento</th>
                        <th>MONTO TOTAL - COBRADO BSF</th>
                        <th>Comentario</th>
                        <th>Conductor</th>
                        <th>Unidad</th>
                        <th>Viaje</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($mostrar = mysqli_fetch_assoc($sqlusu)) { ?>
                        <tr id="fila-<?php echo $mostrar['id']; ?>">
                            <td><?php echo $mostrar['fecha']; ?></td>
                            <td><?php echo $mostrar['formadepago']; ?></td>
                            <td><?php echo $mostrar['accion']; ?></td>
                            <td><?php echo $mostrar['nombredelsocio']; ?></td>
                            <td><?php echo $mostrar['solicituddellamada']; ?></td>
                            <td><?php echo $mostrar['origen']; ?></td>
                            <td><?php echo $mostrar['destino']; ?></td>
                            <td><?php echo $mostrar['colonia']; ?></td>
                            <td><?php echo $mostrar['tag'] ?></td>
                            <td><?php echo $mostrar['km']; ?></td>
                            <td><?php echo $mostrar['horasex'] ?></td>
                            <td><?php echo $mostrar['descuento'] ?></td>
                            <td><?php echo $mostrar['sumatotaldeviaje']; ?></td>
                            <td><?php echo $mostrar['comentario']; ?></td>
                            <td><?php echo $mostrar['conductor']; ?></td>
                            <td><?php echo $mostrar['unidad']; ?></td>
                            <td contenteditable="false" class="Editable" data-id="<?php echo $mostrar['id']; ?>" data-columna="viaje"><?php echo $mostrar['viaje']; ?></td>
                            <td>
                                <button class="Editar-btn" data-id="<?php echo $mostrar['id'] ?>">Editar</button>
                                <button class="Guardar-btn" data-id="<?php echo $mostrar['id'] ?>">Guardar</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Fecha</th>
                        <th>Forma de Pago</th>
                        <th>Accion</th>
                        <th>Nombre</th>
                        <th>Solicitud de Llamada</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Colonia</th>
                        <th>Tag</th>
                        <th>KM</th>
                        <th>Horas Extra</th>
                        <th>Descuento</th>
                        <th>MONTO TOTAL - COBRADO BSF</th>
                        <th>Comentario</th>
                        <th>Conductor</th>
                        <th>Unidad</th>
                        <th>Viaje</th>
                        <th>Opciones</th>
                    </tr>
                </tfoot>
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
