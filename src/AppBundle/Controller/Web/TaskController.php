<?php

namespace AppBundle\Controller\Web;

use AppBundle\Entity\Project;
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{
    /**
     * @param Request $request
     * @Route("/task/create", name="task_create")
     * @return RedirectResponse
    */
    public function createAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        $test = $form->getData();

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

        }

        //get all tasks
        $allTasks = $this->getDoctrine()->getRepository(Task::class)->findAll();

        return $this->render('task/create.html.twig',
            array('form' => $form->createView(),
                  'allTasks' => $allTasks));
    }
}
