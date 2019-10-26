
// $(document).ready(function() {
function mensajesenviados() {
 table11 = $('#mensajesenviados').DataTable({
      // "iDisplayLength": 5, //Paginacion

//       "bDestroy": true,
      "bProcessing": true,
      "bServerSide": true,
//       "bPaginate": true,
      language: {
    "decimal": "",
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
},
      'ajax': {
         url: 'controlador/mensaje.php?op=mostrarmensajesenviados',
         // controlador/mensaje.php?op=mostrarmensajesenviados
         type: "post",
         dataType: "json",
         beforeSend: function () {
          $(".cuerpo").css('filter', 'blur(2px)');
       },
       error: function (e) {
          console.log(e.responseText);
       },
       complete: function (data) {
          $(".cuerpo").css('filter', 'blur(0px)');
          $('#mensajesenviados_filter input').addClass('form-control')
          $('.dataTables_filter').css('text-align','center')
       }
    },
    'drawCallback': function(){
      $('input[type="checkbox"]').iCheck({
         checkboxClass: 'icheckbox_flat-green'
      });
   },

   'columnDefs':[
   {
      'targets':0,
      'checkboxes':{
       'selectRow':true,
       'stateSave': false,
       'selectCallback': function(nodes, selected){
         $('input[type="checkbox"]', nodes).iCheck('update');
         // console.log(nodes+selected);
if (selected==true) {
$("#botoneliminar").attr('disabled',false);
}else{
   $("#botoneliminar").attr('disabled',true);
}


      },
      'selectAllCallback': function(nodes, selected, indeterminate){
         $('input[type="checkbox"]', nodes).iCheck('update');
      }
   },
   className: 'revisar'
}
],
'stateSave': true,
'select': 'multi',
'select':{'style':'multi'},
'deferRender':true,
"order": [
[0, "desc"]
]
});
}
mensajesenviados();

   // Handle iCheck change event for "select all" control
   $(table11.table().container()).on('ifChanged', '.dt-checkboxes-select-all input[type="checkbox"]', function(event){
      var col11 = table11.column($(this).closest('th'));
      col11.checkboxes.select(this.checked);
   });

   // Handle iCheck change event for checkboxes in table body
   $(table11.table().container()).on('ifChanged', '.dt-checkboxes', function(event){
      var cell11 = table11.cell($(this).closest('td'));
      cell11.checkboxes.select(this.checked);
   });


   // Handle form submission event 
   $('#formularioenviados').on('submit', function(e){
      // Prevent actual form submission
      e.preventDefault();
      var form11 = this;
      

// $("#modal-confirmar-eliminacion").modal('show');      
var rows_selected11 = table11.column(0).checkboxes.selected();

      // Iterate over all selected checkboxes
      $.each(rows_selected11, function(index, rowId){
         // Create a hidden element 
         $(form11).append(
          $('<input>').attr('type', 'hidden').attr('name', 'idmensajes[]').val(rowId)
          );
      });
      idformulario11 = $(form11).serialize();

      // FOR DEMONSTRATION ONLY
      // The code below is not needed in production
      // Output form data to a console     
     console.log(rows_selected11.join(","));
      // Outputform data to a console     
      console.log($(form11).serialize());
       // console.log($(form).serialize());
      // Remove added elements


    // tipo == '1' enviados 
    // tipo == '2' recibidos
    swalWithBootstrapButtons({
        title: '¿Estas seguro de mover el/los mensajes a la papelera de reciclaje?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo moverlo',
        cancelButtonText: 'No quiero moverlo',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post('controlador/mensaje.php?op=moverpapelera', idformulario11, function(data) {
            }).done(function (data){
                // console.log(data);
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;

                switch (valorestado) {
                    case 'success':
                    alertaSuccess(valorestado, valormsg);
                    autoRefrescarenviado();
                    autoRefrescareliminado();
                    break;

                    case 'error':
                    alertaError(valorestado, valormsg);
                    break;

                    default:
                    break;
                }
            });  
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swalWithBootstrapButtons(
                'Cancelación de movimiento',
                'El mensaje no fue movido',
                'error'
                )
        }
    });
    
      $('input[name="idmensajes\[\]"]', $('#formularioenviados')).remove();
   });   
// });





// function globalScopeFunction(){
//             globalScope = 'this is a new var in the global scope!';
// }
// globalScopeFunction();

// console.debug(globalScope);
// console.debug(window.globalScope);


////////////////////////////////////////////////////////


