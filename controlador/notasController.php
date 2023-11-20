<?php
$nombres=array("nombres_m"=>"../util/nombres_m.txt", "nombres_f"=>"../util/nombres_f.txt",
"nombres_l"=>"../util/nombres_l.txt",
"nombres_s"=>"../util/nombres_s.txt",
"nombres_o"=>"../util/nombres_o.txt",
"lemas"=>"../util/lemas.txt");
$enlaces=array("enlaces_g"=>"../util/enlaces_g.txt", "enlaces_c"=>"../util/enlaces_c.txt",
"enlaces_r"=>"../util/enlaces_r.txt");

/******************Para notasNombres.php******************/
if($_POST['funcion']=='buscar-nombres'){
	$json=array();

  foreach ($nombres as $clave => $file) {
    $myfile = fopen($file, "r") or die("Unable to open file!");
    $contenido=fread($myfile,filesize($file));
    fclose($myfile);
    $json[]=array(
      $clave=>$contenido
    );
  }

	$jsonstring = json_encode($json);
	echo $jsonstring;
}

if($_POST['funcion']=='add-name'){
  $tipo=$_POST['tipo'];
  $nombre=$_POST['nombre'];
  $mensaje='error_file';

  //$nombres[$tipo]-> devuelve el nombre del archivo guardado en el array $nombres
  $myfile = fopen($nombres[$tipo], "r") or die("Unable to open file!");
  $contenido=fread($myfile,filesize($nombres[$tipo]));
  fclose($myfile);

  //se añade el nombre nuevo y se reordena la lista de nombres
  $json=array();
  if($tipo!='lemas'){
    $json=explode(', ', $contenido);
    array_push($json, $nombre);
    sort($json);
    $contenido=implode(", ", $json);
  }else{
    $json=explode('\n ', $contenido);
    array_push($json, $nombre);
    sort($json);
    $contenido=implode("\n ", $json);
  }
  
  $myfile = fopen($nombres[$tipo], "w") or die("Unable to open file!");
  fwrite($myfile,$contenido);
  fclose($myfile);

  $mensaje='add';

  $json=array(
		'mensaje'=>$mensaje,
	);
  $jsonstring = json_encode($json);
	echo $jsonstring;
}

if($_POST['funcion']=='edit-names'){
  $tipo=$_POST['tipo'];
  $lista=$_POST['lista'];
  $mensaje='error_file';

  //se reordena la lista de nombres
  $json=array();
  if($tipo!='lemas'){
    $json=explode(', ', $lista);
    sort($json);
    $lista=implode(", ", $json);
  }else{
    $json=explode('\n ', $lista);
    sort($json);
    $lista=implode("\n ", $json);
  }

  $myfile = fopen($nombres[$tipo], "w") or die("Unable to open file!");
  fwrite($myfile,$lista);
  fclose($myfile);
  $mensaje='edit';

  $json=array(
		'mensaje'=>$mensaje,
	);

  $jsonstring = json_encode($json);
	echo $jsonstring;
}

if($_POST['funcion']=='buscar-file'){
	$json=array();
  
  $file=$nombres[$_POST['tipo']];
  $myfile = fopen($file, "r") or die("Unable to open file!");
  $contenido=fread($myfile,filesize($file));
  fclose($myfile);
  $json[]=array(
    'lista'=>$contenido
  );

	$jsonstring = json_encode($json);
	echo $jsonstring;
}

/******************Para enlaces.php******************/
if($_POST['funcion']=='buscar-enlaces'){
  $links=array();
  $json=array();
  foreach ($enlaces as $clave => $file) {
    $json2=array();
    $myfile = fopen($file, "r") or die("Unable to open file!");
    $contenido=fread($myfile,filesize($file));
    fclose($myfile);
    $links=explode(';', $contenido);
    foreach($links as $enlace){
      $link=explode(',', $enlace);
      $json2[]=array(
        'nombre'=>$link[1],
        'link'=>$link[0]
      );
    };
    $json[]=array(
      $clave=>$json2
    );
  }
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

if($_POST['funcion']=='add-link'){
  $tipo=$_POST['tipo'];
  $nombre=$_POST['nombre'];
  $url=$_POST['url'];
  $mensaje='error_file';

  //$enlaces[$tipo]-> devuelve el nombre del archivo guardado en el array $enlaces
  $myfile = fopen($enlaces[$tipo], "r") or die("Unable to open file!");
  $contenido=fread($myfile,filesize($enlaces[$tipo]));
  fclose($myfile);

  $linknuevo=$url.','.$nombre;
  //se añade el link nuevo y se reordena la lista de enlaces
  $json=array();
  $json=explode(';', $contenido);
  array_push($json, $linknuevo);
  sort($json);
  $contenido=implode(";", $json);
  
  $myfile = fopen($enlaces[$tipo], "w") or die("Unable to open file!");
  fwrite($myfile,$contenido);
  fclose($myfile);

  $mensaje='add';

  $json=array(
		'mensaje'=>$mensaje,
	);
  $jsonstring = json_encode($json);
	echo $jsonstring;
}
?>