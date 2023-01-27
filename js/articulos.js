$(document).ready(function() {
	//buscar_articulos() para que automáticamente se muestren todos los articulos
	var carga = $('#cargar-cronicas').val();
	var funcion;
	var edit=false;
	var id_editar=$('#id_editar').val();
	var id_detalles=$('#id_cronica_detalles').val();

	if(id_detalles!=undefined){
			buscar_cronica_detalles(id_detalles);
	}
	if(id_editar!=undefined){
			buscar_cronica_editar(id_editar);
	}else{
			buscar_articulos();
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
					console.log(response);
					if(response=='add'){
							$('#add-articulo').hide('slow');
							$('#add-articulo').show(1000);
							$('#add-articulo').hide(3000);
							//resetea los campos de la card
							$('#form-crear-articulo').trigger('reset');
							buscar_articulos();
					}
					if(response=='noadd'){
							$('#noadd-articulo').hide('slow');
							$('#noadd-articulo').show(1000);
							$('#noadd-articulo').hide(3000);
							//resetea los campos de la card
							$('#form-crear-articulo').trigger('reset');
					}
					if(response=='edit'){
							$('#edit-articulo').hide('slow');
							$('#edit-articulo').show(1000);
							$('#edit-articulo').hide(3000);
							//resetea los campos de la card
							$('#form-crear-articulo').trigger('reset');
							buscar_articulos();
					}
					edit=false;
			})
			e.preventDefault();
	});

	function buscar_articulos(consulta){
		if(carga=="cargar-cronicas"){
			funcion='buscar-cronicas';
			$('#nav-buttons').html(`<a type="button" class="btn btn-dark" href="createCronica.php">Nueva</a>`);
		}else{
			funcion='buscar';
			$('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark">Inicio</a>
			<button type="button" data-toggle="modal" data-target="#crearArticulo" class="btn btn-dark">Nuevo</button>`);
		}
		$('#busqueda-nav').show();
		$.post('../controlador/articulosController.php', {consulta, funcion}, (response)=>{
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
		})
	}
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
				$('#confirmado').hide('slow');
				$('#confirmado').show(1000);
				$('#confirmado').hide(3000);
			}
			if(response=='noborrado'){
				$('#rechazado').hide('slow');
				$('#rechazado').show(1000);
				$('#rechazado').hide(3000);
			}
			//resetea los campos de la card
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
				$('#add-cronica').hide('slow');
				$('#add-cronica').show(1000);
				$('#add-cronica').hide(3000);
				$('#form-create-cronica').trigger('reset');
				$('#cancelar-cronica').hide();
				$('#guardar-cronica').hide();
				$('#volver-editar-button').show();
			}
			if(response=='noadd'){
				$('#noadd-cronica').hide('slow');
				$('#noadd-cronica').show(1000);
				$('#noadd-cronica').hide(3000);
				$('#form-create-cronica').trigger('reset');
				$('#cancelar-cronica').hide();
				$('#guardar-cronica').hide();
				$('#volver-editar-button').show();
			}
			if(response=='edit'){
				$('#edit-cronica').hide('slow');
				$('#edit-cronica').show(1000);
				$('#edit-cronica').hide(3000);
				$('#form-create-cronica').trigger('reset');
				$('#cancelar-cronica').hide();
				$('#guardar-cronica').hide();
				$('#volver-editar-button').show();
			}
			edit=false;
		})
		e.preventDefault();
	});
});