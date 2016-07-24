<?php include('Connections/sesionCliente.php'); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="css/styleIE.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.mnmenu.js"></script>
<title></title>
<style type="text/css">
#bgHeader {
	position:absolute;
	left:0px;
	top:0px;
	width:100%;
	height:70px;
	z-index:1;;
	background-color:#2E3842;
}
#divHeader {
	position:absolute;
	left:265px;
	top:25px;
	width:auto;
	height:25px;
	z-index:2;;
}
#divLogo {
	position:absolute;
	left:0px;
	top:0px;
	width:263px;
	height:70px;
	z-index:2;
	background-image: url(img/logo.png);
}
#divMain {
	position:absolute;
	left:0px;
	top:71px;
	width:99%;
	z-index:2;
	background-color:#096;
}
</style>
</head>

<body>
<div id="bgHeader"></div>
<div id="divLogo"></div>
<div id="divHeader">
    <ul id="idmenu">
    	<li class="dropdown">

    		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Reportes</a>
    		<ul class="dropdown-menu">
    				<li> <a href="reportes/por_usuario.php" target="mainIframe">Usuario</a> </li>
    				<li> <a href="reportes/por_vehiculo.php" target="mainIframe">Tipo de Transporte</a> </li>
    				<li> <a href="reportes/por_fecha.php" target="mainIframe">Fecha</a> </li>
    				<li> <a href="reportes/por_envio.php" target="mainIframe">Envios</a> </li>

    		</ul>
    	</li>
    	<li><a href="quejas/quejas.php" target="mainIframe">Quejas</a></li>
    	<li><a href="usuarios/usuarios.php" target="mainIframe">Usuarios</a></li>
    	<li><a href="pagos/pagos.php" target="mainIframe">Pagos</a></li>
    	<li><a href="nuevoEnvio/nuevoEnvio" target="mainIframe">Salir</a></li>
    </ul>
</div>

<div class="container-fluid">
	<div class="embed-responsive embed-responsive-4by3" style="top:71px; padding-bottom:539px !important;s">
		<iframe name="mainIframe" class="embed-responsive-item" id="content"></iframe>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
   $('#idmenu').mnmenu();
});
</script>
</body>
</html>