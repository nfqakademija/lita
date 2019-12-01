<?php

namespace App\Repository;

use App\Dto\FiltersData;
use App\Entity\Program;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

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
        $query = $this->createQueryBuilder('p');

        if ($filtersData->getProgramName()) {
            $query->andWhere('p.program_name = :program_name')
                ->setParameter('program_name', $filtersData->getProgramName());
        }
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
