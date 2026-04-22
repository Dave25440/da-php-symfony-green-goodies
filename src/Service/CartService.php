<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    public function __construct(
        private RequestStack $requestStack,
        private ProductRepository $productRepository,
    ) {}

    public function getCart(): array
    {        
        $session = $this->requestStack->getSession();

        $cart = $session->get('cart', []);
        $order = $session->get('order', []);

        $cartItems = [];
        $total = 0;

        if (!empty($cart)) {
            $products = $this->productRepository->findBy(['id' => array_keys($cart)]);
            $productsById = [];

            foreach ($products as $product) {
                $productsById[$product->getId()] = $product;
            }

            foreach ($order as $id) {
                if (!isset($productsById[$id])) {
                    continue;
                }

                $product = $productsById[$id];
                $quantity = $cart[$id];

                $itemTotal = $product->getPrice() * $quantity;

                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'itemTotal' => $itemTotal,
                ];

                $total += $itemTotal;
            }
        }

        return [
            'cartItems' => $cartItems,
            'total' => $total,
        ];
    }
}
