<?php
include_once 'conexionDB.php';

class Configuracion{
  var $objetos;
  public function __construct(){
      $db = new Conexion();
      $this->acceso = $db->pdo;
  }

  //////////////funciones para tipos de eventos ///////////////
  function addTipoEvento($nombre){
    //se busca si ya existe la entrada
    $sql="SELECT id_tipo_evento FROM tipo_evento WHERE nombre=:nombre";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre));
    $this->objetos=$query->fetchAll();
    //si ya existe la entrada, no se añade
    if(!empty($this->objetos)){
      echo "no-add";
    }else{
      $sql="INSERT INTO tipo_evento(nombre) VALUES (:nombre);";
      $query=$this->acceso->prepare($sql);
      $query->execute(array(':nombre'=>$nombre));
      echo "add";
    }
  }

  function getTiposEventos(){
    $sql="SELECT * FROM tipo_evento WHERE nombre NOT LIKE '' ORDER BY nombre";
    $query=$this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchAll();
    return $this->objetos;
  }

  function borrarTipoEvento($id){
    $sql="DELETE FROM tipo_evento WHERE id_tipo_evento=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    if(!empty($query->execute(array(':id'=>$id)))){
        echo 'borrado';
    }else{
        echo 'no-borrado';
    }
  }

  function editarTipoEvento($id, $nombre){
    //se busca si ya existe un tipo de evento con el $nombre
    $sql="SELECT id_tipo_evento FROM tipo_evento WHERE nombre=:nombre";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre));
    $this->objetos=$query->fetchAll();
    //si ya existe, no se edita
    if(!empty($this->objetos)){
      echo "no-edit";
    }else{
      $sql="UPDATE tipo_evento SET nombre=:nombre WHERE id_tipo_evento=:id";
      $query=$this->acceso->prepare($sql);
      $query->execute(array(':nombre'=>$nombre, ':id'=>$id));
      echo "edit";
    }
  }

//////////////funciones para timelines ///////////////
function addTimeline($nombre){
  //se busca si ya existe la cronologia $nombre
  $sql="SELECT id_cronologia FROM lineas_temporales WHERE nombre=:nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':nombre'=>$nombre));
  $this->objetos=$query->fetchAll();
  //si ya existe la entrada, no se añade
  if(!empty($this->objetos)){
    echo "no-add";
  }else{
    $sql="INSERT INTO lineas_temporales(nombre) VALUES (:nombre);";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre));
    echo "add";
  }
}

function getTimelines(){
  $sql="SELECT * FROM lineas_temporales WHERE nombre NOT LIKE '' ORDER BY nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute();
  $this->objetos=$query->fetchAll();
  return $this->objetos;
}

function borrarTimeline($id){
  $sql="DELETE FROM lineas_temporales WHERE id_cronologia=:id";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':id'=>$id));
  if(!empty($query->execute(array(':id'=>$id)))){
      echo 'borrado';
  }else{
      echo 'no-borrado';
  }
}

function editarTimeline($id, $nombre){
  //se busca si ya existe una cronologia con el $nombre
  $sql="SELECT id_cronologia FROM lineas_temporales WHERE nombre=:nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':nombre'=>$nombre));
  $this->objetos=$query->fetchAll();
  //si ya existe, no se edita
  if(!empty($this->objetos)){
    echo "no-edit";
  }else{
    $sql="UPDATE lineas_temporales SET nombre=:nombre WHERE id_cronologia=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre, ':id'=>$id));
    echo "edit";
  }
}

//////////////funciones para tipos de organizacion ///////////////
function addTipoOrganizacion($nombre){
  //se busca si ya existe la cronologia $nombre
  $sql="SELECT id FROM tipo_organizacion WHERE nombre=:nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':nombre'=>$nombre));
  $this->objetos=$query->fetchAll();
  //si ya existe la entrada, no se añade
  if(!empty($this->objetos)){
    echo "no-add";
  }else{
    $sql="INSERT INTO tipo_organizacion(nombre) VALUES (:nombre);";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre));
    echo "add";
  }
}