// funcion listar todos los articulos con estado 0 del usuario en la session
function mensajeseliminados() {
table10 = $('#mensajeseliminados').DataTable({
      // "iDisplayLength": 5, //Paginacion

//       "bDestroy": true,
      "bProcessing": true,
      "bServerSide": true,
//       "bPaginate": true,
      language: {
    "decimal": "",
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
},
      'ajax': {
         url: 'controlador/mensaje.php?op=mostrarmensajeseliminados',
         // controlador/mensaje.php?op=mostrarmensajesenviados
         type: "post",
         dataType: "json",
         beforeSend: function () {
          $(".cuerpo").css('filter', 'blur(2px)');
       },
       error: function (e) {
          console.log(e.responseText);
       },
       complete: function (data) {
        // console.log(data);
          $(".cuerpo").css('filter', 'blur(0px)');
          $('#mensajeseliminados_filter input').addClass('form-control')
          $('.dataTables_filter').css('text-align','center')
       }
    },
    'drawCallback': function(){
      $('input[type="checkbox"]').iCheck({
         checkboxClass: 'icheckbox_flat-green'
      });
   },

   'columnDefs':[
   {
      'targets':0,
      'checkboxes':{
       'selectRow':true,
       'stateSave': false,
       'selectCallback': function(nodes, selected){
         $('input[type="checkbox"]', nodes).iCheck('update');
         // console.log(nodes+selected);
if (selected==true) {
$("#botoneliminarcompleto").attr('disabled',false);
}else{
   $("#botoneliminarcompleto").attr('disabled',true);
}


      },
      'selectAllCallback': function(nodes, selected, indeterminate){
         $('input[type="checkbox"]', nodes).iCheck('update');
      }
   },
   className: 'revisar'
}
],
'stateSave': true,
'select': 'multi',
'select':{'style':'multi'},
'deferRender':true,
"order": [
[0, "desc"]
]
});

}
mensajeseliminados();



   // Handle iCheck change event for "select all" control
   $(table10.table().container()).on('ifChanged', '.dt-checkboxes-select-all input[type="checkbox"]', function(event){
      var col10 = table10.column($(this).closest('th'));
      col10.checkboxes.select(this.checked);
   });

   // Handle iCheck change event for checkboxes in table body
   $(table10.table().container()).on('ifChanged', '.dt-checkboxes', function(event){
      var cell10 = table10.cell($(this).closest('td'));
      cell10.checkboxes.select(this.checked);
   });


   // Handle form submission event 
   $('#formularioeliminados').on('submit', function(e){
      // Prevent actual form submission
      e.preventDefault();
      var form10 = this;
      

// $("#modal-confirmar-eliminacion").modal('show');      
var rows_selected10 = table10.column(0).checkboxes.selected();

      // Iterate over all selected checkboxes
      $.each(rows_selected10, function(index, rowId){
         // Create a hidden element 
         $(form10).append(
          $('<input>').attr('type', 'hidden').attr('name', 'idmensajes[]').val(rowId)
          );
      });
      idformulario10 = $(form10).serialize();

      // FOR DEMONSTRATION ONLY
      // The code below is not needed in production
      // Output form data to a console     
     console.log(rows_selected10.join(","));
      // Outputform data to a console     
      console.log($(form10).serialize());
       // console.log($(form).serialize());
      // Remove added elements


    // tipo == '1' enviados 
    // tipo == '2' recibidos
    swalWithBootstrapButtons({
        title: '¿Estas seguro de eliminar el/los mensajes de la papelera de reciclaje?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo eliminarlo',
        cancelButtonText: 'No quiero eliminarlo',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post('controlador/mensaje.php?op=eliminarmensaje', idformulario10, function(data) {
            }).done(function (data){
                // console.log(data);
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;

                switch (valorestado) {
                    case 'success':
                    alertaSuccess(valorestado, valormsg);
                    autoRefrescareliminado();
                    break;

                    case 'error':
                    alertaError(valorestado, valormsg);
                    break;

                    default:
                    break;
                }
            });  
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swalWithBootstrapButtons(
                'Cancelación de eliminación',
                'El mensaje no fue eliminado',
                'error'
                )
        }
    });
    
      $('input[name="idmensajes\[\]"]', $('#formularioeliminados')).remove();
   });   
// });





// funcion listar todos los articulos con estado 0 del usuario en la session
function contactosdeusuario() {
    tabla0 = $("#contactosdeusuario").DataTable({
        "iDisplayLength": 5, //Paginacion
        language: {
            "url": "js/Spanish.json"
        },
        "bDestroy": true,
        "bProcessing": true,
        "bServerSide": true,
        "bPaginate": true,
        "ajax": {
            url: 'controlador/contacto.php?op=mostrarcontactosdeusuario',
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $(".cuerpo").css('filter', 'blur(2px)');
            },
            error: function (e) {
                console.log(e.responseText);
            },
            complete: function (data) {
                $(".cuerpo").css('filter', 'blur(0px)');
                          $('#contactosdeusuario_filter input').addClass('form-control')
          $('.dataTables_filter').css('text-align','center')
            }
        },
        "order": [
        [0, "desc"]
        ]
    });
}
contactosdeusuario();

// Autrorefrescar datables del usuario normal
function autoRefrescarrecibidos() {
    $("#mensajesrecibidos").DataTable().ajax.reload(null, false); // user paging is not reset on reload
}

// Autrorefrescar datables del usuario normal
function autoRefrescarenviado() {
    $("#mensajesenviados").DataTable().ajax.reload(null, false); // user paging is not reset on reload
}

// Autrorefrescar datables del usuario normal
function autoRefrescareliminado() {
    $("#mensajeseliminados").DataTable().ajax.reload(null, false); // user paging is not reset on reload
}

// Autrorefrescar datables del usuario normal
function autoRefrescarcontacto() {
    $("#contactosdeusuario").DataTable().ajax.reload(null, false); // user paging is not reset on reload
}

function mostrardetallemensaje(idmensaje,tipomensaje){
//     // tipo == '1' enviados 
//     // tipo == '2' recibidos
//     // tipo == '0' eliminados 
$.ajax({
    type: "POST",
    url: "controlador/mensaje.php?op=detallemensaje&idmensaje="+idmensaje+"&tipomensaje="+tipomensaje,
    data: {},
    cache: false,
    contentType: false,
    processData: false,
    success: function(data) {  
        switch (tipomensaje) {
            case '0':
            // console.log('0');
            $("#message-view2").html(data);
            var inboxList2 = $('#message-list2');
            var inboxView2 = $('#message-view2');

            inboxList2
            .removeClass('animation-fadeInQuick2Inv')
            .addClass('display-none');

            inboxView2
            .removeClass('display-none')
            .addClass('animation-fadeInQuick2');
            break;

            case '2':
            $("#message-view").html(data);
            var inboxList = $('#message-list');
            var inboxView = $('#message-view');

            inboxList
            .removeClass('animation-fadeInQuick2Inv')
            .addClass('display-none');

            inboxView
            .removeClass('display-none')
            .addClass('animation-fadeInQuick2');
            break;

            default:
            // console.log(data);
            break;
        }
    },
    error: function(xhr,msg,excep) { console.log('Error: ' + msg + '/ ' + excep); }
});



}

