<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
    #[Route('/Liste/{var}', name:'Liste_first')]
    public function First($var)
    {
        return new Response("welcome to our home".$var);
    }
    #[Route('/show', name:'show_first')]
    public function  showProduct()
    {
        return $this->render("first/show.html.twig");
    }
}