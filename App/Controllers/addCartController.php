<?php
namespace App\Controllers;
use Symfony\Component\HttpFoundation\RedirectResponse;

class addCartController
{
    public function action(){
        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        $cant_productos = count($_SESSION['cart']);

        //echo "cantidad: " . $cant_productos . "  ";

        $_SESSION['cart'][$cant_productos] = $_GET['id'];

        $response = new RedirectResponse('http://dev.paolo-ecommerce.com/front.php');

        return $response;
    }

}