<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TasksController extends Controller
{
    /**
     * @Route("/")
     * @Template(":todolist:base.html.twig")
     */
    public function indexAction(Request $request)
    {
    }

    /**
     * @Route("/add")
     * @Method({"GET", "POST"})
     * @Template(":todolist:base.html.twig")
     */
    public function addAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm('AppBundle\Form\TaskType', $task);
        $form->handleRequest($request);

        return $this->render('task/add', [
            'task' => $task,
            'form' => $form->createView(),
        ]);
    }
}
