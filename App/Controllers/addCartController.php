<?php

namespace App\Controllers;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class addCartController
{
    /** @var UrlGeneratorInterface */
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function action(Request $request)
    {
        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        $cant_productos = count($_SESSION['cart']);

        //echo "cantidad: " . $cant_productos . "  ";

        $_SESSION['cart'][$cant_productos] = $request->get('id');

        return new RedirectResponse($this->urlGenerator->generate('index'));
    }
}
