<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AcademiesController extends AbstractController
{
    /**
     * @Route("/api/v1/academies", name="academies")
     * @method({'GET'})
     */
    public function index()
    {
        return new JsonResponse([
            'success' => true,
            'data'    => []
        ]);
    }
}
