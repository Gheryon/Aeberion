$(document).ready(function(){

})

function loadContent(tipo, id){
  //console.log(tipo+' '+id);
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
    console.log(response);
    const personaje= JSON.parse(response);
    $('#nav-buttons').html(`<a href="../vista/personajes.php" class="btn btn-dark ml-2">Volver</a>
    <form class="btn" action="createPersonaje.php" method="post">
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
        <p class="ml-2 mr-2">${personaje.descripcionShort}</p>
      </div>`;
    }
    template+=`<h2>Descripción</h2>`;
    if(personaje.descripcion!=undefined){
      template+=`
      <div class="row">
        <h3>Descripción física</h3>
        <p class="ml-2 mr-2">${personaje.descripcion}</p>
      </div>`;
    }
    if(personaje.personalidad!=undefined){
      template+=`
      <div class="row">
        <h3>Personalidad</h3>
        <p class="ml-2 mr-2">${personaje.personalidad}</p>
      </div>`;
    }
    if(personaje.deseos!=undefined){
      template+=`
      <div class="row">
        <h3>Deseos</h3>
        <p class="ml-2 mr-2">${personaje.deseos}</p>
      </div>`;
    }
    if(personaje.miedos!=undefined){
      template+=`
      <div class="row">
        <h3>Miedos</h3>
        <p class="ml-2 mr-2">${personaje.miedos}</p>
      </div>`;
    }
    if(personaje.magia!=undefined){
      template+=`
      <div class="row">
        <h3>Habilidades mágicas</h3>
        <p class="ml-2 mr-2">${personaje.magia}</p>
      </div>`;
    }
    if(personaje.educacion!=undefined){
      template+=`
      <div class="row">
        <h3>Educación</h3>
        <p class="ml-2 mr-2">${personaje.educacion}</p>
      </div>`;
    }
    if(personaje.historia!=undefined){
      template+=`
      <h2>Historia</h2>
      <div class="row">
        <p class="ml-2 mr-2">${personaje.historia}</p>
      </div>`;
    }
    template+=`
    <h2>Aspectos sociales</h2>`;
    if(personaje.religion!=undefined){
      template+=`
      <div class="row">
        <h3>Religión</h3>
        <p class="ml-2 mr-2">${personaje.religion}</p>
      </div>`;
    }
    if(personaje.familia!=undefined){
      template+=`
      <div class="row">
        <h3>Familia</h3>
        <p class="ml-2 mr-2">${personaje.familia}</p>
      </div>`;
    }
    if(personaje.politica!=undefined){
      template+=`
      <div class="row">
        <h3>Política</h3>
        <p class="ml-2 mr-2">${personaje.politica}</p>
      </div>`;
    }
    if(personaje.otros!=undefined){
      template+=`
      <h2>Otros</h2>
      <div class="row">
        <h3>Otros</h3>
        <p class="ml-2 mr-2">${personaje.otros}</p>
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
        <p class="ml-1 mr-2"><a href="vistaContent.php?id=${personaje.id_especie}&tipo=2">${personaje.nombreEspecie}</a></p>
      </div>`;
    }
    if(personaje.sexo!=undefined){
      template+=`
      <div class="row">
        <h3>Sexo</h3>
        <p class="ml-2 mr-2">${personaje.sexo}</p>
      </div>`;
    }
    if(personaje.lugarNacimiento!=undefined){
      template+=`
      <div class="row">
        <h3>Lugar de nacimiento</h3>
        <p class="ml-2 mr-2">${personaje.lugarNacimiento}</p>
      </div>`;
    }
    if(personaje.nacimiento!=undefined){
      template+=`
      <div class="row">
        <h3>Fecha de nacimiento</h3>
        <p class="ml-2 mr-2">${personaje.nacimiento}</p>
      </div>`;
    }
    if(personaje.fallecimiento!=undefined){
      template+=`
      <div class="row">
        <h3>Fecha de fallecimiento</h3>
        <p class="ml-2 mr-2">${personaje.fallecimiento}</p>
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
        <p class="ml-2 mr-2">${especie.anatomia}</p>
      </div>`;
    }
    if(especie.alimentacion!=undefined){
      template+=`
      <div class="row">
        <h3>Alimentación</h3>
        <p class="ml-2 mr-2">${especie.alimentacion}</p>
      </div>`;
    }
    if(especie.reproduccion!=undefined){
      template+=`
      <div class="row">
        <h3>Reproducción y crecimiento</h3>
        <p class="row ml-2 mr-2">${especie.reproduccion}</p>
      </div>`;
    }
    template+=`
    <h2>Hábitats y usos</h2>`;
    if(especie.distribucion!=undefined){
      template+=`
      <div class="row">
        <h3>Distribución y hábitats</h3>
        <p class="ml-2 mr-2">${especie.distribucion}</p>
      </div>`;
    }
    if(especie.habilidades!=undefined){
      template+=`
      <div class="row">
        <h3>Habilidades</h3>
        <p class="row ml-2 mr-2">${especie.habilidades}</p>
      </div>`;
    }
    if(especie.domesticacion!=undefined){
      template+=`
      <div class="row">
        <h3>Domesticación</h3>
        <p class="ml-2 mr-2">${especie.domesticacion}</p>
      </div>`;
    }
    if(especie.explotacion!=undefined){
      template+=`
      <div class="row">
        <h3>Explotación</h3>
        <p class="ml-2 mr-2">${especie.explotacion}</p>
      </div>`;
    }
    if(especie.otros!=undefined){
      template+=`
      <h2>Otros</h2>
      <div class="row">
        <h3>Otros</h3>
        <p class="ml-2 mr-2">${especie.otros}</p>
      </div>`;
    }
    $('#content-left').html(template);
    
    //datos de la card
    template='';
    if(especie.vida!=undefined){
      template+=`
      <div class="row">
        <h3>Vida media</h3>
        <p class="ml-2 mr-2">${especie.vida}</p>
      </div>`;
    }
    if(especie.altura!=undefined){
      template+=`
      <div class="row">
        <h3>Altura</h3>
        <p class="ml-2 mr-2">${especie.altura}</p>
      </div>`;
    }
    if(especie.peso!=undefined){
      template+=`
      <div class="row">
        <h3>Peso</h3>
        <p class="ml-2 mr-2">${especie.peso}</p>
      </div>`;
    }
    if(especie.longitud!=undefined){
      template+=`
      <div class="row">
        <h3>Longitud</h3>
        <p class="ml-2 mr-2">${especie.longitud}</p>
      </div>`;
    }
    if(especie.estatus!=undefined){
      template+=`
      <div class="row">
        <h3>Estatus</h3>
        <p class="ml-2 mr-2">${especie.estatus}</p>
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
      <input type="hidden" name="id" value="${institucion.id}">
    </form>`);
    $('#content-title').html(institucion.nombre);
    let template=`<h1>${institucion.nombre}</h1>`;
    $('#content-title-h1').html(template);
    template='';
    if(institucion.descripcion!=undefined){
      template+=`
      <div class="row">
        <h3>Descripción</h3>
        <p class="ml-2 mr-2">${institucion.descripcion}</p>
      </div>`;
    }
    if(institucion.historia!=undefined){
      template+=`
      <h2>Historia</h2>
      <div class="row">
        <h3>Historia</h3>
        <p class="ml-2 mr-2">${institucion.historia}</p>
      </div>`;
    }
    template+=`<h2>Geopolítica</h2>`;
    if(institucion.politica!=undefined){
      template+=`
      <div class="row">
        <h3>Política exterior e interior</h3>
        <p class="ml-2 mr-2">${institucion.politica}</p>
      </div>`;
    }
    if(institucion.frontera!=undefined){
      template+=`
      <div class="row">
        <h3>Fronteras</h3>
        <p class="ml-2 mr-2">${institucion.frontera}</p>
      </div>`;
    }
    if(institucion.militar!=undefined){
      template+=`
      <div class="row">
        <h3>Militar</h3>
        <p class="ml-2 mr-2">${institucion.militar}</p>
      </div>`;
    }
    if(institucion.territorio!=undefined){
      template+=`
      <div class="row">
        <h3>Territorio</h3>
        <p class="ml-2 mr-2">${institucion.territorio}</p>
      </div>`;
    }    
    template+=`<h2>Cultura, economía y política interior</h2>`;
    if(institucion.demografia!=undefined){
      template+=`
      <div class="row">
        <h3>Demografía</h3>
        <p class="ml-2 mr-2">${institucion.demografia}</p>
      </div>`;
    }
    if(institucion.estructura!=undefined){
      template+=`
      <div class="row">
        <h3>Estructura organizativa</h3>
        <p class="ml-2 mr-2">${institucion.estructura}</p>
      </div>`;
    }
    if(institucion.religion!=undefined){
      template+=`
      <div class="row">
        <h3>Religión</h3>
        <p class="ml-2 mr-2">${institucion.religion}</p>
      </div>`;
    }
    if(institucion.cultura!=undefined){
      template+=`
      <div class="row">
        <h3>Cultura</h3>
        <p class="ml-2 mr-2">${institucion.cultura}</p>
      </div>`;
    }
    if(institucion.educacion!=undefined){
      template+=`
      <div class="row">
        <h3>Educación</h3>
        <p class="ml-2 mr-2">${institucion.educacion}</p>
      </div>`;
    }
    if(institucion.economia!=undefined){
      template+=`
      <div class="row">
        <h3>Economía</h3>
        <p class="ml-2 mr-2">${institucion.economia}</p>
      </div>`;
    }
    if(institucion.tecnologia!=undefined){
      template+=`
      <div class="row">
        <h3>Tecnología y ciencia</h3>
        <p class="ml-2 mr-2">${institucion.tecnologia}</p>
      </div>`;
    }
    if(institucion.recursos!=undefined){
      template+=`
      <div class="row">
        <h3>Recursos naturales</h3>
        <p class="ml-2 mr-2">${institucion.recursos}</p>
      </div>`;
    }
    if(institucion.clima!=undefined){
      template+=`
      <div class="row">
        <h3>Clima</h3>
        <p class="ml-2 mr-2">${institucion.clima}</p>
      </div>`;
    }
    if(institucion.otros!=undefined){
      template+=`
      <h2>Otros</h2>
      <div class="row">
        <h3>Otros</h3>
        <p class="ml-2 mr-2">${institucion.otros}</p>
      </div>`;
    }
    $('#content-left').html(template);

    //datos de la card
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
        <p class="ml-2 mr-2">${institucion.tipo}</p>
      </div>`;
    }
    if(institucion.ruler!=undefined){
      template+=`
      <div class="row">
        <h3>Gobernante actual</h3>
        <p class="ml-1 mr-2"><a href="vistaContent.php?id=${institucion.id_ruler}&tipo=1">${institucion.ruler}</a></p>
      </div>`;
    }
    if(institucion.owner!=undefined){
      template+=`
      <div class="row">
        <h3>Bajo control de</h3>
        <p class="ml-1 mr-2"><a href="vistaContent.php?id=${institucion.id_owner}&tipo=3">${institucion.owner}</a></p>
      </div>`;
    }
    if(institucion.gentilicio!=undefined){
      template+=`
      <div class="row">
        <h3>Gentilicio</h3>
        <p class="ml-2 mr-2">${institucion.gentilicio}</p>
      </div>`;
    }
    if(institucion.capital!=undefined){
      template+=`
      <div class="row">
        <h3>Capital</h3>
        <p class="ml-2 mr-2">${institucion.capital}</p>
      </div>`;
    }
    if(institucion.lema!=undefined){
      template+=`
      <div class="row">
        <h3>Lema</h3>
        <p class="ml-2 mr-2">${institucion.lema}</p>
      </div>`;
    }
    if(institucion.fundacion!=undefined&&(institucion.dia_fundacion!=0)&&(institucion.mes_fundacion!=0)){
      template+=`
      <div class="row">
        <h3>Fundación</h3>
        <p class="ml-2 mr-2">${institucion.fundacion}</p>
      </div>`;
    }
    if(institucion.disolucion!=undefined&&(institucion.dia_disolucion!=0)&&(institucion.mes_disolucion!=0)){
      template+=`
      <div class="row">
        <h3>Disolución</h3>
        <p class="ml-2 mr-2">${institucion.disolucion}</p>
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
    console.log(response);
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
        <p class="ml-2 mr-2">${asentamiento.descripcion}</p>
      </div>`;
    }
    if (asentamiento.demografia != undefined) {
      template += `
      <div class="row">
        <h3>Demografía</h3>
        <p class="ml-2 mr-2">${asentamiento.demografia}</p>
      </div>`;
    }
    if (asentamiento.gobierno != undefined) {
      template += `
      <div class="row">
        <h3>Gobierno</h3>
        <p class="ml-2 mr-2">${asentamiento.gobierno}</p>
      </div>`;
    }
    if (asentamiento.infraestructura != undefined) {
      template += `
      <div class="row">
        <h3>Infraestructura</h3>
        <p class="ml-2 mr-2">${asentamiento.infraestructura}</p>
      </div>`;
    }
    if (asentamiento.historia != undefined) {
      template += `
      <div class="row">
        <h3>Historia</h3>
        <p class="ml-2 mr-2">${asentamiento.historia}</p>
      </div>`;
    }
    if (asentamiento.defensas != undefined) {
      template += `
      <div class="row">
        <h3>Sistemas defensivos</h3>
        <p class="ml-2 mr-2">${asentamiento.defensas}</p>
      </div>`;
    }
    if (asentamiento.economia != undefined) {
      template += `
      <div class="row">
        <h3>Economía, industria y comercio</h3>
        <p class="ml-2 mr-2">${asentamiento.economia}</p>
      </div>`;
    }
    if (asentamiento.cultura != undefined) {
      template += `
      <div class="row">
        <h3>Cultura y arquitectura</h3>
        <p class="ml-2 mr-2">${asentamiento.cultura}</p>
      </div>`;
    }
    if (asentamiento.geografia != undefined) {
      template += `
      <div class="row">
        <h3>Geografía</h3>
        <p class="ml-2 mr-2">${asentamiento.geografia}</p>
      </div>`;
    }
    if (asentamiento.clima != undefined) {
      template += `
      <div class="row">
        <h3>Clima</h3>
        <p class="ml-2 mr-2">${asentamiento.clima}</p>
      </div>`;
    }
    if (asentamiento.recursos != undefined) {
      template += `
      <div class="row">
        <h3>Recursos</h3>
        <p class="ml-2 mr-2">${asentamiento.recursos}</p>
      </div>`;
    }
    if (asentamiento.otros != undefined) {
      template += `
      <div class="row">
        <h3>Otros</h3>
        <p class="ml-2 mr-2">${asentamiento.otros}</p>
      </div>`;
    }
    $('#content-left').html(template);

    //datos de la card
    template = '';
    if (asentamiento.gentilicio != undefined) {
      template += `
      <div class="row">
        <h3>Gentilicio</h3>
        <p class="ml-2 mr-2">${asentamiento.gentilicio}</p>
      </div>`;
    }
    if (asentamiento.tipo != undefined) {
      template += `
      <div class="row">
        <h3>Tipo</h3>
        <p class="ml-2 mr-2">${asentamiento.tipo}</p>
      </div>`;
    }
    if(asentamiento.id_owner!=undefined){
      template+=`
      <div class="row">
        <h3>Bajo control de</h3>
        <p class="ml-1 mr-2"><a href="vistaContent.php?id=${asentamiento.id_owner}&tipo=3">${asentamiento.nombre_owner}</a></p>
      </div>`;
    }
    if (asentamiento.poblacion != undefined) {
      template += `
      <div class="row">
        <h3>Población</h3>
        <p class="ml-2 mr-2">${asentamiento.poblacion}</p>
      </div>`;
    }
    if (asentamiento.fundacion != undefined) {
      template += `
      <div class="row">
        <h3>Fundación</h3>
        <p class="ml-2 mr-2">${asentamiento.fundacion}</p>
      </div>`;
    }
    if (asentamiento.disolucion != undefined) {
      template += `
      <div class="row">
        <h3>Disolución</h3>
        <p class="ml-2 mr-2">${asentamiento.disolucion}</p>
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
        <p class="ml-2 mr-2">${lugar.descripcion}</p>
      </div>`;
    }
    if (lugar.otros_nombres != undefined) {
      template += `
      <div class="row">
        <h3>Otros nombres</h3>
        <p class="ml-2 mr-2">${lugar.otros_nombres}</p>
      </div>`;
    }
    if (lugar.historia != undefined) {
      template += `
      <h2>Historia</h2>
      <div class="row">
        <h3>Historia</h3>
        <p class="ml-2 mr-2">${lugar.historia}</p>
      </div>`;
    }
    if (lugar.geografia != undefined) {
      template += `
      <div class="row">
        <h3>Geografía</h3>
        <p class="ml-2 mr-2">${lugar.geografia}</p>
      </div>`;
    }
    if (lugar.ecosistema != undefined) {
      template += `
      <div class="row">
        <h3>Ecosistema</h3>
        <p class="ml-2 mr-2">${lugar.ecosistema}</p>
      </div>`;
    }
    if (lugar.clima != undefined) {
      template += `
      <div class="row">
        <h3>Clima</h3>
        <p class="ml-2 mr-2">${lugar.clima}</p>
      </div>`;
    }
    if (lugar.flora_fauna != undefined) {
      template += `
      <div class="row">
        <h3>Flora y fauna</h3>
        <p class="ml-2 mr-2">${lugar.flora_fauna}</p>
      </div>`;
    }
    if (lugar.recursos != undefined) {
      template += `
      <div class="row">
        <h3>Recursos importantes o disponibles</h3>
        <p class="ml-2 mr-2">${lugar.recursos}</p>
      </div>`;
    }
    if (lugar.otros != undefined) {
      template += `
      <div class="row">
        <h3>Otros</h3>
        <p class="ml-2 mr-2">${lugar.otros}</p>
      </div>`;
    }
    $('#content-left').html(template);
    //datos de la card
    template = '';
    if (lugar.tipo != undefined) {
      template += `
      <div class="row">
        <h3>Tipo</h3>
        <p class="ml-2 mr-2">${lugar.tipo}</p>
      </div>`;
    }
    $('#content-right').html(template);
  });
}

function ver_conflicto(dato) {
  funcion='ver_conflicto';
  $.post('../controlador/conflictosController.php', {dato, funcion},(response)=>{
    console.log(response);
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
        <p>${conflicto.descripcion}</p>
      </div>`;
    }
    if(conflicto.preludio!=undefined){
      template+=`
      <h2>El conflicto</h2>
      <div class="row">
        <h3>Preludio</h3>
        <p>${conflicto.preludio}</p>
      </div>`;
    }
    if(conflicto.desarrollo!=undefined){
      template+=`
      <div class="row">
        <h3>Desarrollo</h3>
        <p>${conflicto.desarrollo}</p>
      </div>`;
    }
    if(conflicto.resultado!=undefined){
      template+=`
      <div class="row personaje">
        <h3>Resultado</h3>
        <p>${conflicto.resultado}</p>
      </div>`;
    }
    if(conflicto.consecuencias!=undefined){
      template+=`
      <div class="row personaje">
        <h3>Consecuencias</h3>
        <p>${conflicto.consecuencias}</p>
      </div>`;
    }
    if(conflicto.otros!=undefined){
      template+=`
      <div class="row personaje">
        <h3>Otros</h3>
        <p>${conflicto.otros}</p>
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
    if(conflicto.tipo_localizacion!=undefined){
      template+=`
        <div class="col">
          <h6><b>Tipo de localización</b></h6>
          <p>${conflicto.tipo_localizacion}</p>
        </div>`;
    }
    template+=`</div>`;
    template+='<div class="row">';
    if(conflicto.inicio!=undefined){
      template+=`
        <div class="col">
          <h6><b>Comienzo</b></h6>
          <p>${conflicto.inicio}</p>
        </div>`;
    }
    if(conflicto.fin!=undefined){
      template+=`
        <div class="col">
          <h6><b>Final</b></h6>
          <p>${conflicto.fin}</p>
        </div>`;
    }
    template+=`</div>`;
    funcion='get_beligerantes';
    id=dato;
    $.post('../controlador/conflictosController.php', {id, funcion},(response)=>{
      let beligerantes=JSON.parse(response);
      let templateb='';
      let templatec='';
      for(let x of beligerantes){
        if(x.lado=='atacante'){
          templateb+=`<a href="vistaContent.php?id=${x.id}&tipo=3" class="row text-center lado-dercho">${x.nombre}</a>`;
        }else{
          templatec+=`<a href="vistaContent.php?id=${x.id}&tipo=3" class="row text-center lado-izqdo">${x.nombre}</a>`;
        }
      }
      template+=`
        <div class="row beligerantes">
          <h4 class="text-center">Participantes</h4>
            <div class="col">`;
            template+=templateb;
            template+=`</div>
            <div class="col">`
            template+=templatec;
            template+=`</div>
        </div>`;
      
      $('#content-right').html(template);

    });
  });
}