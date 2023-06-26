<?php
//require_once RAIZ.'/app/modelos/ClienteModelo.php';
require_once __DIR__.'/../modelos/ClienteModelo.php'; 
//require_once 'C:\xampp\htdocs\moob\IPS\app\modelos\ClienteModelo.php';


class ClienteController {
    private $clienteModelo;

    public function __construct() {
        $this->clienteModelo = new ClienteModelo();
    }

    public function listarClientes() {
        // Lógica para obtener la lista de clientes y mostrar la vista correspondiente
        $clientes = $this->clienteModelo->obtenerClientes();
        //require_once 'vistas/cliente_listar.php';
        require_once  RAIZ.'/app/vistas/sistema_admin.php';
    }

    public function cliente($usuario) {
        // Lógica para obtener la lista de clientes y mostrar la vista correspondiente
        $infoCliente = $this->clienteModelo->cliente($usuario);
        return $infoCliente;
        //require_once 'vistas/cliente_listar.php';
        //require_once  RAIZ.'/app/vistas/sistema_admin.php';
    }
    public function obtenerClientes() {
        // Lógica para obtener la lista de clientes y mostrar la vista correspondiente
        $clientes = $this->clienteModelo->obtenerClientes();
        //require_once 'vistas/cliente_listar.php';
        return $clientes;
    }
    public function crearCliente($cliente) {
        // Lógica para obtener la lista de clientes y mostrar la vista correspondiente
        $create = $this->clienteModelo->crearCliente($cliente);
        //require_once 'vistas/cliente_listar.php';
        return $create;
    }
    public function eliminarCliente($idCliente) {
        // Lógica para obtener la lista de clientes y mostrar la vista correspondiente
        $delete = $this->clienteModelo->eliminarCliente($idCliente);
        //require_once 'vistas/cliente_listar.php';
        return $delete;
    }
    public function getUpdatedTable() {
        // Lógica para obtener la lista de clientes y mostrar la vista correspondiente
        $update = $this->clienteModelo->getUpdatedTable();
        //require_once 'vistas/cliente_listar.php';
        return $update;
    }
    public function loadExcel($info) {
        // Lógica para obtener la lista de clientes y mostrar la vista correspondiente
        $excel = $this->clienteModelo->loadExcel($info);
        //require_once 'vistas/cliente_listar.php';
        return $excel;
    }

    /* public function crearCliente() {
        // Lógica para crear un nuevo cliente y mostrar la vista correspondiente
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $this->clienteModelo->crearCliente($nombre, $email);
            header('Location: index.php?action=listar');
            exit();
        }
        require_once 'vistas/cliente_crear.php';
    } */

    public function editarCliente($info) {
        if (!empty($info)) {
            $update = $this->clienteModelo->editarCliente($info);
            return $update;
        }

    }

    /*public function eliminarCliente($id) {
        // Lógica para eliminar un cliente y mostrar la vista correspondiente
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->clienteModelo->eliminarCliente($id);
            header('Location: index.php?action=listar');
            exit();
        }
        $cliente = $this->clienteModelo->obtenerCliente($id);
        require_once 'vistas/cliente_eliminar.php';
    } */
}
