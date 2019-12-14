<?php

namespace App\Security;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Consumer;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * UserProvider constructor.
     * @param EntityManagerInterface $entityManager
     * @internal param Client $httpClient
     * @internal param UserOptionService $userOptionService
     * @internal param ProjectService $projectService
     * @internal param SessionService $sessionService
     * @internal param Session $session
     * @internal param UserOptionService $userOptionsService
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Loads the consumer for the given username.
     *
     * This method must throw UsernameNotFoundException if the consumer is not
     * found.
     *
     * @param string $username The username
     * @return UserInterface
     * @throws NonUniqueResultException
     */
    public function loadUserByUsername($username)
    {
        return $this->entityManager->createQueryBuilder()
            ->where('email = :email')
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Refreshes the consumer.
     *
     * It is up to the implementation to decide if the consumer data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of consumers / identity
     * map.
     *
     * @param UserInterface $consumer
     * @return UserInterface
     *
     */
    public function refreshUser(UserInterface $consumer)
    {
        if (!$consumer instanceof Consumer) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($consumer))
            );
        }
        return $consumer;
    }

    /**
     * Whether this provider supports the given consumer class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return $class === 'App\Security\Consumer';
    }
}
