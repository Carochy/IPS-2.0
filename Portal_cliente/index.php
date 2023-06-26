<?php
// Cargar archivo de configuración, bibliotecas, etc.
define('RAIZ', __DIR__);

// Incluir el archivo del controlador de inicio de sesión
require_once RAIZ.'/app/controladores/LoginController.php';
// Crear una instancia del controlador de inicio de sesión
$loginController = new LoginController();

// Procesar la solicitud
$loginController->procesarLogin(); 




