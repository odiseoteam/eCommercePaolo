<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!session_id()){
    session_start();
}

if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$cant_productos = count($_SESSION['cart']);

echo "cantidad: " . $cant_productos . "  ";

$_SESSION['cart'][$cant_productos] = $_GET['id'];

$cant_productos++;

header("location: index.php");