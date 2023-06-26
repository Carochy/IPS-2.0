<?php
session_start();

// Ruta y nombre del archivo XML que deseas descargar
$xmlFilePath = __DIR__ . '/../archivo/LTV  -VOD -MZ_UL.xlsx';

// Nombre que se le dará al archivo descargado
$downloadFileName = 'archivo.xlsx';

// Verificar si el archivo existe
if (file_exists($xmlFilePath)) {
    // Establecer las cabeceras para la descarga
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $downloadFileName . '"');
    header('Content-Length: ' . filesize($xmlFilePath));
    header('Pragma: public');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($xmlFilePath)) . ' GMT');

    // Leer y mostrar el contenido del archivo
    readfile($xmlFilePath);
    exit;
} else {
    // Si el archivo no existe, mostrar un mensaje de error
    http_response_code(404);
    exit;
}
?>
