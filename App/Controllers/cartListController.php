<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use Twig\Environment;

class cartListController
{
    /** @var EntityManager */
    private $entityManager;

    /** @var Environment */
    private $templateEngine;

    public function __construct(
        EntityManager $entityManager,
        Environment $templateEngine
    )
    {
        $this->entityManager = $entityManager;
        $this->templateEngine = $templateEngine;
    }

    public function action()
    {
        $head_title = "Paolo's Commerce - PRODUCTOS AGREGADOS AL CARRITO";
        $page_title = $head_title;
        $src_images_products = "/images/Products/";

        $productos = null;

        if(isset($_SESSION['cart'])){
            $cant_productos = count($_SESSION['cart']);
            $cart_products='';

            for($i=0; $i < $cant_productos; $i++){
                $cart_products .=  $_SESSION['cart'][$i] . ',';
            }

            $cart_products = trim($cart_products, ',');

            $repo = $this->entityManager->getRepository('App\Entities\AppProduct');

            $productos = $repo->createQueryBuilder('product')
                ->select('product.name, product.price, product.imagen')
                ->where('product.id in ('.$cart_products.')')
                ->getQuery()
                ->getResult();
        }

        $response = new Response($this->templateEngine->render('cart_list.html.twig', [
            'head_title' => $head_title,
            'page_title' => $page_title,
            'src_images_products' => $src_images_products,
            'productos' => $productos
        ]));

        return $response;
    }
}
