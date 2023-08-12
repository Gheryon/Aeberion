<?php
include_once '../modelo/personaje.php';
include_once '../modelo/fechas.php';
$personaje = new Personaje();
$fecha = new Fecha();


if ($_POST['funcion'] == 'crear_nuevo_personaje') {
	$nombre = $nombre_familia = $gentilicio = $causa_fallecimiento = $apellidos = $descripcion = $descripcionshort = $personalidad = $deseos = $miedos = $magia = $historia = $religion = $familia = $politica = $especie = $sexo = null;
	if (isset($_POST['nombre'])) {
		$nombre = $_POST['nombre'];}
	if (isset($_POST['nombre_familia'])) {
		$nombre_familia = $_POST['nombre_familia'];}
	if (isset($_POST['lugar_nacimiento'])) {
		$gentilicio = $_POST['lugar_nacimiento'];}
	if (isset($_POST['causa_fallecimiento'])) {
		$causa_fallecimiento = $_POST['causa_fallecimiento'];}
	if (isset($_POST['apellidos'])) {
		$apellidos = $_POST['apellidos'];}
	if (isset($_POST['descripcion'])) {
		$descripcion = $_POST['descripcion'];}
	if (isset($_POST['DescripcionShort'])) {
		$descripcionshort = $_POST['DescripcionShort'];}
	if (isset($_POST['personalidad'])) {
		$personalidad = $_POST['personalidad'];}
	if (isset($_POST['deseos'])) {
		$deseos = $_POST['deseos'];}
	if (isset($_POST['miedos'])) {
		$miedos = $_POST['miedos'];}
	if (isset($_POST['magia'])) {
		$magia = $_POST['magia'];}
	if (isset($_POST['educacion'])) {
		$educacion = $_POST['educacion'];}
	if (isset($_POST['historia'])) {
		$historia = $_POST['historia'];}
	if (isset($_POST['religion'])) {
		$religion = $_POST['religion'];}
	if (isset($_POST['familia'])) {
		$familia = $_POST['familia'];}
	if (isset($_POST['politica'])) {
		$politica = $_POST['politica'];}
	if (isset($_POST['especie'])) {
		$especie = $_POST['especie'];}
	if (isset($_POST['sexo'])) {
		$sexo = $_POST['sexo'];}
	if (isset($_POST['otros'])) {
		$otros = $_POST['otros'];}

	if ($_FILES['retrato']['size']) {
		if(isset($_POST['id_editado'])){
			$personaje->retrado_old($_POST['id_editado']);
			if ($personaje->objetos[0]->retrato != 'default.png') {
				if (file_exists('../imagenes/Retratos/' . $personaje->objetos[0]->retrato)) {
					unlink('../imagenes/Retratos/' . $personaje->objetos[0]->retrato);
				}
			}
		}
		$retrato = uniqid() . '-' . $_FILES['retrato']['name'];
		$ruta_retrato = '../imagenes/Retratos/' . $retrato;
		move_uploaded_file($_FILES['retrato']['tmp_name'], $ruta_retrato);
	} else {
		$retrato = "default.png";
	}

	$fecha_nacimiento=$fecha_fallecimiento=null;
	if (isset($_POST['anacimiento'])) {
		$anacimiento = $_POST['anacimiento'];
		$dnacimiento=0;
		$mnacimiento=0;
		if (isset($_POST['dnacimiento'])) {
			$dnacimiento = $_POST['dnacimiento'];}
		if (isset($_POST['mnacimiento'])) {
			$mnacimiento = $_POST['mnacimiento'];}
		if ($_POST['id_nacimiento']==0) {
			$fecha->addFecha($dnacimiento, $mnacimiento, $anacimiento, "personajes");
			$fecha->lastIdFechas();
			$fecha_nacimiento=$fecha->objetos[0]->id;
		}else{
			$fecha_nacimiento=$_POST['id_nacimiento'];
			$fecha->editFecha($fecha_nacimiento, $dnacimiento, $mnacimiento, $anacimiento, "personajes");
		}
	}
	
	if (isset($_POST['afallecimiento'])) {
		$afallecimiento=$_POST['afallecimiento'];
		$dfallecimiento=0;
		$mfallecimiento=0;
		if (isset($_POST['dfallecimiento'])) {
			$dfallecimiento = $_POST['dfallecimiento'];}
		if (isset($_POST['mfallecimiento'])) {
			$mfallecimiento = $_POST['mfallecimiento'];}
		if ($_POST['id_fallecimiento']==0) {
			$fecha->addFecha($dfallecimiento, $mfallecimiento, $afallecimiento, "personajes");
			$fecha->lastIdFechas();
			$fecha_fallecimiento=$fecha->objetos[0]->id;
		}else{
			$fecha_fallecimiento=$_POST['id_fallecimiento'];
			$fecha->editFecha($fecha_fallecimiento, $dfallecimiento, $mfallecimiento, $afallecimiento, "personajes");
		}
	}

	if($_POST['id_editado']!=0){//se está editando una entrada
		$personaje->editar($_POST['id_editado'], $nombre, $apellidos, $nombre_familia, $gentilicio, $fecha_nacimiento, $fecha_fallecimiento, $causa_fallecimiento, $descripcion, $descripcionshort, $personalidad, $deseos, $miedos, $magia, $educacion, $historia, $religion, $familia, $politica, $especie, $sexo, $otros);
	
		$mensaje='success_edit';
	}else{//se va a añadir una entrada
		$ida=$personaje->lastId();
		$personaje->nuevoPersonaje($nombre, $apellidos, $nombre_familia, $gentilicio, $fecha_nacimiento, $fecha_fallecimiento, $causa_fallecimiento, $descripcion, $descripcionshort, $personalidad, $deseos, $miedos, $magia, $educacion, $historia, $religion, $familia, $politica, $retrato, $especie, $sexo, $otros);
		$idb=$personaje->lastId();
	
		if($ida!=$idb){
			$mensaje='success_create';
		}else{
			$mensaje='error';
		}
	}
	$json=array(
		'mensaje'=>$mensaje,
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

if ($_POST['funcion'] == 'buscar_personajes') {
	$json = array();
	$personaje->buscar();
	foreach ($personaje->objetos as $objeto) {
		$json[] = array(
			'id' => $objeto->id,
			'nombre' => $objeto->nombre,
			'apellidos' => $objeto->apellidos,
			'descripcionshort' => $objeto->descripcionshort,
			'retrato' => '../imagenes/Retratos/' . $objeto->retrato,
			'especie' => $objeto->nombreespecie,
			'sexo' => $objeto->sexo
		);
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

if ($_POST['funcion'] == 'buscar_personaje') {
	$json = array();
	$personaje->obtener_personaje($_POST['dato']);
	$nacimiento=$fallecimiento=$edad=null;
	$dnacimiento=$mnacimiento=$anacimiento=null;
	$dfallecimiento=$mfallecimiento=$afallecimiento=null;
	if($personaje->objetos[0]->nacimiento!=null){
		$fecha->getFecha($personaje->objetos[0]->nacimiento, "personajes");
		$dnacimiento=$fecha->objetos[0]->dia;
		$mnacimiento=$fecha->objetos[0]->mes;
		$anacimiento=$fecha->objetos[0]->anno;
		$nacimiento=implode("-",array($fecha->objetos[0]->dia, $fecha->getMes($fecha->objetos[0]->mes), $fecha->objetos[0]->anno));
	}
	if($personaje->objetos[0]->fallecimiento!=null){
		$fecha->getFecha($personaje->objetos[0]->fallecimiento, "personajes");
		$dfallecimiento=$fecha->objetos[0]->dia;
		$mfallecimiento=$fecha->objetos[0]->mes;
		$afallecimiento=$fecha->objetos[0]->anno;
		$fallecimiento=implode("-",array($fecha->objetos[0]->dia, $fecha->getMes($fecha->objetos[0]->mes), $fecha->objetos[0]->anno));
	}

	if(($nacimiento&&$fallecimiento)==null){
		//$edad=
	}
	$json[] = array(
		'id' => $personaje->objetos[0]->id,
		'id_especie' => $personaje->objetos[0]->id_foranea_especie,
		'nombreEspecie' => $personaje->objetos[0]->nombreespecie,
		'nombre' => $personaje->objetos[0]->nombre_personaje,
		'nombreFamilia' => $personaje->objetos[0]->nombrefamilia,
		'apellidos' => $personaje->objetos[0]->apellidos,
		//'lugarNacimiento'=>$objeto->lugar_nacimiento,
		'nacimiento' => $nacimiento,
		'id_nacimiento' => $personaje->objetos[0]->nacimiento,
		'dnacimiento' => $dnacimiento,
		'mnacimiento' => $mnacimiento,
		'anacimiento' => $anacimiento,
		'fallecimiento' => $fallecimiento,
		'id_fallecimiento' => $personaje->objetos[0]->fallecimiento,
		'dfallecimiento' => $dfallecimiento,
		'mfallecimiento' => $mfallecimiento,
		'afallecimiento' => $afallecimiento,
		'causa_fallecimiento' => $personaje->objetos[0]->causa_fallecimiento,
		'descripcion' => $personaje->objetos[0]->descripcion,
		'descripcionshort' => $personaje->objetos[0]->descripcionshort,
		'personalidad' => $personaje->objetos[0]->personalidad,
		'deseos' => $personaje->objetos[0]->deseos,
		'miedos' => $personaje->objetos[0]->miedos,
		'magia' => $personaje->objetos[0]->magia,
		'educacion' => $personaje->objetos[0]->educacion,
		'historia' => $personaje->objetos[0]->historia,
		'religion' => $personaje->objetos[0]->religion,
		'familia' => $personaje->objetos[0]->familia,
		'politica' => $personaje->objetos[0]->politica,
		'retrato' => '../imagenes/Retratos/' . $personaje->objetos[0]->retrato,
		'sexo' => $personaje->objetos[0]->sexo,
		'otros' => $personaje->objetos[0]->otros_personaje
	);
	
	$jsonstring = json_encode($json[0]);
	echo $jsonstring;
}

if ($_POST['funcion'] == 'borrar_personaje') {
	$mensaje='';
	$id_borrado = $_POST['id_personaje'];
  $personaje->idFechas($id_borrado);
	$fecha->borrarFecha($personaje->objetos[0]->nacimiento);
  $fecha->borrarFecha($personaje->objetos[0]->fallecimiento);
	$personaje->borrarPersonaje($id_borrado);
  if($personaje->obtener_personaje($id_borrado)){
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

if ($_POST['funcion'] == 'editar_personaje') {
	$nombre = $nombre_familia = $gentilicio = $apellidos = $fecha_nacimiento = $fecha_fallecimiento = $causa_fallecimiento = $descripcion = $descripcionshort = $personalidad = $deseos = $miedos = $magia = $historia = $religion = $familia = $politica = $especie = $sexo = $retrato = $otros = null;
	if (isset($_POST['nombre'])) {
		$nombre = $_POST['nombre'];}
	if (isset($_POST['nombre_familia'])) {
		$nombre_familia = $_POST['nombre_familia'];}
	if (isset($_POST['lugar_nacimiento'])) {
		$gentilicio = $_POST['lugar_nacimiento'];}
	if (isset($_POST['causa_fallecimiento'])) {
		$causa_fallecimiento = $_POST['causa_fallecimiento'];}
	if (isset($_POST['apellidos'])) {
		$apellidos = $_POST['apellidos'];}
	if (isset($_POST['descripcion'])) {
		$descripcion = $_POST['descripcion'];}
	if (isset($_POST['descripcionShort'])) {
		$descripcionshort = $_POST['descripcionShort'];}
	if (isset($_POST['personalidad'])) {
		$personalidad = $_POST['personalidad'];}
	if (isset($_POST['deseos'])) {
		$deseos = $_POST['deseos'];}
	if (isset($_POST['miedos'])) {
		$miedos = $_POST['miedos'];}
	if (isset($_POST['magia'])) {
		$magia = $_POST['magia'];}
	if (isset($_POST['educacion'])) {
		$educacion = $_POST['educacion'];}
	if (isset($_POST['historia'])) {
		$historia = $_POST['historia'];}
	if (isset($_POST['religion'])) {
		$religion = $_POST['religion'];}
	if (isset($_POST['familia'])) {
		$familia = $_POST['familia'];}
	if (isset($_POST['politica'])) {
		$politica = $_POST['politica'];}
	if (isset($_POST['especie'])) {
		$especie = $_POST['especie'];}
	if (isset($_POST['sexo'])) {
		$sexo = $_POST['sexo'];}
	if (isset($_POST['otros'])) {
		$otros = $_POST['otros'];}
	if (isset($_POST['id_editado'])) {
		$id_personaje = $_POST['id_editado'];}

	if ($_FILES['retrato']['size']) {
		if (($_FILES['retrato']['type'] == 'image/jpg') || ($_FILES['retrato']['type'] == 'image/jpeg') || ($_FILES['retrato']['type'] == 'image/png') || ($_FILES['retrato']['type'] == 'image/gif')) {
			$retrato_nombre = uniqid() . '-' . $_FILES['retrato']['name'];
			$ruta = '../imagenes/Retratos/' . $retrato_nombre;
			move_uploaded_file($_FILES['retrato']['tmp_name'], $ruta);
			$personaje->cambiar_retrato($_POST['id_personaje'], $retrato_nombre);
			foreach ($personaje->objetos as $objeto) {
				if ($objeto->retrato != 'default.png') {
					if (file_exists('../imagenes/Retratos/' . $objeto->retrato)) {
						unlink('../imagenes/Retratos/' . $objeto->retrato);
					}
				}
			}
		}
	}

	if (isset($_POST['anacimiento'])) {
		$anacimiento = $_POST['anacimiento'];
		$dnacimiento=0;
		$mnacimiento=0;
		if (isset($_POST['dnacimiento'])) {
			$dnacimiento = $_POST['dnacimiento'];}
		if (isset($_POST['mnacimiento'])) {
			$mnacimiento = $_POST['mnacimiento'];}
		if($_POST['id_nacimiento']==0){
			$fecha->addFecha($dnacimiento, $mnacimiento, $anacimiento, "personajes");
			$fecha->lastIdFechas();
			$fecha_nacimiento=$fecha->objetos[0]->id;
		}else{
			$fecha_nacimiento=$_POST['id_nacimiento'];
			$fecha->editFecha($_POST['id_nacimiento'], $dnacimiento, $mnacimiento, $anacimiento, "personajes");
		}
	}
	
	if (isset($_POST['afallecimiento'])) {
		$afallecimiento=$_POST['afallecimiento'];
		$dfallecimiento=0;
		$mfallecimiento=0;
		if (isset($_POST['dfallecimiento'])) {
			$dfallecimiento = $_POST['dfallecimiento'];}
		if (isset($_POST['mfallecimiento'])) {
			$mfallecimiento = $_POST['mfallecimiento'];}
		if($_POST['id_fallecimiento']==0){
			$fecha->addFecha($dfallecimiento, $mfallecimiento, $afallecimiento, "personajes");
			$fecha->lastIdFechas();
			$fecha_fallecimiento=$fecha->objetos[0]->id;
		}else{
			$fecha_fallecimiento=$_POST['id_fallecimiento'];
			$fecha->editFecha($_POST['id_fallecimiento'], $dfallecimiento, $mfallecimiento, $afallecimiento, "personajes");
		}
	}

	$personaje->editar($id_personaje, $nombre, $apellidos, $nombre_familia, $gentilicio, $fecha_nacimiento, $fecha_fallecimiento, $causa_fallecimiento, $descripcion, $descripcionshort, $personalidad, $deseos, $miedos, $magia, $educacion, $historia, $religion, $familia, $politica, $especie, $sexo, $otros);
	
	$mensaje='success_edit';
	
	$json=array(
		'mensaje'=>$mensaje,
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
}
