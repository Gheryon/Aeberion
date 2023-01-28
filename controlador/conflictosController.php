<?php
include_once '../modelo/conflicto.php';
$conflicto=new Conflicto();

if($_POST['funcion']=='crear_nuevo_conflicto'){
  $nombre=$tipo_conflicto=$descripcion=$tipo_localizacion=$comienzo=$finalizacion=$preludio=$desarrollo=$resultado=$consecuencias=$otros=null;

  if(isset($_POST['nombre'])) {
    $nombre=$_POST['nombre'];}
  if(isset($_POST['tipo_conflicto'])) {
    $tipo_conflicto=$_POST['tipo_conflicto'];}
  if(isset($_POST['tipo_localizacion'])) {
    $tipo_localizacion=$_POST['tipo_localizacion'];}
  if(isset($_POST['fecha_inicio'])) {
    $comienzo=$_POST['fecha_inicio'];}
  if(isset($_POST['fecha_final'])) {
    $finalizacion=$_POST['fecha_final'];}
  if(isset($_POST['descripcion'])) {
    $descripcion=$_POST['descripcion'];}
  if(isset($_POST['preludio'])) {
    $preludio=$_POST['preludio'];}
  if(isset($_POST['desarrollo'])) {
    $desarrollo=$_POST['desarrollo'];}
  if(isset($_POST['resultado'])) {
    $resultado=$_POST['resultado'];}
  if(isset($_POST['consecuencias'])) {
    $consecuencias=$_POST['consecuencias'];}
  if(isset($_POST['otros'])) {
    $otros=$_POST['otros'];}
  
  $conflicto->insertConflicto($nombre, $tipo_conflicto, $descripcion, $tipo_localizacion, $comienzo, $finalizacion, $preludio, $desarrollo, $resultado, $consecuencias, $otros);
}

if($_POST['funcion']=='buscar_conflictos'){
  $json=array();
  $conflicto->buscar();
  foreach ($conflicto->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id_conflicto,
      'nombre'=>$objeto->nombre,
      'descripcion'=>$objeto->descripcion,
      'comienzo'=>$objeto->comienzo,
      'final'=>$objeto->finalizacion
    );
  }
  $jsonstring=json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion']=='ver_conflicto'){
  $json=array();
  $conflicto->buscarConflicto($_POST['dato']);
  foreach ($conflicto->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id_conflicto,
      'nombre'=>$objeto->nombre,
      'descripcion'=>$objeto->descripcion,
      'comienzo'=>$objeto->comienzo,
      'final'=>$objeto->finalizacion,
      'tipo_conflicto'=>$objeto->tipo_conflicto,
      'tipo_localizacion'=>$objeto->tipo_localizacion,
      'preludio'=>$objeto->preludio,
      'desarrollo'=>$objeto->desarrollo,
      'resultado'=>$objeto->resultado,
      'consecuencias'=>$objeto->consecuencias,
      'otros'=>$objeto->otros
    );
  }
  $jsonstring=json_encode($json[0]);
  echo $jsonstring;
}

if($_POST['funcion']=='borrar_conflicto'){
  $id_borrado=$_POST['id_conflicto'];
  $conflicto->borrarConflicto($id_borrado);
}

if($_POST['funcion']=='editar_conflicto'){
  $nombre=$tipo_conflicto=$descripcion=$tipo_localizacion=$comienzo=$finalizacion=$preludio=$desarrollo=$resultado=$consecuencias=$otros=null;

  if(isset($_POST['nombre'])) {
    $nombre=$_POST['nombre'];}
  if(isset($_POST['tipo_conflicto'])) {
    $tipo_conflicto=$_POST['tipo_conflicto'];}
  if(isset($_POST['tipo_localizacion'])) {
    $tipo_localizacion=$_POST['tipo_localizacion'];}
  if(isset($_POST['fecha_inicio'])) {
    $comienzo=$_POST['fecha_inicio'];}
  if(isset($_POST['fecha_final'])) {
    $finalizacion=$_POST['fecha_final'];}
  if(isset($_POST['descripcion'])) {
    $descripcion=$_POST['descripcion'];}
  if(isset($_POST['preludio'])) {
    $preludio=$_POST['preludio'];}
  if(isset($_POST['desarrollo'])) {
    $desarrollo=$_POST['desarrollo'];}
  if(isset($_POST['resultado'])) {
    $resultado=$_POST['resultado'];}
  if(isset($_POST['consecuencias'])) {
    $consecuencias=$_POST['consecuencias'];}
  if(isset($_POST['otros'])) {
    $otros=$_POST['otros'];}
    $id=$_POST['id_editado'];

    $conflicto->editarConflicto($nombre, $tipo_conflicto, $descripcion, $tipo_localizacion, $comienzo, $finalizacion, $preludio, $desarrollo, $resultado, $consecuencias, $otros, $id);
    echo 'editado';
}

?>