//Función que utilizaremos con sweet alert para mostrar una confirmación de elimiar el usuario
function confirmarBorrar(idUsuario){
    swal("¿Quieres eliminar el usuario?", {
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
                window.location= "../../backend/usuario/borrarUsuario.php?id="+idUsuario;
            break;
        }
    });
}

//Función que utilizaremos con sweet alert para mostrar una confirmación de dar admin al usuario
function confirmarAdmin(idUsuario){
    swal("¿Quieres darle administrador al usuario?", {
        buttons: {
            cancel: "Cancelar",
            catch: {
            text: "Confirmar",
            value: "admin",
            },
        },
        })
        .then((value) => {
        switch (value) {
            case "admin":
                window.location= "../../backend/admin/darAdmin.php?idUsuario="+idUsuario;
            break;
        }
    });
}
