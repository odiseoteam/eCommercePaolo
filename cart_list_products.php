<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'datos_conexion.php';

if(!session_id()){
    session_start();
}

if(!isset($_SESSION['cart'])){
    $cant_productos = 0;
}else{
    $cant_productos = count($_SESSION['cart']);
}

$cart_products='';

for($i=0; $i < $cant_productos; $i++){
    $cart_products .=  $_SESSION['cart'][$i] . ',';
}

$cart_products = trim($cart_products, ',');

$src_images = "images\\Products\\";
?>


<!doctype html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="index.css" rel="stylesheet">
    <style type="text/css">
        img {object-fit: contain;
            float: left;
            width: 5%;
            height: 5%;
        }
    </style>
    <title>Paolo's Commerce - PRODUCTOS AGREGADOS AL CARRITO</title>
</head>

<body id="body">
    <!-- Header -->
    <nav id="header" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                Paolo's Commerce - PRODUCTOS AGREGADOS AL CARRITO
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
    <?php
    echo '    <div class="row justify-content-md-center">';
    echo '        <div class="col-lg-6">';
    echo '            <ul class="list-group">';
    if($cart_products > 0) {
        $conexion = mysqli_connect($data_connect['DB_HOST'], $data_connect['DB_USER'],
            $data_connect['DB_PASS'], $data_connect['DB_NAME'])
        or die("Problemas con la conexión");

        $productos = mysqli_query($conexion,
            "SELECT name, price, imagen FROM app_product where id in (" . $cart_products . ")")
        or die("Problemas en el select" . mysqli_error($conexion));

        while ($producto = mysqli_fetch_array($productos)) {
            echo '    <li class="list-group-item">';
            echo '      <img src="' . $src_images . $producto['imagen'] . '" class="img-fluid" alt="...">';
            echo '<div>' . $producto['name'] . '. Precio: ' . number_format($producto['price'] / 100,2) . '</div>';
            echo '    </li>';
        }
        mysqli_close($conexion);
    }else{
        echo '<li class="list-group-item">No hay productos cargados en el carrito</li>';
    }
    echo '            </ul>';
    echo '        </div>';
    echo '    </div>';

    ?>
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
