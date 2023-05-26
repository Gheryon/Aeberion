<?php
include_once 'conexionDB.php';

class Conflicto{
  var $objetos;
  public function __construct(){
      $db = new Conexion();
      $this->acceso = $db->pdo;
  }

  function insertConflicto($nombre, $tipo_conflicto, $descripcion, $tipo_localizacion, $comienzo, $finalizacion, $preludio, $desarrollo, $resultado, $consecuencias, $otros){
    //se busca si ya existe la entrada
    $sql="SELECT id_conflicto FROM conflicto WHERE nombre=:nombre";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre));
    $this->objetos=$query->fetchAll();
    //si ya existe la entrada, no se añade
    if(!empty($this->objetos)){
      echo "noadd";
    }else{
      $sql="INSERT INTO conflicto(nombre, id_tipo_conflicto, tipo_localizacion, descripcion, comienzo, finalizacion, preludio, desarrollo, resultado, consecuencias, otros) VALUES (:nombre, :id_tipo_conflicto, :tipo_localizacion, :descripcion, :comienzo, :finalizacion, :preludio, :desarrollo, :resultado, :consecuencias, :otros);";
      $query=$this->acceso->prepare($sql);
      $query->execute(array(':nombre'=>$nombre, ':id_tipo_conflicto'=>$tipo_conflicto, ':tipo_localizacion'=>$tipo_localizacion, ':descripcion'=>$descripcion, ':comienzo'=>$comienzo, ':finalizacion'=>$finalizacion, ':preludio'=>$preludio, ':desarrollo'=>$desarrollo, ':resultado'=>$resultado, ':consecuencias'=>$consecuencias, ':otros'=>$otros));
      echo "add";
    }
  }

  function insertBeligerantes($id_conflicto, $id_organizacion, $lado){
    //se busca si ya existe la entrada
    $sql="SELECT id FROM conflicto_beligerantes WHERE id_conflicto=:id_conflicto AND id_organizacion=:id_organizacion";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id_conflicto'=>$id_conflicto, ':id_organizacion'=>$id_organizacion));
    $this->objetos=$query->fetchAll();
    //si ya existe la entrada, no se añade
    if(!empty($this->objetos)){
      return false;
    }else{
      $sql="INSERT INTO conflicto_beligerantes(id_conflicto, id_organizacion, lado) VALUES (:id_conflicto, :id_organizacion, :lado);";
      $query=$this->acceso->prepare($sql);
      $query->execute(array(':id_conflicto'=>$id_conflicto, ':id_organizacion'=>$id_organizacion, ':lado'=>$lado));
      return true;
    }
  }

  function deleteBeligerantes($id_conflicto, $id_organizacion, $lado){
    $sql="DELETE FROM conflicto_beligerantes WHERE id_conflicto=:id AND id_organizacion=:id_organizacion AND lado=:lado;";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_conflicto, ':id_organizacion'=>$id_organizacion, ':lado'=>$lado));
    return true;
  }

  function lastConflicto(){
    $sql="SELECT MAX(id_conflicto) as id FROM conflicto";
    $query=$this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchAll();
    return $this->objetos;
  }

  function buscarBeligerantes($id, $lado){
    $sql="SELECT * FROM conflicto_beligerantes WHERE id_conflicto=:id AND lado=:lado";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id, ':lado'=>$lado));
    $this->objetos=$query->fetchAll();
    return $this->objetos;
  }

  function loadBeligerantes($id){
    $sql="SELECT *, organizaciones.nombre as nombre FROM conflicto_beligerantes JOIN organizaciones ON conflicto_beligerantes.id_organizacion=organizaciones.id_organizacion WHERE id_conflicto=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchAll();
    return $this->objetos;
  }

  function buscar(){
    //se ha introducido algún caracter a buscar, se devuelven las entradas que encagen con la consulta
    if(!empty($_POST['consulta'])){
      $consulta=$_POST['consulta'];
      $sql="SELECT id_conflicto, nombre, descripcion FROM conflicto WHERE nombre LIKE :consulta";
      $query=$this->acceso->prepare($sql);
      $query->execute(array(':consulta'=>"%$consulta%"));
      $this->objetos=$query->fetchAll();
      return $this->objetos;
    }else{
      //se devuelven todos los conflictos
      $sql="SELECT id_conflicto, nombre, descripcion FROM conflicto WHERE nombre NOT LIKE '' ORDER BY id_conflicto LIMIT 25";
      $query=$this->acceso->prepare($sql);
      $query->execute();
      $this->objetos=$query->fetchAll();
      return $this->objetos;
    }
    $this->objetos=$query->fetchAll();
    return $this->objetos;
  }

  function borrarConflicto($id){
    $sql="DELETE FROM conflicto WHERE id_conflicto=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    if(!empty($query->execute(array(':id'=>$id)))){
        echo 'borrado';
    }else{
        echo 'noborrado';
    }
  }

  function buscarConflicto($id){
    $sql="SELECT *, conflicto.nombre AS nombre, tipo_conflicto.nombre AS tipoconflicto FROM conflicto JOIN tipo_conflicto ON id_tipo_conflicto=tipo_conflicto.id WHERE id_conflicto=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchAll();
    return $this->objetos;
  }

  function editarConflicto($nombre, $tipo_conflicto, $descripcion, $tipo_localizacion, $comienzo, $finalizacion, $preludio, $desarrollo, $resultado, $consecuencias, $otros, $id_conflicto){
    $sql="UPDATE conflicto SET nombre=:nombre, id_tipo_conflicto=:id_tipo_conflicto, tipo_localizacion=:tipo_localizacion, descripcion=:descripcion, comienzo=:comienzo, finalizacion=:finalizacion, preludio=:preludio, desarrollo=:desarrollo, resultado=:resultado, consecuencias=:consecuencias, otros=:otros WHERE id_conflicto=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre, ':id_tipo_conflicto'=>$tipo_conflicto, ':tipo_localizacion'=>$tipo_localizacion, ':descripcion'=>$descripcion, ':comienzo'=>$comienzo, ':finalizacion'=>$finalizacion, ':preludio'=>$preludio, ':desarrollo'=>$desarrollo, ':resultado'=>$resultado, ':consecuencias'=>$consecuencias, ':otros'=>$otros, ':id'=>$id_conflicto));
  }
}
?>