<?php

namespace Easy\Bundle\VentesBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository
{
    public function findProductsType($id)
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->join('p.categories', 'cat', 'WITH', 'cat.id = :categ_id')
            ->addSelect('cat')
            ->setParameter('categ_id', $id)
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}
