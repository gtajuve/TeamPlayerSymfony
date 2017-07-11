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
class TeamController extends Controller
{
    /**
     * @Route("/team",name="team_list")
     */
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $teams=$em->getRepository("AppBundle:Team")->findAllOrderByName();
        return $this->render('team/list.html.twig', array('teams' => $teams));
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
