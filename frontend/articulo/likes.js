$(document).ready(function(){
    verLike();
    nLikes();
    nDislikes();
    $('.like').click(function(e){
        const postData={
           valor: $(this).attr('data-valor'),
           idArticulo: $(this).attr('data-idArticulo')
        }
        $.post('../../backend/meGusta/like.php', postData, function(response){
            verLike();
            nLikes();
            nDislikes();
        });
        e.preventDefault();
    });


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