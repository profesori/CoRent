<?php

namespace AppBundle\Repository;

/**
 * ModeleVoitureRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ModeleVoitureRepository extends \Doctrine\ORM\EntityRepository
{
    public function getPriceByModel($modele)
    {
        $qb = $this->createQueryBuilder('m');
        $query = $qb
        ->where($qb->expr()->eq('m', '?1'))
        ->join('m.categorie', 'c')
        ->addSelect('c')
        ->setParameter(1, $modele)
        ->getQuery();

        return $query;
    }
}
