<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$_SESSION = array();
session_unset();
session_destroy();
/*
if (ini_get("session.use_cookies"))
{
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]);
}*/

session_start();

include_once 'datos_conexion.php';

$src_images = "images\\Products\\";
?>

<!doctype html>
<html lang="en">
	<head>
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">	
		<link href="index.css" rel="stylesheet">
		<title>Paolo's Commerce</title>
	</head>
	
	<body id="body">
		<!-- Header -->
		<nav id="header" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			<div class="container">
				<a class="navbar-brand" href="#">
					Paolo's Commerce
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse justify-content-end" id="navbar">
					<ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a type="button" class="btn btn-secondary" href="cart_list_products.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                            </a>
                        </li>
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
		
		<div id="contenedor-principal" class="container mt-5">
			<div class="row">		
				<!-- Categorias -->
				<div id="categorias" class="container">
					<div class="row">
						<div class="col-lg-12">
							<ul class="nav justify-content-center">
								<li class="nav-item"><a href="add_products.php" class="nav-link">Agregar Productos</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Category 2</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Category 3</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Category 4</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Categorias -->

				<!-- Carousel -->
				<section id="carousel">
					<div id="carousel-bs" class="carousel slide" data-bs-ride="carousel">
					  <ol class="carousel-indicators">
						<li data-bs-target="#carousel-bs" data-bs-slide-to="0" class="active"></li>
						<li data-bs-target="#carousel-bs" data-bs-slide-to="1"></li>
						<li data-bs-target="#carousel-bs" data-bs-slide-to="2"></li>
					  </ol>
					  <div class="carousel-inner">
						<div class="carousel-item active">
						  <img src="images\01.jpg" class="d-block w-100" alt="Armin">
						</div>
						<div class="carousel-item">
						  <img src="images\02.jpg" class="d-block w-100" alt="Erwin">
						</div>
						<div class="carousel-item">
						  <img src="images\03.jpg" class="d-block w-100" alt="Pelado">
						</div>
					  </div>
					  <a class="carousel-control-prev" href="#carousel-bs" role="button" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#carousel-bs" role="button" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					  </a>
					</div>	
				</section>
				<!-- /Carousel -->
				
				<!-- Productos -->
				<Section id="listado-productos" class="mt-4 mb-4">
					<div class="container">
						<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
							<?php
                                //var_dump(session_id());
								$conexion = mysqli_connect($server, $user, $pass, $dataBase)
									or die("Problemas con la conexión");

								$productos = mysqli_query($conexion, "SELECT id, name, price, imagen from app_product")
									or die("Problemas en el select:" . mysqli_error($conexion));

								while ($producto = mysqli_fetch_array($productos)) {
									echo ' <div class="col">';
									echo '    <div class="card">';
									echo '      <img src="'. $src_images . $producto['imagen'] .'" class="card-img-top" alt="...">';
									echo '      <div class="card-body">';
									echo '        <h5 class="card-title"><a href="product.php?id='. $producto['id'] .'">'. $producto['name'] . '</a></h5>';
									echo '        <h5 id="price"> $' . number_format($producto['price'] / 100,2) . '</h5>';
									echo '        <a class="btn btn-primary btn-sm" href="add_cart.php?id=' . $producto['id'] . '">Add to cart</a>';
									echo '        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>';
									echo '      </div>';
									echo '    </div>';
									echo '</div>';
								}
								mysqli_close($conexion);
							?>
						</div>
					</div>
				</Section>
				<!-- /Productos -->
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