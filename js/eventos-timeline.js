$(document).ready(function(){
  buscarEventos();

  var edit=false;

  function buscarEventos(consulta) {
    funcion='buscar';
    $('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark">Inicio</a>
    <button type="button" class="nuevo-evento btn btn-dark" data-toggle="modal" data-target="#nuevoEvento">Nuevo evento</button>`);
    $.post('../controlador/timelinesController.php', {consulta, funcion},(response)=>{
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
                <button type="button" class="editar-evento2 btn btn-primary btn-sm" data-toggle="modal" data-id="${evento.id}" data-target="#nuevoEvento">Editar</button>
                <a class="borrar-evento2 btn btn-danger btn-sm" data-toggle="modal" data-id="${evento.id}" data-target="#eliminarEvento">Eliminar</a>
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

  function fill_select_timelines(){
    funcion='fill_select_timelines';
    $.post('../controlador/timelinesController.php', {funcion}, (response)=>{
      let timelines=JSON.parse(response);
      let template='';
      timelines.forEach(timeline=>{
        template+=`
        <option value="${timeline.id}">${timeline.nombre}</option>
        `;
      });
      $('#select_timeline').html(template);
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
        //resetea los campos de la card
        $('#form-evento').trigger('reset');
        $('#submit-crear-button').hide();
        $('#cancelar-crear-button').hide();
        $('#volver-crear-button').show();
        edit=false;
    })
    e.preventDefault();
});

  $(document).on('click', '.borrar-evento',(e)=>{
    funcion='borrar_asentamiento';
    //se quiere acceder al elemento Id de la card y guardarlo en elemento, para ello hay que subir 4 veces desde donde está el boton Confirmar eliminar asentamiento.
    const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id=$(elemento).attr('asentamientoId');
    const nombre=$(elemento).attr('asentamientoNombre');
    edit=false;
    $('#id_borrar').val(id);
    $('#texto-borrar').html(`<div>¿Seguro de eliminar asentamiento <b>${nombre}</b>?</div>`);
    $('#funcion').val(funcion);
  });

  $(document).on('click', '.nuevo-evento',(e)=>{
    fill_select_timelines();
    edit=false;
  });

  $('#nuevoEvento').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); // Extracción del valor id del atributo data-*
    console.log(id);
    //si id==undefined, se está creando un nuevo evento, si está definido, se está editando un evento
    if(id!=undefined){
      fill_select_timelines();
      funcion='detalles';
      $.post('../controlador/timelinesController.php', {id, funcion}, (response)=>{
        console.log(response);
        const evento = JSON.parse(response);
        $('#id_editar').val(evento.id);
        $('#nombreEvento').val(evento.nombre);
        $('#dia').val(evento.dia);
        $('#mes').val(evento.mes);
        $('#anno').val(evento.anno);
        $('#descripcion').summernote('code',evento.descripcion);
        //$('#tipo').val(evento.tipo);
        edit=true;
      })
    }
  });

});