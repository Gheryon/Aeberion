<?php
include_once 'conexionDB.php';
date_default_timezone_set('Europe/Madrid');
//la fecha actual del mundo es el 27-7-320
$date=mktime(0, 0, 0, 27, 7, 320);
$fecha_mundo=date('d-m-Y', $date);
class Fecha{
	var $objetos;
  var $meses=array("Semana año nuevo", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}
  
	function addFecha($dia, $mes, $anno, $tabla){
    $sql="INSERT INTO fechas(dia, mes, anno, tabla) VALUES (:dia, :mes, :anno, :tabla);";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':dia'=>$dia, ':mes'=>$mes, ':anno'=>$anno,':tabla'=>$tabla));
  }

  function getFecha($id, $tabla){
    $sql="SELECT * FROM fechas WHERE id=:id AND tabla=:tabla";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id, ':tabla'=>$tabla));
    $this->objetos=$query->fetchAll();
    return $this->objetos;
  }

  function editFecha($id, $dia, $mes, $anno, $tabla){
    $sql="UPDATE fechas SET dia=:dia, mes=:mes, anno=:anno WHERE id=:id AND tabla=:tabla;";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':dia'=>$dia, ':mes'=>$mes, ':anno'=>$anno,':id'=>$id,':tabla'=>$tabla));
  }

  function getMes($id){
    return $this->meses[$id];
  }

	function lastIdFechas(){
    $sql="SELECT MAX(id) as id FROM fechas";
    $query=$this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchAll();
    return $this->objetos;
  }

  function borrarFecha($id){
    $sql="DELETE FROM fechas WHERE id=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
  }
}
?>