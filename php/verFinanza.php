<?php
  include("conexion.php");

  $sql = "SELECT * FROM tesoreria WHERE id='$_GET[id]'";
  $result = mysql_query($sql) or die(mysql_error());
  $row = mysql_fetch_assoc($result);
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8"> 
    <style type="text/css">
      #content{
        width: 80%;
        height: 550px;
        background-color: white;
      }
      td img{
        cursor: pointer;
      }
      td img:hover{
        opacity: 0.5;
      }

    </style> 
        <script type="text/javascript">
          function salir(){
              window.location.href ="php/salir.php";
          }
          function guardar(){
              var isError = false;
              var data = [$('#cedula').val(),$('#nombres').val(),$('#apellidos').val(),$('#fecha').val(),$('#arrepentimiento').val(),$('#estado_civil').val(),$('#funcion').val()];
              for (var i = 0; i < data.length; i++) {
                if (data[i]=="") {isError=true;};
              };

              if (isError==true) {
                  $("#error_").show();
              } else{
                  $.post("php/guardarMiembro.php",{var1:data},function(respuesta){
                      $("#succes_").show();
                      setTimeout(function(){ $('.content').load('php/tesoreria.php'); }, 3000);
                  });
              };
          }
           $(".form-control") .click(function() {
              $("#error_").hide();
          });
    </script>  
  </head>

  <body>
<div class="alert alert-success" id="succes_" style="display:none;">Miembro Guardado con Exito ... Redirigiendo en 5 segs</div>
<div class="alert alert-danger" id="error_" style="display:none;">Errores en el Formulario</div>
<div class="wrapper">
  <div class="contenido">
    <table>
      <tr>
        <td style="width: 90%;"><h2> Ver Ingreso/Egreso !</h2></td>
        <td><img class="i" src="img/atras.png" style="width: 40px;" onclick="$('.content').load('php/tesoreria.php');" alt="Atras"></td>
        <td><img class="i" src="img/salir.png" style="width: 40px;" onclick="salir();" alt="Salir"></td>
      </tr>
    </table>
    <hr> 
    <br>
    <table style="width: 100%;">
      <tr>
        <td style="width: 40%;">
          <div>
            <img src="img/dinero.png">
          </div>
        </td>
        <td>
          <table style="width: 100%;">
            <tr>
              <td><b>Monto: </b></td>
              <td> Bs. <?php echo $row["monto"]; ?> </td>
            </tr>
            <tr>
              <td><b> Tipo: </b></td>
              <td> <?php 
                if ($row["tipo"]=="+") {
                  echo "Ingreso";
                } else {
                  echo "Egreso";                  
                }
                
               ?> </td>
            </tr>
            <tr>
              <td><b> Concepto: </b></td>
              <td> <?php echo $row["concepto"]; ?> </td>
            </tr>
            <tr>
              <td><b> Fecha: </b></td>
              <td> <?php echo $row["fecha"]; ?> </td>
            </tr>

            <?php 
              if ($row["id_persona"]>0) {
                $sql = "SELECT * FROM personas WHERE id='$row[id_persona]'";
                $result = mysql_query($sql) or die(mysql_error());
                $row_p = mysql_fetch_assoc($result);
                ?>
                  <tr>
                    <td><b>Del Hermano</b></td>
                    <td><?php echo $row_p["nombres"]; ?></td>
                  </tr>
                <?php
              } 
                
            ?>
        
    </table>
  </div>

  </p>
</div>

        <script src="js/index.js"></script>  
    
  </body>
</html>