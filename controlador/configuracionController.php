<?php
include '../modelo/configuracion.php';

$configuracion=new Configuracion();

///////funciones para control de tipos de evento/////////
if($_POST['funcion']=='add_tipo_evento'){
  $nombre = $_POST['nombre'];
  $configuracion->addTipoEvento($nombre);
}

if($_POST['funcion']=='get_tipos_evento'){
  $configuracion->getTiposEventos();
  $json=array();
  foreach ($configuracion->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id_tipo_evento,
      'nombre'=>$objeto->nombre
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion']=='borrar_tipo_evento'){
  $id=$_POST['id'];
  $configuracion->borrarTipoEvento($id);
}

if($_POST['funcion']=='editar_tipo_evento'){
    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $configuracion->editarTipoEvento($id, $nombre);
}

////////funciones para control timelines/////////////
if($_POST['funcion']=='add_timeline'){
  $nombre = $_POST['nombre'];
  $configuracion->addTimeline($nombre);
}

if($_POST['funcion']=='get_timelines'){
  $configuracion->getTimelines();
  $json=array();
  foreach ($configuracion->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id_cronologia,
      'nombre'=>$objeto->nombre
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion']=='borrar_timeline'){
  $id=$_POST['id'];
  $configuracion->borrarTimeline($id);
}

if($_POST['funcion']=='editar_timeline'){
    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $configuracion->editarTimeline($id, $nombre);
}
?>