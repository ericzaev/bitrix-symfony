<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class BitrixAuthenticator extends AbstractGuardAuthenticator
{
    public function supports(Request $request)
    {
        return false;
    }

    public function getCredentials(Request $request)
    {
        global $USER;

        return ['username' => $USER->GetLogin(), 'is_authorized' => $USER->IsAuthorized()];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return empty($credentials['username']) ? null : $userProvider->loadUserByUsername($credentials['username']);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $credentials['is_authorized'];
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        throw new AuthenticationException('Authentication Failure');
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {

    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse(['message' => 'Authentication Required'], Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
