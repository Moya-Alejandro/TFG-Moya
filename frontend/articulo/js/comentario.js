
//Cuando la página haya cargado, se mostrarán las funciones que hay dentro
$(document).ready(function(){

    //Llamamos estas dos funciones para mostrar en la página los comentarios
    verComentario();
    verComentario2();
    
    //Al darle al .botonComentario, guardaremos los datos que se pasan por sus atributos y los mandaremos a un post para crear los comentarios y guardarlos en la BD, una vez pase esto se vaciará el comentario para poder escribir otro
    $('.botonComentario').click(function(e){
        const postData={
           idArticulo: $(this).attr('data-idArticulo'),
           idUsuario:  $(this).attr('data-idUsuario'),
           comentario: $('#comentario').val()

        }
        $.post('../comentario/insertarComentario.php', postData, function(response){
            verComentario();
            $('#comentarioForm').trigger('reset');

        });
        e.preventDefault();
    });

    //Función que nos mostrará los comentarios que hay en la base de datos
    function verComentario(){
        $.ajax({
            url:'../comentario/verComentario.php',
            type:'GET',
            //Guardamos los datos que pasamos por los atributos ya que los necesitaremos para los botones de editar o borrar
            data: {idArticulo: $('.botonComentario').attr('data-idArticulo'),
                   idUsuario: $('.botonComentario').attr('data-idUsuario')},
            success: function numero(response){
                let comentarios= JSON.parse(response); 
                let fila='';
                comentarios.forEach(comentarios => {
                    //Crearemos los comentarios que existan y en caso de que el id del usuario concuerde saldrán los botones de editar y borrar
                    fila += `
                    <span>${comentarios.comentario}</span><br>`  
                    
                    if($('.botonComentario').attr('data-idUsuario')==comentarios.idUsuarioComentario || $('.botonComentario').attr('data-rol') == "admin"){
                        fila += `${comentarios.iconoBorrar} <br>`
                    }  
                    if($('.botonComentario').attr('data-idUsuario')==comentarios.idUsuarioComentario || $('.botonComentario').attr('data-rol') == "admin"){
                        fila += `${comentarios.iconoEditar} <br>`
                    }  
                });
                //Mostraremos los comentarios en el div con id verComentario
                $('#verComentario').html(fila);
            }
                
        })
            
    }

    //Mostraremos los comentarios para los usuarios que no estén registrados
    function verComentario2(){
        $.ajax({
            url:'../comentario/verComentarioInvitado.php',
            type:'GET',
            data: {idArticulo: $('.botonComentario').attr('data-idArticulo')},
            success: function numero(response){
                let comentarios= JSON.parse(response); 
                let fila='';
                comentarios.forEach(comentarios => {
                    fila += `
                    <span>${comentarios.comentario}</span><br>`  
                    
                });
                $('#verComentario2').html(fila);
            }
                
        })
            
    }

    //Función que utilizaremos con sweet alert para mostrar una confirmación de elimiar el comentario
    function confirmarBorrar(idComentario){
        swal("¿Quieres eliminar el comentario?", {
            buttons: {
              cancel: "Cancelar",
              catch: {
                text: "Eliminar",
                value: "borrar",
              },
            },
          })
          .then((value) => {
            switch (value) {

              case "borrar":
                $.post('../../backend/comentario/borrarComentario.php', {'idComentario':idComentario}, function(response){
                    verComentario(); 
                });
                break;
            }
          });
        }

    //Función que utilizaremos con sweet alert para mostrar una alerta para modificar el comentario
    function modificarComentario(idComentario, comentario){
        swal("Melilla Shooting", {
            content: {
                element: "input",
                attributes: {
                    name: "modificarComentario",
                    value: comentario,

                },
                },
                buttons: {
                catch: {
                    text: "Editar",
                    value: "editar",
                    },
                cancel: "Cancelar",

            },

            })
            .then((value) => {
            switch (value) {

            case "editar":
                $.post('../../backend/comentario/editarComentario.php', {'idComentario':idComentario, 'comentario':`${$('input[name=modificarComentario]').val()}`}, function(response){
                    verComentario(); 
                });


            }
        });
    }
    
    

    //Llamamos a la función para borrar el comentario si se ha confirmado la eliminación
    $(document).on('click','.borrarComentario', function(){

        let idComentario = $(this).attr('data-idComentario');
        
        confirmarBorrar(idComentario);
 
    })

    //Llamamos a la función para editar el comentario si se ha editado
    $(document).on('click','.editarComentario', function(){

        let idComentario = $(this).attr('data-idComentario');
        let comentario = $(this).attr('data-comentario');
        modificarComentario(idComentario, comentario);
 
    })
});