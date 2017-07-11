<?php
/**
 * Created by PhpStorm.
 * User: joro
 * Date: 7/1/17
 * Time: 12:15 AM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Nation;
use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
use Doctrine\ORM\EntityRepository;

class PlayerRepository extends EntityRepository
{
    /**
     * @return Player[]
     */
    public function findAllOrderByLastName(){
        return $this->createQueryBuilder("player")
            ->orderBy('player.lastName','ASC')
            ->getQuery()
            ->execute();
    }

    /**
     * @param Team $team
     * @return Player[]
     */
    public function findAllPlayersOfTeam(Team $team){

        return $this->createQueryBuilder('player')
            ->andWhere('player.team = :team')
            ->setParameter('team', $team)
            ->orderBy('player.number', 'ASC')
            ->getQuery()
            ->execute();
    }
    public function findAllPlayersOfNation(Nation $nation){

        return $this->createQueryBuilder('player')
            ->andWhere('player.nation = :nation')
            ->setParameter('nation', $nation)
            ->orderBy('player.lastName','ASC')
            ->getQuery()
            ->execute();
    }
    public function findAllPlayersOfPosition($pos){

        return $this->createQueryBuilder('player')
            ->andWhere('player.position = :position')
            ->setParameter('position', $pos)
            ->orderBy('player.lastName','ASC')
            ->getQuery()
            ->execute();
    }

}