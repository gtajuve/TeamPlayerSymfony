<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Nation;
use AppBundle\Entity\Team;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * @Security("is_granted('ROLE_USER')")
 *
 */
class PlayerController extends Controller
{
    /**
     * @Route("/player",name="player_list")
     */
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $players=$em->getRepository("AppBundle:Player")->findAllOrderByLastName();
        return $this->render('player/list.html.twig', array('players' => $players));
    }
    /**
     * @Route("/team/{id}/player",name="show_team_players")
     */
    public function showPlayersAction(Team $team)
    {
        $em=$this->getDoctrine()->getManager();
        $players=$em->getRepository("AppBundle:Player")->findAllPlayersOfTeam($team);
        return $this->render('player/list.html.twig', array('players' => $players));
    }
    /**
     * @Route("/nation/{name}/player",name="show_nation_players")
     */
    public function showNationPlayersAction(Nation $nation)
    {
        $em=$this->getDoctrine()->getManager();
        $players=$em->getRepository("AppBundle:Player")->findAllPlayersOfNation($nation);
        return $this->render('player/list.html.twig', array('players' => $players));
    }
    /**
     * @Route("/position/{pos}/player",name="show_position_players")
     */
    public function showPositionPlayersAction($pos)
    {
        $em=$this->getDoctrine()->getManager();
        $players=$em->getRepository("AppBundle:Player")->findAllPlayersOfPosition($pos);
        return $this->render('player/list.html.twig', array('players' => $players));
    }
}
