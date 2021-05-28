$(document).ready(function(){

    verComentario();
    verComentario2();
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

    function verComentario(){
        $.ajax({
            url:'../comentario/verComentario.php',
            type:'GET',
            data: {idArticulo: $('.botonComentario').attr('data-idArticulo'),
                   idUsuario: $('.botonComentario').attr('data-idUsuario')},
            success: function numero(response){
                let comentarios= JSON.parse(response); 
                let fila='';
                comentarios.forEach(comentarios => {
                    fila += `
                    <span>${comentarios.comentario}</span><br>`  
                    
                    if($('.botonComentario').attr('data-idUsuario')==comentarios.idUsuarioComentario || $('.botonComentario').attr('data-rol') == "admin"){
                        fila += `${comentarios.iconoBorrar} <br>`
                    }  
                    if($('.botonComentario').attr('data-idUsuario')==comentarios.idUsuarioComentario || $('.botonComentario').attr('data-rol') == "admin"){
                        fila += `${comentarios.iconoEditar} <br>`
                    }  
                });
                $('#verComentario').html(fila);
            }
                
        })
            
    }

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
    
    


    $(document).on('click','.borrarComentario', function(){

        let idComentario = $(this).attr('data-idComentario');
        
        confirmarBorrar(idComentario);
 
    })

    $(document).on('click','.editarComentario', function(){

        let idComentario = $(this).attr('data-idComentario');
        let comentario = $(this).attr('data-comentario');
        modificarComentario(idComentario, comentario);
 
    })
});