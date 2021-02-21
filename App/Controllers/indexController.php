<?php
namespace App\Controllers;

//$_SESSION = array();
//session_unset();
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

session_start();

class indexController
{
    private $entityManager;
    protected $templateEngine;
    /*
    public function __construct(){
        $loader = new \Twig\Loader\FilesystemLoader('../../views');
        $this->templateEngine = new \Twig\Environment($loader, [
            'debug' => true,
            'cache' => false
        ]);
    }*/

    public function __construct(EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }

    public function action(){

        $loader = new \Twig\Loader\FilesystemLoader('../views');
        $this->templateEngine = new \Twig\Environment($loader, [
            'debug' => true,
            'cache' => false
        ]);

        $src_images = "/images/";
        $src_images_products = "/images/Products/";
        $page_title = "Paolo's Commerce";
        $head_title = $page_title;

        $repo = $this->entityManager->getRepository('App\Entities\AppProduct');

        $productos = $repo->findAll();

        $response = new Response($this->templateEngine->render('index.html.twig', [
                'head_title' => $head_title,
                'page_title' => $page_title,
                'productos' => $productos,
                'src_images' => $src_images,
                'src_images_products' => $src_images_products
        ]));

        return $response;
    }
}