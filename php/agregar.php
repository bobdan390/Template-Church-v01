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
              var data = [$('#cedula').val(),$('#nombres').val(),$('#apellidos').val(),$('#fecha').val(),$('#arrepentimiento').val(),$('#estado_civil').val(),$('#funcion').val(),$('#sociedad').val()];
              for (var i = 0; i < data.length; i++) {
                if (data[i]=="") {isError=true;};
              };

              if (isError==true) {
                  $("#error_").show();
              } else{
                  $.post("php/guardarMiembro.php",{var1:data},function(respuesta){
                      document.body.scrollTop = 0;
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
        <td style="width: 90%;"><h2> Agregar Miembro !</h2></td>
        <td><img class="i" src="img/atras.png" style="width: 40px;" onclick="location.reload();" alt="Atras"></td>
        <td><img class="i" src="img/salir.png" style="width: 40px;" onclick="salir();" alt="Salir"></td>
      </tr>
    </table>
    <hr> 
    <br>
    <table style="width: 100%;">
      <tr>
        <td>
          <div>
            <img src="img/usuario.png">
          </div>
        </td>
        <td>
          <table >
            <tr>
              <td><b>Cedula: </b></td>
              <td> <input id="cedula" type="text" class="form-control"></input> </td>
            </tr>
            <tr>
              <td><b> Nombres: </b></td>
              <td> <input id="nombres" type="text" class="form-control"></input> </td>
            </tr>
            <tr>
              <td><b> Apellidos: </b></td>
              <td> <input id="apellidos" type="text" class="form-control"></input> </td>
            </tr>
            <tr>
              <td><b> Fecha de Nacimiento: </b></td>
              <td> <input id="fecha" type="text" class="form-control"></input> </td>
            </tr>
            <tr>
              <td><b> Fecha de Arrepentimiento: </b></td>
              <td> <input id="arrepentimiento" type="text" class="form-control"></input> </td>
            </tr>
            <tr>
              <td><b> Estado Civil: </b></td>
              <td>
                <select id="estado_civil" class="form-control">
                  <option>Soltero</option>
                  <option>Casado</option>
                  <option>Viudo</option>
                </select>
              </td>
            </tr>
            <tr>
              <td><b> Funcion: </b></td>
              <td> <input id="funcion" type="text" class="form-control"></input> </td>
            </tr>
            <tr>
              <td><b> Sociedad: </b></td>
              <td>
                <select id="sociedad" class="form-control">
                  <option>Damas</option>
                  <option>Jovenes</option>
                  <option>Caballeros</option>
                  <option>Interseccion</option>
                  <option>Tierra_Fertil</option>
                  <option>Semilleritos</option>

                </select>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td></td>
        <td style="text-align: center;"><button type="button" class="btn btn-danger" onclick="guardar();">Guardar</button></td>
      </tr>
    </table>
  </div>

  </p>
</div>

        <script src="js/index.js"></script>  
    
  </body>
</html>
