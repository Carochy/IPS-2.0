<?php 
require_once __DIR__.'/../vistas/header.php'; 
?>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://kit.fontawesome.com/13ac46460d.js" crossorigin="anonymous"></script>
   -->  
    <div class="row" id="seccion_cliente">
        <div class="col-sm-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <div class="card-body" id="tabla_clientes">
                        <div>
                            <h2>Listado de Usuarios 
                                <a  class="agregar-cliente" onclick="create_customer('crear_popap')"><i class="fa-solid fa-square-plus"></i></a>
                            </h2>
                            <!-- <input type="button" value="Agregar Cliente" onclick="create_customer('crear_popap')"> -->

                        </div>
                        <table id="table_"  class="table table-bordered table-hover table-condensed" dt-responsive style="width:100%" >
                            <thead class="thead-dark">
                                <tr>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <!-- <th>Contraseña</th> -->
                                    <th>Apellido</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">

                                <?php
                                $html = '';
                                if(isset($clientes[0]) && is_array($clientes[0])){
                                    
                                    foreach($clientes as $k => $v){
                                        
                                        $nombre_usr= empty($v['nombre_usr'])? '': $v['nombre_usr'];
                                        $apellido_usr= empty($v['apellido_usr'])? '': $v['apellido_usr'];
                                        $email_usr= empty($v['email_usr'])? '': $v['email_usr'];
                                        //$pass = empty($v['pass_usr'])? '': $v['pass_usr'];

                                        $html .= '<tr>';
                                        $html .= '      <td>'.$v['user_usr'].'</td>';
                                        $html .= '      <td>'.$nombre_usr.'</td>';
                                        //$html .= '      <td>'.$pass.'</td>';
                                        $html .= '      <td>'.$apellido_usr.'</td>';
                                        $html .= '      <td>'.$email_usr.'</td>';
                                        $html .= '      <td>'.$v['role_usr'].'</td>';
                                        $html .= ' <td>';
                                        #$html .= '     <a href="#" class="editar-usuario" onclick="process_request(\''.$action.'\', \'' . $v['user_usr'] . '\')">Editar</a>';
                                        $html .= '     <a href="#" class="editar-usuario" onclick="process_request(\'editarUsuario\', \'' . $v['user_usr'] . '\')"><i class="fa-solid fa-pen-to-square"></i></a>';
                                        $html .= '     <a href="#" class="eliminar-usuario" onclick="process_delete(\'deleteUsuario\', \'' . $v['id_usr'] . '\')"><i class="fa-sharp fa-solid fa-trash"></i></a>';
                                        #$html .= '     <a href="index.php?action=eliminar&id=<'. $nombre_usr.'>">Eliminar</a>';
                                        $html .= ' </td>';
                                        $html .= '</tr>';
                                        
                                    }
                                    echo $html;
                                }?>
                            </tbody>
                        </table>
                        

                    </div>
                    <div id = "popap">
                        <div id = "editar-usuario-form"></div> 
                        <!--  <div class="modal fade" id="editar-usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>  -->
                    </div>
                    <div id = "crear_popap">
                        <div id = "crear-usuario-form"></div>
                    </div>
                    <div id = "excel">
                        <div id = "carga_de_excel"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://kit.fontawesome.com/13ac46460d.js" crossorigin="anonymous"></script>
  

</html>