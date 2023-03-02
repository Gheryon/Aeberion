<?php
include_once 'conexionDB.php';

class Evento{
  var $objetos;
  public function __construct(){
      $db = new Conexion();
      $this->acceso = $db->pdo;
  }

  function addEvento($nombre, $anno, $mes, $dia, $descripcion, $lineaTemporal, $tipo){
    //se busca si ya existe la entrada
    $sql="SELECT id FROM timelines WHERE nombre=:nombre";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre));
    $this->objetos=$query->fetchAll();
    //si ya existe la entrada, no se añade
    if(!empty($this->objetos)){
      echo "no-add";
    }else{
      $sql="INSERT INTO timelines(nombre, anno, mes, dia, id_tipo_evento, descripcion, linea_temporal, lineaTemporal) VALUES (:nombre, :anno, :mes, :dia, :id_tipo_evento, :descripcion, :linea_temporal, :lineaTemporal);";
      $query=$this->acceso->prepare($sql);
      $query->execute(array(':nombre'=>$nombre, ':anno'=>$anno, ':mes'=>$mes, ':dia'=>$dia, ':id_tipo_evento'=>$tipo, ':descripcion'=>$descripcion, ':linea_temporal'=>$lineaTemporal, ':lineaTemporal'=>$lineaTemporal));
      echo "add";
    }
  }

  function buscar(){
    //se ha introducido algún caracter a buscar, se devuelven los usuarios que encagen con la consulta
    if(!empty($_POST['consulta'])){
      $consulta=$_POST['consulta'];
      $sql="SELECT * FROM timelines WHERE nombre LIKE :consulta";
      $query=$this->acceso->prepare($sql);
      $query->execute(array(':consulta'=>"%$consulta%"));
      $this->objetos=$query->fetchAll();
      return $this->objetos;
    }else{
        //se devuelven todos los usuarios
      $sql="SELECT timelines.id, timelines.anno, timelines.dia, timelines.mes, timelines.nombre AS nombre, timelines.descripcion, timelines.id_tipo_evento, lineas_temporales.nombre AS cronologia FROM timelines JOIN lineas_temporales ON id_cronologia=id_linea_temporal WHERE timelines.nombre NOT LIKE '' ORDER BY anno";
      $query=$this->acceso->prepare($sql);
      $query->execute();
      $this->objetos=$query->fetchAll();
      return $this->objetos;
    }
  }

  function borrarEvento($id){
    $sql="DELETE FROM timelines WHERE id=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    if(!empty($query->execute(array(':id'=>$id)))){
        echo 'borrado';
    }else{
        echo 'noborrado';
    }
  }

  function buscarEvento($id){
    $sql="SELECT timelines.anno, timelines.dia, timelines.mes, timelines.nombre AS nombre, timelines.descripcion, timelines.id_tipo_evento, lineas_temporales.nombre AS cronologia FROM timelines JOIN lineas_temporales ON id_cronologia=id_linea_temporal WHERE timelines.id=:id; ";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchAll();
    return $this->objetos;
  }

  function buscar_timelines(){
    $sql="SELECT * FROM lineas_temporales ORDER BY nombre";
    $query=$this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchAll();
    return $this->objetos;
  }

  function editar($id_editado, $nombre, $dia, $mes, $anno, $descripcion, $lineaTemporal){
    $sql="UPDATE timelines SET nombre=:nombre, dia=:dia, mes=:mes, anno=:anno, descripcion=:descripcion, lineaTemporal=:lineaTemporal WHERE id=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre, ':dia'=>$dia, ':mes'=>$mes, ':anno'=>$anno, ':descripcion'=>$descripcion, ':lineaTemporal'=>$lineaTemporal, ':id'=>$id_editado));
    echo 'edit';
  }
}
?>