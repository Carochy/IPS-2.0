

<!DOCTYPE html>
<html>
<head>
    <title>Portal de clientes</title>
    <link href="assets/css/style_cl_3.css" rel="stylesheet" type="text/css" />
    <!-- style head -->
   <!--  <link href="../../autopartes/css/style.css" rel="stylesheet" type="text/css" /> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
    <script src='assets/js/data_info3.js'></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body>

    <!-- <div class="topbar">
            
        <nav class="navbar-custom"> -->

            <!-- LOGO -->
           <!--  <div class="logo-box">
                <a  class="logo">
                    <img src="assets/imagenes/Logo_IPS_completo.png" alt="" height="50">
                </a>
            </div>
            <ul>
                <li><a href="#" class="cargar_excel" onclick="load_excel('excel')">Cargar Excel</a></li>
                <li><a href="#" class="listar_cliente" onclick="listar_cliente()">Listar Clientes</a></li>

            </ul>  -->
            
        <!-- </nav>

    </div>  -->
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav my-2 my-lg-0 navbar-text h1">
                    <li class="nav-item"><a class="nav-link" href="#" onclick="load_excel('excel')">Cargar Excel</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" onclick="listar_cliente()">Listar Clientes</a></li>
                </ul>
            </div>
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button>
            </div>  
        </div>
    </nav>
    <!-- Top Bar End -->
    <!-- Modal Guardado de Excel-->
    <div class="modal fade" id="modal-exito" tabindex="-1" role="dialog" aria-labelledby="modal-exito-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-exito-label">Archivo guardado exitosamente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_popap('modal-exito')">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Tu archivo se ha guardado exitosamente.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close_popap('modal-exito')">Cerrar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Elimnar-->
    <div class="modal fade" id="modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="modal-eliminar-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-eliminar-label">Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_popap('modal-eliminar')">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>El Usuario se Elimino con Exito.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close_popap('modal-eliminar')">Cerrar</button>
            </div>
            </div>
        </div>
    </div>
 

    