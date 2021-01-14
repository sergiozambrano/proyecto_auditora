$(document).ready(function(){

  /**
   * Mostrando los roles y sus acciones del usuario que inicio sesión.
   */
  $.ajax({
    url:"../../Controller/Usuario/Roles.C.php",
    type:"POST",
    datatype: "json",
    success:function(data){
      data = JSON.parse(data);

      for (let i = 0; i < data.length; i++) {
        $('select#selectRol').append("<option value="+i+">"+data[i]['nombre_rol']+"</option>");
      }

      acceso(data[0]['nombre_rol']);
    }
  });

  /**
   * Detectar si hubo un cambio en la selección del rol para mostrar las acciones de ese rol
   */
  $('select#selectRol').on('change', function(){
    var data = $('select#selectRol option:Selected').text();
    acceso(data);

  });


  function acceso(data){
    var cont = document.createElement('div');

      //Mostrar los accesos dependiento el rol
      switch (data) {
        case 'Administrador':
          accion  = "<a class='nav-link' href='' target='main'><span>Areás</span></a>"+
                    "<a class='nav-link' href='' target='main'><span>Usuarios</span></a>"+
                    "<a class='nav-link' href='' target='main'><span>Roles</span></a>";
          break;

        case 'Auditor':
          accion  = "<a class='nav-link' href='../Auditoria/Hallazgo.html' target='main'><span>Hallazgo</span></a>"+
                    "<a class='nav-link' href='../Auditoria/ProgramaAuditoria.html' target='main'><span>Mis auditorias</span></a>";
          break;

        case 'Coordinador de auditoría':
          accion  = "<a class='nav-link' href='' target='main'><span>Coordinador de auditoria</span></a>";
          break;

        case 'Coordinador de área':
          accion  = "<a class='nav-link' href='' target='main'><span>Coordinador de area</span></a>";
          break;
      }

      //Agregando los accesos a la vista
      cont.innerHTML = accion;
      $('li#acceso').find('div').replaceWith(cont);
  }

});
