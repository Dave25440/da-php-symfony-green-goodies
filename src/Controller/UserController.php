<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class UserController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $manager,
    ) {}

    /**
     * Affiche la page "Mon compte".
     *
     * @return Response
     */
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

    /**
     * Supprime le compte de l'utilisateur authentifié et invalide la session.
     *
     * @param TokenStorageInterface $tokenStorage
     * @param Request $request
     * @return Response
     */
    #[Route('/account/delete', name: 'app_account_delete', methods: ['DELETE'])]
    public function delete(TokenStorageInterface $tokenStorage, Request $request): Response
    {
        $user = $this->getUser();

        $this->manager->remove($user);
        $this->manager->flush();

        $tokenStorage->setToken(null);
        $request->getSession()->invalidate();

        return $this->redirectToRoute('app_home');
    }
}
