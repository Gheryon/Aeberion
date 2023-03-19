<?php
include_once 'conexionDB.php';

class Especie
{
	var $objetos;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function createEspecie($nombre, $edad, $peso, $altura, $longitud, $estatus, $anatomia, $alimentacion, $reproduccion, $distribucion, $habilidades, $domesticacion, $explotacion, $otros, $imagen){
		//se busca si ya existe la especie
		$sql = "SELECT id_especie FROM especies WHERE nombre=:nombre";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':nombre' => $nombre));
		$this->objetos = $query->fetchAll();
		//si ya existe la especie, no se añade
		if (!empty($this->objetos)) {
			echo "noadd";
		} else {
			$sql = "INSERT INTO especies(nombre, edad, peso, altura, longitud, estatus, anatomia, alimentacion, reproduccion, distribucion, habilidades, domesticacion, explotacion, otros, imagen) VALUES (:nombre, :edad, :peso, :altura, :longitud, :estatus, :anatomia, :alimentacion, :reproduccion, :distribucion, :habilidades, :domesticacion, :explotacion, :otros, :imagen);";
			$query = $this->acceso->prepare($sql);
			$query->execute(array(':nombre' => $nombre, ':edad' => $edad, ':peso' => $peso, ':altura' => $altura, ':longitud' => $longitud, ':estatus' => $estatus, ':anatomia' => $anatomia, ':alimentacion' => $alimentacion, ':reproduccion' => $reproduccion, ':distribucion' => $distribucion, ':habilidades' => $habilidades, ':domesticacion' => $domesticacion, ':explotacion' => $explotacion, ':otros' => $otros, ':imagen' => $imagen));
			echo "add";
		}
	}

	function buscar(){
		if (!empty($_POST['consulta'])) {
			$consulta = $_POST['consulta'];
			$sql = "SELECT * FROM especies WHERE nombre LIKE :consulta";
			$query = $this->acceso->prepare($sql);
			$query->execute(array(':consulta' => "%$consulta%"));
			$this->objetos = $query->fetchAll();
			return $this->objetos;
		} else {
			//se devuelven todos los usuarios
			$sql = "SELECT * FROM especies WHERE nombre NOT LIKE '' ORDER BY id_especie LIMIT 25";
			$query = $this->acceso->prepare($sql);
			$query->execute();
			$this->objetos = $query->fetchAll();
			return $this->objetos;
		}
	}

	function borrarEspecie($id){
		$sql = "DELETE FROM especies WHERE id_especie=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id' => $id));
		if (!empty($query->execute(array(':id' => $id)))) {
			echo 'borrado';
		} else {
			echo 'noborrado';
		}
	}

	function obtener_especie($id){
		$sql = "SELECT * FROM especies WHERE id_especie=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id' => $id));
		$this->objetos = $query->fetchAll();
		return $this->objetos;
	}

	function obtener_especies(){
		$sql = "SELECT * FROM especies order by nombre ASC";
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos = $query->fetchAll();
		return $this->objetos;
	}

	function editarEspecie($id_especie, $nombre, $edad, $peso, $altura, $longitud, $estatus, $anatomia, $alimentacion, $reproduccion, $distribucion, $habilidades, $domesticacion, $explotacion, $otros){
		$sql = "UPDATE especies SET nombre=:nombre, edad=:edad, peso=:peso, altura=:altura, longitud=:longitud, estatus=:estatus, anatomia=:anatomia, alimentacion=:alimentacion, reproduccion=:reproduccion, distribucion=:distribucion, habilidades=:habilidades, domesticacion=:domesticacion, explotacion=:explotacion, otros=:otros WHERE id_especie=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':nombre' => $nombre, ':edad' => $edad, ':peso' => $peso, ':altura' => $altura, ':longitud' => $longitud, ':estatus' => $estatus, ':anatomia' => $anatomia, ':alimentacion' => $alimentacion, ':reproduccion' => $reproduccion, ':distribucion' => $distribucion, ':habilidades' => $habilidades, ':domesticacion' => $domesticacion, ':explotacion' => $explotacion, ':otros' => $otros, ':id' => $id_especie));
	}
}
