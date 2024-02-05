<?php
include_once 'conexionDB.php';

class Configuracion{
  var $objetos;
  public function __construct(){
      $db = new Conexion();
      $this->acceso = $db->pdo;
  }

//////funciones getTipos///////////////
function getTiposEventos(){
  $sql="SELECT * FROM tipo_evento WHERE nombre NOT LIKE '' ORDER BY nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute();
  $this->objetos=$query->fetchAll();
  return $this->objetos;
}
function getTimelines(){
  $sql="SELECT * FROM lineas_temporales WHERE nombre NOT LIKE '' ORDER BY nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute();
  $this->objetos=$query->fetchAll();
  return $this->objetos;
}
function getTiposOrganizacion(){
  $sql="SELECT * FROM tipo_organizacion WHERE nombre NOT LIKE '' ORDER BY nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute();
  $this->objetos=$query->fetchAll();
  return $this->objetos;
}
function getTiposAsentamiento(){
  $sql="SELECT * FROM tipo_asentamiento WHERE nombre NOT LIKE '' ORDER BY nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute();
  $this->objetos=$query->fetchAll();
  return $this->objetos;
}
function getTiposLugar(){
  $sql="SELECT * FROM tipo_lugar WHERE nombre NOT LIKE '' ORDER BY nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute();
  $this->objetos=$query->fetchAll();
  return $this->objetos;
}
function getTiposConflicto(){
  $sql="SELECT * FROM tipo_conflicto WHERE nombre NOT LIKE '' ORDER BY nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute();
  $this->objetos=$query->fetchAll();
  return $this->objetos;
}
//////////////funciones comunes ///////////////
function addTipo($tabla, $nombre){
  //se busca si ya existe la entrada $nombre
  $sql="SELECT id FROM $tabla WHERE nombre=:nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':nombre'=>$nombre));
  $this->objetos=$query->fetchAll();
  //si ya existe la entrada, no se añade
  if(!empty($this->objetos)){
    echo "no-add";
  }else{
    $sql="INSERT INTO $tabla(nombre) VALUES (:nombre);";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre));
    echo "add";
  }
}

function deleteTipo($id, $tabla){
  $sql="DELETE FROM $tabla WHERE id=:id";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':id'=>$id));
  if(!empty($query->execute(array(':id'=>$id)))){
      echo 'borrado';
  }else{
      echo 'no-borrado';
  }
}

function editarTipo($id, $nombre, $tabla){
  //se busca si ya existe el $nombre
  $sql="SELECT id FROM $tabla WHERE nombre=:nombre";
  $query=$this->acceso->prepare($sql);
  $query->execute(array(':nombre'=>$nombre));
  $this->objetos=$query->fetchAll();
  //si ya existe, no se edita
  if(!empty($this->objetos)){
    echo "no-edit";
  }else{
    $sql="UPDATE $tabla SET nombre=:nombre WHERE id=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre, ':id'=>$id));
    echo "edit";
  }
}

///////////funciones para backup//////////
function backup(){
  $backup_file = "../util/backups/aeberion-" .date("Y-m-d-H-i-s"). ".sql";
  //$backup_file = "C:\Users\Gheryon\Downloads\aeberion-" .date("Y-m-d-H-i-s"). ".sql";

  //por alguna razon, es necesario poner la ruta completa para que mysqldump funcione
  $result=exec('C:/xampp/mysql/bin/mysqldump db_aeberion --password=zewion --user=Gheryon --single-transaction >'.$backup_file,$output);
  var_dump($result);
  if(empty($result)){
    echo "éxito";
    /* no output is good */}
  else {
    echo "Error ";
    echo $output;
    /* we have something to log the output here*/}
  //$this->objetos=$this->servidor;
  //return $this->objetos;
}

}
?>