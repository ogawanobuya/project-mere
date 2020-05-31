<?php

namespace App\Repository;

use App\Entity\IdeaAsk;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IdeaAsk|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdeaAsk|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdeaAsk[]    findAll()
 * @method IdeaAsk[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdeaAskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IdeaAsk::class);
    }

    /**
     * @param IdeaAsk $ideaAsk
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(IdeaAsk $ideaAsk)
    {
        $em = $this->getEntityManager();
        $em->persist($ideaAsk);
        $em->flush();
    }

    // /**
    //  * @return IdeaAsk[] Returns an array of IdeaAsk objects
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
    public function findOneBySomeField($value): ?IdeaAsk
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
