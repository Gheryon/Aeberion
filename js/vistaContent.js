$(document).ready(function(){

})

function loadContent(tipo, id){
  console.log(tipo+' '+id);
  if(tipo==1){
    ver_personaje(id);
  }
  if(tipo==2){
    ver_especie(id);
  }
  if(tipo==3){
    ver_institucion(id);
  }
  if(tipo==4){
    ver_religion(id);
  }
  if(tipo==5){
    ver_asentamiento(id);
  }
  if(tipo==6){
    ver_lugar(id);
  }
  if(tipo==7){
    ver_conflicto(id);
  }
}

function ver_personaje(dato) {
  funcion='buscar_personaje';
  $.post('../controlador/personajeController.php', {dato, funcion},(response)=>{
    const personaje= JSON.parse(response);
    $('#nav-buttons').html(`<a href="../vista/personajes.php" class="btn btn-dark ml-2">Volver</a>
    <form class="btn" action="editarPersonaje.php" method="post">
      <button class="btn btn-dark mr-1">Editar</button>
      <input type="hidden" name="id" value="${personaje.id}">
    </form>`);
    $('#content-title').html(personaje.nombre);
    let template='';
    template+=`<h1>${personaje.nombre}`;
    if(personaje.nombreFamilia!=null){
      template+=` ${personaje.nombreFamilia}`;
    }
    if(personaje.apellidos!=null){
      template+=` ${personaje.apellidos}`;
    }
    template+=`</h1>`;
    $('#content-title-h1').html(template);
    template='';
    if(personaje.descripcionShort!=undefined){
      template+=`
      <div class="row">
        <h3>Descripción breve</h3>
        <div class="row ml-2 mr-2">
        ${personaje.descripcionShort}
        </div>
      </div>`;
    }
    template+=`<h2>Descripción</h2>`;
    if(personaje.descripcion!=undefined){
      template+=`
      <div class="row">
        <h3>Descripción física</h3>
        <div class="row ml-2 mr-2">
        ${personaje.descripcion}
        </div>
      </div>`;
    }
    if(personaje.personalidad!=undefined){
      template+=`
      <div class="row">
        <h3>Personalidad</h3>
        <div class="row ml-2 mr-2">
        ${personaje.personalidad}
        </div>
      </div>`;
    }
    if(personaje.deseos!=undefined){
      template+=`
      <div class="row">
        <h3>Deseos</h3>
        <div class="row ml-2 mr-2">
        ${personaje.deseos}
        </div>
      </div>`;
    }
    if(personaje.miedos!=undefined){
      template+=`
      <div class="row">
        <h3>Miedos</h3>
        <div class="row ml-2 mr-2">
        ${personaje.miedos}
        </div>
      </div>`;
    }
    if(personaje.magia!=undefined){
      template+=`
      <div class="row">
        <h3>Habilidades mágicas</h3>
        <div class="row ml-2 mr-2">
        ${personaje.magia}
        </div>
      </div>`;
    }
    if(personaje.educacion!=undefined){
      template+=`
      <div class="row">
        <h3>Educación</h3>
        <div class="row ml-2 mr-2">
        ${personaje.educacion}
        </div>
      </div>`;
    }
    if(personaje.historia!=undefined){
      template+=`
      <h2>Historia</h2>
      <div class="row">
        <div class="row ml-2 mr-2">
        ${personaje.historia}
        </div>
      </div>`;
    }
    template+=`
    <h2>Aspectos sociales</h2>`;
    if(personaje.religion!=undefined){
      template+=`
      <div class="row">
        <h3>Religión</h3>
        <div class="row ml-2 mr-2">
        ${personaje.religion}
        </div>
      </div>`;
    }
    if(personaje.familia!=undefined){
      template+=`
      <div class="row">
        <h3>Familia</h3>
        <div class="row ml-2 mr-2">
        ${personaje.familia}
        </div>
      </div>`;
    }
    if(personaje.politica!=undefined){
      template+=`
      <div class="row">
        <h3>Política</h3>
        <div class="row ml-2 mr-2">
        ${personaje.politica}
        </div>
      </div>`;
    }
    if(personaje.otros!=undefined){
      template+=`
      <h2>Otros</h2>
      <div class="row">
        <h3>Otros</h3>
        <div class="row ml-2 mr-2">
        ${personaje.otros}
        </div>
      </div>`;
    }
    $('#content-left').html(template);
    
    //datos de la card
    template='';
    template+=`
    <div class="row">
      <h3>Retrato</h3>
      <div class="row">
        <img alt="retrato" id="retrato" class="img-fluid" src="${personaje.retrato}" width="300" height="300">
      </div>
    </div>`;
    if(personaje.nombreEspecie!=undefined){
      template+=`
      <div class="row">
        <h3>Especie</h3>
        <div class="row ml-2 mr-2">
        <a href="../vista/vistaContent.php?id_especie=${personaje.id_especie}">${personaje.nombreEspecie}</a>
        
        </div>
      </div>`;
    }
    if(personaje.sexo!=undefined){
      template+=`
      <div class="row">
        <h3>Sexo</h3>
        <div class="row ml-2 mr-2">
        ${personaje.sexo}
        </div>
      </div>`;
    }
    if(personaje.lugarNacimiento!=undefined){
      template+=`
      <div class="row">
        <h3>Lugar de nacimiento</h3>
        <div class="row ml-2 mr-2">
        ${personaje.lugarNacimiento}
        </div>
      </div>`;
    }
    $('#content-right').html(template);
  });
}

