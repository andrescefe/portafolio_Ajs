<?php

class API {

    public function __construct(){
        require_once 'Database.php';
        $conexion = Database::instance();
    }

    public function obtenerTodos(){
        try {

            $sql = "SELECT * from portafolio";
            $query = $connection->prepare($sql);
            $query->execute();
            return $query->fetchAll();

        }catch (\PDOException $e){
            print "Error!: " . $e->getMessage();
        }
    }

    public function obtenerPorId(){

    }

    public function insertar($portafolio = array()){
        
    }

    public function actualizar(){

    }

    public function eliminar(){

    }
}