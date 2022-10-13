<?php
include_once 'conexionDB.php';

class Especie{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function createEspecie($nombre, $edad, $peso, $altura, $longitud, $estatus, $anatomia, $alimentacion, $reproduccion, $distribucion, $habilidades, $domesticacion, $explotacion, $otros, $imagen){
        //se busca si ya existe la especie
        $sql="SELECT id_especie FROM especies WHERE nombre=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchAll();
        //si ya existe la especie, no se añade
        if(!empty($this->objetos)){
            echo "noadd";
        }else{
            $sql="INSERT INTO especies(nombre, edad, peso, altura, longitud, estatus, anatomia, alimentacion, reproduccion, distribucion, habilidades, domesticacion, explotacion, otros, imagen) VALUES (:nombre, :edad, :peso, :altura, :longitud, :estatus, :anatomia, :alimentacion, :reproduccion, :distribucion, :habilidades, :domesticacion, :explotacion, :otros, :imagen);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre, ':edad'=>$edad, ':peso'=>$peso, ':altura'=>$altura, ':longitud'=>$longitud, ':estatus'=>$estatus, ':anatomia'=>$anatomia, ':alimentacion'=>$alimentacion, ':reproduccion'=>$reproduccion, ':distribucion'=>$distribucion, ':habilidades'=>$habilidades, ':domesticacion'=>$domesticacion, ':explotacion'=>$explotacion, ':otros'=>$otros, ':imagen'=>$imagen));
            echo "add";
        }
    }

    function buscar()
    {
        //se ha introducido algún caracter a buscar, se devuelven los usuarios que encagen con la consulta
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM especies WHERE nombre LIKE :consulta";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }else{
            //se devuelven todos los usuarios
            $sql="SELECT * FROM especies WHERE nombre NOT LIKE '' ORDER BY id_especie LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }
    }

    function borrarEspecie($id){
        $sql="DELETE FROM especies WHERE id_especie=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }else{
            echo 'noborrado';
        }
    }

    function obtener_especie($id){
        $sql="SELECT * FROM especies WHERE id_especie=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }
    
    function obtener_especies(){
        $sql="SELECT * FROM especies order by nombre ASC";
        $query=$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }

    function editar($id_personaje, $nombre, $apellidos, $descripcion, $personalidad, $deseos, $miedo, $magia, $historia, $religion, $familia, $politica, $especie, $sexo)
    {
        $sql="UPDATE personaje SET Nombre=:nombre, Apellidos=:apellidos, Descripcion=:descripcion, Personalidad=:personalidad, Deseos=:deseos, Miedos=:miedos, Magia=:magia, Historia=:historia, Religion=:religion, Familia=:familia, Politica=:politica, Especie=:especie, Sexo=:sexo WHERE id=:id_personaje";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre, ':apellidos'=>$apellidos, ':descripcion'=>$descripcion, ':personalidad'=>$personalidad, ':deseos'=>$deseos, ':miedos'=>$miedo, ':magia'=>$magia, ':historia'=>$historia, ':religion'=>$religion, ':familia'=>$familia, ':politica'=>$politica, ':especie'=>$especie, ':sexo'=>$sexo, ':id_personaje'=>$id_personaje));
        
    }

    function cambiar_retrato($id_personaje, $nombre){
        //primero se consulta si la contraseña actual es correcta
        $sql="SELECT retrato FROM personaje WHERE id=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_personaje));
        $this->objetos=$query->fetchAll();
        
        $sql="UPDATE personaje SET Retrato=:nombre WHERE id=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_personaje, ':nombre'=>$nombre));
        
        return $this->objetos;
    }
}
?>