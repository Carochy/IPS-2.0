
<?php  
//require_once 'C:\xampp\htdocs\moob\IPS\app\controladores\ClienteController.php';
require_once __DIR__.'/../controladores/ClienteController.php'; 

$clienteController = new ClienteController();


if(isset($_POST)){
    if(isset($_POST['action'])){
        switch($_POST['action']){
            
            case 'deleteUsuario':
                $json_data = array();

                $resultado = $clienteController->eliminarCliente($_POST['usuario']);
                
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


/* 
function getUpdatedTable($clientes) {
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

