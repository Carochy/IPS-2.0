<?php
//require_once RAIZ.'/app/modelos/conexion.php';
require_once __DIR__.'/../modelos/Conexion.php'; 
//require_once 'C:\xampp\htdocs\moob\IPS\app\modelos\Conexion.php';

class ClienteModelo {
    private $dbconn;
        
    public function __construct(){
        
        $this->dbconn = new Opdb('produccion');
    }

    public function obtenerClientes() {
        // Lógica para obtener la lista de clientes desde la base de datos
            $sql = "SELECT id_usr,
                    user_usr ,
                    nombre_usr,  
                    pass_usr,
                    apellido_usr,
                    email_usr,
                    role_usr
                    FROM user_auth";
        $results = $this->dbconn->execute_sql($sql, true);


        return $results;
    }

    public function cliente($username) {
        // Lógica para obtener los datos de un cliente específico desde la base de datos
        $sql = "SELECT user_usr ,
        nombre_usr,  
        pass_usr,
        apellido_usr,
        email_usr,
        role_usr FROM user_auth WHERE user_usr = '$username'";
        $cliente = $this->dbconn->execute_sql($sql, true);


        return $cliente;
    }

    public function crearCliente($user_auth) {

        //mysqli_query($this->conexion, $insercion);
        $create = $this->dbconn->add_item('user_auth', $user_auth);
        
        //$create = $this->dbconn->execute_sql($insert, true);
        
        return isset($create)?'ok_create':'error'; 
    }

    public function editarCliente($info) {
        // Lógica para editar los datos de un cliente en la base de datos
        /* $actualizacion = "UPDATE clientes SET nombre='$nombre', email='$email' WHERE id=$id";
        mysqli_query($this->conexion, $actualizacion); */
        $usr = $info['usuario'];
        $usr_id = $info['user_usr'];
        $nom = $info['nombre'];
        $ape = $info['apellido'];
        $mail = $info['email'];
        $rol = $info['rol'];
        //$pass = $info['pass'];
        //empty($info['pass'])? '': ',pass_usr = '.password_hash($v['email_usr'], PASSWORD_DEFAULT);

        $sql = "UPDATE user_auth
        SET user_usr ='$usr',
        nombre_usr ='$nom ',  
        apellido_usr ='$ape',
        email_usr ='$mail',
        role_usr ='$rol'";
        if (!empty($info['pass'])) {
            $hashedPass = password_hash($info['pass'], PASSWORD_DEFAULT);
            $sql .= ", pass_usr = '$hashedPass'";
        }
        $sql .= " WHERE user_usr = '$usr_id'";

       $update = $this->dbconn->execute_sql($sql, true);
        
        return isset($update)?'ok_update':'error'; 
        //return $update;
    }
    public function eliminarCliente($idCliente) {
        // Lógica para obtener los datos de un cliente específico desde la base de datos
        $sql = "DELETE FROM user_auth WHERE id_usr = $idCliente";
        $delete = $this->dbconn->execute_sql($sql, true);

        return isset($delete)?'ok_delete':'error'; 
        //return $delete;
    }
    public function getUpdatedTable() {
        // Retrieve the updated client data and generate the updated table HTML
        $clientes = $this->obtenerClientes(); // Assuming this method exists
    
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
    }

    public function loadExcel($info){

        $carpetaDestino = __DIR__.'\..\archivo'; 
        $nombreArchivo = $info['archivo'];
        $rutaArchivoTemp = $info['directorio']; 
        
        $rutaArchivoDestino = $carpetaDestino . $nombreArchivo;
        if (move_uploaded_file($rutaArchivoTemp, $rutaArchivoDestino)) {

            $excel= 'carga correcta';  
        } else {
            $excel = 'Error al guardar el archivo. en la carpeta'.$carpetaDestino;
            
        } 
        return $excel;
        //return 'anetre a la clase';
        //return json_encode($carpetaDestino, JSON_UNESCAPED_UNICODE);

    }
    /*public function eliminarCliente($idCliente) {
        // Lógica para eliminar un cliente de la base de datos
        $eliminacion = "DELETE FROM clientes WHERE id=$id";
        mysqli_query($this->conexion, $eliminacion);
    } */
}
