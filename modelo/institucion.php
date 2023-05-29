<?php
include_once 'conexionDB.php';

class Institucion{
	var $objetos;
	public function __construct(){
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function createInstitucion($nombre_institucion, $escudo, $gentilicio, $capital, $tipo, $fundacion, $disolucion, $lema, $descripcion_breve, $historia, $politica_interior_exterior, $militar, $estructura_organizativa, $territorio, $frontera, $demografia, $cultura, $religion, $educacion, $tecnologia, $economia, $recursos_naturales, $otros, $id_ruler, $id_owner){
		//se busca si ya existe la entrada
		$sql="SELECT id_organizacion FROM organizaciones WHERE nombre=:nombre";
		$query=$this->acceso->prepare($sql);
		$query->execute(array(':nombre'=>$nombre_institucion));
		$this->objetos=$query->fetchAll();
		//si ya existe la entrada, no se añade
		if(!empty($this->objetos)){
				echo "noadd";
		}else{
			$sql="INSERT INTO organizaciones(nombre, gentilicio, capital, escudo, id_ruler, descripcionBreve, id_tipo_organizacion, lema, demografia, fundacion, disolucion, historia, estructura, politicaExteriorInterior, frontera, militar, religion, cultura, educacion, tecnologia, territorio, economia, recursosNaturales, otros) VALUES (:nombre, :gentilicio, :capital, :escudo, :id_ruler, :descripcionBreve, :tipo, :lema, :demografia, :fundacion, :disolucion, :historia, :estructura, :politicaExteriorInterior, :frontera, :militar, :religion, :cultura, :educacion, :tecnologia, :territorio, :economia, :recursosNaturales, :otros);";
			$query=$this->acceso->prepare($sql);
			$query->execute(array(':nombre'=>$nombre_institucion, ':gentilicio'=>$gentilicio, ':capital'=>$capital, ':escudo'=>$escudo, ':id_ruler'=>$id_ruler, ':descripcionBreve'=>$descripcion_breve, ':tipo'=>$tipo, ':lema'=>$lema, ':demografia'=>$demografia, ':fundacion'=>$fundacion, ':disolucion'=>$disolucion, ':historia'=>$historia, ':estructura'=>$estructura_organizativa, ':politicaExteriorInterior'=>$politica_interior_exterior, ':frontera'=>$frontera, ':militar'=>$militar, ':religion'=>$religion, ':cultura'=>$cultura, ':educacion'=>$educacion, ':tecnologia'=>$tecnologia, ':territorio'=>$territorio, ':economia'=>$economia, ':recursosNaturales'=>$recursos_naturales, ':otros'=>$otros));
			echo "add";
		}
	}

	function buscar($tipo){
		if($tipo==0){
			$filtro="AND id_tipo_organizacion!=4";
		}else{
			$filtro="AND id_tipo_organizacion=$tipo";
		}
		//se ha introducido algún caracter a buscar, se devuelven las entradas que encagen con la consulta
		if(!empty($_POST['consulta'])){
			$consulta=$_POST['consulta'];
			$sql="SELECT organizaciones.nombre as nombre, organizaciones.escudo, organizaciones.id_organizacion, organizaciones.descripcionBreve, tipo_organizacion.nombre as tipo FROM organizaciones JOIN tipo_organizacion ON id_tipo_organizacion=tipo_organizacion.id AND id_tipo_organizacion!=4 WHERE organizaciones.nombre LIKE :consulta ORDER BY organizaciones.nombre";
			$query=$this->acceso->prepare($sql);
			$query->execute(array(':consulta'=>"%$consulta%"));
		}else{
			//se devuelven todas las entradas
			$sql="SELECT organizaciones.nombre as nombre, organizaciones.escudo, organizaciones.id_organizacion, organizaciones.descripcionBreve, tipo_organizacion.nombre as tipo FROM organizaciones JOIN tipo_organizacion ON id_tipo_organizacion=tipo_organizacion.id ".$filtro." WHERE organizaciones.nombre NOT LIKE '' ORDER BY organizaciones.nombre";
			$query=$this->acceso->prepare($sql);
			$query->execute();
		}
		$this->objetos=$query->fetchAll();
		return $this->objetos;
	}

	function borrarInstitucion($id){
		$sql="SELECT escudo FROM organizaciones WHERE id_organizacion=:id";
		$query=$this->acceso->prepare($sql);
		$query->execute(array(':id'=>$id));
		$this->objetos=$query->fetchAll();
		if(!empty($this->objetos)){
			foreach ($this->objetos as $obj) {
				$escudo=$obj->escudo;
			}
			if($escudo!='default.png'){
				unlink('../imagenes/Escudos/'.$escudo);
			}
		}
		$sql="DELETE FROM organizaciones WHERE id_organizacion=:id";
		$query=$this->acceso->prepare($sql);
		$query->execute(array(':id'=>$id));
		if(!empty($query->execute(array(':id'=>$id)))){
				echo 'borrado';
		}else{
				echo 'noborrado';
		}
	}

	function buscarInstitucion($id){
		$sql="SELECT consulta.id_organizacion, consulta.escudo, consulta.gentilicio, consulta.capital, consulta.fundacion, consulta.disolucion, consulta.lema, consulta.descripcionBreve, consulta.estructura, consulta.politicaExteriorInterior, consulta.frontera, consulta.militar, consulta.cultura, consulta.educacion, consulta.tecnologia, consulta.territorio, consulta.economia, consulta.recursosNaturales, consulta.demografia, consulta.id_ruler, consulta.id_owner, consulta.id_tipo_organizacion, consulta.otros as otros, consulta.historia as historia, consulta.religion as religion, consulta.nombre as nombre, tipo_organizacion.nombre as tipo_org, personaje.nombre as ruler, padre.nombre as padre
		FROM organizaciones consulta
		JOIN tipo_organizacion ON id_tipo_organizacion=tipo_organizacion.id 
		LEFT JOIN personaje ON personaje.id=id_ruler 
		LEFT JOIN organizaciones padre ON consulta.id_owner=padre.id_organizacion
		WHERE consulta.id_organizacion=:id";
		$query=$this->acceso->prepare($sql);
		$query->execute(array(':id'=>$id));
		$this->objetos=$query->fetchAll();
		return $this->objetos;
	}

	function editarInstitucion($nombre_institucion, $gentilicio, $capital, $tipo, $fundacion, $disolucion, $lema, $descripcion_breve, $historia, $politica_interior_exterior, $militar, $estructura_organizativa, $territorio, $fronteras, $demografia, $cultura, $religion, $educacion, $tecnologia, $economia, $recursos_naturales, $otros, $id_institucion, $id_ruler, $id_owner){
		$sql="UPDATE organizaciones SET nombre=:nombre, gentilicio=:gentilicio, capital=:capital, id_tipo_organizacion=:tipo, id_ruler=:ruler, id_owner=:id_owner, lema=:lema, demografia=:demografia, fundacion=:fundacion, disolucion=:disolucion, descripcionBreve=:descripcionBreve, historia=:historia, estructura=:estructura, politicaExteriorInterior=:politicaExteriorInterior, frontera=:frontera, militar=:militar, religion=:religion, cultura=:cultura, educacion=:educacion, tecnologia=:tecnologia, territorio=:territorio, economia=:economia, recursosNaturales=:recursosNaturales, otros=:otros WHERE id_organizacion=:id";
		$query=$this->acceso->prepare($sql);
		$query->execute(array(':nombre'=>$nombre_institucion, ':gentilicio'=>$gentilicio, ':capital'=>$capital, ':descripcionBreve'=>$descripcion_breve, ':tipo'=>$tipo, ':ruler'=>$id_ruler, ':id_owner'=>$id_owner, ':lema'=>$lema, ':demografia'=>$demografia, ':fundacion'=>$fundacion, ':disolucion'=>$disolucion, ':historia'=>$historia, ':estructura'=>$estructura_organizativa, ':politicaExteriorInterior'=>$politica_interior_exterior, ':frontera'=>$fronteras, ':militar'=>$militar, ':religion'=>$religion, ':cultura'=>$cultura, ':educacion'=>$educacion, ':tecnologia'=>$tecnologia, ':territorio'=>$territorio, ':economia'=>$economia, ':recursosNaturales'=>$recursos_naturales, ':otros'=>$otros, ':id'=>$id_institucion));
	}

	function cambiar_escudo($id_institucion, $nombre){			
		$sql="UPDATE organizaciones SET escudo=:nombre WHERE id_organizacion=:id";
		$query=$this->acceso->prepare($sql);
		$query->execute(array(':id'=>$id_institucion, ':nombre'=>$nombre));
		
		return $this->objetos;
	}

	function menu_religiones(){
		$sql="SELECT id_organizacion, nombre FROM organizaciones WHERE id_tipo_organizacion=4 order by nombre ASC";
		$query=$this->acceso->prepare($sql);
		$query->execute();
		$this->objetos=$query->fetchAll();
		return $this->objetos;
}
}
?>