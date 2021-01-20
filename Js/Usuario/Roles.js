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
        $('select#selectRol').append("<option value="+i+">"+data[i][0]+"</option>");
      }

      acceso(data[0][0]);
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
          accion  = "<a class='nav-link' href='../Area/Area.php' target='main'><span>Areás</span></a>"+
                    "<a class='nav-link' href='../UsuarioRol/UsuarioRol.php' target='main'><span>Usuarios</span></a>"+
                    "<a class='nav-link' href='../Persona/Persona.php' target='main'><span>Personas</span></a>"+
                    "<a class='nav-link' href='../Rol/Rol.php' target='main'><span>Roles</span></a>"+
                    "<a class='nav-link' href='' target='main'><span>Backup</span></a>";
          break;

        case 'Auditor':
          accion  = "<a class='nav-link' href='../Hallazgo/HallazgoAuditor/Hallazgo.html' target='main'><span>Hallazgo</span></a>"+
                    "<a class='nav-link' href='../Auditoria/ProgramaAuditoria.php' target='main'><span>Mis auditorias</span></a>";
          break;

        case 'Coordinador de auditoría':
          accion  = "<a class='nav-link' href='../ProgramacionAuditoria/ProgramacionAnual.php' target='main'><span>Plan anual</span></a>"+
                    "<a class='nav-link' href='../Reportes/ReporteAnual.php' target='main'><span>Reportes</span></a>"+
                    "<a class='nav-link' href='../ProgramacionAuditoria/Anexo.php' target='main'><span>Anexos</span></a>"+
                    "<a class='nav-link' href='../Hallazgo/HallazgoCoordinador/VistaHallazgo.php' target='main'><span>Hallazgos</span></a>";
          break;

        case 'Coordinador de área':
          accion  = "<a class='nav-link' href='../PlanMejoramiento/PlanMejoramiento.php' target='main'><span>Plan de mejoramiento</span></a>"+
                    "<a class='nav-link' href='../PlanMejoramiento/Anexo/Anexos.php' target='main'><span>Anexos</span></a>";
          break;
      }

      //Agregando los accesos a la vista
      cont.innerHTML = accion;
      $('li#acceso').find('div').replaceWith(cont);
  }

});
