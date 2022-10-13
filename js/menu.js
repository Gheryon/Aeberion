$(document).ready(function(){
    rellenar_menu_especies();

    function rellenar_menu_especies() {
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
});