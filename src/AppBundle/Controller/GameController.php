<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * @Security("is_granted('ROLE_USER')")
 *
 */

class GameController extends Controller
{
    /**
     * @Route("/game",name="game_list")
     */
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $games=$em->getRepository("AppBundle:Game")->findAllOrderByPlayedDate();
//

        return $this->render('game/list.html.twig', array('games' => $games));
    }
    /**
     * @Route("/game/{id}/players",name="roster_list")
     */
    public function showPlayersAction(Game $game)
    {
        $players=$game->getPlayers();


        return $this->render('player/list.html.twig', array('players' => $players));
    }
}
