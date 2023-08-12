<?php
include_once '../modelo/conflicto.php';
include_once '../modelo/fechas.php';
$conflicto=new Conflicto();
$fecha = new Fecha();

if($_POST['funcion']=='crear_nuevo_conflicto'){
  $nombre=$tipo_conflicto=$descripcion=$tipo_localizacion=$preludio=$desarrollo=$resultado=$consecuencias=$otros=null;

  if(isset($_POST['nombre'])) {
    $nombre=$_POST['nombre'];}
  if(isset($_POST['tipo_conflicto'])) {
    $tipo_conflicto=$_POST['tipo_conflicto'];}
  if(isset($_POST['tipo_localizacion'])) {
    $tipo_localizacion=$_POST['tipo_localizacion'];}
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

  $fecha_inicio=$fecha_fin=null;
	if($_POST['afundacion']!='anno'){
		$afundacion = $_POST['afundacion'];
		$dfundacion=0;
		$mfundacion=0;
		if (isset($_POST['dfundacion'])) {
			$dfundacion = $_POST['dfundacion'];}
		if (isset($_POST['mfundacion'])) {
			$mfundacion = $_POST['mfundacion'];}
		if ($_POST['id_fundacion']==0) {
			$fecha->addFecha($dfundacion, $mfundacion, $afundacion, "conflictos");
			$fecha->lastIdFechas();
			$fecha_inicio=$fecha->objetos[0]->id;
		}else{
			$fecha_inicio=$_POST['id_fundacion'];
			$fecha->editFecha($fecha_inicio, $dfundacion, $mfundacion, $afundacion, "conflictos");
		}
	}

	if($_POST['adisolucion']!='anno'){
		$adisolucion = $_POST['adisolucion'];
		$ddisolucion=0;
		$mdisolucion=0;
		if (isset($_POST['ddisolucion'])) {
			$ddisolucion = $_POST['ddisolucion'];}
		if (isset($_POST['mdisolucion'])) {
			$mdisolucion = $_POST['mdisolucion'];}
		if ($_POST['id_disolucion']==0) {
			$fecha->addFecha($ddisolucion, $mdisolucion, $adisolucion, "conflictos");
			$fecha->lastIdFechas();
			$fecha_fin=$fecha->objetos[0]->id;
		}else{
			$fecha_fin=$_POST['id_disolucion'];
			$fecha->editFecha($fecha_fin, $ddisolucion, $mdisolucion, $adisolucion, "conflictos");
		}
  }
  if($_POST['id_editado']!=0){//se está editando una entrada
    $conflicto->editarConflicto($nombre, $tipo_conflicto, $descripcion, $tipo_localizacion, $fecha_inicio, $fecha_fin, $preludio, $desarrollo, $resultado, $consecuencias, $otros, $_POST['id_editado']);
    if(isset($_POST['atacantes'])) {
      editarBeligerantes($id, 'atacante');
    }
    if(isset($_POST['defensores'])) {
      editarBeligerantes($id, 'defensor');
    }
    echo 'editado';

  }else{//se está insertando una entrada
    $conflicto->insertConflicto($nombre, $tipo_conflicto, $descripcion, $tipo_localizacion, $fecha_inicio, $fecha_fin, $preludio, $desarrollo, $resultado, $consecuencias, $otros);
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
  $inicio=$dia_inicio=$mes_inicio=$anno_inicio=null;
	$fin=$dia_fin=$mes_fin=$anno_fin=null;
	if($conflicto->objetos[0]->fecha_inicio!=null){
		$fecha->getFecha($conflicto->objetos[0]->fecha_inicio, "conflictos");
		$dia_inicio=$fecha->objetos[0]->dia;
		$mes_inicio=$fecha->objetos[0]->mes;
		$anno_inicio=$fecha->objetos[0]->anno;
		$inicio=implode("-",array($fecha->objetos[0]->dia, $fecha->getMes($fecha->objetos[0]->mes), $fecha->objetos[0]->anno));
	}
	if($conflicto->objetos[0]->fecha_fin!=null){
		$fecha->getFecha($conflicto->objetos[0]->fecha_fin, "conflictos");
		$dia_fin=$fecha->objetos[0]->dia;
		$mes_fin=$fecha->objetos[0]->mes;
		$anno_fin=$fecha->objetos[0]->anno;
		$fin=implode("-",array($fecha->objetos[0]->dia, $fecha->getMes($fecha->objetos[0]->mes), $fecha->objetos[0]->anno));
	}
  $json[]=array(
    'id'=>$conflicto->objetos[0]->id_conflicto,
    'nombre'=>$conflicto->objetos[0]->nombre,
    'descripcion'=>$conflicto->objetos[0]->descripcion,
    'id_inicio' => $conflicto->objetos[0]->fecha_inicio,
    'inicio' => $inicio,
    'dia_inicio' => $dia_inicio,
    'mes_inicio' => $mes_inicio,
    'anno_inicio' => $anno_inicio,
    'id_fin' => $conflicto->objetos[0]->fecha_fin,
    'fin' => $fin,
    'dia_fin' => $dia_fin,
    'mes_fin' => $mes_fin,
    'anno_fin' => $anno_fin,
    'id_tipo_conflicto'=>$conflicto->objetos[0]->id_tipo_conflicto,
    'tipo_conflicto'=>$conflicto->objetos[0]->tipoconflicto,
    'tipo_localizacion'=>$conflicto->objetos[0]->tipo_localizacion,
    'preludio'=>$conflicto->objetos[0]->preludio,
    'desarrollo'=>$conflicto->objetos[0]->desarrollo,
    'resultado'=>$conflicto->objetos[0]->resultado,
    'consecuencias'=>$conflicto->objetos[0]->consecuencias,
    'otros'=>$conflicto->objetos[0]->otros
  );
  
  $jsonstring=json_encode($json[0]);
  echo $jsonstring;
}

if($_POST['funcion']=='borrar_conflicto'){
  $mensaje='';
  $id_borrado=$_POST['id_conflicto'];
  $conflicto->idFechas($id_borrado);
  $conflicto->borrarConflicto($id_borrado);
  $fecha->borrarFecha($conflicto->objetos[0]->fecha_inicio);
  $fecha->borrarFecha($conflicto->objetos[0]->fecha_fin);
  if($conflicto->buscarConflicto($id_borrado)){
    $mensaje='no-borrado';
  }else{
    $mensaje='borrado';
  }
  $json=array(
		'mensaje'=>$mensaje,
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
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