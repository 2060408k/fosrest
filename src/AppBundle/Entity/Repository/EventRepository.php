<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class EventRepository extends EntityRepository
{
    /**
     * Get all the events from the User
     * @param $userId
     * @return array
     */
    public function getEventsByBookProjectId($bookProjectId)
    {
        $queryBuilder = $this->_em->createQueryBuilder();

        $queryBuilder
            ->select('e.name, e.description')
            ->from('AppBundle:Event', 'e','e.id')
            ->innerJoin('e.bookProject','bp')
            ->where('bp.id = '.$bookProjectId)
            ->groupBy('e.id')
            ->orderBy('e.name', 'asc')
        ;

        $query = $queryBuilder->getQuery();

        $result = $query->getResult();

        return $result;
    }

}