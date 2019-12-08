<?php

namespace App\Repository;

use App\Entity\Consumer;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @method Consumer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consumer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consumer[]    findAll()
 * @method Consumer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class ConsumerRepository extends EntityRepository implements UserLoaderInterface
{
    // ...

    public function loadUserByUsername($usernameOrEmail)
    {
        return $this->createQuery(
            'SELECT u
                FROM App\Entity\Consumer u
                WHERE u.username = :query
                OR u.email = :query'
        )
            ->setParameter('query', $usernameOrEmail)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
