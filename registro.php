<?php
    include('conexion.php');
    
    $codu   = [];
    $smt    = $conn->prepare("SELECT nombre,unidad FROM conductores");
    
    $smt->execute();
    
    $resultado  = $smt->get_result();
    $condu  = $resultado;
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/*" href="Imagenes/BSFicon.png">
        <title>Registro</title>
    </head>
    <body>
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label>FECHA:(Se coloca sola)</label>

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
                        <input type="date" id="txtsollama" name="txtSoLlama" required>

                        <label>ORIGEN:</label>
                        <input type="text" id="txtorigen" name="txtOrigen" required>

                        <label>DESTINO:</label>
                        <input type="text" id="txtdestino" name="txtDestino" required>

                        <label>COLONIA:</label>
                        <input type="text" id="txtcolonia" name="txtColonia" required>

                        <label>KM:</label>
                        <input type="number" id="txtkm" name="txtKm" required>

                        <label>TARIFA</label>
                        <input type="number" id="txttarifa" name="txtTarifa" required>

                        <label>TIEMPO EXTRA</label>
                        <input type="number" id="txttiex" name="txtTiex" required>

                        <label>TAG</label>
                        <input type="number" id="txttag" name="txtTag" required>

                        <label>SUMA TOTAL DE VIAJE</label>
                        <input type="number" id="txtstdv" name="txtSTDV">

                        <label>COMENTARIO</label>
                        <input type="text" id="txtcomentario" name="txtComentario" required>

                        <label>CONDUCTOR</label>
                        <td>
                            <input list="conductor" id="dalicodu" name="daliCodu" class="" required>
                            <datalist id="dalicodu">
                                <?php
                                    foreach($condu as $ncondu){
                                        echo '<option value="' . htmlspecialchars($ncondu) . '">';
                                    }
                                ?>
                            </datalist>
                        </td>
                        <!--Va a ir consulta en SQL a la base de datos para colocar a sus trabajadores-->

                        <label>UNIDAD</label>
                        <!--Que nos muestre la unidad dependiendo del conductor que eligamos-->
                    </td>
                </tr>
            </table>
            <button type="submit" id="grabar" name="Grabar" value="enviar">Grabar</button>
            <button id="limpiar">Limpiar</button>
        </form>
    </body>
</html>

<?php
    if(isset($_POST['Grabar'])){
        date_default_timezone_set('America/Mexico_City');

        $Tfecha     = date("Y-m-d");
        $Tfopa      = $_POST['txtaccion'];
        $Tnoso      = $_POST['txtnoso'];
        $Tsollama       = $_POST['txtSoLlama'];
        $Torig      = $_POST['txtOrigen'];
        $Tdest      = $_POST['txtDestino'];
        $Tcolo      = $_POST['txtColonia'];
        $Tkm        = $_POST['txtKm'];
        $Ttari      = $_POST['txtTarifa'];
        $Ttiex      = $_POST['txtTiex'];
        $Ttag       = $_POST['txtTag'];
        $Tstdv      = $_POST['txtSTDV'];
        $Tcome      = $_POST['txtComentario'];
        $Tcond      = $_POST['txtConductor'];
        $Tunid      = $_POST['txtunidad'];

        $smt = $conn->prepare("INSERT INTO registro (fecha,formadepago,accion,nombredelsocio,solicituddellamada,origen,destino,colonia,km,tarifa,tiempoextra,tag,sumatotaldeviaje,comentario,conductor,unidad) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $smt->bind_param("ssssssssiiiiissi", $Tfecha, $Tfopa, $Tnoso, $Tsollama, $Torig, $Tdest, $Tcolo, $Tkm, $Ttari, $Ttiex, $Ttag, $Tstdv, $Tcome, $Tcond, $Tunid);//Se usa para filtrar los datos

        if($smt->execute()){
            echo "<script> window.location='registro.php' </script>";
        } else {
            echo "<script> alert('Error contacte al administrador: clsoporte3@cgcsf.mx'); window.location='registro.php' </script>";
        }
    }

?>