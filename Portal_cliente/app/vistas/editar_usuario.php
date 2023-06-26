
<?php 
require_once __DIR__.'/../controladores/ClienteController.php'; 


$clienteController = new ClienteController();


if(isset($_POST)){
    if(isset($_POST['action'])){
        switch($_POST['action']){
            
            case 'editarUsuario':
                $json_data = array();
                $resultado = $clienteController->cliente($_POST['usuario']);

                if(isset($resultado)&& !empty($resultado) && $resultado != null){
                  
                    $json_data['inner_table'] = popap_editar($resultado);
                    $json_data['done'] = 'ok';
                }else{
                    $json_data['error'] = 'No hemos podido encontrar información';
                    $json_data['done'] = 'nok';
                }
                echo json_encode($json_data);
               
            break;
            case 'formEditarUsuario':
                $json_data = array();

                $resultado = $clienteController->editarCliente($_POST);
                
                if(isset($resultado)&& !empty($resultado) && $resultado != null){
                    $UpdatedTable = $clienteController->getUpdatedTable();

                    $json_data['table'] = $UpdatedTable;                    
                    $json_data['done'] = 'ok';
                }else{
                    $json_data['error'] = 'No hemos podido encontrar información';
                    $json_data['done'] = 'nok';
                } 
                echo json_encode($json_data);
               
            break;
               
        }
        
    }else{
        echo json_encode($_POST, JSON_UNESCAPED_UNICODE);
    }

}


function popap_editar($resultado){
    
    
    $usr = $resultado['user_usr'];
    $data = json_encode($_POST);

    $html_editar = '';

    //$html_editar .= '<div class="modal fade" id="actualizar_cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >';
    //$html_editar .= '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
    $html_editar .= '   <div class="modal-dialog">';
    $html_editar .= '       <div class="modal-content">';
    $html_editar .= '           <div class="modal-header" style="background-color: #DB0F0F !important;">';
    $html_editar .= '           <h3 class="modal-title" style="color: #fff; text-align: center;">Actualizar Cliente</h3>';
    $html_editar .= '           <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_popap(\'popap\')">';
    $html_editar .= '               <span aria-hidden="true">&times;</span>';
    $html_editar .= '           </button>'; 
    
    $html_editar .= '       </div>';
    $html_editar .= '       <form id="editar-usuario-form" method="POST"  >';
    $html_editar .= '           <input class="form-control" type="hidden" id="user_usr_edit" name="user_usr_edit" value ="'.$resultado['user_usr'].'" required>';
    $html_editar .= '           <label for="nombre">Usuario:</label>';
    $html_editar .= '            <input class="form-control" type="text" id="usuario_edit" name="usuario_edit" value = "'.$resultado['user_usr'].'">';
    $html_editar .= '           <label for="pass_edit">Contraseña:</label>';
    $html_editar .= '           <input class="form-control" type="text" id="pass_edit" name="pass_edit">';  
    $html_editar .= '           <label for="nombre">Nombre:</label>';
    $html_editar .= '           <input class="form-control" type="text" id="nombre_edit" name="nombre_edit" value = "'.$resultado['nombre_usr'].'">';
    $html_editar .= '           <label for="nombre">Apellido:</label>';
    $html_editar .= '           <input class="form-control" type="text" id="apellido_edit" name="apellido_edit" value = "'.$resultado['apellido_usr'].'">';
    $html_editar .= '           <label for="email">Email:</label>';
    $html_editar .= '           <input class="form-control" type="email" id="email_edit" name="email_edit" value = "'.$resultado['email_usr'].'">';
    $html_editar .= '           <label for="email">Rol:</label>';
    $html_editar .= '           <select class="form-control" id="rol_edit" name="rol_edit" value = "'.$resultado['role_usr'].'" required>';
    $html_editar .= '                   <option value="'.$resultado['role_usr'].'">'.$resultado['role_usr'].'</option>';
    if ($resultado['role_usr'] =='admin') {
        $option2 = 'cliente';
    }else {
        $option2 = 'admin';
    }
    $html_editar .= '                   <option value="'.$option2.'">'.$option2.'</option>';
    $html_editar .= '           </select>';  
    $html_editar .= '           </form>';
    $html_editar .= '       </div>'; 
    $html_editar .= '       <div class="modal-footer">'; 
    $html_editar .= '               <input type="button" value="Guardar" onclick="process_request(\'formEditarUsuario\',\''.$usr.'\')">';
    $html_editar .= '               <input type="button" value="Cerrar" onclick="close_popap(\'popap\')">'; 
    $html_editar .= '       </div>'; 
    $html_editar .= '   </div>'; 
    //$html_editar .= '</div>'; 
    return $html_editar;

}
?>

