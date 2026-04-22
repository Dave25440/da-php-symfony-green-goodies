<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CartController extends AbstractController
{
    public function __construct(
        private RequestStack $requestStack,
    ) {}

    /**
     * Affiche la page "Mon panier".
     *
     * @param CartService $cartService Permet de récupérer le panier.
     * @return Response
     */
    #[Route('/cart', name: 'app_cart', methods: ['GET'])]
    public function show(CartService $cartService): Response
    {
        $cart = $cartService->getCart();

        return $this->render('cart/show.html.twig', [
            'cartItems' => $cart['cartItems'],
            'total' => $cart['total'],
        ]);
    }

    /**
     * Ajoute le produit au panier avec la quantité.
     *
     * @param Product $product
     * @param Request $request
     * @return Response
     */
    #[Route('/cart/add/{id}', name: 'app_cart_add', methods: ['POST'])]
    public function add(Product $product, Request $request): Response
    {
        $session = $this->requestStack->getSession();

        $cart = $session->get('cart', []);
        $order = $session->get('order', []);

        $id = $product->getId();

        $quantity = (int) $request->request->get('quantity', 1);

        if ($quantity <= 0) {
            unset($cart[$id]);
            $order = array_filter($order, fn($productId) => $productId !== $id);
        } else {
            $cart[$id] = $quantity;

            if (!in_array($id, $order)) {
                $order[] = $id;
            }
        }

        $session->set('cart', $cart);
        $session->set('order', $order);

        return $this->redirectToRoute('app_cart');
    }

    /**
     * Vide le panier.
     *
     * @return Response
     */
    #[Route('/cart/empty', name: 'app_cart_empty', methods: ['GET'])]
    public function empty(): Response
    {
        $session = $this->requestStack->getSession();

        $session->remove('cart');
        $session->remove('order');

        return $this->redirectToRoute('app_cart');
    }
}
