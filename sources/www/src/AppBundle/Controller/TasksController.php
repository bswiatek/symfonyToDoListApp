<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
}
