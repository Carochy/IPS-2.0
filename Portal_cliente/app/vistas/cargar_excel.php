<?php 
//require_once __DIR__.'/../header.php'; 
//require_once __DIR__.'/../../vendor/autoload.php'; 
#require_once __DIR__.'/../controladores/ClienteController.php'; 

#$clienteController = new ClienteController();
if(isset($_POST)){
    if(isset($_POST['action'])){
        switch($_POST['action']){
            
            case 'excel':
                $json_data = array();
                $json_data['excel'] = html(); ;                  
                $json_data['done'] = 'ok';
                echo json_encode($json_data);

            break;

        }


    }else{
        echo json_encode($_POST, JSON_UNESCAPED_UNICODE);
    }
}


function html(){
    $html_excel = '';
    $html_excel .='<h2>Cargar Archivo de Excel</h2>';
    $html_excel .='<form method="POST" enctype="multipart/form-data">';
    $html_excel .='    <label for="archivo">Archivo de Excel:</label>';
    $html_excel .='    <input type="file" name="archivo" id="archivo" accept=".xls,.xlsx,.csv" required><br><br>';
    //$html_excel .='    <input type="button" value="Cargar" onclick="load_excel(\'cargar_excel\')">';
    $html_excel .='    <input type="button" value="Cargar" onclick="guardar_excel()">';
    //$html_excel .='    <input type="button" value="Cargar" >';
    //$html_excel .= '   <input type="button" value="Cerrar" onclick="close_popap()">';
    $html_excel .='</form>';
    return $html_excel;
}