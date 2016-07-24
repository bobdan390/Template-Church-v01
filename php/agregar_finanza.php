<?php
  include("conexion.php");

  $sql = "SELECT * FROM personas ";
  $result = mysql_query($sql) or die(mysql_error());

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
              var data = [$('#tipo').val(),$('#concepto').val(),$('#monto').val(),$('#miembro').val()];
              for (var i = 0; i < data.length; i++) {
                if (data[i]=="") {isError=true;};
              };

              if (isError==true) {
                  $("#error_").show();
              } else{
                  $.post("php/guardar_finanza.php",{var1:data},function(respuesta){
                      document.body.scrollTop = 0;
                      $("#succes_").show();
                      setTimeout(function(){ $(".content").load("php/tesoreria.php"); }, 5000);
                  });
              };
          }
           $(".form-control") .click(function() {
              $("#error_").hide();
          });

           $( "#tipo" ).change(function() {
              if ($("#tipo").val()=="+") {
                  $(".ocultar").show();
                  $("#conceptop_").html("<select id='concepto' class='form-control'>"
                  +"<option>Diezmo</option>"
                  +"<option>Ofrenda</option>"
                  +"<option>Primicia</option>"
                  +"</select>");
              } else{
                  $(".ocultar").hide();
                  $("#concepto_").html("<input id='concepto' type='text' class='form-control'/>");
                  $("#miembro").val(0);
              };
          });
    </script>  
  </head>

  <body>
<div class="alert alert-success" id="succes_" style="display:none;">Guardado con Exito ... Redirigiendo en 5 segs</div>
<div class="alert alert-danger" id="error_" style="display:none;">Errores en el Formulario</div>
<div class="wrapper">
  <div class="contenido">
    <table>
      <tr>
        <td style="width: 90%;"><h2> Agregar Ingreso/Egreso !</h2></td>
        <td><img class="i" src="img/atras.png" style="width: 40px;" onclick="$('.content').load('php/tesoreria.php');" alt="Atras"></td>
        <td><img class="i" src="img/salir.png" style="width: 40px;" onclick="salir();" alt="Salir"></td>
      </tr>
    </table>
    <hr> 
    <br>
    <table style="width: 100%;">
      <tr>
        <td>
          <div>
            <img src="img/dinero.png">
          </div>
        </td>
        <td>
          <table >
            <tr>
              <td><b>Tipo: </b></td>
              <td>
                 <select id="tipo" class="form-control">
                  <option value="+">Ingreso</option>
                  <option value="-">Egreso</option>
                </select> 
               </td>
            </tr>
            <tr>
              <td><b> Concepto: </b></td>
              <td id="concepto_"> 
                <select id="concepto" class="form-control">
                  <option>Diezmo</option>
                  <option>Ofrenda</option>
                  <option>Primicia</option>
                </select>
              </td>
            </tr>
            <tr>
              <td><b> Monto: </b></td>
              <td> <input id="monto" type="text" class="form-control" placeholder="10000"></input> </td>
            </tr>
            <tr class="ocultar">
              <td><b> Miembro: </b></td>
              <td>
                <select id="miembro" class="form-control">
                                    <option value="0">Ninguno...</option>

                  <?php 

                    while ($row = mysql_fetch_assoc($result)) {
                  ?>  
                      <option value="<?php echo $row['id']; ?>"><?php echo $row["nombres"] ." ". $row["apellidos"];  ?></option>
                  <?php  
                  }

                  ?>
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
