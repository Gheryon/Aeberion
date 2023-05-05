<?php
include_once 'conexionDB.php';

class Asentamiento{
  var $objetos;
  public function __construct(){
      $db = new Conexion();
      $this->acceso = $db->pdo;
  }

  function createAsentamiento($nombre, $tipo, $gentilicio, $fundacion, $disolucion, $descripcion, $poblacion, $demografia, $gobierno, $infraestructura, $historia, $defensas, $economia, $cultura, $geografia, $clima, $recursos, $otros){
    //se busca si ya existe la entrada
    $sql="SELECT id_asentamiento FROM asentamientos WHERE nombre=:nombre";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre));
    $this->objetos=$query->fetchAll();
    //si ya existe la entrada, no se añade
    if(!empty($this->objetos)){
      echo "noadd";
    }else{
      $sql="INSERT INTO asentamientos(nombre, id_tipo_asentamiento, gentilicio, fundacion, disolucion, descripcion, poblacion, demografia, gobierno, infraestructura, historia, defensas, economia, cultura, geografia, clima, recursos, otros) VALUES (:nombre, :tipo, :gentilicio, :fundacion, :disolucion, :descripcion, :poblacion, :demografia, :gobierno, :infraestructura, :historia, :defensas, :economia, :cultura, :geografia, :clima, :recursos, :otros);";
      $query=$this->acceso->prepare($sql);
      $query->execute(array(':nombre'=>$nombre, ':tipo'=>$tipo, ':gentilicio'=>$gentilicio, ':fundacion'=>$fundacion, ':disolucion'=>$disolucion, ':descripcion'=>$descripcion, ':poblacion'=>$poblacion, ':demografia'=>$demografia, ':gobierno'=>$gobierno, ':infraestructura'=>$infraestructura, ':historia'=>$historia, ':defensas'=>$defensas, ':economia'=>$economia, ':cultura'=>$cultura, ':geografia'=>$geografia, ':clima'=>$clima, ':recursos'=>$recursos, ':otros'=>$otros));
      echo "add";
    }
  }

  function buscar(){
    //se ha introducido algún caracter a buscar, se devuelven las entradas que encagen con la consulta
    if(!empty($_POST['consulta'])){
      $consulta=$_POST['consulta'];
      $sql="SELECT *, asentamientos.nombre as nombre, tipo_asentamiento.nombre as tipo FROM asentamientos JOIN tipo_asentamiento ON id_tipo_asentamiento=tipo_asentamiento.id WHERE asentamientos.nombre LIKE :consulta";
      $query=$this->acceso->prepare($sql);
      $query->execute(array(':consulta'=>"%$consulta%"));
      $this->objetos=$query->fetchAll();
      return $this->objetos;
    }else{
      //se devuelven todos los asentamientos
      $sql="SELECT *, asentamientos.nombre as nombre, tipo_asentamiento.nombre as tipo FROM asentamientos JOIN tipo_asentamiento ON id_tipo_asentamiento=tipo_asentamiento.id WHERE asentamientos.nombre NOT LIKE '' ORDER BY asentamientos.nombre";
      $query=$this->acceso->prepare($sql);
      $query->execute();
      $this->objetos=$query->fetchAll();
      return $this->objetos;
    }
  }

  function borrarAsentamiento($id){
    $sql="DELETE FROM asentamientos WHERE id_asentamiento=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    if(!empty($query->execute(array(':id'=>$id)))){
        echo 'borrado';
    }else{
        echo 'noborrado';
    }
  }

  function buscarAsentamiento($id){
    $sql="SELECT *,asentamientos.nombre as nombre, tipo_asentamiento.nombre as tipo, tipo_asentamiento.id as id_tipo FROM asentamientos JOIN tipo_asentamiento ON id_tipo_asentamiento=tipo_asentamiento.id WHERE id_asentamiento=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchAll();
    return $this->objetos;
  }

  function editarAsentamiento($id_asentamiento, $nombre, $tipo, $gentilicio, $fundacion, $disolucion, $descripcion, $poblacion, $demografia, $gobierno, $infraestructura, $historia, $defensas, $economia, $cultura, $geografia, $clima, $recursos, $otros){
    $sql="UPDATE asentamientos SET nombre=:nombre, id_tipo_asentamiento=:tipo, gentilicio=:gentilicio, fundacion=:fundacion, disolucion=:disolucion, descripcion=:descripcion, poblacion=:poblacion, demografia=:demografia, gobierno=:gobierno, infraestructura=:infraestructura, historia=:historia, defensas=:defensas, economia=:economia, cultura=:cultura, geografia=:geografia, clima=:clima, recursos=:recursos, otros=:otros WHERE id_asentamiento=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre, ':tipo'=>$tipo, ':gentilicio'=>$gentilicio, ':fundacion'=>$fundacion, ':disolucion'=>$disolucion, ':descripcion'=>$descripcion, ':poblacion'=>$poblacion, ':demografia'=>$demografia, ':gobierno'=>$gobierno, ':infraestructura'=>$infraestructura, ':historia'=>$historia, ':defensas'=>$defensas, ':economia'=>$economia, ':cultura'=>$cultura, ':geografia'=>$geografia, ':clima'=>$clima, ':recursos'=>$recursos, ':otros'=>$otros, ':id'=>$id_asentamiento));
  }
}
?>