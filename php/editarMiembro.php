<?php
  include("conexion.php");

  $sql = "SELECT * FROM personas WHERE id='$_GET[id]'";
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
          function editar(){
              var isError = false;
              var data = [$('#cedula').val(),$('#nombres').val(),$('#apellidos').val(),$('#fecha').val(),$('#arrepentimiento').val(),$('#estado_civil').val(),$('#funcion').val(),$('#aidi').val()];
              for (var i = 0; i < data.length; i++) {
                if (data[i]=="") {isError=true;};
              };

              if (isError==true) {
                  $("#error_").show();
              } else{
                  $.post("php/editar.php",{var1:data},function(respuesta){
                      $("#succes_").show();
                      setTimeout(function(){ location.reload(); }, 5000);
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
        <td style="width: 90%;"><h2> Editar Miembro !</h2></td>
        <td><img class="i" src="img/atras.png" style="width: 40px;" onclick="location.reload();" alt="Atras"></td>
        <td><img class="i" src="img/salir.png" style="width: 40px;" onclick="salir();" alt="Salir"></td>
      </tr>
    </table>
    <hr> 
    <br>
    <table style="width: 100%;">
      <tr>
        <td style="width: 40%;">
          <div>
            <img src="img/usuario.png">
          </div>
        </td>
        <td>
          <table style="width: 100%;">
            <tr>
              <td><b>Cedula: </b></td>
              <td><input id="cedula" value="<?php echo $row['cedula']; ?>" type="text" class="form-control"></input>  </td>
            </tr>
            <tr>
              <td><b> Nombres: </b></td>
              <td><input id="nombres" value="<?php echo $row['nombres']; ?>" type="text" class="form-control"></input> </td>
            </tr>
            <tr>
              <td><b> Apellidos: </b></td>
              <td><input id="apellidos" value="<?php echo $row['apellidos']; ?>" type="text" class="form-control"></input> </td>
            </tr>
            <tr>
              <td><b> Fecha de Nacimiento: </b></td>
              <td> <input id="fecha" value="<?php echo $row['nacimiento']; ?>" type="text" class="form-control"></input> </td>
            </tr>
            <tr>
              <td><b> Fecha de Arrepentimiento: </b></td>
              <td> <input id="arrepentimiento" value="<?php echo $row['arrepentimiento']; ?>" type="text" class="form-control"></input> </td>
            </tr>
            <tr>
              <td><b> Estado Civil: </b></td>
              <td>
                <input id="estado_civil" value="<?php echo $row['estadoCivil']; ?>" type="text" class="form-control"></input>
              </td>
            </tr>
            <tr>
              <td><b> Funcion: </b></td>
              <td> <input id="funcion" value="<?php echo $row['funcion']; ?>" type="text" class="form-control"></input> </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td><input id="aidi" value="<?php echo $row['id']; ?>" type="hidden" class="form-control"></td>
        <td style="text-align: center;"><button type="button" class="btn btn-danger" onclick="editar();">Editar</button></td>
      </tr>
    </table>
  </div>

  </p>
</div>

        <script src="js/index.js"></script>  
    
  </body>
</html>
