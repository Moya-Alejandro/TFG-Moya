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

//Llamamos a la función para borrar el comentario si se ha confirmado la eliminación
$(document).on('click','.borrarComentario', function(){

    let idComentario = $(this).attr('data-idComentario');
    
    confirmarBorrar(idComentario);

})