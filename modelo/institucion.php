<?php
include_once 'conexionDB.php';

class Institucion{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function createInstitucion($nombre_institucion, $escudo, $gentilicio, $capital, $tipo, $fundacion, $disolucion, $lema, $descripcion_breve, $historia, $politica_interior_exterior, $militar, $estructura_organizativa, $territorio, $frontera, $demografia, $cultura, $religion, $educacion, $tecnologia, $economia, $recursos_naturales, $otros){
        //se busca si ya existe la entrada
        $sql="SELECT id_organizacion FROM organizaciones WHERE nombre=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre_institucion));
        $this->objetos=$query->fetchAll();
        //si ya existe la entrada, no se añade
        if(!empty($this->objetos)){
            echo "noadd";
        }else{
            $sql="INSERT INTO organizaciones(nombre, gentilicio, capital, escudo, descripcionBreve, tipo, lema, demografia, fundacion, disolucion, historia, estructura, politicaExteriorInterior, frontera, militar, religion, cultura, educacion, tecnologia, territorio, economia, recursosNaturales, otros) VALUES (:nombre, :gentilicio, :capital, :escudo, :descripcionBreve, :tipo, :lema, :demografia, :fundacion, :disolucion, :historia, :estructura, :politicaExteriorInterior, :frontera, :militar, :religion, :cultura, :educacion, :tecnologia, :territorio, :economia, :recursosNaturales, :otros);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre_institucion, ':gentilicio'=>$gentilicio, ':capital'=>$capital, ':escudo'=>$escudo, ':descripcionBreve'=>$descripcion_breve, ':tipo'=>$tipo, ':lema'=>$lema, ':demografia'=>$demografia, ':fundacion'=>$fundacion, ':disolucion'=>$disolucion, ':historia'=>$historia, ':estructura'=>$estructura_organizativa, ':politicaExteriorInterior'=>$politica_interior_exterior, ':frontera'=>$frontera, ':militar'=>$militar, ':religion'=>$religion, ':cultura'=>$cultura, ':educacion'=>$educacion, ':tecnologia'=>$tecnologia, ':territorio'=>$territorio, ':economia'=>$economia, ':recursosNaturales'=>$recursos_naturales, ':otros'=>$otros));
            echo "add";
        }
    }

    function buscar(){
        //se ha introducido algún caracter a buscar, se devuelven las entradas que encagen con la consulta
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM organizaciones WHERE nombre LIKE :consulta";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }else{
            //se devuelven todas las entradas
            $sql="SELECT * FROM organizaciones WHERE nombre NOT LIKE '' ORDER BY nombre LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }
    }

    function borrarLugar($id){
        $sql="DELETE FROM organizaciones WHERE id_organizacion=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }else{
            echo 'noborrado';
        }
    }

    function buscarInstitucion($id){
        $sql="SELECT * FROM organizaciones WHERE id_organizacion=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }

    function editarInstitucion($nombre_institucion, $escudo, $gentilicio, $capital, $tipo, $fundacion, $disolucion, $lema, $descripcion_breve, $historia, $politica_interior_exterior, $militar, $estructura_organizativa, $territorio, $fronteras, $demografia, $cultura, $religion, $educacion, $tecnologia, $economia, $recursos_naturales, $otros, $id_institucion){
        $sql="UPDATE organizaciones SET nombre=:nombre, gentilicio=:gentilicio, capital=:capital, escudo=:escudo, tipo=:tipo, lema=:lema, demografia=:demografia, fundacion=:fundacion, disolucion=:disolucion, descripcionBreve=:descripcionBreve, historia=:historia, estructura=:estructura, politicaExteriorInterior=:politicaExteriorInterior, frontera=:frontera, militar=:militar, religion=:religion, cultura=:cultura, educacion=:educacion, tecnologia=:tecnologia, territorio=:territorio, economia=:economia, recursosNaturales=:recursosNaturales, otros=:otros WHERE id_organizacion=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre_institucion, ':gentilicio'=>$gentilicio, ':capital'=>$capital, ':escudo'=>$escudo, ':descripcionBreve'=>$descripcion_breve, ':tipo'=>$tipo, ':lema'=>$lema, ':demografia'=>$demografia, ':fundacion'=>$fundacion, ':disolucion'=>$disolucion, ':historia'=>$historia, ':estructura'=>$estructura_organizativa, ':politicaExteriorInterior'=>$politica_interior_exterior, ':frontera'=>$fronteras, ':militar'=>$militar, ':religion'=>$religion, ':cultura'=>$cultura, ':educacion'=>$educacion, ':tecnologia'=>$tecnologia, ':territorio'=>$territorio, ':economia'=>$economia, ':recursosNaturales'=>$recursos_naturales, ':otros'=>$otros, ':id'=>$id_institucion));
    }
}
?>