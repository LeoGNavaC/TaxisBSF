<?php
    include('conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/*" href="Imagenes/BSFicon.png">
        <link rel="stylesheet" href="estilos/estilos.css">
        <title>Registro</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="javascript/scriptR1.js" defer></script><!--Trae a los conductores-->
        <script src="javascript/scriptR4.js" defer></script><!--API(trae a los socios)-->
        <script src="javascript/scriptRFech.js" defer></script><!--Trae la fecha-->
        <script src="javascript/scriptRFracc.js" defer></script><!--Oculta los campos-->
        <script src="javascript/scriptR2.js" defer></script><!--Hace el calculo-->
        <script src="javascript/scriptR3.js" defer></script><!--Guarda los datos-->
    </head>

    <body class="Cuerpo">
        <form id="form-registro">
            <div class="Tabla1">
                <table class="Tregistro">
                    <tr>
                        <td>
                            <label>FECHA:</label>
                        </td>

                        <td>
                            <input type="date" id="txtfecha" readonly>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>FORMA DE PAGO:</label>
                        </td>

                        <td>
                            <select id="fopa" required>
                                <option>...</option>
                                <option value="EFECTIVO">EFECTIVO</option>
                                <option value="TERMINAL">TERMINAL</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>ACCIÓN:</label>
                        </td>

                        <td>
                            <input type="text" id="accion" list="lista-socios" autocomplete="off" required>
                            <datalist id="lista-socios"></datalist>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>NOMBRE DEL SOCIO:</label>
                        </td>

                        <td>
                            <input type="text" id="nombre-socio" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>SOLICITUD DE LLAMADA:</label>
                        </td>

                        <td>
                            <input type="time" id="txtsollama" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>ORIGEN:</label>
                        </td>

                        <td>
                            <input type="text" id="txtorigen" required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>DESTINO:</label>
                        </td>

                        <td>
                            <input type="text" id="txtdestino" required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>COLONIA:</label>
                        </td>

                        <td>
                            <input type="text" id="txtcolonia" required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>¿ES UN VIAJE DENTRO DEL FRACCIONAMIENTO?:</label>
                        </td>

                        <td>
                            <select id="slFracc" onchange="mostrarC()">
                                <option value="no">No</option>
                                <option value="si">Si</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label id="lbKM">KM:</label>
                        </td>

                        <td>
                            <input type="number" id="txtkm" placeholder="KM" step="any">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label id="lbTAG">TAG:</label>
                        </td>

                        <td>
                            <input type="number" id="sttag" placeholder="Valor de Tag" step="any">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label id="lbHE">HORAS EXTRA:</label>
                        </td>

                        <td>
                            <input type="number" id="txthoex" placeholder="Horas extra">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label id="lbD">DESCUENTO:</label>    
                        </td>

                        <td>
                            <input type="number" id="txtdescuento" placeholder="Descuento">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>SUMA TOTAL DE VIAJE:</label>
                        </td>

                        <td>
                            <input type="number" id="sumaTotal" placeholder="Total" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>COMENTARIO:</label>
                        </td>

                        <td>
                            <input type="text" id="txtcomentario" required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="select-conductores">CONDUCTOR:</label>
                        </td>

                        <td>
                            <select id="select-conductores" required>
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
                            <button class="button" type="submit">Guardar</button><!--El tipo submit hace que se recargue la pagina-->
                        </td>
                    </tr>
                </table>
            </div>
        </form>

        <img src="Imagenes/BSFicon.png" alt="Logo" class="logo2">
        <button class="button" onclick="window.location.href='index.php'">Pagina inicial</button>
    </body>
</html>