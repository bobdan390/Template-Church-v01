<?php
  include("conexion.php");
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
        width: 80%;
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
              $(".content").load("php/agregar.php");
          }
          function ver(item){
              $(".content").load("php/verMiembro.php?id="+item);
          }
          function editar(item){
              $(".content").load("php/editarMiembro.php?id="+item);
          }

          function eliminar(item){
              $.post("php/eliminar.php",{var1:item},function(respuesta){
                    
                      $("#succes_").show();
                      setTimeout(function(){ location.reload(); }, 3000);
              });
          }
          function tesoreria(){
              $(".content").load("php/tesoreria.php");
          }
          function buscar(item){
            $("#panel").load("php/buscar.php?search_="+item);
          }
    </script>
  </head>

  <body>

  <div class="alert alert-success" id="succes_" style="display:none;">Miembro Eliminado...</div>
    <div class="wrapper">
  <div class="contenido">
    <table>
      <tr>
        <td style="width: 85%;"><h2 id="titulo"> Membresia General!</h2></td>
        <td><img class="i" src="img/tesoreria.png" style="width: 70px;" onclick="tesoreria();" alt="Tesoreria"></td>
        <td><img class="i" src="img/add_usuario.png" style="width: 70px;" onclick="agregar();" alt="Nuevo"></td>
        <td><img class="i" src="img/salir.png" style="width: 70px;" onclick="salir();" alt="Salir"></td>
      </tr>
    </table>
    <div id="l">
<div style="text-align:center;"> <a href="#" onclick="buscar('Damas');">Damas</a> - <a href="#" onclick="buscar('Semilleros');">Semilleros</a>
    <a href="#" onclick="buscar('Tierra_Fertil');">Tierra Fertil</a> - <a href="#" onclick="buscar('Jovenes');">Jovenes</a> - <a href="#" onclick="buscar('caballeros');">Caballeros</a> 
    - <a href="#" onclick="buscar('Interseccion');">Interseccion</a> <a href="#">Miembros Activos</a> - <a href="#">Miembros Descarriados</a></div>
      
    </div>
    <br>
    
    <div style="max-height: 250px; overflow-y: auto;"> 
    <table class="table" id="panel">
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
          $sql = "SELECT * FROM personas ORDER BY id DESC";
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
    </div>
  </div>

  </p>
</div>

        <script src="js/index.js"></script>
 
  </body>
</html>
