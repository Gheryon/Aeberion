$(document).ready(function () {
  var funcion = '';
  var id_lugar_editar = $('#id_geografia_editar').val();
  //si id_lugar_editar está definido, se va a editar una entrada
  if (id_lugar_editar != undefined) {
    fill_select_tipo();
    buscar_lugar_editar(id_lugar_editar);
  }

  function fill_select_tipo(){
    funcion='get_tipos_lugar';
    $.post('../controlador/configuracionController.php', {funcion},(response)=>{
      let tipos=JSON.parse(response);
      let template='';
      tipos.forEach(tipo=>{
        template+=`
        <option value="${tipo.id}">${tipo.nombre}</option>
        `;
      });
      $('#tipo_select').html(template);
    })
  }

  $('#form-create-lugar').submit(e => {
    let nombre = $('#nombre_lugar').val();
    let tipo = $('#tipo_select').val();
    let descripcion = $('#descripcion_breve').val();
    let otros_nombres = $('#otros_nombres').val();
    let geografia = $('#geografia').val();
    let ecosistema = $('#ecosistema').val();
    let clima = $('#clima').val();
    let flora_fauna = $('#flora_fauna').val();
    let recursos = $('#recursos').val();
    let historia = $('#historia').val();
    let otros = $('#otros').val();
    funcion = 'crear_nuevo_lugar';
    $.post('../controlador/lugaresController.php', { nombre, tipo, descripcion, otros_nombres, geografia, ecosistema, clima, flora_fauna, recursos, historia, otros, funcion }, (response) => {
      if (response == 'add') {
        $('#add').hide('slow');
        $('#add').show(1000);
        $('#add').hide(3000);
        $('#form-create-lugar').trigger('reset');
        $('#submit-crear-button').hide();
        $('#cancelar-crear-button').hide();
        $('#volver-crear-button').show();
      } else {
        $('#no-add').hide('slow');
        $('#no-add').show(1000);
        $('#no-add').hide(3000);
        $('#form-create-lugar').trigger('reset');
      }
    });
    //para prevenir la actualización por defecto de la página
    e.preventDefault();
  });

  $(document).on('keyup', '#buscar', function () {
    let valor = $(this).val();
    if (valor != "") {
      buscar_lugares(valor);
    } else {
      buscar_lugares();
    }
  });

  function buscar_lugar_editar(dato) {
    funcion = 'buscar_lugar';
    $.post('../controlador/lugaresController.php', { dato, funcion }, (response) => {
      //console.log(response);
      const lugar = JSON.parse(response);
      $('#nombre_lugar').val(lugar.nombre);
      $('#descripcion_breve').summernote('code', lugar.descripcion);
      $('#otros_nombres').summernote('code', lugar.otros_nombres);
      $('#tipo_select').val(lugar.id_tipo);
      $('#geografia').summernote('code', lugar.geografia);
      $('#ecosistema').summernote('code', lugar.ecosistema);
      $('#clima').summernote('code', lugar.clima);
      $('#flora_fauna').summernote('code', lugar.flora_fauna);
      $('#recursos').summernote('code', lugar.recursos);
      $('#historia').summernote('code', lugar.historia);
      $('#otros').summernote('code', lugar.otros);

      $('#id_lugar_editar').val(lugar.id);
      $('#id_lugar_borrar').val(lugar.id);
      $('#nombre_lugar_borrar').val(lugar.nombre);
    });
  }

  $('#form-editar-lugar').submit(e => {
    funcion = 'editar_lugar';
    let nombre = $('#nombre_lugar').val();
    let tipo = $('#tipo_select').val();
    let descripcion = $('#descripcion_breve').val();
    let otros_nombres = $('#otros_nombres').val();
    let geografia = $('#geografia').val();
    let ecosistema = $('#ecosistema').val();
    let clima = $('#clima').val();
    let flora_fauna = $('#flora_fauna').val();
    let recursos = $('#recursos').val();
    let historia = $('#historia').val();
    let otros = $('#otros').val();
    let id_lugar = $('#id_geografia_editar').val();
    $.post('../controlador/lugaresController.php', { id_lugar, nombre, tipo, descripcion, otros_nombres, geografia, ecosistema, clima, flora_fauna, recursos, historia, otros, funcion }, (response) => {
      if (response == 'editado') {
        $('#editado').hide('slow');
        $('#editado').show(1000);
        $('#editado').hide(3000);
        $('#form-editar-lugar').trigger('reset');
        $('#submit-editar-button').hide();
        $('#cancelar-editar-button').hide();
        $('#volver-editar-button').show();
      } else {
        $('#no-editado').hide('slow');
        $('#no-editado').show(1000);
        $('#no-editado').hide(3000);
        $('#form-editar-lugar').trigger('reset');
      }
    })
    e.preventDefault();
  });

  $(document).on('click', '.borrar-lugar', (e) => {
    funcion = 'borrar_lugar';
    //se quiere acceder al elemento lugarId de la card y guardarlo en elemento, para ello hay que subir 4 veces desde donde está el boton ascender
    const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id = $(elemento).attr('lugarId');
    const nombre = $(elemento).attr('lugarNombre');
    $('#id_lugar_borrar').val(id);
    $('#nombre_lugar_borrar').val(nombre);
    $('#funcion').val(funcion);
  });

  $('#form-borrar-lugar').submit(e => {
    let id_lugar = $('#id_lugar_borrar').val();
    funcion = $('#funcion').val();
    $.post('../controlador/lugaresController.php', { id_lugar, funcion }, (response) => {
      if (response == 'borrado') {
        $('#borrado').hide('slow');
        $('#borrado').show(1000);
        $('#borrado').hide(3000);
        $('#form-borrar-lugar').trigger('reset');
        $('#borrar-volver-button').show();
        $('#borrar-button').hide();
        //$('#cancelar-editar-button').hide();
        $('#texto-borrar').hide('slow');
        buscar_lugares();
      } else {
        $('#no-borrado').hide('slow');
        $('#no-borrado').show(1000);
        $('#no-borrado').hide(3000);
        $('#form-borrar-lugar').trigger('reset');
      }
    });
    e.preventDefault();
  });
})

