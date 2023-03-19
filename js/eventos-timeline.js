$(document).ready(function(){
  //por defecto, se obtienen todos los eventos (1->historia universal) en orden ascendente
  buscarEventos(1, "ASC");

  var edit=false;
  var orden="ASC";
  var cronologia=1;

  /*$(document).on('change', '#filter_timeline', function(){
  //$('#filter_timeline').on('change', function(){
    console.log(this.value);
    orden=$('#order_timeline').val();
    console.log(orden);
  });*/

  /*$(document).on('change', '#order_timeline', function(){
  //$('#order_timeline').on('change', function(){ <--por lo que sea, no funciona así
    orden=this.value;
    console.log(orden);
    cronologia=$('#filter_timeline').val();
    console.log(cronologia);
    buscarEventos(1, orden);
  });*/
  $('#form_filtrar_eventos').submit(e=>{
    e.preventDefault();
    cronologia=$('#filter_timeline').val();
    orden=$('#order_timeline').val();
    if(cronologia==undefined){
      cronologia=1;
    }
    if(orden==undefined){
      orden="ASC";
    }
    buscarEventos(cronologia, orden);
	});

  function buscarEventos(timeline, orden) {
    $('#nav-buttons').html(`
    <div class="row">
    <a href="../index.php" class="btn btn-dark ml-2">Inicio</a>
    <button type="button" class="nuevo-evento btn btn-dark ml-2" data-toggle="modal" data-target="#nuevoEvento">Nuevo evento</button>
    <form id="form_filtrar_eventos" class="ml-2">
      <!--<label for="filter_timeline" class="form-label">Línea temporal</label>-->
      <select id="filter_timeline" class="form-select" name="filter_timeline"></select>
      <!--<label for="order_timeline" class="form-label"></label>-->
      <select id="order_timeline" class="form-select ml-2" name="order_timeline">
        <option selected disabled value="ASC">Orden</option>
        <option value="ASC">Ascendente</option>
        <option value="DESC">Descendente</option>
      </select>
      <button type="submit" class="btn btn-dark ml-2">Filtrar</button>
    </form>
    </div>
    `);
    fill_select_timelines('#filter_timeline');
    funcion='buscar';
    $.post('../controlador/timelinesController.php', {timeline, orden, funcion},(response)=>{
      //console.log(response);
      const eventos= JSON.parse(response);
      let template='';
      eventos.forEach(evento => {
        template+=`
          <!-- timeline time label -->
          <div class="time-label">
            <span class="bg-dark">${evento.fecha}</span>
          </div>
          <!-- /.timeline-label -->
          <!-- timeline item -->
          <div>
            <i class="fas fa-envelope bg-blue"></i>
            <div class="timeline-item">
            <span class="time"><i class="fas fa-clock"></i> ${evento.lineaTemporal}</span>
              <h3 class="timeline-header">${evento.nombre}</h3>
              <div class="timeline-body">
                ${evento.descripcion}
              </div>
              <div class="timeline-footer">
                <button type="button" class="editar-evento btn btn-primary btn-sm" data-toggle="modal" data-id="${evento.id}" data-target="#nuevoEvento">Editar</button>
                <button type="button" id="${evento.id}" nombre="${evento.nombre}" class="borrar-evento btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminarEvento">Eliminar</button>
              </div>
            </div>
          </div>
          <!-- END timeline item -->
          `;
      });
      template+=`
      <div>
        <i class="fas fa-clock bg-gray"></i>
      </div>
      `;
      $('#timeline').html(template);
    });
  }

  function fill_select_timelines(id){
    funcion='fill_select_timelines';
    $.post('../controlador/timelinesController.php', {funcion}, (response)=>{
      let timelines=JSON.parse(response);
      let template=`
      <option selected disabled value="1">Línea temporal</option>`;
      timelines.forEach(timeline=>{
        template+=`<option value="${timeline.id}">${timeline.nombre}</option>`;
      });
      $(id).html(template);
    })
  }

  $('#form-evento').submit(e=>{
    let nombre=$('#nombreEvento').val();
    let dia=$('#dia').val();
    let mes=$('#mes').val();
    let anno=$('#anno').val();
    let descripcion=$('#descripcion').val();
    let id_editado=$('#id_editar').val();
    let lineaTemporal=$('#select_timeline').val();
    console.log(lineaTemporal);
    //let tipo=$('#tipo').val();
    //si edit es false, se crea una entrada, si es true, se modifica
    if(edit==false){
        funcion='add';
    }else{
        funcion='editar';
    }
    $.post('../controlador/timelinesController.php', {nombre, dia, mes, anno, descripcion, id_editado, lineaTemporal, funcion}, (response)=>{
        console.log(response);
        if(response=='add'){
            $('#add').hide('slow');
            $('#add').show(1000);
            buscarEventos();
        }
        if(response=='no-add'){
            $('#no-add').hide('slow');
            $('#no-add').show(1000);
        }
        if(response=='edit'){
            $('#edit').hide('slow');
            $('#edit').show(1000);
            buscarEventos();
        }
        $('#form-evento').trigger('reset');
        $('#submit-crear-button').hide();
        $('#cancelar-crear-button').hide();
        $('#volver-crear-button').show();
        edit=false;
    })
    e.preventDefault();
  });

  $(document).on('click', '.borrar-evento',(e)=>{
    funcion='borrar_evento';
    let elemento=$(this)[0].activeElement;
    const id=$(elemento).attr('id');
    const nombre=$(elemento).attr('nombre');
    edit=false;
    $('#id_borrar').val(id);
    $('#texto-borrar').html(`<div>¿Seguro de eliminar el evento <b>${nombre}</b>?</div>`);
    $('#funcion').val(funcion);
  });

  $('#form-borrar-evento').submit(e=>{
		let id=$('#id_borrar').val();
		funcion='borrar';
		$.post('../controlador/timelinesController.php', { id, funcion}, (response)=>{
			if(response=='borrado'){
				$('#borrado').hide('slow');
				$('#borrado').show(1000);
        buscarEventos();
			}
			if(response=='noborrado'){
				$('#no-borrado').hide('slow');
				$('#no-borrado').show(1000);
			}
		})
		e.preventDefault();
	});

  $(document).on('click', '.nuevo-evento',(e)=>{
    fill_select_timelines('#select_timeline');
    edit=false;
  });

  $('#nuevoEvento').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); // Extracción del valor id del atributo data-*
    //si id==undefined, se está creando un nuevo evento, si está definido, se está editando un evento
    if(id!=undefined){
      fill_select_timelines('#select_timeline');
      $('#submit-crear-button').show();
      $('#cancelar-crear-button').show();
      $('#volver-crear-button').hide();
      funcion='detalles';
      $.post('../controlador/timelinesController.php', {id, funcion}, (response)=>{
        console.log(response);
        const evento = JSON.parse(response);
        $('#id_editar').val(evento.id);
        $('#nombreEvento').val(evento.nombre);
        $('#dia').val(evento.dia);
        $('#mes').val(evento.mes);
        $('#anno').val(evento.anno);
        console.log(evento.id_linea_temporal);
        $('#select_timeline').val(evento.id_linea_temporal).trigger('change');
        $('#descripcion').summernote('code',evento.descripcion);
        //$('#tipo').val(evento.tipo);
        edit=true;
      })
    }
  });
});