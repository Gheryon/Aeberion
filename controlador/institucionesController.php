<?php
include_once '../modelo/institucion.php';
include_once '../modelo/fechas.php';
$institucion = new Institucion();
$fecha = new Fecha();

if ($_POST['funcion'] == 'crear_nueva_institucion') {
	$nombre_institucion = $gentilicio = $descripcion_breve = $capital = $tipo = $fundacion = $disolucion = $lema = $historia = $politica_interior_exterior = $militar = $estructura_organizativa = $territorio = $fronteras = $demografia = $cultura = $educacion = $religion = $recursos_naturales = $economia = $tecnologia = $escudo = $otros=$id_ruler=$id_owner=null;

	if (isset($_POST['nombre_institucion'])) {
		$nombre_institucion = $_POST['nombre_institucion'];
		if(!$institucion->existeInstitucion($nombre_institucion)){
			if (isset($_POST['gentilicio'])) {
				$gentilicio = $_POST['gentilicio'];}
			if (isset($_POST['capital'])) {
				$capital = $_POST['capital'];}
			if (isset($_POST['tipo_select'])) {
				$tipo = $_POST['tipo_select'];}
			if (isset($_POST['owner'])) {
				$id_owner = $_POST['owner'];}
			if (isset($_POST['ruler'])) {
				$id_ruler = $_POST['ruler'];}
			if (isset($_POST['lema'])) {
				$lema = $_POST['lema'];}
			if (isset($_POST['descripcion_breve'])) {
				$descripcion_breve = $_POST['descripcion_breve'];}
			if (isset($_POST['historia'])) {
				$historia = $_POST['historia'];}
			if (isset($_POST['politica_interior_exterior'])) {
				$politica_interior_exterior = $_POST['politica_interior_exterior'];}
			if (isset($_POST['militar'])) {
				$militar = $_POST['militar'];}
			if (isset($_POST['estructura_organizativa'])) {
				$estructura_organizativa = $_POST['estructura_organizativa'];}
			if (isset($_POST['territorio'])) {
				$territorio = $_POST['territorio'];}
			if (isset($_POST['fronteras'])) {
				$fronteras = $_POST['fronteras'];}
			if (isset($_POST['demografia'])) {
				$demografia = $_POST['demografia'];}
			if (isset($_POST['cultura'])) {
				$cultura = $_POST['cultura'];}
			if (isset($_POST['religion'])) {
				$religion = $_POST['religion'];}
			if (isset($_POST['educacion'])) {
				$educacion = $_POST['educacion'];}
			if (isset($_POST['tecnologia'])) {
				$tecnologia = $_POST['tecnologia'];}
			if (isset($_POST['economia'])) {
				$economia = $_POST['economia'];}
			if (isset($_POST['recursos_naturales'])) {
				$recursos_naturales = $_POST['recursos_naturales'];}
			if (isset($_POST['otros'])) {
				$otros = $_POST['otros'];}
			if ($_FILES['escudo']['size']) {
				$nombre_escudo = uniqid() . '-' . $_FILES['escudo']['name'];
				$ruta_escudo = '../imagenes/Escudos/' . $nombre_escudo;
				move_uploaded_file($_FILES['escudo']['tmp_name'], $ruta_escudo);
			} else {
				$nombre_escudo = "default.png";
			}
		
			$fecha_fundacion=$fecha_disolucion=null;
			if (isset($_POST['afundacion'])) {
				$afundacion = $_POST['afundacion'];
				$dfundacion=0;
				$mfundacion=0;
				if (isset($_POST['dfundacion'])) {
					$dfundacion = $_POST['dfundacion'];}
				if (isset($_POST['mfundacion'])) {
					$mfundacion = $_POST['mfundacion'];}
				$fecha->addFecha($dfundacion, $mfundacion, $afundacion, "instituciones");
				$fecha->lastIdFechas();
				$fecha_fundacion=$fecha->objetos[0]->id;
			}
			
			if (isset($_POST['adisolucion'])) {
				$adisolucion=$_POST['adisolucion'];
				$ddisolucion=0;
				$mdisolucion=0;
				if (isset($_POST['ddisolucion'])) {
					$ddisolucion = $_POST['ddisolucion'];}
				if (isset($_POST['mdisolucion'])) {
					$mdisolucion = $_POST['mdisolucion'];}
				$fecha->addFecha($ddisolucion, $mdisolucion, $adisolucion, "instituciones");
				$fecha->lastIdFechas();
				$fecha_disolucion=$fecha->objetos[0]->id;
			}
			
			$ida=$institucion->lastId();
			$institucion->createInstitucion($nombre_institucion, $nombre_escudo, $gentilicio, $capital, $tipo, $fundacion, $disolucion, $lema, $descripcion_breve, $historia, $politica_interior_exterior, $militar, $estructura_organizativa, $territorio, $fronteras, $demografia, $cultura, $religion, $educacion, $tecnologia, $economia, $recursos_naturales, $otros, $id_ruler, $id_owner);
			$idb=$institucion->lastId();
			//si $ida!=$idb se ha añadido al sistema
			if($ida!=$idb){
				$mensaje='success';
			}else{
				$mensaje='error';
			}
		}else{//ya existe la institucion
			$mensaje='error_existencia';
		}
	}
	
	$json=array(
		'mensaje'=>$mensaje,
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

if ($_POST['funcion'] == 'buscar_instituciones') {
	$json = array();
	$institucion->buscar($_POST['tipo']);
	foreach ($institucion->objetos as $objeto) {
		$json[] = array(
			'id' => $objeto->id_organizacion,
			'nombre' => $objeto->nombre,
			'escudo' => '../imagenes/Escudos/' . $objeto->escudo,
			'descripcion' => $objeto->descripcionbreve,
			'tipo' => $objeto->tipo
		);
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

if ($_POST['funcion'] == 'ver_institucion') {
	$json = array();
	$institucion->buscarInstitucion($_POST['dato']);
	$fundacion=$dia_fundacion=$mes_fundacion=$anno_fundacion=null;
	$disolucion=$dia_disolucion=$mes_disolucion=$anno_disolucion=null;
	if($institucion->objetos[0]->fundacion!=null){
		$fecha->getFecha($institucion->objetos[0]->fundacion, "instituciones");
		$dia_fundacion=$fecha->objetos[0]->dia;
		$mes_fundacion=$fecha->objetos[0]->mes;
		$anno_fundacion=$fecha->objetos[0]->anno;
		$fundacion=implode("-",array($fecha->objetos[0]->dia, $fecha->getMes($fecha->objetos[0]->mes), $fecha->objetos[0]->anno));
	}
	if($institucion->objetos[0]->disolucion!=null){
		$fecha->getFecha($institucion->objetos[0]->disolucion, "instituciones");
		$dia_disolucion=$fecha->objetos[0]->dia;
		$mes_disolucion=$fecha->objetos[0]->mes;
		$anno_disolucion=$fecha->objetos[0]->anno;
		$disolucion=implode("-",array($fecha->objetos[0]->dia, $fecha->getMes($fecha->objetos[0]->mes), $fecha->objetos[0]->anno));
	}
	$json[] = array(
		'id' => $institucion->objetos[0]->id_organizacion,
		'nombre' => $institucion->objetos[0]->nombre,
		'gentilicio' => $institucion->objetos[0]->gentilicio,
		'capital' => $institucion->objetos[0]->capital,
		'escudo' => '../imagenes/Escudos/' . $institucion->objetos[0]->escudo,
		'descripcion' => $institucion->objetos[0]->descripcionbreve,
		'tipo' => $institucion->objetos[0]->tipo_org,
		'id_tipo' => $institucion->objetos[0]->id_tipo_organizacion,
		'lema' => $institucion->objetos[0]->lema,
		'id_ruler' => $institucion->objetos[0]->id_ruler,
		'ruler' => $institucion->objetos[0]->ruler,
		'id_owner' => $institucion->objetos[0]->id_owner,
		'owner' => $institucion->objetos[0]->padre,
		'demografia' => $institucion->objetos[0]->demografia,
		'id_fundacion' => $institucion->objetos[0]->fundacion,
		'fundacion' => $fundacion,
		'dia_fundacion' => $dia_fundacion,
		'mes_fundacion' => $mes_fundacion,
		'anno_fundacion' => $anno_fundacion,
		'id_disolucion' => $institucion->objetos[0]->disolucion,
		'disolucion' => $disolucion,
		'dia_disolucion' => $dia_disolucion,
		'mes_disolucion' => $mes_disolucion,
		'anno_disolucion' => $anno_disolucion,
		'historia' => $institucion->objetos[0]->historia,
		'estructura' => $institucion->objetos[0]->estructura,
		'politica' => $institucion->objetos[0]->politicaexteriorinterior,
		'frontera' => $institucion->objetos[0]->frontera,
		'militar' => $institucion->objetos[0]->militar,
		'religion' => $institucion->objetos[0]->religion,
		'cultura' => $institucion->objetos[0]->cultura,
		'educacion' => $institucion->objetos[0]->educacion,
		'tecnologia' => $institucion->objetos[0]->tecnologia,
		'territorio' => $institucion->objetos[0]->territorio,
		'economia' => $institucion->objetos[0]->economia,
		'recursos' => $institucion->objetos[0]->recursosnaturales,
		'otros' => $institucion->objetos[0]->otros
	);
	$jsonstring = json_encode($json[0]);
	echo $jsonstring;
}

if ($_POST['funcion'] == 'borrar_institucion') {
  $mensaje='';
	$id_borrado = $_POST['id_institucion'];
	$institucion->idFechas($id_borrado);
  $fecha->borrarFecha($institucion->objetos[0]->fundacion);
  $fecha->borrarFecha($institucion->objetos[0]->disolucion);
	$institucion->borrarInstitucion($id_borrado);
  if($institucion->buscarInstitucion($id_borrado)){
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

if ($_POST['funcion'] == 'editar_institucion') {
	$nombre_institucion = $gentilicio = $descripcion_breve = $capital = $tipo = $fundacion = $disolucion = $lema = $historia = $politica_interior_exterior = $militar = $estructura_organizativa = $territorio = $fronteras = $demografia = $cultura = $educacion = $religion = $recursos_naturales=$economia=$tecnologia=$escudo=$otros=$id_owner=$id_ruler=null;

	if (isset($_POST['nombre_institucion'])) {
		$nombre_institucion = $_POST['nombre_institucion'];}
	if (isset($_POST['gentilicio'])) {
		$gentilicio = $_POST['gentilicio'];}
	if (isset($_POST['capital'])) {
		$capital = $_POST['capital'];}
	if (isset($_POST['tipo_select'])) {
		$tipo = $_POST['tipo_select'];}
	if (isset($_POST['owner'])) {
		$id_owner = $_POST['owner'];}
	if (isset($_POST['ruler'])) {
		$id_ruler = $_POST['ruler'];}
	if (isset($_POST['lema'])) {
		$lema = $_POST['lema'];}
	if (isset($_POST['descripcion_breve'])) {
		$descripcion_breve = $_POST['descripcion_breve'];}
	if (isset($_POST['historia'])) {
		$historia = $_POST['historia'];}
	if (isset($_POST['politica_interior_exterior'])) {
		$politica_interior_exterior = $_POST['politica_interior_exterior'];}
	if (isset($_POST['militar'])) {
		$militar = $_POST['militar'];}
	if (isset($_POST['estructura_organizativa'])) {
		$estructura_organizativa = $_POST['estructura_organizativa'];}
	if (isset($_POST['territorio'])) {
		$territorio = $_POST['territorio'];}
	if (isset($_POST['fronteras'])) {
		$fronteras = $_POST['fronteras'];}
	if (isset($_POST['demografia'])) {
		$demografia = $_POST['demografia'];}
	if (isset($_POST['cultura'])) {
		$cultura = $_POST['cultura'];}
	if (isset($_POST['religion'])) {
		$religion = $_POST['religion'];}
	if (isset($_POST['educacion'])) {
		$educacion = $_POST['educacion'];}
	if (isset($_POST['tecnologia'])) {
		$tecnologia = $_POST['tecnologia'];}
	if (isset($_POST['economia'])) {
		$economia = $_POST['economia'];}
	if (isset($_POST['recursos_naturales'])) {
		$recursos_naturales = $_POST['recursos_naturales'];}
	if (isset($_POST['otros'])) {
		$otros = $_POST['otros'];}
	$id = $_POST['id_editado'];

	if ($_FILES['escudo']['size']) {
		$nombre_escudo = uniqid() . '-' . $_FILES['escudo']['name'];
		$ruta_escudo = '../imagenes/Escudos/' . $nombre_escudo;
		move_uploaded_file($_FILES['escudo']['tmp_name'], $ruta_escudo);
		$institucion->cambiar_escudo($_POST['id_editado'], $nombre_escudo);
		foreach ($institucion->objetos as $objeto) {
			if ($objeto->escudo != 'default.png') {
				unlink('../imagenes/Escudos/' . $objeto->escudo);
			}
		}
	}
	
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
			$fecha->addFecha($dfundacion, $mfundacion, $afundacion, "instituciones");
			$fecha->lastIdFechas();
			$fecha_fundacion=$fecha->objetos[0]->id;
		}else{
			$fecha_fundacion=$_POST['id_fundacion'];
			$fecha->editFecha($fecha_fundacion, $dfundacion, $mfundacion, $afundacion, "instituciones");
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

	$institucion->editarInstitucion($nombre_institucion, $gentilicio, $capital, $tipo, $fecha_fundacion, $fecha_disolucion, $lema, $descripcion_breve, $historia, $politica_interior_exterior, $militar, $estructura_organizativa, $territorio, $fronteras, $demografia, $cultura, $religion, $educacion, $tecnologia, $economia, $recursos_naturales, $otros, $id, $id_ruler, $id_owner);
		
	$mensaje='success_edit';
	
	$json=array(
		'mensaje'=>$mensaje,
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

if ($_POST['funcion'] == 'get_paises') {
	//se pasa 0 para que obtenga todos los países menos las religiones
	$institucion->buscar(0);
	$json = array();
	foreach ($institucion->objetos as $objeto) {
		$json[] = array(
			'id' => $objeto->id_organizacion,
			'nombre' => $objeto->nombre
		);
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

/////////////////especifico para religiones
if ($_POST['funcion'] == 'crear_nueva_religion') {
	$nombre = $gentilicio = $descripcion_breve = $capital = $tipo = $fundacion = $disolucion = $lema = $historia = $politica = $militar = $estructura_organizativa = $territorio = $fronteras = $demografia = $cultura = $educacion = $religion = $recursos_naturales = $economia = $tecnologia = $escudo = $otros = null;

	if (isset($_POST['nombre_religion'])) {
		$nombre = $_POST['nombre_religion'];
	}
	if (isset($_POST['tipo_religion'])) {
		$tipo = $_POST['tipo_religion'];
	}
	if (isset($_POST['fundacion'])) {
		$fundacion = $_POST['fundacion'];
	}
	if (isset($_POST['disolucion'])) {
		$disolucion = $_POST['disolucion'];
	}
	if (isset($_POST['lema'])) {
		$lema = $_POST['lema'];
	}
	if (isset($_POST['descripcion_breve'])) {
		$descripcion_breve = $_POST['descripcion_breve'];
	}
	if (isset($_POST['historia'])) {
		$historia = $_POST['historia'];
	}
	if (isset($_POST['politica'])) {
		$politica = $_POST['politica'];
	}
	if (isset($_POST['cosmologia'])) {
		$militar = $_POST['cosmologia'];
	}
	if (isset($_POST['estructura_organizativa'])) {
		$estructura_organizativa = $_POST['estructura_organizativa'];
	}
	if (isset($_POST['doctrina'])) {
		$territorio = $_POST['doctrina'];
	}
	if (isset($_POST['deidades'])) {
		$fronteras = $_POST['deidades'];
	}
	if (isset($_POST['elementos_sagrados'])) {
		$demografia = $_POST['elementos_sagrados'];
	}
	if (isset($_POST['cultura'])) {
		$cultura = $_POST['cultura'];
	}
	if (isset($_POST['sectas'])) {
		$religion = $_POST['sectas'];
	}
	if (isset($_POST['otros'])) {
		$otros = $_POST['otros'];
	}
	if ($_FILES['escudo']['size']) {
		$nombre_escudo = uniqid() . '-' . $_FILES['escudo']['name'];
		$ruta_escudo = '../imagenes/Escudos/' . $nombre_escudo;
		move_uploaded_file($_FILES['escudo']['tmp_name'], $ruta_escudo);
	} else {
		$nombre_escudo = "default.png";
	}

	$institucion->createInstitucion($nombre, $nombre_escudo, $gentilicio, $capital, $tipo, $fundacion, $disolucion, $lema, $descripcion_breve, $historia, $politica, $militar, $estructura_organizativa, $territorio, $fronteras, $demografia, $cultura, $religion, $educacion, $tecnologia, $economia, $recursos_naturales, $otros, $id_ruler, $id_owner);
}

if ($_POST['funcion'] == 'editar_religion') {
	$nombre = $gentilicio = $descripcion_breve = $capital = $tipo = $fundacion = $disolucion = $lema = $historia = $politica = $militar = $estructura_organizativa = $territorio = $fronteras = $demografia = $cultura = $educacion = $religion = $recursos_naturales = $economia = $tecnologia = $escudo = $otros = null;

	if (isset($_POST['nombre_religion'])) {
		$nombre = $_POST['nombre_religion'];
	}
	if (isset($_POST['tipo_religion'])) {
		$tipo = $_POST['tipo_religion'];
	}
	if (isset($_POST['fundacion'])) {
		$fundacion = $_POST['fundacion'];
	}
	if (isset($_POST['disolucion'])) {
		$disolucion = $_POST['disolucion'];
	}
	if (isset($_POST['lema'])) {
		$lema = $_POST['lema'];
	}
	if (isset($_POST['descripcion_breve'])) {
		$descripcion_breve = $_POST['descripcion_breve'];
	}
	if (isset($_POST['historia'])) {
		$historia = $_POST['historia'];
	}
	if (isset($_POST['politica'])) {
		$politica = $_POST['politica'];
	}
	if (isset($_POST['cosmologia'])) {
		$militar = $_POST['cosmologia'];
	}
	if (isset($_POST['estructura_organizativa'])) {
		$estructura_organizativa = $_POST['estructura_organizativa'];
	}
	if (isset($_POST['doctrina'])) {
		$territorio = $_POST['doctrina'];
	}
	if (isset($_POST['deidades'])) {
		$fronteras = $_POST['deidades'];
	}
	if (isset($_POST['elementos_sagrados'])) {
		$demografia = $_POST['elementos_sagrados'];
	}
	if (isset($_POST['cultura'])) {
		$cultura = $_POST['cultura'];
	}
	if (isset($_POST['sectas'])) {
		$religion = $_POST['sectas'];
	}
	if (isset($_POST['otros'])) {
		$otros = $_POST['otros'];
	}
	$id = $_POST['id_editado'];

	if ($_FILES['escudo']['size']) {
		$nombre_escudo = uniqid() . '-' . $_FILES['escudo']['name'];
		$ruta_escudo = '../imagenes/Escudos/' . $nombre_escudo;
		move_uploaded_file($_FILES['escudo']['tmp_name'], $ruta_escudo);
		$institucion->cambiar_escudo($_POST['id_editado'], $nombre_escudo);
		foreach ($institucion->objetos as $objeto) {
			if ($objeto->escudo != 'default.png') {
				unlink('../imagenes/Escudos/' . $objeto->escudo);
			}
		}
	}

	$institucion->editarInstitucion($nombre, $gentilicio, $capital, $tipo, $fundacion, $disolucion, $lema, $descripcion_breve, $historia, $politica, $militar, $estructura_organizativa, $territorio, $fronteras, $demografia, $cultura, $religion, $educacion, $tecnologia, $economia, $recursos_naturales, $otros, $id, $id_ruler, $id_owner);
	echo 'editado';
}

if ($_POST['funcion'] == 'ver_religion') {
	$json = array();
	$institucion->buscarInstitucion($_POST['dato']);
	foreach ($institucion->objetos as $objeto) {
		$json[] = array(
			'id' => $objeto->id_organizacion,
			'nombre' => $objeto->nombre,
			'escudo' => '../imagenes/Escudos/' . $objeto->escudo,
			'descripcion' => $objeto->descripcionbreve,
			'lema' => $objeto->lema,
			'elementos_sagrados' => $objeto->demografia,
			'fundacion' => $objeto->fundacion,
			'disolucion' => $objeto->disolucion,
			'historia' => $objeto->historia,
			'estructura' => $objeto->estructura,
			'politica' => $objeto->politicaexteriorinterior,
			'deidades' => $objeto->frontera,
			'cosmologia' => $objeto->militar,
			'sectas' => $objeto->religion,
			'cultura' => $objeto->cultura,
			'doctrina' => $objeto->territorio,
			'otros' => $objeto->otros
		);
	}
	$jsonstring = json_encode($json[0]);
	echo $jsonstring;
}

if ($_POST['funcion'] == 'menu_religiones') {
	$institucion->menu_religiones();
	$json = array();
	foreach ($institucion->objetos as $objeto) {
		$json[] = array(
			'id' => $objeto->id_organizacion,
			'nombre' => $objeto->nombre
		);
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
}