<?php

    include('conexion.php'); // incluimos el archivo de conexión a la Base de Datos 

    $info = $_POST["var1"];
    
    $query_ ="DELETE FROM tesoreria WHERE id='".$info."'";
    mysql_query($query_);
	

    
?>