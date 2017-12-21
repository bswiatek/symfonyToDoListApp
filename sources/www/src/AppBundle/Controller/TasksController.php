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
     * @Route("/", name="list-tasks")
     * @Template(":todolist:base.html.twig")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tasks = $em
            ->getRepository(Task::class)
            ->findAll();

        return $this->render(':task:list.html.twig', ['tasks' => $tasks]);
    }

    /**
     * @Route("task/add", name="add-task")
     * @Method({"GET", "POST"})
     * @Template(":todolist:base.html.twig")
     */
    public function addAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm('AppBundle\Form\TaskType', $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirect('/');
        }

        return $this->render('task/add.html.twig', [
            'task' => $task,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("task/done/{id}", name="markdone-task")
     * @Method({"POST", "GET"})
     */
    public function doneAction($id)
    {
        $task = $this
            ->getDoctrine()
            ->getRepository(Task::class)
            ->find($id);

        if(!$task) {
            throw new \Exception('Task not found.');
        }

        $task->markDone(true);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('list-tasks');
    }

    /**
     * @Route("task/undone/{id}", name="markundone-task")
     * @Method({"POST", "GET"})
     */
    public function undoneAction($id)
    {
        $task = $this
            ->getDoctrine()
            ->getRepository(Task::class)
            ->find($id);

        if(!$task) {
            throw new \Exception('Task not found.');
        }

        $task->markDone(false);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('list-tasks');
    }

    /**
     * @Route("task/remove/{id}", name="remove-task")
     * @Method({"POST", "GET"})
     */
    public function removeAction($id)
    {
        $task = $this
            ->getDoctrine()
            ->getRepository(Task::class)
            ->find($id);

        if(!$task) {
            throw new \Exception('Task not found.');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();

        return $this->redirectToRoute('list-tasks');
    }
}
