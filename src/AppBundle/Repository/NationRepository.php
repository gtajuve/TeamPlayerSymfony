<?php
/**
 * Created by PhpStorm.
 * User: joro
 * Date: 7/9/17
 * Time: 9:08 PM
 */
namespace AppBundle\Repository;
use AppBundle\Entity\Nation;
use Doctrine\ORM\EntityRepository;

class NationRepository extends EntityRepository
{
    /**
     * @return Nation[]
     */
    public function findAllAlpha(){
        return $this->createQueryBuilder("nation")
            ->orderBy('nation.name','ASC');

    }

}