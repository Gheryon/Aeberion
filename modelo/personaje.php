<?php
include_once 'conexionDB.php';
//cada vez que se instancia una variable Personaje, se hace conexion pdo automaticamente a la base de datos
class Personaje{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function nuevoPersonaje($nombre, $apellidos, $descripcion, $descripcionShort, $personalidad, $deseos, $miedo, $magia, $historia, $religion, $familia, $politica, $retrato, $especie, $sexo){
        //se busca si ya existe el personaje
        $sql="SELECT id FROM personaje WHERE Nombre=:nombre";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchAll();
        //si ya existe el personaje, no se añade el usuario
        if(!empty($this->objetos)){
            echo "noadd";
        }else{
            $sql="INSERT INTO personaje(Nombre, Apellidos, Descripcion, DescripcionShort, Personalidad, Deseos, Miedos, Magia, Historia, Religion, Familia, Politica, Retrato, Especie, Sexo) VALUES (:nombre, :apellidos, :descripcion, :descripcionshort, :personalidad, :deseos, :miedos, :magia, :historia, :religion, :familia, :politica, :retrato, :especie, :sexo);";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre, ':apellidos'=>$apellidos, ':descripcion'=>$descripcion, ':descripcionshort'=>$descripcionShort, ':personalidad'=>$personalidad, ':deseos'=>$deseos, ':miedos'=>$miedo, ':magia'=>$magia, ':historia'=>$historia, ':religion'=>$religion, ':familia'=>$familia, ':politica'=>$politica, ':retrato'=>$retrato, ':especie'=>$especie, ':sexo'=>$sexo));
            echo "add";
        }
    }

    function buscar(){
        //se ha introducido algún caracter a buscar, se devuelven los usuarios que encagen con la consulta
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM personaje WHERE Nombre LIKE :consulta";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }else{
            //se devuelven todos los usuarios
            $sql="SELECT * FROM personaje WHERE Nombre NOT LIKE '' ORDER BY id LIMIT 25";
            $query=$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchAll();
            return $this->objetos;
        }
    }

    function borrarPersonaje($id){
        $sql="SELECT retrato FROM personaje WHERE id=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchAll();
        if(!empty($this->objetos)){
            foreach ($this->objetos as $obj) {
                $retrato=$obj->retrato;
            }
            if($retrato!='default.png'){
                unlink('../imagenes/Retratos/'.$retrato);
            }
        }

        $sql="DELETE FROM personaje WHERE id=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }else{
            echo 'noborrado';
        }
    }

    function obtener_personaje($id){
        $sql="SELECT * FROM personaje WHERE id=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchAll();
        return $this->objetos;
    }

    public function getPersonaje($id){
        $personaje=null;

        $sentence=$this->acceso->prepare("SELECT * FROM personaje WHERE id = ?");
        if($sentence->execute(array($id)))
        {
            while($row=$sentence->fetch())
            {
                $personaje=$row;
            }
        }
        return $personaje;
    }
    
    function editar($id_personaje, $nombre, $apellidos, $descripcion, $descripcionShort, $personalidad, $deseos, $miedo, $magia, $historia, $religion, $familia, $politica, $especie, $sexo){
        $sql="UPDATE personaje SET Nombre=:nombre, Apellidos=:apellidos, Descripcion=:descripcion, DescripcionShort=:descripcionshort, Personalidad=:personalidad, Deseos=:deseos, Miedos=:miedos, Magia=:magia, Historia=:historia, Religion=:religion, Familia=:familia, Politica=:politica, Especie=:especie, Sexo=:sexo WHERE id=:id_personaje";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre, ':apellidos'=>$apellidos, ':descripcion'=>$descripcion, ':descripcionshort'=>$descripcionShort, ':personalidad'=>$personalidad, ':deseos'=>$deseos, ':miedos'=>$miedo, ':magia'=>$magia, ':historia'=>$historia, ':religion'=>$religion, ':familia'=>$familia, ':politica'=>$politica, ':especie'=>$especie, ':sexo'=>$sexo, ':id_personaje'=>$id_personaje));
        
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