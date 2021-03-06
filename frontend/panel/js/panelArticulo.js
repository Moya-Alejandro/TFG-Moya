//Función que utilizaremos con sweet alert para mostrar una confirmación de elimiar el artículo
function confirmarBorrar(idArticulo){
    swal("¿Quieres eliminar el artículo?", {
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
                window.location= "../../backend/admin/borrarArticulo.php?idArticulo="+idArticulo;
            break;
        }
    });
}
