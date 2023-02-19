<?php
include_once '../modelo/asentamiento.php';
$asentamiento = new Asentamiento();

if($_POST['funcion']=='crear_nuevo_asentamiento'){
  $nombre=$tipo=$gentilicio=$fundacion=$disolucion=$descripcion=$poblacion=$demografia=$gobierno=$infraestructura=$historia=$defensas=$economia=$cultura=$geografia=$clima=$recursos=$otros=null;

  if(isset($_POST['nombre'])) {
    $nombre=$_POST['nombre'];}
  if(isset($_POST['tipo'])) {
    $tipo=$_POST['tipo'];}
  if(isset($_POST['gentilicio'])) {
    $gentilicio=$_POST['gentilicio'];}
  if(isset($_POST['fundacion'])) {
    $fundacion=$_POST['fundacion'];}
  if(isset($_POST['disolucion'])) {
    $disolucion=$_POST['disolucion'];}
  if(isset($_POST['descripcion'])) {
    $descripcion=$_POST['descripcion'];}
  if(isset($_POST['poblacion'])) {
    $poblacion=$_POST['poblacion'];}
  if(isset($_POST['demografia'])) {
    $demografia=$_POST['demografia'];}
  if(isset($_POST['gobierno'])) {
    $gobierno=$_POST['gobierno'];}
  if(isset($_POST['infraestructura'])) {
    $infraestructura=$_POST['infraestructura'];}
  if(isset($_POST['historia'])) {
    $historia=$_POST['historia'];}
  if(isset($_POST['defensas'])) {
    $defensas=$_POST['defensas'];}
  if(isset($_POST['economia'])) {
    $economia=$_POST['economia'];}
  if(isset($_POST['cultura'])) {
    $cultura=$_POST['cultura'];}
  if(isset($_POST['geografia'])) {
    $geografia=$_POST['geografia'];}
  if(isset($_POST['clima'])) {
      $clima=$_POST['clima'];}
  if(isset($_POST['recursos'])) {
      $recursos=$_POST['recursos'];}
  if(isset($_POST['otros'])) {
      $otros=$_POST['otros'];}
  
  $asentamiento->createAsentamiento($nombre, $tipo, $gentilicio, $fundacion, $disolucion, $descripcion, $poblacion, $demografia, $gobierno, $infraestructura, $historia, $defensas, $economia, $cultura, $geografia, $clima, $recursos, $otros);
}

if($_POST['funcion']=='buscar_asentamientos'){
  $json=array();
  $asentamiento->buscar();
  foreach ($asentamiento->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id_asentamiento,
      'nombre'=>$objeto->nombre,
      'descripcion'=>$objeto->descripcion,
      'tipo'=>$objeto->tipo
    );
  }
  $jsonstring=json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion']=='ver_asentamiento'){
	$json=array();
	$asentamiento->buscarAsentamiento($_POST['dato']);
	foreach ($asentamiento->objetos as $objeto) {
		$json[]=array(
			'id'=>$objeto->id_asentamiento,
			'nombre'=>$objeto->nombre,
			'tipo'=>$objeto->tipo,
			'gentilicio'=>$objeto->gentilicio,
			'fundacion'=>$objeto->fundacion,
			'disolucion'=>$objeto->disolucion,
			'descripcion'=>$objeto->descripcion,
			'poblacion'=>$objeto->poblacion,
			'demografia'=>$objeto->demografia,
			'gobierno'=>$objeto->gobierno,
			'infraestructura'=>$objeto->infraestructura,
			'historia'=>$objeto->historia,
			'defensas'=>$objeto->defensas,
			'economia'=>$objeto->economia,
			'cultura'=>$objeto->cultura,
			'geografia'=>$objeto->geografia,
			'clima'=>$objeto->clima,
			'recursos'=>$objeto->recursos,
			'otros'=>$objeto->otros
		);
	}
	$jsonstring=json_encode($json[0]);
	echo $jsonstring;
}

if($_POST['funcion']=='borrar_asentamiento'){
  $id_borrado=$_POST['id_asentamiento'];
  $asentamiento->borrarAsentamiento($id_borrado);
}

if($_POST['funcion']=='editar_asentamiento'){
  $nombre=$tipo=$gentilicio=$fundacion=$disolucion=$descripcion=$poblacion=$demografia=$gobierno=$infraestructura=$historia=$defensas=$economia=$cultura=$geografia=$clima=$recursos=$otros=null;

  if(isset($_POST['nombre'])) {
    $nombre=$_POST['nombre'];}
  if(isset($_POST['tipo'])) {
    $tipo=$_POST['tipo'];}
  if(isset($_POST['gentilicio'])) {
    $gentilicio=$_POST['gentilicio'];}
  if(isset($_POST['fundacion'])) {
    $fundacion=$_POST['fundacion'];}
  if(isset($_POST['disolucion'])) {
    $disolucion=$_POST['disolucion'];}
  if(isset($_POST['descripcion'])) {
    $descripcion=$_POST['descripcion'];}
  if(isset($_POST['poblacion'])) {
    $poblacion=$_POST['poblacion'];}
  if(isset($_POST['demografia'])) {
    $demografia=$_POST['demografia'];}
  if(isset($_POST['gobierno'])) {
    $gobierno=$_POST['gobierno'];}
  if(isset($_POST['infraestructura'])) {
    $infraestructura=$_POST['infraestructura'];}
  if(isset($_POST['historia'])) {
    $historia=$_POST['historia'];}
  if(isset($_POST['defensas'])) {
    $defensas=$_POST['defensas'];}
  if(isset($_POST['economia'])) {
    $economia=$_POST['economia'];}
  if(isset($_POST['cultura'])) {
    $cultura=$_POST['cultura'];}
  if(isset($_POST['geografia'])) {
    $geografia=$_POST['geografia'];}
  if(isset($_POST['clima'])) {
      $clima=$_POST['clima'];}
  if(isset($_POST['recursos'])) {
      $recursos=$_POST['recursos'];}
  if(isset($_POST['otros'])) {
      $otros=$_POST['otros'];}
    
  $id=$_POST['id_editado'];
  $asentamiento->editarAsentamiento($id, $nombre, $tipo, $gentilicio, $fundacion, $disolucion, $descripcion, $poblacion, $demografia, $gobierno, $infraestructura, $historia, $defensas, $economia, $cultura, $geografia, $clima, $recursos, $otros);
  echo 'editado';
}
?>