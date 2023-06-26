<?php

if (isset($_FILES['archivo'])) {
    $carpetaDestino = __DIR__ . '/../archivo/';  // Ruta de la carpeta de destino donde se guardará el archivo
    $nombreArchivo = $_FILES['archivo']['name'];
    $rutaArchivoTemp = $_FILES['archivo']['tmp_name'];
    $rutaArchivoDestino = $carpetaDestino . '/' . $nombreArchivo;

    /* if (move_uploaded_file($rutaArchivoTemp, $rutaArchivoDestino)) {
        // Archivo guardado correctamente
        echo 'Archivo guardado en la carpeta: ' . $carpetaDestino;
    } else {
        // Error al guardar el archivo
        echo 'Error al guardar el archivo en la carpeta: ' . $carpetaDestino;
    } */
    if (move_uploaded_file($rutaArchivoTemp, $rutaArchivoDestino)) {
        // Archivo guardado correctamente
        $response = array(
            'success' => true,
            'message' => 'Archivo guardado exitosamente'
        );
        echo json_encode($response);
    } else {
        // Error al guardar el archivo
        $response = array(
            'success' => false,
            'message' => 'Error al guardar el archivo'
        );
        echo json_encode($response);
    }
    
}
