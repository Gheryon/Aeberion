<?php
include '../modelo/articulo.php';

$articulo=new Articulo();

if($_POST['funcion']=='crear')
{
    $nombre = $_POST['nombre_articulo'];
    $contenido = $_POST['contenido_articulo'];
    $tipo = $_POST['tipo'];
    $articulo->crear($nombre, $contenido, $tipo);
}

if($_POST['funcion']=='editar')
{
    $nombre = $_POST['nombre_articulo'];
    $contenido = $_POST['contenido_articulo'];
    $id_editado = $_POST['id_editado'];
    $tipo = $_POST['tipo'];
    $articulo->editar($nombre, $contenido, $tipo, $id_editado);
}

if($_POST['funcion']=='buscar')
{
    $articulo->buscar();
    $json=array();
    foreach ($articulo->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_articulo,
            'nombre'=>$objeto->nombre,
            'contenido'=>$objeto->contenido,
            'tipo'=>$objeto->tipo
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='buscar-cronicas')
{
    $articulo->buscarCronicas();
    $json=array();
    foreach ($articulo->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_articulo,
            'nombre'=>$objeto->nombre,
            'contenido'=>$objeto->contenido,
            'tipo'=>$objeto->tipo
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='detalles')
{
    $json=array();
    $articulo->buscarArticulo($_POST['id']);
    foreach ($articulo->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_articulo,
            'nombre'=>$objeto->nombre,
            'contenido'=>$objeto->contenido,
            'tipo'=>$objeto->tipo
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $articulo->borrar($id);
}
?>