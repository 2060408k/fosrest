<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class CharacterRepository extends EntityRepository
{
    /**
     * Get all the characters from the User
     * @param $userId
     * @return array
     */
    public function getCharactersByBookProjectId($bookProjectId)
    {
        $queryBuilder = $this->_em->createQueryBuilder();

        $queryBuilder
            ->select('c.name, c.surname, c.dob, c.origin, c.skills')
            ->from('AppBundle:Character', 'c','c.id')
            ->innerJoin('c.bookProject','bp')
            ->where('bp.id = '.$bookProjectId)
            ->groupBy('c.id')
            ->orderBy('c.name', 'asc')
        ;

        $query = $queryBuilder->getQuery();

        $result = $query->getResult();
        return $result;
    }
}