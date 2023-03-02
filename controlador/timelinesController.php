<?php
include '../modelo/evento-timeline.php';

$evento=new Evento();

if($_POST['funcion']=='add'){
  $nombre=$_POST['nombre'];
  $anno=$_POST['anno'];
  $dia = $_POST['dia'];
  $mes = $_POST['mes'];
  $descripcion = $_POST['descripcion'];
  $lineaTemporal = $_POST['lineaTemporal'];
  $tipo=null;
  $evento->addEvento($nombre, $anno, $mes, $dia, $descripcion, $lineaTemporal, $tipo);
}

if($_POST['funcion']=='editar'){
  $nombre=$_POST['nombre'];
  $anno=$_POST['anno'];
  $dia = $_POST['dia'];
  $mes = $_POST['mes'];
  $descripcion = $_POST['descripcion'];
  $lineaTemporal = $_POST['lineaTemporal'];
  $id_editado = $_POST['id_editado'];
  $tipo=null;
  $evento->editar($id_editado, $nombre, $dia, $mes, $anno, $descripcion, $lineaTemporal);
}

if($_POST['funcion']=='buscar'){
  $evento->buscar();
  $json=array();
  foreach ($evento->objetos as $objeto) {
    $fecha='';
    if($objeto->dia!=null){
      $fecha=$fecha.$objeto->dia;
    }
    if($objeto->mes!=null){
      $fecha=$fecha." - ".$objeto->mes." - ";
    }
    $fecha=$fecha.$objeto->anno;
    $json[]=array(
      'id'=>$objeto->id,
      'nombre'=>$objeto->nombre,
      'anno'=>$objeto->anno,
      'mes'=>$objeto->mes,
      'dia'=>$objeto->dia,
      'descripcion'=>$objeto->descripcion,
      'fecha'=>$fecha,
      'lineaTemporal'=>$objeto->cronologia,
      'tipo'=>$objeto->id_tipo_evento
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion']=='detalles'){
  $evento->buscarEvento($_POST['id']);
  $json=array();
  foreach ($evento->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id,
      'nombre'=>$objeto->nombre,
      'anno'=>$objeto->anno,
      'mes'=>$objeto->mes,
      'dia'=>$objeto->dia,
      'descripcion'=>$objeto->descripcion,
      'lineaTemporal'=>$objeto->lineatemporal,
      'lineaCronologica'=>$objeto->cronologia,
      'tipo'=>$objeto->id_tipo_evento
    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
}

if($_POST['funcion']=='fill_select_timelines'){
  $json=array();
  $evento->buscar_timelines();
  foreach ($evento->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id_cronologia,
      'nombre'=>$objeto->nombre
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion']=='borrar'){
  $id=$_POST['id'];
  $articulo->borrar($id);
}
?>