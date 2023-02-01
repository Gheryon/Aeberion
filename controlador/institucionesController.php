<?php
include_once '../modelo/institucion.php';
$institucion=new Institucion();

if($_POST['funcion']=='crear_nueva_institucion'){
    $nombre_institucion=$gentilicio=$descripcion_breve=$capital=$tipo=$fundacion=$disolucion=$lema=$historia=$politica_interior_exterior=$militar=$estructura_organizativa=$territorio=$fronteras=$demografia=$cultura=$educacion=$religion=$recursos_naturales=$economia=$tecnologia=$escudo=$otros=null;

    if(isset($_POST['nombre_institucion'])) {
        $nombre_institucion=$_POST['nombre_institucion'];}
    if(isset($_POST['gentilicio'])) {
        $gentilicio=$_POST['gentilicio'];}
    if(isset($_POST['capital'])) {
        $capital=$_POST['capital'];}
    if(isset($_POST['tipo'])) {
        $tipo=$_POST['tipo'];}
    if(isset($_POST['fundacion'])) {
        $fundacion=$_POST['fundacion'];}
    if(isset($_POST['disolucion'])) {
        $disolucion=$_POST['disolucion'];}
    if(isset($_POST['lema'])) {
        $lema=$_POST['lema'];}
    if(isset($_POST['descripcion_breve'])) {
        $descripcion_breve=$_POST['descripcion_breve'];}
    if(isset($_POST['historia'])) {
        $historia=$_POST['historia'];}
    if(isset($_POST['politica_interior_exterior'])) {
        $politica_interior_exterior=$_POST['politica_interior_exterior'];}
    if(isset($_POST['militar'])) {
        $militar=$_POST['militar'];}
    if(isset($_POST['estructura_organizativa'])) {
        $estructura_organizativa=$_POST['estructura_organizativa'];}
    if(isset($_POST['territorio'])) {
        $territorio=$_POST['territorio'];}
    if(isset($_POST['fronteras'])) {
        $fronteras=$_POST['fronteras'];}
    if(isset($_POST['demografia'])) {
        $demografia=$_POST['demografia'];}
    if(isset($_POST['cultura'])) {
        $cultura=$_POST['cultura'];}
    if(isset($_POST['religion'])) {
        $religion=$_POST['religion'];}
    if(isset($_POST['educacion'])) {
        $educacion=$_POST['educacion'];}
    if(isset($_POST['tecnologia'])) {
        $tecnologia=$_POST['tecnologia'];}
    if(isset($_POST['economia'])) {
        $economia=$_POST['economia'];}
    if(isset($_POST['recursos_naturales'])) {
        $recursos_naturales=$_POST['recursos_naturales'];}
    if(isset($_POST['otros'])) {
        $otros=$_POST['otros'];}
    if($_FILES['escudo']['size']){
        $nombre_escudo=uniqid().'-'.$_FILES['escudo']['name'];
        $ruta_escudo='../imagenes/Escudos/'.$nombre_escudo;
        move_uploaded_file($_FILES['escudo']['tmp_name'],$ruta_escudo);
    }else{
        $nombre_escudo="default.png";
    }
    
    $institucion->createInstitucion($nombre_institucion, $nombre_escudo, $gentilicio, $capital, $tipo, $fundacion, $disolucion, $lema, $descripcion_breve, $historia, $politica_interior_exterior, $militar, $estructura_organizativa, $territorio, $fronteras, $demografia, $cultura, $religion, $educacion, $tecnologia, $economia, $recursos_naturales, $otros);
}

