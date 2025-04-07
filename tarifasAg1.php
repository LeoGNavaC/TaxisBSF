<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/*" href="Imagenes/BSFicon.png">
        <link rel="stylesheet" href="estilos/estilos.css">
        <title>Registrar conductor</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="javascript/scriptT3.js" defer></script>
    </head>
    <body class="Cuerpo">
        <form id="form-conductor">
            <div class="Tabla1">
                <table class="Tregistro">
                    <tr>
                        <td>
                            <label>Nombre del conductor:</label>
                        </td>
                        <td>
                            <input type="text" id="txtncon" placeholder="Conductor">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Unidad:</label>
                        </td>
                        <td>
                            <input type="number" id="txtuni" placeholder="Unidad">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <button class="button" type="submit">Guardar</button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <p id="mensaje"></p>
        <img src="Imagenes/BSFicon.png" alt="Logo" class="logo2">
        <button class="button" onclick="window.location.href='tarifas.php'">Pagina Tarifas</button>
    </body>
</html>