<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/{academyId<\d+>?}", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'title' => 'NFQ Lita',
            'activeNavItem' => 'home'
        ]);
    }
}
