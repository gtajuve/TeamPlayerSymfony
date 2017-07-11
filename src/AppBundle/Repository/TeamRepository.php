<?php
/**
 * Created by PhpStorm.
 * User: joro
 * Date: 7/1/17
 * Time: 12:15 AM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Nation;
use AppBundle\Entity\Team;
use Doctrine\ORM\EntityRepository;

class TeamRepository extends EntityRepository
{
    /**
     * @return Team[]
     */
    public function findAllOrderByName(){
        return $this->createQueryBuilder("team")
            ->orderBy('team.name','ASC')
            ->getQuery()
            ->execute();
    }
    /**
     * @return Team[]
     */
    public function findAllAlpha(){
        return $this->createQueryBuilder("team")
            ->orderBy('team.name','ASC');
    }
    public function findAllTeamsOfNation(Nation $nation){

        return $this->createQueryBuilder('team')
            ->andWhere('team.nation = :nation')
            ->setParameter('nation', $nation)
            ->orderBy('team.name','ASC')
            ->getQuery()
            ->execute();
    }
}