<?php

namespace App\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class BitrixDirectlyAuthenticator
 * @package App\Security
 */
class BitrixDirectlyAuthenticator
{
    /**
     * @var AuthenticationManagerInterface
     */
    protected $manager;

    /**
     * @var TokenStorageInterface
     */
    protected $storage;

    /**
     * @var UserProviderInterface
     */
    protected $provider;

    /**
     * BitrixDirectlyAuthenticator constructor.
     * @param UserProviderInterface $provider
     * @param TokenStorageInterface $storage
     * @param AuthenticationManagerInterface $manager
     */
    public function __construct(UserProviderInterface $provider, TokenStorageInterface $storage, AuthenticationManagerInterface $manager)
    {
        $this->manager = $manager;
        $this->storage = $storage;
        $this->provider = $provider;
    }

    /**
     * @return bool
     */
    public function authenticate(): bool
    {
        global $USER;

        if ($USER->IsAuthorized()) {
            if ($entity = $this->provider->loadUserByUsername($USER->GetLogin())) {
                $this->storage->setToken(new UsernamePasswordToken($entity, [], 'main', $entity->getRoles()));

                return true;
            }
        } else {
            $this->storage->setToken(new AnonymousToken('default', 'anon.', []));
        }

        return false;
    }
}