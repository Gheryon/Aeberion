<?php
include_once 'conexionDB.php';

class Configs{
    var $objetos;

    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    public function getEspecies(){
        //$sql="SELECT nombre FROM especies ORDER BY nombre ASC";
        $sql="SELECT id_especie,nombre FROM especies WHERE nombre NOT LIKE '' ORDER BY nombre ASC";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }

    function getEspecie($id){
        $sql="SELECT * FROM especies WHERE id_especie=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }
}
?>