$(document).ready(function() {
    //buscar_articulos() para que automáticamente se muestren todos los articulos
    buscar_articulos();
    var funcion;
    var edit=false;

    $('#form-crear-articulo').submit(e=>{
        let nombre_articulo=$('#nombre-articulo').val();
        let contenido_articulo=$('#contenido-articulo').val();
        let id_editado=$('#id_editar_art').val();
        let tipo=$('#tipo-articulo').val();
        //si edit es false, se crea un articulo, si es true, se modifica
        if(edit==false){
            funcion='crear';
        }else{
            funcion='editar';
        }
        $.post('../controlador/articulosController.php', {nombre_articulo, contenido_articulo, id_editado, tipo, funcion}, (response)=>{
            console.log(response);
            if(response=='add'){
                $('#add-articulo').hide('slow');
                $('#add-articulo').show(1000);
                $('#add-articulo').hide(3000);
                //resetea los campos de la card
                $('#form-crear-articulo').trigger('reset');
                buscar_articulos();
            }
            if(response=='noadd'){
                $('#noadd-articulo').hide('slow');
                $('#noadd-articulo').show(1000);
                $('#noadd-articulo').hide(3000);
                //resetea los campos de la card
                $('#form-crear-articulo').trigger('reset');
            }
            if(response=='edit'){
                $('#edit-articulo').hide('slow');
                $('#edit-articulo').show(1000);
                $('#edit-articulo').hide(3000);
                //resetea los campos de la card
                $('#form-crear-articulo').trigger('reset');
                buscar_articulos();
            }
            edit=false;
        })
        e.preventDefault();
    });

    function buscar_articulos(consulta){
        funcion='buscar';
        $.post('../controlador/articulosController.php', {consulta, funcion}, (response)=>{
            //console.log(response);
            const articulos = JSON.parse(response);
            let template='';
            articulos.forEach(articulo => {
                template+=`
                    <tr artId="${articulo.id}" artNombre="${articulo.nombre}" artContenido="${articulo.contenido}" artTipo="${articulo.tipo}">
                        <td>
                            <button class="detalles btn btn-info" title="Ver articulo" type="button" data-toggle="modal" data-target="#verArticulo"><i class="fas fa-id-card mr-1"></i></button>
                            <button class="editar btn btn-success" title="Editar articulo" type="button" data-toggle="modal" data-target="#crearArticulo"><i class="fas fa-pencil-alt"></i></button>
                            <button class="borrar btn btn-danger" title="Borrar articulo" type="button" data-toggle="modal" data-target="#confirmar"><i class="fas fa-trash"></i></button>
                        </td>
                        <td>"${articulo.nombre}"</td>
                        <td>"${articulo.tipo}"</td>
                    </tr>
                `;
            });
            $('#articulos').html(template);
        })
    }
    //con el atributo .on, se ejecuta cada vez que se pulsa una tecla
    $(document).on('keyup', '#buscar-articulo', function(){
        let valor = $(this).val();
        if(valor!='')
        {
            buscar_articulos(valor);
        }else{
            buscar_articulos();
        }
    });

    $(document).on('click', '.editar', (e)=>{
        //se usan 2 parentElement para llegar al tr desde el button #editar en el que se hace click
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('artId');
        const nombre=$(elemento).attr('artNombre');
        const contenido=$(elemento).attr('artContenido');
        const tipo=$(elemento).attr('artTipo');
        $('#id_editar_art').val(id);
        $('#nombre-articulo').val(nombre);
        $('#contenido-articulo').val(contenido);
        $('#tipo-articulo').val(tipo);
        edit=true;
    });

    $(document).on('click', '.detalles', (e)=>{
        //se usan 2 parentElement para llegar al tr desde el button #detalles en el que se hace click
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('artId');
        funcion='detalles';
        $.post('../controlador/articulosController.php', {id, funcion}, (response)=>{
            const articulo = JSON.parse(response);
            $('#nombre-articulo-title').html(articulo.nombre);
            $('#ver-nombre-articulo').html(articulo.nombre);
            $('#ver-contenido-articulo').html(articulo.contenido);
        })
    });

    $('#form-borrar-articulo').submit(e=>{
        let id=$('#id_articulo').val();
        funcion='borrar';

        $.post('../controlador/articulosController.php', { id, funcion}, (response)=>{
            if(response=='borrado'){
                $('#confirmado').hide('slow');
                $('#confirmado').show(1000);
                $('#confirmado').hide(3000);
                //resetea los campos de la card
                $('#form-borrar-articulo').trigger('reset');
                buscar_articulos();
            }
            if(response=='noborrado'){
                $('#rechazado').hide('slow');
                $('#rechazado').show(1000);
                $('#rechazado').hide(3000);
                //resetea los campos de la card
                $('#form-borrar-articulo').trigger('reset');
                buscar_articulos();
            }
        })
        e.preventDefault();
    });

    //lleva el id del articulo a borrar al modal de confirmacion
    $(document).on('click', '.borrar', (e)=>{
        //se usan 2 parentElement para llegar al tr desde el button #borrar en el que se hace click
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('artId');
        const nombre=$(elemento).attr('artNombre');
        
        $('#id_articulo').val(id);
        $('#nombre-articulo-borrar').val(nombre);
    });
});