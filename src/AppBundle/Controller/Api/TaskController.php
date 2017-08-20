<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\View;

class TaskController extends Controller
{
    /**
     * @Route("/all/task", name="task_all")
     *
     * @return Response
     * @Method("GET")
     */
    public function getAllTasksAction()
    {
        $tasks = $this->getDoctrine()->getRepository(Task::class)->findAll();

        $json = $this->serialize(['tasks' => $tasks]);
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
