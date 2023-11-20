$(document).ready(function() {
	var funcion;
	var edit=false;
	var id_editar=$('#id_editar').val();

	if(id_editar!=undefined){
		buscar_cronica_editar(id_editar);
	}

	$('#form-crear-articulo').submit(e=>{
		let nombre_articulo=$('#nombre-articulo').val();
		let contenido_articulo=$('#contenido-articulo').val();
		let id_editado=$('#id_editar_art').val();
		let tipo=$('#tipo-articulo').val();
		//si edit es false, se crea un articulo, si es true, se modifica
		if(edit==false){
			funcion='crear';
		}else{
			funcion='editar';
		}
		$.post('../controlador/articulosController.php', {nombre_articulo, contenido_articulo, id_editado, tipo, funcion}, (response)=>{
				//console.log(response);
				if(response=='noadd'){
					toastr.error('No se pudo añadir el artículo.', 'Error');
				}else{
					if(response=='add'){
						toastr.success('Artículo añadido con éxito.', 'Éxito');
					}
					if(response=='edit'){
						toastr.success('Artículo editado con éxito.', 'Éxito');
					}
					$('#form-crear-articulo').trigger('reset');
					$('#submit-button').hide();
					edit=false;
					loader();
				}
		})
		e.preventDefault();
	});

	//con el atributo .on, se ejecuta cada vez que se pulsa una tecla
	$(document).on('keyup', '#buscar', function(){
		let valor = $(this).val();
		if(valor!=''){
			buscar_articulos(valor);
		}else{
			buscar_articulos();
		}
	});

	$(document).on('click', '.editar', (e)=>{
		//se usan 2 parentElement para llegar al tr desde el button #editar en el que se hace click
		const elemento=$(this)[0].activeElement.parentElement.parentElement;
		const id=$(elemento).attr('artId');
		funcion='detalles';
		$.post('../controlador/articulosController.php', {id, funcion}, (response)=>{
			const articulo = JSON.parse(response);
			$('#id_editar_art').val(articulo.id);
			$('#nombre-articulo').val(articulo.nombre);
			$('#contenido-articulo').summernote('code',articulo.contenido);
			$('#tipo-articulo').val(articulo.tipo);
			edit=true;
		})
	});

	$(document).on('click', '.nuevoarticulo',(e)=>{
		$('#form-crear-articulo').trigger('reset');
		$('#contenido-articulo').summernote('reset');
		$('#submit-button').show();
    edit=false;
  });

	$(document).on('click', '.detalles', (e)=>{
		//se usan 2 parentElement para llegar al tr desde el button #detalles en el que se hace click
		const elemento=$(this)[0].activeElement.parentElement.parentElement;
		const id=$(elemento).attr('artId');
		funcion='detalles';
		$.post('../controlador/articulosController.php', {id, funcion}, (response)=>{
			const articulo = JSON.parse(response);
			$('#nombre-articulo-title').html(articulo.nombre);
			$('#ver-nombre-articulo').html(articulo.nombre);
			$('#ver-contenido-articulo').html(articulo.contenido);
		})
	});

	$('#form-borrar-articulo').submit(e=>{
		let id=$('#id_articulo').val();
		funcion='borrar';
		$.post('../controlador/articulosController.php', { id, funcion}, (response)=>{
			if(response=='borrado'){
				toastr.success('Artículo eliminado.', 'Éxito');
			}
			if(response=='noborrado'){
				toastr.error('No se pudo eliminar el artículo.', 'Error');
			}
			$('#form-borrar-articulo').trigger('reset');
			buscar_articulos();
		})
		e.preventDefault();
	});

	//lleva el id del articulo a borrar al modal de confirmacion
	$(document).on('click', '.borrar', (e)=>{
		//se usan 2 parentElement para llegar al tr desde el button #borrar en el que se hace click
		const elemento=$(this)[0].activeElement.parentElement.parentElement;
		const id=$(elemento).attr('artId');
		const nombre=$(elemento).attr('artNombre');
		
		$('#id_articulo').val(id);
		$('#nombre-articulo-borrar').val(nombre);
	});

	/*----------para cronicas en createCronica.php---------*/
	function buscar_cronica_editar(dato) {
		funcion='detalles';
		const id=$('#id_editar').val();
		$.post('../controlador/articulosController.php', {id, funcion}, (response)=>{
			const articulo = JSON.parse(response);
			$('#id_editar_cronica').val(articulo.id);
			$('#nombre-cronica').val(articulo.nombre);
			$('#contenido-cronica').summernote('code',articulo.contenido);
			$('#no-edit-title').html("Editar crónica");
			$('#no-edit-title-h1').html("Editar crónica");
			edit=true;
		})
	};

	$('#form-create-cronica').submit(e=>{
		let nombre_articulo=$('#nombre-cronica').val();
		let contenido_articulo=$('#contenido-cronica').val();
		let id_editado=$('#id_editar_cronica').val();
		let tipo="Cronica";
		//si edit es false, se crea una cronica, si es true, se modifica
		if(edit==false){
			funcion='crear';
		}else{
			funcion='editar';
		}
		$.post('../controlador/articulosController.php', {nombre_articulo, contenido_articulo, id_editado, tipo, funcion}, (response)=>{
			//console.log(response);
			if(response=='add'){
				toastr.success('Crónica añadida.', 'Éxito');
			}
			if(response=='noadd'){
				toastr.error('No se pudo añadir, ya existe la crónica.', 'Error');
			}
			if(response=='edit'){
				toastr.success('Crónica editada.', 'Éxito');
			}
			$('#form-create-cronica').trigger('reset');
			$('#cancelar-cronica').hide();
			$('#guardar-cronica').hide();
			$('#volver-editar-button').show();
			edit=false;
		})
		e.preventDefault();
	});
});

