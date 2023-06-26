<!DOCTYPE html>
<html>
<head>
    <title>Portal de clientes</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#downloadBtn").click(function() {
                $.ajax({
                    url: window.location.origin+'/IPS/app/vistas"descargar_exe.php',
                    method: "GET",
                    success: function(response) {
                        // Descarga exitosa, no se requiere ninguna acción adicional
                    },
                    error: function() {
                        alert("Error al descargar el archivo.");
                    }
                });
            });
        });
    </script>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?>!</h1>
    <button id="downloadBtn">Descargar Excel</button>
    <!-- Otro contenido de la página -->
    <a href="cerrar_sesion.php">Cerrar sesión</a>
</body>
</html>

