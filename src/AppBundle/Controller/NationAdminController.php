<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Nation;
use AppBundle\Form\NationFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Security("is_granted('ROLE_ADMIN')")
 * @Route("/admin")
 */
class NationAdminController extends Controller
{
    /**
     * @Route("/nation/new",name="admin_nation_create")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(NationFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $team = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            $this->addFlash("success", "Nation created!!");
            return $this->redirectToRoute('team_list');
        }
        return $this->render("admin/nation/new.html.twig", ["nationForm" => $form->createView()]);
    }
    /**
     * @Route("/nation/{id}/edit",name="admin_nation_edit")
     */
    public function editNationAction(Request $request,Nation $nation)
    {
        $form = $this->createForm(NationFormType::class,$nation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $team = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            $this->addFlash("success", "Nation updated!!");
            return $this->redirectToRoute('nation_list');
        }
        return $this->render("admin/nation/new.html.twig", ["nationForm" => $form->createView()]);
    }
}
