<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $bd = "ontologia";

    //conexion a la BD

    $conexion = new mysqli($servername,$username,$password,$bd);

    $estaus=false;

    if ($conexion->connect_error){
        die("La conexion falló". $conexion->connect_error);
    }

    $estaus=true;

?>