function ver_especie(dato) {
  funcion='buscar_especie';
  $.post('../controlador/especiesController.php', {dato, funcion},(response)=>{
    const especie= JSON.parse(response);
    $('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark ml-2">Volver</a>
    <form class="btn" action="editarEspecie.php" method="post">
      <button class="btn btn-dark mr-1">Editar</button>
      <input type="hidden" name="id_especie" value="${especie.id_especie}">
    </form>`);
    $('#content-title').html(especie.nombre);
    let template=`<h1>${especie.nombre}</h1>`;
    $('#content-title-h1').html(template);
    template='';
    template+=`
    <h2>Anatomía y morfología</h2>`;
    if(especie.anatomia!=undefined){
      template+=`
      <div class="row">
        <h3>Descripción anatómica</h3>
        <div class="row ml-2 mr-2">
        ${especie.anatomia}
        </div>
      </div>`;
    }
    if(especie.alimentacion!=undefined){
      template+=`
      <div class="row">
        <h3>Alimentación</h3>
        <div class="row ml-2 mr-2">
        ${especie.alimentacion}
        </div>
      </div>`;
    }
    if(especie.reproduccion!=undefined){
      template+=`
      <div class="row">
        <h3>Reproducción y crecimiento</h3>
        <div class="row ml-2 mr-2">
        ${especie.reproduccion}
        </div>
      </div>`;
    }
    template+=`
    <h2>Hábitats y usos</h2>`;
    if(especie.distribucion!=undefined){
      template+=`
      <div class="row">
        <h3>Distribución y hábitats</h3>
        <div class="row ml-2 mr-2">
        ${especie.distribucion}
        </div>
      </div>`;
    }
    if(especie.habilidades!=undefined){
      template+=`
      <div class="row">
        <h3>Habilidades</h3>
        <div class="row ml-2 mr-2">
        ${especie.habilidades}
        </div>
      </div>`;
    }
    if(especie.domesticacion!=undefined){
      template+=`
      <div class="row">
        <h3>Domesticación</h3>
        <div class="row ml-2 mr-2">
        ${especie.domesticacion}
        </div>
      </div>`;
    }
    if(especie.explotacion!=undefined){
      template+=`
      <div class="row">
        <h3>Explotación</h3>
        <div class="row ml-2 mr-2">
        ${especie.explotacion}
        </div>
      </div>`;
    }
    template+=`
    <h2>Otros</h2>`;
    if(especie.otros!=undefined){
      template+=`
      <div class="row">
        <h3>Otros</h3>
        <div class="row ml-2 mr-2">
        ${especie.otros}
        </div>
      </div>`;
    }
    $('#content-left').html(template);
    
    //datos de la card
    template='';
    if(especie.vida!=undefined){
      template+=`
      <div class="row">
        <h3>Vida media</h3>
        <div class="row ml-2 mr-2">
        ${especie.vida}
        </div>
      </div>`;
    }
    if(especie.altura!=undefined){
      template+=`
      <div class="row">
        <h3>Altura</h3>
        <div class="row ml-2 mr-2">
        ${especie.altura}
        </div>
      </div>`;
    }
    if(especie.peso!=undefined){
      template+=`
      <div class="row">
        <h3>Peso</h3>
        <div class="row ml-2 mr-2">
        ${especie.peso}
        </div>
      </div>`;
    }
    if(especie.longitud!=undefined){
      template+=`
      <div class="row">
        <h3>Longitud</h3>
        <div class="row ml-2 mr-2">
        ${especie.longitud}
        </div>
      </div>`;
    }
    if(especie.estatus!=undefined){
      template+=`
      <div class="row">
        <h3>Estatus</h3>
        <div class="row ml-2 mr-2">
        ${especie.estatus}
        </div>
      </div>`;
    }
    $('#content-right').html(template);
  });
}

function ver_institucion(dato) {
  funcion='ver_institucion';
  $.post('../controlador/institucionesController.php', {dato, funcion},(response)=>{
    console.log(response);
    const institucion= JSON.parse(response);
    $('#nav-buttons').html(`<a href="paises.php" class="btn btn-dark">Volver</a>
    <form class="btn" action="createInstitucion.php" method="post">
      <button class="btn btn-dark mr-1">Editar</button>
      <input type="hidden" name="id_institucion" value="${institucion.id}">
    </form>`);
    $('#content-title').html(institucion.nombre);
    let template=`<h1>${institucion.nombre}</h1>`;
    $('#content-title-h1').html(template);
    template='';
    if(institucion.descripcion!=undefined){
      template+=`
      <div class="row">
        <h3>Descripción</h3>
        <div class="row ml-2 mr-2">
        ${institucion.descripcion}
        </div>
      </div>`;
    }
    if(institucion.historia!=undefined){
      template+=`
      <div class="row">
        <h3>Historia</h3>
        <div class="row ml-2 mr-2">
        ${institucion.historia}
        </div>
      </div>`;
    }
    if(institucion.demografia!=undefined){
      template+=`
      <div class="row">
        <h3>Demografía</h3>
        <div class="row ml-2 mr-2">
        ${institucion.demografia}
        </div>
      </div>`;
    }
    if(institucion.estructura!=undefined){
      template+=`
      <div class="row">
        <h3>Estructura organizativa</h3>
        <div class="row ml-2 mr-2">
        ${institucion.estructura}
        </div>
      </div>`;
    }
    if(institucion.politica!=undefined){
      template+=`
      <div class="row">
        <h3>Política exterior e interior</h3>
        <div class="row ml-2 mr-2">
        ${institucion.politica}
        </div>
      </div>`;
    }
    if(institucion.clima!=undefined){
      template+=`
      <div class="row">
        <h3>Clima</h3>
        <div class="row ml-2 mr-2">
        ${institucion.clima}
        </div>
      </div>`;
    }
    if(institucion.frontera!=undefined){
      template+=`
      <div class="row">
        <h3>Fronteras</h3>
        <div class="row ml-2 mr-2">
        ${institucion.frontera}
        </div>
      </div>`;
    }
    if(institucion.militar!=undefined){
      template+=`
      <div class="row">
        <h3>Militar</h3>
        <div class="row ml-2 mr-2">
        ${institucion.militar}
        </div>
      </div>`;
    }
    if(institucion.religion!=undefined){
      template+=`
      <div class="row">
        <h3>Religión</h3>
        <div class="row ml-2 mr-2">
        ${institucion.religion}
        </div>
      </div>`;
    }
    if(institucion.cultura!=undefined){
      template+=`
      <div class="row">
        <h3>Cultura</h3>
        <div class="row ml-2 mr-2">
        ${institucion.cultura}
        </div>
      </div>`;
    }
    if(institucion.educacion!=undefined){
      template+=`
      <div class="row">
        <h3>Educación</h3>
        <div class="row ml-2 mr-2">
        ${institucion.educacion}
        </div>
      </div>`;
    }
    if(institucion.territorio!=undefined){
      template+=`
      <div class="row">
        <h3>Territorio</h3>
        <div class="row ml-2 mr-2">
        ${institucion.territorio}
        </div>
      </div>`;
    }
    if(institucion.economia!=undefined){
      template+=`
      <div class="row">
        <h3>Economía</h3>
        <div class="row ml-2 mr-2">
        ${institucion.economia}
        </div>
      </div>`;
    }
    if(institucion.recursos!=undefined){
      template+=`
      <div class="row">
        <h3>Recursos naturales</h3>
        <div class="row ml-2 mr-2">
        ${institucion.recursos}
        </div>
      </div>`;
    }
    if(institucion.tecnologia!=undefined){
      template+=`
      <div class="row">
        <h3>Tecnología y ciencia</h3>
        <div class="row ml-2 mr-2">
        ${institucion.tecnologia}
        </div>
      </div>`;
    }
    if(institucion.otros!=undefined){
      template+=`
      <div class="row">
        <h3>Otros</h3>
        <div class="row ml-2 mr-2">
        ${institucion.otros}
        </div>
      </div>`;
    }
    $('#content-left').html(template);

    //datos de la card
    //$('#escudo').attr('src',institucion.escudo);
    template='';
    template+=`
    <div class="row">
      <h3>Escudo</h3>
      <div class="row">
        <img alt="escudo" id="escudo" class="img-fluid" src="${institucion.escudo}" width="300" height="300">
      </div>
    </div>`;
    if(institucion.tipo!=undefined){
      template+=`
      <div class="row">
        <h3>Tipo</h3>
        <div class="row ml-2 mr-2">
        ${institucion.tipo}
        </div>
      </div>`;
    }
    if(institucion.gentilicio!=undefined){
      template+=`
      <div class="row">
        <h3>Gentilicio</h3>
        <div class="row ml-2 mr-2">
        ${institucion.gentilicio}
        </div>
      </div>`;
    }
    if(institucion.capital!=undefined){
      template+=`
      <div class="row">
        <h3>Capital</h3>
        <div class="row ml-2 mr-2">
        ${institucion.capital}
        </div>
      </div>`;
    }
    if(institucion.lema!=undefined){
      template+=`
      <div class="row">
        <h3>Lema</h3>
        <div class="row ml-2 mr-2">
        ${institucion.lema}
        </div>
      </div>`;
    }
    if(institucion.fundacion!=undefined){
      template+=`
      <div class="row">
        <h3>Fundación</h3>
        <div class="row ml-2 mr-2">
        ${institucion.fundacion}
        </div>
      </div>`;
    }
    if(institucion.disolucion!=undefined){
      template+=`
      <div class="row">
        <h3>Disolución</h3>
        <div class="row ml-2 mr-2">
        ${institucion.disolucion}
        </div>
      </div>`;
    }
    $('#content-right').html(template);
  });
}

function ver_religion(dato) {
  funcion='ver_religion';
  $.post('../controlador/institucionesController.php', {dato, funcion},(response)=>{
    //console.log(response);
    const religion= JSON.parse(response);
    $('#nav-buttons').html(`<a href="../index.php" class="btn btn-dark ml-2">Volver</a>
    <form class="btn" action="createReligion.php" method="post">
      <button class="btn btn-dark mr-1">Editar</button>
      <input type="hidden" name="id_religion" value="${religion.id}">
    </form>`);
    let template='';
    template+=`<h1>${religion.nombre}</h1>`;

    $('#content-title').html(religion.nombre);
    $('#content-title-h1').html(template);
    template='';
    if(religion.descripcion!=undefined){
      template+=`
      <div class="row">
        <h3>Descripción</h3>
        <div class="row ml-2 mr-2">
        ${religion.descripcion}
        </div>
      </div>`;
    }
    if(religion.historia!=undefined){
      template+=`
      <div class="row">
        <h3>Historia</h3>
        <div class="row ml-2 mr-2">
        ${religion.historia}
        </div>
      </div>`;
    }
    if(religion.cosmologia!=undefined){
      template+=`
      <div class="row">
        <h3>Cosmología</h3>
        <div class="row ml-2 mr-2">
        ${religion.cosmologia}
        </div>
      </div>`;
    }
    if(religion.doctrina!=undefined){
      template+=`
      <div class="row">
        <h3>Doctrina</h3>
        <div class="row ml-2 mr-2">
        ${religion.doctrina}
        </div>
      </div>`;
    }
    if(religion.deidades!=undefined){
      template+=`
      <div class="row">
        <h3>Deidades</h3>
        <div class="row ml-2 mr-2">
        ${religion.deidades}
        </div>
      </div>`;
    }
    if(religion.elementos_sagrados!=undefined){
      template+=`
      <div class="row">
        <h3>Lugares y objetos sagrados</h3>
        <div class="row ml-2 mr-2">
        ${religion.elementos_sagrados}
        </div>
      </div>`;
    }
    if(religion.cultura!=undefined){
      template+=`
      <div class="row">
        <h3>Fiestas y rituales principales</h3>
        <div class="row ml-2 mr-2">
        ${religion.cultura}
        </div>
      </div>`;
    }
    if(religion.politica!=undefined){
      template+=`
      <div class="row">
        <h3>Influencia política</h3>
        <div class="row ml-2 mr-2">
        ${religion.politica}
        </div>
      </div>`;
    }
    if(religion.estructura!=undefined){
      template+=`
      <div class="row">
        <h3>Estructura</h3>
        <div class="row ml-2 mr-2">
        ${religion.estructura}
        </div>
      </div>`;
    }
    if(religion.sectas!=undefined){
      template+=`
      <div class="row">
        <h3>Sectas conocidas</h3>
        <div class="row ml-2 mr-2">
        ${religion.sectas}
        </div>
      </div>`;
    }
    if(religion.otros!=undefined){
      template+=`
      <div class="row">
        <h3>Otros</h3>
        <div class="row ml-2 mr-2">
        ${religion.otros}
        </div>
      </div>`;
    }
    $('#content-left').html(template);

    //datos de la card
    template='';
    template+=`
    <div class="row">
      <h3>Escudo</h3>
      <div class="row">
        <img alt="escudo" id="escudo" class="img-fluid" src="${religion.escudo}" width="300" height="300">
      </div>
    </div>`;
    if(religion.lema!=undefined){
      template+=`
      <div class="row">
        <h3>Lema</h3>
        <div class="row ml-2 mr-2">
        ${religion.lema}
        </div>
      </div>`;
    }
    if(religion.fundacion!=undefined){
      template+=`
      <div class="row">
        <h3>Fundación</h3>
        <div class="row ml-2 mr-2">
        ${religion.fundacion}
        </div>
      </div>`;
    }
    if(religion.disolucion!=undefined){
      template+=`
      <div class="row">
        <h3>Disolución</h3>
        <div class="row ml-2 mr-2">
        ${religion.disolucion}
        </div>
      </div>`;
    }
    $('#content-right').html(template);
  });
}

function ver_asentamiento(dato) {
  funcion = 'ver_asentamiento';
  $.post('../controlador/asentamientosController.php', { dato, funcion }, (response) => {
    const asentamiento = JSON.parse(response);
    $('#nav-buttons').html(`<a href="asentamientos.php" class="btn btn-dark ml-2">Volver</a>
    <form class="btn" action="createAsentamiento.php" method="post">
      <button class="btn btn-dark mr-1">Editar</button>
      <input type="hidden" name="id_asentamiento" value="${asentamiento.id}">
    </form>`);
    $('#content-title').html(asentamiento.nombre);
    let template=`<h1>${asentamiento.nombre}</h1>`;
    $('#content-title-h1').html(template);
    template = '';
    if (asentamiento.descripcion != undefined) {
      template += `
      <div class="row">
        <h3>Descripción</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.descripcion}
        </div>
      </div>`;
    }
    if (asentamiento.demografia != undefined) {
      template += `
      <div class="row">
        <h3>Demografía</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.demografia}
        </div>
      </div>`;
    }
    if (asentamiento.gobierno != undefined) {
      template += `
      <div class="row">
        <h3>Gobierno</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.gobierno}
        </div>
      </div>`;
    }
    if (asentamiento.infraestructura != undefined) {
      template += `
      <div class="row">
        <h3>Infraestructura</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.infraestructura}
        </div>
      </div>`;
    }
    if (asentamiento.historia != undefined) {
      template += `
      <div class="row">
        <h3>Historia</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.historia}
        </div>
      </div>`;
    }
    if (asentamiento.defensas != undefined) {
      template += `
      <div class="row">
        <h3>Sistemas defensivos</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.defensas}
        </div>
      </div>`;
    }
    if (asentamiento.economia != undefined) {
      template += `
      <div class="row">
        <h3>Economía, industria y comercio</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.economia}
        </div>
      </div>`;
    }
    if (asentamiento.cultura != undefined) {
      template += `
      <div class="row">
        <h3>Cultura y arquitectura</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.cultura}
        </div>
      </div>`;
    }
    if (asentamiento.geografia != undefined) {
      template += `
      <div class="row">
        <h3>Geografía</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.geografia}
        </div>
      </div>`;
    }
    if (asentamiento.clima != undefined) {
      template += `
      <div class="row">
        <h3>Clima</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.clima}
        </div>
      </div>`;
    }
    if (asentamiento.recursos != undefined) {
      template += `
      <div class="row">
        <h3>Recursos</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.recursos}
        </div>
      </div>`;
    }
    if (asentamiento.otros != undefined) {
      template += `
      <div class="row">
        <h3>Otros</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.otros}
        </div>
      </div>`;
    }
    $('#content-left').html(template);

    //datos de la card
    template = '';
    if (asentamiento.gentilicio != undefined) {
      template += `
      <div class="row">
        <h3>Gentilicio</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.gentilicio}
        </div>
      </div>`;
    }
    if (asentamiento.tipo != undefined) {
      template += `
      <div class="row">
        <h3>Tipo</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.tipo}
        </div>
      </div>`;
    }
    if (asentamiento.poblacion != undefined) {
      template += `
      <div class="row">
        <h3>Población</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.poblacion}
        </div>
      </div>`;
    }
    if (asentamiento.fundacion != undefined) {
      template += `
      <div class="row">
        <h3>Fundación</h3>
        <div class="row ml-2 mr-2">
        ${asentamiento.fundacion}
        </div>
      </div>`;
    }
    if (asentamiento.disolucion != undefined) {
      template += `
      <div class="row">
        <h3>Disolución</h3>
        <div class="row ml-2 mr-2">
        ${religion.disolucion}
        </div>
      </div>`;
    }
    $('#content-right').html(template);
  });
}

function ver_lugar(dato) {
  funcion = 'buscar_lugar';
  $.post('../controlador/lugaresController.php', { dato, funcion }, (response) => {
    const lugar = JSON.parse(response);
    $('#nav-buttons').html(`<a href="lugares.php" class="btn btn-dark ml-2">Volver</a>
    <form class="btn" action="editarLugar.php" method="post">
      <button class="btn btn-dark mr-1">Editar</button>
      <input type="hidden" name="id_geografia" value="${lugar.id}">
    </form>`);
    $('#content-title').html(lugar.nombre);
    let template=`<h1>${lugar.nombre}</h1>`;
    $('#content-title-h1').html(template);
    template = '';
    if (lugar.descripcion != undefined) {
      template += `
      <div class="row">
        <h3>Descripción breve</h3>
        <div class="row ml-2 mr-2">
        ${lugar.descripcion}
        </div>
      </div>`;
    }
    if (lugar.historia != undefined) {
      template += `
      <div class="row">
        <h3>Historia</h3>
        <div class="row ml-2 mr-2">
        ${lugar.historia}
        </div>
      </div>`;
    }
    if (lugar.otros_nombres != undefined) {
      template += `
      <div class="row">
        <h3>Otros nombres</h3>
        <div class="row ml-2 mr-2">
        ${lugar.otros_nombres}
        </div>
      </div>`;
    }
    if (lugar.geografia != undefined) {
      template += `
      <div class="row">
        <h3>Geografía</h3>
        <div class="row ml-2 mr-2">
        ${lugar.geografia}
        </div>
      </div>`;
    }
    if (lugar.ecosistema != undefined) {
      template += `
      <div class="row">
        <h3>Ecosistema</h3>
        <div class="row ml-2 mr-2">
        ${lugar.ecosistema}
        </div>
      </div>`;
    }
    if (lugar.clima != undefined) {
      template += `
      <div class="row">
        <h3>Clima</h3>
        <div class="row ml-2 mr-2">
        ${lugar.clima}
        </div>
      </div>`;
    }
    if (lugar.flora_fauna != undefined) {
      template += `
      <div class="row">
        <h3>Flora y fauna</h3>
        <div class="row ml-2 mr-2">
        ${lugar.flora_fauna}
        </div>
      </div>`;
    }
    if (lugar.recursos != undefined) {
      template += `
      <div class="row">
        <h3>Recursos importantes o disponibles</h3>
        <div class="row ml-2 mr-2">
        ${lugar.recursos}
        </div>
      </div>`;
    }
    if (lugar.otros != undefined) {
      template += `
      <div class="row">
        <h3>Otros</h3>
        <div class="row ml-2 mr-2">
        ${lugar.otros}
        </div>
      </div>`;
    }
    $('#content-left').html(template);
    //datos de la card
    template = '';
    if (lugar.tipo != undefined) {
      template += `
      <div class="row">
        <h3>Tipo</h3>
        <div class="row ml-2 mr-2">
        ${lugar.tipo}
        </div>
      </div>`;
    }
    $('#content-right').html(template);
  });
}

function ver_conflicto(dato) {
  funcion='ver_conflicto';
  $.post('../controlador/conflictosController.php', {dato, funcion},(response)=>{
    const conflicto = JSON.parse(response);
    $('#nav-buttons').html(`<a href="conflictos.php" class="btn btn-dark ml-2">Volver</a>
    <form class="btn" action="createConflicto.php" method="post">
      <button class="btn btn-dark mr-1">Editar</button>
      <input type="hidden" name="id_conflicto" value="${conflicto.id}">
    </form>`);
    $('#content-title').html(conflicto.nombre);
    let template=`<h1>${conflicto.nombre}</h1>`;
    $('#content-title-h1').html(template);
    template = '';
    if(conflicto.descripcion!=undefined){
      template+=`
      <div class="row">
        <h3>Descripción</h3>
        <div class="row">
        ${conflicto.descripcion}
        </div>
      </div>`;
    }
    if(conflicto.preludio!=undefined){
      template+=`
      <div class="row personaje">
      <h2>El conflicto</h2>
      <div class="row">
        <h3>Preludio</h3>
        ${conflicto.preludio}
        </div>
      </div>`;
    }
    if(conflicto.desarrollo!=undefined){
      template+=`
      <div class="row personaje">
        <h3>Desarrollo</h3>
        ${conflicto.desarrollo}
      </div>`;
    }
    if(conflicto.resultado!=undefined){
      template+=`
      <div class="row personaje">
        <h3>Desarrollo</h3>
        ${conflicto.resultado}
      </div>`;
    }
    if(conflicto.consecuencias!=undefined){
      template+=`
      <div class="row personaje">
        <h3>Desarrollo</h3>
        ${conflicto.consecuencias}
      </div>`;
    }
    if(conflicto.otros!=undefined){
      template+=`
      <div class="row personaje">
        <h3>Otros</h3>
        ${conflicto.otros}
      </div>`;
    }
    $('#content-left').html(template);

    //datos de la card en la derecha
    template='<div class="row">';
    if(conflicto.tipo_conflicto!=undefined){
      template+=`
        <div class="col">
          <h6><b>Tipo de conflicto</b></h6>
          <p>${conflicto.tipo_conflicto}</p>
        </div>`;
    }
    if(conflicto.tipo_conflicto!=undefined){
      template+=`
        <div class="col">
          <h6><b>Tipo de localización</b></h6>
          <p>${conflicto.tipo_localizacion}</p>
        </div>`;
    }
    template+=`</div>`;
    template+='<div class="row">';
    if(conflicto.comienzo!=undefined){
      template+=`
        <div class="col">
          <h6><b>Fecha de inicio</b></h6>
          <p>${conflicto.comienzo}</p>
        </div>`;
    }
    if(conflicto.final!=undefined){
      template+=`
        <div class="col">
          <h6><b>Fecha de finalización</b></h6>
          <p>${conflicto.final}</p>
        </div>`;
    }
    template+=`</div>`;
    template+=`
      <div class="row justify-content-center">
        <h4>Beligerantes</h4>
      </div>`;
    
    $('#content-right').html(template);
  });
}