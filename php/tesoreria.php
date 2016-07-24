<?php
  include("conexion.php");
          $sql_ = "SELECT * FROM tesoreria ";
          $result_ = mysql_query($sql_) or die(mysql_error());
          $totales_ = 0;
          while ($row_ = mysql_fetch_assoc($result_)) {
            $totales_ = $totales_ + $row_["monto"];
          }

?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8"> 
    <style type="text/css">
      #content{
        width: 80%;
        height: 400px;
        background-color: white;
      }
      td img{
        cursor: pointer;
      }
      td img:hover{
        opacity: 0.5;
      }
      #l div{
        width: 20%;
margin: auto;
padding-top: 10px;
color: white;
      }
      #l div a{
        color: white;
      }
      #l{height: 50px;
        webkit-border-radius: 15px;
     -moz-border-radius: 15px;
          border-radius: 15px;
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#1e5799+0,1e5799+13,1e5799+24,1e5799+37,2989d8+50,207cca+51,1e5799+67,1e5799+80,1e5799+92,7db9e8+100;Blue+Gloss+Default */
background: rgb(30,87,153); /* Old browsers */
background: -moz-linear-gradient(45deg, rgba(30,87,153,1) 0%, rgba(30,87,153,1) 13%, rgba(30,87,153,1) 24%, rgba(30,87,153,1) 37%, rgba(41,137,216,1) 50%, rgba(32,124,202,1) 51%, rgba(30,87,153,1) 67%, rgba(30,87,153,1) 80%, rgba(30,87,153,1) 92%, rgba(125,185,232,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(45deg, rgba(30,87,153,1) 0%,rgba(30,87,153,1) 13%,rgba(30,87,153,1) 24%,rgba(30,87,153,1) 37%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(30,87,153,1) 67%,rgba(30,87,153,1) 80%,rgba(30,87,153,1) 92%,rgba(125,185,232,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(45deg, rgba(30,87,153,1) 0%,rgba(30,87,153,1) 13%,rgba(30,87,153,1) 24%,rgba(30,87,153,1) 37%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(30,87,153,1) 67%,rgba(30,87,153,1) 80%,rgba(30,87,153,1) 92%,rgba(125,185,232,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
      }
    </style>   
    <script type="text/javascript">
          function salir(){
              window.location.href ="php/salir.php";
          }
          function agregar(){
              $(".content").load("php/agregar_finanza.php");
          }
          function ver(item){
              $(".content").load("php/verFinanza.php?id="+item);
          }
          function editar(item){
              $(".content").load("php/editarMiembro.php?id="+item);
          }

          function eliminar(item){
              $.post("php/eliminar_finanza.php",{var1:item},function(respuesta){
                    
                      $("#succes_").show();
                      setTimeout(function(){ $('.content').load('php/tesoreria.php'); }, 3000);
              });
          }
          function tesoreria(){
              $(".content").load("php/tesoreria.php");
          }
          function buscar(item){
            $("#panel").load("php/buscar_finanza.php?tipo="+item);
          }
    </script>
  </head>

  <body>

  <div class="alert alert-success" id="succes_" style="display:none;">Eliminado...</div>
    <div class="wrapper">
  <div class="contenido">
    <table>
      <tr>
        <td style="width: 85%;"><h2 id="titulo"> Tesoreria! <span style="font-size: 20px;">  (Total Bs. : <?php echo $totales_; ?>)</span></h2> </td>
        <td><img class="i" src="img/menu.png" style="width: 70px;" onclick="location.reload();" alt="Tesoreria"></td>
        <td><img class="i" src="img/dinero_add.png" style="width: 70px;" onclick="agregar();" alt="Nuevo"></td>
        <td><img class="i" src="img/salir.png" style="width: 70px;" onclick="salir();" alt="Salir"></td>
      </tr>
      
    </table>
    
    <div id="l">
      <div style="text-align:center;"> 
      <a href="#" onclick="buscar('mas');">Ingresos</a> -   
      <a href="#" onclick="buscar('menos');">Egresos</a>
    </div>
    </div>
    <br>
    Ultimos Movimientos !!
    <div style="max-height: 250px; overflow-y: auto;"> 
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
          $sql = "SELECT * FROM tesoreria ORDER BY id DESC";
          $result = mysql_query($sql) or die(mysql_error());
          $total = mysql_num_rows($result);
          
          if ($total > 0) {
            while ($row = mysql_fetch_assoc($result)) {
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
          } else {
          ?>
            <tr><td colspan="4">Ninguna finanza agregada!</td> </tr>
          <?php
          }

        ?>
      </tbody>
    </table>
    </div>
  </div>

  </p>
</div>

        <script src="js/index.js"></script>
 
  </body>
</html>
