<?php

namespace App\Repository;

use App\Entity\ContestHost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContestHost>
 *
 * @method ContestHost|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContestHost|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContestHost[]    findAll()
 * @method ContestHost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContestHostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContestHost::class);
    }

//    /**
//     * @return ContestHost[] Returns an array of ContestHost objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ContestHost
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
