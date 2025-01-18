<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{   
    #[Route(path:'/',name:"index" )]
    public function index()
    {
        return $this->render("Homepage/homepage.html.twig");
    }
}