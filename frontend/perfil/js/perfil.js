//Función que utilizaremos con sweet alert para mostrar una confirmación de elimiar el usuario
function confirmarBorrar(idUsuario){
    swal("¿Quieres eliminar tu usuario?", {
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
                window.location= "../../backend/usuario/borrarPerfil.php?id="+idUsuario;
            break;
        }
    });
}
