<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    public function __construct(
        private RequestStack $requestStack,
    ) {}

    /**
     * Affiche la page produit.
     *
     * @param Product|null $product Le produit affiché ou null si non trouvé.
     * @return Response
     */
    #[Route('/product/{id}', name: 'app_product', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(?Product $product): Response
    {
        $session = $this->requestStack->getSession();

        $cart = $session->get('cart', []);
        $quantity = 0;

        // Récupère la quantité du produit dans le panier.
        if ($product && isset($cart[$product->getId()])) {
            $quantity = $cart[$product->getId()];
        }

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'quantity' => $quantity,
        ]);
    }
}
