function activador(e){
    document.querySelector('#imagen').click();
}

function mostrarImagen(e){
    if(e.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            document.querySelector('#mostrarProducto').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}