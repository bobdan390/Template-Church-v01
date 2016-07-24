<?php

    include('conexion.php'); // incluimos el archivo de conexión a la Base de Datos 

    $info = $_POST["var1"];

    $fecha = date("d-m-Y");

    $query = "Insert into tesoreria values('','".$info[2]."','".$info[0]."','".$info[3]."','".$info[1]."','".$fecha."')";
    $reg = mysql_query($query) or die('Consulta fallida: ' . mysql_error());	

    if ($reg) {
    	echo 1;
    } else {
    	echo 0;
    }
    
?>