<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Team;
use AppBundle\Form\TeamFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("is_granted('ROLE_ADMIN')")
 * @Route("/admin")
 */
class TeamAdminController extends Controller
{
    /**
     * @Route("/team/new",name="admin_team_create")
     */
    public function createAction(Request $request)
    {
        $form=$this->createForm(TeamFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $team=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            $this->addFlash("success","Team created!!");
            return $this->redirectToRoute('team_list');
        }
        return $this->render("admin/team/new.html.twig",["teamForm"=>$form->createView()]);

    }
    /**
     * @Route("/team/{id}/edit",name="admin_team_edit")
     */
    public function editAction(Request $request,Team $team)
    {
        if(!$team){
            return $this->redirectToRoute('team_list');
        }
        $form=$this->createForm(TeamFormType::class,$team);

        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $team=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            $this->addFlash("success","Team updated!!");
            return $this->redirectToRoute('team_list');
        }
        return $this->render("admin/team/edit.html.twig",["teamForm"=>$form->createView()]);

    }
    /**
     * @Route("/team/{id}/delete",name="admin_team_delete")
     */
    public function deleteTeamAction(Team $team)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($team);
        $em->flush();
        $this->addFlash("success","Team deleted!!");
        return $this->redirectToRoute('team_list');

    }

}
