<?php
/**
 * Created by PhpStorm.
 * User: Familia
 * Date: 23/08/2016
 * Time: 10:19 AM
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'API.php';

$API = new API();

$postdata = file_get_contents("php:://input");

//por metodo post, cundo se quiere registrar desde un formulario
if (isset($postdata) || !empty($postdata)){

    $solicitud = json_decode($postdata);

    if (isset($solicitud->accion) || !empty($solicitud->accion)){

        switch ($solicitud->accion){
            case 'd':
                //
                exit();
            case 'u':
                //
                exit();
        }
    }

    $new_portafolio = array();
    $folder = 'upload/';

    $new_portafolio[0] = preg_replace('/[^a-zA-Z ]/', $solicitud->titulo);
    $new_portafolio[1] = preg_replace('/[^a-zA-Z ]/', $solicitud->enlace);
    $new_portafolio[2] = preg_replace('/[^a-zA-Z ]/', $solicitud->descripcion);
    $new_portafolio[3] = 1;
    $new_portafolio[4] = date("d-m-Y (H:i:s)");

    if (!is_dir($folder)){
        mkdir($folder);
    }

    if ($_FILES["file"]["error"] == UPLOAD_ERR_OK){
        move_uploaded_file( $_FILES["file"]["tmp_name"], $folder . $_FILES['file']['name']);
        $new_portafolio[5] = $_FILES['file']['name'];
    }

    $API->insertar($new_portafolio);
    exit();
}else{

        $datos = array();
        $datos = $API->obtenerTodos();
        $json = json_encode($datos);
        echo $json;
        exit();
}

