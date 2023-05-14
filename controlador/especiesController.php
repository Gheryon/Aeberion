<?php
include_once '../modelo/especie.php';
$especie = new Especie();

if ($_POST['funcion'] == 'menu_especies') {
	$especie->obtener_especies();
	$json = array();
	foreach ($especie->objetos as $objeto) {
		$json[] = array(
			'id' => $objeto->id_especie,
			'nombre' => $objeto->nombre
		);
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

else if ($_POST['funcion'] == 'buscar_especie') {
	$json = array();
	$especie->obtener_especie($_POST['dato']);
	foreach ($especie->objetos as $objeto) {
		$json[] = array(
			'nombre' => $objeto->nombre,
			'vida' => $objeto->edad,
			'altura' => $objeto->altura,
			'peso' => $objeto->peso,
			'longitud' => $objeto->longitud,
			'estatus' => $objeto->estatus,
			'anatomia' => $objeto->anatomia,
			'alimentacion' => $objeto->alimentacion,
			'reproduccion' => $objeto->reproduccion,
			'distribucion' => $objeto->distribucion,
			'habilidades' => $objeto->habilidades,
			'domesticacion' => $objeto->domesticacion,
			'explotacion' => $objeto->explotacion,
			'otros' => $objeto->otros,
			'id_especie' => $objeto->id_especie,
			'imagen' => '../img/especies/' . $objeto->imagen
		);
	}
	$jsonstring = json_encode($json[0]);
	echo $jsonstring;
}

else if ($_POST['funcion'] == 'editar_especie') {
	$mensaje='';
	if (isset($_POST['id_especie_editar'])) {
		$id_especie = $_POST['id_especie_editar'];
		$nombre = $edad = $peso = $altura = $longitud = $estatus = $anatomia = $alimentacion = $reproduccion = $distribucion = $habilidades = $domesticacion = $explotacion = $otros = null;
		if(isset($_POST['nombre'])) {
			$nombre = $_POST['nombre'];
		}
		if(isset($_POST['vida'])) {
			$edad = $_POST['vida'];
		}
		if(isset($_POST['pesoEspecie'])) {
			$peso = $_POST['pesoEspecie'];
		}
		if(isset($_POST['alturaEspecie'])) {
			$altura = $_POST['alturaEspecie'];
		}
		if(isset($_POST['longitudEspecie'])) {
			$longitud = $_POST['longitudEspecie'];
		}
		if(isset($_POST['estatus'])) {
			$estatus = $_POST['estatus'];
		}
		if(isset($_POST['anatomia'])) {
			$anatomia = $_POST['anatomia'];
		}
		if(isset($_POST['alimentacion'])) {
			$alimentacion = $_POST['alimentacion'];
		}
		if(isset($_POST['reproduccion'])) {
			$reproduccion = $_POST['reproduccion'];
		}
		if(isset($_POST['distribucion'])) {
			$distribucion = $_POST['distribucion'];
		}
		if(isset($_POST['habilidades'])) {
			$habilidades = $_POST['habilidades'];
		}
		if(isset($_POST['domesticacion'])) {
			$domesticacion = $_POST['domesticacion'];
		}
		if(isset($_POST['explotacion'])) {
			$explotacion = $_POST['explotacion'];
		}
		if(isset($_POST['otros'])) {
			$otros = $_POST['otros'];
		}
		$especie->editarEspecie($id_especie, $nombre, $edad, $peso, $altura, $longitud, $estatus, $anatomia, $alimentacion, $reproduccion, $distribucion, $habilidades, $domesticacion, $explotacion, $otros);
		$mensaje='success';
	}else{
		$mensaje='error';
	}
	$json=array(
		'mensaje'=>$mensaje,
	);
	$jsonstring=json_encode($json);
	echo $jsonstring;
}

else if ($_POST['funcion'] == 'crear_nueva_especie') {
	$nombre = $_POST['nombre'];
	$edad = $_POST['edad'];
	$altura = $_POST['altura'];
	$longitud = $_POST['longitud'];
	$peso = $_POST['peso'];
	$estatus = $_POST['estatus'];
	$anatomia = $_POST['anatomia'];
	$alimentacion = $_POST['alimentacion'];
	$reproduccion = $_POST['reproduccion'];
	$distribucion = $_POST['distribucion'];
	$habilidades = $_POST['habilidades'];
	$domesticacion = $_POST['domesticacion'];
	$explotacion = $_POST['explotacion'];
	$otros = $_POST['otros'];

	$imagen = 'default.png';
	$especie->createEspecie($nombre, $edad, $peso, $altura, $longitud, $estatus, $anatomia, $alimentacion, $reproduccion, $distribucion, $habilidades, $domesticacion, $explotacion, $otros, $imagen);
}

else if ($_POST['funcion'] == 'borrar_especie') {
	$id_borrado = $_POST['id'];
	$especie->borrarEspecie($id_borrado);
	$mensaje='';
	$especie->obtener_especie($id_borrado);
	if (!empty($especie->objetos)) {
		$mensaje='error';
	} else {
		$mensaje='success';
	}
	$json=array(
		'mensaje'=>$mensaje,
	);
	$jsonstring=json_encode($json);
	echo $jsonstring;
}

if ($_POST['funcion'] == 'cambiar_retrato') {
	if (($_FILES['retrato']['type'] == 'image/jpg') || ($_FILES['retrato']['type'] == 'image/jpeg') || ($_FILES['retrato']['type'] == 'image/png') || ($_FILES['retrato']['type'] == 'image/gif')) {
		$nombre = uniqid() . '-' . $_FILES['retrato']['name'];
		$ruta = '../imagenes/Retratos/' . $nombre;
		move_uploaded_file($_FILES['retrato']['tmp_name'], $ruta);
		$personaje->cambiar_retrato($_POST['id_personaje'], $nombre);
		foreach ($personaje->objetos as $objeto) {
			unlink('../imagenes/Retratos/' . $objeto->retrato);
		}
		$json = array();
		$json[] = array(
			'ruta' => $ruta,
			'alert' => 'edit'
		);
		$jsonstring = json_encode($json[0]);
		echo $jsonstring;
	} else {
		$json = array();
		$json[] = array(
			'alert' => 'noedit'
		);
		$jsonstring = json_encode($json[0]);
		echo $jsonstring;
	}
}
