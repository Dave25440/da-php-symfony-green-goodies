<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/account', name: 'app_account', methods: ['GET'])]
    public function show(): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $orders = $user->getOrders();

        return $this->render('user/show.html.twig', [
            'user' => $user,
            'orders' => $orders,
        ]);
    }
}
