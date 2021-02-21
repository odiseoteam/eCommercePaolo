<?php
namespace App\Controllers;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use App\Entities\AppProduct;

class addProductsController
{
    private $entityManager;

    public function __construct(EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }

    public function action(Request $request){
        $head_title = 'Alta de Productos';
        $page_title = "Paolo's Commerce - ALTA DE PRODUCTO";

        $loader = new \Twig\Loader\FilesystemLoader('../views');
        $this->templateEngine = new \Twig\Environment($loader, [
            'debug' => true,
            'cache' => false
        ]);

        if ($_SERVER['PHP_AUTH_USER'] <> 'pepe' && $_SERVER['PHP_AUTH_PW'] <> 'tito') {
            header('WWW-Authenticate: Basic realm="Ingresar usuario y contraseña"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Contraseña incorrecta';
            exit;
        }

        if($_POST){
            $uploads_dir = '../web/images/Products/';
            $name_image = null;

            if ($_FILES){
                $tmp_name = $_FILES['imagen']['tmp_name'];
                $name_image = basename($_FILES['imagen']['name']);
                move_uploaded_file($tmp_name, $uploads_dir . $name_image);
            }

            $producto = new AppProduct();
            $producto->setName($request->get('name'));
            $producto->setPrice($request->get('price'));
            //despues me fijo bien còmo obtener la image name del request
            //$product->setImagen($request->files->get('imagen'));
            $producto->setImagen($name_image);
            $producto->setDescription($request->get('description'));

            $this->entityManager->persist($producto);

            $this->entityManager->flush();
            //en caso de que haya error en el flush, averiguar cómo capturarlo
            $insert = true;
        }

        $response = new Response($this->templateEngine->render('add_products.html.twig', [
            'inserto' => $insert,
            'head_title' => $head_title,
            'page_title' => $page_title
        ]));

        return $response;
    }
}