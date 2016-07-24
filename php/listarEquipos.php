    <?php
    // creamos la conexión a mysql
   include('conexion.php'); // incluimos el archivo de conexión a la Base de Datos 
    // hacemos la consulta de registros
    $query = "SELECT * FROM tbl_inventario";
    $queEmp1 = mysql_query($query);
    ?>
    <html>
    <head>
    <title>Listado</title>
    <style type="text/css">

    .wrapper{
    	display: block;
    }
    .contenido{
    	width: 100%;
    }

    </style>
    </head>
    <body>

           <ul class="nav nav-tabs">
  <li class="active"><a href="#">Agregar</a></li>
  <li><a href="#" onclick="location.reload();">Menu</a></li>
  <li><a href="#" onclick="window.location.href = 'index.html';">Salir</a></li>
</ul>



    	<p><h2> Listado</h2></p>
    	<hr>
    <table border="1" class="table table-hover">
      <thead>
        <tr>
            <td>Categoria</td>
            <td>Tipo</td>
            <td>Talla</td>
            <td>Codigo</td>
            <td>Fecha</td>
            <td>Descripcion</td>
            <td>Cantidad</td>
            <td colspan="2">Acciones</td>
        </tr>

      </thead>  
      <tbody>
        <?php while ($row = mysql_fetch_row($queEmp1)) { ?>
        <tr>
          <td><?php echo $row[1]; ?></td>
          <td><?php echo $row[2]; ?></td>
          <td><?php echo $row[3]; ?></td>
          <td><?php echo $row[4]; ?></td>
          <td><?php echo $row[5]; ?></td>
          <td><?php echo $row[6]; ?></td>
          <td><?php echo $row[7]; ?></td>


			<td><a href="#" onclick="eliminar(<?php echo $row[0]; ?>);">Eliminar</a></td> 
      <td><a href="#" onclick="modificar(<?php echo $row[0]; ?>);">Modificar</a></td>      
        </tr>
      </tbody>
      

      <?php } ?>
    </table>
    <script type="text/javascript">
        function eliminar(id){
                   $.post("eliminarEquipo.php",{aidi:id},function(respuesta3){
                      $(".contenido").load("listarEquipos.php");
                   });

        }

        function modificar(id){
            $(".contenido").load("editarInventario.php?aidi="+id);
        }
    </script>
    </body>
    </html>