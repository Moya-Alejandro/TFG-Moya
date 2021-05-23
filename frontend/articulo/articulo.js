$(document).ready(function(){

    verComentario();
    $('.botonComentario').click(function(e){
        const postData={
           idArticulo: $(this).attr('data-idArticulo'),
           idUsuario:  $(this).attr('data-idUsuario'),
           comentario: $('#comentario').val()

        }
        $.post('../comentario/insertarComentario.php', postData, function(response){
            verComentario();

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
                <span>${comentarios.comentario+comentarios.iconoBorrar}</span><br>`          
                });
                $('#verComentario').html(fila);
                $('#verComentario2').html(fila);
            }
                
        })
            
    }
});