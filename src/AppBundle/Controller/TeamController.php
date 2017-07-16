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
class TeamController extends Controller
{
    /**
     * @Route("/team",name="team_list")
     */
    public function indexAction(Request $request)
    {
        $perPage=5;
        if($request->get("perPage")){
            $perPage=$request->get("perPage");
        }
        $em=$this->getDoctrine()->getManager();
        $teams=$em->getRepository("AppBundle:Team")->findAllOrderByName();

        /**
         * @var $paginator Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $teams, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $perPage/*limit per page*/
        );
        dump($teams);
        return $this->render('team/list.html.twig', compact("teams","pagination"));
    }
    /**
     * @Route("/nation/{name}/team",name="show_nation_teams")
     */
    public function showNationPlayersAction(Nation $nation)
    {
        $em=$this->getDoctrine()->getManager();
        $teams=$em->getRepository("AppBundle:Team")->findAllTeamsOfNation($nation);
        return $this->render('team/list.html.twig', array('teams' => $teams));
    }

}
