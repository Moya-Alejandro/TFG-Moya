<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="crearArticulo.css">
    <link rel="stylesheet" href="../index/index.css">
</head>
<body class="index">
    <?php require_once('../header/header.php') ?>
    <form action="../../backend/admin/crearArticulo.php" method="post" enctype="multipart/form-data">
        Selecciona una imagen
        <h2>Update profile</h2>
          <div>
              <div class="placeHolder"  onClick="activador()">
                <h4>Update image</h4>
              </div>
              <img src="../img/avatar.png" onClick="activador()" id="mostrarProducto">
            </span>
            <input type="file" name="imagen" onChange="mostrarImagen(this)" id="imagen" style="display: none;">
            <label>Perfil Imagen</label>
          </div>
          <div class="form-group">
            <label>Escribe</label>
            <textarea name="area"></textarea>
          </div>
          <div>
            <button type="submit">Save User</button>
          </div>
    </form>
</body>
</html>
<script src="crearArticulo.js"></script>