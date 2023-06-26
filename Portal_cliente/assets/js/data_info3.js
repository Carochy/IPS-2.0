function process_request(act, usuario) {
    if (act == 'editarUsuario') {
        data_post = { action: act, usuario: usuario };
       
    }
    if (act == 'formEditarUsuario') {

        usuario = $('#usuario_edit').val().trim();
		nombre = $('#nombre_edit').val().trim();
        pass = $('#pass_edit').val().trim();
		apellido = $('#apellido_edit').val().trim();
		email = $('#email_edit').val().trim();
        rol = $('#rol_edit').val().trim();
        user_usr = $('#user_usr_edit').val().trim();

        data_post = { action: act, usuario: usuario , nombre: nombre , pass:pass, apellido: apellido , email: email , rol: rol , user_usr: user_usr};
            //console.log (user_usr);
    }

    $.ajax({
        type: 'POST',
        //url: 'https://localhost/moob/IPS/app/vistas/editar_usuario.php',
        url:window.location.origin+'/autopartes/Portal_cliente/app/vistas/editar_usuario.php',
        data: data_post,
        dataType: 'json',
        beforeSend: function (objeto) {
            //console.log('lo que viene:', objeto);
            $(".spinn_proccess").addClass("d-flex align-items-center");
            $(".spinn_proccess").removeClass("d-none");
        },
        success: function (response) {
            //console.log('lo que viene en response:', response);
            /* $(".spinn_proccess").addClass("d-none");
            $(".spinn_proccess").removeClass("d-flex align-items-center");
            */
            if (act == 'editarUsuario') {
                $('#tabla_clientes').hide();
                $('#popap').show();
                if (response.done == 'ok') {
                    /* $('#editar-usuario').show(); */
                    //console.log('lo que vine en  editar :', response.inner_table);
                    /* $('#actualizar_cliente').modal('show');  */
                    $('#editar-usuario-form').html(response.inner_table);
                    

                } else {
                    $('#editar-usuario-form').html('<td>' + response.error + '</td>');
                }
            } 
            if (act == 'formEditarUsuario') {
               
                   
                if (response.done == 'ok') {
                    // Cerrar el popup
                    $('#popap').hide();
                    $('#tabla_clientes').show();
                    // Actualizar la lista de clientes en la tabla
                    //console.log('lo que vine en el modal:', response.table);
                    $('#table-body').html(response.table);
                }
                   

            } 
        },
        error: function (xhr, status, error) {
            console.log('el error:', error);
        }
    });
}
function close_popap(id) {

    if (id =='modal-exito') {
        
        //$('#carga_de_excel').show();
        //$('#modal-exito').hide();
        $('#modal-exito').modal('hide');
        //$('#tabla_clientes').show();
        //load_excel('excel');
    }
    if (id =='popap') {
        $('#popap').hide();
        $('#tabla_clientes').show();
    }
    if (id =='crear_popap') {
        $('#crear_popap').hide();
        $('#tabla_clientes').show();
    }
    if (id =='modal-eliminar') {
        $('#modal-eliminar').modal('hide');
        $('#tabla_clientes').show();
    }
    /* $('#popap').hide();
    $('#crear_popap').hide();
    $('#tabla_clientes').show(); */
    /* $('input[value="Cerrar"]').click(function() {
        $('#popap').hide();
    }); */
}

