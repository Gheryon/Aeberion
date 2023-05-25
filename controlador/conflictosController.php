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
  $conflicto->lastConflicto();
  $id=$conflicto->objetos[0]->id;
  if(isset($_POST['atacantes'])) {
    foreach($_POST['atacantes'] as $atacante) {
      $conflicto->insertBeligerantes($id, $atacante, 'atacante');
    }
  }
  if(isset($_POST['defensores'])) {
    foreach($_POST['defensores'] as $defensor) {
      $conflicto->insertBeligerantes($id, $defensor, 'defensor');
    }
  }
}

if($_POST['funcion']=='buscar_conflictos'){
  $json=array();
  $conflicto->buscar();
  foreach ($conflicto->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id_conflicto,
      'nombre'=>$objeto->nombre,
      'descripcion'=>$objeto->descripcion
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
      'id_tipo_conflicto'=>$objeto->id_tipo_conflicto,
      'tipo_conflicto'=>$objeto->tipoconflicto,
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
  if(isset($_POST['atacantes'])) {
    editarBeligerantes($id, 'atacante');
  }
  if(isset($_POST['defensores'])) {
    editarBeligerantes($id, 'defensor');
  }
  echo 'editado';
}

if($_POST['funcion']=='get_beligerantes'){
	$conflicto->loadBeligerantes($_POST['id']);
	$json = array();
	foreach ($conflicto->objetos as $objeto) {
		$json[] = array(
			'id' => $objeto->id_organizacion,
			'nombre' => $objeto->nombre,
      'lado'=>$objeto->lado
		);
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

function editarBeligerantes($id, $lado){
  $conflicto=new Conflicto();
  $conflicto->buscarBeligerantes($id, $lado);
  $beligeranteDB=$conflicto->objetos;
  if($lado=='atacante'){
    $beligeranteNew=$_POST['atacantes'];
  }else{
    $beligeranteNew=$_POST['defensores'];
  }
  $beligeranteOld=Array();
  //se convierte a array las id de los beligerante en la bd
  foreach($beligeranteDB as $beligerante) {
    array_push($beligeranteOld, $beligerante->id_organizacion);
  }
  //al hacer array_diff, en addbeligerante quedan las entradas nuevas que no están en la db
  $addbeligerante=array_diff($beligeranteNew, $beligeranteOld);
  if(sizeof($addbeligerante)>0){
    foreach($addbeligerante as $beligerante) {
      $conflicto->insertBeligerantes($id, $beligerante, $lado);
    }
  }
  //al hacer array_diff, en dltbeligerante quedan las entradas que hay que eliminar en la db
  $dltbeligerante=array_diff($beligeranteOld, $beligeranteNew);
  if(sizeof($dltbeligerante)>0){
    foreach($dltbeligerante as $beligerante) {
      $conflicto->deleteBeligerantes($id, $beligerante, $lado);
    }
  }
}
?>