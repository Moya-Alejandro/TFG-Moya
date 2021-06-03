//Cuando el documento haya cargado se ejecutará lo siguiente
$(document).ready(function(){
    /*Mostramos los likes, el numero de dislikes y likes*/
    verLike();
    nLikes();
    nDislikes();

    /*Cuando le damos click al boton .like se ejecuta lo siguiente*/
    $('.like').click(function(e){
        /*Guardamos los atributos de .like en variables*/
        const postData={
           valor: $(this).attr('data-valor'),
           idArticulo: $(this).attr('data-idArticulo')
        }
        /*Enviamos los valores y realizamos lo que haya en el post */
        $.post('../../backend/meGusta/like.php', postData, function(response){
            /*Mostramos los likes, el numero de dislikes y likes*/
            verLike();
            nLikes();
            nDislikes();
        });
        e.preventDefault();
    });

    /*Funcion para cambiar los colores y ver los likes*/
    function verLike(){
        $.ajax({
            url:'../../backend/meGusta/verLike.php',
            type:'GET',
            data: {idArticulo: $('.like').attr('data-idArticulo') },
            success: function numero(response){
                if(response==1){
                    $('.meGusta').prop('checked',true);
                    $('.verde').css('color','green');
                    $('.rojo').css('color','black');
                }
                if(response==-1){
                    $('.noMeGusta').prop('checked',true);
                    $('.rojo').css('color','red');
                    $('.verde').css('color','black');
                }
                if(response==0){
                    $('.rojo').css('color','black');
                    $('.verde').css('color','black');
                }
            }
                
        }) 
    }

    //Función para ver el número de likes
    function nLikes(){
        $.ajax({
            url:'../../backend/meGusta/nLikes.php',
            type:'GET',
            data: {idArticulo: $('.like').attr('data-idArticulo') },
            success: function numero(response){
                $('.nLikes').html(response);
            }
                
        }) 
    }

    //Función para ver el número de dislikes
    function nDislikes(){
        $.ajax({
            url:'../../backend/meGusta/nDislikes.php',
            type:'GET',
            data: {idArticulo: $('.like').attr('data-idArticulo') },
            success: function numero(response){
                $('.nDislikes').html(response);
            }
                
        }) 
    }
});