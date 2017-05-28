<?php

namespace AppBundle\Repository;

/**
 * AnnonceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnnonceRepository extends \Doctrine\ORM\EntityRepository
{
    public function getFrontPageAnnonce()
    {
        $qb = $this->createQueryBuilder('a');
        $query = $qb->where('a.landing = ?1')
          ->setParameter(1, true)
          ->getQuery();
        return $query;
    }
    public function getAnnoncesByQuery($location, $dateD, $dateF)
    {
        $qb = $this->createQueryBuilder('ann');
        $expression = $qb->expr();
        $query = $qb->join('ann.adresseVoiture', 'adr')
            ->join('adr.ville', 'vi', 'WITH', $qb->expr()->eq('vi.ville', '?1'))
            ->addSelect('adr')
            ->join('ann.calendrier', 'ca')
            ->where($expression->andx($expression->between('ca.dateStatus', '?2', '?3'), $expression->eq('ca.isFree', '?4')))
            ->addSelect('ca')
            ->setParameter(1, $location)
            ->setParameter(2, $dateD)
            ->setParameter(3, $dateF)
            ->setParameter(4, true)
            ->getQuery();
        return $query;
    }
    public function getAnnoncesByUser($user)
    {
        $qb = $this->createQueryBuilder('ann');
        $expression = $qb->expr();
        $query = $qb
          ->where($expression->eq('ann.loueur', '?1'))
          ->setParameter(1, $user)
          ->getQuery();
        return $query;
    }
}
