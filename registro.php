<?php
    include('conexion.php');

    date_default_timezone_set('America/Mexico_City');
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/*" href="Imagenes/BSFicon.png">
        <link rel="stylesheet" href="estilos/estilos.css">
        <title>Registro</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="javascript/scriptR1.js" defer></script>
        <script src="javascript/scriptR2.js" defer></script>
    </head>
    <body class="Cuerpo">
        <form method="post">
            <div class="Tabla1">
                <table class="Tregistro">
                    <tr>
                        <td>
                            <label>FECHA:(Se coloca sola)</label>
                        </td>

                        <td>
                            <input type="datetime" id="txtfecha" name="txtFecha" value="<?php echo date("d/m/y"); ?>" readonly>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>FORMA DE PAGO:</label>
                        </td>

                        <td>
                            <select id="fopa" name="Fopa" required>
                                <option value="efectivo">EFECTIVO</option>
                                <option value="terminal">TERMINAL</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>ACCION:</label>
                            <!--En esta parte ira una API que me traiga las acciones de los socios-->
                        </td>

                        <td>
                            <input type="text" id="txtaccion" name="txtaccion" value="<?php echo "prueba accion"; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>NOMBRE DEL SOCIO:</label>
                            <!--Nos dara el nombre dependiendo de la accion-->
                        </td>

                        <td>
                            <input type="text" id="txtaccion" name="txtaccion" value="<?php echo "prueba nombre del socio"; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>SOLICITUD DE LLAMADA:</label>
                        </td>

                        <td>
                            <input type="datetime" id="txtsollama" name="txtSoLlama" value="<?php echo date("h:i:s") ?>" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>ORIGEN:</label>
                        </td>

                        <td>
                            <input type="text" id="txtorigen" name="txtOrigen" required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>DESTINO:</label>
                        </td>

                        <td>
                            <input type="text" id="txtdestino" name="txtDestino" required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>COLONIA:</label>
                        </td>

                        <td>
                            <input type="text" id="txtcolonia" name="txtColonia" required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>KM:</label>
                        </td>

                        <td>
                            <input type="number" id="txtkm" placeholder="KM" required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>SUMA TOTAL DE VIAJE:</label>
                        </td>

                        <td>
                            <input type="text" id="sumaTotal" placeholder="Total" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>COMENTARIO:</label>
                        </td>

                        <td>
                            <input type="text" id="txtcomentario" name="txtComentario" required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="select-conductores">CONDUCTOR:</label>
                        </td>

                        <td>
                            <select id="select-conductores" name="conductor">
                                <option value="">Cargando...</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>UNIDAD:</label>
                        </td>

                        <td>
                            <p><span id="unidad-conductor">N/A</span></p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <button class="button" type="submit" id="grabar" name="Grabar" value="enviar">Grabar</button>
                            <button class="button" id="limpiar">Limpiar</button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <img src="Imagenes/BSFicon.png" alt="Logo" class="logo2">
        <button class="button" onclick="window.location.href='index.php'">Pagina inicial</button>
    </body>
</html>