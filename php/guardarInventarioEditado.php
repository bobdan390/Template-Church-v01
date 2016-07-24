<?php

    include('conexion.php'); // incluimos el archivo de conexión a la Base de Datos 

   $info = $_POST["var1"];

    $query = "UPDATE tbl_inventario SET categoria='$info[1]',tipo='$info[2]',talla='$info[3]',codigo='$info[4]',fecha='$info[5]',descripcion='$info[6]',cantidad='$info[7]' WHERE id = '$info[0]'";


    //"values('','".$info[1]."','".$info[2]."','".$info[3]."','".$info[4]."', '".$info[5]."','".$info[6]."','".$info[7]."')";
    $reg = mysql_query($query) or die('Consulta fallida: ' . mysql_error());	

    if ($reg) {
    	echo 1;
    } else {
    	echo 0;
    }
    
?>