<?php
include_once '../modelo/personaje.php';
$personaje=new Personaje();
if($_POST['funcion']=='crear_nuevo_personaje'){
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $descripcion=$_POST['descripcion'];
    $descripcionshort=$_POST['descripcionShort'];
    $personalidad=$_POST['personalidad'];
    $deseos=$_POST['deseos'];
    $miedos=$_POST['miedos'];
    $magia=$_POST['magia'];
    $historia=$_POST['historia'];
    $religion=$_POST['religion'];
    $familia=$_POST['familia'];
    $politica=$_POST['politica'];
    //$retrato=$_POST['retrato'];
    $especie=$_POST['especie'];
    $sexo=$_POST['sexo'];

    $retrato='default.png';
    $personaje->nuevoPersonaje($nombre, $apellidos, $descripcion, $descripcionshort, $personalidad, $deseos, $miedos, $magia, $historia, $religion, $familia, $politica, $retrato, $especie, $sexo);
}

if($_POST['funcion']=='buscar_personajes'){
    $json=array();
    //$fecha_actual=new DateTime();
    $personaje->buscar();
    foreach ($personaje->objetos as $objeto) {
        //$nacimiento=new DateTime($objeto->edad);
        //$edad=$nacimiento->diff($fecha_actual);
        $json[]=array(
            'id'=>$objeto->id,
            'nombre'=>$objeto->nombre,
            'apellidos'=>$objeto->apellidos,
            'descripcion'=>$objeto->descripcion,
            'descripcionshort'=>$objeto->descripcionshort,
            'personalidad'=>$objeto->personalidad,
            'deseos'=>$objeto->deseos,
            'miedos'=>$objeto->miedos,
            'magia'=>$objeto->magia,
            'historia'=>$objeto->historia,
            'religion'=>$objeto->religion,
            'familia'=>$objeto->familia,
            'politica'=>$objeto->politica,
            'retrato'=>'../imagenes/Retratos/'.$objeto->retrato,
            'especie'=>$objeto->especie,
            'sexo'=>$objeto->sexo
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='buscar_personaje'){
    $json=array();
    //$fecha_actual=new DateTime();
    $personaje->obtener_personaje($_POST['dato']);
    foreach ($personaje->objetos as $objeto) {
        //$nacimiento=new DateTime($objeto->edad);
        //$edad=$nacimiento->diff($fecha_actual);
        $json[]=array(
            'id'=>$objeto->id,
            'nombre'=>$objeto->nombre,
            'apellidos'=>$objeto->apellidos,
            'descripcion'=>$objeto->descripcion,
            'descripcionshort'=>$objeto->descripcionshort,
            'personalidad'=>$objeto->personalidad,
            'deseos'=>$objeto->deseos,
            'miedos'=>$objeto->miedos,
            'magia'=>$objeto->magia,
            'historia'=>$objeto->historia,
            'religion'=>$objeto->religion,
            'familia'=>$objeto->familia,
            'politica'=>$objeto->politica,
            'retrato'=>'../imagenes/Retratos/'.$objeto->retrato,
            'especie'=>$objeto->especie,
            'sexo'=>$objeto->sexo
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion']=='borrar_personaje'){
    $id_borrado=$_POST['id_personaje'];
    $personaje->borrarPersonaje($id_borrado);
}

if($_POST['funcion']=='editar_personaje'){
    $Descripcion=$Personalidad=$Deseos=$Miedos=$Historia=$Religion=$Familia=$Politica=$Retrato=$Especie=$Sexo=null;
    if(isset($_POST['nombre'])) {
    $nombre=$_POST['nombre'];}
    if(isset($_POST['apellidos'])) {
    $apellidos=$_POST['apellidos'];}
    if(isset($_POST['descripcion'])) {
    $descripcion=$_POST['descripcion'];}
    if(isset($_POST['descripcionShort'])) {
    $descripcionshort=$_POST['descripcionShort'];}
    if(isset($_POST['personalidad'])) {
    $personalidad=$_POST['personalidad'];}
    if(isset($_POST['deseos'])) {
    $deseos=$_POST['deseos'];}
    if(isset($_POST['miedos'])) {
    $miedos=$_POST['miedos'];}
    if(isset($_POST['magia'])) {
    $magia=$_POST['magia'];}
    if(isset($_POST['historia'])) {
    $historia=$_POST['historia'];}
    if(isset($_POST['religion'])) {
    $religion=$_POST['religion'];}
    if(isset($_POST['familia'])) {
    $familia=$_POST['familia'];}
    if(isset($_POST['politica'])) {
    $politica=$_POST['politica'];}
    //if(isset($_POST['retrato'])) {
    //$retrato=$_POST['retrato'];}
    if(isset($_POST['especie'])) {
    $especie=$_POST['especie'];}
    if(isset($_POST['sexo'])) {
    $sexo=$_POST['sexo'];}
    if(isset($_POST['id_personaje'])) {
    $id_personaje=$_POST['id_personaje'];}
    $personaje->editar($id_personaje, $nombre, $apellidos, $descripcion, $descripcionshort, $personalidad, $deseos, $miedos, $magia, $historia, $religion, $familia, $politica, $especie, $sexo);
    echo 'editado';
}


if($_POST['funcion']=='cambiar_retrato'){
    if(($_FILES['retrato']['type']=='image/jpg')||($_FILES['retrato']['type']=='image/jpeg')||($_FILES['retrato']['type']=='image/png')||($_FILES['retrato']['type']=='image/gif'))
    {
        $nombre=uniqid().'-'.$_FILES['retrato']['name'];
        $ruta='../imagenes/Retratos/'.$nombre;
        move_uploaded_file($_FILES['retrato']['tmp_name'],$ruta);
        $personaje->cambiar_retrato($_POST['id_personaje'], $nombre);
        foreach ($personaje->objetos as $objeto) {
            if($objeto->retrato!='default.png'){
                if(file_exists('../imagenes/Retratos/'.$objeto->retrato)){
                    unlink('../imagenes/Retratos/'.$objeto->retrato);
                }
            }
        }
        $json=array();
        $json[]=array(
            'ruta'=>$ruta,
            'alert'=>'edit'
        );
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }else{
        $json=array();
        $json[]=array(
            'alert'=>'noedit'
        );
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
}
?>