function getTiposOrganizacion(){
  $sql="SELECT * FROM tipo_organizacion WHERE nombre NOT LIKE '' ORDER BY nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute();
  $this->objetos=$query->fetchAll();
  return $this->objetos;
}

function borrarTipoOrganizacion($id){
  $sql="DELETE FROM tipo_organizacion WHERE id=:id";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':id'=>$id));
  if(!empty($query->execute(array(':id'=>$id)))){
      echo 'borrado';
  }else{
      echo 'no-borrado';
  }
}

function editarTipoOrganizacion($id, $nombre){
  //se busca si ya existe una cronologia con el $nombre
  $sql="SELECT id FROM tipo_organizacion WHERE nombre=:nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':nombre'=>$nombre));
  $this->objetos=$query->fetchAll();
  //si ya existe, no se edita
  if(!empty($this->objetos)){
    echo "no-edit";
  }else{
    $sql="UPDATE tipo_organizacion SET nombre=:nombre WHERE id=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre, ':id'=>$id));
    echo "edit";
  }
}

//////////////funciones para tipos de asentamiento ///////////////
function addTipoAsentamiento($nombre){
  //se busca si ya existe la cronologia $nombre
  $sql="SELECT id FROM tipo_asentamiento WHERE nombre=:nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':nombre'=>$nombre));
  $this->objetos=$query->fetchAll();
  //si ya existe la entrada, no se añade
  if(!empty($this->objetos)){
    echo "no-add";
  }else{
    $sql="INSERT INTO tipo_asentamiento(nombre) VALUES (:nombre);";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre));
    echo "add";
  }
}

function getTiposAsentamiento(){
  $sql="SELECT * FROM tipo_asentamiento WHERE nombre NOT LIKE '' ORDER BY nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute();
  $this->objetos=$query->fetchAll();
  return $this->objetos;
}

function borrarTipoAsentamiento($id){
  $sql="DELETE FROM tipo_asentamiento WHERE id=:id";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':id'=>$id));
  if(!empty($query->execute(array(':id'=>$id)))){
      echo 'borrado';
  }else{
      echo 'no-borrado';
  }
}

function editarTipoAsentamiento($id, $nombre){
  //se busca si ya existe una cronologia con el $nombre
  $sql="SELECT id FROM tipo_asentamiento WHERE nombre=:nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':nombre'=>$nombre));
  $this->objetos=$query->fetchAll();
  //si ya existe, no se edita
  if(!empty($this->objetos)){
    echo "no-edit";
  }else{
    $sql="UPDATE tipo_asentamiento SET nombre=:nombre WHERE id=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre, ':id'=>$id));
    echo "edit";
  }
}

//////////////funciones para tipos de lugares ///////////////
function addTipoLugar($nombre){
  //se busca si ya existe la cronologia $nombre
  $sql="SELECT id FROM tipo_lugar WHERE nombre=:nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':nombre'=>$nombre));
  $this->objetos=$query->fetchAll();
  //si ya existe la entrada, no se añade
  if(!empty($this->objetos)){
    echo "no-add";
  }else{
    $sql="INSERT INTO tipo_lugar(nombre) VALUES (:nombre);";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre));
    echo "add";
  }
}

function getTiposLugar(){
  $sql="SELECT * FROM tipo_lugar WHERE nombre NOT LIKE '' ORDER BY nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute();
  $this->objetos=$query->fetchAll();
  return $this->objetos;
}

function borrarTipoLugar($id){
  $sql="DELETE FROM tipo_lugar WHERE id=:id";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':id'=>$id));
  if(!empty($query->execute(array(':id'=>$id)))){
      echo 'borrado';
  }else{
      echo 'no-borrado';
  }
}

function editarTipoLugar($id, $nombre){
  //se busca si ya existe una cronologia con el $nombre
  $sql="SELECT id FROM tipo_lugar WHERE nombre=:nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':nombre'=>$nombre));
  $this->objetos=$query->fetchAll();
  //si ya existe, no se edita
  if(!empty($this->objetos)){
    echo "no-edit";
  }else{
    $sql="UPDATE tipo_lugar SET nombre=:nombre WHERE id=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre, ':id'=>$id));
    echo "edit";
  }
}
}
?>