if($_POST['funcion']=='buscar_instituciones'){
    $json=array();
    $institucion->buscar($_POST['tipo_institucion']);
    foreach ($institucion->objetos as $objeto) {
			$json[]=array(
				'id'=>$objeto->id_organizacion,
				'nombre'=>$objeto->nombre,
				'escudo'=>'../imagenes/Escudos/'.$objeto->escudo,
				'descripcion'=>$objeto->descripcionbreve,
				'tipo'=>$objeto->tipo,
				'lema'=>$objeto->lema,
				'fundacion'=>$objeto->fundacion,
				'disolucion'=>$objeto->disolucion
			);
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='ver_institucion'){
	$json=array();
	$institucion->buscarInstitucion($_POST['dato']);
	foreach ($institucion->objetos as $objeto) {
		$json[]=array(
			'id'=>$objeto->id_organizacion,
			'nombre'=>$objeto->nombre,
			'gentilicio'=>$objeto->gentilicio,
			'capital'=>$objeto->capital,
			'escudo'=>'../imagenes/Escudos/'.$objeto->escudo,
			'descripcion'=>$objeto->descripcionbreve,
			'tipo'=>$objeto->tipo,
			'lema'=>$objeto->lema,
			'demografia'=>$objeto->demografia,
			'fundacion'=>$objeto->fundacion,
			'disolucion'=>$objeto->disolucion,
			'historia'=>$objeto->historia,
			'estructura'=>$objeto->estructura,
			'politica'=>$objeto->politicaexteriorinterior,
			'frontera'=>$objeto->frontera,
			'militar'=>$objeto->militar,
			'religion'=>$objeto->religion,
			'cultura'=>$objeto->cultura,
			'educacion'=>$objeto->educacion,
			'tecnologia'=>$objeto->tecnologia,
			'territorio'=>$objeto->territorio,
			'economia'=>$objeto->economia,
			'recursos'=>$objeto->recursosnaturales,
			'otros'=>$objeto->otros
		);
	}
	$jsonstring=json_encode($json[0]);
	echo $jsonstring;
}

if($_POST['funcion']=='borrar_institucion'){
  $id_borrado=$_POST['id_institucion'];
  $institucion->borrarInstitucion($id_borrado);
}

if($_POST['funcion']=='editar_institucion'){
    $nombre_institucion=$gentilicio=$descripcion_breve=$capital=$tipo=$fundacion=$disolucion=$lema=$historia=$politica_interior_exterior=$militar=$estructura_organizativa=$territorio=$fronteras=$demografia=$cultura=$educacion=$religion=$recursos_naturales=$economia=$tecnologia=$escudo=$otros=null;

    if(isset($_POST['nombre_institucion'])) {
        $nombre_institucion=$_POST['nombre_institucion'];}
    if(isset($_POST['gentilicio'])) {
        $gentilicio=$_POST['gentilicio'];}
    if(isset($_POST['capital'])) {
        $capital=$_POST['capital'];}
    if(isset($_POST['tipo'])) {
        $tipo=$_POST['tipo'];}
    if(isset($_POST['fundacion'])) {
        $fundacion=$_POST['fundacion'];}
    if(isset($_POST['disolucion'])) {
        $disolucion=$_POST['disolucion'];}
    if(isset($_POST['lema'])) {
        $lema=$_POST['lema'];}
    if(isset($_POST['descripcion_breve'])) {
        $descripcion_breve=$_POST['descripcion_breve'];}
    if(isset($_POST['historia'])) {
        $historia=$_POST['historia'];}
    if(isset($_POST['politica_interior_exterior'])) {
        $politica_interior_exterior=$_POST['politica_interior_exterior'];}
    if(isset($_POST['militar'])) {
        $militar=$_POST['militar'];}
    if(isset($_POST['estructura_organizativa'])) {
        $estructura_organizativa=$_POST['estructura_organizativa'];}
    if(isset($_POST['territorio'])) {
        $territorio=$_POST['territorio'];}
    if(isset($_POST['fronteras'])) {
        $fronteras=$_POST['fronteras'];}
    if(isset($_POST['demografia'])) {
        $demografia=$_POST['demografia'];}
    if(isset($_POST['cultura'])) {
        $cultura=$_POST['cultura'];}
    if(isset($_POST['religion'])) {
        $religion=$_POST['religion'];}
    if(isset($_POST['educacion'])) {
        $educacion=$_POST['educacion'];}
    if(isset($_POST['tecnologia'])) {
        $tecnologia=$_POST['tecnologia'];}
    if(isset($_POST['economia'])) {
        $economia=$_POST['economia'];}
    if(isset($_POST['recursos_naturales'])) {
        $recursos_naturales=$_POST['recursos_naturales'];}
    if(isset($_POST['otros'])) {
        $otros=$_POST['otros'];}
    $id=$_POST['id_editado'];

    if($_FILES['escudo']['size']){
        $nombre_escudo=uniqid().'-'.$_FILES['escudo']['name'];
        $ruta_escudo='../imagenes/Escudos/'.$nombre_escudo;
        move_uploaded_file($_FILES['escudo']['tmp_name'],$ruta_escudo);
        $institucion->cambiar_escudo($_POST['id_editado'], $nombre_escudo);
        foreach ($institucion->objetos as $objeto) {
            if($objeto->escudo!='default.png'){
                unlink('../imagenes/Escudos/'.$objeto->escudo);
            }
        }
    }
    
    $institucion->editarInstitucion($nombre_institucion, $gentilicio, $capital, $tipo, $fundacion, $disolucion, $lema, $descripcion_breve, $historia, $politica_interior_exterior, $militar, $estructura_organizativa, $territorio, $fronteras, $demografia, $cultura, $religion, $educacion, $tecnologia, $economia, $recursos_naturales, $otros, $id);
    echo 'editado';
}

/////////////////especifico para religiones
if($_POST['funcion']=='crear_nueva_religion'){
	$nombre=$gentilicio=$descripcion_breve=$capital=$tipo=$fundacion=$disolucion=$lema=$historia=$politica=$militar=$estructura_organizativa=$territorio=$fronteras=$demografia=$cultura=$educacion=$religion=$recursos_naturales=$economia=$tecnologia=$escudo=$otros=null;

	if(isset($_POST['nombre_religion'])) {
		$nombre=$_POST['nombre_religion'];}
	if(isset($_POST['tipo_religion'])) {
		$tipo=$_POST['tipo_religion'];}
	if(isset($_POST['fundacion'])) {
		$fundacion=$_POST['fundacion'];}
	if(isset($_POST['disolucion'])) {
		$disolucion=$_POST['disolucion'];}
	if(isset($_POST['lema'])) {
		$lema=$_POST['lema'];}
	if(isset($_POST['descripcion_breve'])) {
		$descripcion_breve=$_POST['descripcion_breve'];}
	if(isset($_POST['historia'])) {
		$historia=$_POST['historia'];}
	if(isset($_POST['politica'])) {
		$politica=$_POST['politica'];}
	if(isset($_POST['cosmologia'])) {
		$militar=$_POST['cosmologia'];}
	if(isset($_POST['estructura_organizativa'])) {
		$estructura_organizativa=$_POST['estructura_organizativa'];}
	if(isset($_POST['doctrina'])) {
		$territorio=$_POST['doctrina'];}
	if(isset($_POST['deidades'])) {
		$fronteras=$_POST['deidades'];}
	if(isset($_POST['elementos_sagrados'])) {
		$demografia=$_POST['elementos_sagrados'];}
	if(isset($_POST['cultura'])) {
		$cultura=$_POST['cultura'];}
	if(isset($_POST['sectas'])) {
		$religion=$_POST['sectas'];}
	if(isset($_POST['otros'])) {
		$otros=$_POST['otros'];}
	if($_FILES['escudo']['size']){
		$nombre_escudo=uniqid().'-'.$_FILES['escudo']['name'];
		$ruta_escudo='../imagenes/Escudos/'.$nombre_escudo;
		move_uploaded_file($_FILES['escudo']['tmp_name'],$ruta_escudo);
	}else{
		$nombre_escudo="default.png";
	}
	
	$institucion->createInstitucion($nombre, $nombre_escudo, $gentilicio, $capital, $tipo, $fundacion, $disolucion, $lema, $descripcion_breve, $historia, $politica, $militar, $estructura_organizativa, $territorio, $fronteras, $demografia, $cultura, $religion, $educacion, $tecnologia, $economia, $recursos_naturales, $otros);
}

if($_POST['funcion']=='editar_religion'){
	$nombre=$gentilicio=$descripcion_breve=$capital=$tipo=$fundacion=$disolucion=$lema=$historia=$politica=$militar=$estructura_organizativa=$territorio=$fronteras=$demografia=$cultura=$educacion=$religion=$recursos_naturales=$economia=$tecnologia=$escudo=$otros=null;

	if(isset($_POST['nombre_religion'])) {
		$nombre=$_POST['nombre_religion'];}
	if(isset($_POST['tipo_religion'])) {
		$tipo=$_POST['tipo_religion'];}
	if(isset($_POST['fundacion'])) {
		$fundacion=$_POST['fundacion'];}
	if(isset($_POST['disolucion'])) {
		$disolucion=$_POST['disolucion'];}
	if(isset($_POST['lema'])) {
		$lema=$_POST['lema'];}
	if(isset($_POST['descripcion_breve'])) {
		$descripcion_breve=$_POST['descripcion_breve'];}
	if(isset($_POST['historia'])) {
		$historia=$_POST['historia'];}
	if(isset($_POST['politica'])) {
		$politica=$_POST['politica'];}
	if(isset($_POST['cosmologia'])) {
		$militar=$_POST['cosmologia'];}
	if(isset($_POST['estructura_organizativa'])) {
		$estructura_organizativa=$_POST['estructura_organizativa'];}
	if(isset($_POST['doctrina'])) {
		$territorio=$_POST['doctrina'];}
	if(isset($_POST['deidades'])) {
		$fronteras=$_POST['deidades'];}
	if(isset($_POST['elementos_sagrados'])) {
		$demografia=$_POST['elementos_sagrados'];}
	if(isset($_POST['cultura'])) {
		$cultura=$_POST['cultura'];}
	if(isset($_POST['sectas'])) {
		$religion=$_POST['sectas'];}
	if(isset($_POST['otros'])) {
		$otros=$_POST['otros'];}
	$id=$_POST['id_editado'];

	if($_FILES['escudo']['size']){
		$nombre_escudo=uniqid().'-'.$_FILES['escudo']['name'];
		$ruta_escudo='../imagenes/Escudos/'.$nombre_escudo;
		move_uploaded_file($_FILES['escudo']['tmp_name'],$ruta_escudo);
		$institucion->cambiar_escudo($_POST['id_editado'], $nombre_escudo);
		foreach ($institucion->objetos as $objeto) {
			if($objeto->escudo!='default.png'){
				unlink('../imagenes/Escudos/'.$objeto->escudo);
			}
		}
	}
	
	$institucion->editarInstitucion($nombre, $gentilicio, $capital, $tipo, $fundacion, $disolucion, $lema, $descripcion_breve, $historia, $politica, $militar, $estructura_organizativa, $territorio, $fronteras, $demografia, $cultura, $religion, $educacion, $tecnologia, $economia, $recursos_naturales, $otros, $id);
	echo 'editado';
}

if($_POST['funcion']=='ver_religion'){
	$json=array();
	$institucion->buscarInstitucion($_POST['dato']);
	foreach ($institucion->objetos as $objeto) {
		$json[]=array(
			'id'=>$objeto->id_organizacion,
			'nombre'=>$objeto->nombre,
			'escudo'=>'../imagenes/Escudos/'.$objeto->escudo,
			'descripcion'=>$objeto->descripcionbreve,
			'tipo'=>$objeto->tipo,
			'lema'=>$objeto->lema,
			'elementos_sagrados'=>$objeto->demografia,
			'fundacion'=>$objeto->fundacion,
			'disolucion'=>$objeto->disolucion,
			'historia'=>$objeto->historia,
			'estructura'=>$objeto->estructura,
			'politica'=>$objeto->politicaexteriorinterior,
			'deidades'=>$objeto->frontera,
			'cosmologia'=>$objeto->militar,
			'sectas'=>$objeto->religion,
			'cultura'=>$objeto->cultura,
			'doctrina'=>$objeto->territorio,
			'otros'=>$objeto->otros
		);
	}
	$jsonstring=json_encode($json[0]);
	echo $jsonstring;
}

if($_POST['funcion']=='menu_religiones'){
	$institucion->menu_religiones();
	$json = array();
	foreach ($institucion->objetos as $objeto) {
		$json[]=array(
			'id'=>$objeto->id_organizacion,
			'nombre'=>$objeto->nombre
		);
	}
	$jsonstring=json_encode($json);
	echo $jsonstring;
}
?>