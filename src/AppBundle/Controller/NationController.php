<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Security("is_granted('ROLE_USER')")
 *
 */
class NationController extends Controller
{
    /**
     * @Route("/nation",name="nation_list")
     */
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $nations=$em->getRepository("AppBundle:Nation")->findAll();
        return $this->render('nation/list.html.twig', array('nations' => $nations));
    }
}
