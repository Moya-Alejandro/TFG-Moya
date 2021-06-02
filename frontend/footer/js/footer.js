$(document).ready(function(){

    numeroCarrito();

    $('.enviar').on('click',function(e){
        const postData={
        idArticulo: $(this).attr('data-id'),
        cantidad:$(this).attr('data-cantidad')
        }

        $.post('../carrito/insertarCarrito.php', postData, function(response){
            numeroCarrito();
        });

        e.preventDefault();
    });

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