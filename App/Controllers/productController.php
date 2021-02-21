<?php
namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

class productController
{
    private $entityManager;
    protected $templateEngine;

    public function __construct(EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }

    public function action($id, Request $request){

        $head_title = 'Producto';
        $page_title = "Paolo's Commerce - PRODUCTO";
        $src_images_products = "/images/Products/";

        $loader = new \Twig\Loader\FilesystemLoader('../views');
        $this->templateEngine = new \Twig\Environment($loader, [
            'debug' => true,
            'cache' => false
        ]);

        //$id = $request->get('id');
        $repo = $this->entityManager->getRepository('App\Entities\AppProduct');

        $producto = $repo->find($id);

        $response = new Response($this->templateEngine->render('product.html.twig', [
            'head_title' => $head_title,
            'page_title' => $page_title,
            'src_images_products' => $src_images_products,
            'producto' => $producto
        ]));

        return $response;
    }
}