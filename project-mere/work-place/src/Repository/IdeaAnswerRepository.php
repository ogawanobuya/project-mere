<?php

namespace App\Repository;

use App\Entity\IdeaAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IdeaAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdeaAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdeaAnswer[]    findAll()
 * @method IdeaAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdeaAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IdeaAnswer::class);
    }

    /**
     * @param IdeaAnswer $ideaAnswer
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(IdeaAnswer $ideaAnswer)
    {
        $em = $this->getEntityManager();
        $em->persist($ideaAnswer);
        $em->flush();
    }

    // /**
    //  * @return IdeaAnswer[] Returns an array of IdeaAnswer objects
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
    public function findOneBySomeField($value): ?IdeaAnswer
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
