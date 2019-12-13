<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FilterController extends AbstractController
{
    /**
     * @Route(
     *     "/api/v1/filterAcademies",
     *     name="filter",
     *     methods={"GET"}
     * )
     * @param Request $request
     */
    public function filterAcademies(Request $request)
    {
        $program = $request->get('Program');
        $city = $request->get('City');
        $price = $request->get('Price');


    }
}
