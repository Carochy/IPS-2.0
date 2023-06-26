<!DOCTYPE html>
<html>
<head>
    <title>Portal de clientes</title>
    <script>
    // Función para descargar automáticamente el archivo al cargar la página
    function descargarArchivo() {
        document.getElementById('descargarEnlace').click();
    }
    </script>
</head>
<body onload="descargarArchivo()">
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?>!</h1>
    <a id="descargarEnlace" href="<?php echo $downloadFileName; ?>">Descargar Excel</a>

    <!-- Otro contenido de la página -->

    <!-- <a href="cerrar_sesion.php">Cerrar sesión</a> -->
</body>
</html>

<?php
// Ruta y nombre del archivo XML que deseas descargar
/* $xmlFilePath = __DIR__ . '/../archivo/LTV  -VOD -MZ_UL.xlsx';

// Nombre que se le dará al archivo descargado
$downloadFileName = 'archivo.xlsx';

// Verificar si el archivo existe
if (file_exists($xmlFilePath)) {
    // Establecer las cabeceras para la descarga
    header('Content-Description: File Transfer');
    header('Content-Type: application/xml');
    header('Content-Disposition: attachment; filename="' . $downloadFileName . '"');
    header('Content-Length: ' . filesize($xmlFilePath));
    header('Pragma: public');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($xmlFilePath)) . ' GMT');

    // Leer y mostrar el contenido del archivo XML
    readfile($xmlFilePath);
} else {
    // Si el archivo no existe, mostrar un mensaje de error
    echo 'El archivo no existe.';
} */
?>
