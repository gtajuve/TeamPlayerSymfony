<?php
/**
 * Created by PhpStorm.
 * User: joro
 * Date: 7/8/17
 * Time: 9:50 PM
 */
namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 * @ORM\Table(name="game")
 */

class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\Regex(pattern="/\d+:\d+/",message="Wrong Score Format!!")
     */
    private $score;
    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(nullable=true)
     */
    private $homeTeam;
    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(nullable=true)
     */
    private $awayTeam;

    /**
     * @ORM\Column(type="date")
     */
    private $playedAt;

    /**
     * @ORM\ManyToMany(targetEntity="Player",mappedBy="games")
     * @ORM\JoinColumn(nullable=true)
     */
    private $players;

    /**
     * Game constructor.
     *
     */
    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getPlayedAt()
    {
        return $this->playedAt;
    }

    /**
     * @param mixed $playedAt
     */
    public function setPlayedAt($playedAt)
    {
        $this->playedAt = $playedAt;
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
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * @param mixed $homeTeam
     */
    public function setHomeTeam(Team $homeTeam)
    {
        $this->homeTeam = $homeTeam;
    }

    /**
     * @return mixed
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * @param mixed $awayTeam
     */
    public function setAwayTeam(Team $awayTeam)
    {
        $this->awayTeam = $awayTeam;
    }
    public function __toString()
    {
        return $this->getHomeTeam().$this->getScore().$this->getAwayTeam();
    }

    /**
     * @return mixed
     */
    public function getPlayers()
    {
        return $this->players;
    }


}