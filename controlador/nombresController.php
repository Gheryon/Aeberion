<?php
$nombres=array("nombres_m"=>"../util/nombres_m.txt", "nombres_f"=>"../util/nombres_f.txt",
"nombres_l"=>"../util/nombres_l.txt",
"nombres_t"=>"../util/nombres_t.txt",
"nombres_s"=>"../util/nombres_s.txt",
"nombres_o"=>"../util/nombres_o.txt",
"lemas"=>"../util/lemas.txt");

if($_POST['funcion']=='buscar'){
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

  //$nombres[$tipo]-> devuelve el nombre del archivo guardado en el array $nombres
  $myfile = fopen($nombres[$tipo], "r") or die("Unable to open file!");
  $contenido=fread($myfile,filesize($nombres[$tipo]));
  fclose($myfile);
  //echo $contenido;

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
  echo $contenido;
  $myfile = fopen($nombres[$tipo], "w") or die("Unable to open file!");
  fwrite($myfile,$contenido);
  fclose($myfile);
  //$jsonstring = json_encode($json);
	//echo $jsonstring;
}
?>