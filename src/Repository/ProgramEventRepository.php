<?php

namespace App\Repository;

use App\Entity\ProgramEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProgramEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProgramEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProgramEvent[]    findAll()
 * @method ProgramEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProgramEvent::class);
    }

     /**
      * @return ProgramEvent[] Returns an array of ProgramEvent objects
      */
    public function findClosesDate()
    {
        return $this->createQueryBuilder('d')
            ->where('d.program_start > CURRENT_TIMESTAMP()')
            ->orderBy('d.program_start', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?ProgramEvent
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
