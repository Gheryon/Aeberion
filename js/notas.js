$(document).ready(function () {

	$('#form-add-names').submit(e => {
		let nombre = $('#nombre').val();
		let tipo = $('#tipo').val();
		let funcion='add-name';
		$.post('../controlador/notasController.php', { nombre, tipo, funcion }, (response) => {
			let nombres=JSON.parse(response);
			if (nombres.mensaje == 'add') {
        toastr.success('Añadido.', 'Éxito');
				loader(1);
			}
			if (nombres.mensaje == 'error_file') {
        toastr.error('No se pudo añadir.', 'Error');
			}
			$('#form-add-names').trigger('reset');
		})
		e.preventDefault();
	});

	$('#edit-names').on('show.bs.modal', function (event) {
    var funcion="buscar-file";
		let tipo = $('#tipo_edit').val();
		$.post('../controlador/notasController.php', { funcion, tipo }, (response) => {
			//console.log(response);
			let nombres=JSON.parse(response);
			//nombres es un array con una única posición donde está el contenido, por eso el [0]
			$('#lista-nombres').val(nombres[0]['lista']);
		})
  });

	$(document).on('change', '#tipo_edit', function(){
		var funcion="buscar-file";
		let tipo = $('#tipo_edit').val();
		$.post('../controlador/notasController.php', { funcion, tipo }, (response) => {
			//console.log(response);
			let nombres=JSON.parse(response);
			//nombres es un array con una única posición donde está el contenido, por eso el [0]
			$('#lista-nombres').val(nombres[0]['lista']);
		})
	});

	$('#form-edit-names').submit(e => {
		let lista = $('#lista-nombres').val();
		let tipo = $('#tipo_edit').val();
		let funcion='edit-names';
		$.post('../controlador/notasController.php', { lista, tipo, funcion }, (response) => {
			let nombres=JSON.parse(response);
			if (nombres.mensaje == 'edit') {
        toastr.success('Editado.', 'Éxito');
				loader();
			}
			if (nombres.mensaje == 'error_file') {
        toastr.error('No se pudo editar, no se pudo abrir el archivo.', 'Error');
			}
			$('#form-edit-names').trigger('reset');
		})
		e.preventDefault();
	});

	$('#form-add-links').submit(e => {
		let nombre = $('#nombre').val();
		let url = $('#url').val();
		let tipo = $('#tipo').val();
		let funcion='add-link';
		$.post('../controlador/notasController.php', { nombre, url, tipo, funcion }, (response) => {
			let nombres=JSON.parse(response);
			if (nombres.mensaje == 'add') {
        toastr.success('Añadido.', 'Éxito');
				loader(2);
			}
			if (nombres.mensaje == 'error_file') {
        toastr.error('No se pudo añadir.', 'Error');
			}
			$('#form-add-names').trigger('reset');
		})
		e.preventDefault();
	});
});

function loader(filtro){
	var target='';
	if(filtro==1){
		var funcion="buscar-nombres";
		target='names';
	}else{
		var funcion="buscar-enlaces";
		target='links';
	}
	
	$('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark">Inicio</a>
		<button type="button" data-toggle="modal" data-target="#add-${target}" class="btn btn-dark">Añadir</button>
		<button type="button" data-toggle="modal" data-target="#edit-${target}" class="btn btn-dark">Editar</button>`);

	$.post('../controlador/notasController.php', { funcion }, (response) => {
		let nombres = JSON.parse(response);

		if(filtro==1){
			//los nombres vienen en el mismo orden siempre: hombres, mujeres, lugares, sin decidir, otros y lemas
			$('#nombres_m').html(nombres[0]['nombres_m']);
			$('#nombres_f').html(nombres[1]['nombres_f']);
			$('#nombres_l').html(nombres[2]['nombres_l']);
			$('#nombres_s').html(nombres[3]['nombres_s']);
			$('#nombres_o').html(nombres[4]['nombres_o']);
			$('#lemas').html(nombres[5]['lemas']);
		}else{
			template=``;
			nombres[0]['enlaces_g'].forEach(enlace => {
				template+=`<div class="row"><a href=${enlace.link}>${enlace.nombre}</a></div>`;
			});
			$('#enlaces_g').html(template);
			template=``;
			nombres[1]['enlaces_c'].forEach(enlace => {
				template+=`<div class="row"><a href=${enlace.link}>${enlace.nombre}</a></div>`;
			});
			$('#enlaces_c').html(template);
			template=``;
			nombres[2]['enlaces_r'].forEach(enlace => {
				template+=`<div class="row"><a href=${enlace.link}>${enlace.nombre}</a></div>`;
			});
			$('#enlaces_r').html(template);
		}
	})
}