<?php
/**
 * Created by PhpStorm.
 * User: joro
 * Date: 7/7/17
 * Time: 9:48 PM
 */
namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamRepository")
 * @ORM\Table(name="team")
 * @ExclusionPolicy("all")
 */

class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     * @Expose()
     */
    private $name;
    /**
     * @ORM\OneToMany(targetEntity="Player",mappedBy="team")
     */
    private $players;
    /**
     * @ORM\ManyToOne(targetEntity="Nation")
     * @ORM\JoinColumn()
     * @Expose()
     */
    private $nation;

    /**
     * @param mixed $nation
     */
    public function setNation($nation)
    {
        $this->nation = $nation;
    }

    /**
     * @return mixed
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     *
     */
    public function __construct()
    {
        $this->players = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNation()
    {
        return $this->nation;
    }
    public function __toString()
    {
        return $this->getName();
    }

}