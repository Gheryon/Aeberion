<?php
include_once '../modelo/especie.php';
$especie=new Especie();

if($_POST['funcion']=='crear_nueva_especie'){
    $nombre=$_POST['nombre'];
    $edad=$_POST['edad'];
    $altura=$_POST['altura'];
    $longitud=$_POST['longitud'];
    $peso=$_POST['peso'];
    $estatus=$_POST['estatus'];
    $anatomia=$_POST['anatomia'];
    $alimentacion=$_POST['alimentacion'];
    $reproduccion=$_POST['reproduccion'];
    $distribucion=$_POST['distribucion'];
    $habilidades=$_POST['habilidades'];
    $domesticacion=$_POST['domesticacion'];
    $explotacion=$_POST['explotacion'];
    $otros=$_POST['otros'];

    $imagen='default.png';
    $especie->createEspecie($nombre, $edad, $peso, $altura, $longitud, $estatus, $anatomia, $alimentacion, $reproduccion, $distribucion, $habilidades, $domesticacion, $explotacion, $otros, $imagen);
}

if($_POST['funcion']=='borrar_especie'){
    $id_borrado=$_POST['id_especie'];
    $especie->borrarEspecie($id_borrado);
}

if($_POST['funcion']=='editar_personaje'){
    $Descripcion=$Personalidad=$Deseos=$Miedos=$Historia=$Religion=$Familia=$Politica=$Retrato=$Especie=$Sexo=null;
    if(isset($_POST['nombre'])) {
    $nombre=$_POST['nombre'];}
    if(isset($_POST['apellidos'])) {
    $apellidos=$_POST['apellidos'];}
    if(isset($_POST['descripcion'])) {
    $descripcion=$_POST['descripcion'];}
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
    $personaje->editar($id_personaje, $nombre, $apellidos, $descripcion, $personalidad, $deseos, $miedos, $magia, $historia, $religion, $familia, $politica, $especie, $sexo);
    echo 'editado';
}

if($_POST['funcion']=='buscar_especie'){
    $json=array();
    $especie->obtener_especie($_POST['dato']);
    foreach ($especie->objetos as $objeto) {
        $json[]=array(
            'nombre'=>$objeto->nombre,
            'vida'=>$objeto->edad,
            'altura'=>$objeto->altura,
            'peso'=>$objeto->peso,
            'longitud'=>$objeto->longitud,
            'estatus'=>$objeto->estatus,
            'anatomia'=>$objeto->anatomia,
            'alimentacion'=>$objeto->alimentacion,
            'reproduccion'=>$objeto->reproduccion,
            'distribucion'=>$objeto->distribucion,
            'habilidades'=>$objeto->habilidades,
            'domesticacion'=>$objeto->domesticacion,
            'explotacion'=>$objeto->explotacion,
            'otros'=>$objeto->otros,
            'imagen'=>'../img/especies/'.$objeto->imagen
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion']=='menu_especies'){
    $especie->obtener_especies();
    $json = array();
    foreach ($especie->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_especie,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='cambiar_retrato'){
    if(($_FILES['retrato']['type']=='image/jpg')||($_FILES['retrato']['type']=='image/jpeg')||($_FILES['retrato']['type']=='image/png')||($_FILES['retrato']['type']=='image/gif'))
    {
        $nombre=uniqid().'-'.$_FILES['retrato']['name'];
        $ruta='../imagenes/Retratos/'.$nombre;
        move_uploaded_file($_FILES['retrato']['tmp_name'],$ruta);
        $personaje->cambiar_retrato($_POST['id_personaje'], $nombre);
        foreach ($personaje->objetos as $objeto) {
            unlink('../imagenes/Retratos/'.$objeto->retrato);
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