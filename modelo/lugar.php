<?php
include_once 'conexionDB.php';

class Lugar{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function createLugar($nombre, $descripcion, $otros_nombres, $geografia, $tipo, $ecosistema, $clima, $flora_fauna, $recursos, $historia, $otros){
        //se busca si ya existe la entrada
        $sql="SELECT id_geografia FROM lugares WHERE nombre_lugar=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchAll();
        //si ya existe la entrada, no se añade
        if(!empty($this->objetos)){
            echo "noadd";
        }else{
            $sql="INSERT INTO lugares(nombre_lugar, descripcion_breve, tipo, otros_nombres, geografia, ecosistema, clima, flora_fauna, recursos, historia, otros) VALUES (:nombre, :descripcion, :tipo, :otros_nombres, :geografia, :ecosistema, :clima, :flora_fauna, :recursos, :historia, :otros);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre, ':descripcion'=>$descripcion, ':tipo'=>$tipo, ':otros_nombres'=>$otros_nombres, ':geografia'=>$geografia, ':ecosistema'=>$ecosistema, ':clima'=>$clima, ':flora_fauna'=>$flora_fauna, ':recursos'=>$recursos, ':historia'=>$historia, ':otros'=>$otros));
            echo "add";
        }
    }

    function buscar(){
        //se ha introducido algún caracter a buscar, se devuelven los usuarios que encagen con la consulta
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM lugares WHERE nombre_lugar LIKE :consulta";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }else{
            //se devuelven todos los usuarios
            $sql="SELECT * FROM lugares WHERE nombre_lugar NOT LIKE '' ORDER BY nombre_lugar LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }
    }

    function borrarLugar($id){
        $sql="DELETE FROM lugares WHERE id_geografia=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }else{
            echo 'noborrado';
        }
    }

    function obtener_lugar($id){
        $sql="SELECT * FROM lugares WHERE id_geografia=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }

    function editarLugar($id_lugar, $nombre, $descripcion, $otros_nombres, $geografia, $tipo, $ecosistema, $clima, $flora_fauna, $recursos, $historia, $otros){
        $sql="UPDATE lugares SET nombre_lugar=:nombre, descripcion_breve=:descripcion, otros_nombres=:otros_nombres, geografia=:geografia, tipo=:tipo, ecosistema=:ecosistema, clima=:clima, flora_fauna=:flora_fauna, recursos=:recursos, historia=:historia, otros=:otros WHERE id_geografia=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre, ':descripcion'=>$descripcion, ':tipo'=>$tipo, ':otros_nombres'=>$otros_nombres, ':geografia'=>$geografia, ':ecosistema'=>$ecosistema, ':clima'=>$clima, ':flora_fauna'=>$flora_fauna, ':recursos'=>$recursos, ':historia'=>$historia, ':otros'=>$otros, ':id'=>$id_lugar));
    }
}
?>