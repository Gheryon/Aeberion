<?php
include_once '../modelo/institucion.php';
$institucion=new Institucion();

if($_POST['funcion']=='crear_nueva_institucion'){
    $nombre_institucion=$_POST['nombre'];
    $gentilicio=$_POST['gentilicio'];
    $capital=$_POST['capital'];
    $tipo=$_POST['tipo'];
    $fundacion=$_POST['fundacion'];
    $disolucion=$_POST['disolucion'];
    $lema=$_POST['lema'];
    $descripcion_breve=$_POST['descripcion'];
    $historia=$_POST['historia'];
    $politica_interior_exterior=$_POST['politica_interior_exterior'];
    $militar=$_POST['militar'];
    $estructura_organizativa=$_POST['estructura_organizativa'];
    $territorio=$_POST['territorio'];
    $fronteras=$_POST['fronteras'];
    $demografia=$_POST['demografia'];
    $cultura=$_POST['cultura'];
    $religion=$_POST['religion'];
    $educacion=$_POST['educacion'];
    $tecnologia=$_POST['tecnologia'];
    $economia=$_POST['economia'];
    $recursos_naturales=$_POST['recursos_naturales'];
    $otros=$_POST['otros'];
    $escudo="default.png";
    
    $institucion->createInstitucion($nombre_institucion, $escudo, $gentilicio, $capital, $tipo, $fundacion, $disolucion, $lema, $descripcion_breve, $historia, $politica_interior_exterior, $militar, $estructura_organizativa, $territorio, $fronteras, $demografia, $cultura, $religion, $educacion, $tecnologia, $economia, $recursos_naturales, $otros);
}

if($_POST['funcion']=='buscar_instituciones'){
    $json=array();
    $institucion->buscar();
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
  $id_borrado=$_POST['id_lugar'];
  $lugar->borrarLugar($id_borrado);
}

if($_POST['funcion']=='editar_institucion'){
    $nombre_institucion=$gentilicio=$descripcion_breve=$capital=$tipo=$fundacion=$disolucion=$lema=$historia=$politica_interior_exterior=$militar=$estructura_organizativa=$territorio=$fronteras=$demografia=$cultura=$educacion=$religion=$recursos_naturales=$economia=$tecnologia=$escudo=$otros=null;

    if(isset($_POST['nombre'])) {
        $nombre_institucion=$_POST['nombre'];}
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
    if(isset($_POST['descripcion'])) {
        $descripcion_breve=$_POST['descripcion'];}
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
    $id=$_POST['id_institucion_editar'];
    $escudo=$_POST['escudo'];
    
    $institucion->editarInstitucion($nombre_institucion, $escudo, $gentilicio, $capital, $tipo, $fundacion, $disolucion, $lema, $descripcion_breve, $historia, $politica_interior_exterior, $militar, $estructura_organizativa, $territorio, $fronteras, $demografia, $cultura, $religion, $educacion, $tecnologia, $economia, $recursos_naturales, $otros, $id);
    echo 'editado';
}

?>