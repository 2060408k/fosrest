<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class BookProjectRepository extends EntityRepository
{
    /**
     * Get all the BookProjects from the User
     * @param $userId
     * @return array
     */
    public function getBookProjectsByUserId($userId)
    {
        $queryBuilder = $this->_em->createQueryBuilder();

        $queryBuilder
            ->select('bp.id, bp.content, bp.name')
            ->from('AppBundle:BookProject', 'bp')
            ->innerJoin('bp.user', 'u')
            ->where('u.id = '.$userId)
            ->groupBy('bp.id')
            ->orderBy('bp.id', 'asc')
        ;

        $query = $queryBuilder->getQuery();

        $result = $query->getResult();
        return $result;
    }
}