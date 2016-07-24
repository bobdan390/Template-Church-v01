<?php require_once('../Connections/db.php'); ?>
<?php include('../Connections/sesionCliente.php'); include('../Connections/timezone.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$explode = explode("-", $_GET['code']);
$expPresup = $explode[0]; 
$expOferta = $explode[1];
$expChofer = $explode[2];

$_SESSION['expPresup'] = $expPresup;
$_SESSION['expOferta'] = $expOferta;
$_SESSION['expChofer'] = $expChofer;

mysql_select_db($database_db, $db);
$query_oferta = sprintf("SELECT * FROM ofertas WHERE ofertas.ID=%s", GetSQLValueString($expOferta, "int"));
$oferta = mysql_query($query_oferta, $db) or die(mysql_error());
$row_oferta = mysql_fetch_assoc($oferta);
$totalRows_oferta = mysql_num_rows($oferta);

mysql_select_db($database_db, $db);
$query_chofer = sprintf("SELECT * FROM usuarios WHERE usuarios.ID=%s", GetSQLValueString($expChofer, "int"));
$chofer = mysql_query($query_chofer, $db) or die(mysql_error());
$row_chofer = mysql_fetch_assoc($chofer);
$totalRows_chofer = mysql_num_rows($chofer);

mysql_select_db($database_db, $db);
$query_presupuesto = sprintf("SELECT * FROM presupueto WHERE presupueto.ID=%s", GetSQLValueString($expPresup, "int"));
$presupuesto = mysql_query($query_presupuesto, $db) or die(mysql_error());
$row_presupuesto = mysql_fetch_assoc($presupuesto);
$totalRows_presupuesto = mysql_num_rows($presupuesto);

$_SESSION['mntPresup'] = $row_presupuesto['monto'];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-modal.js"></script>
<title></title>
</head>

<body>
<div class="alert alert-success ui-corner-bottom" style="text-align:center; width:450px; margin:0 auto; margin-bottom:10px"><span class="glyphicon glyphicon-ok"></span>¡Felicidaddes! Solo falta tu Calificación.</div>

<div class="container">
  <h3>Nº <?php echo $row_oferta['ID']; ?> - <?php echo $row_oferta['titulo']; ?></h3>
  <div class="table-responsive">
  	<table class="table">
      <tr>
        <th colspan="2" class="bg-info">Información del envio</th>
        <th colspan="2" class="bg-info">Origen, destino e informacion de la ruta</th>
      </tr>
      <tr>
        <th>Nº de envio:</th>
        <td><?php echo $row_oferta['ID']; ?></td>
        <th>Origen</th>
        <td><?php echo $row_oferta['origen']; ?></td>
      </tr>
      <tr>
        <th>Estado:</th>
        <td><span class="bg-success">ACEPTADO</span></td>
        <th>Destino</th>
        <td><?php echo $row_oferta['destino']; ?></td>
      </tr>
    </table>
    <hr>
    <div style="text-align:center;">
    ¿LLEGO EL ENVIO A SU DESTINO?<br>
    <select name="recibiste" id="recibiste">
      <option value="1">SI</option>
      <option value="0">NO</option>
      <option value="--------" selected>--------</option>
    </select>
    </div>
    <br>
    <form role="form" id="form_calificar" action="recibeCalificar.php" method="POST" style="width:50%; margin: 0 auto; display:none;">
    	<div class="form-group" style="text-align:center;">
        	CALIFICA EL SERVICIO<br><img src="../img/good_or_bad.png" width="100" height="100" alt="wireTransfer">     
        </div>
        <div class="form-group">
          <label for="opinion">Indicanos cual es tu opinión:</label>
          <textarea name="opinion" class="form-control" required="required"></textarea> 
        </div>
        <div class="form-group">
          <label for="puntos">Como valoras el Servicio:</label >
          <select name="puntos" class="form-control selectpicker">
          	<option value="10">POSITIVO</option>
          	<option value="5">NEUTRAL</option>
            <option value="0">NEGATIVO</option>      
          </select>
      </div>
        <div class="form-actions" style="text-align:center;">
        	<input type="submit" name="ok" id="ok" value="Finalizar" class="btn btn-primary">
            <input type="hidden" name="MM_insert" value="<?php echo $row_oferta['ID']; ?>">
        </div>
    </form>
    <form role="form" id="form_problema" action="recibeProblema.php" method="POST" style="width:50%; margin: 0 auto; display:none;">
    <div class="form-group" style="text-align:center;">
        	PROBLEMAS CON EL SERVICIO<br><img src="../img/problemas.png" width="100" height="100" alt="wireTransfer">     
        </div>
        <div class="form-group">
          <label for="opinion">Indicanos cual es tu situación:</label>
          <textarea name="opinion" class="form-control" required="required"></textarea> 
        </div>
        <div class="form-group">
          <label for="puntos">Como valoras el Servicio:</label >
          <select name="puntos" class="form-control selectpicker">
            <option value="0" selected>NEGATIVO</option>      
          </select>
      </div>
        <div class="form-actions" style="text-align:center;">
        	<input type="submit" name="ok" id="ok" value="Finalizar" class="btn btn-primary">
            <input type="hidden" name="MM_insert" value="<?php echo $row_oferta['ID']; ?>">
        </div>
    </form>
  </div>
</div>
<script>
$(document).ready(function() {
	$("#recibiste").change(function(){
		var queDice = $("#recibiste").val();
		if(queDice==1){$("#form_calificar").show(); $("#form_problema").hide();}
		if(queDice==0){$("#form_problema").show(); $("#form_calificar").hide();}
	});
});
</script>                    
<script>
window.paypalCheckoutReady = function () {
	paypal.checkout.setup('YNZG7Y3KREWPN', {
		environment: 'sandbox',
		container: 'myContainer'
    });
 };
</script>
<script src="//www.paypalobjects.com/api/checkout.js" async></script>
</body>
</html>
<?php
mysql_free_result($oferta);

mysql_free_result($chofer);

mysql_free_result($presupuesto);
?>