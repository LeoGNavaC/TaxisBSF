<?php
    include('conexion.php');

    date_default_timezone_set('America/Mexico_City');
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/*" href="Imagenes/BSFicon.png">
        <title>Registro</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="javascript/scriptR1.js" defer></script>
    </head>
    <body>
        <form method="post">
            <div>
                <table>
                    <tr>
                        <td>
                            <label>FECHA:(Se coloca sola)</label>
                            <input type="datetime" id="txtfecha" name="txtFecha" value="<?php echo date("d/m/y") ?>" readonly>

                            <label>FORMA DE PAGO:</label>
                            <select id="fopa" name="Fopa" required>
                                <option value="efectivo">EFECTIVO</option>
                                <option value="terminal">TERMINAL</option>
                            </select>

                            <label>ACCION:</label>
                            <!--En esta parte ira una API que me traiga las acciones de los socios-->

                            <label>NOMBRE DEL SOCIO:</label>
                            <!--Nos dara el nombre dependiendo de la accion-->

                            <label>SOLICITUD DE LLAMADA:</label>
                            <input type="datetime" id="txtsollama" name="txtSoLlama" value="<?php echo date("h:i:s") ?>" readonly>

                            <label>ORIGEN:</label>
                            <input type="text" id="txtorigen" name="txtOrigen" required>

                            <label>DESTINO:</label>
                            <input type="text" id="txtdestino" name="txtDestino" required>

                            <label>COLONIA:</label>
                            <input type="text" id="txtcolonia" name="txtColonia" required>

                            <label>KM:</label>
                            <input type="number" id="txtkm" name="txtKm" required>

                            <label>TARIFA:</label>
                            <input type="number" id="txttarifa" name="txtTarifa" required>

                            <label>TIEMPO EXTRA:</label>
                            <input type="number" id="txttiex" name="txtTiex" required>

                            <label>TAG:</label>
                            <input type="number" id="txttag" name="txtTag" required>

                            <label>SUMA TOTAL DE VIAJE:</label>
                            <input type="number" id="txtstdv" name="txtSTDV">

                            <label>COMENTARIO:</label>
                            <input type="text" id="txtcomentario" name="txtComentario" required>

                            <label for="select-conductores">CONDUCTOR:</label>
                            <select id="select-conductores" name="conductor">
                                <option value="">Cargando...</option>
                            </select>

                            <label>UNIDAD:</label>
                            <p><span id="unidad-conductor">N/A</span></p>
                        </td>
                    </tr>
                </table>
                <button type="submit" id="grabar" name="Grabar" value="enviar">Grabar</button>
                <button id="limpiar">Limpiar</button>
            </div>
        </form>
    </body>
</html>