function create_customer(act ) {
    if (act == 'crear_popap') {
        data_post = { action: act};
        //console.log('lo que viene boton:', act);
       
    }
    if (act == 'agregar_usuario') {

        usuario = $('#usuario_cre').val().trim();
        pass = $('#pass_cre').val().trim();
		nombre = $('#nombre_cre').val().trim();
		apellido = $('#apellido_cre').val().trim();
		email = $('#email_cre').val().trim();
        rol = $('#rol_cre').val().trim();

        data_post = { action: act, usuario: usuario ,pass:pass, nombre: nombre , apellido: apellido , email: email , rol: rol };
        //console.log('post creat:', data_post);
    }
    $.ajax({
        type: 'POST',
        //url: 'https://localhost/moob/IPS/app/vistas/crear_usuario.php',
        url:window.location.origin+'/autopartes/Portal_cliente/app/vistas/crear_usuario.php',
        data: data_post,
        dataType: 'json',
        beforeSend: function (objeto) {
            //console.log('lo que viene:', objeto);
            $(".spinn_proccess").addClass("d-flex align-items-center");
            $(".spinn_proccess").removeClass("d-none");
        },
        success: function (response) {
            //console.log('lo que viene en response:', response);
            /* $(".spinn_proccess").addClass("d-none");
            $(".spinn_proccess").removeClass("d-flex align-items-center");
            */
            if (act == 'crear_popap') {
                $('#tabla_clientes').hide();
                $('#crear_popap').show();
                if (response.done == 'ok') {
                    console.log('lo que vine en  ineet table:', response.inner_popup);

                    $('#crear-usuario-form').html(response.inner_popup);
                } else {
                    $('#crear-usuario-form').html('<td>' + response.error + '</td>');
                }
            }
            if (act == 'agregar_usuario') {
   
               

                if (response.done == 'ok') {
                    // Cerrar el popup
                    $('#crear_popap').hide();
                    $('#tabla_clientes').show();
                    // Actualizar la lista de clientes en la tabla
                    //console.log('lo que vine en   table:', response.table);
                    $('#table-body').html(response.table);
                } 

            } 

        },
        error: function (xhr, status, error) {
            console.log('el error:', error);
        }
    });
}

function process_delete(act, usuario) {
    if (act == 'deleteUsuario') {
        data_post = { action: act, usuario: usuario };
       
    }


    $.ajax({
        type: 'POST',
        //url: 'https://localhost/moob/IPS/app/vistas/eliminar_usuario.php',
        url:window.location.origin+'/autopartes/Portal_cliente/app/vistas/eliminar_usuario.php',
        data: data_post,
        dataType: 'json',
        beforeSend: function (objeto) {
            //console.log('lo que viene:', objeto);
            $(".spinn_proccess").addClass("d-flex align-items-center");
            $(".spinn_proccess").removeClass("d-none");
        },
        success: function (response) {
            //console.log('lo que viene en response:', response);
            /* $(".spinn_proccess").addClass("d-none");
            $(".spinn_proccess").removeClass("d-flex align-items-center");
            */
            if (act == 'deleteUsuario') {
                
                if (response.done == 'ok') {
                    //console.log('lo que vine en  delete:', response.table);
                    $('#modal-eliminar').modal('show');
                    $('#table-body').html(response.table);
                } else {
                    $('#table-body').html('<td>' + response.error + '</td>');
                }
            } 
            
        },
        error: function (xhr, status, error) {
            console.log('el error:', error);
        }
    });
}

function load_excel(act) {
    if (act == 'excel') {
        data_post = { action: act};
       
    } 

    $.ajax({
        type: 'POST',
        //url: 'https://localhost/moob/IPS/app/vistas/cargar_excel.php',
        url:window.location.origin+'/autopartes/Portal_cliente/app/vistas/cargar_excel.php',
        data: data_post,
        dataType: 'json',
        beforeSend: function (objeto) {
            //console.log('lo que viene:', objeto);
            $(".spinn_proccess").addClass("d-flex align-items-center");
            $(".spinn_proccess").removeClass("d-none");
        },
        success: function (response) {
            //console.log('lo que viene en excel:', response);
            /* $(".spinn_proccess").addClass("d-none");
            $(".spinn_proccess").removeClass("d-flex align-items-center");
            */
            if (act == 'excel') {
                $('#tabla_clientes').hide();
                $('#excel').show();

                if (response.done == 'ok') {
                    //console.log('lo que vine en  excel:', response.excel);

                    $('#carga_de_excel').html(response.excel);
                } else {
                    $('#carga_de_excel').html('<td>' + response.error + '</td>');
                } 
            }
            
            
        },
        error: function (xhr, status, error) {
            console.log('el error:', error);
        }
    });
}
function guardar_excel() {
    var archivo = document.getElementById('archivo').files[0];
    var formData = new FormData();
    formData.append('archivo', archivo);

    $.ajax({
        type: 'POST',
        url: window.location.origin+'/IPS/app/vistas/guardar_excel.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response);
            $('#modal-exito').modal('show');
            // Realizar acciones adicionales después de guardar el archivo
        },
        error: function(xhr, status, error) {
            console.log(error);
            // Manejar el error de la solicitud Ajax
        }
    });
}

function listar_cliente() {
    
    $('#excel').hide();
    $('#tabla_clientes').show();
    
    
}