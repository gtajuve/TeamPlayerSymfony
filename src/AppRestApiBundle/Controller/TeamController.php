<?php

namespace AppRestApiBundle\Controller;

use AppBundle\Entity\Nation;
use AppBundle\Entity\Team;
use AppBundle\Form\TeamFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{
    /**
     * @Route("/team", name="rest_api_articles")
     * @Method("GET")
     */
    public function indexAction()
    {
        $articles = $this->getDoctrine()->getRepository(Team::class)->findAll();
        $serializer = $this->container->get('jms_serializer');
        $json = $serializer->serialize($articles, 'json');
        return new Response($json,Response::HTTP_OK,array('content-type' => 'application/json'));
    }
    /**
     * @Route("/team/{id}", name="rest_api_article")
     * @Method({"GET"})
     * @param $id article id
     * @return JsonResponse
     */
    public function articleAction(Team $team)
    {
//        $team = $this->getDoctrine()->getRepository(Team::class)->find($id);
        try {
                if(null === $team) {
                    return new Response(json_encode(array('error' => 'resource not found')),
                                         Response::HTTP_NOT_FOUND,
                                        array('content-type' => 'application/json'));
                    }
            $serializer = $this->container->get('jms_serializer');
            $teamJson = $serializer->serialize($team, 'json');
            return new Response($teamJson,
                                Response::HTTP_OK,
                                array('content-type' => 'application/json')
            );}catch (\Exception $e) {
                        return new Response(json_encode(['error' => $e->getMessage()]),
                            Response::HTTP_BAD_REQUEST,
                            array('content-type' => 'application/json')
                        );
        }

    }
    /**
     * @Route("/team/create", name="rest_api_team_create")
     * @Method({"POST"})
     * @param $request Request
     * @return Response
     */
    public function createAction(Request $request)
    {
        try {
            //process submitted data
            $this->createNewTeam($request);
            return new Response(null,Response::HTTP_CREATED);
            } catch (\Exception $e) {
                    return new Response(json_encode(['error' => $e->getMessage()]),
                Response::HTTP_BAD_REQUEST,
                array('content-type' => 'application/json')
            );
        }
    }
    /**
     * Creates new article from request parameters and persists it
     * @param Request $request
     * @return Team - persisted article
     */
    protected function createNewTeam(Request $request) {
        $team = new Team();
        $parameters = $request->request->all();
        $persistedType = $this->processForm($team, $parameters, 'POST');
        return $persistedType;
    }
    /**
     * Processes the form.
     * @param Request $request
     * @return Team
     * @throws \Exception
     */
    private function processForm($team, $params, $method = 'PUT') {
        foreach($params as $param => $paramValue) {
            if(null === $paramValue || 0 === strlen(trim($paramValue))) {
                throw new \Exception("invalid data: $param");
            }
        }

        $nation = $this->getDoctrine()
            ->getRepository(Nation::class)
            ->find($params['nation']);
        if(null === $nation) {
            throw new \Exception('invalid nation id');
        }
        $form = $this->createForm(TeamFormType::class, $team, ['method'
                => $method]);
        $form->submit($params);
        if ($form->isSubmitted()) {

            //get entity manager
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            return $team;
        }
        throw new \Exception('submitted data is invalid');
    }
    /**
     * @Route("/team/{id}", name="rest_api_team_delete")
     * @Method({"DELETE"})
     * @param $request Request
     * @return Response
     */
    public function deleteAction(Request $request, $id)
    {
        try {
            $team = $this->getDoctrine()->getRepository(Team::class)->find($id);
             if(null === $team) {
                 $statusCode = Response::HTTP_NOT_FOUND;
             } else {
                 $em = $this->getDoctrine()->getManager();
                 $em->remove($team);
                 $em->flush();
                 $statusCode = Response::HTTP_NO_CONTENT;
             }
             return new Response(null,$statusCode);
             } catch (\Exception $e) {
                        return new Response(json_encode(['error' => $e->getMessage()]),
                            Response::HTTP_BAD_REQUEST,
                            array('content-type' => 'application/json')
                        );
                    }
    }
}