function regresarenviados(tipomensaje){

    switch (tipomensaje) {
       case '0':
       var inboxList2 = $('#message-list2');
       var inboxView2 = $('#message-view2');

       inboxView2
       .removeClass('animation-fadeInQuick2')
       .addClass('display-none');

       inboxList2
       .removeClass('display-none')
       .addClass('animation-fadeInQuick2Inv');
       break;

       case '2':

       var inboxList = $('#message-list');
       var inboxView = $('#message-view');

       inboxView
       .removeClass('animation-fadeInQuick2')
       .addClass('display-none');

       inboxList
       .removeClass('display-none')
       .addClass('animation-fadeInQuick2Inv');
       break;

       default:
       // console.log(data);
       break;
   }

}


// activerecibidos activeenviados activeborrador activeeliminado li
// recibidos enviados borrador eliminado a
$("#enviados").on('click', function(event) {
    event.preventDefault();

    $("#activeenviados").addClass('active');
    $("#activerecibidos").removeClass('active');
    $("#activeeliminado").removeClass('active');

    $("#mostrar_recibidos").fadeOut('slow', function() {  
    });
    $("#mostrar_enviados").fadeIn('slow', function() { 
    });
    $("#mostrar_eliminados").fadeOut('slow', function() { 
    });
});

$("#recibidos").on('click', function(event) {
    event.preventDefault();
    
    $("#activeenviados").removeClass('active');
    $("#activerecibidos").addClass('active');
    $("#activeeliminado").removeClass('active');

    $("#mostrar_recibidos").fadeIn('slow', function() {  
    });
    $("#mostrar_enviados").fadeOut('slow', function() { 
    });
    $("#mostrar_eliminados").fadeOut('slow', function() { 
    });
});

$("#eliminado").on('click', function(event) {
    event.preventDefault();
    
    $("#activeenviados").removeClass('active');
    $("#activerecibidos").removeClass('active');
    $("#activeeliminado").addClass('active');

    $("#mostrar_recibidos").fadeOut('slow', function() {  
    });
    $("#mostrar_enviados").fadeOut('slow', function() { 
    });
    $("#mostrar_eliminados").fadeIn('slow', function() { 
    });
});


var swalWithBootstrapButtons = swal.mixin({
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger',
    buttonsStyling: false
});

// Aqui muestra el swall alert del tipo error
function alertaError(valorestado, valormsg) {
    swal({
        type: valorestado,
        title: 'Error',
        text: valormsg,
        showConfirmButton: false,
        timer: 3000
    });
}
// Aqui muestra el swall alert del tipo success
function alertaSuccess(valorestado, valormsg) {
    swal({
        type: valorestado,
        title: 'Exito',
        text: valormsg,
        showConfirmButton: false,
        timer: 3000
    });
}

function recargarPagina(direccion) {
    if (direccion.length > 0) {
        setTimeout(function () {
            window.location.replace(direccion);
        }, 2000);
    } else {
        setTimeout(function () {
            window.location.reload(true);
        }, 2000);
    }

}


$("#btn_restaurar").on('click',function(){
    $("#login-container").css({
        display: 'none'
    });
    $("#restart-container").css({
        display: 'block'
    });
    $("#form-login").val(''); 
    var validator = $( "#form-login" ).validate();
    validator.resetForm();

});

$(".btn_login").on('click',function(){
    $("#restart-container").css({
        display: 'none'
    });
    $("#register-container").css({
        display: 'none'
    });
    $("#login-container").css({
        display: 'block'
    });
    $("#form-reminder").val('');
    $("#form-register").val('');
    var validator = $( "#form-reminder" ).validate();
    validator.resetForm();
    var validator2 = $( "#form-register" ).validate();
    validator2.resetForm();
});


$("#btn_registrar").on('click',function(){
    $("#login-container").css({
        display: 'none'
    });
    $("#register-container").css({
        display: 'block'
    });
    $("#form-login").val('');
    var validator = $( "#form-login" ).validate();
    validator.resetForm();
});

//////////////////////////////////////

/* Login form - Initialize Validation */
$('#editarcontacto').validate({
                errorClass: 'help-block animation-slideUp', // You can change the animation class for a different entrance animation - check animations page
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group > div').append(error);
                },  
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    e.closest('.form-group').removeClass('has-success has-error');
                    e.closest('.help-block').remove();
                },
                rules: {  
                    'correocontac': {
                        required: true,
                        email: true
                    },
                    'nombrecontacto ': {
                        required: true
                    },
                    'telefonocont':{
                      required: true,
                      number: true
                    }
                },
                messages: {
                    'correocontac': {
                       required: 'Ingresa el correo',
                      email: 'Ingresa un correo valido'
                    },
                    'nombrecontacto': {
                        required: 'Ingresa tu nombre y apellido'
                    },
                    'telefonocont':{
                      required: 'Ingresa tu telefono',
                      number: 'Deben ser solo digitos'
                    }
                }
            });

///////////////////////////////////////
//////////////////////////////////////

