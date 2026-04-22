<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CartController extends AbstractController
{
    public function __construct(
        private RequestStack $requestStack,
    ) {}

    #[Route('/cart', name: 'app_cart', methods: ['GET'])]
    public function show(CartService $cartService): Response
    {
        $cart = $cartService->getCart();

        return $this->render('cart/show.html.twig', [
            'cartItems' => $cart['cartItems'],
            'total' => $cart['total'],
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add', methods: ['GET'])]
    public function add(Product $product): Response
    {
        $session = $this->requestStack->getSession();

        $cart = $session->get('cart', []);
        $order = $session->get('order', []);

        $id = $product->getId();

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
            $order[] = $id;
        }

        $session->set('cart', $cart);
        $session->set('order', $order);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/empty', name: 'app_cart_empty', methods: ['GET'])]
    public function empty(): Response
    {
        $session = $this->requestStack->getSession();

        $session->remove('cart');
        $session->remove('order');

        return $this->redirectToRoute('app_cart');
    }
}