function buscar_cronica_detalles(dato) {
	funcion='detalles';
	const id=dato;
	$.post('../controlador/articulosController.php', {id, funcion}, (response)=>{
		const articulo = JSON.parse(response);
		$('#cronica-title').html(articulo.nombre);
		$('#cronica-title-h1').html(articulo.nombre);
		$('#contenido-cronica').html(articulo.contenido);
	})
};

async function loader(tipo, consulta){
	var funcion;
	let datos=new FormData();
	if(tipo==1){
		funcion='buscar-cronicas';
		$('#nav-buttons').html(`<a type="button" class="btn btn-dark" href="createCronica.php" title="Nueva crónica">Nueva</a>`);
	}else{
		funcion='buscar';
		$('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark">Inicio</a>
		<button type="button" title="Nuevo artículo" data-toggle="modal" data-target="#crearArticulo" class="btn btn-dark nuevoarticulo">Nuevo</button>`);
	}
	$('#busqueda-nav').show();
	datos.append("funcion", funcion);
	if(consulta!=undefined){
		datos.append("consulta", consulta);
	}
	let data = await fetch('../controlador/articulosController.php', {
		method: 'POST',
		body: datos
	})
	if (data.ok) {
		//mejor usar data.text que data.json, pues si hay error, este se añade como cadena de texto a los datos
		let response = await data.text();
		try {
			//se descodifica el json
			const articulos = JSON.parse(response);
			let template='';
			articulos.forEach(articulo => {
				template+=`
					<tr artId="${articulo.id}" artNombre="${articulo.nombre}" artTipo="${articulo.tipo}">`;
					if(funcion=='buscar-cronicas'){
						template+=`<td>
						<button class="detalles btn btn-sm btn-info" title="Ver crónica" type="button">
						<a href=vistaCronica.php?id_cronica=${articulo.id} class="text-reset"><i class="fas fa-id-card mr-1"></i></a>
						</button>
						<form class="btn" action="createCronica.php" method="post">
								<button class="editar btn btn-success btn-sm" title="Editar crónica">
								<i class="fas fa-pencil-alt mr-1"></i></button>
								<input type="hidden" name="id" value="${articulo.id}">
						</form>
						<button class="borrar btn btn-danger btn-sm" title="Borrar crónica" type="button" data-toggle="modal" data-target="#confirmar"><i class="fas fa-trash"></i></button>`;
					}else{
						template+=`<td>
						<button class="detalles btn btn-info" title="Ver articulo" type="button" data-toggle="modal" data-target="#verArticulo"><i class="fas fa-id-card mr-1"></i></button>
						<button class="editar btn btn-success" title="Editar articulo" type="button" data-toggle="modal" data-target="#crearArticulo"><i class="fas fa-pencil-alt"></i></button>
						<button class="borrar btn btn-danger" title="Borrar articulo" type="button" data-toggle="modal" data-target="#confirmar"><i class="fas fa-trash"></i></button>`;
					}
					template+=`
					</td>
						<td>"${articulo.nombre}"</td>
						<td>"${articulo.tipo}"</td>
					</tr>`;				
				});
		$('#articulos').html(template);
		} catch (error) {
			console.error(error);
			console.log(response);
			toastr.error('Hubo conflicto en el sistema.', 'Error');
		}
	} else {
		toastr.error('Se ha producido un error: '+data.status, 'Error');
	}
}