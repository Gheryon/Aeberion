<?php
include 'conexionDB.php';

class Articulo{
    var $objetos;

    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($nombre, $contenido, $tipo){
        //se busca si ya existe el articulo
        $sql="SELECT id_articulo FROM articulosgenericos WHERE nombre=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchAll();
        //si ya existe el nombre del articulo, no se añade
        if(!empty($this->objetos)){
            echo 'noadd';
        }else{
            $sql="INSERT INTO articulosgenericos(nombre, contenido, tipo) VALUES (:nombre, :contenido, :tipo);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre, ':contenido'=>$contenido, ':tipo'=>$tipo));
            echo 'add';
        }
    }

    function buscar(){
        //se ha introducido algún caracter a buscar, se devuelven los articulos que encagen con la consulta
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM articulosgenericos WHERE nombre LIKE :consulta";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }else{
            //se devuelven todos los articulos
            $sql="SELECT * FROM articulosgenericos WHERE nombre NOT LIKE '' ORDER BY id_articulo LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }
    }

    function buscarCronicas(){
        //se ha introducido algún caracter a buscar, se devuelven los articulos que encagen con la consulta
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM articulosgenericos WHERE nombre LIKE :consulta AND tipo = 'Cronica'";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }else{
            //se devuelven todos los articulos
            $sql="SELECT * FROM articulosgenericos WHERE nombre NOT LIKE '' AND tipo = 'Cronica' ORDER BY id_articulo LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }
    }
    function borrar($id){
        $sql="DELETE FROM articulosgenericos WHERE id_articulo=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }else{
            echo 'noborrado';
        }
    }

    function editar($nombre, $contenido, $tipo, $id_editado){
        $sql="UPDATE articulosgenericos SET nombre=:nombre, contenido=:contenido, tipo=:tipo WHERE id_articulo=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre, ':contenido'=>$contenido, ':tipo'=>$tipo, ':id'=>$id_editado));
        echo 'edit';
    }

    function buscarArticulo($id){
        $sql="SELECT * FROM articulosgenericos WHERE id_articulo=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }
}
?>