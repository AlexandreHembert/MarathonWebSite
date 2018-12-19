<?php
/**
 * Created by PhpStorm.
 * User: hemery
 * Date: 2018-12-06
 * Time: 18:28
 */

namespace App\Repository;

use App\Entity\Histoire;
use App\Entity\HistoireSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

class HistoireRepository extends ServiceEntityRepository {
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Histoire::class);
    }


/*
    /**
     * @return Query

    public function findAllVisibleQuery(HistoireSearch $search) : QueryBuilder
    {
        $query = $this->findVisibleQuery();

        if ($search->getGenres()->count() > 0) {
            $k=0;
            //filtre les genres
            foreach($search->getGenres() as $genre) {
                $k++;
                $query=$query
                    ->andWhere(":genre$k MEMBER OF p.genres")
                    ->setParameter("genre$k",$genre);
            }

        }

        return $query->getQuery();
    }
*/


    public function findVisibleQuery(): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.actif = true')
            ->getQuery()
            ->getResult();
    }


}