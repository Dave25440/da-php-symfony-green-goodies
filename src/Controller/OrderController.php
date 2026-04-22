<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OrderController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $manager,
        private RequestStack $requestStack,
    ) {}

    #[Route('/order/new', name: 'app_order_new', methods: ['POST'])]
    public function new(CartService $cartService): Response
    {
        $user = $this->getUser();
        $cart = $cartService->getCart();

        if (empty($cart['cartItems'])) {
            $this->addFlash('warning', 'Votre panier est vide.');

            return $this->redirectToRoute('app_cart');
        }

        $order = new Order();
        $order->setDate(new \DateTimeImmutable());
        $order->setTotal($cart['total']);
        $order->setUser($user);

        foreach ($cart['cartItems'] as $item) {
            $orderItem = new OrderItem();
            $orderItem->setQuantity($item['quantity']);
            $orderItem->setPrice($item['product']->getPrice());
            $orderItem->setProduct($item['product']);
            $orderItem->setPurchase($order);

            $order->addOrderItem($orderItem);
        }

        $this->manager->persist($order);
        $this->manager->flush();

        $session = $this->requestStack->getSession();
        $session->remove('cart');
        $session->remove('order');

        $this->addFlash('success', 'Votre commande a été enregistrée.');

        return $this->redirectToRoute('app_account');
    }
}
