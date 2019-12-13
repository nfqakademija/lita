<?php

namespace App\Controller;

use App\Form\Type\ProgramType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'title' => 'NFQ Lita',
            'activeNavItem' => 'home',
        ]);
    }
}
