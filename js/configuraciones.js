$(document).ready(function(){
  buscarTiposEventos();
  buscarTimelines();
  buscarTiposOrganizaciones();
  buscarTiposAsentamientos();
  buscarTiposLugar();
  buscarTiposConflicto();

  //para evitar que los mensajes toastr se acumulen en pantalla
  toastr.options={
    "preventDuplicates": true
  }

  /*******comunes para todos******/
  $('#form-editar-nombre').submit(e=>{
    let id=$('#id_editar').val();
    let nombre=$('#nombre_editar').val();
    let tipo=$('#funcion_editar').val();
    let funcion='edit_tipo';
    $.post('../controlador/configuracionController.php', {id, nombre, funcion, tipo},(response)=>{
      if(response=='edit'){
        toastr.success('Elemento editado.', 'Éxito');
        if(tipo=='evento'){
          buscarTiposEventos();
        }
        if(tipo=='timeline'){
          buscarTimelines();
        }
        if(tipo=='organizacion'){
          buscarTiposOrganizaciones();
        }
        if(tipo=='asentamiento'){
          buscarTiposAsentamientos();
        }
        if(tipo=='lugar'){
          buscarTiposLugar();
        }
        if(tipo=='conflicto'){
          buscarTiposConflicto();
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
    let tipo=$('#funcion').val();
    let funcion='delete_tipo';
    $.post('../controlador/configuracionController.php', {id, funcion, tipo},(response)=>{
      if(response=='borrado'){
        toastr.success('Elemento borrado.', 'Éxito');
        if(tipo=='evento'){
          buscarTiposEventos();
        }
        if(tipo=='timeline'){
          buscarTimelines();
        }
        if(tipo=='organizacion'){
          buscarTiposOrganizaciones();
        }
        if(tipo=='asentamiento'){
          buscarTiposAsentamientos();
        }
        if(tipo=='lugar'){
          buscarTiposLugar();
        }
        if(tipo=='conflicto'){
          buscarTiposConflicto();
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

  $(document).on('click', '.editar-tipo',(e)=>{
    $('#submit-editar-button').show();
    $('#cancelar-editar-button').show();
    $('#cerrar-editar-button').hide();
    let elemento=$(this)[0].activeElement.parentElement.parentElement;
    let id=$(elemento).attr('id');
    let tipo=$(elemento).attr('tipo');
    let nombre=$(elemento).attr('nombre');
    $('#id_editar').val(id);
    $('#nombre_editar').val(nombre);
    $('#funcion_editar').val(tipo);
  });
  
  $(document).on('click', '.borrar-tipo',(e)=>{
    $('#confirmar-borrar-button').show();
    $('#cancelar-borrar-button').show();
    $('#cerrar-borrar-button').hide();
    let elemento=$(this)[0].activeElement.parentElement.parentElement;
    let id=$(elemento).attr('id');
    let tipo=$(elemento).attr('tipo');
    let nombre=$(elemento).attr('nombre');
    $('#id_borrar').val(id);
    $('#texto-borrar').html(`<div>Confirma la eliminación del tipo <b>${nombre}</b>?</div>`);
    $('#funcion').val(tipo);
  });

  /*******para cargar tipos******/
  function buscarTiposEventos() {
    funcion='get_tipos_evento';
    $.post('../controlador/configuracionController.php', {funcion},(response)=>{
      const tipos= JSON.parse(response);
      let template='';
      tipos.forEach(tipo => {
        template+=`
				<tr id="${tipo.id}" tipo="evento" nombre="${tipo.nombre}">
					<td>${tipo.nombre}</td>
					<td><button class="editar-tipo btn btn-sm btn-success" data-toggle="modal" data-target="#editar_nombre"><i class="fas fa-pencil-alt"></i></button>
          <button class="borrar-tipo btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmar_eliminacion"><i class="fas fa-times-circle"></i></button></td>
				</tr>
			`;
      });
      $('#tipos_evento_tabla').html(template);
    });
  }
  function buscarTimelines() {
    funcion='get_timelines';
    $.post('../controlador/configuracionController.php', {funcion},(response)=>{
      const tipos= JSON.parse(response);
      let template='';
      tipos.forEach(tipo => {
        template+=`
				<tr id="${tipo.id}" tipo="timeline" nombre="${tipo.nombre}">
					<td>${tipo.nombre}</td>
					<td><button class="editar-tipo btn btn-sm btn-success" data-toggle="modal" data-target="#editar_nombre"><i class="fas fa-pencil-alt"></i></button>
          <button class="borrar-tipo btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmar_eliminacion"><i class="fas fa-times-circle"></i></button></td>
				</tr>
			`;
      });
      $('#timelines_tabla').html(template);
    });
  }
  function buscarTiposOrganizaciones() {
    funcion='get_tipos_organizacion';
    $.post('../controlador/configuracionController.php', {funcion},(response)=>{
      const tipos= JSON.parse(response);
      let template='';
      tipos.forEach(tipo => {
        template+=`
				<tr id="${tipo.id}" tipo="organizacion" nombre="${tipo.nombre}">
					<td>${tipo.nombre}</td>
					<td><button class="editar-tipo btn btn-sm btn-success" data-toggle="modal" data-target="#editar_nombre"><i class="fas fa-pencil-alt"></i></button>
          <button class="borrar-tipo btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmar_eliminacion"><i class="fas fa-times-circle"></i></button></td>
				</tr>
			`;
      });
      $('#tipos_organizacion_tabla').html(template);
    });
  }
  function buscarTiposAsentamientos() {
    funcion='get_tipos_asentamiento';
    $.post('../controlador/configuracionController.php', {funcion},(response)=>{
      const tipos= JSON.parse(response);
      let template='';
      tipos.forEach(tipo => {
        template+=`
				<tr id="${tipo.id}" tipo="asentamiento" nombre="${tipo.nombre}">
					<td>${tipo.nombre}</td>
					<td><button class="editar-tipo btn btn-sm btn-success" data-toggle="modal" data-target="#editar_nombre"><i class="fas fa-pencil-alt"></i></button>
          <button class="borrar-tipo btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmar_eliminacion"><i class="fas fa-times-circle"></i></button></td>
				</tr>
			`;
      });
      $('#tipos_asentamiento_tabla').html(template);
    });
  }
  function buscarTiposLugar() {
    funcion='get_tipos_lugar';
    $.post('../controlador/configuracionController.php', {funcion},(response)=>{
      const tipos= JSON.parse(response);
      let template='';
      tipos.forEach(tipo => {
        template+=`
        <tr id="${tipo.id}" tipo="lugar" nombre="${tipo.nombre}">
          <td>${tipo.nombre}</td>
          <td><button class="editar-tipo btn btn-sm btn-success" data-toggle="modal" data-target="#editar_nombre"><i class="fas fa-pencil-alt"></i></button>
          <button class="borrar-tipo btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmar_eliminacion"><i class="fas fa-times-circle"></i></button></td>
        </tr>
      `;
      });
      $('#tipos_lugares_tabla').html(template);
    });
  }
  function buscarTiposConflicto() {
    funcion='get_tipos_conflicto';
    $.post('../controlador/configuracionController.php', {funcion},(response)=>{
      const tipos= JSON.parse(response);
      let template='';
      tipos.forEach(tipo => {
        template+=`
        <tr id="${tipo.id}" tipo="conflicto" nombre="${tipo.nombre}">
          <td>${tipo.nombre}</td>
          <td><button class="editar-tipo btn btn-sm btn-success" data-toggle="modal" data-target="#editar_nombre"><i class="fas fa-pencil-alt"></i></button>
          <button class="borrar-tipo btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmar_eliminacion"><i class="fas fa-times-circle"></i></button></td>
        </tr>
      `;
      });
      $('#tipos_conflicto_tabla').html(template);
    });
  }
  
  /***************add-forms******************/
  $('#form-add-tipo-evento').submit(e=>{
    let nombre=$('#nuevoTipoEvento').val();
    funcion='add_tipo';
    tipo='evento';
    $.post('../controlador/configuracionController.php', {nombre, funcion, tipo},(response)=>{
      console.log(response);
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

  $('#form-add-timeline').submit(e=>{
    let nombre=$('#nuevoTimeline').val();
    funcion='add_tipo';
    tipo='timeline';
    $.post('../controlador/configuracionController.php', {nombre, funcion, tipo},(response)=>{
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

  $('#form-add-tipo-organizacion').submit(e=>{
    let nombre=$('#nuevoTipoOrganizacion').val();
    funcion='add_tipo';
    tipo='organizacion';
    $.post('../controlador/configuracionController.php', {nombre, funcion, tipo},(response)=>{
      if(response=='add'){
        toastr.success('Tipo de organización añadida.', 'Éxito');
        buscarTiposOrganizaciones();
      }
      if(response=='no-add'){
        toastr.error('No se pudo añadir.', 'Error');
      }
      $('#form-add-tipo-organizacion').trigger('reset');
    });
    e.preventDefault();
  });

  $('#form-add-tipo-asentamiento').submit(e=>{
    let nombre=$('#nuevoTipoAsentamiento').val();
    funcion='add_tipo';
    tipo='asentamiento';
    $.post('../controlador/configuracionController.php', {nombre, funcion, tipo},(response)=>{
      if(response=='add'){
        toastr.success('Tipo de asentamiento añadido.', 'Éxito');
        buscarTiposAsentamientos();
      }
      if(response=='no-add'){
        toastr.error('No se pudo añadir.', 'Error');
      }
      $('#form-add-tipo-asentamiento').trigger('reset');
    });
    e.preventDefault();
  });

  $('#form-add-tipo-lugar').submit(e=>{
    let nombre=$('#nuevoTipoLugar').val();
    funcion='add_tipo';
    tipo='lugar';
    $.post('../controlador/configuracionController.php', {nombre, funcion, tipo},(response)=>{
      if(response=='add'){
        toastr.success('Tipo de lugar añadido.', 'Éxito');
        buscarTiposLugar();
      }
      if(response=='no-add'){
        toastr.error('No se pudo añadir.', 'Error');
      }
      $('#form-add-tipo-lugar').trigger('reset');
    });
    e.preventDefault();
  });

  $('#form-add-tipo-conflicto').submit(e=>{
    let nombre=$('#nuevoTipoConflicto').val();
    funcion='add_tipo';
    tipo='conflicto';
    $.post('../controlador/configuracionController.php', {nombre, funcion, tipo},(response)=>{
      if(response=='add'){
        toastr.success('Tipo de conflicto añadido.', 'Éxito');
        buscarTiposConflicto();
      }
      if(response=='no-add'){
        toastr.error('No se pudo añadir.', 'Error');
      }
      $('#form-add-tipo-conflicto').trigger('reset');
    });
    e.preventDefault();
  });
});