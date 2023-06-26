
<?php 
//require_once 'C:\xampp\htdocs\moob\IPS\app\controladores\ClienteController.php';
require_once __DIR__.'/../controladores/ClienteController.php'; 
//include __DIR__.'/../updateTable.php'; 

$clienteController = new ClienteController();

if(isset($_POST)){
    if(isset($_POST['action'])){
        switch($_POST['action']){
            
            case 'crear_popap':
                $json_data = array();
                $json_data['inner_popup'] = popap_crear();
                $json_data['done'] = 'ok';

                echo json_encode($json_data);
               
            break;
            case 'agregar_usuario':
                $json_data = array();

                $usr = $_POST['usuario'];
                $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                $nom = $_POST['nombre'];
                $ape = $_POST['apellido'];
                $mail = $_POST['email'];
                $rol = $_POST['rol'];
                $creacion = date('Y-m-d H:i:s');

                $info_cliente = array('user_usr' => $usr, 
                    'nombre_usr' => $nom, 
                    'apellido_usr' => $ape, 
                    'email_usr' => $mail, 
                    'pass_usr' => $pass, 
                    'role_usr' => $rol,
                    'created' => $creacion); 

                $resultado = $clienteController->crearCliente($info_cliente);
                
                if(isset($resultado)&& !empty($resultado) && $resultado != null){
                    //$clientes = $clienteController->obtenerClientes();
                    $UpdatedTable = $clienteController->getUpdatedTable();

                    //$json_data['table'] = getUpdatedTable($clientes);   
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


function popap_crear(){
    //$action = 'agregar_usuario';

    $html_editar = '';
    /* $html_editar .= '<div id = "crear-usuario-form">'; */
    //$html_editar .= '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
    $html_editar .= '   <div class="modal-dialog">';
    $html_editar .= '       <div class="modal-content">';
    $html_editar .= '           <div class="modal-header" style="background-color: #DB0F0F !important;">';
    $html_editar .= '           <h3 class="modal-title" style="color: #fff; text-align: center;">Agregar Cliente</h3>';
    $html_editar .= '           <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_popap(\'crear_popap\')">';
    $html_editar .= '               <span aria-hidden="true">&times;</span>';
    $html_editar .= '           </button>'; 
    //$html_editar .= '    <h3>Crear Usuario</h3>';
    $html_editar .= '       </div>';
    $html_editar .= '    <form id="crear-usuario-form" method="POST"  >';
    $html_editar .= '        <input class="form-control" type="hidden" id="user_cre" name="user_cre">';
    $html_editar .= '        <label for="user_cre">Usuario:</label>';
    $html_editar .= '        <input class="form-control" type="text" id="usuario_cre" name="usuario_cre" required>';
    $html_editar .= '        <label for="pass_cre">Contraseña:</label>';
    $html_editar .= '        <input class="form-control" type="text" id="pass_cre" name="pass_cre"  required>';  
    $html_editar .= '        <label for="nombre_cre">Nombre:</label>';
    $html_editar .= '        <input class="form-control" type="text" id="nombre_cre" name="nombre_cre" >';
    $html_editar .= '        <label for="apellido_cre">Apellido:</label>';
    $html_editar .= '        <input class="form-control" type="text" id="apellido_cre" name="apellido_cre">';
    $html_editar .= '        <label for="email_cre">Email:</label>';
    $html_editar .= '        <input class="form-control" type="email" id="email_cre" name="email_cre" >';
    $html_editar .= '        <label for="rol_cre">Rol:</label>';
    $html_editar .= '        <select class="form-control" id="rol_cre" name="rol_cre" required>';
    $html_editar .= '            <option value="admin">admin</option>';
    $html_editar .= '            <option value="cliente">cliente</option>';
    $html_editar .= '        </select>';    
    $html_editar .= '        <input type="button" value="Guardar" onclick="create_customer(\'agregar_usuario\')">';
    $html_editar .= '        <input type="button" value="Cerrar" onclick="close_popap(\'crear_popap\')">'; 
    /*$html_editar .= '   </div>'; */
    $html_editar .= ' </form>';
    $html_editar .= '       </div>'; 
    $html_editar .= '   </div>'; 
    return $html_editar;

}
/* function getUpdatedTable($clientes) {
    // Retrieve the updated client data and generate the updated table HTML
    //$clientes = $clienteController->obtenerClientes(); // Assuming this method exists

    $html_tabla = '';

        if(isset($clientes[0]) && is_array($clientes[0])){
            
            foreach($clientes as $k => $v){
                
                $nombre_usr= empty($v['nombre_usr'])? '': $v['nombre_usr'];
                $apellido_usr= empty($v['apellido_usr'])? '': $v['apellido_usr'];
                $email_usr= empty($v['email_usr'])? '': $v['email_usr'];
                $action = 'editarUsuario';
                $eliminar = 'deleteUsuario';

                $html_tabla .= '<tr>';
                $html_tabla .= '      <td>'.$v['user_usr'].'</td>';
                $html_tabla .= '      <td>'.$nombre_usr.'</td>';
                $html_tabla .= '      <td>'.$apellido_usr.'</td>';
                $html_tabla .= '      <td>'.$email_usr.'</td>';
                $html_tabla .= '      <td>'.$v['role_usr'].'</td>';
                $html_tabla .= ' <td>';
                $html_tabla .= '     <a href="#" class="editar-usuario" onclick="process_request(\''.$action.'\', \'' . $v['user_usr'] . '\')"><i class="fa-solid fa-pen-to-square"></i></a>';
                $html_tabla .= '     <a href="#" class="eliminar-usuario" onclick="process_delete(\''.$eliminar.'\', \'' . $v['id_usr'] . '\')"><i class="fa-sharp fa-solid fa-trash"></i></a>';
                $html_tabla .= ' </td>';
                $html_tabla .= '</tr>';
                
            }
           //return 'entre';
        } 

   
    return $html_tabla;
    //return 'entre';
} */
 

?>

