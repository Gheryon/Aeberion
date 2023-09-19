$(document).ready(function () {
	$('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark">Inicio</a>
		<button type="button" data-toggle="modal" data-target="#add-names" class="btn btn-dark">Añadir</button>`);

	$('#form-add-names').submit(e => {
		let nombre = $('#nombre').val();
		let tipo = $('#tipo').val();
		let funcion='add-name';
		$.post('../controlador/nombresController.php', { nombre, tipo, funcion }, (response) => {
			console.log(response);
			//let nombres=JSON.parse(response);
			//console.log(nombres);
			if (response == 'add') {
        toastr.success('Añadido.', 'Éxito');
				loader();
			}
			if (response == 'noadd') {
        toastr.error('No se pudo añadir.', 'Error');
			}
			$('#form-add-names').trigger('reset');
		})
		e.preventDefault();
	});
});

function loader(){
  var funcion="buscar";
	$.post('../controlador/nombresController.php', { funcion }, (response) => {
		//console.log(response);
		let nombres = JSON.parse(response);
		console.log(nombres);

		//los nombres vienen en el mismo orden siempre
		$('#nombres_m').html(nombres[0]['nombres_m']);
		$('#nombres_f').html(nombres[1]['nombres_f']);
		$('#nombres_l').html(nombres[2]['nombres_l']);
		//$('#nombres_t').html(nombres[3]['nombres_t']);
		$('#nombres_s').html(nombres[4]['nombres_s']);
		$('#nombres_o').html(nombres[5]['nombres_o']);
		$('#lemas').html(nombres[6]['lemas']);
	})
}