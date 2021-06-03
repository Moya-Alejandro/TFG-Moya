//Función que utilizaremos con sweet alert para mostrar una confirmación de elimiar la categoría
function confirmarBorrar(idCategoria){
    swal("¿Quieres eliminar la categoria?", {
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
                window.location= '../../backend/admin/borrarCategoria.php?idCategoria='+idCategoria;
            break;
        }
    });
}
