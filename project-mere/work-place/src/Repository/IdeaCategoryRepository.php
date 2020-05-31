<?php

namespace App\Repository;

use App\Entity\IdeaCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IdeaCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdeaCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdeaCategory[]    findAll()
 * @method IdeaCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdeaCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IdeaCategory::class);
    }

    // /**
    //  * @return IdeaCategory[] Returns an array of IdeaCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IdeaCategory
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
