<?php
include_once '../modelo/asentamiento.php';
include_once '../modelo/fechas.php';
$asentamiento = new Asentamiento();
$fecha = new Fecha();

if($_POST['funcion']=='crear_nuevo_asentamiento'){
  $nombre=$tipo=$gentilicio=$fundacion=$disolucion=$descripcion=$poblacion=$demografia=$gobierno=$infraestructura=$historia=$defensas=$economia=$cultura=$geografia=$clima=$recursos=$otros=null;

  if(isset($_POST['nombre'])) {
    $nombre=$_POST['nombre'];
    if(!$asentamiento->existeAsentamiento($nombre)){
      if(isset($_POST['tipo_select'])) {
        $tipo=$_POST['tipo_select'];}
      if(isset($_POST['gentilicio'])) {
        $gentilicio=$_POST['gentilicio'];}
      if(isset($_POST['owner'])) {
        $otros=$_POST['owner'];}
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
      
      $fecha_fundacion=$fecha_disolucion=null;
      if (isset($_POST['afundacion'])) {
        $afundacion = $_POST['afundacion'];
        $dfundacion=0;
        $mfundacion=0;
        if (isset($_POST['dfundacion'])) {
          $dfundacion = $_POST['dfundacion'];}
        if (isset($_POST['mfundacion'])) {
          $mfundacion = $_POST['mfundacion'];}
        if($_POST['id_fundacion']==0){
          $fecha->addFecha($dfundacion, $mfundacion, $afundacion, "asentamientos");
          $fecha->lastIdFechas();
          $fecha_fundacion=$fecha->objetos[0]->id;
        }else{
          $fecha_fundacion=$_POST['id_fundacion'];
          $fecha->editFecha($_POST['id_fundacion'], $dfundacion, $mfundacion, $afundacion, "asentamientos");
        }
      }
    
      if(isset($_POST['adisolucion'])){
        $adisolucion = $_POST['adisolucion'];
        $ddisolucion=0;
        $mdisolucion=0;
        if (isset($_POST['ddisolucion'])) {
          $ddisolucion = $_POST['ddisolucion'];}
        if (isset($_POST['mdisolucion'])) {
          $mdisolucion = $_POST['mdisolucion'];}
        if ($_POST['id_disolucion']==0) {
          $fecha->addFecha($ddisolucion, $mdisolucion, $adisolucion, "instituciones");
          $fecha->lastIdFechas();
          $fecha_disolucion=$fecha->objetos[0]->id;
        }else{
          $fecha_disolucion=$_POST['id_disolucion'];
          $fecha->editFecha($fecha_disolucion, $ddisolucion, $mdisolucion, $adisolucion, "instituciones");
        }
      }
    
      $asentamiento->createAsentamiento($nombre, $tipo, $gentilicio, $fecha_fundacion, $fecha_disolucion, $owner, $descripcion, $poblacion, $demografia, $gobierno, $infraestructura, $historia, $defensas, $economia, $cultura, $geografia, $clima, $recursos, $otros);
        
      $mensaje='success_add';
    }else{
      $mensaje='error_existencia';
    }
  }
  	
	$json=array(
		'mensaje'=>$mensaje,
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
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
  $fundacion=$dia_fundacion=$mes_fundacion=$anno_fundacion=null;
	$disolucion=$dia_disolucion=$mes_disolucion=$anno_disolucion=null;
	if($asentamiento->objetos[0]->fundacion!=null){
		$fecha->getFecha($asentamiento->objetos[0]->fundacion, "asentamientos");
		$dia_fundacion=$fecha->objetos[0]->dia;
		$mes_fundacion=$fecha->objetos[0]->mes;
		$anno_fundacion=$fecha->objetos[0]->anno;
		$fundacion=implode("-",array($fecha->objetos[0]->dia, $fecha->getMes($fecha->objetos[0]->mes), $fecha->objetos[0]->anno));
	}
	if($asentamiento->objetos[0]->disolucion!=null){
		$fecha->getFecha($asentamiento->objetos[0]->disolucion, "asentamientos");
		$dia_disolucion=$fecha->objetos[0]->dia;
		$mes_disolucion=$fecha->objetos[0]->mes;
		$anno_disolucion=$fecha->objetos[0]->anno;
		$disolucion=implode("-",array($fecha->objetos[0]->dia, $fecha->getMes($fecha->objetos[0]->mes), $fecha->objetos[0]->anno));
	}
  $json[]=array(
    'id'=>$asentamiento->objetos[0]->id_asentamiento,
    'nombre'=>$asentamiento->objetos[0]->nombre,
    'tipo'=>$asentamiento->objetos[0]->tipo,
    'id_tipo'=>$asentamiento->objetos[0]->id_tipo,
    'id_owner'=>$asentamiento->objetos[0]->id_owner,
    'nombre_owner'=>$asentamiento->objetos[0]->nombre_owner,
    'gentilicio'=>$asentamiento->objetos[0]->gentilicio,
    'id_fundacion' => $asentamiento->objetos[0]->fundacion,
    'fundacion' => $fundacion,
    'dia_fundacion' => $dia_fundacion,
    'mes_fundacion' => $mes_fundacion,
    'anno_fundacion' => $anno_fundacion,
    'id_disolucion' => $asentamiento->objetos[0]->disolucion,
    'disolucion' => $disolucion,
    'dia_disolucion' => $dia_disolucion,
    'mes_disolucion' => $mes_disolucion,
    'anno_disolucion' => $anno_disolucion,
    'descripcion'=>$asentamiento->objetos[0]->descripcion,
    'poblacion'=>$asentamiento->objetos[0]->poblacion,
    'demografia'=>$asentamiento->objetos[0]->demografia,
    'gobierno'=>$asentamiento->objetos[0]->gobierno,
    'infraestructura'=>$asentamiento->objetos[0]->infraestructura,
    'historia'=>$asentamiento->objetos[0]->historia,
    'defensas'=>$asentamiento->objetos[0]->defensas,
    'economia'=>$asentamiento->objetos[0]->economia,
    'cultura'=>$asentamiento->objetos[0]->cultura,
    'geografia'=>$asentamiento->objetos[0]->geografia,
    'clima'=>$asentamiento->objetos[0]->clima,
    'recursos'=>$asentamiento->objetos[0]->recursos,
    'otros'=>$asentamiento->objetos[0]->otros
  );
	$jsonstring=json_encode($json[0]);
	echo $jsonstring;
}

if($_POST['funcion']=='borrar_asentamiento'){
	$mensaje='';
  $id_borrado=$_POST['id_asentamiento'];
  $asentamiento->idFechas($id_borrado);
  $asentamiento->borrarAsentamiento($id_borrado);
	$fecha->borrarFecha($asentamiento->objetos[0]->fundacion);
  $fecha->borrarFecha($asentamiento->objetos[0]->disolucion);
  if($asentamiento->borrarAsentamiento($id_borrado)){
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

if($_POST['funcion']=='editar_asentamiento'){
  $nombre=$tipo=$gentilicio=$descripcion=$poblacion=$demografia=$gobierno=$infraestructura=$historia=$defensas=$economia=$cultura=$geografia=$clima=$recursos=$otros=$owner=null;

  if(isset($_POST['nombre'])) {
    $nombre=$_POST['nombre'];}
  if(isset($_POST['tipo_select'])) {
    $tipo=$_POST['tipo_select'];}
  if(isset($_POST['gentilicio'])) {
    $gentilicio=$_POST['gentilicio'];}
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
  if(isset($_POST['owner'])) {
    $owner=$_POST['owner'];}
    
  $id=$_POST['id_editado'];

  $fecha_fundacion=$fecha_disolucion=null;
	if(isset($_POST['afundacion'])){
		$afundacion = $_POST['afundacion'];
		$dfundacion=0;
		$mfundacion=0;
		if (isset($_POST['dfundacion'])) {
			$dfundacion = $_POST['dfundacion'];}
		if (isset($_POST['mfundacion'])) {
			$mfundacion = $_POST['mfundacion'];}
		if ($_POST['id_fundacion']==0) {
			$fecha->addFecha($dfundacion, $mfundacion, $afundacion, "asentamientos");
			$fecha->lastIdFechas();
			$fecha_fundacion=$fecha->objetos[0]->id;
		}else{
			$fecha_fundacion=$_POST['id_fundacion'];
			$fecha->editFecha($fecha_fundacion, $dfundacion, $mfundacion, $afundacion, "asentamientos");
		}
	}

	if(isset($_POST['adisolucion'])){
		$adisolucion = $_POST['adisolucion'];
		$ddisolucion=0;
		$mdisolucion=0;
		if (isset($_POST['ddisolucion'])) {
			$ddisolucion = $_POST['ddisolucion'];}
		if (isset($_POST['mdisolucion'])) {
			$mdisolucion = $_POST['mdisolucion'];}
		if ($_POST['id_disolucion']==0) {
			$fecha->addFecha($ddisolucion, $mdisolucion, $adisolucion, "asentamientos");
			$fecha->lastIdFechas();
			$fecha_disolucion=$fecha->objetos[0]->id;
		}else{
			$fecha_disolucion=$_POST['id_disolucion'];
			$fecha->editFecha($fecha_disolucion, $ddisolucion, $mdisolucion, $adisolucion, "asentamientos");
		}
	}
  $asentamiento->editarAsentamiento($id, $nombre, $tipo, $gentilicio, $fecha_fundacion, $fecha_disolucion, $owner, $descripcion, $poblacion, $demografia, $gobierno, $infraestructura, $historia, $defensas, $economia, $cultura, $geografia, $clima, $recursos, $otros);
		
	$mensaje='success_edit';
	
	$json=array(
		'mensaje'=>$mensaje,
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
}
?>