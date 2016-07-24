<script type="text/javascript">
  var l = "<?php echo $_GET['search_'] ?>";
t  $("#itulo").html("Sociedad De "+l+"<img onclick='location.reload();' style='width: 30px; margin-left: 10px;' src='img/menu.png'>");
</script>
<table class="table">

      <thead style='font: bold 15px "Trebuchet MS";'>
        <tr>
          <td>Nombres y Apellidos</td>
          <td>Cedula</td>
          <td>Funcion</td>
          <td>Acciones</td>
        </tr>
      </thead>
      <tbody>
        <?php
          include("conexion.php");
          $sql = "SELECT * FROM personas WHERE sociedad='$_GET[search_]'";
          $result = mysql_query($sql) or die(mysql_error());
          $total = mysql_num_rows($result);
          
          if ($total > 0) {
            while ($row = mysql_fetch_assoc($result)) {
              ?><tr>
                  <td><?php echo $row["nombres"]." ".$row["apellidos"]; ?></td>
                  <td><?php echo $row["cedula"]; ?></td>
                  <td><?php echo $row["funcion"]; ?></td>
                  <td><a href="#" onclick="ver(<?php echo $row['id']; ?>);">Ver </a> 
                      <a href="#" onclick="editar(<?php echo $row['id']; ?>);">Editar</a> 
                      <a href="#" onclick="eliminar(<?php echo $row['id']; ?>);">Eliminar</a></td>
                </tr>
              <?php
            }
          } else {
          ?>
            <tr><td colspan="4">Ninguna persona agregada!</td> </tr>
          <?php
          }

        ?>
      </tbody>
    </table>