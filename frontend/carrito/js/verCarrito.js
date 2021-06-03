//Función que utilizaremos con sweet alert para mostrar una confirmación de elimiar el comentario
function confirmarBorrar(idArticulo){
    swal("¿Quieres eliminar el artículo del carrito?", {
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
                window.location= '../../backend/carrito/borrarArticuloCarrito.php?idArticulo='+idArticulo;
            break;
        }
    });
}

//Función que utilizaremos con sweet alert para mostrar una confirmación de elimiar el comentario
function confirmarBorrarCarrito(idUsuario){
    swal("¿Quieres eliminar todos los artículos del carrito?", {
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
                window.location= '../../backend/carrito/vaciarCarrito.php?idUsuario='+idUsuario;
            break;
        }
    });
}