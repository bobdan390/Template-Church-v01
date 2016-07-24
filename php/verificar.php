<?php

include("conexion.php"); 


$user = $_POST['var1'];
$pass = $_POST['var2'];


$sql = "SELECT * FROM login WHERE usuario='$user' AND clave='$pass'";
$result = mysql_query($sql) or die(mysql_error());
$total = mysql_num_rows($result);
$row = mysql_fetch_assoc($result);
if ($total > 0) {
	session_start();
	$_SESSION['login']=true;
	echo 1;
} else {
	echo 0;
}





?>