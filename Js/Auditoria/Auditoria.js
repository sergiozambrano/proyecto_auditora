$(document).ready(function() {
  mostrar();


  function mostrar(id=0){
    $('tbody').empty();

    $.ajax({
      ur: '',
      type: 'POST',
      datatype: 'JSON',
      success: function(data) {

      }
    });
  }
});
