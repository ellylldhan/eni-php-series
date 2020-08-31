<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Serie::class);
    }

     /**
      * @return Serie[] Returns an array of Serie objects
      */
    public function findGoodSeries() {

        // Methode avec QueryBuilder
//        $qb = $this->createQueryBuilder('s');
//        $qb->andWhere('s.vote >= 8')
//           ->andWhere('s.popularity >= 10')
//           ->addOrderBy('s.vote', 'DESC');
//        $qb->setMaxResults(30);
//        $query = $qb->getQuery();
//        return $query->getResult();

        // Methode avec EntityManager
        $em    = $this->getEntityManager();
        $dql   = "SELECT s 
                FROM App\Entity\Serie s 
                WHERE s.vote >= 8 
                AND s.popularity >= 10 
                ORDER BY s.vote DESC";
        $query = $em->createQuery($dql);
        $query->setMaxResults(30);
        $query->setFirstResult(0);

        return $query->getResult();
    }

    /**
     * @return Paginator Returns an array of Serie objects
     */
    public function findTotalSeasons() {
        $qb = $this->createQueryBuilder('s');
        $qb->andWhere('s.vote >= 8')
           ->andWhere('s.popularity >= 10')
            ->join('s.seasons', 's ')
           ->addOrderBy('s.vote', 'DESC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);


    // /**
    //  * @return Serie[] Returns an array of Serie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Serie
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


}
