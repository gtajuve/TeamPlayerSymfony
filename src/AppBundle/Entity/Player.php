<?php
/**
 * Created by PhpStorm.
 * User: joro
 * Date: 7/7/17
 * Time: 10:05 PM
 */
namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerRepository")
 * @ORM\Table(name="player")
 */

class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $firstName;
    /**
     * @ORM\Column(type="string")
     */
    private $lastName;
    /**
     * @ORM\Column(type="string")
     */
    private $position;
    /**
     * @ORM\Column(type="string")
     * @Assert\Range(min=1,max=99)
     */
    private $number;
    /**
     * @ORM\ManyToOne(targetEntity="Nation")
     * @ORM\JoinColumn()
     */
    private $nation;

    /**
     * Player constructor.
     * @param $games
     */
    public function __construct()
    {
        $this->games = new ArrayCollection();
    }

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
    public function getNation()
    {
        return $this->nation;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }


    /**
     * @ORM\ManyToOne(targetEntity="Team",inversedBy="players")
     * @ORM\JoinColumn(nullable=true)
     */
    private $team;

    /**
     * @ORM\ManyToMany(targetEntity="Game",inversedBy="players")
     * @ORM\JoinColumn(nullable=true)
     */
    private $games;

    /**
     * @return mixed
     */
    public function getGames()
    {
        return $this->games;
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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param mixed $team
     */
    public function setTeam(Team $team)
    {
        $this->team = $team;
    }
    public function __toString()
    {
        return $this->getFirstName()." ".$this->getLastName()." ".$this->getTeam();
    }
}