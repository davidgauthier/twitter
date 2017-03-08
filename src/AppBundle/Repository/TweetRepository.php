<?php

namespace AppBundle\Repository;

/**
 * TweetRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TweetRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Retourne les (limit) derniers tweets ajoutés en base de données.
     *
     * @param int $limit
     *
     * @return array
     */
    public function getLastTweets($limit = 10)
    {
        return $this->createQueryBuilder('t')
            ->select('t')
            ->orderBy('t.createdAt', 'DESC')
            //->orderBy('t.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
