<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ChapterRepository extends EntityRepository
{
    /**
     * Get all the chapters from the User
     * @param $userId
     * @return array
     */
    public function getChaptersByBookProjectId($bookProjectId)
    {
        $queryBuilder = $this->_em->createQueryBuilder();

        $queryBuilder
            ->select('c.name, c.description, c.position')
            ->from('AppBundle:Chapter', 'c','c.id')
            ->innerJoin('c.bookProject', 'bp')
            ->where('bp.id = '.$bookProjectId)
            ->groupBy('c.id')
            ->orderBy('c.position', 'asc')
        ;

        $query = $queryBuilder->getQuery();

        $result = $query->getResult();
        return $result;
    }
}