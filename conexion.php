<?php
    $host   = 'localhost';
    $nom    = 'root';
    $pass   = '';
    $db     = 'taxibsf';  

    $conn = mysqli_connect($host, $nom, $pass, $db);

    if(!$conn){
        die("Error en la conexion: " . mysqli_connect_error());
    }

    /* Conexion con el servidor del 13
    //ip de la pc servidor base de datos
    define("DB_HOST", "mysql_tickets");

    // nombre de la base de datos
    define("DB_NAME", "control_asistencia");


    //nombre de usuario de base de datos
    define("DB_USERNAME", "root");
    //define("DB_USERNAME", "u222417_admin");

    //conraseña del usuario de base de datos
    define("DB_PASSWORD", "angel");
    //define("DB_PASSWORD", "Enero2020Admin");

    //codificacion de caracteres
    define("DB_ENCODE", "utf8");

    //nombre del proyecto
    define("PRO_NOMBRE", "CompartiendoCodigos");
    */
?>
