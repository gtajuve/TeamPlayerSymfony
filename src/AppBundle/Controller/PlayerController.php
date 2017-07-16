<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Nation;
use AppBundle\Entity\Team;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Security("is_granted('ROLE_USER')")
 *
 */
class PlayerController extends Controller
{
    const NUM_RESULT=10;
    /**
     * @Route("/player",name="player_list")
     */
    public function indexAction(Request $request)
    {
        $perPage=self::NUM_RESULT;
        if($request->get("perPage")){
            $perPage=$request->get("perPage");
        }
        $currentPage=$request->get("page");
        $em=$this->getDoctrine()->getManager();
        $players=$em->getRepository("AppBundle:Player")->findAllPaginated($request->get("page"),$perPage);
        $countPlayers=$em->getRepository("AppBundle:Player")->getPlayerCount();
        $pages=ceil($countPlayers/$perPage)-1;
        dump($countPlayers);
        return $this->render('player/list.html.twig',compact("players","pages","currentPage"));
    }
    /**
     * @Route("/team/{id}/player",name="show_team_players")
     */
    public function showPlayersAction(Team $team)
    {
//        $em=$this->getDoctrine()->getManager();
//        $players=$em->getRepository("AppBundle:Player")->findAllPlayersOfTeam($team);
        $players=$team->getPlayers();
        return $this->render('player/list.html.twig',compact("players"));
    }
    /**
     * @Route("/nation/{name}/player",name="show_nation_players")
     */
    public function showNationPlayersAction(Nation $nation)
    {
        $em=$this->getDoctrine()->getManager();
        $players=$em->getRepository("AppBundle:Player")->findAllPlayersOfNation($nation);
        return $this->render('player/list.html.twig', compact("players"));
    }
    /**
     * @Route("/position/{pos}/player",name="show_position_players")
     */
    public function showPositionPlayersAction($pos)
    {
        $em=$this->getDoctrine()->getManager();
        $players=$em->getRepository("AppBundle:Player")->findAllPlayersOfPosition($pos);
        return $this->render('player/list.html.twig', compact("players"));
    }
}
