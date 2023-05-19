<?php
include '../modelo/configuracion.php';

$configuracion=new Configuracion();

///////funciones para obtener tipos/////////
if($_POST['funcion']=='get_tipos_evento'){
  $configuracion->getTiposEventos();
  $json=array();
  foreach ($configuracion->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id,
      'nombre'=>$objeto->nombre
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion']=='get_timelines'){
  $configuracion->getTimelines();
  $json=array();
  foreach ($configuracion->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id,
      'nombre'=>$objeto->nombre
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion']=='get_tipos_organizacion'){
  $configuracion->getTiposOrganizacion();
  $json=array();
  foreach ($configuracion->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id,
      'nombre'=>$objeto->nombre
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion']=='get_tipos_asentamiento'){
  $configuracion->getTiposAsentamiento();
  $json=array();
  foreach ($configuracion->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id,
      'nombre'=>$objeto->nombre
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion']=='get_tipos_lugar'){
  $configuracion->getTiposLugar();
  $json=array();
  foreach ($configuracion->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id,
      'nombre'=>$objeto->nombre
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion']=='get_tipos_conflicto'){
  $configuracion->getTiposConflicto();
  $json=array();
  foreach ($configuracion->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id,
      'nombre'=>$objeto->nombre
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

////////funciones para añadir, editar y borrar tipos/////////////
if($_POST['funcion']=='add_tipo'){
  $nombre = $_POST['nombre'];
  if($_POST['tipo']=='evento'){
    $tipo='tipo_evento';
  }
  if($_POST['tipo']=='timeline'){
    $tipo='lineas_temporales';
  }
  if($_POST['tipo']=='organizacion'){
    $tipo='tipo_organizacion';
  }
  if($_POST['tipo']=='asentamiento'){
    $tipo='tipo_asentamiento';
  }
  if($_POST['tipo']=='lugar'){
    $tipo='tipo_lugar';
  }
  if($_POST['tipo']=='conflicto'){
    $tipo='tipo_conflicto';
  }
  $configuracion->addTipo($tipo, $nombre);
}

if($_POST['funcion']=='delete_tipo'){
  $id = $_POST['id'];
  if($_POST['tipo']=='evento'){
    $tipo='tipo_evento';
  }
  if($_POST['tipo']=='timeline'){
    $tipo='lineas_temporales';
  }
  if($_POST['tipo']=='organizacion'){
    $tipo='tipo_organizacion';
  }
  if($_POST['tipo']=='asentamiento'){
    $tipo='tipo_asentamiento';
  }
  if($_POST['tipo']=='lugar'){
    $tipo='tipo_lugar';
  }
  if($_POST['tipo']=='conflicto'){
    $tipo='tipo_conflicto';
  }
  $configuracion->deleteTipo($id, $tipo);
}

if($_POST['funcion']=='edit_tipo'){
  $id=$_POST['id'];
  $nombre=$_POST['nombre'];
  if($_POST['tipo']=='evento'){
    $tipo='tipo_evento';
  }
  if($_POST['tipo']=='timeline'){
    $tipo='lineas_temporales';
  }
  if($_POST['tipo']=='organizacion'){
    $tipo='tipo_organizacion';
  }
  if($_POST['tipo']=='asentamiento'){
    $tipo='tipo_asentamiento';
  }
  if($_POST['tipo']=='lugar'){
    $tipo='tipo_lugar';
  }
  if($_POST['tipo']=='conflicto'){
    $tipo='tipo_conflicto';
  }
  $configuracion->editarTipo($id, $nombre, $tipo);
}
?>