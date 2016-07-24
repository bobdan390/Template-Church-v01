<?php

include("conexion.php");

$query = "SELECT * FROM tbl_inventario WHERE id='$_GET[aidi]'";
    $queEmp1 = mysql_query($query);
    $row = mysql_fetch_row($queEmp1);

//var_dump($_GET);

?>
<html>
<head>
<title>
AGREGAR</title>
<style type="text/css">



</style>

</head>

     <ul class="nav nav-tabs">
  <li class="active"><a href="#">Agregar</a></li>
  <li><a href="#" onclick="location.reload();">Menu</a></li>
  <li><a href="#" onclick="$('.contenido').load('listarEquipos.php');">Listado</a></li>
  <li><a href="#" onclick="window.location.href = 'index.html';">Salir</a></li>
</ul>

<p><h3>Editar Producto:</h3></p>
<hr>
<form class="form-horizontal" role="form" >
  <div class="form-group">
    <label for="equipo">Categoria :</label>
              <select id="categoria">
                
                <option value="Caballero" <?php if($row[1]=="Caballero"){echo "selected='selected'";} ?>>Caballero</option>
                <option value="Damas" <?php if($row[1]=="Damas"){echo "selected='selected'";} ?>>Damas</option>
                <option value="Bebes" <?php if($row[1]=="Bebes"){echo "selected='selected'";} ?>>Bebes</option>
                
              </select>
  </div>

  <div class="form-group">
    <label for="Nombre">Tipo de Produto:</label>
    <select id="tipo">
                
                <option value="Camisa" <?php if($row[2]=="Camisa"){echo "selected='selected'";} ?>>Camisa</option>
                <option value="Chemis" <?php if($row[2]=="Chemis"){echo "selected='selected'";} ?>>Chemis</option>
                <option value="Pantalon" <?php if($row[2]=="Pantalon"){echo "selected='selected'";} ?>>Pantalon</option>
                <option value="Pillama" <?php if($row[2]=="Pillama"){echo "selected='selected'";} ?>>Pillama</option>
                <option value="Franelillas" <?php if($row[2]=="Franelillas"){echo "selected='selected'";} ?>>Franelillas</option>
                <option value="Ropa Interior" <?php if($row[2]=="Ropa Interior"){echo "selected='selected'";} ?>>Ropa Interior</option>     
              
    </select>

  </div>

  <div class="form-group">
    <label for="talla">talla:</label>
    <select id="talla">
                <option value="ss" <?php if($row[3]=="ss"){echo "selected='selected'";} ?>>SS</option>
                <option value="s" <?php if($row[3]=="s"){echo "selected='selected'";} ?>>S</option>
                <option value="m" <?php if($row[3]=="m"){echo "selected='selected'";} ?>>M</option>
                <option value="l" <?php if($row[3]=="l"){echo "selected='selected'";} ?>>L</option>
                <option value="xl" <?php if($row[3]=="xl"){echo "selected='selected'";} ?>>XL</option>
                <option value="xxl" <?php if($row[3]=="xxl"){echo "selected='selected'";} ?>>XXL</option>
    </select>
  </div>

  <div class="form-group">
    <label for="Codigo">Codigo del Producto:</label>
    <input type="text" class="form-control" id="Codigo"
           placeholder="Codigo" value="<?php echo $row[4]; ?>">
  </div>

  <div class="form-group">
    <label for="Fecha">Fecha de Elaboraci&oacuten:</label>
    <input type="text" class="form-control" id="Fecha"
           placeholder="Fecha" value="<?php echo $row[5]; ?>">
  </div>

  <div class="form-group">
    <label for="Descripcion">Descripci&oacuten:</label>
    <input type="text" class="form-control" id="Descripcion"
           placeholder="Descripcion" value="<?php echo $row[6]; ?>">
  </div>

  <div class="form-group">
    <label for="Cantidad">Cantidad</label>
    <input type="text" class="form-control" id="Cantidad"
           placeholder="Cantidad" value="<?php echo $row[7]; ?>">
    <input type="hidden" id="aidi" value="<?php echo $row[0]; ?>">
  </div>

  <button type="button" class="btn btn-default" onclick="enviar();">Editar</button>
</form>
</body>

<script type="text/javascript">
function enviar(){
	/*var equipo = $("#equipo").val();
	var nombre = $("#Nombre").val();
	var procesador = $("#Procesador").val();
	var nucleo = $("#Nucleo").val();
	var tarjeta = $("#Tarjeta").val();
	var nombre = $("#equipo").val();
	var modelo = $("#Modelo").val();*/
	var array =[$("#aidi").val(),$("#categoria").val(),$("#tipo").val(),$("#talla").val(),$("#Codigo").val(),$("#Fecha").val(),$("#Descripcion").val(),$("#Cantidad").val()];
	var error = false;
	for (var i = 0; i < array.length; i++) {
		
		if (array[i]=="") {
			error = true;
			//alert("Campos por llenar!!");
		} 

	};

	if (error==false) {
			 $.post("guardarInventarioEditado.php",{var1:array},function(respuesta){

          //alert(respuesta);
        
					if (respuesta==1) {
							alert("Guardado Correctamente!!");
							$(".contenido").load("listarEquipos.php");
					} else{
							alert("Error en la conexion con la bd - Revisar Conexion!!");
					};
        
			 });		
	}else{
    alert("Campos por Llenar!!");
  };
}
</script>
</html>