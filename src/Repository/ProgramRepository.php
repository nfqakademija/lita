<?php

namespace App\Repository;

use App\Entity\Program;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Program|null find($id, $lockMode = null, $lockVersion = null)
 * @method Program|null findOneBy(array $criteria, array $orderBy = null)
 * @method Program[]    findAll()
 * @method Program[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Program::class);
    }

    /**
     * @param int $academyId
     * @return mixed
     */
    public function findMinPriceByAcademy(int $academyId)
    {
        return $this->createQueryBuilder('p')
            ->select('MIN(p.program_price) as min_price, MAX(p.program_price) as max_price')
            ->where('p.academy = :academy_id')
            ->setParameter('academy_id', $academyId)
            ->setMaxResults(1)
            ->getQuery()
            ->execute();
    }

    public function findAcademyCities(int $academyId)
    {
        return $this->createQueryBuilder('p')
            ->select('DISTINCT ')
            ->where('p.academy = :academy_id')
            ->setParameter('academy_id', $academyId)
            ->setMaxResults(1)
            ->getQuery()
            ->execute();
    }
}
