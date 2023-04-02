<?php
include_once '../modelo/personaje.php';
$personaje = new Personaje();

if ($_POST['funcion'] == 'crear_nuevo_personaje') {
	$nombre = $nombre_familia = $gentilicio = $apellidos = $descripcion = $descripcionshort = $personalidad = $deseos = $miedos = $magia = $historia = $religion = $familia = $politica = $especie = $sexo = null;
	if (isset($_POST['nombre'])) {
		$nombre = $_POST['nombre'];
	}
	if (isset($_POST['nombre_familia'])) {
		$nombre_familia = $_POST['nombre_familia'];
	}
	if (isset($_POST['lugar_nacimiento'])) {
		$gentilicio = $_POST['lugar_nacimiento'];
	}
	if (isset($_POST['apellidos'])) {
		$apellidos = $_POST['apellidos'];
	}
	if (isset($_POST['descripcion'])) {
		$descripcion = $_POST['descripcion'];
	}
	if (isset($_POST['descripcionShort'])) {
		$descripcionshort = $_POST['descripcionShort'];
	}
	if (isset($_POST['personalidad'])) {
		$personalidad = $_POST['personalidad'];
	}
	if (isset($_POST['deseos'])) {
		$deseos = $_POST['deseos'];
	}
	if (isset($_POST['miedos'])) {
		$miedos = $_POST['miedos'];
	}
	if (isset($_POST['magia'])) {
		$magia = $_POST['magia'];
	}
	if (isset($_POST['educacion'])) {
		$educacion = $_POST['educacion'];
	}
	if (isset($_POST['historia'])) {
		$historia = $_POST['historia'];
	}
	if (isset($_POST['religion'])) {
		$religion = $_POST['religion'];
	}
	if (isset($_POST['familia'])) {
		$familia = $_POST['familia'];
	}
	if (isset($_POST['politica'])) {
		$politica = $_POST['politica'];
	}
	if (isset($_POST['especie'])) {
		$especie = $_POST['especie'];
	}
	if (isset($_POST['sexo'])) {
		$sexo = $_POST['sexo'];
	}
	if (isset($_POST['otros'])) {
		$otros = $_POST['otros'];
	}

	if ($_FILES['retrato']['size']) {
		$retrato = uniqid() . '-' . $_FILES['retrato']['name'];
		$ruta_retrato = '../imagenes/Retratos/' . $retrato;
		move_uploaded_file($_FILES['retrato']['tmp_name'], $ruta_retrato);
	} else {
		$retrato = "default.png";
	}

	$personaje->nuevoPersonaje($nombre, $apellidos, $nombre_familia, $gentilicio, $descripcion, $descripcionshort, $personalidad, $deseos, $miedos, $magia, $educacion, $historia, $religion, $familia, $politica, $retrato, $especie, $sexo, $otros);
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
	//$fecha_actual=new DateTime();
	$personaje->obtener_personaje($_POST['dato']);
	foreach ($personaje->objetos as $objeto) {
		//$nacimiento=new DateTime($objeto->edad);
		//$edad=$nacimiento->diff($fecha_actual);
		$json[] = array(
			'id' => $objeto->id,
			'id_especie' => $objeto->id_foranea_especie,
			'nombreEspecie' => $objeto->nombreespecie,
			'nombre' => $objeto->nombre_personaje,
			'nombreFamilia' => $objeto->nombrefamilia,
			'apellidos' => $objeto->apellidos,
			//'lugarNacimiento'=>$objeto->lugar_nacimiento,
			'descripcion' => $objeto->descripcion,
			'descripcionshort' => $objeto->descripcionshort,
			'personalidad' => $objeto->personalidad,
			'deseos' => $objeto->deseos,
			'miedos' => $objeto->miedos,
			'magia' => $objeto->magia,
			'educacion' => $objeto->educacion,
			'historia' => $objeto->historia,
			'religion' => $objeto->religion,
			'familia' => $objeto->familia,
			'politica' => $objeto->politica,
			'retrato' => '../imagenes/Retratos/' . $objeto->retrato,
			'sexo' => $objeto->sexo,
			'otros' => $objeto->otros_personaje
		);
	}
	$jsonstring = json_encode($json[0]);
	echo $jsonstring;
}

if ($_POST['funcion'] == 'borrar_personaje') {
	$id_borrado = $_POST['id_personaje'];
	$personaje->borrarPersonaje($id_borrado);
}

if ($_POST['funcion'] == 'editar_personaje') {
	$nombre = $nombre_familia = $gentilicio = $apellidos = $descripcion = $descripcionshort = $personalidad = $deseos = $miedos = $magia = $historia = $religion = $familia = $politica = $especie = $sexo = $retrato = $otros = null;
	if (isset($_POST['nombre'])) {
		$nombre = $_POST['nombre'];
	}
	if (isset($_POST['nombre_familia'])) {
		$nombre_familia = $_POST['nombre_familia'];
	}
	if (isset($_POST['lugar_nacimiento'])) {
		$gentilicio = $_POST['lugar_nacimiento'];
	}
	if (isset($_POST['apellidos'])) {
		$apellidos = $_POST['apellidos'];
	}
	if (isset($_POST['descripcion'])) {
		$descripcion = $_POST['descripcion'];
	}
	if (isset($_POST['descripcionShort'])) {
		$descripcionshort = $_POST['descripcionShort'];
	}
	if (isset($_POST['personalidad'])) {
		$personalidad = $_POST['personalidad'];
	}
	if (isset($_POST['deseos'])) {
		$deseos = $_POST['deseos'];
	}
	if (isset($_POST['miedos'])) {
		$miedos = $_POST['miedos'];
	}
	if (isset($_POST['magia'])) {
		$magia = $_POST['magia'];
	}
	if (isset($_POST['educacion'])) {
		$educacion = $_POST['educacion'];
	}
	if (isset($_POST['historia'])) {
		$historia = $_POST['historia'];
	}
	if (isset($_POST['religion'])) {
		$religion = $_POST['religion'];
	}
	if (isset($_POST['familia'])) {
		$familia = $_POST['familia'];
	}
	if (isset($_POST['politica'])) {
		$politica = $_POST['politica'];
	}
	if (isset($_POST['especies_select'])) {
		$especie = $_POST['especies_select'];
	}
	if (isset($_POST['sexo'])) {
		$sexo = $_POST['sexo'];
	}
	if (isset($_POST['otros'])) {
		$otros = $_POST['otros'];
	}
	if (isset($_POST['id_personaje'])) {
		$id_personaje = $_POST['id_personaje'];
	}

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

	$personaje->editar($id_personaje, $nombre, $apellidos, $nombre_familia, $gentilicio, $descripcion, $descripcionshort, $personalidad, $deseos, $miedos, $magia, $educacion, $historia, $religion, $familia, $politica, $especie, $sexo, $otros);
	echo 'editado';
}
