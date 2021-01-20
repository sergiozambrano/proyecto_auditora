$(document).ready(function () {
  $('form#formCodigo').hide();

  /**
   * Validacion del usuario y creacion del código
   */
  $('#formRecCon').submit(function(e) {
    e.preventDefault();

    var documento = $.trim($('#documento').val());

    $.ajax({
      url:"../../Controller/Autenticacion/Recuperar.C.php",
      type:"POST",
      datatype: "json",
      data: {documento: documento, accion:'codigo'},
      success: function (data) {
        data = JSON.parse(data);

        if (data == 1) {
          $('form#formCodigo').show();
          $('form#formRecCon').hide();

          Swal.fire({
            type:'success',
            title:'Se envió un código de verificación al correo registrado',
          });

        }else if(data == 0){
          Swal.fire({
            type:'error',
            title:'No se pudo enviar el correo, intentelo nuevamente',
          });

        }else if(data == 2){
          Swal.fire({
            type:'error',
            title:'El documento no se encuentra registrado',
          });
        }
      }
    });
  });

  /**
   * Envía el código digitado para ser validado
   */
  $('#formCodigo').submit(function (e) {
    e.preventDefault();

    var codigoDigitado = $.trim($('#codigo').val());

    $.ajax({
      url:"../../Controller/Autenticacion/Recuperar.C.php",
      type:"POST",
      datatype: "json",
      data: {codigoDigitado: codigoDigitado, accion:'validar'},
      success: function(data){
        if (data == 1) {
          Swal.fire({
            title: 'Contraseña restablecida exitosamente',
            text: "recuerda cambiarla nuevamente",
            type: 'success',
          });

          setTimeout(function(){
            $(location).attr('href',"../../index.html");
          }, 4000);

        }else if(data == 2){
          Swal.fire({
            type:'error',
            title:'Limite de intentos alcanzado',
            text: 'El código suministrado no coincide',
          });
          setTimeout(function(){
            location.reload();
          }, 3000);

        }else if(data == 0){
          Swal.fire({
            type:'error',
            title:'No se pudo modificar la contraseña error en el sistema',
          });
          setTimeout(function(){
            location.reload();
          }, 3000);
        }
      }
    });
  });

  /**
   * Recarga la pagina para volver a mostar el formulario anterior
   */
  $('#volver').click(function (e) {
    location.reload();
  });
});