/* Login form - Initialize Validation */
$('#registrocontacto').validate({
                errorClass: 'help-block animation-slideUp', // You can change the animation class for a different entrance animation - check animations page
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group > div').append(error);
                },  
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    e.closest('.form-group').removeClass('has-success has-error');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'correocontacto': {
                        required: true,
                        email: true
                    },
                    'nombreapellido': {
                        required: true
                    },
                    'telefonocontacto':{
                      required: true,
                      number: true
                    }
                },
                messages: {
                    'correocontacto': {
                       required: 'Ingresa el correo',
                      email: 'Ingresa un correo valido'
                    },
                    'nombreapellido': {
                        required: 'Ingresa tu nombre y apellido'
                    },
                    'telefonocontacto':{
                      required: 'Ingresa tu telefono',
                      number: 'Deben ser solo digitos'
                    }
                }
            });

///////////////////////////////////////
// 
//////////////////////////////////////


//////////////////////////////////////

/* Login form - Initialize Validation */
$('#enviarmensaje').validate({
                errorClass: 'help-block animation-slideUp', // You can change the animation class for a different entrance animation - check animations page
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group > div').append(error);
                },  
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    e.closest('.form-group').removeClass('has-success has-error');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'fcompose_users': {
                        required: true,
                        email: true
                    },
                    'asunto': {
                        required: true
                    },
                    'fcompose_message':{
                      required: true
                    }
                },
                // asunto fcompose_message 
                messages: {
                    'fcompose_users': {
                       required: 'Ingresa el correo',
                      email: 'Ingresa un correo valido'
                    },
                    'asunto': {
                        required: 'Ingresa el asunto'
                    },
                    'fcompose_message':{
                      required: 'Ingresa tu mensaje'
                    }
                }
            });

///////////////////////////////////////




/* Login form - Initialize Validation */
$('#form-login').validate({
                errorClass: 'help-block animation-slideUp', // You can change the animation class for a different entrance animation - check animations page
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group > div').append(error);
                },
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    e.closest('.form-group').removeClass('has-success has-error');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'login_email': {
                        required: true,
                        email: true
                    },
                    'login_password': {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    'login_email': 'Ingresa un correo valido',
                    'login_password': {
                        required: 'Ingresa la contraseña',
                        minlength: 'Tu contraseña debe tener más de 5 caracteres'
                    }
                }
            });

///////////////////////////////////////


///////////////////////////////////////////
/* Reminder form - Initialize Validation */
$('#form-reminder').validate({
                errorClass: 'help-block animation-slideUp', // You can change the animation class for a different entrance animation - check animations page
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group > div').append(error);
                },
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    e.closest('.form-group').removeClass('has-success has-error');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'reminder_email': {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    'reminder_email': 'Ingresa un correo valido'
                }
            });




/* Reminder form - Initialize Validation */
$('#cambioContraseña').validate({
                errorClass: 'help-block animation-slideUp', // You can change the animation class for a different entrance animation - check animations page
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group > div').append(error);
                },
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    e.closest('.form-group').removeClass('has-success has-error');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'side-profile-password': {
                        required: true,
                        minlength: 5
                    },
                    'side-profile-password-confirm': {
                        required: true,
                        equalTo: '#side-profile-password'
                    },
                },
                messages: {
              'side-profile-password': {
                    required: 'Ingresa una contraseña',
                    minlength: 'Tu contraseña debe tener más de 5 caracteres'
                },
                'register_password_verify': {
                    required: 'Ingresa una contraseña',
                    minlength: 'Tu contraseña debe tener más de 5 caracteres',
                    equalTo: 'Ingresa la misma contraseña'
                },
                }

            });



$.validator.addMethod('customphone', function (value, element) {
    return this.optional(element) || /^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/.test(value);
}, "Por favor entre un número de teléfono válido");

$('#form-register').validate({
                errorClass: 'help-block animation-slideUp', // You can change the animation class for a different entrance animation - check animations page
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group > div').append(error);
                },
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    if (e.closest('.form-group').find('.help-block').length === 2) {
                        e.closest('.help-block').remove();
                    } else {
                        e.closest('.form-group').removeClass('has-success has-error');
                        e.closest('.help-block').remove();
                    }
                },
                rules: {
                    'register_cedula':{
                        required: true,
                        minlength: 5,
                        number: true
                    },
                    'register_username': {
                        required: true,
                        minlength: 3
                    },
                    'register_email': {
                        required: true,
                        email: true
                    },
                    'register_telefono':{
                        required: true
                    },
                    'register_password': {
                        required: true,
                        minlength: 5
                    },
                    'register_password_verify': {
                        required: true,
                        equalTo: '#register_password'
                    },
                    'register_terms': {
                        required: true
                    },
                    'register_pregunta_segura':{
                        required: true
                    },
                    'register_respuesta_segura':{
                        required: true
                    },
                    'register_año':{
                        required: true
                    },
                    'register_seccion':{
                        required: true
                    }

                },
                messages: {
                  'register_cedula':{
                    required: 'Ingresa tu cedula',
                    minlength: 'Ingresa tu cedula bien',
                    number: 'Debes ingresar solo números'
                },
                'register_username': {
                    required: 'Ingresa tu nombre y apellido',
                    minlength: 'Ingresa tu nombre y apellido'
                },
                'register_email': 'Ingresa un correo valido',
                'register_telefono':{
                    required: 'Ingresa un telefono'
                },
                'register_password': {
                    required: 'Ingresa una contraseña',
                    minlength: 'Tu contraseña debe tener más de 5 caracteres'
                },
                'register_password_verify': {
                    required: 'Ingresa una contraseña',
                    minlength: 'Tu contraseña debe tener más de 5 caracteres',
                    equalTo: 'Ingresa la misma contraseña'
                },
                'register_terms': {
                    required: '¡Acepta los terminos y condiciones!'
                },
                'register_pregunta_segura':{
                    required: 'Ingresa la pregunta de seguridad'
                },
                'register_respuesta_segura':{
                    required: 'Ingresa la respuesta de seguridad'
                },
                'register_año':{
                    required: 'Selecciona un año'
                },
                'register_seccion':{
                    required: 'Selecciona una sección'
                }
            }
        });


