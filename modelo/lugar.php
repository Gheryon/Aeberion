<?php
include_once 'conexionDB.php';

class Lugar
{
	var $objetos;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function createLugar($nombre, $descripcion, $otros_nombres, $geografia, $tipo, $ecosistema, $clima, $flora_fauna, $recursos, $historia, $otros)	{
		//se busca si ya existe la entrada
		$sql = "SELECT id_geografia FROM lugares WHERE nombre=:nombre";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':nombre' => $nombre));
		$this->objetos = $query->fetchAll();
		//si ya existe la entrada, no se añade
		if (!empty($this->objetos)) {
			echo "noadd";
		} else {
			$sql = "INSERT INTO lugares(nombre, descripcion_breve, id_tipo_lugar, otros_nombres, geografia, ecosistema, clima, flora_fauna, recursos, historia, otros) VALUES (:nombre, :descripcion, :tipo, :otros_nombres, :geografia, :ecosistema, :clima, :flora_fauna, :recursos, :historia, :otros);";
			$query = $this->acceso->prepare($sql);
			$query->execute(array(':nombre' => $nombre, ':descripcion' => $descripcion, ':tipo' => $tipo, ':otros_nombres' => $otros_nombres, ':geografia' => $geografia, ':ecosistema' => $ecosistema, ':clima' => $clima, ':flora_fauna' => $flora_fauna, ':recursos' => $recursos, ':historia' => $historia, ':otros' => $otros));
			echo "add";
		}
	}

	function buscar()	{
		//se ha introducido algún caracter a buscar, se devuelven los usuarios que encagen con la consulta
		if (!empty($_POST['consulta'])) {
			$consulta = $_POST['consulta'];
			$sql = "SELECT tipo_lugar.nombre as tipo, lugares.nombre, lugares.descripcion_breve, lugares.id_geografia FROM lugares JOIN tipo_lugar ON id_tipo_lugar=tipo_lugar.id WHERE lugares.nombre LIKE :consulta";
			$query = $this->acceso->prepare($sql);
			$query->execute(array(':consulta' => "%$consulta%"));
			$this->objetos = $query->fetchAll();
			return $this->objetos;
		} else {
			//se devuelven todos los usuarios
			$sql = "SELECT tipo_lugar.nombre as tipo, lugares.nombre, lugares.descripcion_breve, lugares.id_geografia FROM lugares JOIN tipo_lugar ON id_tipo_lugar=tipo_lugar.id WHERE lugares.nombre NOT LIKE '' ORDER BY lugares.nombre";
			$query = $this->acceso->prepare($sql);
			$query->execute();
			$this->objetos = $query->fetchAll();
			return $this->objetos;
		}
	}

	function borrarLugar($id)	{
		$sql = "DELETE FROM lugares WHERE id_geografia=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id' => $id));
		if (!empty($query->execute(array(':id' => $id)))) {
			echo 'borrado';
		} else {
			echo 'noborrado';
		}
	}

	function obtener_lugar($id)	{
		$sql = "SELECT *,lugares.nombre as nombre, tipo_lugar.nombre as tipo, tipo_lugar.id FROM lugares JOIN tipo_lugar ON id_tipo_lugar=tipo_lugar.id WHERE id_geografia=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id' => $id));
		$this->objetos = $query->fetchAll();
		return $this->objetos;
	}

	function editarLugar($id_lugar, $nombre, $descripcion, $otros_nombres, $geografia, $tipo, $ecosistema, $clima, $flora_fauna, $recursos, $historia, $otros)	{
		$sql = "UPDATE lugares SET nombre=:nombre, descripcion_breve=:descripcion, otros_nombres=:otros_nombres, geografia=:geografia, id_tipo_lugar=:tipo, ecosistema=:ecosistema, clima=:clima, flora_fauna=:flora_fauna, recursos=:recursos, historia=:historia, otros=:otros WHERE id_geografia=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':nombre' => $nombre, ':descripcion' => $descripcion, ':tipo' => $tipo, ':otros_nombres' => $otros_nombres, ':geografia' => $geografia, ':ecosistema' => $ecosistema, ':clima' => $clima, ':flora_fauna' => $flora_fauna, ':recursos' => $recursos, ':historia' => $historia, ':otros' => $otros, ':id' => $id_lugar));
	}
}
