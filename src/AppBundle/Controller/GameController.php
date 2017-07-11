<?php

namespace AppBundle\Controller;

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
//        foreach($games as $game){
//            $game["homeNat"]=$game->getHomeTeam()->getNation();
//            $game["awayNat"]=$game->getAwayTeam()->getNation();
//        }

        return $this->render('game/list.html.twig', array('games' => $games));
    }
}