var c = () => Array.from(document.getElementsByTagName("INPUT")).filter(cur => cur.type === 'checkbox' && cur.checked).length > 0;

$('#form-reminder').on('submit', function(e){
    e.preventDefault();
    formulario = $('#form-reminder').serialize();
    $.post('controlador/usuario.php?op=recordarcontrasena', formulario, function(data) {
    }).done(function (data){
        console.log(data);
    });
});




$("#reminder_email_cedula").on('keyup',function(){
  var email_cedula = this.value;
    $.post('controlador/usuario.php?op=revisaremailcedula', {'email_cedula':email_cedula}, function(data) {
    }).done(function (data){
        // console.log(data);
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                pregunta = datos.estado.pregunta_seguridad;
                if (valorestado == 'success') {
                  $("#alerterror").addClass('d-none')
                  $("#alertsucces").removeClass('d-none')
                  $("#btn-recordar-pregunta").attr('disabled',false)
                  $("#formFinal").removeClass('d-none')
                  $("#pregunta").val(pregunta);

                }else{
                  $("#alertsucces").addClass('d-none')
                  $("#alerterror").removeClass('d-none')
                  $("#btn-recordar-pregunta").attr('disabled',true)
                   $("#formFinal").addClass('d-none')
                }
    });
})



$("#cerrarError").on('click',function(e){
  e.preventDefault()
  $("#alerterror").addClass('d-none')
})

$("#cerrarSucces").on('click',function(e){
  e.preventDefault()
  $("#alertsucces").addClass('d-none')
})


$("#form-reminder-pregunta").on('submit',function(e){
  e.preventDefault()
  // formulario = $("#form-reminder-pregunta").serialize()
  // console.log(formulario)
  reminder_email_cedula = $("#reminder_email_cedula").val()
  pregunta = $("#pregunta").val()
  respuesta = $("#respuesta").val()

  formulario = {'reminder_email_cedula':reminder_email_cedula,'pregunta':pregunta,'respuesta':respuesta}
  $.post('controlador/usuario.php?op=restuararconpregunta', formulario, function(data) {
    }).done(function (data){
        // console.log(data);
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                valorecarga = datos.estado.recargar;
                if (valorestado == 'success') {
                    alertaSuccess(valorestado, valormsg);
                    direccion = 'index.php?vista=recuperar_clave&fp_code='+valorecarga;
                    recargarPagina(direccion);
                }else{
                    alertaError(valorestado, valormsg);

                }

})
  })



/* Reminder form - Initialize Validation */
$('#form-recuperar-contraseña').validate({
  // fp_code res_contraseña res_repite_contraseña
                errorClass: 'help-block animation-slideUp', // You can change the animation class for a different entrance animation - check animations page
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group > div').append(error);
                },
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    e.closest('.form-group').removeClass('has-success has-error');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'res_contraseña': {
                        required: true,
                        minlength: 5
                    },
                    'res_repite_contraseña': {
                        required: true,
                        equalTo: '#res_contraseña'
                    },
                },
                messages: {
              'res_contraseña': {
                    required: 'Ingresa una contraseña',
                    minlength: 'Tu contraseña debe tener más de 5 caracteres'
                },
                'res_repite_contraseña': {
                    required: 'Ingresa una contraseña',
                    minlength: 'Tu contraseña debe tener más de 5 caracteres',
                    equalTo: 'Ingresa la misma contraseña'
                },
                }

            });

$('#cambiarcontraseñafinal').on('click',function(e){
  e.preventDefault()
  formulario = $('#form-recuperar-contraseña').serialize()
    $.post('controlador/usuario.php?op=recuperarcontraseña', formulario, function(data) {
}).done(function(data){
  // console.log(data);
datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                switch (valorestado) {

                    case 'success':
                    alertaSuccess(valorestado, valormsg);
                    direccion = 'index.php';
                    recargarPagina(direccion);
                    break;

                    case 'error':
                    alertaError(valorestado, valormsg);
                    break;

                    default:
                    break;
                }
})
})


// Aqui puedo ver la extension del archivo
let ext = '';
$('input#register_foto[type="file"]').change(function () {
    ext = this.value.match(/\.(.+)$/)[1];
});

