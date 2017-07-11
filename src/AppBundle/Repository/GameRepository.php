<?php
/**
 * Created by PhpStorm.
 * User: joro
 * Date: 7/1/17
 * Time: 12:15 AM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Game;
use Doctrine\ORM\EntityRepository;

class GameRepository extends EntityRepository
{
    /**
     * @return Game[]
     */
    public function findAllOrderByPlayedDate(){
        return $this->createQueryBuilder("game")
            ->orderBy('game.playedAt','ASC')
            ->getQuery()
            ->execute();
    }

}