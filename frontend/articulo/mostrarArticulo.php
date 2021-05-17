<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php 

    $idArticulo = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../index/index.css">
    </head>
    <body class="index">
        <div>
            <textarea name="comentario" id="comentario" minlength="0" maxlength="1000" cols="90" rows="3"></textarea><?php if($rol!="invitado"){ ?><button class="botonComentario" name="comentario" id="comentario" data-idArticulo = "<?php echo $idArticulo;?>" data-idUsuario="<?php echo $_SESSION["id"]; ?>">Comentar</button><div id="verComentario"></div><?php } ?>
            <?php if($rol=="invitado"){ ?><button type="hidden" class="botonComentario" name="comentario" id="comentario" data-idArticulo = "<?php echo $idArticulo;?>"></button><div id="verComentario2"></div><?php } ?> <br>
            
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="articulo.js" type="text/javascript"></script>