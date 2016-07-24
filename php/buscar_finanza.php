<table class="table" id="panel">
      <thead style='font: bold 15px "Trebuchet MS";'>
        <tr>
          <td>(Accion) Monto</td>
          <td>Ingreso/Egreso</td>
          <td>Concepto</td>
          <td>Acciones</td>
        </tr>
      </thead>
      <tbody>
        <?php
          include("conexion.php");
          $l = $_GET["tipo"];
          if ($l=="mas") {
            $_GET["tipo"]="+";
          } else {
            $_GET["tipo"]="-";
          }
          
          $sql = "SELECT * FROM tesoreria WHERE tipo ='$_GET[tipo]'";
          $result = mysql_query($sql) or die(mysql_error());
          $total = mysql_num_rows($result);
          
          if ($total > 0) {
            $total_ = 0;
            while ($row = mysql_fetch_assoc($result)) {
                  $total_ = $total_ + $row["monto"];
              ?><tr>
                  <td><?php 
                  if ($row["tipo"]=="+") {
                    $tipo = "Ingreso";
                  } else {
                    $tipo = "Egreso";
                  }
                  
                  echo "( ".$row["tipo"]." ) " . $row["monto"] ?> Bs.</td>
                  <td><?php echo $tipo ?></td>
                  <td><?php echo $row["concepto"] ?></td>
                  <td><a href="#" onclick="ver(<?php echo $row['id']; ?>);">Ver </a> 
                      <a href="#" onclick="eliminar(<?php echo $row['id']; ?>);">Eliminar</a></td>
                </tr>
              <?php
            }
            ?>
            <script type="text/javascript">
            var l = "<?php echo $_GET['tipo']; ?>";

            if (l=="+") {var m = "Ingreso";} else {var m ="Egreso";};

            $("#titulo").html( m + "<span style='font-size: 20px;'>  (Total Bs. : <?php echo $total_; ?>)</span>"

              +"<img onclick='ir();' style='width: 30px; margin-left: 10px;' src='img/atras.png'>");

            function ir(){
              $('.content').load('php/tesoreria.php');
            }
            </script>
            <?php
          } else {
          ?>
            <tr><td colspan="4">Ninguna finanza agregada!</td> </tr>
          <?php
          }

        ?>
      </tbody>
    </table>