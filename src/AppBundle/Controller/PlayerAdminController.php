<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Player;
use AppBundle\Form\PlayerFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("is_granted('ROLE_ADMIN')")
 * @Route("/admin")
 */
class PlayerAdminController extends Controller
{
    /**
     * @Route("/player/new",name="admin_player_create")
     */
    public function createAction(Request $request)
    {
        $form=$this->createForm(PlayerFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $team=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            $this->addFlash("success","Player created!!");
            return $this->redirectToRoute('player_list');
        }
        return $this->render("admin/player/new.html.twig",["playerForm"=>$form->createView()]);

    }
    /**
     * @Route("/player/{id}/new",name="admin_player_edit")
     */
    public function editAction(Request $request,Player $player)
    {
        $form=$this->createForm(PlayerFormType::class,$player);

        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $team=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            $this->addFlash("success","Player updated!!");
            return $this->redirectToRoute('player_list');
        }
        return $this->render("admin/player/edit.html.twig",["playerForm"=>$form->createView()]);

    }
    /**
     * @Route("/player/{id}/delete",name="admin_player_delete")
     */
    public function deletePlayerAction(Player $player)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($player);
        $em->flush();
        $this->addFlash("success","Player deleted!!");
        return $this->redirectToRoute('player_list');

    }
}
