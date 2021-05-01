//Evento que se activa al iniciar sesion:
$(document).ready(function(){
    $('#login-form').submit(function(e) {
          e.preventDefault();
          var informacion=$('#login-form').serialize();
          var metodo=$('#login-form').attr('method');
          var peticion=$('#login-form').attr('action');
          $.ajax({
             type: metodo,
             url: peticion,
             data:informacion,
             beforeSend: function(){
             $("#accediendo").html('<br><p class="text-center"><img src="./img/enviando.gif" class="center-all-contens"></p><br>');
             },
             error: function() {
             $("#accediendo").html('Error en el sistema');
             },
             success: function (data) {
             $("#accediendo").html(data);
             }
         });
         return false;
     });
 
    });