<?php
include_once '../modelo/lugar.php';
$lugar=new Lugar();

if($_POST['funcion']=='crear_nuevo_lugar'){
    $nombre=$_POST['nombre'];
    $descripcion=$_POST['descripcion'];
    $otros_nombres=$_POST['otros_nombres'];
    $geografia=$_POST['geografia'];
    $tipo=$_POST['tipo'];
    $ecosistema=$_POST['ecosistema'];
    $clima=$_POST['clima'];
    $flora_fauna=$_POST['flora_fauna'];
    $recursos=$_POST['recursos'];
    $historia=$_POST['historia'];
    $otros=$_POST['otros'];

    $lugar->createLugar($nombre, $descripcion, $otros_nombres, $geografia, $tipo, $ecosistema, $clima, $flora_fauna, $recursos, $historia, $otros);
}

if($_POST['funcion']=='borrar_lugar'){
    $id_borrado=$_POST['id_lugar'];
    $lugar->borrarLugar($id_borrado);
}

if($_POST['funcion']=='buscar_lugares'){
    $json=array();
    $lugar->buscar();
    foreach ($lugar->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_geografia,
            'nombre'=>$objeto->nombre_lugar,
            'descripcion'=>$objeto->descripcion_breve,
            'tipo'=>$objeto->tipo,
            'otros_nombres'=>$objeto->otros_nombres,
            'geografia'=>$objeto->geografia,
            'ecosistema'=>$objeto->ecosistema,
            'clima'=>$objeto->clima,
            'flora_fauna'=>$objeto->flora_fauna,
            'recursos'=>$objeto->recursos,
            'historia'=>$objeto->historia,
            'otros'=>$objeto->otros
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='buscar_lugar'){
    $json=array();
    $lugar->obtener_lugar($_POST['dato']);
    foreach ($lugar->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_geografia,
            'nombre'=>$objeto->nombre_lugar,
            'descripcion'=>$objeto->descripcion_breve,
            'tipo'=>$objeto->tipo,
            'otros_nombres'=>$objeto->otros_nombres,
            'geografia'=>$objeto->geografia,
            'ecosistema'=>$objeto->ecosistema,
            'clima'=>$objeto->clima,
            'flora_fauna'=>$objeto->flora_fauna,
            'recursos'=>$objeto->recursos,
            'historia'=>$objeto->historia,
            'otros'=>$objeto->otros
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion']=='editar_lugar'){
    $nombre=$descripcion=$otros_nombres=$geografia=$tipo=$ecosistema=$clima=$flora_fauna=$recursos=$historia=$otros=null;
    if(isset($_POST['nombre'])) {
        $nombre=$_POST['nombre'];}
    if(isset($_POST['descripcion'])) {
        $descripcion=$_POST['descripcion'];}
    if(isset($_POST['otros_nombres'])) {
        $otros_nombres=$_POST['otros_nombres'];}
    if(isset($_POST['geografia'])) {
        $geografia=$_POST['geografia'];}
    if(isset($_POST['tipo'])) {
        $tipo=$_POST['tipo'];}
    if(isset($_POST['ecosistema'])) {
        $ecosistema=$_POST['ecosistema'];}
    if(isset($_POST['clima'])) {
        $clima=$_POST['clima'];}
    if(isset($_POST['flora_fauna'])) {
        $flora_fauna=$_POST['flora_fauna'];}
    if(isset($_POST['recursos'])) {
        $recursos=$_POST['recursos'];}
    if(isset($_POST['historia'])) {
        $historia=$_POST['historia'];}
    if(isset($_POST['otros'])) {
        $otros=$_POST['otros'];}
    if(isset($_POST['id_lugar'])) {
        $id_lugar=$_POST['id_lugar'];}
    
    $lugar->editarLugar($id_lugar, $nombre, $descripcion, $otros_nombres, $geografia, $tipo, $ecosistema, $clima, $flora_fauna, $recursos, $historia, $otros);
    echo 'editado';
}

?>