function buscar_lugares(consulta) {
  funcion = 'buscar_lugares';
  $('#busqueda-nav').show();
  $('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark">Inicio</a>
  <a href="createLugar.php" class="btn btn-dark">Nuevo</a>`);
  $.post('../controlador/lugaresController.php', { consulta, funcion }, (response) => {
    const lugares = JSON.parse(response);
    let template = '';
    lugares.forEach(lugar => {
      template += `
      <div lugarId="${lugar.id}" lugarNombre="${lugar.nombre}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
        <div class="card-header text-muted border-bottom-0">
      </div>
      <div class="card-body pt-0">
        <div class="row">
          <div class="col">
            <h2 class="lead"><b>${lugar.nombre}</b></h2>
            <p class="text-muted text-sm"><b>Descripción breve: </b> ${lugar.descripcion} </p>
            <ul class="ml-4 mb-0 fa-ul text-muted">
            <li class="small"><span class="fa-li"><i class="fa-solid fa-mountain-sun"></i></span> Tipo: ${lugar.tipo}</li>
            </ul>
          </div>
          <div class="small-box bg-success">
            <div class="icon">
                <i class="fas fa-tree"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-right">
          <button class="detalles-lugar btn btn-info btn-sm" type="button">
          <a href="vistaContent.php?id=${lugar.id}&tipo=6" class="text-reset"><i class="fas fa-id-card mr-1"></i>Detalles</a>
          </button>
          <form class="btn" action="editarLugar.php" method="post">
            <button class="editar-lugar btn btn-success btn-sm">
            <i class="fas fa-pencil-alt mr-1"></i>Editar</button>
            <input type="hidden" name="id_geografia" value="${lugar.id}">
          </form>
          <button class="borrar-lugar btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#eliminarLugar">
              <i class="fas fa-trash mr-1"></i>Eliminar
          </button>
        </div>
      </div>
    </div>
    </div>
        `;
    });
    $('#lugares').html(template);
  });
}