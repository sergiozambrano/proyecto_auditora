$(document).ready(function () {
  /**
   * Mostrando datos personales al usuario.
   */
  $.ajax({
    url: '../../Controller/Usuario/Setting.C.php',
    type: 'POST',
    datatype: 'json',
    success: function(data){
      data = JSON.parse(data);
      $('input#codigo_contrato').attr('value',data[0]['cod_contrato_usu']);
      $('input#primer_nombre').attr('value', data[0]['nombre_pri_per']);
      $('input#segundo_nombre').attr('value', data[0]['nombre_seg_per']);
      $('input#primer_apellido').attr('value', data[0]['apellido_pri_per']);
      $('input#segundo_apellido').attr('value', data[0]['apellido_seg_per']);
      $('input#tipo_documento').attr('value', data[0]['tipo_doc_per']);
      $('input#numero_documento').attr('value', data[0]['num_documento']);
      $('input#numero_celular').attr('value', data[0]['num_celular']);
      $('input#correo').attr('value', data[0]['correo']);
      $('input#fecha_nacimiento').attr('value', data[0]['fecha_nac_per']);
      $('input#genero').attr('value', data[0]['genero_per']);
      $('input#perfil_laboral').attr('value', data[0]['perfil_usu']);
    }
  });

  $('form#clave').submit(function(e){
    e.preventDefault();

    var data = {
      claveActual: $('#claveActual').val(),
      claveNueva: $('#claveNueva').val(),
      repetirClaveNueva: $('#repetirClaveNueva').val()
    }

    var alerta = $('div#alerta');

    if (data['claveActual'].length <= 0 && data['claveNueva'].length <= 0 && data['repetirClaveNueva'].length <= 0) {
      alerta.attr('class', 'alert alert-danger').attr('role', 'alert');
      alerta.text('Debe llenar todos los campos');

    }else{

      if (data['claveNueva'].length >=8 && data['claveNueva'].length <= 20) {
        var upper = new RegExp('[A-Z]');
        var lower = new RegExp('[a-z]');
        var numeros = new RegExp('[0-9]')
        var signos = new RegExp('[^A-Za-z0-9]');

        if (upper.test(data['claveNueva']) && lower.test(data['claveNueva']) && numeros.test(data['claveNueva'])
        && signos.test(data['claveNueva'])) {

          if (data['claveNueva'] == data['repetirClaveNueva']) {

            $.ajax({
              url: '../../Controller/Usuario/Setting.C.php',
              type: 'POST',
              data: data,
              datatype: 'json',
              success: function(data){

                if (data == 1) {
                  Swal.fire({
                    type:'success',
                    title:'La contraseña se ha actualizado correctamente',
                  });

                  $('#claveActual').val('');
                  $('#claveNueva').val('');
                  $('#repetirClaveNueva').val('');

                }else if(data == 0){
                  Swal.fire({
                    type:'error',
                    title:'No cambios no se guardaron satisfactoriamente',
                  });

                }else if(data == 2){
                  Swal.fire({
                    type:'error',
                    title:'La contraseña actual y la nueva no pueden ser iguales',
                  });

                }else if (data == 3) {
                  Swal.fire({
                    type:'error',
                    title:'La contraseña actual no coincide',
                  });
                }
              }
            });
          }else{
            alerta.attr('class', 'alert alert-danger').attr('role', 'alert');
            alerta.text('Las contraseñas no coinciden');
          }
        }else{
          alerta.attr('class', 'alert alert-danger').attr('role', 'alert');
          alerta.text('La contraseña debe tener como mínimo una  mayúscula, una mínuscula y un caracter especial');
        }
      } else {
        alerta.attr('class', 'alert alert-danger').attr('role', 'alert');
        alerta.text('La clave nueva debete tener mínimo 8 carateres y maxímo 20');
      }
    }
  });
});
