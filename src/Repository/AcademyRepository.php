<?php

namespace App\Repository;

use App\Dto\FiltersData;
use App\Entity\Academy;
use App\Entity\Program;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Academy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Academy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Academy[]    findAll()
 * @method Academy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcademyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Academy::class);
    }

    /**
     * @param FiltersData $filtersData
     * @return Collection
     */
    public function filterPrograms(FiltersData $filtersData)
    {
        $query = $this->createQuerywithFiltersApplied($filtersData);

        return $query->getQuery()->getResult();
    }

    /**
     * @param FiltersData $filtersData
     * @return QueryBuilder
     */
    protected function createQueryWithFiltersApplied(FiltersData $filtersData): QueryBuilder
    {
        $query = $this->getEntityManager()->createQueryBuilder('a');
        $query
            ->select('a')
            ->from('App:Academy', 'a')
            ->leftJoin(
                'a.programs', 'p'
            )
            ->andWhere('p.program_name      = :program_name')
            ->andWhere('p.program_price     = :program_price')
            ->setParameters([
                'p.program_name', $filtersData->getProgramName(),
                'p.program_price', $filtersData->getProgramPrice()
            ]);

        return $query;
    }

    /**
     * @param FiltersData $filtersData
     * @return int
     */
    public function countMatchingPrograms(FiltersData $filtersData): int
    {
        try {
            $query = $this->createQueryWithFiltersApplied($filtersData);

            return (int)count($query->getQuery()->getResult());
        } catch (\Throwable $e) {
            return 0;
        }
    }
}
