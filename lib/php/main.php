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

$postdata = file_get_contents("php://input");

//por metodo post, cundo se quiere registrar desde un formulario
if (isset($postdata) || !empty($postdata)){

    $solicitud = json_decode($postdata, true);
//    echo '<pre>';
//    die(print_r($solicitud));

    if (isset($solicitud['accion']) || !empty($solicitud['accion'])){
        echo "<pre>";
        die(print_r($solicitud));
        switch ($solicitud['accion']){
            case 'D':
                //
                $id = (int)$solicitud->id;
                $API->eliminar($id);
                exit();
            case 'U':
                //
                exit();
            case 'R':
                echo "entre";
                $datos = array();
                $datos = $API->obtenerTodos();
                echo "<pre>";
                die(print_r($datos));
                $json = json_encode($datos);
                echo $json;
                exit();
            case 'C':
                $new_portafolio = array();

                $new_portafolio['titulo_portafolio'] = preg_replace('/[^a-zA-Z ]/','', $solicitud['titulo']);
                $new_portafolio['link_portafolio'] = preg_replace('/[^a-zA-Z ]/','', $solicitud['enlace']);
                $new_portafolio['descripcion_portafolio'] = preg_replace('/[^a-zA-Z ]/','', $solicitud['descripcion']);
                $new_portafolio['usuario_id'] = 1;
                $new_portafolio['fecha_portafolio'] = date("d-m-Y (H:i:s)");
                $new_portafolio['rutaimg_portafolio'] = 'hola.png';

                $API->insertar($new_portafolio);
                exit();

        }
    }

}
