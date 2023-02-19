$(document).ready(function(){
  cargar_especies_menu();
  cargar_religiones_menu();

  function cargar_especies_menu() {
    funcion="menu_especies";
    $.post('../controlador/especiesController.php', {funcion}, (response)=>{
      const especies= JSON.parse(response);
      let template='';
      especies.forEach(especie => {
        template+=`
        <li class="nav-item">
          <a href="especies.php?id_especie=${especie.id}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>${especie.nombre}</p>
          </a>
        </li>
          `;
      });
      $('#menu_especies').html(template);
    })
  }
  function cargar_religiones_menu() {
    funcion="menu_religiones";
    $.post('../controlador/institucionesController.php', {funcion}, (response)=>{
      const religiones= JSON.parse(response);
      let template='';
      religiones.forEach(religion => {
        template+=`
        <li class="nav-item">
          <a href="vistaContent.php?id_religion=${religion.id}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>${religion.nombre}</p>
          </a>
        </li>
          `;
      });
      $('#menu_religiones').html(template);
    })
  }
});