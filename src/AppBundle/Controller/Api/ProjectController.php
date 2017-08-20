<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Project;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends FOSRestController
{
    /**
     * @Route("/all/projects", name="project_getAll")
     *
     * @return Response
     * @Method("GET")
     */
    public function getAllProjectsAction()
    {
        $projects = $this->getDoctrine()->getRepository(Project::class)->findAll();

        $json = $this->serialize(['project' => $projects]);
        $response = new Response($json, 200);

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/all/projects/names", name="project_getNames")
     *
     * @return Response
     * @Method("GET")
     */
    public function getProjectsNamesAction()
    {
        $projects = $this->getDoctrine()->getRepository(Project::class)->findAll();

        $data = array();

        foreach ($projects as $pr)
        {
            $data[$pr->getId()] = array('name' => $pr->getName());
        }

        $json = $this->serialize($data);

        $response = new Response($json, 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    private function serialize( $data)
    {
        return $this->container->get('jms_serializer')
            ->serialize($data, 'json');
    }
}
