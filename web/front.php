<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

include "../config_doctrine.php";

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;

$request = Request::createFromGlobals();
$routes = new RouteCollection();

$routes->add('index', new Route('/', [
    '_controller' => [new App\Controllers\indexController($entityManager), 'action']
]));

$routes->add('add_products', new Route('/add_products', [
    '_controller' => [new App\Controllers\addProductsController($entityManager), 'action']
]));

$routes->add('add_cart', new Route('/add_cart', [
    '_controller' => [new App\Controllers\addCartController(), 'action']
]));

$routes->add('cart_list', new Route('/cart_list', [
    '_controller' => [new App\Controllers\cartListController($entityManager), 'action']
]));

$routes->add('product', new Route('/product/{id}', [
    'id' => null,
    '_controller' => [new App\Controllers\productController($entityManager), 'action']
]));

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

try{
    $request->attributes->add($matcher->match($request->getPathInfo()));

    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);

    //$response = new Response();
    //$response->setContent(call_user_func($request->attributes->get('_controller'), $request));
    //$response = new Response(call_user_func_array($controller, $arguments));
    $response = call_user_func_array($controller, $arguments);
    //$response->setContent(call_user_func_array($controller, $arguments));
}catch (Routing\Exception\ResourceNotFoundException $exception) {
    $response = new Response('Not Found', 404);
}catch (Exception $exception) {
    $response = new Response($exception->getMessage(), 500);
}

$response->send();