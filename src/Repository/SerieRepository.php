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
     * @return Paginator Returns an array of Serie objects
     */
    public function findGoodSeries() {
        $qb = $this->createQueryBuilder('s');
        $qb->andWhere('s.vote >= 8')
           ->andWhere('s.popularity >= 10')
           ->join('s.seasons', 's ')
           ->addSelect('seas')
           ->addOrderBy('s.vote', 'DESC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();

        return new Paginator($query);
    }

    public function findSeriesByKeywords(string $keywords)
    {
        $qb = $this->createQueryBuilder('m');
        $qb->andWhere("m.title LIKE :kw")
           ->setParameter(":kw", "%$keywords%");
        $qb->setMaxResults(20);
        $query = $qb->getQuery();
        return new Paginator($query);;
    }

    public function countSeries() {
        $qb = $this->createQueryBuilder('s');
        $qb->select('count(s.id)');
//        $query = $qb->getQuery();
        return $qb->getQuery()->getSingleScalarResult();;
    }
}
