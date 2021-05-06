<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="crearArticulo.css">
        <link rel="stylesheet" href="../index/index.css">
    </head>
    <body class="index">
        <?php require_once('../header/header.php') ?>
        <div class="carta-body">
            <form action="../../backend/admin/crearArticulo.php" method="post" enctype="multipart/form-data">
                <h2>Crear Artículo</h2>
                <div>
                    <div class="placeHolder"  onClick="activador()"></div>
                    <img src="https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png" onClick="activador()" id="mostrarProducto">
                    <input class ="subirImagen" type="file" name="imagen" onChange="mostrarImagen(this)" id="imagen">
                </div>
                <div class="campos">
                    <div class="campo">
                        <label for="nArticulo">Nombre</label>
                        <input id="nArticulo" type="text" name="nArticulo" required >
                        <p id="errorArticulo">Algo ha salido mal</p>
                    </div>
                    <div class="campo">
                        <label for="precio">Precio </label>
                        <input id="precio" type="text" name="precio" required >
                        <p id="errorPrecio">Algo ha salido mal</p>
                    </div>
                    <div class="campo">
                        <label for="stock">Stock </label>
                        <input id="stock" type="text" name="stock" required >
                        <p id="errorStock">Algo ha salido mal</p>
                    </div>
                    <div class="campo">
                        <label for="foto">Foto </label>
                        <input id="foto" type="text" name="foto" required >
                        <p id="errorFoto">Algo ha salido mal</p>
                    </div>
                    <div class="campo" >
                        <label for="detalles">Detalles: </label>
                        <textarea name="detalles"><?php echo $fila['detalles'];?></textarea><br><br>
                    </div>
                </div>
                <div>
                    <p><strong><?php echo $error?></strong></p>
                    <button type="submit">Crear</button>
                </div>
            </form>
        </div>
    </body>
</html>
<script src="crearArticulo.js"></script>