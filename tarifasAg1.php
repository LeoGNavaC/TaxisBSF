<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/*" href="Imagenes/BSFicon.png">
        <title>Registrar conductor</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="javascript/scriptT3.js" defer></script>
    </head>
    <body>
        <form id="form-conductor">
            <div>
                <table>
                    <tr>
                        <td><label>Nombre del conductor:</label></td>
                        <td><input type="text" id="txtncon" placeholder="Conductor"></td>
                    </tr>

                    <tr>
                        <td><label>Unidad:</label><td>
                        <td><input type="number" id="txtuni" placeholder="Unidad"></td>
                    </tr>

                    <tr>
                        <td><button type="submit">Guardar</button></td>
                    </tr>
                </table>
            </div>
        </form>
        <p id="mensaje"></p>
    </body>
</html>