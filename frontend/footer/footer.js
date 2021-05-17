$(document).ready(function(){

    numeroCarrito();

    $('.enviar').on('click',function(e){
        const postData={
        idArticulo: $(this).attr('data-id'),
        precio:  $(this).attr('data-precio'),
        cantidad:$(this).attr('data-cantidad'),
        stock: $(this).attr('data-stock'),
        nombre: $(this).attr('data-name')

        }

        $.post('../carrito/insertarCarrito.php', postData, function(response){
            numeroCarrito();
            console.log(response);
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