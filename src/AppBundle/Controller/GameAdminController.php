<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use AppBundle\Form\GameFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Security("is_granted('ROLE_ADMIN')")
 * @Route("/admin")
 */

class GameAdminController extends Controller
{
    /**
     * @Route("/game/new",name="admin_game_create")
     */
    public function createAction(Request $request)
    {
        $form=$this->createForm(GameFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $game=$form->getData();

            $em=$this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();
            $this->addFlash("success","Game created!!");
            return $this->redirectToRoute('game_list');
        }
        return $this->render("admin/game/new.html.twig",["gameForm"=>$form->createView()]);

    }
    /**
     * @Route("/game/{id}/new",name="admin_game_edit")
     */
    public function editAction(Request $request,Game $game)
    {
        $form=$this->createForm(GameFormType::class,$game);

        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $game=$form->getData();

            $em=$this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();
            $this->addFlash("success","Game edited!!");
            return $this->redirectToRoute('game_list');
        }
        return $this->render("admin/game/edit.html.twig",["gameForm"=>$form->createView()]);

    }
}
