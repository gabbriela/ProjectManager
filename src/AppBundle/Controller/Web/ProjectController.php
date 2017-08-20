<?php

namespace AppBundle\Controller\Web;

use AppBundle\Entity\Project;
use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends Controller
{
    /**
     * @param Request $request
     * @Route("/project/showAll", name="project_showAll")
     * @return RedirectResponse
     */
    public function showAllAction()
    {
        $projects = $this->getDoctrine()->getRepository(Project::class)->findAll();

        return $this->render('project/showAll.html.twig', array('projects' => $projects));
    }

    /**
     *
     * @Route("/project/show/{id}", name="project_show")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Method({"GET"})
     */
    public function showAction($id)
    {
        $project = $this->getDoctrine()->getRepository(Project::class)->find($id);

        $tasks = $this->getDoctrine()->getRepository(Task::class)->findBy(['projectId' => $id]);

        return $this->render('project/show.html.twig', array('project' => $project, 'tasks' => $tasks));
    }
}
