<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

final class UserController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $manager,
        private TokenStorageInterface $tokenStorage,
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
            'orders' => $orders,
        ]);
    }

    /**
     * Active l'accès API de l'utilisateur authentifié.
     *
     * @return Response
     */
    #[Route('/account/api/enable', name: 'app_account_api_enable', methods: ['POST'])]
    public function enableApiAccess(): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $roles = $user->getRoles();

        if (!in_array('ROLE_API', $roles, true)) {
            $roles[] = 'ROLE_API';
            $user->setRoles($roles);

            $this->manager->persist($user);
            $this->manager->flush();

            $token = new UsernamePasswordToken($user, 'main', $roles);
            $this->tokenStorage->setToken($token);
        }

        return $this->redirectToRoute('app_account');
    }

    /**
     * Désactive l'accès API de l'utilisateur authentifié.
     *
     * @return Response
     */
    #[Route('/account/api/disable', name: 'app_account_api_disable', methods: ['POST'])]
    public function disableApiAccess(): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $roles = $user->getRoles();

        if (in_array('ROLE_API', $roles, true)) {
            $roles = array_diff($roles, ['ROLE_API']);
            $user->setRoles($roles);

            $this->manager->persist($user);
            $this->manager->flush();

            $token = new UsernamePasswordToken($user, 'main', $roles);
            $this->tokenStorage->setToken($token);
        }

        return $this->redirectToRoute('app_account');
    }

    /**
     * Supprime le compte de l'utilisateur authentifié et invalide la session.
     *
     * @param TokenStorageInterface $tokenStorage
     * @param Request $request
     * @return Response
     */
    #[Route('/account/delete', name: 'app_account_delete', methods: ['DELETE'])]
    public function delete(Request $request): Response
    {
        $user = $this->getUser();

        $this->manager->remove($user);
        $this->manager->flush();

        $this->tokenStorage->setToken(null);
        $request->getSession()->invalidate();

        return $this->redirectToRoute('app_home');
    }
}
