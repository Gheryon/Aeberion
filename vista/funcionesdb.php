<?php
class Database{
    private static $dbName = 'db_aeberion'; 
    private static $dbHost = 'localhost';
    private static $dbUsername = 'Gheryon';
    private static $dbUserPassword = 'zewion';

    private static $cont = null;

public function __construct() {
  //Conectar con la base de datos
	$this->dbc = $this->connect();
//die('Init-Función no permitida');
}

public static function connect() {
// Permitir solo una conexión para la totalidad del acceso
if ( null == self::$cont )
{
  try
  {
    self::$cont = new PDO( "mysql:host=".self::$dbHost.";port=3306;"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
  }
  catch(PDOException $e)
  {
    die($e->getMessage());
  }
} 
return self::$cont;
}

public static function disconnect()
{
  self::$cont = null;
}

/*
  Funciones CRUD para eventos
*/
public function getAllEventos($orden)
{
  $eventos=array();

  $sentence=$this->dbc->prepare("SELECT * FROM timelines ORDER BY anno $orden");
  if($sentence->execute())
  {
    while($row=$sentence->fetch())
    {
      $eventos[]=$row;
    }
  }
  return $eventos;
}

public function getEventos($lineaTemporal, $orden)
{
  $eventos=array();

  $sentence=$this->dbc->prepare("SELECT * FROM timelines WHERE lineaTemporal = ? OR lineaTemporal = 'Universal' ORDER BY anno $orden");
  if($sentence->execute(array($lineaTemporal)))
  {
    while($row=$sentence->fetch())
    {
      $eventos[]=$row;
    }
  }
  return $eventos;
}

public function getEvento($id)
{
	$evento=null;

	$sentence=$this->dbc->prepare("SELECT * FROM timelines WHERE id = ?");
	if($sentence->execute(array($id)))
	{
		while($row=$sentence->fetch())
		{
			$evento=$row;
		}
	}
	return $evento;
}

public function deleteEvento($id)
{
  $sentence=$this->dbc->prepare("DELETE FROM timelines WHERE id=?");
  if($sentence->execute(array($id)))
  {
    return true;
  }
  else
  {
    return false;
  }
  return true;
}

public function updateEvento($id, $nombreEvento, $dia, $mes, $anno, $descripcion, $lineaTemporal)
{
	$sentence=$this->dbc->prepare("UPDATE timelines SET nombreEvento=?, dia=?, mes=?, anno=?, descripcion=?, lineaTemporal=? WHERE id=?");
	if($sentence->execute(array($nombreEvento, $dia, $mes, $anno, $descripcion, $lineaTemporal, $id)))
	{
		return true;
	}
	else
	{
		return false;
	}
}

/*
  Funciones CRUD para personajes
*/
public function addPersonaje($Nombre, $Apellidos, $Descripcion, $Personalidad, $Deseos, $Miedos, $Historia, $Religion, $Familia, $Politica, $Retrato, $Especie, $Sexo)
{
  $sentence=$this->dbc->prepare("INSERT INTO personaje (Nombre, Apellidos, Descripcion, Personalidad, Deseos, Miedos, Historia, Religion, Familia, Politica, Retrato, Especie, Sexo) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	if($sentence->execute(array($Nombre, $Apellidos, $Descripcion, $Personalidad, $Deseos, $Miedos, $Historia, $Religion, $Familia, $Politica, $Retrato, $Especie, $Sexo)))
	{
		return false;
	}
	else
	{
		return true;
	}
}

public function getPersonaje($id)
{
  $personaje=null;

	$sentence=$this->dbc->prepare("SELECT * FROM personaje WHERE id = ?");
	if($sentence->execute(array($id)))
	{
		while($row=$sentence->fetch())
		{
			$personaje=$row;
		}
	}
	return $personaje;
}

public function updatePersonaje()
{

}

public function removePersonaje()
{

}
}