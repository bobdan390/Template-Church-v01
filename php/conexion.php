<?php
// nos  conectamos a ejemplo.com y al puerto 3307
$enlace = mysql_connect('localhost','root','');
if  (!$enlace) {
    die('No pudo conectarse: ' . mysql_error());
}
//echo 'Conectado satisfactoriamente ahora';

mysql_select_db('redil') or die('No se pudo seleccionar la base de datos');
//mysql_close($enlace);

// Realizar una consulta MySQL

//$query = "Insert into tbl_usuarios values('','solimar','soporte tecnico','ingenier','1')";
//$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

//mysql_close($enlace);
//$query = "Insert into tbl_equipo values('','hp 22','epson 140','21', 'hp deskjet 2050','ps/2','ps/2','reguladpr')";
//$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());


?>

