<?php
require_once RAIZ.'/app/modelos/conexion.php';


class UsuarioModelo {
    private $dbconn;
        
    public function __construct(){
        
        $this->dbconn = new Opdb('produccion');
    }
    public function verificarCredenciales($username, $password) {
        // Verificar las credenciales en la base de datos
        // Realizar las consultas y la lógica necesaria para validar las credenciales

        $sql = "SELECT pass_usr FROM user_auth WHERE user_usr = '$username'";
        $results = $this->dbconn->execute_sql($sql, true);

        if (password_verify($password, $results['pass_usr'])) {
            return true;
        } else { 
            return false;
        }
            
    }

    public function verificarRol($username) {
        // Verificar las credenciales en la base de datos
        // Realizar las consultas y la lógica necesaria para validar las credenciales

        $sql = "SELECT role_usr FROM user_auth WHERE user_usr = '$username'";
        $results = $this->dbconn->execute_sql($sql, true);
        $rol =$results['role_usr'];
        return ($rol)?$rol:false;
            
    }


}
