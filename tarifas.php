<?php
    include("conexion.php");

    $filasmax1  = 10;
    $filasmax2  = 10;
    $pagina1    = isset($_GET['pag1']) ? (int)$_GET['pag1'] : 1;
    $pagina2    = isset($_GET['pag2']) ? (int)$_GET['pag2'] : 1;
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
        <script src="javascript/scriptT1.js" defer></script>
        <script src="javascript/scriptT2.js" defer></script>
    </head>
    <body>
        <div>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Tarifa base</th>
                    <th>Tarifa por KM</th>
                    <th>IVA</th>
                    <th>PROPINA</th>
                </tr>
                <?php while($mostrar1 = mysqli_fetch_assoc($sqlusu)) {?>
                    <tr id="Fila-<?php echo $mostrar1['id']; ?>">
                        <td><?php echo $mostrar1['id']; ?></td>
                        <td contenteditable="false" class="Editable" data-id="<?php echo $mostrar1['id']; ?>" data-columna="tarifabase"><?php echo $mostrar1['tarifabase']; ?></td>
                        <td contenteditable="false" class="Editable" data-id="<?php echo $mostrar1['id']; ?>" data-columna="tarifaporkm"><?php echo $mostrar1['tarifaporkm']; ?></td>
                        <td contenteditable="false" class="Editable" data-id="<?php echo $mostrar1['id']; ?>" data-columna="iva"><?php echo $mostrar1['iva']; ?></td>
                        <td contenteditable="false" class="Editable" data-id="<?php echo $mostrar1['id']; ?>" data-columna="propina"><?php echo $mostrar1['propina']; ?></td>
                        <td>
                            <button class="Editar-btn" data-id="<?php echo $mostrar1['id'] ?>">Editar</button>
                            <button class="Guardar-btn" data-id="<?php echo $mostrar1['id'] ?>">Guardar</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <div>
            <?php if($pagina1 > 1): ?>
                <a href="tarifas.php?pag1=<?php echo $pagina1 - 1; ?>">Anterior</a>
            <?php else: ?>
                <a href="#" style="pointer-events: none;">Anterior</a>
            <?php endif; ?>

            <?php if(($pagina1 * $filasmax1) < $maxusutabla1): ?>
                <a href="tarifas.php?pag1=<?php echo $pagina1 + 1; ?>">Siguiente</a>
            <?php else: ?>
                <a href="#" style="pointer-events: none">Siguiente</a>
            <?php endif; ?>
        </div>

        <div>
            <button class="" onclick="window.location.href='tarifasAg1.php?pag2=<?php $pagina2 ?>'">Agregar conductores</button>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>CONDUCTOR</th>
                    <th>UNIDAD</th>
                    <th>OPCIONES</th>
                </tr>
                <?php while($mostrar2 = mysqli_fetch_assoc($sqlcon)) {?>
                    <tr id="fila-<?php echo $mostrar2['id']; ?>">
                        <td><?php echo $mostrar2['id']; ?></td>
                        <td contenteditable="false" class="editable" data-id="<?php echo $mostrar2['id']; ?>" data-columna="nombre"><?php echo $mostrar2['nombre']; ?></td>
                        <td contenteditable="false" class="editable" data-id="<?php echo $mostrar2['id']; ?>" data-columna="unidad"><?php echo $mostrar2['unidad']; ?></td>
                        <td>
                            <button class="editar-btn" data-id="<?php echo $mostrar2['id']; ?>">Editar</button>
                            <button class="guardar-btn" data-id="<?php echo $mostrar2['id']; ?>">Guardar</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <div>
            <?php if($pagina2 > 1): ?>
                <a href="tarifas.php?pag2=<?php echo $pagina2 - 1; ?>">Anterior</a>
            <?php else: ?>
                <a href="#" style="pointer-events: none;">Anterior</a>
            <?php endif; ?>

            <?php if(($pagina2 * $filasmax2) < $maxusutabla2): ?>
                <a href="tarifas.php?pag2=<?php echo $pagina2 + 1; ?>">Siguiente</a>
            <?php else: ?>
                <a href="#" style="pointer-events: none">Siguiente</a>
            <?php endif; ?>
        </div>
    </body>
</html>