$('#form-register').on('submit', function(event) {
    event.preventDefault();
    var formdatanuevo = new FormData(document.getElementById('form-register'));

    register_cedula = $("#register_cedula").val(); 
    register_username = $("#register_username").val(); 
    register_email = $("#register_email").val(); 
    register_telefono = $("#register_telefono").val(); 
    register_password = $("#register_password").val(); 
    register_password_verify = $("#register_password_verify").val(); 
    register_pregunta_segura = $("#register_pregunta_segura").val(); 
    register_respuesta_segura = $("#register_respuesta_segura").val(); 

    if (register_cedula == '' || register_username == '' || register_email =='' || register_telefono =='' || register_password =='' || register_password_verify =='' || register_pregunta_segura =='' || register_respuesta_segura == '') {
    }else{
        if (register_password != register_password_verify) {
        }else{

 if(!c()) { // Si NO hay ningun checkbox chequeado.
   // console.log("Ningún chequeado..");
} else {


    // console.log(formdatanuevo);

    if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif') {
        $.ajax({
            type: "POST",
            url: "controlador/usuario.php?op=registrar",
            data: formdatanuevo,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                // console.log('con archivo');
                // console.log(data);
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                switch (valorestado) {

                    case 'success':
                    alertaSuccess(valorestado, valormsg);
                    direccion = 'index.php';
                    recargarPagina(direccion);
                    break;

                    case 'error':
                    alertaError(valorestado, valormsg);
                    break;

                    default:
                    break;
                }
            },
            error: function(xhr,msg,excep) { console.log('Error: ' + msg + '/ ' + excep); }
        });
    }else if (ext=='') {
        $.ajax({
            type: "POST",
            url: "controlador/usuario.php?op=registrar",
            data: formdatanuevo,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                // console.log('sin archivo');
                // console.log(data);
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                switch (valorestado) {

                    case 'success':
                    alertaSuccess(valorestado, valormsg);
                    direccion = 'index.php';
                    recargarPagina(direccion);
                    break;

                    case 'error':
                    alertaError(valorestado, valormsg);
                    break;

                    default:
                    break;
                }
            },
            error: function(xhr,msg,excep) { console.log('Error: ' + msg + '/ ' + excep); }
        });   
    }else{
        alertaError('error', 'Solo puedes subir imagenes');
    }

}
}
}
});





function cantidadmensajestotal(){
	$.post('controlador/mensaje.php?op=cantidadmensajestotal', {}, function(data) {
}).done(function(data){
	// console.log(data);
	$("#cantidadmensajestotal").html(data);
});
}

function cantidadcontactos(){
$.post('controlador/contacto.php?op=cantidadcontactos', {}, function(data) {
}).done(function(data){
	// console.log(data);
	$("#cantidadcontactos").html(data);
});
}
function cantidadmensajesen1(){
$.post('controlador/mensaje.php?op=cantidadmensajesen1', {}, function(data) {
}).done(function(data){
	$("#cantidadmensajesen1").html(data);
});
}

function cantidadmensajesen0(){
$.post('controlador/mensaje.php?op=cantidadmensajesen0', {}, function(data) {
}).done(function(data){
	$("#cantidadmensajesen0").html(data);
});
}
cantidadmensajestotal();
cantidadcontactos();
cantidadmensajesen1();
cantidadmensajesen0();







function mostrarcontacto(){
    $.post('controlador/usuario.php?op=mostrarcontacto', {}, function(data) {
        /*optional stuff to do after success */
    }).done(function(data){
        $("#fcompose_users").html(data);
        $("#fcompose_users").attr('multiple')
        $('#fcompose_users').select2({width: 'resolve'});
    }).fail(function (data) {
        console.log(data)
    }); 
}
mostrarcontacto();

function mostraraño(){
    $.post('controlador/usuario.php?op=mostraraño', {}, function(data) {
        /*optional stuff to do after success */
    }).done(function(data){
        $("#register_año").html(data);
    }).fail(function (data) {
        console.log(data)
    });
}
mostraraño();

function mostraraño1(){
    $.post('controlador/usuario.php?op=mostraraño', {}, function(data) {
        /*optional stuff to do after success */
    }).done(function(data){
        $("#register_año1").html(data);
    }).fail(function (data) {
        console.log(data)
    });
}
mostraraño1();



$("#register_año").change(function(){
    register_año=$("#register_año").val();

    $.post('controlador/usuario.php?op=mostrarseccion', {'register_año':register_año}, function(data) {
        /*optional stuff to do after success */
    }).done(function(data){
      console.log(data)
        $("#register_seccion").html(data);
    }).fail(function (data) {
        console.log(data)
    });

});



// Inicio de la entrada al sistema
$("#form-login").on('submit', function (e) {
    e.preventDefault();
    email = $("#login_email").val();
    password = $("#login_password").val();

    if (email == '' || password == '') {
    }else{
        $.post("controlador/usuario.php?op=entrar", {
            "login_email": email,
            "login_password": password
        }, function () {}).done(function (data) {
            datos = JSON.parse(data);
            valorestado = datos.estado.type;
            valormsg = datos.estado.msg;
            switch (valorestado) {
                case 'success':
                alertaSuccess(valorestado, valormsg);
                direccion = 'index.php';
                recargarPagina(direccion);

                break;
                case 'error':

                alertaError(valorestado, valormsg);
                break;
                default:
                break;
            }
        }).fail(function (dato) {
            console.log('hubo un error');
            valorestado = 'error';
            valormsg = 'Hubo un error al hacer la petición';
            alertaError(valorestado, valormsg);
        });
    }
});
// Fin de la entrada al sistema

$("#salir").on('click', function(event) {
    event.preventDefault();
    valorestado = 'success';
    valormsg = 'Has salido correctamente del sistema';
    $.post("controlador/usuario.php?op=salir", {}, function () {}).done(function () {
        $('body').html("");
        alertaSuccess(valorestado, valormsg);
        direccion = 'index.php';
        recargarPagina(direccion);
    });
});

// Este codigo borra todo cuando se cierra el modal
$('#modal-compose2').on('hidden.bs.modal', function () {
    $('#registrocontacto input').val('');
    $("#modal-compose2").removeClass('show');
});
$('#modal-compose2').on('show.bs.modal', function () {
    $("#modal-compose2").removeClass('in');
    $("#modal-compose2").addClass('show');    
});


        // showing modal with effect
        $('.modal-effect').on('click', function(e){
          e.preventDefault();

          var effect = "flip-vertical";
          $('#modaldemo8').addClass(effect);
          $('#modaldemo8').modal('show');
      });

        // hide modal with effect
        $('#modaldemo8').on('hidden.bs.modal', function (e) {
          $(this).removeClass (function (index, className) {
              return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
          });
      });



