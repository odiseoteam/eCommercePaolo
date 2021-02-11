<!DOCTYPE html>
<?php
if ($_SERVER['PHP_AUTH_USER'] <> 'pepe' && $_SERVER['PHP_AUTH_PW'] <> 'tito') {
    header('WWW-Authenticate: Basic realm="Ingresar usuario y contraseña"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Contraseña incorrecta';
    exit;
}


include_once 'datos_conexion.php';

if($_POST){

    $conexion = mysqli_connect($data_connect['DB_HOST'], $data_connect['DB_USER'],
                    $data_connect['DB_PASS'], $data_connect['DB_NAME'])
    or die("Problemas con la conexión");

    //$uploads_dir = '/images/Products';
    //$uploads_dir = "images\\Products\\";
    $uploads_dir = 'images/Products/';
    $name_image = null;

    if ($_FILES){
        $tmp_name = $_FILES['imagen']['tmp_name'];
        $name_image = basename($_FILES['imagen']['name']);
        //copy($tmp_name, "$uploads_dir/$name_image");
        move_uploaded_file($tmp_name, $uploads_dir . $name_image);
    }

    $insert = mysqli_query($conexion, "INSERT INTO app_product(name, price, imagen, description) 
                           VALUES ('$_POST[name]', $_POST[price] ,'$name_image', '$_POST[description]')")
    or die("Problemas en el select" . mysqli_error($conexion));

    mysqli_close($conexion);
}

?>

<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="index.css" rel="stylesheet">
    <title>Alta de Productos</title>
</head>
<body>

<!-- Header -->
<nav id="header" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            Paolo's Commerce - ALTA DE PRODUCTO
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Service</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- /Header -->
<div id="contenedor-principal" class="container pt-5 mt-5 mb-2">
    <div class="row justify-content-md-center">
        <div class="col-lg-6 shadow p-3 mb-5 bg-white rounded">
            <form action="add_products.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="name" aria-describedby="nombreHelp">
                    <div id="nombreHelp" class="form-text">Subi productos copados</div>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="numeric" class="form-control" id="precio" name="price" aria-describedby="precioHelp">
                    <div id="precioHelp" class="form-text">Dos decimales</div>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" name="description">
                </div>
                <div class="mb-3">
                    <label for="imagen" class="form-label">Eliga una imagen para el producto</label>
                    <input class="form-control" type="file" id="imagen" name="imagen" accept="image/png, image/jpeg, image/jpg">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <?php
                if ($insert){
                    echo '<span class="badge bg-success">Success!!</span>';
                }
                ?>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<footer id="footer" class="pb-4 pt-4">
    <div class="container">
        <div class="row text-center">
            <div class="col-12 col-lg">
                Copyright © Your Website 2020
            </div>
        </div>
    </div>
</footer>
<!-- /Footer -->

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
-->

</body>
</html>