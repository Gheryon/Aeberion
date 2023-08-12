<?php
include_once 'conexionDB.php';
class Personaje{
	var $objetos;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function nuevoPersonaje($nombre, $apellidos, $nombrefamilia, $gentilicio, $fecha_nacimiento, $fecha_fallecimiento, $causa_fallecimiento, $descripcion, $descripcionShort, $personalidad, $deseos, $miedo, $magia, $educacion, $historia, $religion, $familia, $politica, $retrato, $especie, $sexo, $otros)	{
		$sql = "INSERT INTO personaje(Nombre, Apellidos, nombreFamilia, lugar_nacimiento, nacimiento, fallecimiento, causa_fallecimiento, Descripcion, DescripcionShort, Personalidad, Deseos, Miedos, Magia, educacion, Historia, Religion, Familia, Politica, Retrato, id_foranea_especie, Sexo, otros) VALUES (:nombre, :apellidos, :nombrefamilia, :lugar_nacimiento, :nacimiento, :fallecimiento, :causa_fallecimiento, :descripcion, :descripcionshort, :personalidad, :deseos, :miedos, :magia, :educacion, :historia, :religion, :familia, :politica, :retrato, :id_foranea_especie, :sexo, :otros);";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':nombre' => $nombre, ':apellidos' => $apellidos, ':nombrefamilia' => $nombrefamilia, ':lugar_nacimiento' => $gentilicio, ':nacimiento' => $fecha_nacimiento, ':fallecimiento' => $fecha_fallecimiento, ':causa_fallecimiento' => $causa_fallecimiento, ':descripcion' => $descripcion, ':descripcionshort' => $descripcionShort, ':personalidad' => $personalidad, ':deseos' => $deseos, ':miedos' => $miedo, ':magia' => $magia, ':educacion' => $educacion, ':historia' => $historia, ':religion' => $religion, ':familia' => $familia, ':politica' => $politica, ':retrato' => $retrato, ':id_foranea_especie' => $especie, ':sexo' => $sexo, ':otros' => $otros));
	}

	function lastId(){
    $sql="SELECT MAX(id) as id FROM personaje";
    $query=$this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchAll();
    return $this->objetos;
  }

	function idFechas($id){
    $sql="SELECT nacimiento, fallecimiento FROM personaje WHERE id=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchAll();
    return $this->objetos;
  }

	function buscar()	{
		//se ha introducido algún caracter a buscar, se devuelven los usuarios que encagen con la consulta
		if (!empty($_POST['consulta'])) {
			$consulta = $_POST['consulta'];
			$sql = "SELECT personaje.id, personaje.Nombre, personaje.Apellidos, personaje.DescripcionShort, personaje.Sexo, personaje.Retrato, especies.nombre AS nombreEspecie FROM personaje JOIN especies ON id_foranea_especie=id_especie WHERE personaje.Nombre LIKE :consulta";
			$query = $this->acceso->prepare($sql);
			$query->execute(array(':consulta' => "%$consulta%"));
			$this->objetos = $query->fetchAll();
			return $this->objetos;
		} else {
			//se devuelven todos los usuarios
			$sql = "SELECT personaje.id, personaje.Nombre, personaje.Apellidos, personaje.DescripcionShort, personaje.Sexo, personaje.Retrato, especies.nombre AS nombreEspecie FROM personaje JOIN especies ON id_foranea_especie=id_especie WHERE personaje.Nombre NOT LIKE '' ORDER BY personaje.Nombre LIMIT 25";
			$query = $this->acceso->prepare($sql);
			$query->execute();
			$this->objetos = $query->fetchAll();
			return $this->objetos;
		}
	}

	function borrarPersonaje($id)	{
		$sql = "SELECT retrato FROM personaje WHERE id=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id' => $id));
		$this->objetos = $query->fetchAll();
		if (!empty($this->objetos)) {
			foreach ($this->objetos as $obj) {
				$retrato = $obj->retrato;
			}
			if ($retrato != 'default.png') {
				unlink('../imagenes/Retratos/' . $retrato);
			}
		}

		$sql = "DELETE FROM personaje WHERE id=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id' => $id));
	}

	function obtener_personaje($id)	{
		$sql = "SELECT *, personaje.otros AS otros_personaje, personaje.Nombre AS nombre_personaje, especies.nombre AS nombreEspecie FROM personaje JOIN especies ON id_foranea_especie=id_especie WHERE id=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id' => $id));
		$this->objetos = $query->fetchAll();
		return $this->objetos;
	}

	function editar($id_personaje, $nombre, $apellidos, $nombre_familia, $gentilicio, $fecha_nacimiento, $fecha_fallecimiento, $causa_fallecimiento, $descripcion, $descripcionshort, $personalidad, $deseos, $miedos, $magia, $educacion, $historia, $religion, $familia, $politica, $especie, $sexo, $otros)	{
		$sql = "UPDATE personaje SET Nombre=:nombre, nombreFamilia=:nombrefam, Apellidos=:apellidos, lugar_nacimiento=:lugar_nacimiento, nacimiento=:nacimiento, fallecimiento=:fallecimiento, causa_fallecimiento=:causa_fallecimiento, Descripcion=:descripcion, DescripcionShort=:descripcionshort, Personalidad=:personalidad, Deseos=:deseos, Miedos=:miedos, Magia=:magia, educacion=:educacion, Historia=:historia, Religion=:religion, Familia=:familia, Politica=:politica, id_foranea_especie=:id_foranea_especie, Sexo=:sexo, otros=:otros WHERE id=:id_personaje";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':nombre' => $nombre, 'nombrefam' => $nombre_familia, ':apellidos' => $apellidos, ':lugar_nacimiento' => $gentilicio, ':nacimiento' => $fecha_nacimiento, ':fallecimiento' => $fecha_fallecimiento, ':causa_fallecimiento' => $causa_fallecimiento, ':descripcion' => $descripcion, ':descripcionshort' => $descripcionshort, ':personalidad' => $personalidad, ':deseos' => $deseos, ':miedos' => $miedos, ':magia' => $magia, ':educacion' => $educacion, ':historia' => $historia, ':religion' => $religion, ':familia' => $familia, ':politica' => $politica, ':id_foranea_especie' => $especie, ':sexo' => $sexo, ':otros' => $otros, ':id_personaje' => $id_personaje));
	}

	function retrado_old($id){
		$sql = "SELECT retrato FROM personaje WHERE id=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id' => $id));
		$this->objetos = $query->fetchAll();
		return $this->objetos;
	}
}