// Este codigo muestra el modal de envio de mensaje
$('#modal-compose').on('show.bs.modal', function () {
obj = document.getElementById('fcompose_users');
numero = obj.getElementsByTagName('option').length;
console.log(numero)

if (numero=='0') {
        $("#enviarmensaje").hide();
        $("#errorcontacto").html('<div class="alert alert-danger alert-dismissible"><h5 class="text-center"><i class="icon fa fa-ban"></i> Error!</h5>No tienes ningún contacto registrado.</div>');
    }else {
        $("#enviarmensaje").show();
        $("#errorcontacto").html('');
        mostrarcontacto();
    }


});











function editarcontacto(idcontacto){
    console.log(idcontacto);

    $.post('controlador/contacto.php?op=vercontacto', {'idcontacto': idcontacto}, function(data) {
      /*optional stuff to do after success */
    }).done(function(data){
      datos= JSON.parse(data);
    $("#idcontacto").val(idcontacto);
    $("#nombrecontacto").val(datos[0][0])
    $("#correocontac").val(datos[0][1])
    $("#telefonocont").val(datos[0][2])
    $("#seccionid").val(datos[0][3])
    $("#register_año1").val(datos[0][4])
    });

}



$("#register_año1").change(function(){
  // console.log(seccion)
  // valorseccion = $("#seccionid").val()
  // console.log(valorseccion);
    register_año1=$("#register_año1").val();
    $.post('controlador/usuario.php?op=mostrarseccion', {'register_año':register_año1}, function(data) {
        /*optional stuff to do after success */
    }).done(function(data){
      // console.log(data)
        $("#register_seccion1").html(data);
    }).fail(function (data) {
        console.log(data)
    });
        // $("#register_seccion1").val(valorseccion);

});

$("#editarcontacto").on('submit', function(event) {
  event.preventDefault();
  /* Act on the event */
  form = $("#editarcontacto").serialize(); 

swalWithBootstrapButtons({
    title: '¿Estas seguro de actualizar el contacto?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, deseo actulizar',
    cancelButtonText: 'No quiero actulizar',
    reverseButtons: true
}).then((result) => {
    if (result.value) {
        $.post('controlador/contacto.php?op=editarcontacto', form, function(data) {
        }).done(function (data){
            // console.log(data);
            datos = JSON.parse(data);
            valorestado = datos.estado.type;
            valormsg = datos.estado.msg;

            switch (valorestado) {
                case 'success':
                alertaSuccess(valorestado, valormsg);
                contactosdeusuario();
                $("#modal-editar-contacto").modal('hide');
                    break;

                    case 'error':
                    alertaError(valorestado, valormsg);
                    break;

                    default:
                    break;
                }
            });  
    } else if (result.dismiss === swal.DismissReason.cancel) {
        swalWithBootstrapButtons(
            'Actualización cancelada',
            'El contacto no fue actualizado',
            'error'
            )
    }
});


});

function eliminarmensaje(id){
   console.log(id);
   swalWithBootstrapButtons({
    title: '¿Estas seguro de eliminar el mensaje?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, deseo eliminarlo',
    cancelButtonText: 'No quiero eliminarlo',
    reverseButtons: true
}).then((result) => {
    if (result.value) {
        $.post('controlador/mensaje.php?op=eliminarmensaje', {'idmensaje':id}, function(data) {
        }).done(function (data){
            // console.log(data);
            datos = JSON.parse(data);
            valorestado = datos.estado.type;
            valormsg = datos.estado.msg;


            var inboxList2 = $('#message-list2');
            var inboxView2 = $('#message-view2');

            switch (valorestado) {
                case 'success':
                alertaSuccess(valorestado, valormsg);
                    // autoRefrescarcontacto();
                    autoRefrescareliminado();
                    inboxView2
                    .removeClass('animation-fadeInQuick2Inv')
                    .addClass('display-none');

                    inboxList2
                    .removeClass('display-none')
                    .addClass('animation-fadeInQuick2');
                    break;

                    case 'error':
                    alertaError(valorestado, valormsg);
                    break;

                    default:
                    break;
                }
            });  
    } else if (result.dismiss === swal.DismissReason.cancel) {
        swalWithBootstrapButtons(
            'Eliminación cancelada',
            'El mensaje no fue eliminado',
            'error'
            )
    }
});
}
function eliminarcontacto(id){
    console.log(id);
    swalWithBootstrapButtons({
        title: '¿Estas seguro de eliminar el contacto?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo eliminarlo',
        cancelButtonText: 'No quiero eliminarlo',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post('controlador/contacto.php?op=eliminarcontacto', {'idcontacto':id}, function(data) {
            }).done(function (data){
                // console.log(data);
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;

                switch (valorestado) {
                    case 'success':
                    alertaSuccess(valorestado, valormsg);
                    autoRefrescarcontacto();
                    mostrarcontacto();
                    break;

                    case 'error':
                    alertaError(valorestado, valormsg);
                    break;

                    default:
                    break;
                }
            });  
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swalWithBootstrapButtons(
                'Eliminación cancelada',
                'El contacto no fue eliminado',
                'error'
                )
        }
    });
}

