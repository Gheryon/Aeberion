$(document).ready(function(){
  buscarTiposEventos();
  buscarTimelines();

  //para evitar que los mensajes toastr se acumulen en pantalla
  toastr.options={
    "preventDuplicates": true
  }

  /*******comunes para todos******/
  $('#form-editar-nombre').submit(e=>{
    let id=$('#id_editar').val();
    let nombre=$('#nombre_editar').val();
    let funcion=$('#funcion_editar').val();
    $.post('../controlador/configuracionController.php', {id, nombre, funcion},(response)=>{
      if(response=='edit'){
        toastr.success('Elemento editado.', 'Éxito');
        if(funcion=='editar_tipo_evento'){
          buscarTiposEventos();
        }
        if(funcion=='editar_timeline'){
          buscarTimelines();
        }
      }
      if(response=='no-edit'){
        toastr.error('No se pudo editar.', 'Error');
      }
      $('#form-editar-nombre').trigger('reset');
      $('#submit-editar-button').hide();
      $('#cancelar-editar-button').hide();
      $('#cerrar-editar-button').show();
    });
    e.preventDefault();
  });

  $('#form-confirmar-borrar').submit(e=>{
    let id=$('#id_borrar').val();
    let funcion=$('#funcion').val();
    $.post('../controlador/configuracionController.php', {id, funcion},(response)=>{
      if(response=='borrado'){
        toastr.success('Elemento borrado.', 'Éxito');
        if(funcion=='borrar_tipo_evento'){
          buscarTiposEventos();
        }
        if(funcion=='borrar_timeline'){
          buscarTimelines();
        }
      }
      if(response=='no-borrado'){
        toastr.error('No se pudo borrar.', 'Error');
      }
      $('#form-confirmar-borrar').trigger('reset');
      $('#cancelar-borrar-button').hide();
      $('#confirmar-borrar-button').hide();
      $('#cerrar-borrar-button').show();
    });
    e.preventDefault();
  });

  /*******para gestionar tipos de eventos******/
  function buscarTiposEventos() {
    funcion='get_tipos_evento';
    $.post('../controlador/configuracionController.php', {funcion},(response)=>{
      //console.log(response);
      const tipos= JSON.parse(response);
      let template='';
      tipos.forEach(tipo => {
        template+=`
				<tr id="${tipo.id}" funcion="borrar_tipo_evento" nombre="${tipo.nombre}">
					<td>${tipo.nombre}</td>
					<td><button funcion="editar_tipo_evento" class="editar-tipo-evento btn btn-sm btn-success" data-toggle="modal" data-target="#editar_nombre"><i class="fas fa-pencil-alt"></i></button>
              <button class="borrar-tipo-evento btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmar_eliminacion"><i class="fas fa-times-circle"></i></button></td>
				</tr>
			`;
      });
      $('#tipos_evento_tabla').html(template);
    });
  }

  $('#form-add-tipo-evento').submit(e=>{
    let nombre=$('#nuevoTipoEvento').val();
    funcion='add_tipo_evento';
    $.post('../controlador/configuracionController.php', {nombre, funcion},(response)=>{
      if(response=='add'){
        toastr.success('Tipo de evento añadido.', 'Éxito');
        buscarTiposEventos();
      }
      if(response=='no-add'){
        toastr.error('No se pudo añadir.', 'Error');
      }
      $('#form-add-tipo-evento').trigger('reset');
    });
    e.preventDefault();
  });

  $(document).on('click', '.borrar-tipo-evento',(e)=>{
    let elemento=$(this)[0].activeElement.parentElement.parentElement;
    let id=$(elemento).attr('id');
    let nombre=$(elemento).attr('nombre');
    let funcion=$(elemento).attr('funcion');
    $('#id_borrar').val(id);
    $('#texto-borrar').html(`<div>Confirma la eliminación del tipo de evento <b>${nombre}</b>?</div>`);
    $('#funcion').val(funcion);
  });

  $(document).on('click', '.editar-tipo-evento',(e)=>{
    $('#submit-editar-button').show();
    $('#cancelar-editar-button').show();
    $('#cerrar-editar-button').hide();
    let elemento=$(this)[0].activeElement.parentElement.parentElement;
    let elemento2=$(this)[0].activeElement;
    let id=$(elemento).attr('id');
    let nombre=$(elemento).attr('nombre');
    let funcion=$(elemento2).attr('funcion');
    $('#id_editar').val(id);
    $('#nombre_editar').val(nombre);
    $('#funcion_editar').val(funcion);
  });

  /*******para gestionar timelines******/
  function buscarTimelines() {
    funcion='get_timelines';
    $.post('../controlador/configuracionController.php', {funcion},(response)=>{
      //console.log(response);
      const tipos= JSON.parse(response);
      let template='';
      tipos.forEach(tipo => {
        template+=`
				<tr id="${tipo.id}" nombre="${tipo.nombre}">
					<td>${tipo.nombre}</td>
					<td><button funcion="editar_timeline" class="editar-timeline btn btn-sm btn-success" data-toggle="modal" data-target="#editar_nombre"><i class="fas fa-pencil-alt"></i></button>
              <button funcion="borrar_timeline" class="borrar-timeline btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmar_eliminacion"><i class="fas fa-times-circle"></i></button></td>
				</tr>
			`;
      });
      $('#timelines_tabla').html(template);
    });
  }

  $('#form-add-timeline').submit(e=>{
    let nombre=$('#nuevoTimeline').val();
    funcion='add_timeline';
    $.post('../controlador/configuracionController.php', {nombre, funcion},(response)=>{
      if(response=='add'){
        toastr.success('Cronología añadida.', 'Éxito');
        buscarTimelines();
      }
      if(response=='no-add'){
        toastr.error('No se pudo añadir.', 'Error');
      }
      $('#form-add-timeline').trigger('reset');
    });
    e.preventDefault();
  });

  $(document).on('click', '.borrar-timeline',(e)=>{
    let elemento=$(this)[0].activeElement.parentElement.parentElement;
    let elemento2=$(this)[0].activeElement;
    let id=$(elemento).attr('id');
    let nombre=$(elemento).attr('nombre');
    let funcion=$(elemento2).attr('funcion');
    $('#id_borrar').val(id);
    $('#texto-borrar').html(`<div>Confirma la eliminación de la cronología <b>${nombre}</b>?</div>`);
    $('#funcion').val(funcion);
  });

  $(document).on('click', '.editar-timeline',(e)=>{
    $('#submit-editar-button').show();
    $('#cancelar-editar-button').show();
    $('#cerrar-editar-button').hide();
    let elemento=$(this)[0].activeElement.parentElement.parentElement;
    let elemento2=$(this)[0].activeElement;
    let id=$(elemento).attr('id');
    let nombre=$(elemento).attr('nombre');
    let funcion=$(elemento2).attr('funcion');
    $('#id_editar').val(id);
    $('#nombre_editar').val(nombre);
    $('#funcion_editar').val(funcion);
  });
});