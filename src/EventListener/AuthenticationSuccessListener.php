<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthenticationSuccessListener
{
    /**
     * Vérifie l'accès API de l'utilisateur authentifié.
     *
     * @param AuthenticationSuccessEvent $event
     * @return void
     */
    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event): void
    {
        $user = $event->getUser();

        if (!$user || !in_array('ROLE_API', $user->getRoles(), true)) {
            throw new HttpException(Response::HTTP_FORBIDDEN, 'Accès API non activé.');
        }
    }
}
