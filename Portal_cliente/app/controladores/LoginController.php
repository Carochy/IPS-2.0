<?php
require_once RAIZ.'/app/modelos/UsuarioModelo.php';
require_once RAIZ.'/app/controladores/ClienteController.php';


class LoginController {
    public function procesarLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Validar el nombre de usuario y la contraseña
            $usuarioModelo = new UsuarioModelo();
            $esValido = $usuarioModelo->verificarCredenciales($username, $password);
            
        
            if ($esValido) {
                // Iniciar sesión y redirigir al usuario
                session_start();
                $rol = $usuarioModelo->verificarRol($username);
                $_SESSION['username'] = $username;
                $_SESSION['rol'] = $rol;
                
                if ($rol == 'admin') {
                    //header("Location: .$portal");
                    $clienteController = new ClienteController();
                    $clientes = $clienteController->listarClientes();

                    require_once RAIZ.'/app/vistas/sistema_admin.php'; 
                    //header("Location: /moob/IPS/app/vistas/portal_cliente.php");
                    
                }elseif($rol == 'cliente'){
                    echo 'entre';
                    require_once RAIZ.'/app/vistas/portal_cliente.php';
                }
            } else {
                // Mostrar mensaje de error en la vista
                $error = 'Credenciales inválidas';
                echo $error ;
                //require_once RAIZ.'/app/vistas/login.php';
                echo RAIZ.'/index.php';
            }
        } else {
            // Mostrar el formulario de inicio de sesión
            //require_once RAIZ.'/app/vistas/login.php';
            //require_once RAIZ.'/index.php';
            echo RAIZ.'/index.php';
        }
    }
}
