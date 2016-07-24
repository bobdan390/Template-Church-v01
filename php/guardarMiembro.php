<?php

    include('conexion.php'); // incluimos el archivo de conexión a la Base de Datos 

    $info = $_POST["var1"];

    $query = "Insert into personas values('','".$info[0]."','".$info[1]."','".$info[2]."','".$info[3]."', '".$info[4]."','".$info[5]."','".$info[6]."','".$info[7]."')";
    $reg = mysql_query($query) or die('Consulta fallida: ' . mysql_error());	

    if ($reg) {
    	echo 1;
    } else {
    	echo 0;
    }
    
?>