$("#registrocontacto").on('submit',function(e){
    e.preventDefault();
    formulario = $("#registrocontacto").serialize();

    nombreapellido = $("#nombreapellido").val();
    telefonocontacto = $("#telefonocontacto").val();
    correocontacto = $("#correocontacto").val();
    register_seccion = $("#register_seccion").val();

    if (nombreapellido=='' || telefonocontacto == '' || correocontacto=='' || register_seccion=='') {

    }else{
        $.post('controlador/contacto.php?op=registrocontacto', formulario, function(data) {
        }).done(function(data){

            datos = JSON.parse(data);
            valorestado = datos.estado.type;
            valormsg = datos.estado.msg;

            switch (valorestado) {
                case 'success':
                $("#modal-compose2").modal('hide');
                alertaSuccess(valorestado, valormsg);
                autoRefrescarcontacto();
                mostrarcontacto();
                break;
                case 'error':
                alertaError(valorestado, valormsg);
                break;
                default:
                break;
            }

        }); 
    }
});

// Revisar aqui para enviar
$("#enviarmensaje").on('submit', function(event) {
    event.preventDefault();
    var formdatanuevo = new FormData(document.getElementById('enviarmensaje'));
    $.ajax({
        type: "POST",
        url: "controlador/mensaje.php?op=enviarmensaje",
        data: formdatanuevo,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);
            datos = JSON.parse(data);
            valorestado = datos.estado.type;
            valormsg = datos.estado.msg;
            switch (valorestado) {
                case 'success':
                alertaSuccess(valorestado, valormsg);
                direccion = 'index.php';
                recargarPagina(direccion);
                break;

                case 'error':
                alertaError(valorestado, valormsg);
                break;

                default:
                break;
            }
        },
        error: function(xhr,msg,excep) { console.log('Error: ' + msg + '/ ' + excep); }
    });
});


function moverpapelera(idmensaje,tipomensaje){
    // tipo == '1' enviados 
    // tipo == '2' recibidos

  console.log(idmensaje);
    swalWithBootstrapButtons({
        title: '¿Estas seguro de mover el mensaje a la papelera de reciclaje?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo moverlo',
        cancelButtonText: 'No quiero moverlo',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post('controlador/mensaje.php?op=moverpapelera', {'idmensaje':idmensaje}, function(data) {
            }).done(function (data){
                // console.log(data);
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;

                switch (valorestado) {
                    case 'success':
                    alertaSuccess(valorestado, valormsg);
                    autoRefrescarrecibidos();
                    autoRefrescarenviado();
                    autoRefrescareliminado();
                    break;

                    case 'error':
                    alertaError(valorestado, valormsg);
                    break;

                    default:
                    break;
                }
            });  
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swalWithBootstrapButtons(
                'Cancelación de movimiento',
                'El mensaje no fue movido',
                'error'
                )
        }
    });

}






$("#btncambiocontraseña").on('click',function(e){
  e.preventDefault();
  App.sidebar('close-sidebar-alt2');
  formulario = $("#cambioContraseña").serialize();
  // console.log(formulario)

pass = $("#side-profile-password").val();
repass = $("#side-profile-password-confirm").val();

if (pass!=repass) {
  alertaError('error', 'La contraseña deben coincidir');
}else{
swalWithBootstrapButtons({
        title: '¿Estas seguro de cambiar la contraseña?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo cambiarla',
        cancelButtonText: 'No quiero cambiarla',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.post('controlador/usuario.php?op=cambiocontrasena', formulario, function(data) {
            }).done(function (data){
                // console.log(data);
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;

                switch (valorestado) {
                    case 'success':
                    alertaSuccess(valorestado, valormsg);
                    break;

                    case 'error':
                    alertaError(valorestado, valormsg);
                    break;

                    default:
                    break;
                }

            });  
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swalWithBootstrapButtons(
                'Cancelación de cambio',
                'la contraseña no fue cambiada',
                'error'
                )
        }
    });
  }
  // side-profile-password
  // side-profile-password-confirm
})



$("#cambiodatosusuario").on('submit',function(e){
e.preventDefault()
App.sidebar('close-sidebar-alt')
var formularionuevo = new FormData(document.getElementById('cambiodatosusuario'));
// console.log(formularionuevo) 

swalWithBootstrapButtons({
        title: '¿Estas seguro de actualizar los datos?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, deseo actualizarlo',
        cancelButtonText: 'No quiero actualizarlo',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {

 $.ajax({
            type: "POST",
            url: "controlador/usuario.php?op=actualizardatos",
            data: formularionuevo,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                // console.log('con archivo');
                // console.log(data);
                datos = JSON.parse(data);
                valorestado = datos.estado.type;
                valormsg = datos.estado.msg;
                switch (valorestado) {

                    case 'success':
                    alertaSuccess(valorestado, valormsg);
                    direccion = 'index.php';
                    recargarPagina(direccion);
                    break;

                    case 'error':
                    alertaError(valorestado, valormsg);
                    break;

                    default:
                    break;
                }
            },
            error: function(xhr,msg,excep) { console.log('Error: ' + msg + '/ ' + excep); }
        });

         } else if (result.dismiss === swal.DismissReason.cancel) {
            swalWithBootstrapButtons(
                'Cancelación de actualización',
                'Los datos no fueron cambiados',
                'error'
                )
        }
    });
// side-profile-name
// side-profile-email
// side-profile-telefono
})





function mostrarpreguntarespuesta(){
  $.post('controlador/usuario.php?op=mostrarpreguntarespuesta', {}, function(data) {
        }).done(function(data){
          // console.log(data)
            datos = JSON.parse(data);
            pregunta_seguridad = datos.estado.pregunta_seguridad;
            respuesta_seguridad = datos.estado.respuesta_seguridad;

$("#side-profile-pregunta").val(pregunta_seguridad)
$("#side-profile-respuesta").val(respuesta_seguridad)

        });  
}

if ($("#cambiodatosusuario").length) {
mostrarpreguntarespuesta()
}