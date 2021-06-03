
/*Cuando se carge el archivo se ejecutará lo siguiente */
$(document).ready(function(){

    /*Mostraremos el número de cantidad de articulos dentro del carrito */
    numeroCarrito();

    /*Al activar la función insertaremos un articulo en el carrito */
    $('.enviar').on('click',function(e){
        const postData={
        idArticulo: $(this).attr('data-id'),
        cantidad:$(this).attr('data-cantidad')
        }

        $.post('../carrito/insertarCarrito.php', postData, function(response){
            /*Volveremos a mostrar el número del carrito */
            numeroCarrito();
        });

        e.preventDefault();
    });

    /*Cogeremos el número de carrito, que haya en la base de datos y la pondremos en el html */
    function numeroCarrito(){
        $.ajax({
            url:'../carrito/nCarrito.php',
            type:'GET',
            success: function numero(response){
                let numero= parseInt(response);
                document.getElementById('numeroCarrito').innerHTML=numero;
            }
        })
    }

});  