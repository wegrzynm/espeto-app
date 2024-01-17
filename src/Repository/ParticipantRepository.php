<?php

namespace App\Repository;

use App\Entity\Participant;
use App\Entity\Restaurant;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Restaurant>
 *
 * @method Restaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurant[]    findAll()
 * @method Restaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participant::class);
    }

    /**
    * @return Restaurant[] Returns an array of Restaurant objects
    */
   public function countAllFromCurrentEvents(DateTime $date): array
   {
       return $this->createQueryBuilder('r')
            ->join('r.contest', 'c', 'r.contest = c.id')
           ->where('c.startDate >= :val')
           ->orWhere('c.endDate >= :val')
           ->setParameter('val', $date)
           ->orderBy('c.startDate', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }
    
    /**
    * @return Restaurant[] Returns an array of Restaurant objects
    */
   public function findAllFromCurrentEvents(DateTime $date, int $offset, int $maxResults): array
   {
       return $this->createQueryBuilder('r')
            ->join('r.contest', 'c', 'r.contest = c.id')
           ->where('c.startDate >= :val')
           ->orWhere('c.endDate >= :val')
           ->setParameter('val', $date)
           ->orderBy('c.startDate', 'ASC')
           ->setFirstResult($offset)
           ->setMaxResults($maxResults)
           ->getQuery()
           ->getResult()
       ;
   }


//    /**
//     * @return Restaurant[] Returns an array of Restaurant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Restaurant
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
