<?php

namespace AppBundle\Controller;


use AppBundle\Form\RosterFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("is_granted('ROLE_ADMIN')")
 * @Route("/admin")
 */
class RosterAdminController extends Controller
{
    /**
     * @Route("/roster/new",name="admin_roster_create")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(RosterFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $roster = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($roster);
            $em->flush();
            $this->addFlash("success", "Player add to game!!");
            return $this->redirectToRoute('game_list');
        }
        return $this->render("admin/roster/new.html.twig", ["rosterForm" => $form->createView()]);
    }
}
