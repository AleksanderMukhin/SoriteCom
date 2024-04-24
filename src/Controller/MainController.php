<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @Route("/Redirectionregister", name="redregister")
     */
    public function myControllerAction(Request $request): Response
    {
        return $this->render('register.html.twig');
    }
}
