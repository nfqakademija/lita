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
    public function filterAcademies(FiltersData $filtersData)
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
        $query = $this->getEntityManager()->createQueryBuilder();
        $query
            ->select('academy')
            ->from('App:Academy', 'academy')
            ->leftJoin('academy.programs', 'programs')
            ->leftJoin('programs.events', 'events')
            ->leftJoin('events.cities', 'cities');

        if ($filtersData->getProgramName() !== null) {
            $query->andWhere('programs.program_name = :program_name');
            $query->setParameter('program_name', $filtersData->getProgramName());
        }

        if ($filtersData->getCity() !== null) {
            $query->andWhere('cities.city = :city');
            $query->setParameter('city', $filtersData->getCity());
        }

        if ($filtersData->getProgramPrice() !== null) {
            if ($filtersData->getProgramPrice() == 'FREE') {
                $query->andWhere('(programs.program_price = :program_price OR programs.program_price IS null)');
                $query->setParameter('program_price', 0.0);
            }
            if ($filtersData->getProgramPrice() == 'Cheaper-First') {
                $query->orderBy('programs.program_price', 'ASC');
            }
            if ($filtersData->getProgramPrice() == 'Expensive-First') {
                $query->orderBy('programs.program_price', 'DESC');
            }
        }

        return $query;
    }
}
