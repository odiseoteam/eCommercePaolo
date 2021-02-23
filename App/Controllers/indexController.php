<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

session_start();

class indexController
{
    /** @var EntityManager */
    private $entityManager;

    /** @var UrlGeneratorInterface */
    private $urlGenerator;

    /** @var Environment */
    private $templateEngine;

    public function __construct(
        EntityManager $entityManager,
        UrlGeneratorInterface $urlGenerator,
        Environment $templateEngine
    )
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->templateEngine = $templateEngine;
    }

    public function action()
    {
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
            'src_images_products' => $src_images_products,
            'url_generator' => $this->urlGenerator,
        ]));

        return $response;
    }
}
